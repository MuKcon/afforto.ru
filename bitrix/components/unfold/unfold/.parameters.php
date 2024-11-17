<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("iblock"))
	return;
$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));
$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPEY"]!="-"?$arCurrentValues["IBLOCK_TYPEY"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

if(isset($arCurrentValues["IBLOCK_IDY"])){
	$arParams = $arCurrentValues["IBLOCK_IDY"];
	$dbResSect = CIBlockSection::GetList(
	   Array("SORT"=>"ASC"),
	   Array("IBLOCK_ID"=>$arParams,"ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", "DEPTH_LEVEL" =>1),
	  false,
	  Array("UF_PRICE")
	);
	while($sectRes = $dbResSect->GetNext())
	{
	 $arSections[$sectRes["ID"]] = $sectRes["NAME"];
	}
}

if(isset($arCurrentValues["RAZDEL"])){
	$arParams = $arCurrentValues["IBLOCK_IDY"];
	$arParamsPod = $arCurrentValues["RAZDEL"];

	$dbResSect1 = CIBlockSection::GetList(
	   Array("SORT"=>"ASC"),
	   Array("IBLOCK_ID"=>$arParams,"ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y", "SECTION_ID"=>$arParamsPod),
	  false,
	  Array("UF_PRICE")
	);
	while($sectRes1 = $dbResSect1->GetNext())
	{
	 $arSectionsPod[$sectRes1["ID"]] = $sectRes1["NAME"];
	}
}


 $arComponentParameters = array(
 	"PARAMETERS" => array(
 		"IBLOCK_TYPEY" => array(
			"PARENT" => "BASE",
			"NAME" => "Тип информационного блока",
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => null,
			"REFRESH" => "Y",
		),
		"IBLOCK_IDY" => array(
			"PARENT" => "BASE",
			"NAME" => "Информационный блок",
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => null,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"RAZDEL" => array(
			"PARENT" => "BASE",
			"NAME" => "Раздел",
			"TYPE" => "LIST",
			"VALUES" =>  $arSections,
			"DEFAULT" => null,
			"ADDITIONAL_VALUES" => "N",
			"MULTIPLE"=>"Y",
			"REFRESH" => "Y",
		),
		"PODRAZDEL" => array(
			"PARENT" => "BASE",
			"NAME" => "Подраздел",
			"TYPE" => "LIST",
			"VALUES" =>  $arSectionsPod,
			"DEFAULT" => null,
			"ADDITIONAL_VALUES" => "N",
			"MULTIPLE"=>"Y",
			"REFRESH" => "Y",
		),
		"HEADER" => array(
			"PARENT" => "BASE",
			"NAME" => "Заголовок",
			"TYPE" => "STRING",
			"VALUES" =>  $header,
			"DEFAULT" => null,
		),
 	)
 )
?>