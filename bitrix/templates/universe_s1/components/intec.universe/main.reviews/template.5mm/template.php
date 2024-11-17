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
<div class="intec-content intec-content-visible">
    <div class="intec-content-wrapper">
        <div class="widget c-reviews c-reviews-template-5" id="<?= $sTemplateId ?>">
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
                    'widget-content',
                    'intec-grid' => [
                        '',
                        'wrap',
                        'a-v-stretch',
                        'a-h-center',
                        'i-h-7'
                    ]
                ]
            ]) ?>
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $sPicture = $arItem['PREVIEW_PICTURE']['SRC'];
                    $sDetailText = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');

                    if (!empty($arCodes['POSITION']))
                        $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                    else
                        $sPosition = $arItem['PREVIEW_TEXT'];

                    if (!empty($sDetailText))
                        $sDetailText = TruncateText($sDetailText, $arVisual['TRUNCATE']);

                ?>
                    <?= Html::beginTag('div', [
                        'id' => $sAreaId,
                        'class' => Html::cssClassFromArray([
                            'widget-element' => true,
                            'intec-grid-item' => [
                                $arVisual['LINE_COUNT'] => true,
                                '1100-3' => $arVisual['LINE_COUNT'] >= 4,
                                '900-2' => $arVisual['LINE_COUNT'] >= 3,
                                '600-1' => true
                            ]
                        ], true)
                    ]) ?>
                        <div class="widget-element-wrapper">
                            <div class="widget-element-text">
                                <?= $sDetailText ?>
                            </div>
                            <div class="widget-element-info-wrap">
                                <div class="widget-element-info-container">
                                    <?= Html::tag('div', '', [
                                        'class' => 'widget-element-picture',
                                        'style' => [
                                            'background-image' => 'url('.$sPicture.')'
                                        ]
                                    ]) ?>
                                    <div class="widget-element-info">
                                        <div class="widget-element-name">
                                            <?= $arItem['NAME'] ?>
                                        </div>
                                        <?php if ($arVisual['POSITION']['SHOW'] && !empty($sPosition)) { ?>
                                            <div class="widget-element-position">
                                                <?= $sPosition ?>
                                            </div>
                                        <?php } ?>
                                    </div>
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
    </div>
</div>
