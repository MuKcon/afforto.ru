<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div', ['style' => [
    'margin-top' => '50px',
    'margin-bottom' => '50px'
]]) ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:main.services",
        "template.8",
        array(
            "IBLOCK_TYPE" => "catalogs",
            "IBLOCK_ID" => "17",
            "ELEMENTS_COUNT" => 4,
			"HEADER_BLOCK_SHOW" => "Y",
			"HEADER_BLOCK_POSITION" => "center",
			"HEADER_BLOCK_TEXT" => "Услуги",
			"DESCRIPTION_BLOCK_SHOW" => "N",
            "LINE_COUNT" => 2,
			"LINK_USE" => "Y",
			"INDENT_IMAGE_USE" => "N",
			"DESCRIPTION_USE" => "Y",
			"SEE_ALL_SHOW" => "N",
			"SECTION_URL" => "",
			"DETAIL_URL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => 3600,
			"SORT_BY" => "SORT",
			"ORDER_BY" => "ASC"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>