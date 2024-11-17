<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div', ['style' => [
    'margin-top' => '50px',
    'margin-bottom' => '50px'
]]) ?>
    <? $APPLICATION->IncludeComponent(
        "intec.universe:main.categories",
        "template.6",
        array(
            "COMPONENT_TEMPLATE" => "template.6",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "4",
            "COUNT_SECTIONS" => "4",
            "SECTIONS" => array(
            ),
            "PROPERTY_LINK" => "SYSTEM_LINK",
            "HEADER_SHOW" => "Y",
            "HEADER_POSITION" => "center",
            "HEADER_TEXT" => "Дополнительная продукция",
            "DESCRIPTION_SHOW" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SORT_BY" => "SORT",
            "SORT_ORDER" => "ASC",
            "PROPERTY_SIZE" => "",
            "AXIS_X" => "left",
            "AXIS_Y" => "top",
            "VIEW_STYLE" => "chess",
            "NAME_VERTICAL" => "top",
            "NAME_HORIZONTAL" => "center",
            "FOOTER_SHOW" => "N"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>