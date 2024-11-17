<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use intec\core\collections\Arrays;

/**
 * @var array $arCurrentValues
 */

if (!Loader::includeModule('iblock'))
    return;

if (!Loader::includeModule('intec.core'))
    return;

$arPropertiesText = array();
$arPropertiesCheckbox = array();
$arPropertiesFile = array();
$arPropertiesList = array();

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
        } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'C') {
            $arPropertiesCheckbox[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesList[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
}

$arTemplateParameters = array();

/** DATA_SOURCE */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arIBlockTypes = CIBlockParameters::GetIBlockTypes();
    $arIBlocks = Arrays::fromDBResult(CIBlock::GetList([
        'SORT' => 'ASC'
    ], [
        'ACTIVE' => 'Y'
    ]));

    $arBlockProperties = Arrays::from([]);

    if (!empty($arCurrentValues['BLOCKS_IBLOCK_ID']))
        $arBlockProperties = Arrays::fromDBResult(CIBlockProperty::GetList([
            'SORT' => 'ASC'
        ], [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arCurrentValues['BLOCKS_IBLOCK_ID']
        ]));

    $arTemplateParameters = array(
        'BLOCKS_IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_BLOCKS_IBLOCK_TYPE'),
            'TYPE' => 'LIST',
            'VALUES' => $arIBlockTypes,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        ),
        'BLOCKS_IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_BLOCKS_IBLOCK_ID'),
            'TYPE' => 'LIST',
            'VALUES' => $arIBlocks->asArray(function ($sKey, $arIBlock) use (&$arCurrentValues) {
                if (!$arIBlock['TYPE'] != $arCurrentValues['BLOCKS_IBLOCK_TYPE'])
                    return ['skip' => true];

                return [
                    'key' => $arIBlock['ID'],
                    'value' => '['.$arIBlock['ID'].'] '.$arIBlock['NAME']
                ];
            }),
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        ),
        'BLOCKS_COUNT' => array(
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_BLOCKS_COUNT'),
            'TYPE' => 'LIST',
            'VALUES' => array(
                2 => 2,
                3 => 3,
                4 => 4
            )
        ),
        'PROPERTY_HEADER_COLOR' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_HEADER_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_DESCRIPTION_COLOR' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_DESCRIPTION_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_LINK' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_LINK'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_LINK_BLANK' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_LINK_BLANK'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesCheckbox,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_BUTTON_SHOW' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_BUTTON_SHOW'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesCheckbox,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_BUTTON_TEXT' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_BUTTON_TEXT'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_BUTTON_TEXT_COLOR' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_BUTTON_TEXT_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_BUTTON_COLOR' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_BUTTON_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_BANNER_COLOR' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_BANNER_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesList,
            'ADDITIONAL_VALUES' => 'Y'
        ),
        'PROPERTY_VIDEO_URL' => array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_PROPERTY_VIDEO_URL'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesText,
            'ADDITIONAL_VALUES' => 'Y'
        )
    );

    if (!empty($arCurrentValues['BLOCKS_IBLOCK_ID'])) {
        $arTemplateParameters['BLOCKS_PROPERTY_LINK'] = [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_BLOCKS_PROPERTY_LINK'),
            'TYPE' => 'LIST',
            'VALUES' => $arBlockProperties->asArray(function ($sKey, $arProperty) {
                if (empty($arProperty['CODE']))
                    return ['skip' => true];

                if ($arProperty['PROPERTY_TYPE'] != 'S' || $arProperty['MULTIPLE'] == 'Y')
                    return ['skip' => true];

                return [
                    'key' => $arProperty['CODE'],
                    'value' => '['.$arProperty['CODE'].'] '.$arProperty['NAME']
                ];
            }),
            'ADDITIONAL_VALUES' => 'Y'
        ];
        $arTemplateParameters['BLOCKS_PROPERTY_LINK_BLANK'] = [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_BLOCKS_PROPERTY_LINK_BLANK'),
            'TYPE' => 'LIST',
            'VALUES' => $arBlockProperties->asArray(function ($sKey, $arProperty) {
                if (empty($arProperty['CODE']))
                    return ['skip' => true];

                if ((
                    $arProperty['PROPERTY_TYPE'] != 'L' &&
                    $arProperty['LIST_TYPE'] != 'C'
                    ) || $arProperty['MULTIPLE'] == 'Y'
                ) return ['skip' => true];

                return [
                    'key' => $arProperty['CODE'],
                    'value' => '['.$arProperty['CODE'].'] '.$arProperty['NAME']
                ];
            }),
            'ADDITIONAL_VALUES' => 'Y'
        ];
    }
}

/** VISUAL */
$arTemplateParameters['HEIGHT'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_HEIGHT'),
    'TYPE' => 'LIST',
    'VALUES' => array(
        300 => '300px',
        350 => '350px',
        400 => '400px',
        450 => '450px',
        500 => '500px',
        550 => '550px',
        600 => '600px'
    ),
    'DEFAULT' => 500,
    'ADDITIONAL_VALUES' => 'Y'
);

$arTemplateParameters['WIDE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_WIDE'),
    'TYPE' => 'CHECKBOX'
);

if (!empty($arCurrentValues['PROPERTY_VIDEO_URL'])) {
    $arTemplateParameters['VIDEO_SHADOW_USE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_SLIDER_TEMP2_VIDEO_SHADOW_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    );

    if ($arCurrentValues['VIDEO_SHADOW_USE'] == 'Y') {
        $arTemplateParameters['VIDEO_SHADOW_COLOR'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP2_VIDEO_SHADOW_COLOR'),
            'TYPE' => 'LIST',
            'VALUES' => [
                'default' => Loc::getMessage('C_SLIDER_TEMP2_VIDEO_SHADOW_COLOR_DEFAULT'),
                'custom' => Loc::getMessage('C_SLIDER_TEMP2_VIDEO_SHADOW_COLOR_CUSTOM')
            ],
            'REFRESH' => 'Y'
        ];

        if ($arCurrentValues['VIDEO_SHADOW_COLOR'] == 'custom') {
            $arTemplateParameters['VIDEO_SHADOW_COLOR_CUSTOM'] = [
                'PARENT' => 'VISUAL',
                'NAME' => Loc::getMessage('C_SLIDER_TEMP2_VIDEO_SHADOW_COLOR_CUSTOM'),
                'TYPE' => 'STRING'
            ];
        }

        $arTemplateParameters['VIDEO_SHADOW_OPACITY'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_SLIDER_TEMP3_VIDEO_SHADOW_OPACITY'),
            'TYPE' => 'STRING',
            'DEFAULT' => '50'
        ];
    }
}

$arTemplateParameters['SLIDER_DOTS'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_DOTS'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);
$arTemplateParameters['SLIDER_NAV'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_NAV'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['SLIDER_LOOP'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_LOOP'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);
$arTemplateParameters['SLIDER_SPEED'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_SPEED'),
    'TYPE' => 'STRING',
    'DEFAULT' => '500'
);
$arTemplateParameters['SLIDER_AUTO_USE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_AUTO_USE'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);

if ($arCurrentValues['SLIDER_AUTO_USE'] == 'Y') {
    $arTemplateParameters['SLIDER_AUTO_TIME'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_AUTO_TIME'),
        'TYPE' => 'STRING',
        'DEFAULT' => '10000'
    );
    $arTemplateParameters['SLIDER_AUTO_PAUSE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_SLIDER_TEMP2_SLIDER_AUTO_PAUSE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    );
}