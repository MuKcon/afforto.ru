<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 * @var array $arParams
 */

$sNewTopShowIn = ArrayHelper::getValue($arParams, 'LIST_NEWS_TOP_SHOW_IN');

$bNewTopListShow = false;
$bNewTopDetailShow = false;

if ($sNewTopShowIn != 'detail') {
    $bNewTopListShow = true;
}

if ($sNewTopShowIn != 'list') {
    $bNewTopDetailShow = true;
}

$sSubscribeShowIn = ArrayHelper::getValue($arParams, 'LIST_SUBSCRIBE_SHOW_IN');

$bSubscribeListShow = false;
$bSubscribeDetailShow = false;

if ($sSubscribeShowIn != 'detail') {
    $bSubscribeListShow = true;
}

if ($sSubscribeShowIn != 'list') {
    $bSubscribeDetailShow = true;
}

$arResult['VIEW_PARAMETERS'] = [
    'LIST_TWO_COLUMNS' => ArrayHelper::getValue($arParams, 'LIST_TWO_COLUMNS') == 'Y',
    'LIST_TAG_CLOUD_SHOW' => ArrayHelper::getValue($arParams, 'LIST_TAG_CLOUD_SHOW') == 'Y',
    'LIST_NEWS_TOP_SHOW' => ArrayHelper::getValue($arParams, 'LIST_NEWS_TOP_SHOW') == 'Y',
    'LIST_NEWS_TOP_SHOW_IN_LIST' => $bNewTopListShow,
    'LIST_NEWS_TOP_SHOW_IN_DETAIL' => $bNewTopDetailShow,
    'LIST_SUBSCRIBE_SHOW' => ArrayHelper::getValue($arParams, 'LIST_SUBSCRIBE_SHOW') == 'Y',
    'LIST_SUBSCRIBE_SHOW_IN_LIST' => $bSubscribeListShow,
    'LIST_SUBSCRIBE_SHOW_IN_DETAIL' => $bSubscribeDetailShow,
    'DETAIL_TWO_COLUMNS' => ArrayHelper::getValue($arParams, 'DETAIL_TWO_COLUMNS') == 'Y'
];