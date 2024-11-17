<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

$arResult['PROPERTY_CODES'] = [
    'POSITION' => ArrayHelper::getValue($arParams, 'PROPERTY_POSITION')
];

$sFooterPosition = ArrayHelper::getValue($arParams, 'FOOTER_POSITION');
$sFooterText = ArrayHelper::getValue($arParams, 'FOOTER_TEXT');
$sFooterText = trim($sFooterText);
$sListPage = ArrayHelper::getValue($arParams, 'LIST_PAGE');
$sListPage = StringHelper::replaceMacros($sListPage, $arMacros);
$bFooterShow = ArrayHelper::getValue($arParams, 'FOOTER_SHOW') == 'Y';
$bFooterShow = $bFooterShow && !empty($sFooterText) && !empty($sListPage);

$arResult['FOOTER_BLOCK'] = [
    'SHOW' => $bFooterShow,
    'POSITION' => ArrayHelper::fromRange(['center', 'left', 'right'], $sFooterPosition),
    'TEXT' => Html::encode($sFooterText),
    'LIST_PAGE' => $sListPage
];

$sLineCount = ArrayHelper::getValue($arParams, 'LINE_COUNT');
$iTruncate = ArrayHelper::getValue($arParams, 'TRUNCATE');

if (!Type::isNumeric($iTruncate) || $iTruncate < 1)
    $iTruncate = null;

$arResult['VISUAL'] = [
    'LINE_COUNT' => ArrayHelper::fromRange([2, 1], $sLineCount),
    'POSITION' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'POSITION_SHOW') == 'Y'
    ],
    'TRUNCATE' => $iTruncate
];


$sNoImg = SITE_TEMPLATE_PATH.'/images/noimg/no-img_minquadro.jpg';

foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    /** Обработка изображений */
    $arPreviewPicture = $arItem['PREVIEW_PICTURE'];
    $arDetailPicture = $arItem['DETAIL_PICTURE'];

    if (empty($arPreviewPicture) && !empty($arDetailPicture))
        $arPreviewPicture = $arDetailPicture;

    if (!empty($arPreviewPicture)) {
        $arPictureResize = CFile::ResizeImageGet(
            $arPreviewPicture,
            array(
                'width' => 150,
                'height' => 150
            ),
            BX_RESIZE_IMAGE_EXACT
        );

        $arItem['PREVIEW_PICTURE']['SRC'] = $arPictureResize['src'];
    } else {
        $arItem['PREVIEW_PICTURE']['SRC'] = $sNoImg;
    }

    $arResult['ITEMS'][$iKey] = $arItem;
}