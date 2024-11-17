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

            $sImage = CFile::ResizeImageGet($sImage, array(
                'width' => 165,
                'height' => 165
            ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);

            if (!empty($sImage)) {
                $sImage = $sImage['src'];
            } else {
                $sImage = null;
            }
        ?>
            <div class="widget-reviews-item <?=$arParams["COUNT_IN_ROW"]?>">
                <div class="widget-reviews-item-wrapper" id="<?= $sAreaId ?>">
                    <div class="widget-reviews-item-header">
                        <div class="widget-reviews-item-image">
                            <div class="widget-reviews-item-image-wrapper" style="background-image: url('<?= $sImage ?>')"></div>
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
        <?php } ?>
    </div>
</div>
  <div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                    <a href="">
                        <img class="img-responsive" src="img/thumb-1.jpg" alt="Thumb-1">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/2-375.jpg 375, img/2-480.jpg 480, img/2.jpg 800" data-src="img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                    <a href="">
                        <img class="img-responsive" src="img/thumb-2.jpg" alt="Thumb-2">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                    <a href="">
                        <img class="img-responsive" src="img/thumb-13.jpg" alt="Thumb-3">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/4-375.jpg 375, img/4-480.jpg 480, img/4.jpg 800" data-src="img/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                    <a href="">
                        <img class="img-responsive" src="img/thumb-4.jpg" alt="Thumb-4">
                    </a>
                </li>
            </ul>
        </div>
        <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
        <script src="../demo/js/lg-rotate.js"></script>
        <script>
            lightGallery(document.getElementById('lightgallery'));
        </script>