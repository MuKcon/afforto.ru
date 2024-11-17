<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Сотрудники');
$APPLICATION->SetPageProperty("title", "Сотрудники – информация компании Afforto");
$APPLICATION->SetPageProperty("description", "Сотрудники. Самые последняя и актуальна информация компании Afforto. Еще больше полезной информации вы сможете найти на страницах нашего сайта.");
?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:news",
    "staff.1",
    array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "50",
        "NEWS_COUNT" => "20",
        "USE_SEARCH" => "N",
        "SETTINGS_USE" => "Y",
        "LAZYLOAD_USE" => "N",
        "FORM_ASK_USE" => "Y",
        "FORM_ASK_TEMPLATE" => ".default",
        "FORM_ASK_ID" => "16",
        "FORM_ASK_FIELD" => "form_textarea_65",
        "FORM_ASK_CONSENT_URL" => "/company/consent/",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_REVIEW" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "PROPERTY_POSITION" => "POSITION",
        "PROPERTY_PHONE" => "PHONE",
        "PROPERTY_EMAIL" => "EMAIL",
        "PROPERTY_SOCIAL_VK" => "VKONTAKTE",
        "PROPERTY_SOCIAL_FB" => "FACEBOOK",
        "PROPERTY_SOCIAL_INST" => "INSTAGRAM",
        "PROPERTY_SOCIAL_TW" => "TWITTER",
        "PROPERTY_SOCIAL_SKYPE" => "SKYPE",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/company/staff/",
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
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_ELEMENT_CHAIN" => "Y",
        "USE_PERMISSIONS" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "LIST_TEMPLATE" => "blocks.1",
        "LIST_SECTIONS_MODE" => "Y",
        "LIST_SECTIONS_ROOT" => "N",
        "LIST_COLUMNS" => "3",
        "LIST_LINK_USE" => "Y",
        "LIST_LINK_BLANK" => "Y",
        "LIST_POSITION_SHOW" => "Y",
        "LIST_PHONE_SHOW" => "Y",
        "LIST_EMAIL_SHOW" => "Y",
        "LIST_SOCIAL_SHOW" => "Y",
        "LIST_SOCIAL_SKYPE_ACTION" => "chat",
        "LIST_FORM_ASK_USE" => "Y",
        "LIST_FORM_ASK_TITLE" => "Задать вопрос",
        "LIST_FORM_ASK_BUTTON_TEXT" => "НАПИСАТЬ СООБЩЕНИЕ",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_TEMPLATE" => "default.1",
        "DETAIL_PICTURE_SHOW" => "Y",
        "DETAIL_NAME_SHOW" => "Y",
        "DETAIL_POSITION_SHOW" => "Y",
        "DETAIL_PHONE_SHOW" => "Y",
        "DETAIL_EMAIL_SHOW" => "Y",
        "DETAIL_SOCIAL_SHOW" => "Y",
        "DETAIL_SOCIAL_SKYPE_ACTION" => "chat",
        "DETAIL_PROPERTY_DESCRIPTION_HEADER" => "DETAIL_HEADER",
        "DETAIL_DESCRIPTION_SHOW" => "Y",
        "DETAIL_FORM_ASK_USE" => "Y",
        "DETAIL_FORM_ASK_TITLE" => "Задать вопрос",
        "DETAIL_FORM_ASK_BUTTON_TEXT" => "НАПИСАТЬ СООБЩЕНИЕ",
        "DETAIL_BUTTON_BACK_SHOW" => "Y",
        "DETAIL_BUTTON_BACK_TEXT" => "К СПИСКУ СОТРУДНИКОВ",
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "DETAIL_DESCRIPTION_HEADER_SHOW" => "Y",
        "LIST_PICTURE_SHOW" => "Y",
        "LIST_PICTURE_VIEW" => "rounded",
        "LIST_PREVIEW_SHOW" => "N",
        "SEF_URL_TEMPLATES" => array(
            "news" => "/company/staff/",
            "section" => "/company/staff/",
            "detail" => "#ELEMENT_ID#/",
        )
    ),
    false
); ?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>