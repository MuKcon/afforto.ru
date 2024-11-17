<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if (!Loader::includeModule('iblock'))
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

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arTemplateParameters['PROPERTY_POSITION'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_PROPERTY_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y'
    );
}

$arTemplateParameters['POSITION_SHOW'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP3_POSITION_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);
$arTemplateParameters['SLIDER_LOOP'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP3_SLIDER_LOOP'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);
$arTemplateParameters['SLIDER_AUTO_PLAY_USE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP3_SLIDER_AUTO_PLAY_USE'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);

if ($arCurrentValues['SLIDER_AUTO_PLAY_USE'] == 'Y') {
    $arTemplateParameters['SLIDER_AUTO_PLAY_TIME'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_SLIDER_AUTO_PLAY_TIME'),
        'TYPE' => 'STRING',
        'DEFAULT' => '10000'
    );
    $arTemplateParameters['SLIDER_SLIDE_SPEED'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_SLIDER_SLIDE_SPEED'),
        'TYPE' => 'STRING',
        'DEFAULT' => '500'
    );
    $arTemplateParameters['SLIDER_AUTO_PLAY_PAUSE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_SLIDER_AUTO_PLAY_PAUSE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    );
}

$arTemplateParameters['FOOTER_SHOW'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP3_FOOTER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);

if ($arCurrentValues['FOOTER_SHOW'] == 'Y') {
    $arTemplateParameters['FOOTER_POSITION'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_FOOTER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => array(
            'left' => Loc::getMessage('REVIEWS_TEMP3_POSITION_LEFT'),
            'center' => Loc::getMessage('REVIEWS_TEMP3_POSITION_CENTER'),
            'right' => Loc::getMessage('REVIEWS_TEMP3_POSITION_RIGHT')
        ),
        'DEFAULT' => 'center'
    );
    $arTemplateParameters['FOOTER_TEXT'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_FOOTER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('REVIEWS_TEMP3_FOOTER_TEXT_DEFAULT')
    );
    $arTemplateParameters['LIST_PAGE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP3_LIST_PAGE'),
        'TYPE' => 'STRING'
    );
}