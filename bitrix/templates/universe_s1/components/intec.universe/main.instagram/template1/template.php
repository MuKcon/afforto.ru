<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 */

$sTemplateID = spl_object_hash($this);

$this->setFrameMode(true);

$arHeader = ArrayHelper::getValue($arResult, 'HEADER_BLOCK');
$arDescription = ArrayHelper::getValue($arResult, 'DESCRIPTION_BLOCK');
$arFooter = ArrayHelper::getValue($arResult, 'FOOTER_BLOCK');
$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');

?>
<div class="widget c-instagram c-instagram-template-1" id="<?= $sTemplateID ?>">
    <?php if ($arHeader['SHOW']) { ?>
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
    <div class="widget-content">
        <div class="widget-elements<?= $arViewParams['PADDING_USE'] ? ' widget-elements-with-padding' : '' ?>">
            <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sImage = $arItem['IMAGES']['standard_resolution']['url'];
                    $sDescription = ArrayHelper::getValue($arItem, 'DESCRIPTION');
                    $sLink = ArrayHelper::getValue($arItem, 'LINK');

                ?>
                <div class="widget-element grid-<?= $arViewParams['LINE_COUNT'] ?>">
                    <div class="widget-element-wrapper">
                        <a href="<?= $sLink ?>" class="widget-element-image" style="background-image: url(<?= $sImage ?>)">
                            <div class="widget-element-description">
                                <?php if ($arViewParams['DESCRIPTION_ITEM_SHOW']) { ?>
                                    <?= TruncateText($sDescription, '200') ?>
                                <?php } ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ($arFooter['SHOW']) { ?>
        <div class="widget-footer align-<?= $arFooter['POSITION'] ?>">
            <a class="widget-footer-all intec-cl-border intec-cl-background-hover" href="<?= $arFooter['LIST_PAGE'] ?>">
                <?= $arFooter['TEXT'] ?>
            </a>
        </div>
    <?php } ?>
</div>

