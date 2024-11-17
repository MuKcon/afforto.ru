<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;

/**
 * @var array $arResult
 * @var array $arParams
 */

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

/** Коды свойств инфоблоков */
$arResult['PROPERTY_CODES'] = [
    'POSITION' => ArrayHelper::getValue($arParams, 'PROPERTY_POSITION')
];

/** Параметры отображения */
$sSlideTime = ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_TIME');
$sSlideTime = trim($sSlideTime);
$sSlideTime = !empty($sSlideTime) ? $sSlideTime : '10000';
$sSlideSpeed = ArrayHelper::getValue($arParams, 'SLIDER_SLIDE_SPEED');
$sSlideSpeed = trim($sSlideSpeed);
$sSlideSpeed = !empty($sSlideSpeed) ? $sSlideSpeed : '500';

$arResult['VISUAL'] = [
    'POSITION_SHOW' => ArrayHelper::getValue($arParams, 'POSITION_SHOW') == 'Y',
    'SLIDER' => [
        'LOOP' => ArrayHelper::getValue($arParams, 'SLIDER_LOOP') == 'Y',
        'AUTO_PLAY_USE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_USE') == 'Y',
        'AUTO_PLAY_TIME' => $sSlideTime,
        'SLIDE_SPEED' => $sSlideSpeed,
        'AUTO_PLAY_PAUSE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_PAUSE') == 'Y'
    ]
];

/** Настройки кнопки "Показать все" */
$sFooterText = ArrayHelper::getValue($arParams, 'FOOTER_TEXT');
$sFooterText = trim($sFooterText);
$sFooterText = StringHelper::replaceMacros($sFooterText, $arMacros);
$sListPage = ArrayHelper::getValue($arParams, 'LIST_PAGE');
$sListPage = trim($sListPage);
$sListPage = StringHelper::replaceMacros($sListPage, $arMacros);
$bFooterShow = ArrayHelper::getValue($arParams, 'FOOTER_SHOW');
$bFooterShow = $bFooterShow == 'Y' && !empty($sFooterText) && !empty($sListPage);

$arResult['FOOTER_BLOCK'] = [
    'SHOW' => $bFooterShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'FOOTER_POSITION'),
    'TEXT' => Html::encode($sFooterText),
    'LIST_PAGE' => $sListPage
];

/** Обработка данных */
foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    /** Обработка картинок */
    $arPreviewPicture = ArrayHelper::getValue($arItem, 'PREVIEW_PICTURE');
    $arDetailPicture = ArrayHelper::getValue($arItem, 'DETAIL_PICTURE');
    $sNoImg = SITE_TEMPLATE_PATH.'/images/no-img/noimg_original.jpg';

    if (empty($arPreviewPicture) && !empty($arDetailPicture)) {
        $arPreviewPicture = $arDetailPicture;
    }

    if (!empty($arPreviewPicture)) {
        $arPicture = CFile::ResizeImageGet(
            $arPreviewPicture,
            array(
                'width' => 100,
                'height' => 100
            ),
            BX_RESIZE_IMAGE_EXACT
        );

        $arPreviewPicture['SRC'] = $arPicture['src'];
    } else if (empty($arPreviewPicture) && empty($arDetailPicture)) {
        $arPreviewPicture['SRC'] = $sNoImg;
    }

    $arItem['PREVIEW_PICTURE'] = $arPreviewPicture;

    /** Обработка текста */
    $sPreviewText = ArrayHelper::getValue($arItem, 'PREVIEW_TEXT');
    $sDetailText = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');

    if (empty($sDetailText) && !empty($sPreviewText)) {
        $sDetailText = $sPreviewText;
    }

    $sDetailText = TruncateText($sDetailText, 400);
    $arItem['DETAIL_TEXT'] = $sDetailText;

    $arResult['ITEMS'][$iKey] = $arItem;
}