<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\collections\Arrays;
use intec\core\helpers\Html;
use intec\core\io\Path;

/**
 * @var Arrays $blocks
 * @var array $block
 * @var array $data
 * @var string $page
 * @var Path $path
 * @global CMain $APPLICATION
 */

?>
<?= Html::beginTag('div', ['style' => array (
  'margin-top' => '50px',
  'margin-bottom' => '50px',
)]) ?>
<?php $APPLICATION->IncludeComponent('intec.universe:main.shares', 'template.1', array (
  'IBLOCK_TYPE' => 'content',
  'IBLOCK_ID' => '19',
  'SECTIONS' => 
  array (
  ),
  'ELEMENTS_COUNT' => '4',
  'SETTINGS_USE' => 'Y',
  'LAZYLOAD_USE' => 'N',
  'ELEMENT_HEADER_PROPERTY_TEXT' => 'DURATION',
  'TIMER_PROPERTY_UNTIL_DATE' => 'ACTION_END',
  'HEADER_BLOCK_SHOW' => 'Y',
  'HEADER_BLOCK_POSITION' => 'center',
  'HEADER_BLOCK_TEXT' => 'Акции',
  'DESCRIPTION_BLOCK_SHOW' => 'N',
  'LINE_COUNT' => '4',
  'LINK_USE' => 'Y',
  'LINK_ALL_SHOW' => 'Y',
  'LINK_ALL_PLACE' => 'bottom',
  'LINK_ALL_POSITION' => 'right',
  'LINK_ALL_TEXT' => 'Все акции',
  'ELEMENT_HEADER_SHOW' => 'Y',
  'TIMER_SHOW' => 'Y',
  'TIMER_USE' => 'Y',
  'TIMER_TIMER_SECONDS_SHOW' => 'N',
  'TIMER_TIMER_HEADER_SHOW' => 'Y',
  'TIMER_TIMER_HEADER' => 'До конца акции',
  'TIMER_SALE_SHOW' => 'Y',
  'TIMER_PROPERTY_DISCOUNT' => 'SALE',
  'TIMER_SALE_HEADER_SHOW' => 'N',
  'LIST_PAGE_URL' => '',
  'SECTION_URL' => '',
  'DETAIL_URL' => '',
  'NAVIGATION_USE' => 'Y',
  'NAVIGATION_ID' => 'news',
  'NAVIGATION_MODE' => 'ajax',
  'NAVIGATION_TEMPLATE' => 'lazy.2',
  'SORT_BY' => 'SORT',
  'ORDER_BY' => 'ASC',
  'DATE_SHOW' => 'Y',
  'DATE_FORMAT' => 'd.m.Y',
  'SEE_ALL_SHOW' => 'N',
  'NAVIGATION_ALL' => 'N',
  'CACHE_TYPE' => 'A',
  'CACHE_TIME' => 3600000,
), false) ?>
<?= Html::endTag('div') ?>
