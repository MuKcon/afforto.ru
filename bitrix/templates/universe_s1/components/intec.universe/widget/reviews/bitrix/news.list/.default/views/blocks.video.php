<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\ArrayHelper;
use Bitrix\Main\Localization\Loc;

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
$sVideoLinkCode = ArrayHelper::getValue($arParams, 'VIDEO_IBLOCK_PROPERTY_LINK');
$bVideoShow = ArrayHelper::getValue($arParams, 'VIDEO_SHOW') == 'Y';
$sImageSize = ArrayHelper::getValue($arParams, 'VIDEO_IMAGE_QUALITY');
$bServiceShow = ArrayHelper::getValue($arParams, 'SERVICE_SHOW') == 'Y';
$bProjectShow = ArrayHelper::getValue($arParams, 'PROJECT_SHOW') == 'Y';
?>
<div class="widget-reviews-view widget-reviews-view-video">
    <div class="widget-reviews-view-wrapper">
        <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
            <?php
            $sId = $sTemplateId.'_'.$sType.'_extend_'.$arItem['ID'];
            $sAreaId = $this->GetEditAreaId($sId);
            $this->AddEditAction($sId, $arItem['EDIT_LINK']);
            $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

            $sName = $arItem['NAME'];
            $sPositionClient = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);
            $sDetailText = $arItem['DETAIL_TEXT'];
            $sImage = null;
            if (!empty($arItem['PREVIEW_PICTURE'])) {
                $sImage = $arItem['PREVIEW_PICTURE'];
            } else if (!empty($arItem['DETAIL_PICTURE'])) {
                $sImage = $arItem['DETAIL_PICTURE'];
            }
            $sImage = CFile::ResizeImageGet($sImage, array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
            if (!empty($sImage))
                $sImage = $sImage['src'];

            $sVideo = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['VIDEO'], 'VALUE']);
            if ($bVideoShow && !empty($sVideo))
                $sPicture = $sVideo[$sImageSize];

            $bDocumentShow = false;
            $sDocument = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DOCUMENT'], 'VALUE']);
            $sService = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['SERVICE'], 'VALUE']);
            $sProject = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PROJECT'], 'VALUE']);

            $sDocumentName = '';
            $sDocumentImage = '';
            if (!empty($sDocument)){
                $bDocumentShow = true;
                $sDocumentName = $sDocument['ORIGINAL_NAME'];
                $sDocumentImage = $sDocument['SRC'];
            }

            $sContentType = null;

            if ($bVideoShow && !empty($sVideo)){
                $sContentType = 'video';
            }elseif($bDocumentShow && empty($sVideo)){
                $sContentType = 'document';
            }
            ?>
            <div class="widget-reviews-item">
                <div class="widget-reviews-item-wrapper" id="<?= $sAreaId ?>">
                    <div class="widget-reviews-item-image">
                        <div class="widget-reviews-item-image-wrapper" style="background-image: url('<?= $sImage ?>')"></div>
                    </div>
                    <div class="widget-reviews-item-content">
                        <div class="widget-reviews-item-name intec-cl-text">
                            <?= $sName ?>
                        </div>
                        <div class="widget-reviews-item-signature">
                            <?= $sPositionClient ?>
                        </div>
                        <? if ($bServiceShow && !empty($sService)){ ?>
                        <div class="widget-reviews-item-service">
                            <span class=""><?= Loc::getMessage('C_W_REVIEWS_N_L_SERVICE_TITLE'); ?></span><a href="<?= $sService['DETAIL_PAGE_URL']?>" class=""><?= $sService['NAME']?></a>
                        </div>
                        <? } ?>
                        <? if ($bProjectShow && !empty($sProject)){ ?>
                        <div class="widget-reviews-item-project">
                            <span class=""><?= Loc::getMessage('C_W_REVIEWS_N_L_PROJECT_TITLE'); ?></span><a href="<?= $sProject['DETAIL_PAGE_URL']?>" class=""><?= $sProject['NAME']?></a>
                        </div>
                        <? } ?>
                        <div class="widget-reviews-item-information">
                            <div class="widget-reviews-item-information-wrapper <?=($sContentType)?$sContentType:""?>">
                            <?= $sDetailText ?>
                            </div>
                            <?if ($sContentType){?>
                                <div class="widget-reviews-item-right-block">
                                    <? if ($sContentType == 'video') {?>
                                        <div class="widget-reviews-item-video-wrap">
                                            <div class="widget-reviews-item-video" style="background-image: url('<?= $sPicture ?>')" data-src="<?= $sVideo['iframe'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="widget-reviews-item-video-icon">
                                                    <path d="M216 354.9V157.1c0-10.7 13-16.1 20.5-8.5l98.3 98.9c4.7 4.7 4.7 12.2 0 16.9l-98.3 98.9c-7.5 7.7-20.5 2.3-20.5-8.4zM256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm0 48C145.5 56 56 145.5 56 256s89.5 200 200 200 200-89.5 200-200S366.5 56 256 56z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    <?}?>
                                    <? if ($sContentType == 'document') {?>
                                        <div class="widget-reviews-item-document-wrap">
                                            <a class="widget-reviews-item-document" href="<?= $sDocumentImage ?>">
                                                <img class="widget-reviews-item-document-image" src="<?= $sDocumentImage ?>">
                                                <span class="widget-reviews-item-document-name"><?= $sDocumentName ?></span>
                                            </a>
                                        </div>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?if ($sContentType){?>
    <script>
        (function ($, api) {
            $(document).ready(function () {
                var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
                $('.widget-reviews-item-video-wrap', root).lightGallery();
                $('.widget-reviews-item-document-wrap', root).lightGallery({
                    //appendSubHtmlTo: 'img'
                });
            });
        })(jQuery, intec)
    </script>
<?}?>