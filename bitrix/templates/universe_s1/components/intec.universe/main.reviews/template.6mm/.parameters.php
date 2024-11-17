<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if(!Loader::includeModule('iblock'))
    return;

$arPropertiesText = [];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    /** Список свойств инфоблока */
    $rsProperties = CIBlockProperty::GetList(
        array(),
        array(
            'IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']
        )
    );

    while ($arProperty = $rsProperties->Fetch()) {
        if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
    unset($rsProperties);
}


$arTemplateParameters = [];

/** DATA_SOURCE */
$arTemplateParameters['PROPERTY_POSITION'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_PROPERTY_POSTION'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesText,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];

/** VISUAL */
$arTemplateParameters['LINE_COUNT'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_LINE_COUNT'),
    'TYPE' => 'LIST',
    'VALUES' => [
        1 => '1',
        2 => '2'
    ],
    'DEFAULT' => 2
];

if (!empty($arCurrentValues['PROPERTY_POSITION'])) {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_POSITION_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
} else {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_SIGNATURE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

$arTemplateParameters['TRUNCATE'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_TRUNCATE'),
    'TYPE' => 'STRING',
    'DEFAULT' => 150
];

$arTemplateParameters['FOOTER_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_FOOTER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['FOOTER_SHOW'] == 'Y') {
    $arTemplateParameters['FOOTER_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_FOOTER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_REVIEWS_TEMP6_POSITION_LEFT'),
            'center' => Loc::getMessage('C_REVIEWS_TEMP6_POSITION_CENTER'),
            'right' => Loc::getMessage('C_REVIEWS_TEMP6_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['FOOTER_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_FOOTER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_REVIEWS_TEMP6_FOOTER_TEXT_DEFAULT')
    ];
    $arTemplateParameters['LIST_PAGE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP6_LIST_PAGE'),
        'TYPE' => 'STRING'
    ];
}