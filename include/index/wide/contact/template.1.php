<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

?>
<?= Html::beginTag('div') ?>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:map.google.view",
        "template.1",
        array(
            "COMPONENT_TEMPLATE" => "template.1",
            "API_KEY" => "",
            "INIT_MAP_TYPE" => "ROADMAP",
            "MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.161497;s:10:\"google_lon\";d:61.38433209999994;s:12:\"google_scale\";i:13;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:34:\"г. Челябинск###RN###пр. Ленина 64а\";s:3:\"LON\";d:61.384219447221;s:3:\"LAT\";d:55.161593531811;}}}",
            "MAP_WIDTH" => "100%",
            "MAP_HEIGHT" => "500",
            "WIDTH" => "Y",
            "INFO_SHOW" => "Y",
            "INFO_TITLE" => "Наши контакты",
            "ADDRESS_SHOW" => "Y",
            "ADDRESS_CITY" => "",
            "ADDRESS_STREET" => "",
            "PHONE_SHOW" => "Y",
            "PHONE_NUMBER" => array(
                0 => ""
            ),
            "ORDER_CALL_SHOW" => "Y",
            "ORDER_CALL_FORM" => "1",
            "ORDER_CALL_FORM_TEMPLATE" => ".default",
            "ORDER_CALL_CONSENT" => "/company/consent/",
            "ORDER_CALL_TITLE" => "Заказать звонок",
            "ORDER_CALL_TEXT" => "Заказать звонок",
            "EMAIL_SHOW" => "Y",
            "EMAIL_ADDRESS" => array(
                0 => ""
            ),
            "CONTROLS" => array(
                0 => "SMALL_ZOOM_CONTROL",
                1 => "TYPECONTROL",
                2 => "SCALELINE",
            ),
            "OPTIONS" => array(
                0 => "ENABLE_SCROLL_ZOOM",
                1 => "ENABLE_DBLCLICK_ZOOM",
                2 => "ENABLE_DRAGGING",
                3 => "ENABLE_KEYBOARD",
            ),
            "MAP_ID" => ""
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>