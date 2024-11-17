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
$arPropertiesCheckbox = [];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $rsProperties = CIBlockProperty::GetList(
        [], ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']]
    );

    while ($arProperty = $rsProperties->Fetch()) {
        if ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'C') {
            $arPropertiesCheckbox[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
}

$arTemplateParameters = [];

/** DATA_SOURCE */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arTemplateParameters['PICTURE_SOURCE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_PICTURE_SOURCE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'preview' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_SOURCE_PREVIEW'),
            'detail' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_SOURCE_DETAIL')
        ],
        'DEFAULT' => 'parameters'
    ];
    $arTemplateParameters['PROPERTY_BACKGROUND'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_PROPERTY_BACKGROUND'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesFile,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
}

/** VISUAL */
$arTemplateParameters['TEXT_POSITION'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_TEXT_POSITION'),
    'TYPE' => 'LIST',
    'VALUES' => [
        'left' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_LEFT'),
        'center' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_CENTER'),
        'right' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_RIGHT')
    ],
    'DEFAULT' => 'left'
];
$arTemplateParameters['THEME'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_THEME'),
    'TYPE' => 'LIST',
    'VALUES' => [
        'light' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_THEME_LIGHT'),
        'dark' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_THEME_DARK')
    ],
    'DEFAULT' => 'dark'
];
$arTemplateParameters['PICTURE_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_PICTURE_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['BUTTON_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['BUTTON_SHOW'] == 'Y') {
    $arTemplateParameters['BUTTON_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_TEXT_DEFAULT')
    ];
    $arTemplateParameters['BUTTON_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_LEFT'),
            'center' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_CENTER'),
            'right' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_POSITION_RIGHT')
        ],
        'DEFAULT' => 'left'
    ];
    $arTemplateParameters['BUTTON_MODE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_MODE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'link' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_MODE_LINK'),
            'anchor' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_MODE_ANCHOR')
        ],
        'DEFAULT' => 'link'
    ];

     if ($arCurrentValues['BUTTON_MODE'] == 'link') {
         $arTemplateParameters['BUTTON_LINK'] = [
             'PARENT' => 'VISUAL',
             'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_LINK'),
             'TYPE' => 'STRING',
         ];
     } else if ($arCurrentValues['BUTTON_MODE'] == 'anchor') {
         $arTemplateParameters['BUTTON_LINK'] = [
             'PARENT' => 'VISUAL',
             'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BUTTON_ANCHOR'),
             'TYPE' => 'STRING',
         ];
     }
}

if (!empty($arCurrentValues['PROPERTY_BACKGROUND'])) {
    $arTemplateParameters['BACKGROUND_USE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BACKGROUND_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['BACKGROUND_USE'] == 'Y') {
        $arTemplateParameters['BACKGROUND_PADDING'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_BACKGROUND_PADDING'),
            'TYPE' => 'STRING',
            'DEFAULT' => '50'
        ];
    }
}