<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use intec\core\collections\Arrays;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

if (!Loader::includeModule('intec.core'))
    return;

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/'
];

/** Выбранные коды свойств инфоблока */
$arResult['PROPERTY_CODES'] += ArrayHelper::merge($arResult['PROPERTY_CODES'], [
    'HEADER_COLOR' => ArrayHelper::getValue($arParams, 'PROPERTY_HEADER_COLOR'),
    'DESCRIPTION_COLOR' => ArrayHelper::getValue($arParams, 'PROPERTY_DESCRIPTION_COLOR'),
    'LINK' => ArrayHelper::getValue($arParams, 'PROPERTY_LINK'),
    'LINK_BLANK' => ArrayHelper::getValue($arParams, 'PROPERTY_LINK_BLANK'),
    'BUTTON_SHOW' => ArrayHelper::getValue($arParams, 'PROPERTY_BUTTON_SHOW'),
    'BUTTON_TEXT' => ArrayHelper::getValue($arParams, 'PROPERTY_BUTTON_TEXT'),
    'BUTTON_TEXT_COLOR' => ArrayHelper::getValue($arParams, 'PROPERTY_BUTTON_TEXT_COLOR'),
    'BUTTON_COLOR' => ArrayHelper::getValue($arParams, 'PROPERTY_BUTTON_COLOR'),
    'BANNER_COLOR' => ArrayHelper::getValue($arParams, 'PROPERTY_BANNER_COLOR'),
    'VIDEO_URL' => ArrayHelper::getValue($arParams, 'PROPERTY_VIDEO_URL')
]);

/** Настройки внешнего вида */
$arVisual = [
    'HEIGHT' => ArrayHelper::getValue($arParams, 'HEIGHT'),
    'SELECTOR' => ArrayHelper::getValue($arParams, 'SELECTOR'),
    'ATTRIBUTE' => ArrayHelper::getValue($arParams, 'ATTRIBUTE'),
    'CLASS' => ArrayHelper::getValue($arParams, 'CLASS'),
    'SLIDER' => [
        'USE' => count($arResult['ITEMS']) > 1,
        'NAV' => ArrayHelper::getValue($arParams, 'SLIDER_NAV') == 'Y',
        'DOTS' => ArrayHelper::getValue($arParams, 'SLIDER_DOTS') == 'Y',
        'LOOP' => ArrayHelper::getValue($arParams, 'SLIDER_LOOP') == 'Y',
        'SPEED' => ArrayHelper::getValue($arParams, 'SLIDER_SPEED'),
        'AUTO' => [
            'USE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_USE') == 'Y',
            'TIME' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_TIME'),
            'PAUSE' => ArrayHelper::getValue($arParams, 'SLIDER_AUTO_PAUSE') == 'Y'
        ]
    ],
    'VIDEO' => [
        'SHADOW' => [
            'USE' => ArrayHelper::getValue($arParams, 'VIDEO_SHADOW_USE') == 'Y',
            'COLOR' => [
                'VALUE' => ArrayHelper::getValue($arParams, 'VIDEO_SHADOW_COLOR'),
                'CUSTOM' => ArrayHelper::getValue($arParams, 'VIDEO_SHADOW_COLOR_CUSTOM'),
            ],
            'OPACITY' => ArrayHelper::getValue($arParams, 'VIDEO_SHADOW_OPACITY')
        ]
    ],
    'BLOCKS' => [
        'SHOW' => true,
        'COUNT' => ArrayHelper::getValue($arParams, 'BLOCKS_COUNT')
    ],
    'WIDE' => ArrayHelper::getValue($arParams, 'WIDE') === 'Y'
];

if (empty($arVisual['HEIGHT']))
    $arVisual['HEIGHT'] = '500';

if (empty($arVisual['SELECTOR']))
    $arVisual['SELECTOR'] = null;

if (empty($arVisual['ATTRIBUTE']))
    $arVisual['ATTRIBUTE'] = null;

if (empty($arVisual['SPEED']))
    $arVisual['SPEED'] = '500';

if (empty($arVisual['SLIDER']['TIME']))
    $arVisual['SLIDER']['TIME'] = '10000';

if ($arVisual['BLOCKS']['COUNT'] < 2)
    $arVisual['BLOCKS']['COUNT'] = 2;

if ($arVisual['BLOCKS']['COUNT'] > 4)
    $arVisual['BLOCKS']['COUNT'] = 4;

$arResult['VISUAL'] = ArrayHelper::merge($arResult['VISUAL'], $arVisual);

foreach ($arResult['ITEMS'] as $sKey => $arItem) {
    /** Обработка выбранных свойств */
    $arCodes = ArrayHelper::getValue($arResult, 'PROPERTY_CODES');

    foreach ($arCodes as $sCode) {
        if (!empty($sCode)) {
            $arProperty = ArrayHelper::getValue($arItem, ['PROPERTIES', $sCode]);

            if (!empty($arProperty)) {
                /** Текстовое поле */
                if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
                    if (Type::isArray($arProperty['VALUE'])) {
                        if (!empty($arProperty['VALUE']['TEXT'])) {
                            if ($arProperty['VALUE']['TYPE'] == 'HTML') {
                                $arProperty['VALUE'] = $arProperty['~VALUE']['TEXT'];
                            } else {
                                $arProperty['VALUE'] = $arProperty['VALUE']['TEXT'];
                            }
                        } else {
                            $arProperty['VALUE'] = null;
                        }

                        $arItem['PROPERTIES'][$sCode] = $arProperty;
                    }
                }

                /** Файл */
                if ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
                    if (!empty($arProperty['VALUE'])) {
                        $arPicture = CFile::ResizeImageGet(
                            $arProperty['VALUE'],
                            array(
                                'width' => 800,
                                'height' => 800
                            ),
                            BX_RESIZE_IMAGE_PROPORTIONAL_ALT
                        );

                        $arProperty['VALUE'] = $arPicture;
                        $arItem['PROPERTIES'][$sCode] = $arProperty;
                    }
                }
            }
        }

        $arResult['ITEMS'][$sKey] = $arItem;
    }
}

$arBlocks = [];

if ($arVisual['BLOCKS']['SHOW'] && !empty($arParams['BLOCKS_IBLOCK_ID'])) {
    $arFiles = [];
    $arBlocks = Arrays::from([]);

    $rsBlocks = CIBlockElement::GetList([
        'SORT' => 'ASC'
    ], [
        'IBLOCK_ID' => $arParams['BLOCKS_IBLOCK_ID'], [
            'LOGIC' => 'OR',
            '!PREVIEW_PICTURE' => false,
            '!DETAIL_PICTURE' => false
        ]
    ], false, [
        'nPageSize' => $arVisual['BLOCKS']['COUNT']
    ]);

    while ($rsBlock = $rsBlocks->GetNextElement()) {
        $arBlock = $rsBlock->GetFields();
        $arBlock['PROPERTIES'] = $rsBlock->GetProperties();
        $arBlocks->set($arBlock['ID'], $arBlock);
    }

    $arBlocks->each(function ($iIndex, &$arBlock) use (&$arFiles, &$arParams, &$arMacros) {
        $arBlock['LINK'] = [
            'USE' => true,
            'VALUE' => null,
            'BLANK' => false
        ];

        $arButtons = CIBlock::GetPanelButtons(
            $arBlock['IBLOCK_ID'],
            $arBlock['ID'],
            $arBlock['SECTION_ID'],
            [
                'SECTION_BUTTONS' => false,
                'SESSID' => false,
                'CATALOG' => true
            ]
        );

        $arBlock['EDIT_LINK'] = $arButtons['edit']['edit_element']['ACTION_URL'];
        $arBlock['DELETE_LINK'] = $arButtons['edit']['delete_element']['ACTION_URL'];

        if (!empty($arBlock['PREVIEW_PICTURE']))
            $arFiles[] = $arBlock['PREVIEW_PICTURE'];

        if (!empty($arBlock['DETAIL_PICTURE']))
            $arFiles[] = $arBlock['DETAIL_PICTURE'];

        if (!empty($arParams['BLOCKS_PROPERTY_LINK']))
            $arBlock['LINK']['VALUE'] = ArrayHelper::getValue($arBlock, ['PROPERTIES', $arParams['BLOCKS_PROPERTY_LINK'], 'VALUE']);

        if (!empty($arParams['BLOCKS_PROPERTY_LINK_BLANK'])) {
            $arBlock['LINK']['BLANK'] = ArrayHelper::getValue($arBlock, ['PROPERTIES', $arParams['BLOCKS_PROPERTY_LINK_BLANK'], 'VALUE_XML_ID']);
            $arBlock['LINK']['BLANK'] = !empty($arBlock['LINK']['BLANK']);
        }

        if (empty($arBlock['LINK']['VALUE'])) {
            $arBlock['LINK']['USE'] = false;
            $arBlock['LINK']['VALUE'] = null;
        } else {
            $arBlock['LINK']['VALUE'] = StringHelper::replaceMacros(
                $arBlock['LINK']['VALUE'],
                $arMacros
            );
        }
    });

    if (!empty($arFiles)) {
        $arFiles = Arrays::fromDBResult(CFile::GetList([], [
            '@ID' => implode(',', $arFiles)
        ]), false, function ($arFile) {
            $arFile['SRC'] = CFile::GetFileSRC($arFile);

            return [
                'value' => $arFile
            ];
        })->indexBy('ID');
    } else {
        $arFiles = Arrays::from([]);
    }

    if (!$arFiles->isEmpty()) {
        $arBlocks->each(function ($iIndex, &$arBlock) use (&$arFiles) {
            if (!empty($arBlock['PREVIEW_PICTURE']))
                $arBlock['PREVIEW_PICTURE'] = $arFiles->get($arBlock['PREVIEW_PICTURE']);

            if (!empty($arBlock['DETAIL_PICTURE']))
                $arBlock['DETAIL_PICTURE'] = $arFiles->get($arBlock['DETAIL_PICTURE']);

            if (!empty($arBlock['PREVIEW_PICTURE'])) {
                $arBlock['PICTURE'] = $arBlock['PREVIEW_PICTURE'];
            } else if (!empty($arBlock['DETAIL_PICTURE'])) {
                $arBlock['PICTURE'] = $arBlock['DETAIL_PICTURE'];
            }
        });
    }

    $arBlocks = $arBlocks->asArray();
}

if (empty($arBlocks))
    $arVisual['BLOCKS']['SHOW'] = false;

$arResult['BLOCKS'] = $arBlocks;