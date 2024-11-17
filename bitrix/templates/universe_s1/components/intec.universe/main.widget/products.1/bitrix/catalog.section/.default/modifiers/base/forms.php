<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\ArrayHelper;

$arParams = ArrayHelper::merge([
    'FORM_ID' => null,
    'FORM_PROPERTY_PRODUCT' => null
], $arParams);

$arResult['FORM'] = [
    'SHOW' => $arResult['ACTION'] === 'order',
    'ID' => $arParams['FORM_ID'],
    'PROPERTIES' => [
        'PRODUCT' => $arParams['FORM_PROPERTY_PRODUCT']
    ]
];

if (empty($arResult['FORM']['ID']))
    $arResult['FORM']['SHOW'] = false;