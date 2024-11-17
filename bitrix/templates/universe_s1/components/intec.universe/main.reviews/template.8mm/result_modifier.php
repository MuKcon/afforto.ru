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

$arCodes = [
    'POSITION' => ArrayHelper::getValue($arParams, 'PROPERTY_POSITION'),
    'SERVICES' => ArrayHelper::getValue($arParams, 'PROPERTY_SERVICES'),
    'PROJECTS' => ArrayHelper::getValue($arParams, 'PROPERTY_PROJECTS'),
    'PICTURE' => ArrayHelper::getValue($arParams, 'PROPERTY_PICTURE'),
    'VIDEO' => ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO'),
    'VIDEO_URL' => ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO_URL'),
    'VIDEO_IMAGE_USE' => ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO_IMAGE_USE')
];

$arResult['PROPERTY_CODES'] = $arCodes;

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

$arQuality = [
    'sddefault',
    'maxresdefault',
    'hqdefault',
    'mqdefault'
];

$arResult['VISUAL'] = [
    'POSITION' => [
        'SHOW' => ArrayHelper::getValue($arParams, 'POSITION_SHOW') == 'Y'
    ],
    'SERVICES' => [
        'SHOW' => false
    ],
    'PROJECTS' => [
        'SHOW' => false
    ],
    'PICTURE' => [
        'SHOW' => false
    ],
    'VIDEO' => [
        'SHOW' => false,
        'QUALITY' => ArrayHelper::fromRange($arQuality, ArrayHelper::getValue($arParams, 'VIDEO_QUALITY'))
    ]
];

/** Обработка данных */
$sNoImg = SITE_TEMPLATE_PATH.'/images/noimg/no-img_minquadro.jpg';
$arAdditional = [
    'video' => [],
    'services' => [],
    'projects' => [],
    'documents' => []
];

foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    /** Получение ключей доп. элементов */
    $getAdditional = function ($property) use ($arItem) {
        if (!empty($property)) {
            $value = ArrayHelper::getValue($arItem, ['PROPERTIES', $property, 'VALUE']);

            if (!empty($value))
                return [$value => $value];
        }

        return null;
    };

    $arAdditional['video'] = ArrayHelper::merge($arAdditional['video'], $getAdditional($arCodes['VIDEO']));
    $arAdditional['services'] = ArrayHelper::merge($arAdditional['services'], $getAdditional($arCodes['SERVICES']));
    $arAdditional['projects'] = ArrayHelper::merge($arAdditional['projects'], $getAdditional($arCodes['PROJECTS']));
    $arAdditional['documents'] = ArrayHelper::merge($arAdditional['documents'], $getAdditional($arCodes['PICTURE']));

    /** Обработка изображений */
    $arPreviewPicture = $arItem['PREVIEW_PICTURE'];
    $arDetailPicture = $arItem['DETAIL_PICTURE'];

    if (empty($arPreviewPicture) && !empty($arDetailPicture))
        $arPreviewPicture = $arDetailPicture;

    if (!empty($arPreviewPicture)) {
        $arPictureResize = CFile::ResizeImageGet(
            $arPreviewPicture,
            array(
                'width' => 120,
                'height' => 120
            ),
            BX_RESIZE_IMAGE_EXACT
        );

        $arItem['PREVIEW_PICTURE']['SRC'] = $arPictureResize['src'];
    } else {
        $arItem['PREVIEW_PICTURE']['SRC'] = $sNoImg;
    }

    $arResult['ITEMS'][$iKey] = $arItem;
}

/** Получение и обработка доп. элементов */
$getElements = function ($iblock, $elements, $iblockType = null) {
    $values = [];

    if (!empty($iblock && $elements)) {
        $arFilter = [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $iblock,
            'ID' => $elements
        ];

        if (!empty($iblockType))
            $arFilter['IBLOCK_TYPE'] = $iblockType;

        $rawValues = CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            $arFilter
        );
        $rawValues->SetUrlTemplates();

        if (empty($iblockType)) {
            while ($value = $rawValues->GetNext()) {
                $values[$value['ID']] = $value;
            }
        } else {
            while ($value = $rawValues->GetNextElement()) {
                $valueTemp = $value->GetFields();
                $valueTemp['PROPERTIES'] = $value->GetProperties();

                $values[$valueTemp['ID']] = $valueTemp;
            }
        }
    }

    return $values;
};

if (!empty($arCodes['SERVICES']) && !empty($arParams['SERVICES_IBLOCK_ID']) && $arParams['SERVICES_SHOW'] == 'Y') {
    $arAdditional['services'] = array_filter($arAdditional['services']);

    if (!empty($arAdditional['services'])) {
        $arServices = $getElements($arParams['SERVICES_IBLOCK_ID'], $arAdditional['services']);
        $arResult['VISUAL']['SERVICES']['SHOW'] = true;
    }
}

if (!empty($arCodes['PROJECTS']) && !empty($arParams['PROJECTS_IBLOCK_ID']) && $arParams['PROJECTS_SHOW'] == 'Y') {
    $arAdditional['projects'] = array_filter($arAdditional['projects']);

    if (!empty($arAdditional['projects'])) {
        $arProjects = $getElements($arParams['PROJECTS_IBLOCK_ID'], $arAdditional['projects']);
        $arResult['VISUAL']['PROJECTS']['SHOW'] = true;
    }
}

if (!empty($arCodes['VIDEO']) && !empty($arParams['VIDEO_IBLOCK_ID']) && !empty($arCodes['VIDEO_URL'] && $arParams['VIDEO_SHOW'] == 'Y')) {
    $arAdditional['video'] = array_filter($arAdditional['video']);

    if (!empty($arAdditional['video'])) {
        $arVideo = $getElements($arParams['VIDEO_IBLOCK_ID'], $arAdditional['video'], $arParams['VIDEO_IBLOCK_TYPE']);

        foreach ($arVideo as $iKey => $arItem) {
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
                    'mqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg',
                    'hqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/hqdefault.jpg',
                    'sddefault' => 'https://img.youtube.com/vi/'.$videoID.'/sddefault.jpg',
                    'maxresdefault' => 'https://img.youtube.com/vi/'.$videoID.'/maxresdefault.jpg',
                    'id' => $videoID
                );
            };

            $sUrl = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO_URL'], 'VALUE']);
            $bImageUse = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO_IMAGE_USE'], 'VALUE']) == 'Y';
            $arYoutube = [];

            if ($sUrl) {
                $arYoutube = $youtube($sUrl);
                $arItem['PROPERTIES'][$arCodes['VIDEO_URL']]['VALUE'] = $arYoutube['iframe'];
            }

            if (!$bImageUse && !empty($sUrl)) {
                $arItem['PREVIEW_PICTURE'] = $arYoutube[$arResult['VISUAL']['VIDEO']['QUALITY']];
            } else if ($bImageUse && !empty($arItem['PREVIEW_PICTURE'])) {
                $arPicture = CFile::ResizeImageGet(
                    $arItem['PREVIEW_PICTURE'],
                    [
                        'width' => 250,
                        'height' => 250
                    ],
                    BX_RESIZE_IMAGE_PROPORTIONAL_ALT
                );

                $arItem['PREVIEW_PICTURE'] = $arPicture['src'];
            }

            $arVideo[$iKey] = $arItem;
        }

        $arResult['VISUAL']['VIDEO']['SHOW'] = true;
    }
}

if (!empty($arCodes['PICTURE']) && $arParams['PICTURE_SHOW'] == 'Y') {
    $arAdditional['documents'] = array_filter($arAdditional['documents']);

    if (!empty($arAdditional['documents'])) {
        $arAdditional['documents'] = implode(',', $arAdditional['documents']);
        $rsPictures = CFile::GetList(['SORT' => 'ASC'], ['@ID' => $arAdditional['documents']]);

        while ($arPictureTemp = $rsPictures->Fetch()) {
            $arPictures[$arPictureTemp['ID']] = $arPictureTemp;
        }

        foreach ($arPictures as $iKey => $arPicture) {
            $arPicture['SRC'] = CFile::GetFileSRC($arPicture);
            $arPictureResize = CFile::ResizeImageGet(
                $arPicture,
                [
                    'width' => 350,
                    'height' => 350
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL_ALT
            );

            $arPictures[$iKey]['SRC'] = $arPicture['SRC'];
            $arPictures[$iKey]['SRC_SMALL'] = $arPictureResize['src'];
        }

        $arResult['VISUAL']['PICTURE']['SHOW'] = true;
    }
}

/** Добавление элементов в результирующий массив */
foreach ($arResult['ITEMS'] as $iKey => $arItem) {
    if ($arResult['VISUAL']['SERVICES']['SHOW']) {
        $service = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['SERVICES'], 'VALUE']);
        $serviceValue = ArrayHelper::getValue($arServices, $service);

        if (!empty($serviceValue))
            $arItem['PROPERTIES'][$arCodes['SERVICES']]['VALUE'] = $serviceValue;
    }

    if ($arResult['VISUAL']['PROJECTS']['SHOW']) {
        $project = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PROJECTS'], 'VALUE']);
        $projectValue = ArrayHelper::getValue($arProjects, $project);

        if (!empty($projectValue))
            $arItem['PROPERTIES'][$arCodes['PROJECTS']]['VALUE'] = $projectValue;
    }

    if ($arResult['VISUAL']['VIDEO']['SHOW']) {
        $video = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO'], 'VALUE']);
        $videoValue = ArrayHelper::getValue($arVideo, $video);

        if (!empty($videoValue))
            $arItem['PROPERTIES'][$arCodes['VIDEO']]['VALUE'] = $videoValue;
    }

    if ($arResult['VISUAL']['PICTURE']['SHOW']) {
        $picture = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PICTURE'], 'VALUE']);
        $pictureValue = ArrayHelper::getValue($arPictures, $picture);

        if (!empty($pictureValue))
            $arItem['PROPERTIES'][$arCodes['PICTURE']]['VALUE'] = $pictureValue;
    }

    $arResult['ITEMS'][$iKey] = $arItem;
}