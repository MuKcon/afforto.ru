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

/** Привязка свойства с видеоотзывом */
$arResult['PROPERTY_CODES']['VIDEO'] = ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO');
$arResult['PROPERTY_CODES']['POSITION'] = ArrayHelper::getValue($arParams, 'PROPERTY_POSITION');

/** Свойства отображения шаблона */
$sLineCount = ArrayHelper::getValue($arParams, 'LINE_COUNT');

if ($sLineCount <= 1)
    $sLineCount = 1;

if ($sLineCount >= 2)
    $sLineCount = 2;

$bSliderUse = ArrayHelper::getValue($arParams, 'SLIDER_USE') == 'Y';
$sVideoIBlockType = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_TYPE');
$sVideoIBlock = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_ID');
$sVideoLinkCode = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_PROPERTY_LINK');
$bVideoShow = ArrayHelper::getValue($arParams, 'VIDEO_SHOW');
$bVideoShow = $bVideoShow == 'Y' && !empty($sVideoIBlock) && !empty($sVideoLinkCode);

$arResult['VISUAL'] = [
    'LINE_COUNT' => $sLineCount,
    'VIDEO' => [
        'SHOW' => $bVideoShow,
        'IMAGE_SIZE' => ArrayHelper::getValue($arParams, 'VIDEO_IMAGE_QUALITY')
    ],
    'SLIDER' => [
        'USE' => $bSliderUse,
        'ITEMS' => $sLineCount,
        'LOOP' => ArrayHelper::getValue($arParams, 'SLIDER_LOOP') == 'Y',
        'AUTO_PLAY_USE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_USE') == 'Y',
        'AUTO_PLAY_TIME' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_TIME', 10000),
        'SLIDE_SPEED' => ArrayHelper::getValue($arParams, 'SLIDER_SLIDE_SPEED', 500),
        'AUTO_PLAY_PAUSE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PLAY_PAUSE') == 'Y'
    ]
];

/** Набор настроек обработки под сетку */
$arParamsForGrid = [
    'picture' => [
        'width' => 265,
        'height' => 265
    ]
];

/** Обработка данных */
foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    $arResult['ELEMENTS'][] = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['VIDEO'], 'VALUE']);

    /** Набор настроек обработки под сетку */
    if ($sLineCount == 1) {
        $arParamsForGrid['intLen'] = 350;
    } else if ($sLineCount == 2) {
        $arParamsForGrid['intLen'] = 120;
    }

    /** Обработка текста */
    $sDetailText = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');
    $sDetailText = TruncateText($sDetailText, $arParamsForGrid['intLen']);

    $arItem['DETAIL_TEXT'] = $sDetailText;

    /** Обработка картинок */
    $arPreviewPicture = ArrayHelper::getValue($arItem, 'PREVIEW_PICTURE');
    $arDetailPicture = ArrayHelper::getValue($arItem, 'DETAIL_PICTURE');
    $sNoImage = SITE_TEMPLATE_PATH.'/images/no-img/noimg_original.jpg';

    if (empty($arPreviewPicture) && !empty($arDetailPicture)) {
        $arPreviewPicture = $arDetailPicture;
    }

    if (!empty($arPreviewPicture)) {
        $arPicture = CFile::ResizeImageGet(
            $arPreviewPicture,
            $arParamsForGrid['picture'],
            BX_RESIZE_IMAGE_PROPORTIONAL_ALT
        );
        $arPreviewPicture['SRC'] = $arPicture['src'];
    } else if (empty($arPreviewPicture)) {
        $arPreviewPicture['SRC'] = $sNoImage;
    }

    $arItem['PREVIEW_PICTURE'] = $arPreviewPicture;


    $arResult['ITEMS'][$iKey] = $arItem;
}

/** Обработка видео */
if ($bVideoShow) {
    $sImageUseCode = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_PROPERTY_IMAGE_USE');
    $arVideos = [];
    $arImages = [];
    $arImageUse = [];

    $rsVideos = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_TYPE' => $sVideoIBlockType,
            'IBLOCK_ID' => $sVideoIBlock,
            'ID' => $arResult['ELEMENTS']
        )
    );

    while ($arVideo = $rsVideos->GetNextElement()) {
        $arFields = $arVideo->GetFields();
        $arProperties = $arVideo->GetProperties();
        $arVideos[$arFields['ID']] = ArrayHelper::getValue($arProperties, [$sVideoLinkCode, 'VALUE']);

        if (!empty($sImageUseCode)) {
            $arImageUse[$arFields['ID']] = ArrayHelper::getValue($arProperties, [$sImageUseCode, 'VALUE']) == 'Y';
            $arVideoPreviewPicture = ArrayHelper::getValue($arFields, 'PREVIEW_PICTURE');
            $arVideoDetailPicture = ArrayHelper::getValue($arFields, 'DETAIL_PICTURE');

            if (empty($arPreviewPicture) && !empty($arDetailPicture)) {
                $arVideoPreviewPicture = $arVideoDetailPicture;
            }

            if (!empty($arPreviewPicture)) {
                $arVideoPicture = CFile::ResizeImageGet(
                    $arVideoPreviewPicture,
                    $arParamsForGrid['picture'],
                    BX_RESIZE_IMAGE_PROPORTIONAL_ALT
                );

                $arVideoPreviewPicture = $arVideoPicture['src'];
            }

            $arImages[$arFields['ID']] = $arVideoPreviewPicture;
        }
    }

    unset($rsVideos);

    /** Вставка ссылок на видео в $arResult
     * @param $url
     * @return array
     */
    $youtube = function ($url) {
        $arrUrl = parse_url($url);

        if (isset($arrUrl['query'])) {
            $arrUrlGet = explode('&', $arrUrl['query']);
            foreach ($arrUrlGet as $value) {
                $arrGetParam = explode('=', $value);
                if (!strcmp(array_shift($arrGetParam), 'v')) {
                    $videoID = array_pop($arrGetParam);
                    break;
                }
            }
            if (empty($videoID)) {
                $videoID = array_pop(explode('/', $arrUrl['path']));
            }
        } else {
            $videoID = array_pop(explode('/', $url));
        }

        return array(
            'iframe' => 'https://www.youtube.com/embed/'.$videoID,
            'src' => 'https://www.youtube.com/watch?v='.$videoID,
            'sddefault' => 'https://img.youtube.com/vi/'.$videoID.'/sddefault.jpg',
            'mqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg',
            'hqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/hqdefault.jpg',
            'maxresdefault' => 'https://img.youtube.com/vi/'.$videoID.'/maxresdefault.jpg',
            'id' => $videoID
        );
    };

    foreach ($arResult['ITEMS'] as $iKey => $arItem) {
        $sVideoID = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['VIDEO'], 'VALUE']);
        if (!empty($sVideoID)) {
            if (!Type::isArray($arVideos[$sVideoID]))
                $arVideos[$sVideoID] = $youtube($arVideos[$sVideoID]);

            if (!empty($sImageUseCode) && $arImageUse[$sVideoID] && !empty($arImages[$sVideoID])) {
                $arVideos[$sVideoID]['sddefault'] = $arImages[$sVideoID];
                $arVideos[$sVideoID]['mqdefault'] = $arImages[$sVideoID];
                $arVideos[$sVideoID]['hqdefault'] = $arImages[$sVideoID];
                $arVideos[$sVideoID]['maxresdefault'] = $arImages[$sVideoID];
            }

            $arResult['ITEMS'][$iKey]['PROPERTIES'][$arResult['PROPERTY_CODES']['VIDEO']]['VALUE'] = $arVideos[$sVideoID];
        }
    }
}