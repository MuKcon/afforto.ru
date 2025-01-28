<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль "Инфоблоки" не подключен');
    return;
}

// Получаем параметры
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
$cachePath = '/workflow_component/';

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
        ['ID', 'NAME', 'PROPERTY_HEADER', 'PROPERTY_STAGES']
    );

    if ($element = $dbElement->Fetch()) {
        $arResult['HEADER'] = $element['PROPERTY_HEADER_VALUE'];

        // Проверяем наличие привязки к разделам
        if (!empty($element['PROPERTY_STAGES_VALUE'])) {
            $arResult['STAGES'] = [];

            // Получаем ID разделов
            $sectionIds = is_array($element['PROPERTY_STAGES_VALUE'])
                ? $element['PROPERTY_STAGES_VALUE']
                : [$element['PROPERTY_STAGES_VALUE']];

            // Запрашиваем элементы из привязанных разделов
            $dbStages = CIBlockElement::GetList(
                ['SORT' => 'ASC'], // Сортировка
                [
                    'IBLOCK_SECTION_ID' => $sectionIds, // Привязанные разделы
                    'IBLOCK_ID' => $arParams['STAGES_IBLOCK_ID'], // ID инфоблока стадий
                    'ACTIVE' => 'Y',
                ],
                false,
                false,
                ['ID', 'NAME', 'PROPERTY_ICON', 'PROPERTY_DESCRIPTION']
            );

            while ($stage = $dbStages->Fetch()) {
                $arResult['STAGES'][] = [
                    'TITLE' => $stage['NAME'],
                    'ICON' => CFile::GetPath($stage['PROPERTY_ICON_VALUE']),
                    'DESCRIPTION' => [
                        'TEXT' => $stage['PROPERTY_DESCRIPTION_VALUE'],
                        'TYPE' => 'TEXT',
                    ],
                ];
            }
        }

        // Если раздел пустой, сбрасываем кэш
        if (empty($arResult['STAGES'])) {
            $cache->abortDataCache();
        } else {
            // Сохраняем данные в кэш
            $cache->endDataCache($arResult);
        }
    } else {
        // Сбрасываем кэш, если элемент не найден
        $cache->abortDataCache();
        ShowError('Элемент не найден');
        return;
    }
}

// Передаем результат в шаблон
$this->IncludeComponentTemplate();
