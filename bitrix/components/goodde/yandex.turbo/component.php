<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$this->setFrameMode(false);

if (!CModule::IncludeModule('goodde.yandexturbo')) 
{
	ShowError(GetMessage("YA_TURBO_MODULE_NOT_INSTALL"));
	return;
}

if(!CModule::IncludeModule('iblock'))
{
	ShowError(GetMessage("YA_TURBO_IBLOCK_NOT_INSTALL"));
	return;
}

$arIblock = unserialize(COption::GetOptionString('goodde.yandexturbo', "iblock"));
if((!$arParams['IBLOCK_ID']) || (!in_array($arParams['IBLOCK_ID'], $arIblock[$arParams["IBLOCK_TYPE"]]['ID'])))
{
	ShowError(GetMessage("YA_TURBO_IBLOCK_NOT_FOUND"));
	return;
}
unset($arIblock); //was used only for IBLOCK_ID setup with Editor

/*************************************************************************
	Processing of received parameters
*************************************************************************/
CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;

unset($arParams["IBLOCK_TYPE"]); //was used only for IBLOCK_ID setup with Editor
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
$arParams["SECTION_CODE"] = trim($arParams["SECTION_CODE"]);
$arParams["NUM_DAYS"] = intval($arParams["NUM_DAYS"]);
$arParams["NUM_NEWS"] = intval($arParams["NUM_NEWS"]);

if(!array_key_exists("RSS_TTL", $arParams))
	$arParams["RSS_TTL"] = 60;
$arParams["RSS_TTL"] = intval($arParams["RSS_TTL"]);
if(array_key_exists("NUM_RELATED", $arParams))
{
	$arParams['NUM_RELATED'] = intval($arParams['NUM_RELATED']);
}
else
{
	$arParams['NUM_RELATED'] = intval(COption::GetOptionString('goodde.yandexturbo', "RELATED_INFINITY"));	
}
$arParams['SHOW_RELATED'] = COption::GetOptionString('goodde.yandexturbo', "RELATED_INFINITY_SHOW");
$arParams['NUM_RELATED'] = ($arParams['NUM_RELATED'] > 10 ? 10 : $arParams['NUM_RELATED']);
$arParams["CHECK_DATES"] = $arParams["CHECK_DATES"]!="N";
$arParams["GLUE_CONTENT"] = $arParams["GLUE_CONTENT"]==="Y";

if(COption::GetOptionString('goodde.yandexturbo', "ITEM_STATUS", 'N') === 'Y')
	$arParams['ITEM_STATUS'] = 'false';
else
	$arParams['ITEM_STATUS'] = 'true';

$arParams['MENU'] =  CGOODDEYandexTurbo::getMenuString();
if(mb_strlen($arParams['MENU'])<=0)
	$arParams['MENU'] = 'N';

$arParams['SHARE'] = unserialize(COption::GetOptionString('goodde.yandexturbo', "SHARES"));
if(!is_array($arParams['SHARE']))
	$arParams['SHARE'] = array();

$arParams['FORM'] = unserialize(COption::GetOptionString('goodde.yandexturbo', "FORM"));
if(!is_array($arParams['FORM']))
	$arParams['FORM'] = array();

$arParams['FEEDBACK'] = unserialize(COption::GetOptionString('goodde.yandexturbo', "FEEDBACK"));
if(!is_array($arParams['FEEDBACK']))
	$arParams['FEEDBACK'] = array();

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(mb_strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
	$arParams["SORT_ORDER1"]="DESC";

if(mb_strlen($arParams["SORT_BY2"])<=0)
	$arParams["SORT_BY2"] = "SORT";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
	$arParams["SORT_ORDER2"]="ASC";

if(mb_strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}

if(!is_array($arParams["PROPERTY_CODE"]))
	$arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $key=>$val)
	if(!$val==="")
		unset($arParams["PROPERTY_CODE"][$key]);

$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
	$arParams["CACHE_TIME"] = 0;

if($arParams["NUM_NEWS"] > 0)
{
	$arNavParams = array('nPageSize' => $arParams['NUM_NEWS'], 'iNumPage' => intval($_GET['PAGEN_1']));
	$arNavigation = CDBResult::GetNavParams($arNavParams);
}
else
{
	$arNavParams = false;
	$arNavigation = false;
}

$bDesignMode = $APPLICATION->GetShowIncludeAreas() && is_object($USER) && $USER->IsAdmin();

if(!$bDesignMode)
{
	$APPLICATION->RestartBuffer();
	header("Content-Type: application/rss+xml; charset=".LANG_CHARSET);
	header("Pragma: no-cache");
}
else
{
	ob_start();
}
/*************************************************************************
	Start caching
*************************************************************************/

if($this->StartResultCache(false, array($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups(), $arNavigation, $arrFilter)))
{
	$rsResult = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"SITE_ID" => SITE_ID,
		"ID" => $arParams["IBLOCK_ID"],
	));
	$arResult = $rsResult->Fetch();
	if(!$arResult)
	{
		$this->AbortResultCache();
		if($bDesignMode)
		{
			ob_end_flush();
			ShowError(GetMessage('YA_TURBO_IBLOCK_NOT_FOUND'));
			return;
		}
		else
			die();
	}
	else
	{
		foreach($arResult as $k => $v)
		{
			if(mb_substr($k, 0, 1)!=="~")
			{
				$arResult["~".$k] = $v;
				$arResult[$k] = htmlspecialcharsbx($v);
			}
		}
	}
	
	$arResult['ITEM_STATUS'] = $arParams['ITEM_STATUS'];
	$arResult["RSS_TTL"] = $arParams["RSS_TTL"];
	$arResult["SECTION_COUNT"] = 0;
	if($arParams["SECTION_ID"] > 0 || mb_strlen($arParams["SECTION_CODE"]) > 0)
	{
		$arFilter = array(
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_ACTIVE" => "Y",
		);
		if($arParams["SECTION_ID"] > 0)
			$arFilter["ID"] = $arParams["SECTION_ID"];
		elseif(mb_strlen($arParams["SECTION_CODE"]) > 0)
			$arFilter["=CODE"] = $arParams["SECTION_CODE"];

		$rsResult = CIBlockSection::GetList(array(), $arFilter);
		$arResult["SECTION"] = $rsResult->Fetch();
		if(!$arResult["SECTION"])
		{
			$this->AbortResultCache();
			if($bDesignMode)
			{
				ob_end_flush();
				ShowError(GetMessage("YA_TURBO_SECTION_NOT_FOUND"));
				return;
			}
			else
				die();
		}
		else
		{
			foreach($arResult["SECTION"] as $k => $v)
			{
				if(mb_substr($k, 0, 1)!=="~")
				{
					$arResult["SECTION"]["~".$k] = $v;
					$arResult["SECTION"][$k] = htmlspecialcharsbx($v);
				}
			}
		}
		if(mb_strlen($arResult["SECTION"]["DESCRIPTION"])>0)
			$arResult["SECTION"]["DESCRIPTION"] = CGOODDEYandexTurbo::fullTextFormatting($arResult["SECTION"]["DESCRIPTION"]);
	}
	else
	{
		$arFilter = array(
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_ACTIVE" => "Y",
		);
		$arResult["SECTION_COUNT"] = CIBlockSection::GetCount($arFilter);	
	}
	if(mb_strlen($arResult['DESCRIPTION'])>0)
		$arResult['DESCRIPTION'] = CGOODDEYandexTurbo::fullTextFormatting($arResult['DESCRIPTION']);
		
	$arResult['HTTPS'] = (CMain::IsHTTPS()) ? "https://" : "http://";
	if(mb_strlen($arResult["SERVER_NAME"])<=0 && defined("SITE_SERVER_NAME"))
	{
		$arResult["SERVER_NAME"] = SITE_SERVER_NAME;
	}
	if(mb_strlen($arResult["SERVER_NAME"])<=0 && defined("SITE_SERVER_NAME"))
	{
		$b = "sort";
		$o = "asc";
		$rsSite = CSite::GetList($b, $o, array("LID" => $arResult["LID"]));
		if($arSite = $rsSite->Fetch())
			$arResult["SERVER_NAME"] = $arSite["SERVER_NAME"];
	}
	if(mb_strlen($arResult["SERVER_NAME"])<=0)
	{
		$arResult["SERVER_NAME"] = COption::GetOptionString("main", "server_name");
	}
	
	$arResult["PICTURE"] = CFile::GetFileArray($arResult["PICTURE"]);
	$arResult["NODES"] = CIBlockRSS::GetNodeList($arResult["ID"]);

	$arSelect = array(
		"ID",
		"CODE",
		"XML_ID",
		"IBLOCK_ID",
		"NAME",
		"SORT",
		"DETAIL_PAGE_URL",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
		"IBLOCK_SECTION_ID",
		"DATE_ACTIVE_FROM",
		"ACTIVE_FROM",
		"DATE_ACTIVE_TO",
		"ACTIVE_TO",
		"SHOW_COUNTER",
		"SHOW_COUNTER_START",
		"IBLOCK_TYPE_ID",
		"IBLOCK_CODE",
		"IBLOCK_EXTERNAL_ID",
		"DATE_CREATE",
		"CREATED_BY",
		"TIMESTAMP_X",
		"MODIFIED_BY",
	);
	$bGetProperty = count($arParams["PROPERTY_CODE"])>0;
	if($bGetProperty)
		$arSelect[]="PROPERTY_*";
	
	$arFilter = array (
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);

	if($arParams["CHECK_DATES"])
		$arFilter["ACTIVE_DATE"] = "Y";

	if(array_key_exists("SECTION", $arResult))
	{
		$arFilter["SECTION_ID"] = $arResult["SECTION"]["ID"];
		if($arParams["INCLUDE_SUBSECTIONS"] || $arFilter["SECTION_ID"] > 0)
			$arFilter["INCLUDE_SUBSECTIONS"] = "Y";
	}
	else
	{
		$arFilter["IBLOCK_ID"] = $arResult["ID"];
		if($arResult["SECTION_COUNT"] > 0) 
			$arFilter["SECTION_GLOBAL_ACTIVE"] = 'Y';
	}

	if($arParams["NUM_DAYS"] > 0)
		$arFilter["ACTIVE_FROM"] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H"), date("i"), date("s"), date("m"), date("d")-IntVal($arParams["NUM_DAYS"]), date("Y")));

	$arSort = array(
		$arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
		$arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
	);
	if(!array_key_exists("ID", $arSort))
		$arSort["ID"] = "DESC";

	$arResult["ITEMS"]=array();

	CTimeZone::Disable();
	$rsElements = CIBlockElement::GetList($arSort, array_merge($arFilter, $arrFilter), false, $arNavParams, $arSelect);
	CTimeZone::Enable();
	$arProperties = array();
	$rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);
	while($obElement = $rsElements->GetNextElement())
	{
		$arElement = $obElement->GetFields();
		if($bGetProperty)
		$arProperties = $obElement->GetProperties();

		$arNodesElement = array();
		foreach($arElement as $code => $value)
			$arNodesElement["#".$code."#"] = $value;
		$arNodesElement["#PREVIEW_TEXT#"] = CGOODDEYandexTurbo::fullTextFormatting($arNodesElement["#PREVIEW_TEXT#"]);
		$arNodesElement["#DETAIL_TEXT#"] = CGOODDEYandexTurbo::getTheTurboContent($arNodesElement["#DETAIL_TEXT#"]);
		if(is_array($arProperties))
		{
			foreach($arProperties as $code=>$arProperty)
				$arNodesElement["#".$code."#"] = $arProperty["VALUE"];
		}
		$arNodesSearch = array_keys($arNodesElement);
		$arNodesReplace = array_values($arNodesElement);

		$arElement["arr_PREVIEW_PICTURE"] = $arElement["PREVIEW_PICTURE"] = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
		if(is_array($arElement["arr_PREVIEW_PICTURE"]))
			$arElement["PREVIEW_PICTURE"] = CHTTP::URN2URI($arElement["arr_PREVIEW_PICTURE"]["SRC"], $arResult["SERVER_NAME"]);
		$arElement["arr_DETAIL_PICTURE"] = $arElement["DETAIL_PICTURE"] = CFile::GetFileArray($arElement["DETAIL_PICTURE"]);
		if(is_array($arElement["arr_DETAIL_PICTURE"]))
			$arElement["DETAIL_PICTURE"] = CHTTP::URN2URI($arElement["arr_DETAIL_PICTURE"]["SRC"], $arResult["SERVER_NAME"]);

		$ipropValues = new Bitrix\Iblock\InheritedProperty\ElementValues($arElement["IBLOCK_ID"], $arElement["ID"]);
		$arElement['IPROPERTY_VALUES'] = $ipropValues->getValues();
		
		if(mb_strlen($arElement['IPROPERTY_VALUES']['ELEMENT_META_TITLE']) > 0)
		{
			$arItem["title"] = $arElement['IPROPERTY_VALUES']['ELEMENT_META_TITLE'];
		}
		elseif(mb_strlen($arResult["NODES"]["title"]) > 0)
		{
			$arItem["title"] = str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["title"]);
		}
		else
		{
			$arItem["title"] = $arElement["NAME"];
		}
		
		if(mb_strlen($arElement['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) > 0)
		{
			$arItem['page_title'] = $arElement['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'];
		}
		else
		{
			$arItem['page_title'] = $arElement["NAME"];
		}
		
		$arItem["title"] = CGOODDEYandexTurbo::fullTextFormatting($arItem["title"]);
		$arItem['page_title'] = CGOODDEYandexTurbo::fullTextFormatting($arItem['page_title']);

		if(mb_strlen($arResult["NODES"]["link"])>0)
			$arItem["link"] = str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["link"]);
		elseif($arProperties["DOC_LINK"]["VALUE"])
			$arItem["link"] = CHTTP::URN2URI($arProperties["DOC_LINK"]["VALUE"], $arResult["SERVER_NAME"]);
		else
			$arItem["link"] = CHTTP::URN2URI($arElement["DETAIL_PAGE_URL"], $arResult["SERVER_NAME"]);
		
		//correct aspro bug in url
		$arTmpYear = explode(' ', $arElement["ACTIVE_FROM"]);
		$year = explode('.', $arTmpYear[0]);
		$arItem["link"] = str_replace('#YEAR#', $year[2], $arItem["link"]);
		
		if(mb_strlen($arResult["NODES"]["description"])>0)
			$arItem["description"] = str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["description"]);
		else
			$arItem["description"]= $arElement["PREVIEW_TEXT"];
		$arItem["description"]= CGOODDEYandexTurbo::fullTextFormatting($arElement["PREVIEW_TEXT"]);

		if(mb_strlen($arResult["NODES"]["enclosure"])>0)
		{
			$arItem["enclosure"] = array(
				"url" => str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["enclosure"]),
				"length" => str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["enclosure_length"]),
				"type" => str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["enclosure_type"]),
			);
		}
		elseif(is_array($arElement["arr_DETAIL_PICTURE"]))
		{
			$arItem["enclosure"] = array(
				"url" => CHTTP::URN2URI($arElement["arr_DETAIL_PICTURE"]["SRC"], $arResult["SERVER_NAME"]),
				"length" => $arElement["arr_DETAIL_PICTURE"]["FILE_SIZE"],
				"type" => $arElement["arr_DETAIL_PICTURE"]["CONTENT_TYPE"],
			);
		}
		elseif(is_array($arElement["arr_PREVIEW_PICTURE"]))
		{
			$arItem["enclosure"] = array(
				"url" => CHTTP::URN2URI($arElement["arr_PREVIEW_PICTURE"]["SRC"], $arResult["SERVER_NAME"]),
				"length" => $arElement["arr_PREVIEW_PICTURE"]["FILE_SIZE"],
				"type" => $arElement["arr_PREVIEW_PICTURE"]["CONTENT_TYPE"],
			);
		}
		else
		{
			$arItem["enclosure"]=false;
		}

		if(mb_strlen($arResult["NODES"]["category"])>0)
		{
			$arItem["category"] = str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["category"]);
		}
		else
		{
			$arItem["category"] = "";
			$rsNavChain = CIBlockSection::GetNavChain($arResult["ID"], $arElement["IBLOCK_SECTION_ID"]);
			while($arNavChain = $rsNavChain->Fetch())
			{
				$arItem["category"] .= CGOODDEYandexTurbo::fullTextFormatting($arNavChain["NAME"])."/";
			}
		}
		
		$arItem["full-text"] = '';
		if($arParams['GLUE_CONTENT'])
		{
			if($arElement["PREVIEW_TEXT"])
			{
				$arItem["full-text"] .= $arElement["PREVIEW_TEXT"]."\r\n";
			}
			if($arElement["DETAIL_TEXT"])
			{
				$arItem["full-text"] .= $arElement["DETAIL_TEXT"];
			}
		}
		else
		{
			if($arElement["DETAIL_TEXT"])
			{
				$arItem['full-text'] = $arElement["DETAIL_TEXT"];
			}
			elseif($arElement["PREVIEW_TEXT"])
			{
				$arItem['full-text'] = $arElement["PREVIEW_TEXT"];
			}
		}
		$arItem['full-text'] = CGOODDEYandexTurbo::getTheTurboContent($arItem['full-text']);
		
		if(mb_strlen($arResult["NODES"]["pubDate"])>0)
		{
			$arItem["pubDate"] = str_replace($arNodesSearch, $arNodesReplace, $arResult["NODES"]["pubDate"]);
		}
		elseif(mb_strlen($arElement["ACTIVE_FROM"])>0)
		{
			$arItem["pubDate"] = date("r", MkDateTime($DB->FormatDate($arElement["ACTIVE_FROM"], Clang::GetDateFormat("FULL"), "DD.MM.YYYY H:I:S"), "d.m.Y H:i:s"));
		}
		elseif(mb_strlen($arElement["DATE_CREATE"])>0)
		{
			$arItem["pubDate"] = date("r", MkDateTime($DB->FormatDate($arElement["DATE_CREATE"], Clang::GetDateFormat("FULL"), "DD.MM.YYYY H:I:S"), "d.m.Y H:i:s"));
		}
		else
		{
			$arItem["pubDate"] = date("r");
		}

		$arItem["ELEMENT"] = $arElement;
		$arItem["PROPERTIES"] = $arProperties;
		$arResult["ITEMS"][] = $arItem;
		$arResult["ELEMENTS"][] = $arElement["ID"];
	}
	if($arParams['MENU'] !== 'N')
	{
		$arResult['MENU'] = $arParams['MENU'];
		unset($arParams['MENU']);
	}
	if($arParams['SHARE'])
	{
		$arResult['SHARE'] = $arParams['SHARE'];
		unset($arParams['SHARE']);
	}
	
	if($arParams['FEEDBACK'] && isset($arParams['FEEDBACK']['SHOW']))
	{
		if(mb_strlen($arParams['FEEDBACK']['TITLE']) > 0)
			$arResult['FEEDBACK']['TITLE'] = $arParams['FEEDBACK']['TITLE'];
		
		if(mb_strlen($arParams['FORM']['AGREEMENT']['COMPANY']) > 0 && mb_strlen($arParams['FORM']['AGREEMENT']['LINK']) > 0)
		{
			$arResult['FORM'] = array(
				'AGREEMENT_COMPANY' => $arParams['FORM']['AGREEMENT']['COMPANY'],
				'AGREEMENT_LINK' => $arParams['FORM']['AGREEMENT']['LINK'],
			);
		}
		
		if($arParams['FEEDBACK']['TYPE'])
		{
			foreach($arParams['FEEDBACK']['TYPE'] as $key => $arFeedback)
			{
				$arResult['FEEDBACK']['ITEMS'][$arFeedback['STICK']]['TYPE'][$key] = array(
					'TYPE' => $arFeedback['PROVIDER_KEY'],
				);
				switch($arFeedback['PROVIDER_KEY']) 
				{
					case 'mail':
						$arResult['FEEDBACK']['ITEMS'][$arFeedback['STICK']]['TYPE'][$key]['VALUE'] = 'mailto:'.$arFeedback['PROVIDER_VALUE'][$arFeedback['PROVIDER_KEY']];
						break;
					case 'call':
						$arResult['FEEDBACK']['ITEMS'][$arFeedback['STICK']]['TYPE'][$key]['VALUE'] = 'tel:'.$arFeedback['PROVIDER_VALUE'][$arFeedback['PROVIDER_KEY']];
						break;
					case 'chat':
						break;
					default;
						$arResult['FEEDBACK']['ITEMS'][$arFeedback['STICK']]['TYPE'][$key]['VALUE'] = $arFeedback['PROVIDER_VALUE'][$arFeedback['PROVIDER_KEY']];
					break;
				}
			}
		}
		unset($arParams['FEEDBACK']);
	}
	
	if($arParams['SHOW_RELATED'] === 'Y')
	{
		if($arParams['NUM_RELATED'] > 0)
		{
			$count = count($arResult['ITEMS']);
			if($count > 10)
			{
				foreach($arResult['ITEMS'] as $key => $arItems)
				{	
					$arResult['ITEMS'][$key]['INFINITY'] = false;
					if($arRelated = CGOODDEYandexTurbo::arrayNeighbor($count, $key, $arRelated, $arParams['NUM_RELATED']))
					{
						foreach($arRelated as $k => $v)
						{
							$arResult['ITEMS'][$key]['RELATED'][$k] = array(
								'link' => $arResult['ITEMS'][$v]['link'],
								'enclosure' => $arResult['ITEMS'][$v]['enclosure'],
								'title' => $arResult['ITEMS'][$v]['page_title'],
							);
						}
					}
				}
				unset($arRelated);
				unset($count);
			}
		}
	}
	
	if(!$bDesignMode)
	{
		$APPLICATION->RestartBuffer();
	}
	
	$this->setResultCacheKeys(array(
		"ID",
		"IBLOCK_TYPE_ID",
		"NAME",
		"ELEMENTS",
		"SERVER_NAME",
	));
	
	$this->IncludeComponentTemplate();
}

if(!$bDesignMode)
{
	$r = $APPLICATION->EndBufferContentMan();
	echo $r;
	die();
}
else
{
	$contents = ob_get_contents();
	ob_end_clean();
	echo "<pre>",htmlspecialcharsbx($contents),"</pre>";
}
?>