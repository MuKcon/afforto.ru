<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

$arForms = [];
$arTemplates = [];

if ($arCurrentValues['ORDER_CALL_SHOW'] == 'Y') {
    $rsTemplates = [];

    if (Loader::includeModule('form')) {
        include(__DIR__.'/parameters/base.php');
    } elseif (Loader::includeModule('intec.startshop')) {
        include(__DIR__.'/parameters/lite.php');
    } else
        return;

    foreach ($rsTemplates as $arTemplate) {
        $arTemplates[$arTemplate['NAME']] = $arTemplate['NAME'] . (!empty($arTemplate['TEMPLATE']) ? ' (' . $arTemplate['TEMPLATE'] . ')' : null);
    }
}

$arTemplateParameters['WIDTH'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MGV_TEMP1_WIDTH'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
];
$arTemplateParameters['INFO_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MGV_TEMP1_INFO_SHOW'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

$arTemplateParameters['OVERLAY'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_MGV_TEMP1_OVERLAY'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['INFO_SHOW'] == 'Y') {
    $arTemplateParameters['BLOCK_INFO_VIEW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_BLOCK_INFO_VIEW'),
        'TYPE' => 'LIST',
        'VALUES' => [
            'left' => Loc::getMessage('C_MGV_TEMP1_BLOCK_INFO_VIEW_LEFT'),
            'over' => Loc::getMessage('C_MGV_TEMP1_BLOCK_INFO_VIEW_OVER')
        ],
        'DEFAULT' => 'left'
    ];

    $arTemplateParameters['INFO_TITLE'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_INFO_TITLE'),
        'TYPE' => 'STRING',
        'DEFAULT' => Loc::getMessage('C_MGV_TEMP1_INFO_TITLE_DEFAULT')
    ];
    $arTemplateParameters['ADDRESS_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_ADDRESS_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['ADDRESS_SHOW'] == 'Y') {
        $arTemplateParameters['ADDRESS_CITY'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ADDRESS_CITY'),
            'TYPE' => 'STRING'
        ];
        $arTemplateParameters['ADDRESS_STREET'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ADDRESS_STREET'),
            'TYPE' => 'STRING'
        ];
    }

    $arTemplateParameters['PHONE_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_PHONE_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['PHONE_SHOW'] == 'Y') {
        $arTemplateParameters['PHONE_NUMBER'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_PHONE_NUMBER'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y'
        ];
    }

    $arTemplateParameters['ORDER_CALL_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['ORDER_CALL_SHOW'] == 'Y') {
        $arTemplateParameters['ORDER_CALL_FORM'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_FORM'),
            'TYPE' => 'LIST',
            'VALUES' => $arForms,
            'ADDITIONAL_VALUES' => 'Y'
        ];
        $arTemplateParameters['ORDER_CALL_FORM_TEMPLATE'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_FORM_TEMPLATE'),
            'TYPE' => 'LIST',
            'VALUES' => $arTemplates,
            'ADDITIONAL_VALUES' => 'Y',
            'DEFAULT' => '.default'
        ];
        $arTemplateParameters['ORDER_CALL_CONSENT'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_CONSENT'),
            'TYPE' => 'STRING'
        ];
        $arTemplateParameters['ORDER_CALL_TITLE'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_TITLE'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_TITLE_DEFAULT')
        ];
        $arTemplateParameters['ORDER_CALL_TEXT'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_TEXT'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('C_MGV_TEMP1_ORDER_CALL_TITLE_DEFAULT')
        ];
    }

    $arTemplateParameters['EMAIL_SHOW'] = [
        'PARENT' => 'VISUAL',
        'NAME' => Loc::getMessage('C_MGV_TEMP1_EMAIL_SHOW'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y'
    ];

    if ($arCurrentValues['EMAIL_SHOW'] == 'Y') {
        $arTemplateParameters['EMAIL_ADDRESS'] = [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('C_MGV_TEMP1_EMAIL_ADDRESS'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y'
        ];
    }
}