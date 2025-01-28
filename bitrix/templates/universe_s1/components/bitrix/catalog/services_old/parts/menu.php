<?php if (defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true) ?>
<?php

use intec\core\helpers\Type;

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $arViews
 * @var array $arColumns
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 */

$arMenu = [
    'SHOW' => true,
    'TEMPLATE' => 'vertical.1',
    'PARAMETERS' => [
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ROOT_MENU_TYPE' => $arParams['MENU_ROOT_TYPE'],
        'CHILD_MENU_TYPE' => $arParams['MENU_CHILD_TYPE'],
        'MAX_LEVEL' => $arParams['MENU_MAX_LEVEL'],
        'MENU_CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'MENU_CACHE_TIME' => $arParams['CACHE_TIME'],
        'MENU_CACHE_USE_GROUPS' => $arParams['CACHE_GROUPS'],
        'MENU_CACHE_GET_VARS' => [],
        'PROPERTY_IMAGE' => $arParams['PROPERTY_IMAGE'],
        'PROPERTY_SHOW_HEADER_SUBMENU' => $arParams['SHOW_HEADER_SUBMENU'],
        'USE_EXT' => 'Y',
        'DELAY' => 'N',
        'ALLOW_MULTI_SELECT' => 'N'
    ]
];

if (!empty($arResult['ALIASES']))
    foreach ($arResult['ALIASES'] as $sAlias)
        if (!Type::isArray($sAlias))
            $arMenu['PARAMETERS']['MENU_CACHE_GET_VARS'][] = $sAlias;