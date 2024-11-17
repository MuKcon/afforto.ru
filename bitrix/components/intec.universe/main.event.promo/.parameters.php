<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('iblock'))
    return;

/**
 * @var array $arCurrentValues
 */

/** Типы инфоблоков */
$arIBlockTypes = CIBlockParameters::GetIBlockTypes();

/** Список инфоблоков по выбранному типу */
$arIBlocks = [];

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $rsIBlocks = CIBlock::GetList(
        [], ['TYPE' => $arCurrentValues['IBLOCK_TYPE']]
    );
} else {
    $rsIBlocks = CIBlock::GetList();
}

while ($arIBlock = $rsIBlocks->GetNext()) {
    $arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
}

unset($rsIBlocks, $arIBlock);

/** Список элементов инфоблока */
$arElements = [];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $rsIBlockElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']]
    );

    if ($arCurrentValues['MODE'] == 'code') {
        while ($arElement = $rsIBlockElements->Fetch()) {
            $arElements[$arElement['CODE']] = '[' . $arElement['CODE'] . '] ' . $arElement['NAME'];
        }
    } else {
        while ($arElement = $rsIBlockElements->Fetch()) {
            $arElements[$arElement['ID']] = '[' . $arElement['ID'] . '] ' . $arElement['NAME'];
        }
    }

    unset($rsIBlockElements, $arElement);
}

$arParameters = [];

/** BASE */
$arParameters['IBLOCK_TYPE'] = [
    'PARENT' => 'BASE',
    'NAME' => Loc::getMessage('C_MAIN_ABOUT_IBLOCK_TYPE'),
    'TYPE' => 'LIST',
    'VALUES' => $arIBlockTypes,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];
$arParameters['IBLOCK_ID'] = [
    'PARENT' => 'BASE',
    'NAME' => Loc::getMessage('C_MAIN_ABOUT_IBLOCK_ID'),
    'TYPE' => 'LIST',
    'VALUES' => $arIBlocks,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];
$arParameters['MODE'] = [
    'PARENT' => 'BASE',
    'NAME' => Loc::getMessage('C_MAIN_ABOUT_MODE'),
    'TYPE' => 'LIST',
    'VALUES' => [
        'id' => Loc::getMessage('C_MAIN_ABOUT_MODE_ID'),
        'code' => Loc::getMessage('C_MAIN_ABOUT_MODE_CODE')
    ],
    'DEFAULT' => 'id',
    'REFRESH' => 'Y'
];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arParameters['ELEMENT'] = [
        'PARENT' => 'BASE',
        'NAME' => Loc::getMessage('C_MAIN_ABOUT_ELEMENT'),
        'TYPE' => 'LIST',
        'VALUES' => $arElements,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
}

$arParameters['CACHE_TIME'] = [];

/** DATA_SOURCE */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arParameters['HEADER_SOURCE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_ABOUT_HEADER_SOUCE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'element' => Loc::getMessage('C_MAIN_ABOUT_HEADER_SOUCE_ELEMENT'),
            'parameters' => Loc::getMessage('C_MAIN_ABOUT_HEADER_SOUCE_PARAMETERS')
        ],
        'DEFAULT' => 'parameters',
        'REFRESH' => 'Y'
    ];
    $arParameters['TEXT_SOURCE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_ABOUT_TEXT_SOURCE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'preview' => Loc::getMessage('C_MAIN_ABOUT_TEXT_SOURCE_PREVIEW'),
            'detail' => Loc::getMessage('C_MAIN_ABOUT_TEXT_SOURCE_DETAIL')
        ],
        'DEFAULT' => 'preview'
    ];
}

/** VISUAL */
$arParameters['HEADER_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_ABOUT_HEADER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['HEADER_SHOW'] == 'Y') {
    $arParameters['HEADER_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_ABOUT_HEADER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_MAIN_ABOUT_POSITION_LEFT'),
            'center' => Loc::getMessage('C_MAIN_ABOUT_POSITION_CENTER'),
            'right' => Loc::getMessage('C_MAIN_ABOUT_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];

    if ($arCurrentValues['HEADER_SOURCE'] != 'element') {
        $arParameters['HEADER_TEXT'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MAIN_ABOUT_HEADER_TEXT'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('C_MAIN_ABOUT_HEADER_TEXT_DEFAULT')
        ];
    }
}

/** Параметры компонента */
$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => $arParameters
];