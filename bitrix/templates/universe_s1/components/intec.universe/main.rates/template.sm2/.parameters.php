<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

/**
 * @var array $arCurrentValues
 */

if (!Loader::includeModule('iblock'))
    return;

$iIBlockId = $arCurrentValues['IBLOCK_ID'];

$rsProperties = CIBlockProperty::GetList(
    array('SORT' => 'ASC'),
    array('IBLOCK_ID' => $iIBlockId)
);

$arPropertiesText = [];
$arPropertiesList = [];

while ($arProperty = $rsProperties->Fetch()) {
    if (!empty($arProperty['CODE'])) {
        $sName = '['.$arProperty['CODE'].'] '.$arProperty['NAME'];

        if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesText[$arProperty['CODE']] = $sName;
        } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'L') {
            $arPropertiesList[$arProperty['CODE']] = $sName;
        }
    }
}

/** Получение списка форм и шаблонов для них */
$arForms = [];
$rsTemplates = [];
$arTemplates = [];
$arFormFields = [];

if ($arCurrentValues['BUTTON_SHOW'] == 'Y' && $arCurrentValues['BUTTON_TYPE'] == 'order') {
    if (Loader::includeModule('form')) {
        include('parameters/base.php');
    } elseif (Loader::includeModule('intec.startshop')) {
        include('parameters/lite.php');
    } else {
        return;
    }

    foreach ($rsTemplates as $arTemplate) {
        $arTemplates[$arTemplate['NAME']] = $arTemplate['NAME'] . (!empty($arTemplate['TEMPLATE']) ? ' (' . $arTemplate['TEMPLATE'] . ')' : null);
    }
}


/** DATA_SOURCE */
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arTemplateParameters['PROPERTY_PRICE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_PRICE'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];
    $arTemplateParameters['PROPERTY_CURRENCY'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_CURRENCY'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesList,
        'ADDITIONAL_VALUES' => 'Y'
    ];
    $arTemplateParameters['PROPERTY_DISCOUNT'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_DISCOUNT'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y',
        'REFRESH' => 'Y'
    ];

    if (!empty($arCurrentValues['PROPERTY_DISCOUNT'])) {
        $arTemplateParameters['PROPERTY_DISCOUNT_TYPE'] = [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_DISCOUNT_TYPE'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesList,
            'ADDITIONAL_VALUES' => 'Y'
        ];
    }

    $arTemplateParameters['PROPERTY_DETAIL_URL'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_DETAIL_URL'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y'
    ];
    $arTemplateParameters['PROPERTY_LIST'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_LIST'),
        'TYPE' => 'LIST',
        'VALUES' => array_merge($arPropertiesText, $arPropertiesList),
        'ADDITIONAL_VALUES' => 'Y',
        'MULTIPLE' => 'Y'
    ];
}

/** VISUAL */
$arTemplateParameters['HEADER_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_HEADER_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['HEADER_SHOW'] == 'Y') {
    $arTemplateParameters['HEADER_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_HEADER_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_RATES_TEMP1_POSITION_LEFT'),
            'center' => Loc::getMessage('C_RATES_TEMP1_POSITION_CENTER'),
            'right' => Loc::getMessage('C_RATES_TEMP1_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['HEADER_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_HEADER_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_RATES_TEMP1_HEADER_TEXT_DEFAULT')
    ];
}

$arTemplateParameters['DESCRIPTION_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_DESCRIPTION_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['DESCRIPTION_SHOW'] == 'Y') {
    $arTemplateParameters['DESCRIPTION_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_DESCRIPTION_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => array(
            'left' => Loc::getMessage('C_RATES_TEMP1_POSITION_LEFT'),
            'center' => Loc::getMessage('C_RATES_TEMP1_POSITION_CENTER'),
            'right' => Loc::getMessage('C_RATES_TEMP1_POSITION_RIGHT')
        ),
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['DESCRIPTION_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_DESCRIPTION_TEXT'),
        'TYPE' => 'STRING'
    ];
}

$arTemplateParameters['LINE_COUNT'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_LINE_COUNT'),
    'TYPE' => 'LIST',
    'VALUES' => [
        3 => '3',
        4 => '4'
    ],
    'DEFAULT' => 3
];
$arTemplateParameters['VIEW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_VIEW'),
    'TYPE' => 'LIST',
    'VALUES' => [
        'simple' => Loc::getMessage('C_RATES_TEMP1_VIEW_SIMPLE'),
        'tabs' => Loc::getMessage('C_RATES_TEMP1_VIEW_TABS')
    ],
    'DEFAULT' => 'tabs',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['VIEW'] == 'tabs') {
    $arTemplateParameters['TABS_POSITION'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_TABS_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_RATES_TEMP1_POSITION_LEFT'),
            'center' => Loc::getMessage('C_RATES_TEMP1_POSITION_CENTER'),
            'right' => Loc::getMessage('C_RATES_TEMP1_POSITION_RIGHT')
        ],
        'DEFAULT' => 'center'
    ];
    $arTemplateParameters['SECTION_DESCRIPTION_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SECTION_DESCRIPTION_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['SECTION_DESCRIPTION_SHOW'] == 'Y') {
        $arTemplateParameters['SECTION_DESCRIPTION_POSITION'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_RATES_TEMP1_SECTION_DESCRIPTION_POSITION'),
            'TYPE' => 'LIST',
            'VALUES' => [
                'left' => Loc::getMessage('C_RATES_TEMP1_POSITION_LEFT'),
                'center' => Loc::getMessage('C_RATES_TEMP1_POSITION_CENTER'),
                'right' => Loc::getMessage('C_RATES_TEMP1_POSITION_RIGHT')
            ],
            'DEFAULT' => 'center'
        ];
    }

    $arTemplateParameters['SECTION_MAX_COUNT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SECTION_MAX_COUNT'),
        'TYPE' => 'STRING'
    ];
}

$arTemplateParameters['COUNT_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_COUNT_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['COUNT_SHOW'] == 'Y') {
    $arTemplateParameters['COUNT_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_COUNT_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_RATES_TEMP1_COUNT_TEXT_DEFAULT')
    ];
}

$arTemplateParameters['ELEMENT_DESCRIPTION_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_ELEMENT_DESCRIPTION_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['ELEMENT_DESCRIPTION_SHOW'] == 'Y') {
    $arTemplateParameters['ELEMENT_DESCRIPTION_LENGTH'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_ELEMENT_DESCRIPTION_LENGTH'),
        'TYPE' => 'STRING',
        'DEFAULT' => 250
    ];
}

if (!empty($arCurrentValues['PROPERTY_PRICE'])) {
    $arTemplateParameters['PRICE_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_PRICE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

if ($arCurrentValues['PROPERTY_DISCOUNT']) {
    $arTemplateParameters['DISCOUNT_STICKER_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_DISCOUNT_STICKER_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
}

$arTemplateParameters['PROPERTY_LIST_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_PROPERTY_LIST_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['BUTTON_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['BUTTON_SHOW'] == 'Y') {
    $arTemplateParameters['BUTTON_TEXT'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_TEXT'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_RATES_TEMP1_BUTTON_TEXT_DEFAULT')
    ];
    $arTemplateParameters['BUTTON_TYPE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_TYPE'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'detail' => Loc::getMessage('C_RATES_TEMP1_BUTTON_TYPE_DETAIL'),
            'order' => Loc::getMessage('C_RATES_TEMP1_BUTTON_TYPE_ORDER')
        ],
        'DEFAULT' => 'detail',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['BUTTON_TYPE'] == 'order') {
        $arTemplateParameters['BUTTON_FORM_ID'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_ID'),
            'TYPE' => 'LIST',
            'VALUES' => $arForms,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        ];

        if (!empty($arCurrentValues['BUTTON_FORM_ID'])) {
            $arTemplateParameters['BUTTON_FORM_TEMPLATE'] = [
                'PARENT' => 'VISUAL',
                'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_TEMPLATE'),
                'TYPE' => 'LIST',
                'VALUES' => $arTemplates,
                'DEFAULT' => '.default',
                'ADDITIONAL_VALUES' => 'Y'
            ];
            $arTemplateParameters['BUTTON_FORM_FIELD'] = [
                'PARENT' => 'VISUAL',
                'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_FIELD'),
                'TYPE' => 'LIST',
                'VALUES' => $arFormFields,
                'ADDITIONAL_VALUES' => 'Y'
            ];
            $arTemplateParameters['BUTTON_FORM_TITLE'] = [
                'PARENT' => 'VISUAL',
                'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_TITLE'),
                'TYPE' => 'STRING',
                'DEFAULT' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_TITLE_DEFAULT')
            ];
            $arTemplateParameters['BUTTON_FORM_CONSENT'] = [
                'PARENT' => 'VISUAL',
                'NAME' => Loc::getMessage('C_RATES_TEMP1_BUTTON_FORM_CONSENT'),
                'TYPE' => 'STRING'
            ];
        }
    }
}

$arTemplateParameters['SLIDER_USE'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_USE'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['SLIDER_USE'] == 'Y') {
    $arTemplateParameters['SLIDER_LOOP'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_LOOP'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
    $arTemplateParameters['SLIDER_ARROW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_ARROW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
    $arTemplateParameters['SLIDER_DOTS'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_DOTS'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    ];
    $arTemplateParameters['SLIDER_SPEED'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_SPEED'),
        'TYPE' => 'STRING',
        'DEFAULT' => '500'
    ];
    $arTemplateParameters['SLIDER_AUTO_USE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_AUTO_USE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['SLIDER_AUTO_USE'] == 'Y') {
        $arTemplateParameters['SLIDER_AUTO_TIME'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_AUTO_TIME'),
            'TYPE' => 'STRING',
            'DEFAULT' => '10000'
        ];
        $arTemplateParameters['SLIDER_AUTO_PAUSE'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_RATES_TEMP1_SLIDER_AUTO_PAUSE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N'
        ];
    }
}