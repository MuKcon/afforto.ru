<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arParams
 * @var array $arResult
 */

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

/** Параметры заголовка */
$sHeaderText = ArrayHelper::getValue($arParams, 'HEADER_TEXT');
$sHeaderText = trim($sHeaderText);
$bHeaderShow = ArrayHelper::getValue($arParams, 'HEADER_SHOW');
$bHeaderShow = $bHeaderShow == 'Y' && !empty($sHeaderText);

$arResult['HEADER_BLOCK'] = [
    'SHOW' => $bHeaderShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'HEADER_POSITION'),
    'TEXT' => Html::encode($sHeaderText)
];

/** Параметры описания */
$sDescriptionText = ArrayHelper::getValue($arParams, 'DESCRIPTION_TEXT');
$sDescriptionText = trim($sDescriptionText);
$bDescriptionShow = ArrayHelper::getValue($arParams, 'DESCRIPTION_SHOW');
$bDescriptionShow = $bDescriptionShow == 'Y' && !empty($sDescriptionText);

$arResult['DESCRIPTION_BLOCK'] = [
    'SHOW' => $bDescriptionShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'DESCRIPTION_POSITION'),
    'TEXT' => Html::encode($sDescriptionText)
];

/** Параметры отображения */
$iLineCount = ArrayHelper::fromRange([3, 4], ArrayHelper::getValue($arParams, 'LINE_COUNT'));
$iSliderSpeed = ArrayHelper::getValue($arParams, 'SLIDER_SLIDE_SPEED');
$iSectionMaxCount = ArrayHelper::getValue($arParams, 'SECTION_MAX_COUNT');
$bSectionsMaxCountUse = false;

if (!empty($iSectionMaxCount) || Type::isInteger($iSectionMaxCount) && $iSectionMaxCount > 0)
    $bSectionsMaxCountUse = true;

$arPropList = ArrayHelper::getValue($arParams, 'PROPERTIES_LIST_PROPERTY');

if (!Type::isArray($arPropList))
    $arPropList = [];

$arPropList = array_filter($arPropList);

$sCountText = ArrayHelper::getValue($arParams, 'COUNT_TEXT');
$bCountShow = ArrayHelper::getValue($arParams, 'COUNT_SHOW') == 'Y';
$bCountShow = $bCountShow && !empty($sCountText);

$arResult['VISUAL'] = [
    'LINE_COUNT' => $iLineCount,
    'VIEW' => ArrayHelper::fromRange(['tabs', 'simple'], ArrayHelper::getValue($arParams, 'VIEW')),
    'TABS' => [
        'POSITION' => ArrayHelper::fromRange(['center', 'left', 'right'], ArrayHelper::getValue($arParams, 'TABS_POSITION'))
    ],
    'COUNT' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'COUNT_SHOW') == 'Y',
        'TEXT' => ArrayHelper::getValue($arParams, 'COUNT_TEXT'),
    ],
    'PRICE' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'PRICE_SHOW') == 'Y'
    ],
    'DISCOUNT' => [
        'STICKER' => [
            'SHOW' => ArrayHelper::getValue($arParams, 'DISCOUNT_STICKER_SHOW') == 'Y'
        ]
    ],
    'SECTION' => [
        'DESCRIPTION' => [
            'SHOW' => ArrayHelper::getValue($arParams, 'SECTION_DESCRIPTION_SHOW') == 'Y',
            'POSITION' => ArrayHelper::fromRange(['center', 'left', 'right'], ArrayHelper::getValue($arParams, 'SECTION_DESCRIPTION_POSITION'))
        ],
        'MAX_COUNT' => [
            'USE' => $bSectionsMaxCountUse,
            'VALUE' => $iSectionMaxCount
        ]
    ],
    'ELEMENT_DESCRIPTION' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'ELEMENT_DESCRIPTION_SHOW') == 'Y',
        'LENGTH' => ArrayHelper::getValue($arParams, 'ELEMENT_DESCRIPTION_LENGTH')
    ],
    'PROPERTY_LIST' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'PROPERTY_LIST_SHOW') == 'Y'
    ],
    'BUTTON' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'BUTTON_SHOW') == 'Y',
        'TEXT' => ArrayHelper::getValue($arParams, 'BUTTON_TEXT'),
        'TYPE' => ArrayHelper::getValue($arParams, 'BUTTON_TYPE'),
        'FORM' => [
            'ID' => ArrayHelper::getValue($arParams, 'BUTTON_FORM_ID'),
            'TEMPLATE' => ArrayHelper::getValue($arParams, 'BUTTON_FORM_TEMPLATE'),
            'FIELD' => ArrayHelper::getValue($arParams, 'BUTTON_FORM_FIELD'),
            'TITLE' => ArrayHelper::getValue($arParams, 'BUTTON_FORM_TITLE'),
            'CONSENT' => ArrayHelper::getValue($arParams, 'BUTTON_FORM_CONSENT')
        ]
    ],
    'SLIDER' => [
        'USE' => ArrayHelper::getValue($arParams, 'SLIDER_USE') == 'Y',
        'LOOP' => ArrayHelper::getValue($arParams, 'SLIDER_LOOP') == 'Y',
        'SPEED' => ArrayHelper::getValue($arParams, 'SLIDER_SPEED'),
        'CONTROLS' => [
            'NAV' => ArrayHelper::getValue($arParams, 'SLIDER_ARROW') == 'Y',
            'DOTS' => ArrayHelper::getValue($arParams, 'SLIDER_DOTS') == 'Y'
        ],
        'AUTO' => [
            'USE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_USE') == 'Y',
            'TIME' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_TIME'),
            'PAUSE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PAUSE') == 'Y'
        ]
    ]
];

/** Коды свойств */
$arResult['PROPERTY_CODES'] = [
    'PRICE' => ArrayHelper::getValue($arParams, 'PROPERTY_PRICE'),
    'DISCOUNT' => ArrayHelper::getValue($arParams, 'PROPERTY_DISCOUNT'),
    'DISCOUNT_TYPE' => ArrayHelper::getValue($arParams, 'PROPERTY_DISCOUNT_TYPE'),
    'CURRENCY' => ArrayHelper::getValue($arParams, 'PROPERTY_CURRENCY'),
    'DETAIL_URL' => ArrayHelper::getValue($arParams, 'PROPERTY_DETAIL_URL'),
    'LIST' => array_filter(ArrayHelper::getValue($arParams, 'PROPERTY_LIST'))
];


/** Обработка данных */
/**
 * Рассчет скидки
 * @param $price
 * @param $discount
 * @param $type
 * @return mixed
 */
$fGetPrice = function ($price, $discount, $type = 'percent') {
    if (!empty($discount)) {
        if ($type != 'value' && $discount <= 100) {
            $discount = $price / 100 * $discount;
        } else if ($type != 'value' && $discount > 100) {
            $discount = $price;
        }
    } else {
        $discount = 0;
    }

    $price = $price - $discount;

    return $price;
};

$sPropertyPrice = $arResult['PROPERTY_CODES']['PRICE'];
$sPropertyDiscount = $arResult['PROPERTY_CODES']['DISCOUNT'];
$sPropertyDetailUrl = $arResult['PROPERTY_CODES']['DETAIL_URL'];

if ($arResult['VISUAL']['VIEW'] == 'simple') {
    foreach ($arResult['ITEMS'] as $iKey => $arItem) {
        /** Обработка цен */
        if (!empty($sPropertyPrice)) {
            $iPrice = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyPrice, 'VALUE']);
            $sPropertyDiscountType = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['DISCOUNT_TYPE'], 'VALUE_XML_ID']);
            $arPrice = null;

            if (!empty($iPrice) || Type::isNumeric($iPrice)) {
                $iDiscount = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyDiscount, 'VALUE']);
                $iNewPrice = $fGetPrice($iPrice, $iDiscount, $sPropertyDiscountType);
                $arPrice = [
                    'VALUE' => $iNewPrice,
                    'OLD_VALUE' => $iDiscount > 0 ? $iPrice : null
                ];
            }

            $arResult['ITEMS'][$iKey]['PROPERTIES'][$sPropertyPrice]['VALUE'] = $arPrice;
        }

        /** Обработка ссылок */
        $sDetailUrl = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyDetailUrl, 'VALUE']);

        if (!empty($sDetailUrl)) {
            $sDetailUrl = StringHelper::replaceMacros($sDetailUrl, $arMacros);

            $arResult['ITEMS'][$iKey]['PROPERTIES'][$sPropertyDetailUrl]['VALUE'] = $sDetailUrl;
        }
    }
} else if ($arResult['VISUAL']['VIEW'] == 'tabs') {
    foreach ($arResult['SECTIONS'] as $iKeySection => $arSection) {
        if (!empty($arSection['ITEMS'])) {
            foreach ($arSection['ITEMS'] as $iKeyItem => $arItem) {
                /** Обработка цен */
                if (!empty($sPropertyPrice)) {
                    $iPrice = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyPrice, 'VALUE']);
                    $sPropertyDiscountType = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['DISCOUNT_TYPE'], 'VALUE_XML_ID']);
                    $arPrice = null;

                    if (!empty($iPrice) || Type::isNumeric($iPrice)) {
                        $iDiscount = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyDiscount, 'VALUE']);
                        $iNewPrice = $fGetPrice($iPrice, $iDiscount, $sPropertyDiscountType);
                        $arPrice = [
                            'VALUE' => $iNewPrice,
                            'OLD_VALUE' => $iDiscount > 0 ? $iPrice : null
                        ];
                    }

                    $arResult['SECTIONS'][$iKeySection]['ITEMS'][$iKeyItem]['PROPERTIES'][$sPropertyPrice]['VALUE'] = $arPrice;
                }

                /** Обработка ссылок */
                $sDetailUrl = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyDetailUrl, 'VALUE']);

                if (!empty($sDetailUrl)) {
                    $sDetailUrl = StringHelper::replaceMacros($sDetailUrl, $arMacros);

                    $arResult['SECTIONS'][$iKeySection]['ITEMS'][$iKeyItem]['PROPERTIES'][$sPropertyDetailUrl]['VALUE'] = $sDetailUrl;
                }
            }
        }
    }
}