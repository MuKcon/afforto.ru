<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

if (empty($arResult['SYSTEM_PROPERTIES']['TEXT']))
    $arResult['SYSTEM_PROPERTIES']['TEXT'] = Loc::getMessage('C_MAIN_SPONSOR_TEMP1_CONTENT_TEXT_EMPTY');

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

$logoSource = ArrayHelper::fromRange(['preview', 'detail'], ArrayHelper::getValue($arParams, 'LOGO_SOURCE'));

$arPropertyCodes = [
    'BACKGROUND' => ArrayHelper::getValue($arParams, 'PROPERTY_BACKGROUND'),
    'LINK' => ArrayHelper::getValue($arParams, 'PROPERTY_LINK')
];

$arSystemProperties = [
    'LOGO' => ArrayHelper::getValue($arResult, ['ITEM', strtoupper($logoSource).'_PICTURE']),
    'LINK' => StringHelper::replaceMacros(
        ArrayHelper::getValue($arResult, ['ITEM', 'PROPERTIES', $arPropertyCodes['LINK'], 'VALUE']),
        $arMacros
    ),
    'BACKGROUND' => ArrayHelper::getValue($arResult, ['ITEM', 'PROPERTIES', $arPropertyCodes['BACKGROUND'], 'VALUE'])
];

unset($logoSource);

$arVisual = [
    'THEME' => ArrayHelper::fromRange(['dark', 'light'], ArrayHelper::getValue($arParams, 'THEME')),
    'LOGO' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'LOGO_SHOW') == 'Y' && !empty($arSystemProperties['LOGO']),
        'LINK' => [
            'USE' => false,
            'BLANK' => false
        ]
    ],
    'BACKGROUND' => [
        'USE' => ArrayHelper::getValue($arParams, 'BACKGROUND_USE') == 'Y' &&
            !empty($arSystemProperties['BACKGROUND']) &&
            !empty($arPropertyCodes['BACKGROUND']),
        'PADDING' => StringHelper::replace(ArrayHelper::getValue($arParams, 'BACKGROUND_PADDING'), ['px' => ''])
    ]
];

if (!$arVisual['BACKGROUND']['USE'])
    $arVisual['BACKGROUND']['PADDING'] = null;

if ($arVisual['LOGO']['SHOW']) {
    if (!empty($arPropertyCodes['LINK'])) {
        if (ArrayHelper::getValue($arParams, 'LOGO_LINK_USE') == 'Y') {
            if (!empty($arSystemProperties['LINK'])) {
                $arVisual['LOGO']['LINK']['USE'] = true;

                if (ArrayHelper::getValue($arParams, 'LOGO_LINK_BLANK') == 'Y')
                    $arVisual['LOGO']['LINK']['BLANK'] = true;
            }
        }
    }

    $arPicture = CFile::ResizeImageGet(
        $arSystemProperties['LOGO'],
        [
            'width' => 400,
            'height' => 400
        ],
        BX_RESIZE_IMAGE_PROPORTIONAL_ALT
    );

    $arSystemProperties['LOGO']['SRC'] = $arPicture['src'];

    unset($arPicture);
}

if ($arVisual['BACKGROUND']['USE']) {
    if (!Type::isNumeric($arVisual['BACKGROUND']['PADDING']))
        $arVisual['BACKGROUND']['PADDING'] = null;

    $arPicture = CFile::GetFileArray($arSystemProperties['BACKGROUND']);
    $arPictureSrc = CFile::GetFileSRC($arPicture);

    $arSystemProperties['BACKGROUND'] = $arPicture;
    $arSystemProperties['BACKGROUND']['SRC'] = $arPictureSrc;
}

unset($arPicture, $arPictureSrc);

$arResult['PROPERTY_CODES'] = $arPropertyCodes;
$arResult['SYSTEM_PROPERTIES'] = ArrayHelper::merge($arResult['SYSTEM_PROPERTIES'], $arSystemProperties);
$arResult['VISUAL'] = $arVisual;

unset($arPropertyCodes, $arSystemProperties, $arVisual, $arMacros);