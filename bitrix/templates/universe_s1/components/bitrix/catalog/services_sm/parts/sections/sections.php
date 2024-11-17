<?php if (defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true) ?>
<?php

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 */

$arSections = [
    'SHOW' => true,
    'POSITION' => ArrayHelper::fromRange([
        'top',
        'bottom'
    ], $arParams['SECTIONS_LIST_POSITION']),
    'TEMPLATE' => $arParams['SECTIONS_LIST_VIEW'],
    'PARAMETERS' => [
        'DISPLAY_DESCRIPTION' => $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'],
        'IMAGES' => $arParams['SECTIONS_LIST_VIEW_IMAGES'],
        'LINE_COUNT' => $arParams['SECTIONS_LIST_VIEW_LINE_COUNT'],
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
        'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
        'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
        'HIDE_SECTION_NAME' => (isset($arParams['SECTIONS_HIDE_SECTION_NAME']) ? $arParams['SECTIONS_HIDE_SECTION_NAME'] : 'N')
    ]
];