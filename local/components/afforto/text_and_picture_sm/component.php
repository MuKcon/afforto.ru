<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль инфоблоков не установлен');
    return;
}

// Проверка параметров
$iblockId = (int)$arParams['IBLOCK_ID'];
$elementId = (int)$arParams['ELEMENT_ID'];

if (!$iblockId || !$elementId) {
    ShowError('Не указан инфоблок или элемент');
    return;
}

// Настройки кэша
$cacheType = $arParams['CACHE_TYPE'];
$cacheTime = (int)$arParams['CACHE_TIME'];
$cacheId = md5(serialize([$iblockId, $elementId, $arParams]));
$cachePath = '/textandpicture_component/';

// Инициализация кэша
$cache = Bitrix\Main\Data\Cache::createInstance();

if ($cacheType !== 'N' && $cache->initCache($cacheTime, $cacheId, $cachePath)) {
    // Если данные есть в кэше, загружаем их
    $arResult = $cache->getVars();
} elseif ($cacheType !== 'N' && $cache->startDataCache()) {
    // Если данных в кэше нет, загружаем их из базы
    $arResult = [];
    $dbElement = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'ID' => $elementId, 'ACTIVE' => 'Y'],
        false,
        false,
        ['ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PICTURE']
    );

    if ($element = $dbElement->Fetch()) {
        $arResult['TITLE'] = $element['NAME']; // Заголовок
        $arResult['SHORT_DESCRIPTION'] = $element['PREVIEW_TEXT']; // Краткое описание
        $arResult['DETAILED_DESCRIPTION'] = $element['DETAIL_TEXT']; // Детальное описание
        $arResult['PREVIEW_IMAGE'] = CFile::GetPath($element['PREVIEW_PICTURE']); // Картинка анонса
        $arResult['DETAIL_IMAGE'] = CFile::GetPath($element['DETAIL_PICTURE']); // Детальная картинка
        $arResult['IMAGE_POSITION'] = $arParams['IMAGE_POSITION']; // Расположение изображения
    } else {
        // Если элемент не найден, сбрасываем кэш
        $cache->abortDataCache();
        ShowError('Элемент не найден');
        return;
    }

    // Сохраняем данные в кэш
    $cache->endDataCache($arResult);
}

// Передаем данные в шаблон
$this->IncludeComponentTemplate();
