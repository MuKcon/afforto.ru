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
$template = ArrayHelper::getValue($blocks, ['templates', $code], 'chess');

if ($display) { ?>
    <?php if (ArrayHelper::isIn($template, [
        'chess',
        'puzzle',
        'tiles'
    ])) { ?>
        <?= Html::beginTag('div', ['style' => [
            'margin-top' => '50px',
            'margin-bottom' => '50px'
        ]]) ?>
            <?php $APPLICATION->IncludeComponent(
                "intec.universe:widget",
                "sections",
                array(
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "4",
                    "ITEMS_LIMIT" => "4",
                    "DISPLAY_TITLE" => "Y",
                    "DISPLAY_DESCRIPTION" => "Y",
                    "PROPERTY_LINK" => "SYSTEM_LINK",
                    "PROPERTY_TARGET" => "SYSTEM_TARGET",
                    "PROPERTY_SHOW_STICKER" => "SYSTEM_SHOW_STICK",
                    "PROPERTY_STICKER" => "SYSTEM_STICK",
                    "SORT_BY1" => "",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "",
                    "SORT_ORDER2" => "ASC",
                    "DESKTOP_TEMPLATE" => "puzzle",
                    "MOBILE_TEMPLATE" => "one_column",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "0",
                    "TITLE" => "Рубрики",
                    "ALIGHT_HEADER" => "N",
                    "DESCRIPTION" => "Описание очень важно для этого вида отображения. Пожалуйста, заполните его. Описание очень важно для этого вида отображения. Пожалуйста, заполните его.",
                    "ALIGHT_DESCRIPTION" => "N",
                    "MAIN_ELEMENT" => "4",
                    "PROPERTY_SIZE" => "SYSTEM_SIZE"
                ),
                false
            ); ?>
        <?= Html::endTag('div') ?>
    <?php } else { ?>
        <?php $templateInclude($template) ?>
    <?php } ?>
<?php }