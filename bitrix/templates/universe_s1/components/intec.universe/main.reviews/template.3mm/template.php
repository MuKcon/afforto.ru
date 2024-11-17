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
        <div class="widget c-reviews c-reviews-template-3" id="<?= $sTemplateId ?>">
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
            <div class="widget-content owl-carousel">
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $sName = ArrayHelper::getValue($arItem, 'NAME');
                    $sPicture = ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']);
                    $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
                    $sDescription = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');
                ?>
                    <div class="widget-element-wrapper">
                        <div class="widget-element" id="<?= $sAreaId ?>">
                            <?= Html::tag('div', '', [ /** Картинка элемента */
                                'class' => 'widget-element-picture',
                                'style' => [
                                    'background-image' => 'url('.$sPicture.')'
                                ]
                            ]) ?>
                            <div class="widget-element-info">
                                <div class="widget-element-name">
                                    <?= $sName ?>
                                </div>
                                <?php if ($arVisual['POSITION_SHOW'] && !empty($sPosition)) { ?>
                                    <div class="widget-element-position">
                                        <?= $sPosition ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="widget-element-description">
                                <?= $sDescription ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
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
