<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { die(); }

use Bitrix\Main;

$arResult['WIDGET_DATA'] = [
	'api-key' => $arParams['API_KEY'],
	'sender-id' => $arParams['SENDER_ID'],
	'cart' => Main\Web\Json::encode($arParams['CART']),
	'store-id' => $arParams['STORE_ID'],
	'service-type' => $arParams['SERVICE_TYPE'],
	'log' => $arParams['LOG'],
	'postal-code' => $arParams['POSTAL_CODE'],
	'prop-addressId' => ($arParams['SERVICE_TYPE'] !== 'COURIER') ? $arParams['ORDER_PROP_ADDRESS_ID'] : '',
	'date-deducted' => $arParams['DATE_DEDUCTED'],
];

// region

if ($arParams['REGION_ID'])
{
	$arResult['WIDGET_DATA']['region-id'] = $arParams['REGION_ID'];
}
else if ($arParams['REGION_NAME'])
{
	$arResult['WIDGET_DATA']['region-name'] = $arParams['REGION_NAME'];
}
