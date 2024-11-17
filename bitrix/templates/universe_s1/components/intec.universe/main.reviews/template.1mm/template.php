<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

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
<div class="intec-content">
    <div class="intec-content-wrapper">
        <div class="widget c-reviews c-reviews-template-1" id="<?= $sTemplateId ?>">
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
                'class' => Html::cssClassFromArray([ /** Контентый блок */
                    'widget-content' => true,
                    'owl-carousel' => $arVisual['SLIDER']['USE'],
                    'intec-grid' => [
                        '' => !$arVisual['SLIDER']['USE'],
                        'wrap' => !$arVisual['SLIDER']['USE'],
                        'a-v-start' => !$arVisual['SLIDER']['USE'],
                        'a-h-center' => !$arVisual['SLIDER']['USE']
                    ]
                ], true)
            ]) ?>
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $sName = ArrayHelper::getValue($arItem, 'NAME');
                    $sPositionClient = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                    $sDescription = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');
                    $sVideo = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO'], 'VALUE']);
                    $sPicture = ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']);

                    if ($arVisual['VIDEO']['SHOW'] && !empty($sVideo)) {
                        $sPicture = $sVideo[$arVisual['VIDEO']['IMAGE_SIZE']];
                    }

                ?>
                    <?= Html::beginTag('div', [ /** Главный блок элемента */
                        'class' => Html::cssClassFromArray([
                            'widget-element-wrap' => true,
                            'intec-grid-item' => [
                                $arVisual['LINE_COUNT'] => true,
                                '1000-1' => $arVisual['LINE_COUNT'] >= 2
                            ]
                        ], true)
                    ]) ?>
                        <div class="widget-element clearfix" id="<?= $sAreaId ?>">
                            <?php if ($arVisual['VIDEO']['SHOW'] && !empty($sVideo)) { ?>
                                <div class="widget-element-video-wrap">
                                    <?= Html::beginTag('div', [ /** Блок видео */
                                        'class' => 'widget-element-video',
                                        'style' => [
                                            'background-image' => 'url('.$sPicture.')'
                                        ],
                                        'data-src' => $sVideo['iframe']
                                    ]) ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="widget-element-video-icon">
                                            <path d="M216 354.9V157.1c0-10.7 13-16.1 20.5-8.5l98.3 98.9c4.7 4.7 4.7 12.2 0 16.9l-98.3 98.9c-7.5 7.7-20.5 2.3-20.5-8.4zM256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm0 48C145.5 56 56 145.5 56 256s89.5 200 200 200 200-89.5 200-200S366.5 56 256 56z"></path>
                                        </svg>
                                    <?= Html::endTag('div') ?>
                                </div>
                            <?php } else { ?>
                                <?= Html::tag('div', '', [ /** Картинка элемента */
                                    'class' => 'widget-element-picture',
                                    'style' => [
                                        'background-image' => 'url('.$sPicture.')'
                                    ]
                                ]) ?>
                            <?php } ?>
                            <div class="widget-element-text">
                                <div class="widget-element-name">
                                    <?= $sName ?>
                                </div>
                                <div class="widget-element-position">
                                    <?= $sPositionClient ?>
                                </div>
                                <div class="widget-element-description">
                                    <?= $sDescription ?>
                                </div>
                            </div>
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
        <?php if ($arVisual['VIDEO']['SHOW'] || $arVisual['SLIDER']['USE']) {
            include(__DIR__.'/script.php');
        } ?>
    </div>
</div>
