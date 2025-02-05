<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div', ['style' => [
    'margin-top' => '50px'
]]) ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:main.gallery",
        "template.2",
        array(
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "12",
            "SECTIONS" => array(
            ),
            "ELEMENTS_COUNT" => "8",
            "HEADER_SHOW" => "Y",
            "HEADER_POSITION" => "left",
            "HEADER_TEXT" => "Фотогалерея",
            "DESCRIPTION_SHOW" => "N",
            "LINE_COUNT" => "4",
            "WIDTH_FULL" => "N",
            "DELIMITER_USE" => "N",
            "FOOTER_SHOW" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SORT_BY" => "SORT",
            "ORDER_BY" => "ASC"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>