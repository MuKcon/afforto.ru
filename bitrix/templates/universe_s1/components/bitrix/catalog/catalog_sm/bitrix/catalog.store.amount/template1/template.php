<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?php if(!empty($arResult["STORES"])){ ?>
    <div class="intec-content">
        <div class="intec-content-wrapper">
            <div class="c-catalog-store-amount c-catalog-store-amount-template-1">
                <?php if ($arParams["MAIN_TITLE"] != ''){ ?>
                <div class="item-sub-title">
                    <?= $arParams["MAIN_TITLE"] ?>
                </div>
                <?php } ?>
                <div class="catalog-store-amount-elements">
                    <?php foreach($arResult["STORES"] as $pid => $arProperty){ ?>
                    <div class="catalog-store-amount-element" <?= ($arParams['SHOW_EMPTY_STORE'] == 'N' && isset($arProperty['REAL_AMOUNT']) && $arProperty['REAL_AMOUNT'] <= 0 ? 'display:none' : '') ?>>
                        <div class="catalog-store-amount-element-wrapper">
                            <div class="catalog-store-amount-element-table">
                                <?php if (isset($arProperty["TITLE"]) || isset($arProperty["DESCRIPTION"])){ ?>
                                    <div class="catalog-store-amount-element-column column-1">
                                        <?php if (isset($arProperty["TITLE"])){ ?>
                                            <div class="catalog-store-amount-field address"><?= $arProperty["TITLE"] ?></div>
                                        <?php } ?>
                                        <?php if (isset($arProperty["DESCRIPTION"])){ ?>
                                            <div class="catalog-store-amount-field description"><?= $arProperty["DESCRIPTION"] ?></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($arProperty["PHONE"]) || isset($arProperty["EMAIL"])){ ?>
                                    <div class="catalog-store-amount-element-column column-2">
                                        <?php if (isset($arProperty["PHONE"])){ ?>
                                            <div class="catalog-store-amount-field tel"><?= $arProperty["PHONE"] ?></div>
                                        <?php } ?>
                                        <?php if (isset($arProperty["EMAIL"])){ ?>
                                            <div class="catalog-store-amount-field email"><?= $arProperty["EMAIL"] ?></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($arProperty["SCHEDULE"])){ ?>
                                    <div class="catalog-store-amount-element-column column-3">
                                        <div class="catalog-store-amount-field schedule"><?= $arProperty["SCHEDULE"] ?></div>
                                    </div>
                                <?php } ?>
                                <div class="catalog-store-amount-element-column column-4">
                                    <?if ($arParams['SHOW_GENERAL_STORE_INFORMATION'] == "Y") :?>
                                        <?=GetMessage('BALANCE')?>:
                                    <?else:?>
                                        <?=GetMessage('S_AMOUNT')?>
                                    <?endif;?>
                                    <div class="catalog-store-amount-field count" id="<?= $arResult['JS']['ID'] ?>_<?= $arProperty['ID'] ?>"><?= $arProperty["AMOUNT"] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?if (isset($arResult["IS_SKU"]) && $arResult["IS_SKU"] == 1):?>
	<script type="text/javascript">
		var obStoreAmount = new JCCatalogStoreSKU(<? echo CUtil::PhpToJSObject($arResult['JS'], false, true, true); ?>);
        offers.on('offerChange', function(event, parameters) {
            offer = parameters.offer;
            obStoreAmount.offerOnChange(offer.ID);
        })
    </script>
	<?
endif;?>