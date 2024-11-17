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
            'slider',
            'blocks_1',
            'blocks_2'
        ])) { ?>
            <?= Html::beginTag('div', ['style' => [
                'margin-top' => '50px',
                'margin-bottom' => '50px'
            ]]) ?>
                <?php $APPLICATION->IncludeComponent(
                    "intec.universe:widget",
                    "reviews",
                    array(
                        "IBLOCK_TYPE" => "reviews",
                        "IBLOCK_ID" => "16",
                        "ITEMS_LIMIT" => "4",
                        "PROPERTY_DISPLAY" => "SYSTEM_SHOW_BLOCK",
                        "DISPLAY_TITLE" => "Y",
                        "TITLE" => "Отзывы",
                        "ALIGN_TITLE" => "left",
                        "DISPLAY_BUTTON_ALL" => "Y",
                        "VIEW_DESKTOP" => "slider.all",
                        "VIEW_MOBILE" => "slider.all",
                        "PAGE_URL" => "/company/reviews/",
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