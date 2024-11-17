<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

/**
 * @var string $code
 * @var array $blocks
 * @var integer $banner
 * @var Closure $templateInclude($template)
 */

$display = ArrayHelper::getValue($blocks, ['active', $code], 'Y') === 'Y';

if ($display) { ?>
    <?= Html::beginTag('div', ['style' => [
        'margin-top' => '50px',
        'margin-bottom' => '50px'
    ]]) ?>
        <?php $APPLICATION->IncludeComponent(
            "intec.universe:widget",
            "catalog.categories",
            array(
                "IBLOCK_TYPE" => "catalogs",
                "IBLOCK_ID" => "13",
                "ITEMS_LIMIT" => "20",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "PROPERTY_LABEL_NEW" => "SYSTEM_NEW",
                "PROPERTY_LABEL_RECOMMEND" => "SYSTEM_RECOMMEND",
                "PROPERTY_LABEL_HIT" => "SYSTEM_HIT",
                "DISPLAY_DISCOUNT" => "Y",
                "PROPERTY_SECTION" => "SYSTEM_CATEGORY",
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "SIZE",
                    2 => "COLORS",
                    3 => "",
                ),
                "VIEW_DESKTOP" => "default.desktop",
                "VIEW_MOBILE" => "default.mobile",
                "DISPLAY_TITLE" => "N",
                "TITLE" => "Супер распродажа этой осени",
                "TITLE_ALIGN" => "center",
                "SHOW_DESCRIPTION" => "N",
                "COUNT_ELEMENT_IN_ROW" => "three",
                "SECTION_URL" => "",
                "DETAIL_URL" => "",
                "BASKET_URL" => "/personal/basket/",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "0",
                "CONSENT_URL" => "/company/consent/",
                "USE_BASKET" => "settings",
                "ORDER_PRODUCT_WEB_FORM" => "3",
                "PROPERTY_FORM_ORDER_PRODUCT" => "form_text_7"
            ),
            false
        ); ?>
    <?= Html::endTag('div') ?>
<?php }