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
        'padding-top' => '50px',
        'padding-bottom' => '50px',
        'background-color' => '#f8f9fb'
    ]]) ?>
        <?php $APPLICATION->IncludeComponent(
            "intec.universe:widget",
            "news",
            array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "11",
                "ITEMS_LIMIT" => "",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "ASC",
                "SORT_ORDER2" => "ASC",
                "DATE_FORMAT" => "j F Y",
                "DISPLAY_TITLE" => "Y",
                "TITLE" => "Новости",
                "ALIGN_TITLE" => "center",
                "DISPLAY_DESCRIPTION" => "N",
                "VIEW_DESKTOP" => "extend.all",
                "VIEW_MOBILE" => "extend.all",
                "DETAIL_URL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "0"
            ),
            false
        ); ?>
    <?= Html::endTag('div') ?>
<?php }