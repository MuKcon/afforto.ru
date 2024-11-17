<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use intec\Core;
use intec\core\helpers\ArrayHelper;

/**
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arResult
 * @var array $arParams
 */

/** Подписка */
$bSubscribe = false;

if (Loader::includeModule('subscribe'))
    $bSubscribe = true;

/** Параметры облака тегов */
$request = Core::$app->request;
$arTags = $request->get($arParams['TAG_VARIABLE_NAME']);
$arTagsFilter = [];

if (empty($arTags))
    $arTags = array();

foreach ($arTags as $iKey => $sTag) {
    if ($sTag == 'Y') {
        $arTagsFilter[] = $iKey;
    }
}

$arrFilter = ['PROPERTY_'.$arParams['PROPERTY_TAG'] => $arTagsFilter];

$GLOBALS['arrFilter'] = $arrFilter;

/** Параметры отображения */
$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');

$bSubscribeShow = $arViewParams['LIST_SUBSCRIBE_SHOW_IN_LIST'] && $bSubscribe;
$bNewsTopShow = $arViewParams['LIST_NEWS_TOP_SHOW_IN_LIST'];

$sNofFullView = !$bSubscribeShow || !$bNewsTopShow ? ' not-full-view' : null;

?>
<div class="intec-content experts">
    <div class="intec-content-wrapper">
        <div class="ns-bitrix c-news c-news-blog<?= $arViewParams['LIST_TWO_COLUMNS'] ? ' two-columns' : null ?>">
            <?php if ($arViewParams['LIST_TAG_CLOUD_SHOW']) { ?>
                <div class="news-tags-cloud-wrap position-top">
                    <?php $APPLICATION->IncludeComponent(
                        'intec.universe:tags.cloud',
                        'template.1',
                        array(
                            'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                            'PROPERTY_TAG' => $arParams['PROPERTY_TAG'],
                            'TAG_VARIABLE_NAME' => $arParams['TAG_VARIABLE_NAME']
                        ),
                        $component
                    ); ?>
                </div>
            <?php } ?>
            <div class="news-elements-content<?= $arViewParams['LIST_TWO_COLUMNS'] ? ' main-column' : null ?>">
                <?php $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "expert",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                        "SORT_BY1" => $arParams["SORT_BY1"],
                        "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                        "SORT_BY2" => $arParams["SORT_BY2"],
                        "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                        "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                        "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                        "DISPLAY_NAME" => $arParams['DISPLAY_NAME'],
                        "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                        "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                        "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                        "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                        "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                        "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                        "FILTER_NAME" => 'arrFilter',
                        "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                        "CHECK_DATES" => $arParams["CHECK_DATES"],
                        'VIEW' => $arParams['LIST_VIEW'],
                        'GRID' => $arParams['LIST_GRID'],
                        'DATE_SHOW' => $arParams['LIST_DATE_SHOW'],
                        'TAG_SHOW' => $arParams['LIST_TAG_SHOW'],
                        'DESCRIPTION_SHOW' => $arParams['LIST_DESCRIPTION_SHOW'],
                        'PROPERTY_TAG' => $arParams['PROPERTY_TAG'],
                        'TAG_VARIABLE_NAME' => $arParams['TAG_VARIABLE_NAME'],
                        'COLUMN' => $arParams['LIST_TWO_COLUMNS']
                    ),
                    $component
                ); ?>
            </div>
            <?php if ($arViewParams['LIST_TWO_COLUMNS']) { ?>
                <div class="news-elements-content right-column<?= $sNofFullView ?>">
                    <?php if ($arViewParams['LIST_TAG_CLOUD_SHOW']) { ?>
                        <div class="news-tags-cloud-wrap position-right">
                            <?php $APPLICATION->IncludeComponent(
                                'intec.universe:tags.cloud',
                                'template.1',
                                array(
                                    'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                    'PROPERTY_TAG' => $arParams['PROPERTY_TAG'],
                                    'TAG_VARIABLE_NAME' => $arParams['TAG_VARIABLE_NAME'],
                                    'HEADER_SHOW' => $arParams['LIST_TAG_HEADER_SHOW'],
                                    'HEADER_TEXT' => $arParams['LIST_TAG_HEADER_TEXT']
                                ),
                                $component
                            ); ?>
                        </div>
                    <?php } ?>
                    <?php if ($bNewsTopShow && $arViewParams['LIST_NEWS_TOP_SHOW']) { ?>
                        <div class="news-top-viewed-wrap">
                            <?php $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "news.top",
                                array(
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "NEWS_COUNT" => $arParams["LIST_NEWS_TOP_ELEMENTS_COUNT"],
                                    "SORT_BY1" => 'SHOW_COUNTER',
                                    "SORT_ORDER1" => 'DESC',
                                    "SORT_BY2" => $arParams["SORT_BY2"],
                                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                                    "SET_TITLE" => 'N',
                                    "SET_LAST_MODIFIED" => '',
                                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                    "SHOW_404" => $arParams["SHOW_404"],
                                    "FILE_404" => $arParams["FILE_404"],
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "DISPLAY_TOP_PAGER" => 'N',
                                    "DISPLAY_BOTTOM_PAGER" => 'N',
                                    "PAGER_TITLE" => '',
                                    "PAGER_TEMPLATE" => '',
                                    "PAGER_SHOW_ALWAYS" => '',
                                    "PAGER_DESC_NUMBERING" => '',
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => '',
                                    "PAGER_SHOW_ALL" => '',
                                    "PAGER_BASE_LINK_ENABLE" => '',
                                    "PAGER_BASE_LINK" => '',
                                    "PAGER_PARAMS_NAME" => '',
                                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                                    "DISPLAY_NAME" => $arParams['DISPLAY_NAME'],
                                    "DISPLAY_PICTURE" => 'N',
                                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                                    "FILTER_NAME" => '',
                                    "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                                    'PROPERTY_TAG' => $arParams['PROPERTY_TAG'],
                                    'TAG_VARIABLE_NAME' => $arParams['TAG_VARIABLE_NAME'],
                                    'HEADER_SHOW' => $arParams['LIST_NEWS_TOP_HEADER_SHOW'],
                                    'HEADER_TEXT' => $arParams['LIST_NEWS_TOP_HEADER_TEXT'],
                                    'TAG_SHOW' => $arParams['LIST_NEWS_TOP_TAG_SHOW'],
                                    'DATE_SHOW' => $arParams['LIST_NEWS_TOP_DATE_SHOW']
                                ),
                                $component
                            ); ?>
                        </div>
                    <?php } ?>
                    <?php if ($bSubscribeShow) { ?>
                        <div class="news-subscribe-wrapper">
                            <?php $APPLICATION->IncludeComponent(
                                'bitrix:subscribe.edit',
                                'blog',
                                array(
                                    'COMPONENT_TEMPLATE' => 'blog',
                                    'SHOW_HIDDEN' => 'N',
                                    'CONSENT_URL' => $arParams['LIST_SUBSCRIBE_CONSENT'],
                                    'AJAX_MODE' => 'N',
                                    'AJAX_OPTION_JUMP' => 'N',
                                    'AJAX_OPTION_STYLE' => 'Y',
                                    'AJAX_OPTION_HISTORY' => 'N',
                                    'AJAX_OPTION_ADDITIONAL' => '',
                                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                                    'ALLOW_ANONYMOUS' => $arParams['LIST_SUBSCRIBE_ALLOW_ANONIMOUS'],
                                    'SHOW_AUTH_LINKS' => 'N',
                                    'SET_TITLE' => 'N',
                                    'HEADER_SHOW' => $arParams['LIST_SUBSCRIBE_HEADER_SHOW'],
                                    'HEADER_TEXT' => $arParams['LIST_SUBSCRIBE_HEADER_TEXT'],
                                    'HEADER_POSITION' => $arParams['LIST_SUBSCRIBE_HEADER_POSITION'],
                                    'SUBSCRIBE_RUBRICS' => $arParams['LIST_SUBSCRIBE_RUBRICS'],
                                    'SUBSCRIBE_TYPE' => $arParams['LIST_SUBSCRIBE_TYPE']
                                ),
                                $component
                            );?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
