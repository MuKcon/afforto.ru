<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

// Приводим параметры к числовым значениям
$arParams['IBLOCK_ID'] = (int)$arParams['IBLOCK_ID'];
$arParams['ELEMENT_ID'] = (int)$arParams['ELEMENT_ID'];

if ($arParams['IBLOCK_ID'] && $arParams['ELEMENT_ID']) {
    $dbElement = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arParams['ELEMENT_ID'], 'ACTIVE' => 'Y'],
        false,
        false,
        ['ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'PROPERTY_BUTTON_LINK', 'PROPERTY_BUTTON_TEXT']
    );

    if ($arElement = $dbElement->GetNext()) {
        $arResult['ELEMENT'] = $arElement;
    }
}
