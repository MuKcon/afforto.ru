<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) { die(); }

use Bitrix\Main\Localization\Loc;

/*
 * tags
 * - input: value storage
 * - a: button
 * - img: script loader
 * */

$loadScriptArguments = [];
$widgetDataAttributes = '';
$scriptPathList = [
	BX_ROOT . '/js/yandex.delivery/components/cartwidget/controller.js',
	BX_ROOT . '/js/yandex.delivery/components/cartwidget/admincontroller.js',
];
$cssPathList = [
	$this->GetFolder() . '/style.css',
];

foreach ($arResult['WIDGET_DATA'] as $name => $value)
{
	$widgetDataAttributes .= ' data-' . $name . '="' . htmlspecialcharsbx($value) . '"';
}

foreach ($scriptPathList as $scriptPath)
{
	$this->addExternalJs($scriptPath);

	$loadScriptArguments[] = "'" . htmlspecialcharsbx($scriptPath) . "'";
}
foreach ($cssPathList as $cssPath)
{
	$this->addExternalCss($cssPath);

	$loadCssArguments[] = "'" . htmlspecialcharsbx($cssPath) . "'";
}

?>
<span class="yadelivery--name--pvz"><?php

	if ($arParams['PRINT_VALUE'])
	{
		echo $arParams['PRINT_VALUE'];
	}
	?>
</span>
<input type="hidden" name="<?= $arParams['INPUT_NAME']; ?>" value="<?= $arParams['VALUE']; ?>" <?= $arParams['ONCHANGE'] ?
	'onchange="' . $arParams['ONCHANGE'] . '"': ''; ?> />

<a href="#" class="button--yadelivery--choice"
   onclick="BX.YandexDelivery.AdminCartWidget.getInstance(this).open(); event.preventDefault();" <?=$widgetDataAttributes; ?>><?php
	echo Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_CHOOSE_' . $arParams['SERVICE_TYPE']) ?: Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_CHOOSE');
	?>
</a>
<?if($arParams['IS_CORRECT_ENTRY'] === false):?>
	<div class="yadelivery--error--block"><?echo Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_ERROR_TEXT_' . $arParams['SERVICE_TYPE'])?: Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_ERROR_TEXT');?></div>
<?endif?>
<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" width="0" height="0" alt="" onload="typeof BX!== 'undefined' && ((BX.YandexDelivery && BX.YandexDelivery.AdminCartWidget) || (BX.loadScript && BX.loadScript([<?= implode(',', $loadScriptArguments); ?>])) || (BX.loadCSS && BX.loadCSS([<?= implode(',', $loadCssArguments); ?>])))" />
