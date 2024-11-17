<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if(!Loader::includeModule('iblock'))
    return;

$arPropertiesText = [];
$arPropertiesFile = [];
$arPropertiesElement = [];

if (!empty($arCurrentValues['IBLOCK_ID'])) {
    /** Список свойств инфоблока */
    $rsProperties = CIBlockProperty::GetList(
        ['SORT' => 'ASC'],
        ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']]
    );

    while ($arProperty = $rsProperties->Fetch()) {
        if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'E') {
            $arPropertiesElement[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
    unset($rsProperties);
}

$arIBlockTypes = [];
$arIBlocks = [];

$arIBlockTypes = CIBlockParameters::GetIBlockTypes();

/** Список инфоблоков */
$rsIBlocks = CIBlock::GetList(array('SORT' => 'ASC'), array('ACTIVE' => 'Y'));

while ($arIBlock = $rsIBlocks->Fetch())
    $arIBlocks[$arIBlock['ID']] = $arIBlock;

/** Фильтр инфоблоков по выбранному типу */
$getIBlocksByType = function ($type = null) use ($arIBlocks) {
    $list = [];

    foreach ($arIBlocks as $iblock) {
        if ($iblock['IBLOCK_TYPE_ID'] == $type || $type == null)
            $list[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];
    }

    return $list;
};

$arVideoCheckbox = [];
$arVideoText = [];

if (!empty($arCurrentValues['PROPERTY_VIDEO']) && !empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
    $rsVideoProperties = CIBlockProperty::GetList(
        ['SORT' => 'ASC'],
        ['IBLOCK_ID' => $arCurrentValues['VIDEO_IBLOCK_ID']]
    );

    while ($arProperty = $rsVideoProperties->Fetch()) {
        if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arVideoText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'C') {
            $arVideoCheckbox[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
        }
    }
}

$arTemplateParameters = [];

/** DATA_SOURCE */
$arTemplateParameters['PROPERTY_POSITION'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_POSITION'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesText,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];
$arTemplateParameters['PROPERTY_SERVICES'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_SERVICES'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesElement,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];

if (!empty($arCurrentValues['PROPERTY_SERVICES'])) {
    $arTemplateParameters['SERVICES_IBLOCK_TYPE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_SERVICES_IBLOCK_TYPE'),
        'TYPE' => 'LIST',
        'VALUES' => $arIBlockTypes,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
    $arTemplateParameters['SERVICES_IBLOCK_ID'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_SERVICES_IBLOCK_ID'),
        'TYPE' => 'LIST',
        'VALUES' => $getIBlocksByType($arCurrentValues['SERVICES_IBLOCK_TYPE']),
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
}

$arTemplateParameters['PROPERTY_PROJECTS'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_PROJECTS'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesElement,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];

if (!empty($arCurrentValues['PROPERTY_PROJECTS'])) {
    $arTemplateParameters['PROJECTS_IBLOCK_TYPE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROJECTS_IBLOCK_TYPE'),
        'TYPE' => 'LIST',
        'VALUES' => $arIBlockTypes,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
    $arTemplateParameters['PROJECTS_IBLOCK_ID'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROJECTS_IBLOCK_ID'),
        'TYPE' => 'LIST',
        'VALUES' => $getIBlocksByType($arCurrentValues['PROJECTS_IBLOCK_TYPE']),
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
}

$arTemplateParameters['PROPERTY_PICTURE'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_PICTURE'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesFile,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];
$arTemplateParameters['PROPERTY_VIDEO'] = [
    'PARENT' => 'DATA_SOURCE',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_VIDEO'),
    'TYPE' => 'LIST',
    'VALUES' => $arPropertiesElement,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
];

if (!empty($arCurrentValues['PROPERTY_VIDEO'])) {
    $arTemplateParameters['VIDEO_IBLOCK_TYPE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_IBLOCK_TYPE'),
        'TYPE' => 'LIST',
        'VALUES' => $arIBlockTypes,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
    $arTemplateParameters['VIDEO_IBLOCK_ID'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_IBLOCK_ID'),
        'TYPE' => 'LIST',
        'VALUES' => $getIBlocksByType($arCurrentValues['VIDEO_IBLOCK_TYPE']),
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];

    if (!empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
        $arTemplateParameters['PROPERTY_VIDEO_URL'] = [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_VIDEO_URL'),
            'TYPE' => 'LIST',
            'VALUES' => $arVideoText,
            'ADDITIONAL_VALUES' => 'Y'
        ];
        $arTemplateParameters['PROPERTY_VIDEO_IMAGE_USE'] = [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROPERTY_VIDEO_IMAGE_USE'),
            'TYPE' => 'LIST',
            'VALUES' => $arVideoCheckbox,
            'ADDITIONAL_VALUES' => 'Y'
        ];
    }
}

/** VISUAL */
if (!empty($arCurrentValues['PROPERTY_POSITION'])) {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_POSITION_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
} else {
    $arTemplateParameters['POSITION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_SIGNATURE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

if (!empty($arCurrentValues['PROPERTY_SERVICES']) && !empty($arCurrentValues['SERVICES_IBLOCK_ID'])) {
    $arTemplateParameters['SERVICES_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_SERVICES_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

if (!empty($arCurrentValues['PROPERTY_PROJECTS']) && !empty($arCurrentValues['PROJECTS_IBLOCK_ID'])) {
    $arTemplateParameters['PROJECTS_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PROJECTS_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

if (!empty($arCurrentValues['PROPERTY_PICTURE'])) {
    $arTemplateParameters['PICTURE_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_PICTURE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

if (!empty($arCurrentValues['PROPERTY_VIDEO']) && !empty($arCurrentValues['VIDEO_IBLOCK_ID']) && !empty($arCurrentValues['PROPERTY_VIDEO_URL'])) {
    $arTemplateParameters['VIDEO_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['VIDEO_SHOW'] == 'Y') {
        $arTemplateParameters['VIDEO_QUALITY'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_QUALITY'),
            'TYPE' => 'LIST',
            'VALUES' => [
                'mqdefault' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_QUALITY_MQ'),
                'hqdefault' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_QUALITY_HQ'),
                'sddefault' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_QUALITY_SD'),
                'maxresdefault' => Loc::getMessage('C_REVIEWS_TEMP8_VIDEO_QUALITY_MAX')
            ],
            'DEFAULT' => 'sddefault'
        ];
    }
}

$arTemplateParameters['FOOTER_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_FOOTER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['FOOTER_SHOW'] == 'Y') {
    $arTemplateParameters['FOOTER_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_FOOTER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_REVIEWS_TEMP8_POSITION_LEFT'),
            'center' => Loc::getMessage('C_REVIEWS_TEMP8_POSITION_CENTER'),
            'right' => Loc::getMessage('C_REVIEWS_TEMP8_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['FOOTER_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_FOOTER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_REVIEWS_TEMP8_FOOTER_TEXT_DEFAULT')
    ];
    $arTemplateParameters['LIST_PAGE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_REVIEWS_TEMP8_LIST_PAGE'),
        'TYPE' => 'STRING'
    ];
}