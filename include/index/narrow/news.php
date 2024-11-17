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
        'margin-top' => '30px'
    ]]) ?>
        <?php $APPLICATION->IncludeComponent(
            "intec.universe:widget",
            "news",
            array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "11",
                "ITEMS_LIMIT" => "0",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "ASC",
                "SORT_ORDER2" => "ASC",
                "DATE_FORMAT" => "d.m.Y",
                "DISPLAY_TITLE" => "Y",
                "ALIGN_TITLE" => "Y",
                "TITLE" => "Новости",
                "DISPLAY_DESCRIPTION" => "N",
                "VIEW_DESKTOP" => "list.all",
                "VIEW_MOBILE" => "list.all",
                "LINE_COUNT_MOBILE" => "1",
                "DETAIL_URL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "0",
                "USE_SETTINGS" => "N"
            ),
            false
        ); ?>
    <?= Html::endTag('div') ?>
<?php }