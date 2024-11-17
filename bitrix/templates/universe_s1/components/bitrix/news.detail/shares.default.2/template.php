<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\Html;

/**
 * @var array $arParams
 * @var array $arResult
 */

$this->setFrameMode(true);

if (!Loader::includeModule('intec.core'))
    return;

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));
$arVisual = $arResult['VISUAL'];

Loc::loadMessages(__FILE__);

?>

	<?= Html::beginTag('div', [
		'id' => $sTemplateId,
		'class' => [
			'ns-bitrix',
			'c-news-detail',
			'c-news-detail-shares-default-2'
		]
	]) ?>


    <?php
        foreach ($arResult['BLOCKS'] as $arKey => $arValue) {
            if ($arValue['ACTIVE'])
                include($arValue['PATH']);
        }
    ?>

	<?= Html::endTag('div') ?>




	<div class="cutom-cont">
	<?php if ($arResult["PROPERTIES"]["SERVICES"]["VALUE"]){?> 
	<h2>Услуги по акции</h2>
	<?}?>
	<div class="cutom-cont-cnt"> 

	<?foreach($arResult["PROPERTIES"]["SERVICES"]["VALUE"] as $analog):?>
	<?$res = CIBlockElement::GetByID($analog);?> 
	<?if($ar_res = $res->GetNext())?> 

		<a href='<?=$ar_res["DETAIL_PAGE_URL"];?>'>
			<div class="texts"><?=$ar_res["NAME"];?></div>
			<div class="texts-img"><img src="<?=CFile::GetPath($ar_res["DETAIL_PICTURE"])?>"></div>
	</a>

	<?endforeach;?>
			</div>
</div>


<?php include(__DIR__.'/parts/script.php'); ?>
