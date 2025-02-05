<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$this->setFrameMode(true);

$arData = $arResult['DATA'];
$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$sBannerType = ArrayHelper::getValue($arParams, 'TYPE_BANNER');

$bDetailDescriptionShow = ArrayHelper::getValue($arData, ['DETAIL_TEXT', 'SHOW']);
$sHeaderDetailDescription = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_DESCRIPTION');
$sDetailDescription = ArrayHelper::getValue($arData, ['DETAIL_TEXT', 'VALUE']);

$bFeedbackShow = ArrayHelper::getValue($arParams, 'FEEDBACK') == 'Y';
$sFeedbackTitle = GetMessage('SRVICE_FEEDBACK_TITLE');
$sFeedbackText = GetMessage('SRVICE_FEEDBACK_TEXT');
$sFeedbackFormID = ArrayHelper::getValue($arParams, 'FEEDBACK_FORM_ID');
$sFeedbackButton = GetMessage('SRVICE_FEEDBACK_BUTTON');

$bGalleryShow = ArrayHelper::getValue($arData, ['GALLERY', 'SHOW']);
$bGalleryValue = ArrayHelper::getValue($arData, ['GALLERY', 'VALUE']);
$sHeaderGallery = GetMessage('SRVICE_CAPTION_GALLERY');

$arProperties = ArrayHelper::getValue($arResult, 'DISPLAY_PROPERTIES');
$sHeaderProperties = GetMessage('PROPS');

$bDocumentsShow = ArrayHelper::getValue($arData, ['DOCUMENTS', 'SHOW']);
$bDocumentsValue = ArrayHelper::getValue($arData, ['DOCUMENTS', 'VALUE']);
$sHeaderDocuments = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_DOCUMENTS');

$bVideoShow = ArrayHelper::getValue($arData, ['VIDEO', 'SHOW']) == 1;
$bVideoValue = ArrayHelper::getValue($arData, ['VIDEO', 'VALUE']);
$sHeaderVideo = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_VIDEO');

$bProjectsShow = ArrayHelper::getValue($arData, ['PROJECTS', 'SHOW']);
$bProjectsValue = ArrayHelper::getValue($arData, ['PROJECTS', 'VALUE']);
$sHeaderProjects = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_PROJECTS');

$bReviewsShow = ArrayHelper::getValue($arData, ['REVIEWS', 'SHOW']);
$bReviewsValue = ArrayHelper::getValue($arData, ['REVIEWS', 'VALUE']);
$sHeaderReviews = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_REVIEWS');

$bServicesShow = ArrayHelper::getValue($arData, ['SERVICES', 'SHOW']);
$bServicesValue = ArrayHelper::getValue($arData, ['SERVICES', 'VALUE']);
$sHeaderServices = ArrayHelper::getValue($arParams, 'ELEMENT_CAPTION_SERVICES');

$bProductsShow = ArrayHelper::getValue($arData, ['PRODUCTS', 'SHOW']);
$bProductsValue = ArrayHelper::getValue($arData, ['PRODUCTS', 'VALUE']);
$sHeaderProducts = GetMessage('SRVICE_CAPTION_PRODUCTS');
$sProductsIBlockType = ArrayHelper::getValue($arParams, 'CATALOG_IBLOCK_TYPE');
$sProductsIBlock = ArrayHelper::getValue($arParams, 'CATALOG_IBLOCK');
$sProductsPriceCode = ArrayHelper::getValue($arParams, 'PRICE_CODE');
$sProductsConvertCurrency = ArrayHelper::getValue($arParams, 'CONVERT_CURRENCY');
$sProductsCurrencyID = ArrayHelper::getValue($arParams, 'CURRENCY_ID');

$GLOBALS['_content_bottom'] = $arResult['PROPERTIES']['CONTENT_BOTTOM']['VALUE'];
?>
<div class="service landing ">
	<?php include("parts/banner.php") ?>
	<? if($arResult['PROPERTIES']['CONTENT_BOTTOM']['VALUE'] != "Y"): ?>
		<div class="intec-content">
			<div class="intec-content-wrapper">
				<?php if ($bDetailDescriptionShow && $sBannerType < 4) {
					include('parts/detail-text.php');
				}
				?>
			</div>
		</div>
		<div class="intec-content">
			<div class="intec-content-wrapper"><?
				if ($bGalleryShow && $bGalleryValue) {
					include('parts/gallery.php');
				}

				if (!empty($arProperties)) {
					include('parts/properties.php');
				}?>
				
				<?if ($bDocumentsShow && $bDocumentsValue) {
					include('parts/documents.php');
				}

				if ($bVideoShow && $bVideoValue) {
					include('parts/video.php');
				}

				if ($bProjectsShow && $bProjectsValue) {
					include('parts/projects.php');
				}

				if ($bReviewsShow && $bReviewsValue) {
					include('parts/reviews.php');
				}

				if ($bServicesShow && $bServicesValue) {
					include('parts/services.php');
				}

				if ($bProductsShow && $bProductsValue) {
					include('parts/products.php');
				} 

				if($bFeedbackShow) {
					include("parts/feedback.php");
				}
				
				?>

			</div>
		</div>
	<? endif; ?>
</div>