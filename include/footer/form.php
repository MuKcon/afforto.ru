<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @global CMain $APPLICATION
 */
?>
<?php $APPLICATION->IncludeComponent(
    "intec.universe:widget",
    "web.form.2",
    array(
        "COMPONENT_TEMPLATE" => "web.form.2",
        "GRAB_DATA" => "N",
        "TITLE" => "",
        "DESCRIPTION" => "",
        "BUTTON" => "",
        "FORM" => "",
        "WEB_FORM_ID" => "5",
        "WEB_FORM_TEMPLATE" => ".default",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "0",
        "CONSENT_URL" => "/company/consent/"
    ),
    false
); ?>