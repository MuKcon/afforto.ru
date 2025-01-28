<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \intec\core\helpers\ArrayHelper;

/**
 * @var $APPLICATION
 * @var array $arResult
 * @var array $arParams
 * @var array $currentOffer
 * @var array $minPrice
 */

?>
<?php if (!empty($arResult['OFFERS'])) { ?>
    <span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="display:none;">
        <meta itemprop="offerCount" content="<?= count($arResult['OFFERS']) ?>" />
        <meta itemprop="lowPrice" content="<?= $minPrice['VALUE'] ?>" />
        <meta itemprop="priceCurrency" content="<?= $arResult['MIN_PRICE']['CURRENCY'] ?>" />
        <?php foreach($arResult['OFFERS'] as $arOffer) {
            $currentOffersList = array();
            $offerMinPrice = ArrayHelper::getValue($arOffer, ['MIN_PRICE', 'DISCOUNT_VALUE'], $arResult['MIN_PRICE']['VALUE']);

            foreach ($arOffer['TREE'] as $propName => $skuId) {
                $propId = (int)substr($propName, 5);

                foreach ($arResult['SKU_PROPS'] as $prop) {
                    if ($prop['ID'] != $propId)
                        continue;

                    foreach ($prop['VALUES'] as $propId => $propValue) {
                        if ($propId == $skuId) {
                            $currentOffersList[] = $propValue['NAME'];
                            break;
                        }
                    }
                }
            } ?>
            <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="sku" content="<?= implode('/', $currentOffersList) ?>" />
                <a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" itemprop="url"></a>
                <meta itemprop="price" content="<?= $offerMinPrice ?>" />
                <meta itemprop="priceCurrency" content="<?= $arOffer['MIN_PRICE']['CURRENCY'] ?>" />
                <link itemprop="availability" href="http://schema.org/<?= $arOffer['CAN_BUY'] ? 'InStock' : 'OutOfStock' ?>" />
            </span>
        <?php } ?>
		</span>
    <?php unset($arOffer, $currentOffersList); ?>
<?php } else if ($arResult['MIN_PRICE']) { ?>
    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="display: none">
        <meta itemprop="price" content="<?= $minPrice['VALUE'] ?>" />
        <meta itemprop="priceCurrency" content="<?= $arResult['MIN_PRICE']['CURRENCY'] ?>" />
        <link itemprop="availability" href="http://schema.org/<?= $arResult['MIN_PRICE']['CAN_BUY'] ? 'InStock' : 'OutOfStock' ?>" />
    </span>
<?php } ?>