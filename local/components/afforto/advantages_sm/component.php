<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль "Инфоблоки" не подключен');
    return;
}

// Получаем параметры
$iblockId = (int)$arParams['IBLOCK_ID'];
$sectionId = (int)$arParams['SECTION_ID']; // ID выбранного раздела

if (!$iblockId || !$sectionId) {
    ShowError('Не указан инфоблок или раздел');
    return;
}

// Настройки кэша
$cacheType = $arParams['CACHE_TYPE'];
$cacheTime = (int)$arParams['CACHE_TIME'];
$cacheId = md5(serialize([$iblockId, $sectionId, $arParams]));
$cachePath = '/advantages_component/';

// Инициализация кэша
$cache = Bitrix\Main\Data\Cache::createInstance();

if ($cacheType !== 'N' && $cache->initCache($cacheTime, $cacheId, $cachePath)) {
    // Если данные есть в кэше, загружаем их
    $arResult = $cache->getVars();
} elseif ($cacheType !== 'N' && $cache->startDataCache()) {
    // Если данных в кэше нет, загружаем их из базы
    $arResult = [];
    $arResult['TITLE'] = $arParams['COMPONENT_TITLE']; // Заголовок блока
    $dbElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        [
            'IBLOCK_ID' => $iblockId,
            'SECTION_ID' => $sectionId,
            'ACTIVE' => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y', // Включать элементы из подразделов
        ],
        false,
        false,
        ['ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT']
    );

    while ($element = $dbElements->Fetch()) {
        $arResult['ITEMS'][] = [
            'ID' => $element['ID'],
            'NAME' => $element['NAME'],
            'PREVIEW_TEXT' => $element['PREVIEW_TEXT'],
            'PREVIEW_PICTURE' => CFile::GetPath($element['PREVIEW_PICTURE']),
        ];
    }

    // Если раздел пустой, сбрасываем кэш
    if (empty($arResult['ITEMS'])) {
        $cache->abortDataCache();
    } else {
        // Сохраняем данные в кэш
        $cache->endDataCache($arResult);
    }
}

// Передаем данные в шаблон
$this->IncludeComponentTemplate();
