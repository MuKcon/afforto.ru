<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { die(); }

$arResult['WIDGET_DATA'] = [
	'api-key' => $arParams['API_KEY'],
	'sender-id' => $arParams['SENDER_ID'],
	'data-url' => $arParams['DATA_URL'],
	'store-id' => $arParams['STORE_ID'],
	'service-type' => $arParams['SERVICE_TYPE'],
	'postal-code' => $arParams['POSTAL_CODE']
];
