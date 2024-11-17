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
        "template.7",
        array(
            "IBLOCK_TYPE" => "reviews",
            "IBLOCK_ID" => "16",
            "COUNT_ELEMENTS" => "2",
			"SELECT_BY_PROPERTY" => "N",
			"HEADER_SHOW" => "Y",
			"HEADER_POSITION" => "left",
			"HEADER_TEXT" => "Отзывы",
			"DESCRIPTION_SHOW" => "N",
			"POSITION_SHOW" => "Y",
			"TRUNCATE" => "150",
			"SLIDER_DOTS" => "Y",
			"SLIDER_NAV" => "Y",
			"SLIDER_LOOP" => "N",
			"SLIDER_AUTO" => "N",
			"FOOTER_SHOW" => "Y",
			"FOOTER_POSITION" => "right",
			"FOOTER_TEXT" => "Показать все",
			"LIST_PAGE" => "/company/reviews/",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SORT_BY" => "SORT",
			"ORDER_BY" => "ASC"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>