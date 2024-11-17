<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Отзывы и рекомендации компании Afforto");
$APPLICATION->SetPageProperty("title", "Отзывы и рекомендации – информация о компании Afforto");
$APPLICATION->SetPageProperty("description", "Отзывы и рекомендации. Самые последняя и актуальна информация компании Afforto. Еще больше полезной информации вы сможете найти на страницах нашего сайта.");
?><?$APPLICATION->IncludeComponent(
	"intec.universe:main.reviews",
	"template.6_n",
	Array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COLUMNS" => "1",
		"DESCRIPTION_SHOW" => "N",
		"DETAIL_URL" => "",
		"ELEMENTS_COUNT" => "",
		"FOOTER_BUTTON_SHOW" => "N",
		"FOOTER_SHOW" => "N",
		"HEADER_SHOW" => "N",
		"IBLOCK_ID" => "16",
		"IBLOCK_TYPE" => "reviews",
		"LAZYLOAD_USE" => "N",
		"LINE_COUNT" => "2",
		"LINK_USE" => "N",
		"LIST_PAGE_URL" => "",
		"ORDER_BY" => "ASC",
		"POSITION_SHOW" => "N",
		"PREVIEW_TRUNCATE_USE" => "N",
		"PROPERTY_POSITION" => "",
		"SECTIONS" => array("",""),
		"SECTIONS_MODE" => "id",
		"SECTION_URL" => "",
		"SEND_USE" => "N",
		"SETTINGS_USE" => "N",
		"SORT_BY" => "SORT",
		"TRUNCATE" => "150"
	)
);?><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>