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
            "shares",
            array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "19",
                "ITEMS_LIMIT" => "3",
                "PROPERTY_DISPLAY" => "SYSTEM_SHOW_ON_MAIN",
                "SORT_BY1" => "TIMESTAMP_X",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "ASC",
                "SORT_ORDER2" => "ASC",
                "DATE_FORMAT" => "j F Y",
                "DISPLAY_TITLE" => "Y",
                "TITLE" => "Акции",
                "ALIGN_TITLE" => "N",
                "DISPLAY_DESCRIPTION" => "N",
                "VIEW_DESKTOP" => "default.all",
                "COUNT_IN_ROW" => "three",
                "VIEW_MOBILE" => "default.all",
                "DETAIL_URL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "0"
            ),
            false
        ); ?>
    <?= Html::endTag('div') ?>
<?php }