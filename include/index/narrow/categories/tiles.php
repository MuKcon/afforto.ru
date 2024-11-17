<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div', ['style' => [
    'margin-top' => '50px',
    'margin-bottom' => '50px'
]]) ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:main.sections",
        "template.1",
        array(
            "IBLOCK_TYPE" => "catalogs",
            "IBLOCK_ID" => "13",
            "QUANTITY" => "N",
			"MODE" => "ID",
			"DEPTH" => 1,
			"ELEMENTS_COUNT" => 6,
			"HEADER_SHOW" => "Y",
			"HEADER_POSITION" => "left",
			"HEADER_TEXT" => "Популярные категории",
			"DESCRIPTION_SHOW" => "N",
			"LINE_COUNT" => 3,
			"SECTION_URL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => 3600,
			"SORT_BY" => "SORT",
			"ORDER_BY" => "ASC"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>