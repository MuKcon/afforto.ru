<?php if (defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true) ?>
<?php

use Bitrix\Main\Data\Cache;
use intec\Core;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\StringHelper;

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $arViews
 * @var array $arFilter
 * @var CBitrixComponent
 */

$arElements = [
    'SHOW' => false
];

$oCache = Cache::createInstance();

$arElementsFilter = [];

if (!empty($arResult['SECTION']))
    $arElementsFilter['SECTION_ID'] = $arResult['SECTION']['ID'];

if ($arParams['INCLUDE_SUBSECTIONS'] === 'Y' || $arParams['INCLUDE_SUBSECTIONS'] === 'A')
    $arElementsFilter['INCLUDE_SUBSECTIONS'] = 'Y';

if ($arParams['INCLUDE_SUBSECTIONS'] === 'A')
    $arElementsFilter['SECTION_GLOBAL_ACTIVE'] = 'Y';

if ($oCache->initCache(36000, 'ELEMENTS'.serialize($arElementsFilter), '/iblock/catalog')) {
    $arElements = $oCache->getVars();
} else if ($oCache->startDataCache()) {
    $rsElements = CIBlockElement::GetList(['SORT' => 'ASC'], $arElementsFilter, false, false);
    $arElements['SHOW'] = $rsElements->Fetch();
    $arElements['SHOW'] = !empty($arElements['SHOW']);

    $oCache->endDataCache($arElements);

    unset($rsElements);
}

unset($arElementsFilter);

$arElements['VIEW'] = Core::$app->session->get('BITRIX_CATALOG_VIEW');
$sView = Core::$app->request->get('view');

if (!empty($sView))
    $arElements['VIEW'] = $sView;

unset($sView);

if (empty($arElements['VIEW']))
    $arElements['VIEW'] = ArrayHelper::getValue($arParams, 'LIST_VIEW');

Core::$app->session->set('BITRIX_CATALOG_VIEW', $arElements['VIEW']);

foreach ($arViews as $sView => &$arView) {
    $arView['ACTIVE'] = false;

    if ($arElements['VIEW'] === $arView['VALUE'])
        $arElements['VIEW'] = $sView;

    unset($arView);
}

$arElements['VIEW'] = ArrayHelper::fromRange(ArrayHelper::getKeys($arViews), $arElements['VIEW']);
$arElements['TEMPLATE'] = ArrayHelper::getValue($arParams, 'LIST_'.$arElements['VIEW'].'_TEMPLATE');
$arElements['PARAMETERS'] = [];

$arViews[$arElements['VIEW']]['ACTIVE'] = true;

if (empty($arElements['TEMPLATE']))
    $arElements['SHOW'] = false;

if ($arElements['SHOW'] || !empty($arElements['TEMPLATE'])) {
    $sPrefix = 'LIST_'.$arElements['VIEW'].'_';
    $arElements['TEMPLATE'] = 'catalog.'.$arElements['TEMPLATE'];

    foreach ($arParams as $sKey => $mValue) {
        if (StringHelper::startsWith($sKey, $sPrefix)) {
            $sKey = StringHelper::cut(
                $sKey,
                StringHelper::length($sPrefix)
            );

            if ($sKey === 'TEMPLATE')
                continue;

            if (StringHelper::startsWith($sKey, 'QUICK_VIEW_'))
                continue;

            $arElements['PARAMETERS'][$sKey] = $mValue;
        } else if (StringHelper::startsWith($sKey, 'QUICK_VIEW_')) {
            $arElements['PARAMETERS'][$sKey] = $mValue;
        }
    }

    foreach ($arResult['PARAMETERS']['COMMON'] as $sProperty) {
        $arElements['PARAMETERS'][$sProperty] = ArrayHelper::getValue($arParams, $sProperty);
        $arElements['PARAMETERS']['QUICK_VIEW_'.$sProperty] = ArrayHelper::getValue($arParams, $sProperty);
    }

    $arElements['PARAMETERS'] = ArrayHelper::merge($arElements['PARAMETERS'], [
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
        'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
        'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
        'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
        'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
        'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
        'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
        'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
        'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
        'BASKET_URL' => $arParams['BASKET_URL'],
        'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
        'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
        'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
        'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
        'FILTER_NAME' => $arParams['FILTER_NAME'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_FILTER' => $arParams['CACHE_FILTER'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'SET_TITLE' => $arParams['SET_TITLE'],
        'MESSAGE_404' => $arParams['MESSAGE_404'],
        'SET_STATUS_404' => $arParams['SET_STATUS_404'],
        'SHOW_404' => $arParams['SHOW_404'],
        'FILE_404' => $arParams['FILE_404'],
        'PAGE_ELEMENT_COUNT' => $arParams['PAGE_ELEMENT_COUNT'],
        'LINE_ELEMENT_COUNT' => 3,
        'DISPLAY_PREVIEW' => $arParams['LIST_DESCRIPTION_SHOW'],
        'DISPLAY_PROPERTIES' => $arParams['LIST_PROPERTIES_SHOW'],
        'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],

        'PRICE_CODE' => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
        'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],

        'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
        'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
        'PAGER_TITLE' => $arParams['PAGER_TITLE'],
        'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
        'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
        'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],

        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
        'PRODUCT_DISPLAY_MODE' => 'Y',
        'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
        'OFFER_TREE_PROPS' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
        'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
        'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
        'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
        'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
        'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
        'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
        'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
        'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
        'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],

        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],

        'USE_COMPARE' => $arParams['USE_COMPARE'],
        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],

        'WIDE' => 'Y'
    ]);
}

if (!$arElements['SHOW'])
    $arFilter['SHOW'] = false;