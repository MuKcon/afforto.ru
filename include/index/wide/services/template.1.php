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
        "template.1",
        array(
            "IBLOCK_TYPE" => "catalogs",
            "IBLOCK_ID" => "17",
            "ELEMENTS_COUNT" => "4",
            "HEADER_BLOCK_SHOW" => "Y",
            "HEADER_BLOCK_POSITION" => "LEFT",
            "HEADER_BLOCK_TEXT" => "Услуги",
            "DESCRIPTION_BLOCK_SHOW" => "N",
            "LINE_COUNT" => "4",
            "DESCRIPTION_SHOW" => "Y",
            "DETAIL_SHOW" => "Y",
            "DETAIL_TEXT" => "Подробнее",
            "SEE_ALL_SHOW" => "Y",
            "SEE_ALL_POSITION" => "center",
            "SEE_ALL_TEXT" => "Показать все",
            "LIST_PAGE_URL" => "/services/",
            "SECTION_URL" => "",
            "DETAIL_URL" => ""
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>