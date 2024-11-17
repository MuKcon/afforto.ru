<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;

/**
 * @var array $arResult
 */

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arHeader = $arResult['HEADER_BLOCK'];
$arDescription = $arResult['DESCRIPTION_BLOCK'];
$arFooter = $arResult['FOOTER_BLOCK'];
$arVisual = $arResult['VISUAL'];
$arCodes = $arResult['PROPERTY_CODES'];

?>
<div class="intec-content intec-content-visible">
    <div class="intec-content-wrapper">
        <div class="widget c-reviews c-reviews-template-7" id="<?= $sTemplateId ?>">
            <?php if ($arHeader['SHOW'] || $arDescription['SHOW']) { ?>
                <div class="widget-header">
                    <?php if ($arHeader['SHOW']) { ?>
                        <div class="widget-title align-<?= $arHeader['POSITION'] ?>">
                            <?= $arHeader['TEXT'] ?>
                        </div>
                    <?php } ?>
                    <?php if ($arDescription['SHOW']) { ?>
                        <div class="widget-description align-<?= $arDescription['POSITION'] ?>">
                            <?= $arDescription['TEXT'] ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?= Html::beginTag('div', [
                'class' => [
                    'widget-content'
                ]
            ]) ?>
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $sPreviewPicture = $arItem['PREVIEW_PICTURE']['SRC'];
                    $sVideoPicture = null;
                    $arService = null;
                    $arProject = null;
                    $arVideo = null;

                    if (!empty($arCodes['POSITION'])) {
                        $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                    } else {
                        $sPosition = $arItem['PREVIEW_TEXT'];
                    }

                    if ($arVisual['SERVICES']['SHOW']) {
                        $arService = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['SERVICES'], 'VALUE']);
                    }

                    if ($arVisual['PROJECTS']['SHOW']) {
                        $arProject = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PROJECTS'], 'VALUE']);
                    }

                    if ($arVisual['VIDEO']['SHOW']) {
                        $arVideo = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO'], 'VALUE']);
                        $sVideoPicture = $arVideo['PREVIEW_PICTURE'];
                    }

                    if ($arVisual['PICTURE']['SHOW']) {
                        $arPicture = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PICTURE'], 'VALUE']);
                    }

                ?>
                    <?= Html::beginTag('div', [
                        'id' => $sAreaId,
                        'class' => Html::cssClassFromArray([
                            'widget-element-wrap' => [
                                '' => true,
                                'documents' => !empty($arVideo) || !empty($arPicture)
                            ]
                        ], true)
                    ]) ?>
                        <div class="widget-element intec-grid intec-grid-wrap">
                            <div class="widget-element-picture-wrap intec-grid-item-auto intec-grid-item-720-1">
                                <?= Html::tag('div', '', [
                                    'class' => 'widget-element-picture',
                                    'style' => [
                                        'background-image' => 'url('.$sPreviewPicture.')'
                                    ]
                                ]) ?>
                            </div>
                            <div class="widget-element-info intec-grid-item intec-grid-item-600-1">
                                <div class="widget-element-name intec-cl-text">
                                    <?= $arItem['NAME'] ?>
                                </div>
                                <?php if ($arVisual['POSITION']['SHOW'] && !empty($sPosition)) { ?>
                                    <div class="widget-element-position">
                                        <?= $sPosition ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($arService) || !empty($arProject)) { ?>
                                    <div class="widget-element-additional">
                                        <?php if (!empty($arService)) { ?>
                                            <div class="widget-element-additional-element">
                                                <span class="widget-element-additional-name">
                                                    <?= Loc::getMessage('C_REVIEWS_TEMP8_SERVICE_TEXT') ?>
                                                </span>
                                                <a class="widget-element-additional-value" href="<?= $arService['DETAIL_PAGE_URL'] ?>" target="_blank">
                                                    <?= $arService['NAME'] ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <?php if (!empty($arProject)) { ?>
                                            <div class="widget-element-additional-element">
                                                <span class="widget-element-additional-name">
                                                    <?= Loc::getMessage('C_REVIEWS_TEMP8_PROJECT_TEXT') ?>
                                                </span>
                                                <a class="widget-element-additional-value" href="<?= $arProject['DETAIL_PAGE_URL'] ?>" target="_blank">
                                                    <?= $arProject['NAME'] ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="widget-element-text">
                                    <?= $arItem['DETAIL_TEXT'] ?>
                                </div>
                            </div>
                            <?php if (!empty($arVideo) || !empty($arPicture)) { ?>
                                <div class="widget-element-document intec-grid-item-auto intec-grid-item-600-1">
                                    <?php if (!empty($arVideo)) { ?>
                                        <div class="widget-element-video">
                                            <?= Html::beginTag('div', [
                                                'class' => 'widget-element-video-picture',
                                                'style' => [
                                                    'background-image' => 'url('.$sVideoPicture.')'
                                                ],
                                                'data-src' => $arVideo['PROPERTIES'][$arCodes['VIDEO_URL']]['VALUE']
                                            ]) ?>
                                                <div class="widget-element-video-icon-wrap">
                                                    <svg class="widget-element-video-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M216 354.9V157.1c0-10.7 13-16.1 20.5-8.5l98.3 98.9c4.7 4.7 4.7 12.2 0 16.9l-98.3 98.9c-7.5 7.7-20.5 2.3-20.5-8.4zM256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm0 48C145.5 56 56 145.5 56 256s89.5 200 200 200 200-89.5 200-200S366.5 56 256 56z"></path>
                                                    </svg>
                                                </div>
                                            <?= Html::endTag('div') ?>
                                        </div>
                                    <?php } else if (!empty($arPicture)) { ?>
                                        <div class="widget-element-add-picture-wrap">
                                            <?= Html::tag('div', '', [
                                                'class' => 'widget-element-add-picture',
                                                'style' => [
                                                    'background-image' => 'url('.$arPicture['SRC_SMALL'].')'
                                                ],
                                                'data-src' => $arPicture['SRC']
                                            ]) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?= Html::endTag('div') ?>
                <?php } ?>
            <?= Html::endTag('div') ?>
            <?php if ($arFooter['SHOW']) { ?>
                <div class="widget-footer align-<?= $arFooter['POSITION'] ?>">
                    <a class="widget-footer-all intec-cl-border intec-cl-background-hover" href="<?= $arFooter['LIST_PAGE'] ?>">
                        <?= $arFooter['TEXT'] ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php if ($arVisual['VIDEO']['SHOW'] || $arVisual['PICTURE']['SHOW']) { ?>
            <script>
                (function ($, api) {
                    var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);

                    <?php if ($arVisual['VIDEO']['SHOW']) { ?>
                        $('.widget-content', root).lightGallery({
                            selector: '.widget-element-video-picture'
                        });
                    <?php } ?>
                    <?php if ($arVisual['PICTURE']['SHOW']) { ?>
                        $('.widget-element-add-picture-wrap', root).lightGallery();
                    <?php } ?>
                })(jQuery, intec)
            </script>
        <?php } ?>
    </div>
</div>
