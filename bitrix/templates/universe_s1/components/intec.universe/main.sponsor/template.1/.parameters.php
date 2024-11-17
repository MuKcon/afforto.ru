<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('iblock'))
    return;

/**
 * @var array $arCurrentValues
 */

/** Список свойств инфоблока */
$arPropertiesFile = [];
$arPropertiesText = [];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $rsProperties = CIBlockProperty::GetList(
        [], ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']]
    );

    while ($arProperty = $rsProperties->Fetch()) {
        if ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
}

$arTemplateParameters = [];

/** DATA_SOURCE */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arTemplateParameters['LOGO_SOURCE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_SOURCE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'preview' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_SOURCE_PREVIEW'),
            'detail' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_SOURCE_DETAIL')
        ],
        'DEFAULT' => 'preview'
    ];
    $arTemplateParameters['PROPERTY_BACKGROUND'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_PROPERTY_BACKGROUND'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesFile,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
    $arTemplateParameters['PROPERTY_LINK'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_PROPERTY_LINK'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
}

/** VISUAL */
$arTemplateParameters['THEME'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_THEME'),
    'TYPE' => 'LIST',
    'VALUES' => [
        'dark' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_THEME_DARK'),
        'light' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_THEME_LIGHT')
    ],
    'DEFAULT' => 'dark'
];
$arTemplateParameters['LOGO_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['LOGO_SHOW'] == 'Y' && !empty($arCurrentValues['PROPERTY_LINK'])) {
    $arTemplateParameters['LOGO_LINK_USE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_LINK_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['LOGO_LINK_USE'] == 'Y') {
        $arTemplateParameters['LOGO_LINK_BLANK'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_LOGO_LINK_BLANK'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N'
        ];
    }
}

if (!empty($arCurrentValues['PROPERTY_BACKGROUND'])) {
    $arTemplateParameters['BACKGROUND_USE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_BACKGROUND_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['BACKGROUND_USE'] == 'Y') {
        $arTemplateParameters['BACKGROUND_PADDING'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MAIN_SPONSOR_TEMP1_BACKGROUND_PADDING'),
            'TYPE' => 'STRING',
            'DEFAULT' => '50'
        ];
    }
}