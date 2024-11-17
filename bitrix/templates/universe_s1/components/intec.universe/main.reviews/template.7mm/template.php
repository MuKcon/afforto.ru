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
                'class' => Html::cssClassFromArray([
                    'widget-content-wrap' => [
                        '' => true,
                        'dots' => $arVisual['SLIDER']['DOTS'],
                        'nav' => $arVisual['SLIDER']['NAV']
                    ]
                ], true)
            ]) ?>
                <?= Html::beginTag('div', [
                    'class' => [
                        'widget-content',
                        'owl-carousel'
                    ]
                ]) ?>
                    <?php foreach ($arResult['ITEMS'] as $arItem) {

                        $sId = $sTemplateId.'_'.$arItem['ID'];
                        $sAreaId = $this->GetEditAreaId($sId);
                        $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                        $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                        $sPicture = ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']);
                        $sDetailText = $arItem['DETAIL_TEXT'];

                        if (!empty($arCodes['POSITION']))
                            $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                        else
                            $sPosition = $arItem['PREVIEW_TEXT'];

                    ?>
                        <div class="widget-element-wrap " id="<?= $sAreaId ?>">
                            <div class="widget-element">
                                <div class="widget-element-picture-wrap">
                                    <?= Html::tag('div', '', [
                                        'class' => 'widget-element-picture',
                                        'style' => [
                                            'background-image' => 'url('.$sPicture.')'
                                        ]
                                    ]) ?>
                                </div>
                                <div class="widget-element-info">
                                    <div class="widget-element-name">
                                        <?= $arItem['NAME'] ?>
                                    </div>
                                    <div class="widget-element-position">
                                        <?php if ($arVisual['POSITION']['SHOW'] && !empty($sPosition)) { ?>
                                            <?= $sPosition ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="widget-element-text">
                                    <?= $sDetailText ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?= Html::endTag('div') ?>
            <?= Html::endTag('div') ?>
            <?php if ($arFooter['SHOW']) { ?>
                <div class="widget-footer align-<?= $arFooter['POSITION'] ?>">
                    <a class="widget-footer-all intec-cl-border intec-cl-background-hover" href="<?= $arFooter['LIST_PAGE'] ?>">
                        <?= $arFooter['TEXT'] ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php include(__DIR__.'/script.php') ?>
    </div>
</div>