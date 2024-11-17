<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div', ['style' => [
    'margin-top' => '50px',
    'margin-bottom' => '50px'
]]) ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:main.reviews",
        "template.3",
        array(
            "IBLOCK_TYPE" => "reviews",
            "IBLOCK_ID" => "16",
            "COUNT_ELEMENTS" => "",
            "SELECT_BY_PROPERTY" => "N",
            "PROPERTY_POSITION" => "",
            "HEADER_SHOW" => "Y",
            "HEADER_POSITION" => "center",
            "HEADER_TEXT" => "Отзывы",
            "DESCRIPTION_SHOW" => "N",
            "POSITION_SHOW" => "N",
            "SLIDER_LOOP" => "N",
            "SLIDER_AUTO_PLAY_USE" => "N",
            "FOOTER_SHOW" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SORT_BY" => "SORT",
            "ORDER_BY" => "ASC"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>