<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\ArrayHelper;

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 * @var string $sTemplateId
 * @var string $sType
 */

$arCodes = ArrayHelper::getValue($arResult, 'PROPERTY_CODES');
?>
<div class="widget-reviews-view widget-reviews-view-blocks">
    <div class="widget-reviews-view-wrapper">
        <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
        <?php
            $sId = $sTemplateId.'_'.$sType.'_extend_'.$arItem['ID'];
            $sAreaId = $this->GetEditAreaId($sId);
            $this->AddEditAction($sId, $arItem['EDIT_LINK']);
            $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);
            $sImage = null;

            $sName = $arItem['NAME'];
            $sPositionClient = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
            $sDetailText = $arItem['DETAIL_TEXT'];

            if (!empty($arItem['PREVIEW_PICTURE'])) {
                $sImage = $arItem['PREVIEW_PICTURE'];
            } else if (!empty($arItem['DETAIL_PICTURE'])) {
                $sImage = $arItem['DETAIL_PICTURE'];
            }

            $sImage = CFile::ResizeImageGet($sImage, array(
                'width' => 138,
                'height' => 138
            ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);

            if (!empty($sImage)) {
                $sImage = $sImage['src'];
            } else {
                $sImage = null;
            }
        ?>
            <div class="widget-reviews-item <?=$arParams["COUNT_IN_ROW"]?>">
                <div class="widget-reviews-item-wrapper" id="<?= $sAreaId ?>">
                    <div class="widget-reviews-item-information">
                        <?= $sDetailText ?>
                    </div>
                    <div class="widget-reviews-item-delimiter"></div>
                    <div class="widget-reviews-item-header">
                        <div class="widget-reviews-item-header-wrapper">
                            <div class="widget-reviews-item-header-wrapper-2">
                                <div class="widget-reviews-item-image">
                                    <div class="widget-reviews-item-image-wrapper" style="background-image: url('<?= $sImage ?>')"></div>
                                </div>
                                <div class="widget-reviews-item-about">
                                    <div class="widget-reviews-item-name">
                                        <?= $sName ?>
                                    </div>
                                    <?php if (!empty($sPositionClient)) { ?>
                                        <div class="widget-reviews-item-signature">
                                            <?= $sPositionClient ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
