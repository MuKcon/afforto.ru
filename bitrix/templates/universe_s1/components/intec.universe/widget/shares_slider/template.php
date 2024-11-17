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
        'SORT_BY1' => $arParams['SORT_BY1'],
        'SORT_ORDER1' => $arParams['SORT_ORDER1'],
        'SORT_BY2' => $arParams['SORT_BY2'],
        'SORT_ORDER2' => $arParams['SORT_ORDER2'],
        'FILTER_NAME' => $arParams['FILTER_NAME'],
        'FIELD_CODE' => array(
            'DATE_ACTIVE_FROM',
            'ACTIVE_FROM',
            'DATE_ACTIVE_TO',
            'ACTIVE_TO'
        ),
        'PROPERTY_CODE' => array(),
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
        'ACTIVE_DATE_FORMAT' => $arParams['DATE_FORMAT'],
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
        "ALIGN_TITLE" => $arParams["ALIGN_TITLE"],
        "ALIGN_DESCRIPTION" => $arParams["ALIGN_DESCRIPTION"],
        'TITLE' => $arParams['TITLE'],
        "COUNT_IN_ROW" => $arParams["COUNT_IN_ROW"],
        "DISPLAY_DESCRIPTION" => $arParams["DISPLAY_DESCRIPTION"],
        "DESCRIPTION" => $arParams["DESCRIPTION"],
    ),
    $component
); ?>

<script>
    $(function() {
		$('.akcii-slider .widget-shares-view-wrapper').addClass("owl-carousel").owlCarousel({
	    loop:true,
	    margin:10,
		nav:true,
		dots:false,
        navText: ['<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.875 1.25L3.125 5L6.875 8.75" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>', '<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 1.25L6.875 5L3.125 8.75" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
            540:{
	            items:2,
	            nav:true
	        },
	        750:{
	            items:3,
	            nav:true
	        },
	        1100:{
	            items:4,
	            nav:true,
	        }
	    }
		})
	});
</script>