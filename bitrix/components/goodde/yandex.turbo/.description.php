<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("YA_TURBO_NAME"),
	"DESCRIPTION" => GetMessage("YA_TURBO_DESCRIPTION"),
	"ICON" => "/images/turbo.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "goodde",
		"NAME" => GetMessage("YA_TURBO_RSS"),
		"SORT" => 10,
	),
);
?>