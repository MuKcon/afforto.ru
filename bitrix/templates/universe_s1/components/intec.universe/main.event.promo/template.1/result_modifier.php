<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

if (empty($arResult['SYSTEM_PROPERTIES']['TEXT']))
    $arResult['SYSTEM_PROPERTIES']['TEXT'] = Loc::getMessage('C_MAIN_EVENT_PROMO_TEMP1_EMPTY_TEXT');

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

$pictureSource = ArrayHelper::fromRange(['preview', 'detail'], ArrayHelper::getValue($arParams, 'PICTURE_SOURCE'));

$arPropertyCodes = [
    'BACKGROUND' => ArrayHelper::getValue($arParams, 'PROPERTY_BACKGROUND')
];

$arSystemProperties = [
    'PICTURE' => ArrayHelper::getValue($arResult, ['ITEM', strtoupper($pictureSource).'_PICTURE']),
    'BACKGROUND' => ArrayHelper::getValue($arResult, ['ITEM', 'PROPERTIES', $arPropertyCodes['BACKGROUND'], 'VALUE'])
];

unset($pictureSource);

$arVisual = [
    'THEME' => ArrayHelper::fromRange(['dark', 'light'], ArrayHelper::getValue($arParams, 'THEME')),
    'TEXT' => [
        'POSITION' => ArrayHelper::fromRange(['left', 'center', 'right'], ArrayHelper::getValue($arParams, 'TEXT_POSITION'))
    ],
    'PICTURE' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'PICTURE_SHOW') == 'Y' && !empty($arSystemProperties['PICTURE'])
    ],
    'BUTTON' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'BUTTON_SHOW') == 'Y',
        'TEXT' => Html::encode(ArrayHelper::getValue($arParams, 'BUTTON_TEXT')),
        'POSITION' => ArrayHelper::fromRange(['left', 'center', 'right'], ArrayHelper::getValue($arParams, 'BUTTON_POSITION')),
        'LINK' => null,
        'MODE' => ArrayHelper::fromRange(['link', 'anchor'], ArrayHelper::getValue($arParams, 'BUTTON_MODE'))
    ],
    'BACKGROUND' => [
        'USE' => ArrayHelper::getValue($arParams, 'BACKGROUND_USE') == 'Y' && !empty($arSystemProperties['BACKGROUND']),
        'PADDING' => null
    ],
];

if ($arVisual['PICTURE']['SHOW']) {
    $arPicture = CFile::ResizeImageGet(
        $arSystemProperties['PICTURE'],
        [
            'width' => 600,
            'height' => 600
        ],
        BX_RESIZE_IMAGE_PROPORTIONAL_ALT
    );

    $arSystemProperties['PICTURE']['SRC'] = $arPicture['src'];

    unset($arPicture);
}

if ($arVisual['BUTTON']['SHOW']) {
    $sLink = ArrayHelper::getValue($arParams, 'BUTTON_LINK');

    if (!empty($sLink)) {
        if ($arVisual['BUTTON']['MODE'] == 'link')
            $arVisual['BUTTON']['LINK'] = StringHelper::replaceMacros($sLink, $arMacros);
        elseif ($arVisual['BUTTON']['MODE'] == 'anchor')
            $arVisual['BUTTON']['LINK'] = '#'.StringHelper::replace($sLink, ['#' => '']);
    }

    unset($sLink);

    $arVisual['BUTTON']['SHOW'] = !empty($arVisual['BUTTON']['TEXT']) && !empty($arVisual['BUTTON']['LINK']);
}

if ($arVisual['BACKGROUND']['USE']) {
    $arSystemProperties['BACKGROUND'] = CFile::GetFileArray($arSystemProperties['BACKGROUND']);
    $arSystemProperties['BACKGROUND']['SRC'] = CFile::GetFileSRC($arSystemProperties['BACKGROUND']);

    $iPadding = ArrayHelper::getValue($arParams, 'BACKGROUND_PADDING');
    $iPadding = StringHelper::replace(
        $iPadding,
        ['px' => '']
    );

    if (Type::isNumeric($iPadding))
        $arVisual['BACKGROUND']['PADDING'] = $iPadding;

    unset($iPadding);
}

$arResult['PROPERTY_CODES'] = $arPropertyCodes;
$arResult['SYSTEM_PROPERTIES'] = ArrayHelper::merge($arResult['SYSTEM_PROPERTIES'], $arSystemProperties);
$arResult['VISUAL'] = $arVisual;

unset($arPropertyCodes, $arSystemProperties, $arVisual, $arMacros);