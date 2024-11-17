<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if (!Loader::includeModule('iblock'))
    return;

$arPropertiesText = array();
$arPropertiesFile = array();
$arIBlockTypes = array();
$arVideoIBlocks = array();
$arVideoProperties = array();
$arVideoPropertiesText = array();
$arPropertiesCheckbox = array();

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
        } elseif ($arProperty['PROPERTY_TYPE'] == 'E' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }

    /** Список инфоблоков для видео */
    $arIBlockTypes = CIBlockParameters::GetIBlockTypes();

    if (!empty($arCurrentValues['VIDEO_SHOW'] == 'Y' && $arCurrentValues['PROPERTY_VIDEO'])) {
        if (!empty($arCurrentValues['VIDEO_IBLOCK_TYPE'])) {
            $rsVideoIBlocks = CIBlock::GetList(
                array(),
                array(
                    'TYPE' => $arCurrentValues['VIDEO_IBLOCK_TYPE']
                )
            );
        } else {
            $rsVideoIBlocks = CIBlock::GetList();
        }

        while ($arVideoIBlock = $rsVideoIBlocks->Fetch()) {
            $arVideoIBlocks[$arVideoIBlock['ID']] = '[' . $arVideoIBlock['ID'] . '] ' . $arVideoIBlock['NAME'];
        }

        /** Свойства инфоблока "Видео" */
        if (!empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
            $rsVideoProperties = CIBlockProperty::GetList(
                array(),
                array(
                    'IBLOCK_ID' => $arCurrentValues['VIDEO_IBLOCK_ID']
                )
            );

            while ($arVideoProperty = $rsVideoProperties->Fetch()) {
                if ($arVideoProperty['PROPERTY_TYPE'] == 'S' && $arVideoProperty['LIST_TYPE'] == 'L') {
                    $arVideoPropertiesText[$arVideoProperty['CODE']] = '[' . $arVideoProperty['CODE'] . '] ' . $arVideoProperty['NAME'];
                } elseif ($arVideoProperty['PROPERTY_TYPE'] == 'L' && $arVideoProperty['LIST_TYPE'] == 'C') {
                    $arPropertiesCheckbox[$arVideoProperty['CODE']] = '[' . $arVideoProperty['CODE'] . '] ' . $arVideoProperty['NAME'];
                }
            }
        }
    }

}

/** Параметры шаблона */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arTemplateParameters['PROPERTY_POSITION'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_PROPERTY_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y'
    );
    $arTemplateParameters['VIDEO_SHOW'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    );
    if ($arCurrentValues['VIDEO_SHOW'] == 'Y') {
        $arTemplateParameters['PROPERTY_VIDEO'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('REVIEWS_TEMP1_PROPERTY_VIDEO'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesFile,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        );

        if (!empty($arCurrentValues['PROPERTY_VIDEO'])) {
            $arTemplateParameters['VIDEO_IBLOCK_TYPE'] = array(
                'PARENT' => 'DATA_SOURCE',
                'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_IBLOCK_TYPE'),
                'TYPE' => 'LIST',
                'VALUES' => $arIBlockTypes,
                'ADDITIONAL_VALUES' => 'Y',
                'REFRESH' => 'Y'
            );
            $arTemplateParameters['VIDEO_IBLOCK_ID'] = array(
                'PARENT' => 'DATA_SOURCE',
                'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_IBLOCK_ID'),
                'TYPE' => 'LIST',
                'VALUES' => $arVideoIBlocks,
                'ADDITIONAL_VALUES' => 'Y',
                'REFRESH' => 'Y'
            );

            if (!empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
                $arTemplateParameters['VIDEO_IBLOCK_PROPERTY_LINK'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_IBLOCK_PROPERTY_LINK'),
                    'TYPE' => 'LIST',
                    'VALUES' => $arVideoPropertiesText,
                    'ADDITIONAL_VALUES' => 'Y',
                );
                $arTemplateParameters['VIDEO_IBLOCK_PROPERTY_IMAGE_USE'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_IBLOCK_PROPERTY_IMAGE_USE'),
                    'TYPE' => 'LIST',
                    'VALUES' => $arPropertiesCheckbox,
                    'ADDITIONAL_VALUES' => 'Y'
                );
                $arTemplateParameters['VIDEO_IMAGE_QUALITY'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_IMAGE_QUALITY'),
                    'TYPE' => 'LIST',
                    'VALUES' => array(
                        'mqdefault' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_VIDEO_IMAGE_QUALITY_MQ'),
                        'hqdefault' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_VIDEO_IMAGE_QUALITY_HQ'),
                        'sddefault' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_VIDEO_IMAGE_QUALITY_SD'),
                        'maxresdefault' => Loc::getMessage('REVIEWS_TEMP1_VIDEO_VIDEO_IMAGE_QUALITY_MAX')
                    ),
                    'DEFAULT' => 'hqdefault'
                );
            }
        }
    }
}

$arTemplateParameters['LINE_COUNT'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP1_LINE_COUNT'),
    'TYPE' => 'LIST',
    'VALUES' => array(
        1 => '1',
        2 => '2'
    ),
    'DEFAULT' => 1
);
$arTemplateParameters['SLIDER_USE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_USE'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);

if ($arCurrentValues['SLIDER_USE'] == 'Y') {
    $arTemplateParameters['SLIDER_LOOP'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_LOOP'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    );
    $arTemplateParameters['SLIDER_AUTO_PLAY_USE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_AUTO_PLAY_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    );

    if ($arCurrentValues['SLIDER_AUTO_PLAY_USE'] == 'Y') {
        $arTemplateParameters['SLIDER_AUTO_PLAY_TIME'] = array(
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_AUTO_PLAY_TIME'),
            'TYPE' => 'STRING',
            'DEFAULT' => '10000'
        );
        $arTemplateParameters['SLIDER_SLIDE_SPEED'] = array(
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_SLIDE_SPEED'),
            'TYPE' => 'STRING',
            'DEFAULT' => '500'
        );
        $arTemplateParameters['SLIDER_AUTO_PLAY_PAUSE'] = array(
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('REVIEWS_TEMP1_SLIDER_AUTO_PLAY_PAUSE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N'
        );
    }
}

$arTemplateParameters['FOOTER_SHOW'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('REVIEWS_TEMP1_FOOTER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);

if ($arCurrentValues['FOOTER_SHOW'] == 'Y') {
    $arTemplateParameters['FOOTER_POSITION'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_FOOTER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => array(
            'left' => Loc::getMessage('REVIEWS_TEMP1_POSITION_LEFT'),
            'center' => Loc::getMessage('REVIEWS_TEMP1_POSITION_CENTER'),
            'right' => Loc::getMessage('REVIEWS_TEMP1_POSITION_RIGHT')
        ),
        'DEFAULT' => 'center'
    );
    $arTemplateParameters['FOOTER_TEXT'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_FOOTER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('REVIEWS_TEMP1_FOOTER_TEXT_DEFAULT')
    );
    $arTemplateParameters['LIST_PAGE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('REVIEWS_TEMP1_LIST_PAGE'),
        'TYPE' => 'STRING'
    );
}