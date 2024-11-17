<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\Json;
use \Bitrix\Main\Localization\Loc;

/**
* @var $APPLICATION
* @var array $arResult
* @var array $arParams
* @var array $currentOffer
* @var integer $currentOfferId
*/

?>
<div>
<?
if (!empty($arResult['OFFERS']))
{
    if ($arResult['OFFER_GROUP'])
    {
        foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId)
        {
            ?>
            <div class="set-offer-block set-offer-block-<?=$offerId?> <?=($offerId == $currentOffer['ID'])?"active":""?>">
                <?$APPLICATION->IncludeComponent(
                    'bitrix:catalog.set.constructor',
                    '',
                    array(
                        'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
                        'ELEMENT_ID' => $offerId,
                        'PRICE_CODE' => $arParams['PRICE_CODE'],
                        'BASKET_URL' => $arParams['BASKET_URL'],
                        'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                        'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID']
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );?>
            </div>
            <?
        }
    }
}
else
{
    if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP'])
    {
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.set.constructor',
            '',
            array(
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'ELEMENT_ID' => $arResult['ID'],
                'PRICE_CODE' => $arParams['PRICE_CODE'],
                'BASKET_URL' => $arParams['BASKET_URL'],
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID']
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        );
    }
}
?>

</div>