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
        "template.3",
        array(
            "IBLOCK_TYPE" => "catalogs",
            "IBLOCK_ID" => "17",
            "ELEMENTS_COUNT" => "6",
            "HEADER_BLOCK_SHOW" => "Y",
            "HEADER_BLOCK_POSITION" => "LEFT",
            "HEADER_BLOCK_TEXT" => "Услуги",
            "DESCRIPTION_BLOCK_SHOW" => "N",
            "LINE_COUNT" => "3",
            "SEE_ALL_SHOW" => "N",
            "LIST_PAGE_URL" => "",
            "SECTION_URL" => "",
            "DETAIL_URL" => ""
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>