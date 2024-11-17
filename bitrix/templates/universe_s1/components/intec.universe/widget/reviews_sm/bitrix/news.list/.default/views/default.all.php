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

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<? $num = 0;?>


<div class="widget-reviews-view widget-reviews-view-default">
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
			
			$sImage1 = CFile::ResizeImageGet($sImage, array(
                'width' => 1000,
                'height' => 1000
            ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
			
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
            <div class="widget-reviews-item <?=$arParams["COUNT_IN_ROW"]?>" data-src="<?= $sImage1['src'] ?>"   data-fancybox href="#hidden<?=$num?>">
                <div class="widget-reviews-item-wrapper" id="<?= $sAreaId ?>">
                    <div class="widget-reviews-item-header">
                        <div class="widget-reviews-item-image">
                            <div class="widget-reviews-item-image-wrapper" style="background-image: url('<?= $sImage ?>')">
								<div style="display: none; width: 500px;" id="hidden<?=$num?>">
	<img src="<?=$$sImage?>">
</div>
								<?= Html::img($sImage, [ /** Иконка для галлереи */
									'alt' => $sName,
									'title' => $sName
								]) ?>
							</div>
                        </div>
                        <div class="widget-reviews-item-name intec-cl-text">
                            <?= $sName ?>
                        </div>
                        <div class="widget-reviews-item-signature">
                            <?= $sPositionClient ?>
                        </div>
                    </div>
                    <div class="widget-reviews-item-information">
                        <?= $sDetailText ?>
                    </div>
                </div>
            </div>
			<?  $num = $num + 1;?>
        <?php } ?>
    </div>
</div>


<script>
    (function ($, api) {
        $(document).ready(function () {
            var galleryRoot = $('#'+<?= JavaScript::toObject($sTemplateId) ?>);
            $('.widget-reviews-view-wrapper', galleryRoot).lightGallery();
        });
    })(jQuery, intec);
</script>