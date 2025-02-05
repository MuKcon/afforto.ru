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
<?php $APPLICATION->IncludeComponent('intec.universe:main.staff', 'template.1', array (
  'IBLOCK_TYPE' => 'content',
  'IBLOCK_ID' => '50',
  'SECTIONS_MODE' => 'id',
  'ELEMENTS_COUNT' => '4',
  'SETTINGS_USE' => 'Y',
  'LAZYLOAD_USE' => 'N',
  'PROPERTY_POSITION' => 'POSITION',
  'HEADER_SHOW' => 'Y',
  'HEADER_POSITION' => 'center',
  'HEADER_TEXT' => 'Наша команда',
  'DESCRIPTION_SHOW' => 'N',
  'LINE_COUNT' => 4,
  'POSITION_SHOW' => 'Y',
  'SOCIALS_SHOW' => 'N',
  'CACHE_TYPE' => 'A',
  'CACHE_TIME' => 3600000,
  'SORT_BY' => 'SORT',
  'ORDER_BY' => 'ASC',
), false) ?>
<?= Html::endTag('div') ?>
