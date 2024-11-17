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
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_PROPERTY_POSTION'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesText,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];

/** VISUAL */
if (!empty($arCurrentValues['PROPERTY_POSITION'])) {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_POSITION_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
} else {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SIGNATURE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

$arTemplateParameters['TRUNCATE'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_TRUNCATE'),
    'TYPE' => 'STRING',
    'DEFAULT' => 150
];
$arTemplateParameters['SLIDER_DOTS'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_DOTS'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['SLIDER_NAV'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_NAV'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['SLIDER_LOOP'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_LOOP'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['SLIDER_AUTO'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_AUTO'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['SLIDER_AUTO'] == 'Y') {
    $arTemplateParameters['SLIDER_AUTO_TIME'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_AUTO_TIME'),
        'TYPE' => 'STRING',
        'DEFAULT' => '10000'
    ];
    $arTemplateParameters['SLIDER_AUTO_SPEED'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_AUTO_SPEED'),
        'TYPE' => 'STRING',
        'DEFAULT' => '500'
    ];
    $arTemplateParameters['SLIDER_AUTO_PAUSE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_SLIDER_AUTO_PAUSE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

$arTemplateParameters['FOOTER_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_FOOTER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['FOOTER_SHOW'] == 'Y') {
    $arTemplateParameters['FOOTER_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_FOOTER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_REVIEWS_TEMP7_POSITION_LEFT'),
            'center' => Loc::getMessage('C_REVIEWS_TEMP7_POSITION_CENTER'),
            'right' => Loc::getMessage('C_REVIEWS_TEMP7_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['FOOTER_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_FOOTER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_REVIEWS_TEMP7_FOOTER_TEXT_DEFAULT')
    ];
    $arTemplateParameters['LIST_PAGE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP7_LIST_PAGE'),
        'TYPE' => 'STRING'
    ];
}