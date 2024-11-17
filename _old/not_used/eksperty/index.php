<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Информация о специалистах на сайте компании afforto.ru. Эксперты и авторы статей.");
$APPLICATION->SetPageProperty("keywords", "Эксперты, Статья, Информация, Новости, Компания");
$APPLICATION->SetPageProperty("title", "Эксперты – информация об авторах статей и специалистах на сайте afforto.ru");
$APPLICATION->SetTitle("Эксперты");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"expert", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "expert",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
		"DETAIL_BACK_SHOW" => "Y",
		"DETAIL_BACK_TEXT" => "Назад к списку",
		"DETAIL_DATE_SHOW" => "Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_IMAGE_SHOW" => "Y",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "",
		"DETAIL_PREVIEW_TEXT_SHOW" => "Y",
		"DETAIL_SOCIAL_SHOW" => "Y",
		"DETAIL_TAG_SHOW" => "no",
		"DETAIL_TWO_COLUMNS" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "56",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_DATE_SHOW" => "N",
		"LIST_DESCRIPTION_SHOW" => "N",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_NEWS_TOP_DATE_SHOW" => "N",
		"LIST_NEWS_TOP_ELEMENTS_COUNT" => "4",
		"LIST_NEWS_TOP_HEADER_SHOW" => "N",
		"LIST_NEWS_TOP_SHOW" => "N",
		"LIST_NEWS_TOP_SHOW_IN" => "list",
		"LIST_NEWS_TOP_TAG_SHOW" => "Y",
		"LIST_SUBSCRIBE_ALLOW_ANONYMOUS" => "N",
		"LIST_SUBSCRIBE_CONSENT" => "/company/consent/",
		"LIST_SUBSCRIBE_HEADER_POSITION" => "center",
		"LIST_SUBSCRIBE_HEADER_SHOW" => "Y",
		"LIST_SUBSCRIBE_HEADER_TEXT" => "Подписывайтесь на новости и акции:",
		"LIST_SUBSCRIBE_RUBRICS" => array(
			0 => "",
			1 => "",
		),
		"LIST_SUBSCRIBE_SHOW" => "N",
		"LIST_SUBSCRIBE_SHOW_IN" => "list",
		"LIST_SUBSCRIBE_TYPE" => "html",
		"LIST_TAG_CLOUD_SHOW" => "N",
		"LIST_TAG_HEADER_SHOW" => "N",
		"LIST_TAG_HEADER_TEXT" => "Популярные теги",
		"LIST_TAG_SHOW" => "N",
		"LIST_TWO_COLUMNS" => "N",
		"LIST_VIEW" => "standard",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Эксперты",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"PROPERTY_TAG" => "SYSTEM_TAGS",
		"SEF_FOLDER" => "/company/eksperty/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "Y",
		"TAG_VARIABLE_NAME" => "tag",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"FILE_404" => "",
		"LIST_PROPERTY_CODE" => array(
			0 => "position",
			1 => "",
		),
		"LIST_GRID" => "4",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "position",
			1 => "education",
			2 => "experience",
			3 => "training",
			4 => "awards",
			5 => "currentwork",
			6 => "",
		),
		"DETAIL_READ_ALSO_SHOW" => "N",
		"DETAIL_SOCIAL_LIST" => array(
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?><?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>