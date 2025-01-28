<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\template\Properties;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 */

if ($arParams['SECTIONS_LIST_VIEW'] == 'settings') {
    switch (Properties::get('services-root-template')) {
        case 1:
            $arParams['SECTIONS_LIST_VIEW'] = 'tile';
            break;
        case 2:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 3:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 4:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'SQUARE_BIG';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 5:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'SQUARE_BIG';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 6:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'SQUARE_SMALL';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 7:
            $arParams['SECTIONS_LIST_VIEW'] = 'blocks';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'SQUARE_SMALL';
            $arParams['SECTIONS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 8:
            $arParams['SECTIONS_LIST_VIEW'] = 'extend';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'SQUARE';
            break;
        case 9:
            $arParams['SECTIONS_LIST_VIEW'] = 'extend';
            $arParams['SECTIONS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            break;
        case 10:
            $arParams['SECTIONS_LIST_VIEW'] = 'list';
            break;
    }
}

if ($arParams['ELEMENTS_LIST_VIEW'] == 'settings') {
    switch (Properties::get('services-section-template')) {
        case 1:
            $arParams['ELEMENTS_LIST_VIEW'] = 'tile';
            break;
        case 2:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 3:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 4:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'SQUARE_BIG';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 5:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'SQUARE_BIG';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 6:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'SQUARE_SMALL';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'Y';
            break;
        case 7:
            $arParams['ELEMENTS_LIST_VIEW'] = 'blocks';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'SQUARE_SMALL';
            $arParams['ELEMENTS_LIST_VIEW_DISPLAY_DESCRIPTION'] = 'N';
            break;
        case 8:
            $arParams['ELEMENTS_LIST_VIEW'] = 'extend';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'SQUARE';
            break;
        case 9:
            $arParams['ELEMENTS_LIST_VIEW'] = 'extend';
            $arParams['ELEMENTS_LIST_VIEW_IMAGES'] = 'CIRCLE';
            break;
        case 10:
            $arParams['ELEMENTS_LIST_VIEW'] = 'list';
            break;
    }
}

if ($arParams['TYPE_BANNER'] == 'settings') {
    switch (Properties::get('services-element-template')) {
        case 'narrow.1':
            $arParams['TYPE_BANNER'] = '1';
            $arParams['TYPE_BANNER_WIDE'] = 'N';
            break;
        case 'wide.1':
            $arParams['TYPE_BANNER'] = '1';
            $arParams['TYPE_BANNER_WIDE'] = 'Y';
            break;
        case 'narrow.2':
            $arParams['TYPE_BANNER'] = '2';
            $arParams['TYPE_BANNER_WIDE'] = 'N';
            break;
        case 'narrow.3':
            $arParams['TYPE_BANNER'] = '3';
            $arParams['TYPE_BANNER_WIDE'] = 'N';
            break;
        case 'narrow.4':
            $arParams['TYPE_BANNER'] = '4';
            $arParams['TYPE_BANNER_WIDE'] = 'N';
            break;
    }
}

if ($arParams['MENU_DISPLAY_IN_ROOT'] == 'settings')
    $arParams['MENU_DISPLAY_IN_ROOT'] = (
        Properties::get('services-root-menu-show')
    ) ? 'Y' : 'N';

if ($arParams['MENU_DISPLAY_IN_SECTION'] == 'settings')
    $arParams['MENU_DISPLAY_IN_SECTION'] = (
        Properties::get('services-section-menu-show')
    ) ? 'Y' : 'N';