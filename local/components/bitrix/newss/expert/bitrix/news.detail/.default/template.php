<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\Type;

/**
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arResult
 * @var array $arParams
 */

$this->setFrameMode(true);

$arCodes = ArrayHelper::getValue($arResult, 'PROPERTY_CODES');
$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');
$sName = ArrayHelper::getValue($arResult, 'NAME');
$sDate = ArrayHelper::getValue($arResult, 'DISPLAY_ACTIVE_FROM');
$sPreviewText = ArrayHelper::getValue($arResult, 'PREVIEW_TEXT');
$sDetailText = ArrayHelper::getValue($arResult, 'DETAIL_TEXT');
$sDetailPicture = ArrayHelper::getValue($arResult, ['DETAIL_PICTURE', 'SRC']);
$sListPage = ArrayHelper::getValue($arResult, 'LIST_PAGE_URL');

$arTags = ArrayHelper::getValue($arResult, ['PROPERTIES', $arCodes['TAG'], 'VALUE']);
$arDetailPicture = [
    'class' => 'news-detail-text-image',
    'style' => ['background-image' => "url($sDetailPicture)"]
];

$bTagsShowTop = !empty($arCodes['TAG']) && Type::isArray($arTags) && ($arViewParams['TAG_SHOW'] == 'top' || $arViewParams['TAG_SHOW'] == 'all');
$bTagsShowBottom = !empty($arCodes['TAG']) && Type::isArray($arTags) && ($arViewParams['TAG_SHOW'] == 'bottom' || $arViewParams['TAG_SHOW'] == 'all');

$iCounter = 0;



$arServices = ArrayHelper::getValue($arResult, ['PROPERTIES', "SYSTEM_SERVICES", 'VALUE']);
$arPosition = ArrayHelper::getValue($arResult, ['PROPERTIES', "position", 'VALUE']);
$arEducation = ArrayHelper::getValue($arResult, ['PROPERTIES', "education", 'VALUE']);
$arExperience = ArrayHelper::getValue($arResult, ['PROPERTIES', "experience", 'VALUE']);
$arCurrentwork = ArrayHelper::getValue($arResult, ['PROPERTIES', "currentwork", 'VALUE']);
$arTraining = ArrayHelper::getValue($arResult, ['PROPERTIES', "training", 'VALUE']);
$arAwards = ArrayHelper::getValue($arResult, ['PROPERTIES', "awards", 'VALUE']);
echo $arP;
?>
<div class="intec-content expertdetail">
    <div class="intec-content-wrapper">
        <div class="ns-bitrix c-news-detail c-news-detail-default" style="font-size: 14px">
            <?php if ($bTagsShowTop || $arViewParams['DATE_SHOW']) { ?>
                <div class="news-detail-header">
                    <?php if ($arViewParams['DATE_SHOW']) { ?>
                        <div class="news-detail-header-date">
                            <?= $sDate ?>
                        </div>
                    <?php } ?>
                    <?php if ($bTagsShowTop) { ?>
                        <?php foreach ($arTags as $sTag) {

                            $iCounter++;

                        ?>
                            <div class="news-detail-tag news-detail-tag-color-<?= $iCounter ?>">
                                <?= '#'.$sTag ?>
                            </div>
                            <?php if ($iCounter == 5) $iCounter = 0 ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="news-detail-content expert-detail">
                <div class="news-detail-text">
        <div class="expertwrap">   

                    <?php if ($arViewParams['IMAGE_SHOW'] && !empty($sDetailPicture)) { ?>
                        <div class="news-detail-text-image-wrap">
                            <?= Html::tag('div', '', $arDetailPicture) ?>
                        </div>
                    <?php } ?>
             <div class="expertinfo">       




                    <?php if (!empty($arEducation)) { ?>
                        <div class="news-detail-edu expertfield">
			<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "education","NAME"]);?>: </div>
                        <div class="expert-field-val"><?= $arEducation ?></div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arExperience)) { ?>
                        <div class="news-detail-exp  expertfield">
<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "experience","NAME"]);?>: </div>
                            <div class="expert-field-val"><?= $arExperience ?></div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arCurrentwork)) { ?>
                        <div class="news-detail-cw expertfield">
<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "currentwork","NAME"]);?>: </div>
                           <div class="expert-field-val"> <?= $arCurrentwork ?></div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arPosition)) { ?>
                        <div class="news-detail-pos expertfield">
<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "position","NAME"]);?>: </div>
                            <div class="expert-field-val"><?= $arPosition ?></div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arTraining)) { ?>
                        <div class="news-detail-train expertfield">
<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "training","NAME"]);?>: </div>
                            <?= $arTraining ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arAwards)) { ?>
                        <div class="news-detail-award expertfield">
<div class="expert-field-label"><?=ArrayHelper::getValue($arResult, ['PROPERTIES', "awards","NAME"]);?>: </div>
                            <?= $arAwards?>
                        </div>
                    <?php } ?>

                    <?php if ($arViewParams['PREVIEW_SHOW'] && !empty($sPreviewText)) { ?>
                        <div class="news-detail-text-preview">
                            <?= $sPreviewText ?>
                        </div>
                    <?php } ?>
                    <div class="news-detail-text-detail">
                        <?= $sDetailText ?>
                    </div>
	</div>
</div>

                </div>

            </div>
			
			
			
            <?php if ($arViewParams['BACK_SHOW'] || $arViewParams['SOCIAL_SHOW']) { ?>
                <div class="news-detail-footer clearfix">
                    <?php if ($arViewParams['BACK_SHOW']) { ?>
                        <a class="news-detail-footer-back intec-cl-text-hover" href="<?= $sListPage ?>">
                            <span class="news-detail-footer-back-icon fal fa-angle-left"></span>
                            <span class="news-detail-footer-back-text">
                                <?= $arViewParams['BACK_TEXT'] ?>
                            </span>
                        </a>
                    <?php } ?>
                    <?php if ($arViewParams['SOCIAL_SHOW']) { ?>
                        <div class="news-detail-footer-social">
                            <?php $APPLICATION->IncludeComponent(
                                "bitrix:main.share",
                                "flat",
                                array(
                                    'HANDLERS' => $arViewParams['SOCIAL_LIST'],
                                    'PAGE_URL' => $arResult["DETAIL_PAGE_URL"],
                                    "PAGE_TITLE" => $arResult["NAME"]
                                ),
                                $component
                            ); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>