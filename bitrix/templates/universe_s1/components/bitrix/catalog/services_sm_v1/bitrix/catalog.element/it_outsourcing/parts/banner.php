<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\JavaScript;
use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 * @var  array $arParams
 * @var array $arData
 * @var string $sBannerType
 * @var boolean $bDetailDescriptionShow
 * @var string $sDetailDescription
 * @var string $sHeaderDetailDescription
 */

$bBannerWide = ArrayHelper::getValue($arParams, 'TYPE_BANNER_WIDE') == 'Y';

$bImageShow = ArrayHelper::getValue($arData, ['IMAGE', 'SHOW']);
$sImagePath = ArrayHelper::getValue($arData, ['IMAGE', 'PATH']);

$utm = $_GET['utm_content'];
 
 if($utm == 'obsluzhivanie_komputerov') {
   $sName = 'Обслуживание компьютеров для бизнеса';
 }
 elseif($utm == 'obsluzhivanie_komputernoj_tehniki') {
   $sName = 'Обслуживание компьютерной техники';
 }
 elseif($utm == 'it_outsourcing') {
   $sName = 'IT аутсорсинг для бизнеса';
 }
elseif($utm == 'abonentskoe_obsluzhivanie_komputerov') {
   $sName = 'Абонентское обслуживание компьютеров';
 }
elseif($utm == 'obsluzhivanie_komputernyh_setej') {
   $sName = 'Обслуживание компьютерных сетей';
 }
elseif($utm == 'obsluzhivanie_komputerov_i_serverov') {
   $sName = 'Обслуживание компьютеров и серверов';
 }
elseif($utm == 'obsluzhivanie_komputerov_i_orgtehniki') {
   $sName = 'Обслуживание компьютеров и оргтехники';
 }
elseif($utm == 'obsluzhivanie_serverov') {
   $sName = 'Обслуживание и администрирование серверов';
 }
elseif($utm == 'sistemnoe_administrirovanie') {
   $sName = 'Системное администрирование';
 }
elseif($utm == 'tehnicheskaya_podderzhka') {
   $sName = 'Техническая поддержка для бизнеса';
 }
elseif($utm == 'komputernoe_soprovozhdenie') {
   $sName = 'Компьютерное сопровождение бизнеса';
 }
elseif($utm == 'it_obsluzhivanie') {
   $sName = 'IT обслуживание для бизнеса';
 }
elseif($utm == 'it_uslugi') {
   $sName = 'IT услуги для бизнеса';
 }
elseif($utm == 'obsluzhivanie_i_remont') {
   $sName = 'Обслуживание и ремонт компьютеров';
 }
elseif($utm == 'prihodyashij_sisadmin') {
   $sName = 'Приходящий системный администратор';
 }
else {
  $sName = ArrayHelper::getValue($arResult, 'NAME');
 }
 
$bPriceShow = ArrayHelper::getValue($arData, ['PRICE', 'SHOW']);
$sPriceText = GetMessage('SERVICE_HEADER_PRICE_CAPTION').':';
$sPriceFormatted = ArrayHelper::getValue($arData, ['PRICE', 'FORMATTED']);

$bButtonShow = ArrayHelper::getValue($arParams, 'SERVICES') == 'Y';
$sButtonText = GetMessage('SERVICE_HEADER_ORDER_BUTTON');

$bPreviewDescriptionShow = ArrayHelper::getValue($arData, ['PREVIEW_TEXT', 'SHOW']);
$sPreviewDescription = ArrayHelper::getValue($arData, ['PREVIEW_TEXT', 'VALUE']);

$sFormID = ArrayHelper::getValue($arParams, 'SERVICES_FORM_ID');
$sFormsServiceProperty = ArrayHelper::getValue($arParams, 'PROPERTY_FORM_ORDER_SERVICE');

$arFormParameters = [
    'id' => $sFormID,
    'template' => '.default',
    'parameters' => [
        'AJAX_OPTION_ADDITIONAL' => $sTemplateId.'_FORM_ORDER',
        'CONSENT_URL' => $arParams['CONSENT_URL']
    ],
    'settings' => [
        'title' => $sButtonText
    ],
    'fields' => []
];

if (!empty($sFormsServiceProperty)) {
    $arFormParameters['fields'][$sFormsServiceProperty] = $sName;
}


if (!$bBannerWide) { ?>
    <div class="intec-content">
        <div class="intec-content-wrapper">
<?php } ?>
    <div class="service-header">
        <?php if ($sBannerType == 1) { ?>
            <div class="service-header-with-title service-header-image-wrapper">
                <div class="service-header-image">
                    <div class="uni-image" style="height: 100%;">
                        <div class="uni-aligner-vertical"></div>
                        <div class="big-image" style="background-image:url(<?= $sImagePath ?>)" title="<?= $sName ?>"></div>
                    </div>
                </div>
                <div class="intec-content">
                    <div class="intec-content-wrapper">
                        <div class="service-header-blocks-wrapper">
                            <h1 class="service-header-title"><?= $sName ?></h1>
							<? if($arResult['PROPERTIES']['OTHER_H2']['VALUE']): ?>
								<h2 id="title-h2" class="service-header-sub-title"><?=$arResult['PROPERTIES']['OTHER_H2']['VALUE'];?></h2>
							<? endif; ?>
                            <div class="service-header-information <?= !$bImageShow ? 'service-header-information-no-img' : '' ?>">
                                <?php if ($bPriceShow) { ?>
                                    <div class="service-header-information-price">
                                        <span class="caption"><?= $sPriceText ?></span>
                                        <span class="price"><?= $sPriceFormatted ?></span>
                                        <?php if ($bButtonShow) { ?>
                                            <div class="service-header-information-order">
												<? if($arResult['PROPERTIES']['OTHER_BTN']['VALUE'] == "Да" and $arResult['PROPERTIES']['OTHER_BTN_NAME']['VALUE'] and $arResult['PROPERTIES']['OTHER_BTN_LINK']['VALUE']): ?>
													<a href="<?=$arResult['PROPERTIES']['OTHER_BTN_LINK']['VALUE'];?>" class="intec-button intec-button-cl-common intec-button-md">
														<?=$arResult['PROPERTIES']['OTHER_BTN_NAME']['VALUE']?>
													</a>
												<? else: ?>
												<!--	<a class="intec-button intec-button-cl-common intec-button-md" data-role="form.button" 
														onclick="universe.forms.show(<?= JavaScript::toObject($arFormParameters) ?>)">
														<?= $sButtonText ?>
													</a>-->
													
											
 	<?$APPLICATION->IncludeComponent(
	"intec.universe:main.form",
	"zakaz_uslug",
	Array(
		"BACKGROUND_COLOR" => "#f4f4f4",
		"BACKGROUND_IMAGE_USE" => "N",
		"BUTTON_TEXT" => "Заказать услугу",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "zakaz_uslug",
		"CONSENT" => "",
		"DESCRIPTION_SHOW" => "N",
		"ID" => "6",
		"LAZYLOAD_USE" => "Y",
		"NAME" => "Заказать услугу",
		"SETTINGS_USE" => "N",
		"TEMPLATE" => ".default",
		"THEME" => "dark",
		"TITLE" => "Заказать услугу",
		"VIEW" => "left"
	)
);?>  

												<? endif; ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        <?php } ?>
                                    </div>
                                <?php }
                                if ($bPreviewDescriptionShow) { ?>
                                    <div class="service-header-information-text"><?= $sPreviewDescription ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service-header-information-adaptiv">
                    <?php if ($bPriceShow) { ?>
                        <div class="service-header-information-price">
                            <div class="service-header-information-price-caption"><?= $sPriceText ?></div>
                            <div class="service-header-information-price-value"><?= $sPriceFormatted ?></div>
                        </div>
                    <?php } ?>
                    <?php if ($bButtonShow) { ?>
                        <div class="service-header-information-order">
                            <a class="intec-button-md intec-button intec-button-cl-common" data-role="form.button"
                               onclick="universe.forms.show(<?= JavaScript::toObject($arFormParameters) ?>)">
                                <?= $sButtonText ?>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    <?php } ?>
                    <?php if ($bPreviewDescriptionShow) { ?>
                        <div class="service-header-information-text"><?= $sPreviewDescription ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php }
        if ($sBannerType > 1) { ?>
            <div class="service-header-separate-title service-header-image-wrapper">
                <div class="background-block <?= $sBannerType > 2 ? 'white' : '' ?> <?= $sBannerType > 3 ? 'static' : '' ?>">
                    <div class="intec-content">
                        <div class="intec-content-wrapper clearfix" style="position:relative;">
                            <div class="text-block">
                                <h1 class="service-header-title"><?= $sName ?></h1>
                                <?php if ($sBannerType < 4) { ?>
                                    <div class="service-header-information <?= !$bImageShow ? 'service-header-information-no-img' : '' ?>">
                                        <?php if ($bPriceShow) { ?>
                                            <div class="service-header-information-price">
                                                <span class="caption"><?= $sPriceText ?></span>
                                                <span class="price"><?= $sPriceFormatted ?></span>
                                                <?php if ($bButtonShow) { ?>
                                                    <div class="service-header-information-order">
                                                        <a class="intec-button intec-button-cl-common intec-button-md"
                                                           onclick="universe.forms.show(<?= JavaScript::toObject($arFormParameters) ?>)">
                                                            <?= $sButtonText ?>
                                                        </a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sBannerType < 3 && $bPreviewDescriptionShow) { ?>
                                            <div class="service-header-information-text"><?= $sPreviewDescription ?></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="service-header-image">
                                <div class="uni-image" style="background-image: url(<?= $sImagePath ?>);"></div>
                            </div>
                            <?php if ($bDetailDescriptionShow && $sBannerType == 4) { ?>
                                <div class="detail_description">
                                    <div class="service-header-description">
                                        <div class="service-header-description-caption"><?= $sHeaderDetailDescription ?></div>
                                        <div class="service-header-description-text"><?= $sDetailDescription ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="service-header-information-adaptiv">
                    <?php if ($bPriceShow) { ?>
                        <div class="service-header-information-price">
                            <div class="service-header-information-price-caption"><?= $sPriceText ?></div>
                            <div class="service-header-information-price-value"><?= $sPriceFormatted ?></div>
                        </div>
                    <?php }
                    if ($bButtonShow) { ?>
                        <div class="service-header-information-order">
                            <a class="intec-button intec-button-cl-common intec-button-md"
                               onclick="universe.forms.show(<?= JavaScript::toObject($arFormParameters) ?>)">
                                <?= $sButtonText ?>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    <?php }
                    if ($bPreviewDescriptionShow) { ?>
                        <div class="service-header-information-text"><?= $sPreviewDescription ?></div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php if (!$bBannerWide) { ?>
        </div>
    </div>
<?php } ?>