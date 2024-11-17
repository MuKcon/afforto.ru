<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arListSections = array();
if(isset($arCurrentValues["IBLOCK_ID"]) && intval($arCurrentValues["IBLOCK_ID"])>0)
{
	$arFilter = Array(
		'IBLOCK_ID' => intval($arCurrentValues["IBLOCK_ID"]),
		'GLOBAL_ACTIVE'=>'Y',
		'IBLOCK_ACTIVE'=>'Y',
	);

	$arSec = CIBlockSection::GetList(Array('LEFT_MARGIN'=>'ASC'), $arFilter, false, array("ID", "DEPTH_LEVEL", "NAME"));
	while($arRes = $arSec->Fetch())
		$arListSections[$arRes['ID']] = str_repeat(".", $arRes['DEPTH_LEVEL']).$arRes['NAME'];
}

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arSorts = Array(
	"ASC" => GetMessage("YA_TURBO_SORT_ASC"),
	"DESC" => GetMessage("YA_TURBO_SORT_DESC"),
);

$arSortFields = Array(
		"ID" => GetMessage("YA_TURBO_SORT_ID"),
		"NAME" => GetMessage("YA_TURBO_SORT_NAME"),
		"ACTIVE_FROM" => GetMessage("YA_TURBO_SORT_ACTIVE_FROM"),
		"SORT" => GetMessage("YA_TURBO_SORT_SORT"),
		"TIMESTAMP_X" => GetMessage("YA_TURBO_SORT_TIMESTAMP_X"),
		"CREATED" => GetMessage("YA_TURBO_SORT_CREATED"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		"RSS" => array(
			"NAME" => GetMessage("YA_TURBO_RSS"),
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_IBLOCK_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_SECTION_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arListSections,
			"REFRESH" => "Y",
			"DEFAULT" => "",
		),
		"SECTION_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_SECTION_CODE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
		"NUM_NEWS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("YA_TURBO_NUM_NEWS"),
			"TYPE"=>"STRING",
			"DEFAULT"=>'20',
		),
		"NUM_DAYS" => array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("YA_TURBO_NUM_DAYS"),
			"TYPE"=>"STRING",
			"DEFAULT"=>'30',
		),
		"RSS_TTL" => array(
			"PARENT" => "RSS",
			"NAME"=>GetMessage("YA_TURBO_RSS_TTL"),
			"TYPE"=>"STRING",
			"DEFAULT"=>"60",
		),
		"GLUE_CONTENT" => array(
			"PARENT" => "RSS",
			"NAME"=>GetMessage("YA_TURBO_GLUE_CONTENT"),
			"TYPE"=>"CHECKBOX",
			"DEFAULT"=>"N",
		),
		"SORT_BY1"  =>  Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("YA_TURBO_SORT_BY1"),
			"TYPE" => "LIST",
			"DEFAULT" => "ACTIVE_FROM",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER1"  =>  Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("YA_TURBO_SORT_ORDER1"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_BY2"  =>  Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("YA_TURBO_SORT_BY2"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y",
		),
		"SORT_ORDER2"  =>  Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("YA_TURBO_SORT_ORDER2"),
			"TYPE" => "LIST",
			"DEFAULT" => "ASC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y",
		),
		"FILTER_NAME" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("YA_TURBO_FILTER_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("YA_TURBO_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("YA_TURBO_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
?>
