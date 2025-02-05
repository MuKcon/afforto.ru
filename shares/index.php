<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "акции, скидки, спецпредложения, специальные предложения, распродажа");
$APPLICATION->SetPageProperty("description", "Акции и специальные предложения для клиентов компании Afforto. Здесь Вы найдете все актуальные акции, скидки на различные товары или услуги действующие в нашей компании.");
$APPLICATION->SetPageProperty("title", "Акции и специальные предложения");

$APPLICATION->SetTitle("Акции");

?>
<?php $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"shares.1", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "19",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"SETTINGS_USE" => "Y",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/shares/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "DURATION",
			2 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"LIST_TEMPLATE" => "blocks.1",
		"LIST_PROPERTY_END_TIME" => "ACTION_END",
		"LIST_PROPERTY_DURATION" => "DURATION",
		"LIST_PROPERTY_PERCENT" => "SALE",
		"LIST_LAZYLOAD_USE" => "N",
		"LIST_DATE_SHOW" => "Y",
		"LIST_DATE_TYPE" => "DATE_ACTIVE_FROM",
		"LIST_DATE_FORMAT" => "d.m.Y",
		"LIST_DESCRIPTION_SHOW" => "Y",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"PAGER_TEMPLATE" => "arrows",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"FILE_404" => "/404.php",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "DURATION",
			2 => "PROMO_ELEMENTS",
			3 => "CONDITIONS_ELEMENTS",
			4 => "BANNER_HEADER",
			5 => "BANNER_UPHEADER",
			6 => "BANNER_THEME",
			7 => "VIDEOS_ELEMENTS",
			8 => "ICONS_ELEMENTS",
			9 => "DESCRIPTION_HEADER",
			10 => "ACTION_END",
			11 => "ACTION_START",
			12 => "PHOTO_ELEMENTS",
			13 => "CATALOG_ELEMENTS",
			14 => "SERVICES_ELEMENTS",
			15 => "",
		),
		"DETAIL_TEMPLATE" => "default.2",
		"DETAIL_BANNER_WIDE" => "N",
		"DETAIL_BANNER_HEIGHT" => "400px",
		"DETAIL_DESCRIPTION_PROPERTY_DURATION" => "DURATION",
		"DETAIL_PROMO_PROPERTY_ELEMENTS" => "PROMO_ELEMENTS",
		"DETAIL_PROMO_IBLOCK_TYPE" => "content",
		"DETAIL_PROMO_IBLOCK_ID" => "48",
		"DETAIL_CONDITIONS_PROPERTY_ELEMENTS" => "CONDITIONS_ELEMENTS",
		"DETAIL_CONDITIONS_HEADER" => "Условия акции",
		"DETAIL_CONDITIONS_HEADER_POSITION" => "left",
		"DETAIL_CONDITIONS_IBLOCK_TYPE" => "content",
		"DETAIL_CONDITIONS_IBLOCK_ID" => "20",
		"DETAIL_CONDITIONS_COLUMNS" => "3",
		"DETAIL_FORM_SHOW" => "N",
		"DETAIL_VIDEOS_PROPERTY_ELEMENTS" => "VIDEOS_ELEMENTS",
		"DETAIL_VIDEOS_HEADER" => "Обзоры",
		"DETAIL_VIDEOS_HEADER_POSITION" => "center",
		"DETAIL_VIDEOS_IBLOCK_TYPE" => "content",
		"DETAIL_VIDEOS_IBLOCK_ID" => "25",
		"DETAIL_VIDEOS_COLUMNS" => "3",
		"DETAIL_VIDEOS_PROPERTY_URL" => "LINK",
		"DETAIL_GALLERY_PROPERTY_ELEMENTS" => "PHOTO_ELEMENTS",
		"DETAIL_GALLERY_HEADER" => "Фотографии",
		"DETAIL_GALLERY_HEADER_POSITION" => "center",
		"DETAIL_GALLERY_LINE_COUNT" => "4",
		"DETAIL_GALLERY_WIDE" => "N",
		"DETAIL_SECTIONS_PROPERTY_ELEMENTS" => "CATALOG_SECTIONS",
		"DETAIL_SECTIONS_HEADER" => "Разделы каталога",
		"DETAIL_SECTIONS_HEADER_POSITION" => "center",
		"DETAIL_SECTIONS_IBLOCK_TYPE" => "catalogs",
		"DETAIL_SECTIONS_IBLOCK_ID" => "13",
		"DETAIL_SECTIONS_PROPERTY_SECTIONS" => "CATALOG_SECTIONS",
		"DETAIL_SECTIONS_LINE_COUNT" => "5",
		"DETAIL_SERVICES_PROPERTY_ELEMENTS" => "",
		"DETAIL_SERVICES_SETTINGS_USE" => "N",
		"DETAIL_SERVICES_LAZYLOAD_USE" => "N",
		"DETAIL_SERVICES_HEADER" => "Услуги по акции",
		"DETAIL_SERVICES_HEADER_POSITION" => "left",
		"DETAIL_SERVICES_IBLOCK_TYPE" => "catalogs",
		"DETAIL_SERVICES_IBLOCK_ID" => "17",
		"DETAIL_SERVICES_COLUMNS" => "3",
		"DETAIL_SERVICES_LINK_USE" => "Y",
		"DETAIL_SERVICES_INDENT_IMAGE_USE" => "N",
		"DETAIL_SERVICES_DESCRIPTION_USE" => "Y",
		"DETAIL_SERVICES_FOOTER_SHOW" => "N",
		"DETAIL_PRODUCTS_PROPERTY_ELEMENTS" => "CATALOG_ELEMENTS",
		"DETAIL_PRODUCTS_HEADER" => "Товары по акции",
		"DETAIL_PRODUCTS_HEADER_POSITION" => "left",
		"DETAIL_PRODUCTS_IBLOCK_TYPE" => "content",
		"DETAIL_PRODUCTS_IBLOCK_ID" => "13",
		"DETAIL_PRODUCTS_OFFERS_LIMIT" => "0",
		"DETAIL_PRODUCTS_PRICE_CODE" => array(
		),
		"DETAIL_PRODUCTS_BASKET_URL" => "/personal/basket/",
		"DETAIL_PRODUCTS_HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"DETAIL_PRODUCTS_ACTION" => "none",
		"DETAIL_PRODUCTS_BORDERS" => "Y",
		"DETAIL_PRODUCTS_COLUMNS" => "2",
		"DETAIL_PRODUCTS_COUNTER_SHOW" => "Y",
		"DETAIL_PRODUCTS_OFFERS_USE" => "Y",
		"DETAIL_PRODUCTS_CONSENT_URL" => "/company/consent/",
		"DETAIL_PRODUCTS_LAZY_LOAD" => "N",
		"DETAIL_PRODUCTS_DELAY_USE" => "Y",
		"DETAIL_PRODUCTS_VOTE_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUANTITY_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_USE" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_DETAIL" => "N",
		"DETAIL_PRODUCTS_USE_COMPARE" => "Y",
		"DETAIL_PRODUCTS_COMPARE_NAME" => "compare",
		"DETAIL_PRODUCTS_PROPERTY_ORDER_USE" => "ORDER_USE",
		"DETAIL_PRODUCTS_PROPERTY_MARKS_RECOMMEND" => "RECOMMEND",
		"DETAIL_PRODUCTS_PROPERTY_MARKS_NEW" => "NEW",
		"DETAIL_PRODUCTS_PROPERTY_MARKS_HIT" => "HIT",
		"DETAIL_PRODUCTS_VOTE_MODE" => "rating",
		"DETAIL_PRODUCTS_QUANTITY_MODE" => "number",
		"DETAIL_PRODUCTS_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "OFFERS_SIZE",
			2 => "",
		),
		"DETAIL_PRODUCTS_QUICK_VIEW_TEMPLATE" => "1",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_CODE" => array(
			0 => "",
			1 => "PROPERTY_QUANTITY_OF_STRIPS",
			2 => "PROPERTY_POWER",
			3 => "PROPERTY_YSENSITIVITY",
			4 => "PROPERTY_FREQUENCY_RANGE",
			5 => "PROPERTY_TYPE_SIZE",
			6 => "PROPERTY_PROCREATOR",
			7 => "PROPERTY_FREEZER",
			8 => "PROPERTY_CONTROL",
			9 => "PROPERTY_COMPRESSORS",
			10 => "PROPERTY_DIMENSIONS",
			11 => "PROPERTY_SCOPE",
			12 => "PROPERTY_DISPLAY",
			13 => "PROPERTY_NOISE",
			14 => "PROPERTY_WEIGTH",
			15 => "PROPERTY_TIMER",
			16 => "PROPERTY_VERTEL",
			17 => "PROPERTY_FUNCTIONS",
			18 => "PROPERTY_CLEANING",
			19 => "PROPERTY_ENERGY_CONSUMPTION",
			20 => "PROPERTY_RECIPES",
			21 => "PROPERTY_DEFROSTING",
			22 => "PROPERTY_SPIN",
			23 => "PROPERTY_COFFEE",
			24 => "PROPERTY_COFFEE_MACHINE",
			25 => "PROPERTY_SETTINGS",
			26 => "PROPERTY_DIAGONAL",
			27 => "PROPERTY_RESOLUTION",
			28 => "PROPERTY_LED",
			29 => "PROPERTY_STEREO_SOUND",
			30 => "PROPERTY_ACOUSTICS",
			31 => "PROPERTY_SURROUND_SOUND",
			32 => "PROPERTY_FORMATS",
			33 => "PROPERTY_COMPOSITION",
			34 => "PROPERTY_LENGTH",
			35 => "PROPERTY_SLEEVE",
			36 => "PROPERTY_SEASON",
			37 => "PROPERTY_PATTERN",
			38 => "PROPERTY_CLASP",
			39 => "PROPERTY_TOP_MATERIAL",
			40 => "PROPERTY_INNER_MATERIAL",
			41 => "PROPERTY_BASE_MATERIAL",
			42 => "PROPERTY_MATERIAL_ARTICLE",
			43 => "PROPERTY_HEEL",
			44 => "PROPERTY_ENGINE",
			45 => "PROPERTY_DRYING",
			46 => "PROPERTY_ingredient",
			47 => "PROPERTY_WIDTH",
			48 => "PROPERTY_HEIGHT",
			49 => "PROPERTY_BOTTOM_WIDTH",
			50 => "PROPERTY_HANDLE_LENGTH",
			51 => "PROPERTY_INTERNAL_POCKETS",
			52 => "PROPERTY_LEGS",
			53 => "PROPERTY_EQUIPMENT",
			54 => "PROPERTY_POCKETS",
			55 => "PROPERTY_HOOD",
			56 => "PROPERTY_TYPE",
			57 => "",
		),
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_MARKS_HIT" => "HIT",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_MARKS_NEW" => "NEW",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_MARKS_RECOMMEND" => "RECOMMEND",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_PICTURES" => "IMAGES",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_TEXT" => "",
		"DETAIL_PRODUCTS_QUICK_VIEW_WEIGHT_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_QUANTITY_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_QUANTITY_MODE" => "number",
		"DETAIL_PRODUCTS_QUICK_VIEW_ACTION" => "none",
		"DETAIL_PRODUCTS_QUICK_VIEW_COUNTER_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_DESCRIPTION_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_GALLERY_PANEL" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_GALLERY_PREVIEW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_INFORMATION_PAYMENT" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_INFORMATION_SHIPMENT" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_MARKS_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_DESCRIPTION_MODE" => "preview",
		"DETAIL_PRODUCTS_QUICK_VIEW_PAYMENT_URL" => "/help/buys/payment/",
		"DETAIL_PRODUCTS_QUICK_VIEW_SHIPMENT_URL" => "/help/buys/delivery/",
		"DETAIL_PRODUCTS_FORM_ID" => "1",
		"DETAIL_PRODUCTS_FORM_PROPERTY_PRODUCT" => "form_text_49",
		"DETAIL_PRODUCTS_FORM_TEMPLATE" => "!!",
		"DETAIL_LINKS_BUTTON" => "Посмотреть все акции",
		"DETAIL_LINKS_SOCIAL_SHOW" => "Y",
		"DETAIL_LINKS_HANDLERS" => array(
			0 => "pinterest",
			1 => "gplus",
			2 => "vk",
			3 => "facebook",
			4 => "twitter",
		),
		"DETAIL_LINKS_SHORTEN_URL_LOGIN" => "",
		"DETAIL_LINKS_SHORTEN_URL_KEY" => "",
		"DETAIL_LINKS_TITLE" => "Поделиться",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_LAZYLOAD_USE" => "Y",
		"DETAIL_PRODUCTS_OFFERS_SORT_FIELD" => "shows",
		"DETAIL_PRODUCTS_OFFERS_SORT_ORDER" => "asc",
		"DETAIL_PRODUCTS_QUICK_VIEW_OFFERS_PROPERTY_PICTURES" => "OFFERS_MORE_PHOTO",
		"DETAIL_PRODUCTS_QUICK_VIEW_LAZYLOAD_USE" => "N",
		"DETAIL_FORM_WIDE" => "N",
		"DETAIL_FORM_BORDER_STYLE" => "squared",
		"DETAIL_FORM_FORM_ID" => "1",
		"DETAIL_FORM_FORM_TEMPLATE" => "!!",
		"DETAIL_FORM_TITLE" => "Задать вопрос",
		"DETAIL_FORM_DESCRIPTION" => "Подробно расскажем о наших услугах и товарах, видах и стоимости доставки, подготовим индивидуальное предложение.",
		"DETAIL_FORM_BUTTON_TEXT" => "Задать вопрос",
		"DETAIL_FORM_POPUP_TITLE" => "Задать вопрос",
		"DETAIL_FORM_CONSENT_URL" => "/company/consent/",
		"DETAIL_PRODUCTS_COLUMNS_MOBILE" => "1",
		"DETAIL_PRODUCTS_IMAGE_ASPECT_RATIO" => "1:1",
		"DETAIL_PRODUCTS_RECALCULATION_PRICES_USE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_SLIDE_USE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_ORDER_USE" => "",
		"DETAIL_BANNER_SHOW" => "Y",
		"DETAIL_TIMER_SHOW" => "Y",
		"DETAIL_DESCRIPTION_SHOW" => "Y",
		"DETAIL_ICONS_SHOW" => "Y",
		"DETAIL_CONDITIONS_SHOW" => "Y",
		"DETAIL_FORM_TEMPLATE" => "1",
		"DETAIL_SERVICES_SHOW" => "Y",
		"DETAIL_PRODUCTS_SHOW" => "Y",
		"DETAIL_BANNER_DARK_TEXT" => "BANNER_THEME",
		"DETAIL_BANNER_PROPERTY_DURATION_END" => "ACTION_END",
		"DETAIL_BANNER_SALE" => "PERIOD",
		"DETAIL_BANNER_PROPERTY_TITLE" => "BANNER_HEADER",
		"DETAIL_BANNER_PROPERTY_SUBTITLE" => "BANNER_UPHEADER",
		"DETAIL_TIMER_SECONDS_SHOW" => "Y",
		"DETAIL_TIMER_SALE_SHOW" => "Y",
		"DETAIL_DESCRIPTION_PROPERTY_TITLE" => "DESCRIPTION_HEADER",
		"DETAIL_ICONS_LINK" => "ICONS_ELEMENTS",
		"DETAIL_ICONS_TEMPLATE" => "1",
		"DETAIL_ICONS_IBLOCK_TYPE" => "content",
		"DETAIL_ICONS_IBLOCK_ID" => "1",
		"DETAIL_ICONS_ELEMENTS_COUNT" => "5",
		"DETAIL_ICONS_HEADER_SHOW" => "N",
		"DETAIL_ICONS_HEADER_POSITION" => "center",
		"DETAIL_ICONS_HEADER" => "Преимущества",
		"DETAIL_ICONS_DESCRIPTION_SHOW" => "N",
		"DETAIL_ICONS_SORT_BY" => "SHOWS",
		"DETAIL_ICONS_ORDER_BY" => "ASC",
		"DETAIL_ICONS_TITLE_POSITION" => "top",
		"DETAIL_ICONS_BACKGROUND_SHOW" => "N",
		"DETAIL_ICONS_COLUMNS" => "3",
		"DETAIL_ICONS_NAME_SHOW" => "Y",
		"DETAIL_ICONS_NAME_ALIGN" => "left",
		"DETAIL_ICONS_PICTURE_SHOW" => "Y",
		"DETAIL_ICONS_PICTURE_POSITION" => "left",
		"DETAIL_ICONS_PICTURE_ALIGN" => "left",
		"DETAIL_ICONS_SVG_FILE_USE" => "Y",
		"DETAIL_ICONS_PROPERTY_SVG_FILE" => "ICON",
		"DETAIL_ICONS_PREVIEW_SHOW" => "Y",
		"DETAIL_ICONS_PREVIEW_ALIGN" => "left",
		"DETAIL_CONDITIONS_NUMBER_SHOW" => "Y",
		"DETAIL_CONDITIONS_TEMPLATE" => "1",
		"DETAIL_CONDITIONS_ELEMENTS_COUNT" => "",
		"DETAIL_CONDITIONS_HEADER_SHOW" => "Y",
		"DETAIL_CONDITIONS_DESCRIPTION_SHOW" => "Y",
		"DETAIL_CONDITIONS_SORT_BY" => "SHOWS",
		"DETAIL_CONDITIONS_ORDER_BY" => "ASC",
		"DETAIL_CONDITIONS_BACKGROUND_SHOW" => "N",
		"DETAIL_CONDITIONS_NUMBER_ALIGN" => "left",
		"DETAIL_CONDITIONS_PROPERTY_NUMBER" => "NUMBER",
		"DETAIL_CONDITIONS_PREVIEW_SHOW" => "Y",
		"DETAIL_CONDITIONS_PREVIEW_ALIGN" => "left",
		"DETAIL_SERVICES_WIDE" => "Y",
		"DETAIL_SERVICES_TEMPLATE" => "2",
		"DETAIL_SERVICES_SECTION_ID" => $_REQUEST["SECTION_ID"],
		"DETAIL_SERVICES_SECTION_CODE" => "",
		"DETAIL_SERVICES_SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SERVICES_ELEMENT_SORT_FIELD" => "shows",
		"DETAIL_SERVICES_ELEMENT_SORT_ORDER" => "asc",
		"DETAIL_SERVICES_ELEMENT_SORT_FIELD2" => "shows",
		"DETAIL_SERVICES_ELEMENT_SORT_ORDER2" => "asc",
		"DETAIL_SERVICES_INCLUDE_SUBSECTIONS" => "Y",
		"DETAIL_SERVICES_SHOW_ALL_WO_SECTION" => "Y",
		"DETAIL_SERVICES_SECTION_URL" => "",
		"DETAIL_SERVICES_DETAIL_URL" => "",
		"DETAIL_SERVICES_SECTION_ID_VARIABLE" => "SECTION_ID",
		"DETAIL_SERVICES_PRICE_CODE" => array(
		),
		"DETAIL_SERVICES_USE_PRICE_COUNT" => "Y",
		"DETAIL_SERVICES_SHOW_PRICE_COUNT" => "1",
		"DETAIL_SERVICES_PRICE_VAT_INCLUDE" => "Y",
		"DETAIL_SERVICES_BASKET_URL" => "/personal/basket.php",
		"DETAIL_SERVICES_ACTION_VARIABLE" => "action",
		"DETAIL_SERVICES_PRODUCT_ID_VARIABLE" => "id",
		"DETAIL_SERVICES_USE_PRODUCT_QUANTITY" => "N",
		"DETAIL_SERVICES_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"DETAIL_SERVICES_PRODUCT_PROPS_VARIABLE" => "prop",
		"DETAIL_SERVICES_PAGER_TEMPLATE" => "arrows",
		"DETAIL_SERVICES_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_SERVICES_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_SERVICES_PAGER_TITLE" => "Товары",
		"DETAIL_SERVICES_PAGER_SHOW_ALWAYS" => "N",
		"DETAIL_SERVICES_PAGER_DESC_NUMBERING" => "N",
		"DETAIL_SERVICES_HIDE_NOT_AVAILABLE" => "Y",
		"DETAIL_SERVICES_CONVERT_CURRENCY" => "N",
		"DETAIL_SERVICES_DISPLAY_COMPARE" => "N",
		"DETAIL_PRODUCTS_USE_LIST_URL" => "Y",
		"DETAIL_PRODUCTS_SECTION_URL" => "",
		"DETAIL_PRODUCTS_DETAIL_URL" => "",
		"DETAIL_PRODUCTS_TEMPLATE" => "1",
		"DETAIL_PRODUCTS_SECTION_ID" => $_REQUEST["SECTION_ID"],
		"DETAIL_PRODUCTS_SECTION_CODE" => "",
		"DETAIL_PRODUCTS_SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PRODUCTS_ELEMENT_SORT_FIELD" => "shows",
		"DETAIL_PRODUCTS_ELEMENT_SORT_ORDER" => "asc",
		"DETAIL_PRODUCTS_ELEMENT_SORT_FIELD2" => "shows",
		"DETAIL_PRODUCTS_ELEMENT_SORT_ORDER2" => "asc",
		"DETAIL_PRODUCTS_INCLUDE_SUBSECTIONS" => "Y",
		"DETAIL_PRODUCTS_SHOW_ALL_WO_SECTION" => "N",
		"DETAIL_PRODUCTS_SECTION_ID_VARIABLE" => "SECTION_ID",
		"DETAIL_PRODUCTS_PAGE_ELEMENT_COUNT" => "18",
		"DETAIL_PRODUCTS_USE_PRICE_COUNT" => "N",
		"DETAIL_PRODUCTS_SHOW_PRICE_COUNT" => "1",
		"DETAIL_PRODUCTS_PRICE_VAT_INCLUDE" => "Y",
		"DETAIL_PRODUCTS_ACTION_VARIABLE" => "action",
		"DETAIL_PRODUCTS_PRODUCT_ID_VARIABLE" => "id",
		"DETAIL_PRODUCTS_USE_PRODUCT_QUANTITY" => "N",
		"DETAIL_PRODUCTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"DETAIL_PRODUCTS_ADD_PROPERTIES_TO_BASKET" => "Y",
		"DETAIL_PRODUCTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"DETAIL_PRODUCTS_PARTIAL_PRODUCT_PROPERTIES" => "N",
		"DETAIL_PRODUCTS_PAGER_TEMPLATE" => "arrows",
		"DETAIL_PRODUCTS_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_PRODUCTS_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PRODUCTS_PAGER_TITLE" => "Товары",
		"DETAIL_PRODUCTS_PAGER_SHOW_ALWAYS" => "N",
		"DETAIL_PRODUCTS_PAGER_DESC_NUMBERING" => "N",
		"DETAIL_PRODUCTS_HIDE_NOT_AVAILABLE" => "Y",
		"DETAIL_PRODUCTS_CONVERT_CURRENCY" => "N",
		"DETAIL_PRODUCTS_DISPLAY_COMPARE" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_ADDITIONAL_PRODUCTS" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIME_ZERO_HIDE" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_MODE" => "discount",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_ELEMENT_ID_INTRODUCE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_SECONDS_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_QUANTITY_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_QUANTITY_ENTER_VALUE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_PRODUCT_UNITS_USE" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_QUANTITY_HEADER_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_HEADER_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_HEADER" => "До конца акции",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_SETTINGS_USE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_LAZYLOAD_USE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_QUANTITY_OVER" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_TITLE_SHOW" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_TIMER_TIMER_QUANTITY_HEADER" => "Остаток",
		"DETAIL_PRODUCTS_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PRODUCTS_OFFERS_SORT_FIELD2" => "shows",
		"DETAIL_PRODUCTS_OFFERS_SORT_ORDER2" => "asc",
		"DETAIL_PRODUCTS_QUICK_VIEW_OFFERS_PROPERTY_PICTURE_DIRECTORY" => "OFFERS_COLORS",
		"DETAIL_PRODUCTS_QUICK_VIEW_OFFERS_VARIABLE_SELECT" => "offer",
		"DETAIL_ICONS_MOBILE_COLUMNS" => "1",
		"DETAIL_PRODUCTS_COUNTER_MESSAGE_MAX_SHOW" => "Y",
		"DETAIL_PRODUCTS_SECTION_TIMER_SHOW" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_COUNTER_MESSAGE_MAX_SHOW" => "Y",
		"DETAIL_CONDITIONS_DESCRIPTION_POSITION" => "center",
		"DETAIL_CONDITIONS_DESCRIPTION" => "Условия акции",
		"DETAIL_PRODUCTS_PROPERTY_PICTURES" => "",
		"DETAIL_PRODUCTS_OFFERS_PROPERTY_PICTURES" => "OFFERS_MORE_PHOTO",
		"DETAIL_PRODUCTS_BORDERS_STYLE" => "squared",
		"DETAIL_PRODUCTS_MARKS_SHOW" => "Y",
		"DETAIL_PRODUCTS_NAME_POSITION" => "middle",
		"DETAIL_PRODUCTS_NAME_ALIGN" => "left",
		"DETAIL_PRODUCTS_PRICE_ALIGN" => "left",
		"DETAIL_PRODUCTS_OFFERS_ALIGN" => "start",
		"DETAIL_PRODUCTS_OFFERS_VIEW" => "default",
		"DETAIL_PRODUCTS_OFFERS_PROPERTY_PICTURE_DIRECTORY" => "OFFERS_COLORS",
		"DETAIL_PRODUCTS_VOTE_ALIGN" => "left",
		"DETAIL_PRODUCTS_QUANTITY_ALIGN" => "left",
		"DETAIL_PRODUCTS_PURCHASE_BASKET_BUTTON_TEXT" => "В корзину",
		"DETAIL_PRODUCTS_PURCHASE_ORDER_BUTTON_TEXT" => "Заказать",
		"DETAIL_PRODUCTS_WEIGHT_SHOW" => "N",
		"DETAIL_PRODUCTS_DESCRIPTION_SHOW" => "N",
		"DETAIL_PRODUCTS_DESCRIPTION_ALIGN" => "left",
		"DETAIL_PRODUCTS_PROPERTY_ARTICLE" => "ARTICLE",
		"DETAIL_PRODUCTS_OFFERS_PROPERTY_ARTICLE" => "OFFERS_SYSTEM_ARTICLE",
		"DETAIL_PRODUCTS_ARTICLE_SHOW" => "Y",
		"DETAIL_PRODUCTS_MEASURE_SHOW" => "Y",
		"DETAIL_PRODUCTS_ORDER_FAST_USE" => "Y",
		"DETAIL_PRODUCTS_LIST_URL" => "",
		"DETAIL_PRODUCTS_LIST_URL_POSITION" => "left",
		"DETAIL_PRODUCTS_MARKS_ORIENTATION" => "horizontal",
		"DETAIL_PRODUCTS_QUICK_VIEW_DELAY_USE" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_MARKS_ORIENTATION" => "horizontal",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTIES_SHOW" => "Y",
		"DETAIL_PRODUCTS_QUICK_VIEW_DETAIL_SHOW" => "Y",
		"DETAIL_CONDITIONS_SETTINGS_USE" => "N",
		"DETAIL_CONDITIONS_LAZYLOAD_USE" => "N",
		"DETAIL_CONDITIONS_LINK_USE" => "N",
		"DETAIL_CONDITIONS_SLIDER_NAV" => "N",
		"DETAIL_CONDITIONS_SLIDER_LOOP" => "N",
		"DETAIL_CONDITIONS_SLIDER_AUTOPLAY" => "N",
		"DETAIL_CONDITIONS_PICTURE_SHOW" => "N",
		"DETAIL_CONDITIONS_BUTTON_SHOW" => "N",
		"DETAIL_CONDITIONS_PROPERTY_MAX_NUMBER" => "",
		"DETAIL_CONDITIONS_ELEMENTS_ROW_COUNT" => "2",
		"DETAIL_CONDITIONS_LINE_COUNT" => "4",
		"DETAIL_CONDITIONS_VIEW" => "number",
		"DETAIL_CONDITIONS_BACKGROUND_SIZE" => "cover",
		"DETAIL_CONDITIONS_ARROW_SHOW" => "N",
		"DETAIL_CONDITIONS_INDENT_USE" => "N",
		"DETAIL_CONDITIONS_THEME" => "white",
		"DETAIL_CONDITIONS_ICON_SHOW" => "N",
		"DETAIL_CONDITIONS_BACKGROUND_USE" => "N",
		"DETAIL_CONDITIONS_ALIGNMENT" => "center",
		"DETAIL_CONDITIONS_NAME_SHOW" => "Y",
		"DETAIL_CONDITIONS_BORDER_SHOW" => "N",
		"DETAIL_CONDITIONS_SVG_USE" => "N",
		"DETAIL_CONDITIONS_BACKGROUND_PATH" => "",
		"DETAIL_CONDITIONS_PICTURE_SIZE" => "60",
		"DETAIL_CONDITIONS_NAME_SIZE" => "middle",
		"DETAIL_CONDITIONS_NAME_MARGIN" => "middle",
		"DETAIL_CONDITIONS_ELEMENT_MARGIN" => "middle",
		"DETAIL_CONDITIONS_PICTURE_POSITION" => "top",
		"DETAIL_CONDITIONS_HIDE" => "N",
		"DETAIL_CONDITIONS_PROPERTY_CATEGORY" => "",
		"DETAIL_CONDITIONS_PROPERTY_PICTURES" => "",
		"DETAIL_CONDITIONS_PROPERTY_PICTURES_TEXT" => "",
		"DETAIL_CONDITIONS_HIDING_USE" => "N",
		"DETAIL_CONDITIONS_PROPERTY_NAME" => "",
		"DETAIL_CONDITIONS_PROPERTY_IMAGES" => "",
		"DETAIL_CONDITIONS_PROPERTY_TEXT_ADDITIONAL" => "",
		"DETAIL_CONDITIONS_PROPERTY_THEME" => "",
		"DETAIL_CONDITIONS_PROPERTY_VIEW" => "",
		"DETAIL_CONDITIONS_PROPERTY_DETAIL_NARROW" => "",
		"DETAIL_CONDITIONS_BUTTON_TEXT" => "Подробнее",
		"DETAIL_CONDITIONS_TITLE_POSITION" => "top",
		"DETAIL_CONDITIONS_MOBILE_COLUMNS" => "2",
		"DETAIL_CONDITIONS_NAME_ALIGN" => "left",
		"DETAIL_CONDITIONS_COLUMNS_MOBILE" => "1",
		"DETAIL_PRODUCTS_IMAGE_SLIDER_SHOW" => "Y",
		"DETAIL_PRODUCTS_ORDER_FAST_TEMPLATE" => ".default",
		"DETAIL_PRODUCTS_ORDER_FAST_AJAX_MODE" => "N",
		"DETAIL_PRODUCTS_ORDER_FAST_VARIABLES_ACTION" => "action",
		"DETAIL_PRODUCTS_ORDER_FAST_VARIABLES_VALUES" => "values",
		"DETAIL_PRODUCTS_ORDER_FAST_CURRENCY" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_DELIVERY" => "1",
		"DETAIL_PRODUCTS_ORDER_FAST_PAYMENT" => "1",
		"DETAIL_PRODUCTS_ORDER_FAST_PERSON" => "1",
		"DETAIL_PRODUCTS_ORDER_FAST_FIELDS_COMMENT_USE" => "Y",
		"DETAIL_PRODUCTS_ORDER_FAST_SETTINGS_USE" => "N",
		"DETAIL_PRODUCTS_ORDER_FAST_LAZYLOAD_USE" => "N",
		"DETAIL_PRODUCTS_ORDER_FAST_CONSENT_SHOW" => "Y",
		"DETAIL_PRODUCTS_ORDER_FAST_CONSENT_URL" => "/company/consent/",
		"DETAIL_PRODUCTS_ORDER_FAST_MESSAGES_TITLE" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_MESSAGES_ORDER" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_MESSAGES_BUTTON" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_PROPERTY_ARTICLE" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_OFFERS_PROPERTY_ARTICLE" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_AJAX_OPTION_JUMP" => "N",
		"DETAIL_PRODUCTS_ORDER_FAST_AJAX_OPTION_STYLE" => "Y",
		"DETAIL_PRODUCTS_ORDER_FAST_AJAX_OPTION_HISTORY" => "N",
		"DETAIL_PRODUCTS_ORDER_FAST_AJAX_OPTION_ADDITIONAL" => "",
		"DETAIL_PRODUCTS_COMPARE_PATH" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_PROPERTIES" => "",
		"DETAIL_PRODUCTS_IMAGE_SLIDER_NAV_SHOW" => "N",
		"DETAIL_PRODUCTS_IMAGE_SLIDER_OVERLAY_USE" => "Y",
		"PROPERTY_DATE_END" => "ACTION_END",
		"PROPERTY_DISCOUNT" => "PERIOD",
		"PROPERTY_DURATION" => "DURATION",
		"LIST_IBLOCK_DESCRIPTION_SHOW" => "Y",
		"LIST_ELEMENT_AS_LINK" => "Y",
		"LIST_DURATION_SHOW" => "Y",
		"DETAIL_ICONS_LINK_PROPERTY_USE" => "N",
		"DETAIL_PRODUCTS_USE_COMPARE_LIST" => "N",
		"DETAIL_PRODUCTS_PROPERTY_OLD_PRICE_BASE" => "",
		"DETAIL_PRODUCTS_PROPERTY_REQUEST_USE" => "",
		"DETAIL_PRODUCTS_PRICE_DISCOUNT_PERCENT" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_REQUEST_USE" => "",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_ADDITIONAL" => "",
		"DETAIL_PRODUCTS_ORDER_FAST_STATUS" => "1",
		"DETAIL_PRODUCTS_PURCHASE_REQUEST_BUTTON_TEXT" => "Уточнить цену",
		"LIST_DISCOUNT_SHOW" => "Y",
		"LIST_TIMER_SHOW" => "Y",
		"COMPONENT_TEMPLATE" => "shares.1",
		"PROPERTY_LIST_TEMPLATE" => "settings",
		"HEAD_PICTURE_TYPE" => "NOT_FULL_PICTURE",
		"PROPERTY_DETAIL_TEMPLATE" => "extended",
		"PROPERTY_BASKET_URL" => "/personal/basket/",
		"PROPERTY_PRICE_CODE_SALE" => array(
			0 => "BASE",
		),
		"IBLOCK_TYPE_FOR_SALE" => "catalogs",
		"IBLOCK_TYPE_ID_SALE" => "13",
		"TYPE_OF_BLOCK_FOR_CONDITIONS" => "content",
		"ID_OF_BLOCK_FOR_CONDITIONS" => "20",
		"PROPERTY_IBLOCK_TYPE_ICONS" => "content",
		"PROPERTY_IBLOCK_ID_ICONS" => "21",
		"PROPERTY_IBLOCK_TYPE_PROMO" => "",
		"PROPERTY_IBLOCK_ID_PROMO" => "",
		"PROPERTY_IBLOCK_TYPE_TEASER" => "",
		"PROPERTY_IBLOCK_ID_TEASER" => "",
		"PROPERTY_IBLOCK_TYPE_OVERVIEWS" => "",
		"PROPERTY_IBLOCK_ID_OVERVIEWS" => "",
		"PROPERTY_IBLOCK_TYPE_PHOTO" => "",
		"PROPERTY_IBLOCK_ID_PHOTO" => "",
		"PROPERTY_IBLOCK_TYPE_SECTION" => "",
		"PROPERTY_IBLOCK_ID_SECTION" => "",
		"PROPERTY_IBLOCK_TYPE_SERVICES" => "",
		"ORDER_PRODUCT_WEB_FORM" => "1",
		"PROPERTY_FORM_ORDER_PRODUCT" => "",
		"PROPERTY_FOR_PERIOD" => "",
		"PROPERTY_FOR_SALE_PERCENT" => "",
		"PROPERTY_RECOMENDATIONS" => "CONDITION",
		"PROPERTY_OF_BLOCK_FOR_CONDITIONS" => "CONDITION",
		"PROPERTY_FOR_ICONS" => "",
		"PROPERTY_FOR_PROMO" => "",
		"PROPERTY_FOR_TEASER" => "",
		"PROPERTY_TEASER_HEADER" => "",
		"PROPERTY_FOR_OVERVIEWS" => "",
		"PROPERTY_OVERVIEWS_LINK" => "",
		"PROPERTY_FOR_PHOTO" => "",
		"PROPERTY_FOR_SECTION" => "",
		"PROPERTY_SECTION_HEADER" => "",
		"PROPERTY_FOR_SERVICES" => "",
		"PROPERTY_IBLOCK_ID_SERVICES" => "",
		"USE_BASKET" => "settings",
		"PROPERTY_SHOW_FORM" => "N",
		"USE_SHARE" => "N",
		"LIST_TIMER_TIMER_SECONDS_SHOW" => "N",
		"DETAIL_ICONS_LINK_USE" => "N",
		"DETAIL_PRODUCTS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PRODUCTS_PRODUCT_PROPERTIES" => array(
		),
		"DETAIL_PRODUCTS_OFFERS_CART_PROPERTIES" => array(
		),
		"DETAIL_PRODUCTS_PROPERTY_MARKS_SHARE" => "",
		"DETAIL_PRODUCTS_MEASURES_USE" => "N",
		"DETAIL_PRODUCTS_QUICK_VIEW_PROPERTY_MARKS_SHARE" => "",
		"DETAIL_PRODUCTS_QUICK_VIEW_MEASURE_SHOW" => "N",
		"DETAIL_FORM_FORM_TITLE" => "",
		"DETAIL_FORM_SETTINGS_USE" => "N",
		"DETAIL_FORM_CONSENT_SHOW" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"LIST_TIMER_COMPOSITE_FRAME_MODE" => "A",
		"LIST_TIMER_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_ICONS_COMPOSITE_FRAME_MODE" => "A",
		"DETAIL_ICONS_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_CONDITIONS_COMPOSITE_FRAME_MODE" => "A",
		"DETAIL_CONDITIONS_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_FORM_COMPOSITE_FRAME_MODE" => "A",
		"DETAIL_FORM_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_PRODUCTS_ORDER_FAST_COMPOSITE_FRAME_MODE" => "A",
		"DETAIL_PRODUCTS_ORDER_FAST_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_PRODUCTS_COMPOSITE_FRAME_MODE" => "A",
		"DETAIL_PRODUCTS_COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_FORM_WEB_FORM_ID" => "",
		"DETAIL_FORM_LAZYLOAD_USE" => "N",
		"DETAIL_FORM_WEB_FORM_TITLE_SHOW" => "N",
		"DETAIL_FORM_WEB_FORM_DESCRIPTION_SHOW" => "N",
		"DETAIL_FORM_WEB_FORM_BACKGROUND" => "theme",
		"DETAIL_FORM_WEB_FORM_BACKGROUND_OPACITY" => "",
		"DETAIL_FORM_WEB_FORM_TEXT_COLOR" => "light",
		"DETAIL_FORM_WEB_FORM_POSITION" => "left",
		"DETAIL_FORM_WEB_FORM_ADDITIONAL_PICTURE_SHOW" => "N",
		"DETAIL_FORM_BLOCK_BACKGROUND" => "#TEMPLATE_PATH#/images/bg.jpg",
		"DETAIL_FORM_BLOCK_BACKGROUND_PARALLAX_USE" => "N",
		"LAZYLOAD_USE" => "N",
		"MAP_VENDOR" => "google",
		"SOCIAL_SERVICES_VK" => "",
		"SOCIAL_SERVICES_FACEBOOK" => "",
		"SOCIAL_SERVICES_INSTAGRAM" => "",
		"SOCIAL_SERVICES_TWITTER" => "",
		"SOCIAL_SERVICES_SKYPE" => "",
		"SOCIAL_SERVICES_YOUTUBE" => "",
		"SOCIAL_SERVICES_OK" => "",
		"FORM_ID" => "",
		"MAP_SHOW" => "N",
		"NUM_NEWS" => "",
		"NUM_DAYS" => "",
		"YANDEX" => "",
		"MAX_VOTE" => "",
		"VOTE_NAMES" => "",
		"CATEGORY_IBLOCK" => "",
		"CATEGORY_CODE" => "",
		"CATEGORY_ITEMS_COUNT" => "",
		"MESSAGES_PER_PAGE" => "",
		"USE_CAPTCHA" => "",
		"REVIEW_AJAX_POST" => "",
		"PATH_TO_SMILE" => "",
		"FORUM_ID" => "",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => "",
		"FILTER_PROPERTY_CODE" => "",
		"LIST_CONTACTS_TEMPLATE" => "1",
		"LIST_STORES_TEMPLATE" => "default.1",
		"DETAIL_CONTACT_TEMPLATE" => "1",
		"DETAIL_STORE_TEMPLATE" => "default.1",
		"LIST_TIMER_SALE_SHOW" => "N",
		"DETAIL_ICONS_ELEMENTS_ROW_COUNT" => "4",
		"DETAIL_CONDITIONS_LINK_PROPERTY_USE" => "Y",
		"DETAIL_CONDITIONS_LINK_PROPERTY" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
); ?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>