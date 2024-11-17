<?php if (defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true) ?>
<?php

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 */

$arElements = [
    'SHOW' => true,
    'TEMPLATE' => $arParams['ELEMENTS_LIST_VIEW'],
    'PARAMETERS' => [
        'DISPLAY_DESCRIPTION' => $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'],
        'IMAGES' => $arParams['SECTIONS_LIST_VIEW_IMAGES'],
        'LINE_COUNT' => $arParams['SECTIONS_LIST_VIEW_LINE_COUNT'],

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
        'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
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
        'DISPLAY_COMPARE' => 'N',
        'PAGE_ELEMENT_COUNT' => $arParams['PAGE_ELEMENT_COUNT'],
        'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
        'PRICE_CODE' => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT' => 'N',
        'SHOW_PRICE_COUNT' => 'N',

        'PRICE_VAT_INCLUDE' => 'N',
        'USE_PRODUCT_QUANTITY' => 'N',
        'ADD_PROPERTIES_TO_BASKET' => null,
        'PARTIAL_PRODUCT_PROPERTIES' => null,
        'PRODUCT_PROPERTIES' => null,

        'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
        'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
        'PAGER_TITLE' => $arParams['PAGER_TITLE'],
        'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
        'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
        'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
        'PAGER_BASE_LINK_ENABLE' => $arParams['PAGER_BASE_LINK_ENABLE'],
        'PAGER_BASE_LINK' => $arParams['PAGER_BASE_LINK'],
        'PAGER_PARAMS_NAME' => $arParams['PAGER_PARAMS_NAME'],

        'OFFERS_CART_PROPERTIES' => null,
        'OFFERS_FIELD_CODE' => null,
        'OFFERS_PROPERTY_CODE' => null,
        'OFFERS_SORT_FIELD' => null,
        'OFFERS_SORT_ORDER' => null,
        'OFFERS_SORT_FIELD2' => null,
        'OFFERS_SORT_ORDER2' => null,
        'OFFERS_LIMIT' => null,

        'SECTION_ID' => false,
        'SECTION_CODE' => false,
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
        'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],

        'USE_MAIN_ELEMENT_SECTION' => $arResult['USE_MAIN_ELEMENT_SECTION'],
        'CONVERT_CURRENCY' => 'N',
        'CURRENCY_ID' => null,
        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
        'ADD_SECTIONS_CHAIN' => $arParams['ADD_SECTIONS_CHAIN'],
        'ADD_TO_BASKET_ACTION' => null,
        'COMPARE_PATH' => null,
        'LAZY_LOAD' => $arParams['LAZY_LOAD'],
        'MESS_BTN_LAZY_LOAD' => $arParams['MESS_BTN_LAZY_LOAD']
    ]
];