<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 */

$this->setFrameMode(true);

if (!CModule::IncludeModule('intec.core'))
    return;

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    array(
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'NEWS_COUNT' => $arParams['ITEMS_LIMIT'],
        'SORT_BY1' => 'ACTIVE_FROM',
        'SORT_ORDER1' => 'DESC',
        'SORT_BY2' => 'SORT',
        'SORT_ORDER2' => 'ASC',
        'FILTER_NAME' => $arParams['FILTER_NAME'],
        'FIELD_CODE' => array(),
        'PROPERTY_CODE' => array(
            $arParams['PROPERTY_DOCUMENT'],$arParams['PROPERTY_VIDEO']
        ),
        'CHECK_DATES' => 'Y',
        'VIEW_DESKTOP' => $arParams['VIEW_DESKTOP'],
        'VIEW_MOBILE' => $arParams['VIEW_MOBILE'],
        'DETAIL_URL' => $arParams['DETAIL_URL'],
        'AJAX_MODE' => 'N',
        'AJAX_OPTION_JUMP' => 'N',
        'AJAX_OPTION_STYLE' => 'Y',
        'AJAX_OPTION_HISTORY' => 'N',
        'AJAX_OPTION_ADDITIONAL' => '',
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'CACHE_FILTER' => 'N',
        'PREVIEW_TRUNCATE_LEN' => null,
        'SET_TITLE' => 'N',
        'SET_BROWSER_TITLE' => 'N',
        'SET_META_KEYWORDS' => 'N',
        'SET_META_DESCRIPTION' => 'N',
        'SET_LAST_MODIFIED' => 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN' => 'N',
        'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
        'PARENT_SECTION' => null,
        'PARENT_SECTION_CODE' => null,
        'INCLUDE_SUBSECTIONS' => 'N',
        'STRICT_SECTION_CHECK' => 'N',
        'DISPLAY_TOP_PAGER' => 'N',
        'DISPLAY_BOTTOM_PAGER' => 'N',
        'PAGER_SHOW_ALWAYS' => 'N',
        'PAGER_DESC_NUMBERING' => 'N',
        'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
        'PAGER_SHOW_ALL' => 'N',
        'PAGER_BASE_LINK_ENABLE' => 'N',
        'SET_STATUS_404' => 'N',
        'SHOW_404' => 'N',
        'DISPLAY_TITLE' => $arParams['DISPLAY_TITLE'],
        'DISPLAY_BUTTON_ALL' => $arParams['DISPLAY_BUTTON_ALL'],
        'TITLE' => $arParams['TITLE'],
        'COUNT_IN_ROW' => $arParams["COUNT_IN_ROW"],
        "ALIGN_TITLE" => $arParams["ALIGN_TITLE"],
        "PAGE_URL" => $arParams["PAGE_URL"],
        'DISPLAY_DESCRIPTION' => $arParams['DISPLAY_DESCRIPTION'],
        'ALIGN_DESCRIPTION' => $arParams['ALIGN_DESCRIPTION'],
        'DESCRIPTION' => $arParams['DESCRIPTION'],

        'VIDEO_SHOW' => $arParams['VIDEO_SHOW'],
        'DOCUMENT_SHOW' => $arParams['DOCUMENT_SHOW'],
        'PROPERTY_DOCUMENT' => $arParams['PROPERTY_DOCUMENT'],
        'PROPERTY_VIDEO' => $arParams['PROPERTY_VIDEO'],
        'VIDEO_IBLOCK_TYPE' => $arParams['VIDEO_IBLOCK_TYPE'],
        'VIDEO_IBLOCK_ID' => $arParams['VIDEO_IBLOCK_ID'],
        'VIDEO_IBLOCK_PROPERTY_LINK' => $arParams['VIDEO_IBLOCK_PROPERTY_LINK'],
        'VIDEO_IBLOCK_PROPERTY_IMAGE_USE' => $arParams['VIDEO_IBLOCK_PROPERTY_IMAGE_USE'],
        'VIDEO_IMAGE_QUALITY' => $arParams['VIDEO_IMAGE_QUALITY'],
        'PROJECT_SHOW' => $arParams['PROJECT_SHOW'],
        'PROPERTY_PROJECT' => $arParams['PROPERTY_PROJECT'],
        'SERVICE_SHOW' => $arParams['SERVICE_SHOW'],
        'PROPERTY_SERVICE' => $arParams['PROPERTY_SERVICE'],
        'PROPERTY_POSITION' => $arParams['PROPERTY_POSITION']
    ),
    $component
);