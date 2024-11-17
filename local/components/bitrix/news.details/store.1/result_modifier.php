<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\RegExp;
use intec\core\helpers\StringHelper;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

$arParams = ArrayHelper::merge([
    'MAP_VENDOR' => 'yandex'
], $arParams);

if ($arParams['SETTINGS_USE'] == 'Y')
    include(__DIR__.'/parts/settings.php');

$arResult['TITLE'] = null;
$arParams['MAP_VENDOR'] = ArrayHelper::fromRange([
    'google',
    'yandex'
], $arParams['MAP_VENDOR']);

$mapId = $arParams['MAP_ID'];
$mapIdLength = StringHelper::length($mapId);
$mapIdExpression = new RegExp('^[A-Za-z_][A-Za-z01-9_]*$');

if ($mapIdLength <= 0 || $mapIdExpression->isMatch($mapId))
    $arParams['MAP_ID'] = 'MAP_'.RandString();


$sPhone = ArrayHelper::getValue($arResult, ['PROPERTIES', $arParams['PROPERTY_PHONE'], 'VALUE']);
$arResult['PHONE']['DISPLAY'] = $sPhone;
$arResult['PHONE']['VALUE'] = StringHelper::replace(
    $sPhone, [
        '-' => '',
        ' ' => '',
        '(' => '',
        ')' => ''
    ]
);

$sAddress = ArrayHelper::getValue($arResult, ['PROPERTIES', $arParams['PROPERTY_ADDRESS'], 'VALUE']);
$arResult['ADDRESS'] = !empty($sAddress) ? $sAddress : null;

$sEmail = ArrayHelper::getValue($arResult,['PROPERTIES', $arParams['PROPERTY_EMAIL'], 'VALUE']);
$arResult['EMAIL'] = !empty($sEmail) ? $sEmail : null;

$sSchedule = ArrayHelper::getValue($arResult, ['PROPERTIES', $arParams['PROPERTY_SCHEDULE'], 'VALUE']);
$arResult['SCHEDULE'] = !empty($sSchedule) ? $sSchedule : null;

if ($bDescriptionShow) {
    $arResult['DESCRIPTION'] = $arResult['PREVIEW_TEXT'];
}


?>