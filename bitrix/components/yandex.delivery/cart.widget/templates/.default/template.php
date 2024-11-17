<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) { die(); }

use Bitrix\Main\Localization\Loc;

/*
 * tags
 * - input: value storage
 * - a: button
 * - img: script loader
 * */

$scriptPath = BX_ROOT . '/js/yandex.delivery/components/cartwidget/controller.js';
$cssPath = $this->GetFolder() . '/style.css';
$widgetDataAttributes = '';
$propsChangeForm = '';
$scriptCode = '';

$this->addExternalJs($scriptPath);
$this->addExternalCss($cssPath);

foreach ($arResult['WIDGET_DATA'] as $name => $value)
{
	$widgetDataAttributes .= ' data-' . $name . '="' . htmlspecialcharsbx($value) . '"';
}
foreach ($arParams['PROPERTY_CHANGE'] as $name => $value)
{
	if($propsChangeForm !== '')
		$propsChangeForm.= ' & ';

	$propsChangeForm .= "BX.YandexDelivery.CartWidget.eventChangePropsForm('".$value."','".$arParams['INPUT_NAME']."')";
}
if(isset($arParams['ORDER_PROP_ADDRESS_ID']) && $arParams['SERVICE_TYPE'] !== 'COURIER')
{
    $scriptCode .= "var elementsAddress = document.getElementsByName('".$arParams['ORDER_PROP_ADDRESS_ID'] ."'); if(typeof elementsAddress[0] !== 'undefined') elementsAddress[0].value = '".$arParams['PRINT_VALUE']."';";
}
if($arParams['SHOW_WIDGET_WINDOW'])
{
	$scriptCode .= "document.querySelector('.button--yadelivery--choice').click();";
}

$imgAttribute = 'src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" width="1" height="1" alt="" style="position: absolute;opacity: 0;"';
?>
<script>

</script>
<span class="yadelivery--name--pvz"><?php

	if ($arParams['PRINT_VALUE'])
	{
		echo $arParams['PRINT_VALUE'];
	}
	?>
</span>
<?
if($arParams['PROPS_NAME_DELIVERY'] && $arParams['PRINT_VALUE'])
{
	foreach ($arParams['PROPS_NAME_DELIVERY'] as $name)
	{
		?><input type="hidden" name="<?=$name?>" value="<?= $arParams['PRINT_VALUE']; ?>"><?
	}
}
?>
<input type="hidden" name="<?= $arParams['INPUT_NAME']; ?>" value="<?= $arParams['VALUE']; ?>" <?= $arParams['ONCHANGE'] ?
	'onchange="' . $arParams['ONCHANGE'] . '"': ''; ?> />

<a href="#" class="button--yadelivery--choice" onclick="BX.YandexDelivery.CartWidget.getInstance(this).open(); event.preventDefault();" <?=$widgetDataAttributes; ?>><?php
echo Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_CHOOSE_' . $arParams['SERVICE_TYPE']) ?: Loc::getMessage('YANDEX_DELIVERY_TEMPLATE_CART_WIDGET_CHOOSE');
?>
</a>
<img <?=$imgAttribute?> alt="" onload="typeof BX!== 'undefined' && ((BX.YandexDelivery && BX.YandexDelivery.CartWidget) || (BX.loadScript && BX.loadScript('<?=htmlspecialcharsbx($scriptPath); ?>')) || (BX.loadCSS && BX.loadCSS('<?= htmlspecialcharsbx($cssPath); ?>')) )" />
<?if($propsChangeForm !== ''):?>
	<img <?=$imgAttribute?> alt="" onload="typeof BX!== 'undefined' && (<?=$propsChangeForm?>)" />
<?endif?>
<?if($scriptCode !== ''):?>
    <img <?=$imgAttribute?>  onload="<?=$scriptCode?>" />
<?endif?>
<input name="PREV_DELIVERY_ID" type="hidden" value="<?=$arParams['DELIVERY_ID']?>">