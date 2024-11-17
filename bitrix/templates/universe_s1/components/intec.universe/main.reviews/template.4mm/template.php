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
        <div class="widget c-reviews c-reviews-template-4" id="<?= $sTemplateId ?>">
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
                        'a-v-start',
                        'a-h-center'
                    ]
                ]
            ]) ?>
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $sPicture = ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']);

                    if (!empty($arCodes['POSITION'])) {
                        $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                    } else {
                        $sPosition = $arItem['PREVIEW_TEXT'];
                    }

                ?>
                    <?= Html::beginTag('div', [
                        'class' => [
                            'widget-element-wrap',
                            'intec-grid-item-1'
                        ]
                    ]) ?>
                        <div class="widget-element" id="<?= $sAreaId ?>">
                            <div class="widget-element-border-top"></div>
                            <div class="widget-element-content intec-grid intec-grid-wrap intec-grid-a-v-stretch">
                                <div class="widget-element-picture-wrap intec-grid-item-auto intec-grid-item-720-1">
                                    <div class="widget-element-align">
                                        <?= Html::tag('div', '', [
                                            'class' => 'widget-element-picture',
                                            'style' => [
                                                'background-image' => 'url('.$sPicture.')'
                                            ]
                                        ]) ?>
                                        <div class="widget-element-name intec-cl-text">
                                            <?= $arItem['NAME'] ?>
                                        </div>
                                        <?php if ($arVisual['POSITION']['SHOW'] && !empty($sPosition)) { ?>
                                            <?= Html::tag('div', $sPosition, [
                                                'class' => Html::cssClassFromArray([
                                                    'widget-element' => [
                                                        'position' => !empty($arCodes['POSITION']),
                                                        'signature' => empty($arCodes['POSITION'])
                                                    ]
                                                ], true)
                                            ]) ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="widget-element-text intec-grid-item intec-grid-item-720-1">
                                    <?= $arItem['DETAIL_TEXT'] ?>
                                </div>
                            </div>
                            <div class="widget-element-border-bottom"></div>
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
