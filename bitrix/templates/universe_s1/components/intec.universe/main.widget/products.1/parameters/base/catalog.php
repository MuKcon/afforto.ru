<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if (!Loader::includeModule('catalog'))
    return;

$arPrices = CCatalogIBlockParameters::getPriceTypesList();
$arTemplateParameters['DISCOUNT_SHOW'] = [
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('C_WIDGET_PRODUCTS_1_DISCOUNT_SHOW'),
    'TYPE' => 'CHECKBOX'
];