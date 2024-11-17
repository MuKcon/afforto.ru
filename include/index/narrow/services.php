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
$template = ArrayHelper::getValue($blocks, ['templates', $code], 'default');

if ($display) { ?>
    <?php if (ArrayHelper::isIn($template, [
        'default',
        'tile',
        'minimal',
        'blocks',
        'small_blocks'
    ])) { ?>
        <?= Html::beginTag('div', ['style' => [
            'margin-top' => '50px',
            'margin-bottom' => '50px'
        ]]) ?>
            <?php $APPLICATION->IncludeComponent(
                "intec.universe:widget",
                "services",
                array(
                    "IBLOCK_TYPE" => "catalogs",
                    "IBLOCK_ID" => "17",
                    "ITEMS_LIMIT" => "4",
                    "PROPERTY_DISPLAY" => "SYSTEM_SHOW_ON_MAIN",
                    "DISPLAY_TITLE" => "Y",
                    "TITLE" => "Услуги",
                    "ALIGHT_TEXT" => "N",
                    "DISPLAY_DESCRIPTION" => "Y",
                    "DESCRIPTION" => "Описание очень важно для этого вида отображения. Пожалуйста, заполните его.",
                    "ALIGHT_DESCRIPTION" => "N",
                    "DISPLAY_BUTTON_ALL" => "Y",
                    "VIEW_DESKTOP" => "tile.all",
                    "VIEW_MOBILE" => "tile.all",
                    "PAGE_URL" => "/services/",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "0"
                ),
                false
            ); ?>
        <?= Html::endTag('div') ?>
    <?php } else { ?>
        <?php $templateInclude($template) ?>
    <?php } ?>
<?php }

unset($widget);