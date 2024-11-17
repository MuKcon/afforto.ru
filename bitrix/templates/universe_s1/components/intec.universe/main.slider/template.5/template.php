<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;

/**
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 */

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arVisual = $arResult['VISUAL'];
$arCodes = $arResult['PROPERTY_CODES'];

?>
<?= Html::beginTag('div', [
    'id' => $sTemplateId,
    'class' => [
        'widget',
        'c-slider',
        'c-slider-template-5'
    ],
    'data' => [
        'blocks' => $arVisual['BLOCKS']['SHOW'] ? 'true' : 'false',
        'wide' => $arVisual['WIDE'] ? 'true' : 'false'
    ]
]) ?>
    <div class="widget-content">
        <div class="intec-content-wrap widget-content-wrapper">
            <?php if (!$arVisual['WIDE']) { ?>
                <?= Html::beginTag('div', ['class' => [
                    'widget-content-wrapper-2',
                    'intec-content'
                ]]) ?>
                <?= Html::beginTag('div', ['class' => [
                    'widget-content-wrapper-3',
                    'intec-content-wrapper'
                ]]) ?>
            <?php } ?>
            <div class="<?= Html::cssClassFromArray([
                'widget-slides' => true,
                'widget-slides-nav' => $arVisual['SLIDER']['NAV'],
                'owl-carousel' => $arVisual['SLIDER']['USE']
            ], true) ?>">
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $arSlide = [
                        'BACKGROUND' => ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']),
                        'COLOR' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['BANNER_COLOR'], 'VALUE_XML_ID'])
                    ];

                    if (empty($arSlide['POSITION']))
                        $arSlide['POSITION'] = 'left';

                    $arHeader = [
                        'TEXT' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['HEADER'], 'VALUE']),
                        'COLOR' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['HEADER_COLOR'], 'VALUE'])
                    ];

                    if (empty($arHeader['COLOR']))
                        $arHeader['COLOR'] = null;

                    $arDescription = [
                        'TEXT' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DESCRIPTION'], 'VALUE']),
                        'COLOR' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DESCRIPTION_COLOR'], 'VALUE'])
                    ];

                    if (empty($arDescription['COLOR']))
                        $arDescription['COLOR'] = null;

                    $arLink = [
                        'VALUE' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['LINK'], 'VALUE']),
                        'BLANK' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['LINK_BLANK'], 'VALUE']) == 'Y'
                    ];

                    if (!empty($arLink['VALUE']))
                        $arLink['VALUE'] = StringHelper::replaceMacros($arLink['VALUE'], ['SITE_DIR' => SITE_DIR]);

                    $arButton = [
                        'SHOW' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['BUTTON_SHOW'], 'VALUE']) == 'Y',
                        'COLOR' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['BUTTON_COLOR'], 'VALUE']),
                        'TEXT' => [
                            'VALUE' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['BUTTON_TEXT'], 'VALUE']),
                            'COLOR' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['BUTTON_TEXT_COLOR'], 'VALUE'])
                        ]
                    ];

                    if (!$arButton['SHOW'] && !empty($arLink['VALUE']))
                        $arSlide['TAG'] = 'a';

                    if (empty($arButton['COLOR']))
                        $arButton['COLOR'] = null;

                    if (empty($arButton['TEXT']['VALUE']))
                        $arButton['TEXT']['VALUE'] = Loc::getMessage('C_SLIDER_TEMP2_BUTTON_TEXT_DEFAULT');

                    if (empty($arButton['TEXT']['COLOR']))
                        $arButton['TEXT']['COLOR'] = null;

                    $arVideo = [
                        'SHOW' => false,
                        'URL' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO_URL'], 'VALUE'])
                    ];

                    $arVideo['SHOW'] = !empty($arVideo['URL']);
                ?>
                    <?= Html::beginTag('div', [ /** Главный тег элемента */
                        'class' => Html::cssClassFromArray([
                            'widget-slide' => [
                                '' => true,
                                'video' => $arVideo['SHOW'],
                            ]
                        ], true),
                        'data-color' => $arSlide['COLOR'],
                        'style' => [
                            'height' => $arVisual['HEIGHT'].'px',
                            'background-image' => 'url('.$arSlide['BACKGROUND'].')'
                        ]
                    ]) ?>
                        <?php if ($arVideo['SHOW']) { ?>
                            <div class="widget-slide-video-wrap">
                                <?php $APPLICATION->IncludeComponent(
                                    'intec.universe:system.video.frame',
                                    '.default',
                                    array(
                                        'URL' => $arVideo['URL'],
                                        'SHADOW_USE' => $arVisual['VIDEO']['SHADOW']['USE'] ? 'Y' : 'N',
                                        'SHADOW_COLOR' => $arVisual['VIDEO']['SHADOW']['COLOR']['VALUE'],
                                        'SHADOW_COLOR_CUSTOM' => $arVisual['VIDEO']['SHADOW']['COLOR']['CUSTOM'],
                                        'SHADOW_OPACITY' => $arVisual['VIDEO']['SHADOW']['OPACITY']
                                    ),
                                    $component
                                ) ?>
                            </div>
                        <?php } ?>
                        <div class="widget-slide-wrapper">
                            <div class="widget-slide-wrapper-2 intec-content intec-content-primary">
                                <div class="widget-slide-wrapper-3 intec-content-wrapper">
                                    <div class="widget-slide-content" id="<?= $sAreaId ?>">
                                        <div class="widget-slide-text">
                                            <div class="widget-slide-text-wrapper">
                                                <?php if ($arVisual['HEADER']['SHOW'] && !empty($arHeader['TEXT'])) { ?>
                                                    <div class="widget-slide-text-header">
                                                        <?= Html::tag('div', $arHeader['TEXT'], [
                                                            'style' => ['color' => $arHeader['COLOR']]
                                                        ]) ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($arVisual['DESCRIPTION']['SHOW'] && !empty($arDescription['TEXT'])) { ?>
                                                    <div class="widget-slide-text-description">
                                                        <?= Html::tag('div', $arDescription['TEXT'], [
                                                            'style' => ['color' => $arDescription['COLOR']]
                                                        ]) ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($arButton['SHOW'] && !empty($arLink['VALUE'])) { ?>
                                                    <div class="widget-slide-button-wrap">
                                                        <?= Html::tag('a', $arButton['TEXT']['VALUE'], [ /** Кнопка баннера */
                                                            'class' => Html::cssClassFromArray([
                                                                'widget-slide-button' => true,
                                                                'intec-cl-background' => empty($arButton['COLOR']),
                                                                'intec-cl-background-light-hover' => empty($arButton['COLOR'])
                                                            ], true),
                                                            'href' => $arLink['VALUE'],
                                                            'target' => $arLink['BLANK'] ? '_blank' : null,
                                                            'style' => [
                                                                'background' => $arButton['COLOR'],
                                                                'color' => $arButton['TEXT']['COLOR']
                                                            ]
                                                        ]) ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?= Html::endTag('div') ?>
                <?php } ?>
            </div>
            <?php if ($arVisual['BLOCKS']['SHOW']) { ?>
                <div class="widget-blocks" data-count="<?= $arVisual['BLOCKS']['COUNT'] ?>">
                    <?php foreach ($arResult['BLOCKS'] as $arBlock) { ?>
                    <?php
                        $sId = $sTemplateId.'_block_'.$arBlock['ID'];
                        $sAreaId = $this->GetEditAreaId($sId);
                        $this->AddEditAction($sId, $arBlock['EDIT_LINK']);
                        $this->AddDeleteAction($sId, $arBlock['DELETE_LINK']);

                        $sTag = 'div';
                        $arLink = $arBlock['LINK'];

                        if ($arLink['USE'])
                            $sTag = 'a';
                    ?>
                        <?= Html::beginTag($sTag, [
                            'id' => $sAreaId,
                            'href' => $arLink['USE'] ? $arLink['VALUE'] : null,
                            'target' => $arLink['USE'] && $arLink['BLANK'] ? '_blank' : null,
                            'class' => 'widget-block'
                        ]) ?>
                            <div class="widget-block-background" style="background-image: url('<?= $arBlock['PICTURE']['SRC'] ?>')"></div>
                            <div class="widget-block-overlay"></div>
                            <div class="widget-block-information">
                                <div class="widget-block-name">
                                    <?= $arBlock['NAME'] ?>
                                </div>
                                <?php if (!empty($arBlock['PREVIEW_TEXT'])) { ?>
                                    <div class="widget-block-description">
                                        <?= $arBlock['PREVIEW_TEXT'] ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?= Html::endTag($sTag) ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if (!$arVisual['WIDE']) { ?>
                <?= Html::endTag('div') ?>
                <?= Html::endTag('div') ?>
            <?php } ?>
        </div>
    </div>
<?= Html::endTag('div') ?>
<?php include(__DIR__.'/parts/script.php') ?>
