<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

/**
 * @var string $code
 * @var array $blocks
 * @var integer $banner
 * @var Closure $templateInclude($template)
 */

$display = ArrayHelper::getValue($blocks, ['active', $code], 'Y') === 'Y';

if ($display) { ?>
    <?= Html::beginTag('div', ['style' => [
        'margin-top' => '50px',
        'margin-bottom' => '50px'
    ]]) ?>
        <?php $APPLICATION->IncludeComponent(
            "intec.universe:widget",
            "categories",
            array(
                "IBLOCK_TYPE" => "catalogs",
                "IBLOCK_ID" => "13",
                "DISPLAY_TITLE" => "Y",
                "DISPLAY_DESCRIPTION" => "N",
                "SECTION_COUNT_ELEMENTS" => "Y",
                "VIEW" => "list",
                "GRID_CATALOG_ROOT_SECTIONS_COUNT" => "3",
                "USE_SUBSECTIONS_SECTIONS" => "Y",
                "COUNT_SUBSECTIONS_SECTIONS" => "3",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "0",
                "ID_CATEGORIES" => array(
                    0 => "11",
                    1 => "12",
                    2 => "13",
                    3 => "14",
                    4 => "15",
                    5 => "16",
                ),
                "TITLE" => "Популярные категории",
                "ALIGHT_HEADER" => "Y",
                "ALIGHT_DESCRIPTION" => "Y"
            ),
            false
        ); ?>
    <?= Html::endTag('div') ?>
<?php }