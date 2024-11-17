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

if ($arResult['FOOTER_BLOCK']['POSITION'] == 'top-right') {
    $arResult['HEADER_BLOCK']['POSITION'] = $arResult['HEADER_BLOCK']['POSITION'].' right-button';
    $arResult['DESCRIPTION_BLOCK']['POSITION'] = $arResult['DESCRIPTION_BLOCK']['POSITION'].' right-button';
}

/** Коды свойств */
$sPropertyLogotype = ArrayHelper::getValue($arParams, 'PROPERTY_LOGOTYPE');
$sPropertyLink = ArrayHelper::getValue($arParams, 'PROPERTY_LINK');

$arResult['PROPERTY_CODES'] = [
    'POSITION' => ArrayHelper::getValue($arParams, 'PROPERTY_POSITION'),
    'LOGOTYPE' => $sPropertyLogotype,
    'LINK' => $sPropertyLink
];

/** Параметры отображения */
$bPositionShow = ArrayHelper::getValue($arParams, 'POSITION_SHOW');
$bPositionShow = $bPositionShow == 'Y' && !empty($arResult['PROPERTY_CODES']['POSITION']);
$bLogotypeShow = ArrayHelper::getValue($arParams, 'LOGOTYPE_SHOW');
$bLogotypeShow = $bLogotypeShow == 'Y' && !empty($arResult['PROPERTY_CODES']['LOGOTYPE']);
$sSlideTime = ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_TIME');
$sSlideTime = trim($sSlideTime);
$sSlideTime = !empty($sSlideTime) ? $sSlideTime : '10000';
$sSlideSpeed = ArrayHelper::getValue($arParams, 'SLIDER_SLIDE_SPEED');
$sSlideSpeed = trim($sSlideSpeed);
$sSlideSpeed = !empty($sSlideSpeed) ? $sSlideSpeed : '500';

$arResult['VISUAL'] = [
    'COUNTER_SHOW' => ArrayHelper::getValue($arParams, 'COUNTER_SHOW') == 'Y',
    'POSITION_SHOW' => $bPositionShow,
    'LOGOTYPE_SHOW' => $bLogotypeShow,
    'SLIDER' => [
        'LOOP' => ArrayHelper::getValue($arParams, 'SLIDER_LOOP') == 'Y',
        'AUTO_PLAY_USE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_USE') == 'Y',
        'AUTO_PLAY_TIME' => $sSlideTime,
        'SLIDE_SPEED' => $sSlideSpeed,
        'AUTO_PLAY_PAUSE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_PAUSE') == 'Y'
    ]
];

/** Обработка данных */
foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    /** Обработка превью картинок */
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
                'width' => 150,
                'height' => 200
            ),
            BX_RESIZE_IMAGE_EXACT
        );

        $arPreviewPicture['SRC'] = $arPicture['src'];
    } else if (empty($arPreviewPicture) && empty($arDetailPicture)) {
        $arPreviewPicture['SRC'] = $sNoImg;
    }

    $arItem['PREVIEW_PICTURE'] = $arPreviewPicture;

    /** Обработка картинок логотипов */
    $arPropertyLogotype = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyLogotype]);

    if (!empty($arPropertyLogotype)) {
        $arPicture = CFile::ResizeImageGet(
            $arPropertyLogotype['VALUE'],
            array(
                'width' => 150,
                'height' => 150
            ),
            BX_RESIZE_IMAGE_PROPORTIONAL_ALT
        );

        $arPropertyLogotype['VALUE'] = $arPicture['src'];
        $arItem['PROPERTIES'][$sPropertyLogotype] = $arPropertyLogotype;
    }

    /** Обработка ссылок */
    $sLink = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyLink, 'VALUE']);

    if (!empty($sLink)) {
        $sLink = trim($sLink);
        $sLink = StringHelper::replaceMacros($sLink, $arMacros);

        $arItem['PROPERTIES'][$sPropertyLink]['VALUE'] = $sLink;
    }

    /** Обработка текста */
    $sDetailText = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');

    if (!empty($sPreviewText)) {
        $sDetailText = TruncateText($sDetailText, 310);
        $arItem['DETAIL_TEXT'] = $sDetailText;
    }


    $arResult['ITEMS'][$iKey] = $arItem;
}