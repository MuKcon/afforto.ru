<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Loader;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;
use intec\constructor\models\Build;


$arResult['PROPERTY_CODES']['VIDEO'] = ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO');
$arResult['PROPERTY_CODES']['DOCUMENT'] = ArrayHelper::getValue($arParams, 'PROPERTY_DOCUMENT');
$arResult['PROPERTY_CODES']['SERVICE'] = ArrayHelper::getValue($arParams, 'PROPERTY_SERVICE');
$arResult['PROPERTY_CODES']['PROJECT'] = ArrayHelper::getValue($arParams, 'PROPERTY_PROJECT');
$arResult['PROPERTY_CODES']['POSITION'] = ArrayHelper::getValue($arParams, 'PROPERTY_POSITION');
$sVideoIBlockType = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_TYPE');
$sVideoIBlock = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_ID');
$sVideoLinkCode = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_PROPERTY_LINK');
$bVideoShow = ArrayHelper::getValue($arParams, 'VIDEO_SHOW');
$bVideoShow = $bVideoShow == 'Y' && !empty($sVideoIBlock) && !empty($sVideoLinkCode);
$bServiceShow = ArrayHelper::getValue($arParams, 'SERVICE_SHOW');
$bProjectShow = ArrayHelper::getValue($arParams, 'PROJECT_SHOW');

/*$arResult['VIEW_PARAMETERS'] = [
    'VIDEO_SHOW' => $bVideoShow,
    'IMAGE_SIZE' => ArrayHelper::getValue($arParams, 'VIDEO_IMAGE_QUALITY')
];*/

foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    $arResult['ELEMENTS'][] = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['VIDEO'], 'VALUE']);
    $arResult['ELEMENTS_SERVICE'][] = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['SERVICE'], 'VALUE']);
    $arResult['ELEMENTS_PROJECT'][] = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['PROJECT'], 'VALUE']);

    $nDocumentId = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['DOCUMENT'], 'VALUE']);
    $arDocuments = CFile::GetFileArray($nDocumentId);
    //$arDocuments = CFile::MakeFileArray($nDocumentId);
    $arResult['ITEMS'][$iKey]['PROPERTIES'][$arResult['PROPERTY_CODES']['DOCUMENT']]['VALUE'] = $arDocuments;
}

/** Обработка услуг **/
if ($bServiceShow){
    $rsService = CIBlockElement::GetList(
        array(),
        array(
            'ID' => $arResult['ELEMENTS_SERVICE']
        )
    );

    while ($arService = $rsService->GetNextElement()) {
        $arFields = $arService->GetFields();
        $arServices[$arFields['ID']]['NAME'] = $arFields['NAME'];
        $arServices[$arFields['ID']]['DETAIL_PAGE_URL'] = $arFields['DETAIL_PAGE_URL'];
    }
}
unset($rsService);

/** Обработка проектов **/
if ($bProjectShow){
    $rsProject = CIBlockElement::GetList(
        array(),
        array(
            'ID' => $arResult['ELEMENTS_PROJECT']
        )
    );

    while ($arProject = $rsProject->GetNextElement()) {
        $arFields = $arProject->GetFields();
        $arProjects[$arFields['ID']]['NAME'] = $arFields['NAME'];
        $arProjects[$arFields['ID']]['DETAIL_PAGE_URL'] = $arFields['DETAIL_PAGE_URL'];
    }
}
unset($rsProject);

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

    /** Вставка ссылок на видео в $arResult */
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

        $sServiceID = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['SERVICE'], 'VALUE']);
        if (!empty($sServiceID)){
            $arResult['ITEMS'][$iKey]['PROPERTIES'][$arResult['PROPERTY_CODES']['SERVICE']]['VALUE'] = $arServices[$sServiceID];
        }

        $sProjectID = ArrayHelper::getValue($arItem, ['PROPERTIES', $arResult['PROPERTY_CODES']['PROJECT'], 'VALUE']);
        if (!empty($sProjectID)){
            $arResult['ITEMS'][$iKey]['PROPERTIES'][$arResult['PROPERTY_CODES']['PROJECT']]['VALUE'] = $arProjects[$sProjectID];
        }
    }
}