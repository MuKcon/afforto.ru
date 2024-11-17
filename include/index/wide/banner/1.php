<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\collections\Arrays;
use intec\core\helpers\Html;
use intec\core\io\Path;

/**
 * @var Arrays $blocks
 * @var array $block
 * @var array $data
 * @var string $page
 * @var Path $path
 * @global CMain $APPLICATION
 */

?>
<?= Html::beginTag('div') ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:widget",
        "slider",
        array(
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "2",
            "SLIDER_COUNT" => "",
            "SLIDER_ACTIVE_ELEMENTS" => "Y",
            "SLIDER_PROPERTY_TITLE" => "HEADER",
            "SLIDER_PROPERTY_TITLE_COLOR" => "TITLE_TEXT_COLOR",
            "SLIDER_PROPERTY_DESCRIPTION" => "DESCRIPTION",
            "SLIDER_PROPERTY_DESCRIPTION_COLOR" => "DESCRIPTION_TEXT_COLOR",
            "SLIDER_PROPERTY_LINK" => "LINK",
            "SLIDER_PROPERTY_BLANK" => "NEW_TAB",
            "SLIDER_PROPERTY_BUTTON_SHOW" => "BUTTON_SHOW",
            "SLIDER_PROPERTY_BUTTON_TEXT" => "BUTTON_TEXT",
            "SLIDER_PROPERTY_BUTTON_TEXT_COLOR" => "BUTTON_TEXT_COLOR",
            "SLIDER_PROPERTY_BUTTON_COLOR" => "BUTTON_COLOR",
            "SLIDER_PROPERTY_TEXT_POSITION" => "POSITION",
            "SLIDER_PROPERTY_IMAGE" => "BANNER_IMG",
            "SLIDER_PROPERTY_IMAGE_POSITION" => "BANNER_IMG_POSITION",
            "SLIDER_PROPERTY_AUTOPLAY" => "Y",
            "SLIDER_PROPERTY_AUTOPLAY_DELAY" => "5000",
            "SLIDER_PROPERTY_HEIGHT" => "600",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0"
        ),
        false
    ); ?>
<?= Html::endTag('div') ?>