<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\Json;
use Bitrix\Main\Localization\Loc;
use intec\core\helpers\JavaScript;

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT'])) {
    $navParams =  array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$bShowTopPager = false;
$bShowBottomPager = false;
$bShowLazyLoad = false;
$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
$compareList = ArrayHelper::getValue($arParams, 'COMPARE_NAME');

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $bShowTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $bShowBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $bShowLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$sPriceFrom = Loc::getMessage('PRICE_FROM');
$sNotAvailable = Loc::getMessage('PRODUCT_NOT_HAVE');
$sRecommendation = Loc::getMessage('MARK_RECOMMEND');
$sNew = Loc::getMessage('MARK_NEW');
$sPopular = Loc::getMessage('MARK_HIT');
$sAddToCart = Loc::getMessage('ADD_TO_CART');
$sAddedToCart = Loc::getMessage('ADDED_TO_CART');
$sMoreInfo = Loc::getMessage('MORE');

$sBasketUrl = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'BASKET_URL']);
$sIBlockId = ArrayHelper::getValue($arParams, 'IBLOCK_ID');

$bDisplayPreview = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'DISPLAY_PREVIEW']);
$bDisplayProperties = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'DISPLAY_PROPERTIES']);
$bDisplayCompare = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'COMPARE_SHOW']);
$bDisplayDelay = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'DELAY_SHOW']);
$bDisplayQuickView = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'QUICK_VIEW_SHOW']);
$bDisplayCounter = ArrayHelper::getValue($arResult, ['VIEW_PARAMETERS', 'COUNTER_SHOW']);

$arPriceItems = array();

if (!empty($arResult['ITEMS'])) { ?>
    <?php if ($bShowTopPager) { ?>
        <?= $arResult["NAV_STRING"] ?>
    <?php } ?>
    <!-- items-container -->
    <div class="intec-catalog-section intec-catalog-section-list" data-entity="<?= $containerName ?>">
        <?php

        $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
        $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
        $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

        foreach ($arResult["ITEMS"] as $cell => $arElement) {

            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);

            $sPictureSrc = ArrayHelper::getValue($arElement, ['PICTURE', 'src']);
            $sDetailPage = ArrayHelper::getValue($arElement, 'DETAIL_PAGE_URL');
            $sName = ArrayHelper::getValue($arElement, 'NAME');
            $sPreviewText = ArrayHelper::getValue($arElement, 'PREVIEW_TEXT');
            $sMeasureRatio = ArrayHelper::getValue($arElement, 'CATALOG_MEASURE_RATIO');
            $sQuantity = ArrayHelper::getValue($arElement, 'CATALOG_QUANTITY');
            $sPrice = ArrayHelper::getValue($arElement, ['MIN_PRICE', 'PRINT_DISCOUNT_VALUE']);
            $sOldPrice = ArrayHelper::getValue($arElement, ['MIN_PRICE', 'PRINT_VALUE']);
            $sPriceNumeric = ArrayHelper::getValue($arElement, ['MIN_PRICE', 'DISCOUNT_VALUE']);
            $sOldPriceNumeric = ArrayHelper::getValue($arElement, ['MIN_PRICE', 'VALUE']);
            $sDiscountDifference = ArrayHelper::getValue($arElement, ['MIN_PRICE', 'DISCOUNT_DIFF_PERCENT']);

            $bPopular = ArrayHelper::getValue($arElement, ['VIEW_PARAMETERS', 'MARKERS', 'POPULAR']);
            $bNew = ArrayHelper::getValue($arElement, ['VIEW_PARAMETERS', 'MARKERS', 'NEW']);
            $bRecommendation = ArrayHelper::getValue($arElement, ['VIEW_PARAMETERS', 'MARKERS', 'RECOMMENDATION']);
            $bOffersExist = !empty(ArrayHelper::getValue($arElement, 'OFFERS'));
            $bCanBuy = ArrayHelper::getValue($arElement, 'CAN_BUY');
            $bCanBuyZero = ArrayHelper::getValue($arElement, 'CAN_BUY_ZERO');
            $bDiscount = $sOldPriceNumeric > $sPriceNumeric;

            $arPictureAttributes = [
                'title' => ArrayHelper::getValue($arElement, ['PICTURE', 'imgTitle']),
                'alt' => ArrayHelper::getValue($arElement, ['PICTURE', 'imgAlt'])
            ];

            /**
             * Параметры счетчиков,
             * кнопок добавления в корзину,
             * кнопок сравнения
             */
            $arCounterSettings = [];
            $arBasketAdd = [];
            $arBasketAdded = [];
            $arCompareAdd = [];
            $arCompareAdded = [];
            $arDelayAdd = [];
            $arDelayAdded = [];

            if ($bCanBuy && !$bOffersExist) {
                if ($bDisplayCounter) {
                    $arCounterSettings = Json::encode([
                        'bounds' => [
                            'minimum' =>((int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']!="")?(int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']:$sMeasureRatio,// $sMeasureRatio
                            'maximum' => $bCanBuyZero ? false: $sQuantity,
                        ],
                        'step' => $sMeasureRatio,
                        'value' => $sMeasureRatio
                    ]);
                }

                $arBasketAdd = [
                    'class' => 'intec-button intec-button-w-icon intec-button-cl-common intec-button-transparent intec-button-lg intec-button-fs-16 add',
                    'data-basket-add' => $arElement['ID'],
                    'data-basket-in' => 'false',
                    'data-basket-quantity' => ((int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']!="")?(int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']:$sMeasureRatio// $sMeasureRatio
                ];

                $arBasketAdded = [
                    'class' => 'intec-button intec-button-w-icon intec-button-cl-common intec-button-lg intec-button-fs-16 added',
                    'href' => $sBasketUrl,
                    'data-basket-added' => $arElement['ID'],
                    'data-basket-in' => 'false',
                    'data-basket-quantity' => ((int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']!="")?(int)$arElement['PROPERTIES']['MIN_VAL']['VALUE']:$sMeasureRatio// $sMeasureRatio
                ];

                if ($bDisplayCompare) {
                    $arCompareAdd = [
                        'class' => 'intec-min-button intec-min-button-compare add',
                        'data-compare-add' => $arElement['ID'],
                        'data-compare-in' => 'false',
                        'data-compare-list' => $compareList,
                        'data-compare-iblock' => $sIBlockId
                    ];

                    $arCompareAdded = [
                        'class' => 'intec-min-button intec-min-button-compare added',
                        'data-compare-added' => $arElement['ID'],
                        'data-compare-in' => 'false',
                        'data-compare-list' => $compareList,
                        'data-compare-iblock' => $sIBlockId
                    ];
                }

                if ($bDisplayDelay) {
                    $arDelayAdd = [
                        'class' => 'intec-min-button intec-min-button-like add',
                        'data-basket-delay' => $arElement['ID'],
                        'data-basket-in' => 'false'
                    ];

                    $arDelayAdded = [
                        'class' => 'intec-min-button intec-min-button-like added',
                        'data-basket-delayed' => $arElement['ID'],
                        'data-basket-in' => 'false'
                    ];
                }
            }

            if (count($arElement['ITEM_QUANTITY_RANGES']) > 1) {
                $arPriceItems[$arElement['ID']] = $arElement['ITEM_PRICES'];
            }
            ?>
            <div id="<?= $this->GetEditAreaId($arElement['ID']) ?>" class="catalog-section-element" data-entity="items-row" data-product-id="<?=$arElement['ID']?>">
                <div class="image-block intec-image-effect">
                    <?php if ($bDisplayQuickView) {
                        include('parts/quick.view.php');
                    } ?>
                    <?php $APPLICATION->IncludeComponent(
                        'intec.universe:widget',
                        'markers',
                        array(
                            'MARKER_RECOMMENDATION' => $bRecommendation,
                            'MARKER_NEW' => $bNew,
                            'MARKER_HIT' => $bPopular,
                            'MARKER_DISCOUNT' => $bDiscount,
                            'MARKER_DISCOUNT_VALUE' => $sDiscountDifference
                        ),
                        $component,
                        array(
                            'HIDE_ICONS' => 'Y'
                        )
                    ) ?>
                    <div class="valign"></div>
                    <a class="image-link" href="<?= $sDetailPage ?>">
                        <?= Html::img($sPictureSrc, $arPictureAttributes) ?>
                    </a>
                </div>
                <div class="element-catalog">
                    <div class="price-block">
                        <div class="newprice">
                            <span>
                                <?= $sPrice ?>
                            </span>
                            <?php if ($bDiscount) { ?>
                                <div class="oldprice">
                                    <?= $sOldPrice ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($arParams['USE_BASKET'] == 'Y') {?>
                        <?php if ($bCanBuy && !$bOffersExist) { ?>
                            <?php if ($bDisplayCounter) { ?>
                                <span class="item-quantity" data-settings="<?= Html::encode($arCounterSettings) ?>">
                                    <?= Html::tag('a', '-', [
                                        'class' => 'quantity-button intec-cl-text-hover',
                                        'href' => 'javascript:void(0)',
                                        'data-type' => 'button',
                                        'data-action' => 'decrement'
                                    ]) ?>
                                    <?= Html::input('text', null, $sMeasureRatio, [
                                        'data-type' => 'input',
                                        'class' => 'quantity-input'
                                    ]) ?>
                                    <?= Html::tag('a', '+', [
                                        'class' => 'quantity-button intec-cl-text-hover',
                                        'href' => 'javascript:void(0)',
                                        'data-type' => 'button',
                                        'data-action' => 'increment'
                                    ]) ?>
                                </span>
                            <?php } ?>
                            <div class="buys">
                                <?= Html::beginTag('div', $arBasketAdd) ?>
                                <span class="intec-button-icon intec-basket glyph-icon-cart"></span>
                                <span class="intec-button-text intec-basket-text">
                                        <?= $sAddToCart ?>
                                    </span>
                                <?= Html::endTag('div') ?>
                                <?= Html::beginTag('a', $arBasketAdded) ?>
                                <span class="intec-button-icon intec-basket glyph-icon-cart"></span>
                                <span class="intec-button-text intec-basket-text">
                                        <?= $sAddedToCart ?>
                                    </span>
                                <?= Html::endTag('a') ?>
                            </div>
                            <div class="min-button-block">
                                <?php if ($bDisplayCompare) { ?>
                                    <?= Html::beginTag('div', $arCompareAdd) ?>
                                    <i class="glyph-icon-compare" aria-hidden="true"></i>
                                    <?= Html::endTag('div') ?>
                                    <?= Html::beginTag('div', $arCompareAdded) ?>
                                    <i class="glyph-icon-compare" aria-hidden="true"></i>
                                    <?= Html::endTag('div') ?>
                                <?php } ?>
                                <?php if ($bDisplayDelay) { ?>
                                    <?= Html::beginTag('div', $arDelayAdd) ?>
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    <?= Html::endTag('div') ?>
                                    <?= Html::beginTag('div', $arDelayAdded) ?>
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    <?= Html::endTag('div') ?>
                                <?php } ?>
                            </div>
                        <?php } else if ($bOffersExist && $bCanBuy) { ?>
                            <div class="buys">
                                <a href="<?= $sDetailPage ?>" class="intec-button intec-button-w-icon intec-button-cl-common intec-button-transparent intec-button-lg intec-button-fs-16">
                                    <span class="intec-button-icon intec-basket glyph-icon-cart"></span>
                                    <span class="intec-button-text intec-basket-text">
                                        <?= $sMoreInfo ?>
                                    </span>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="buys">
                                <?= $sNotAvailable ?>
                            </div>
                        <?php } ?>
                    <?php } else {?>
                        <?php if (!empty($arElement['FORM_ORDER'])) {?>
                            <div class="buys">
                                <a onclick="universe.forms.show(<?= JavaScript::toObject($arElement['FORM_ORDER']) ?>)" class="intec-button intec-button-w-icon intec-button-cl-common intec-button-transparent intec-button-lg intec-button-fs-16">
                                    <span class="intec-button-icon intec-basket glyph-icon-cart"></span>
                                    <span class="intec-button-text intec-basket-text">
                                        <?= GetMessage('TEXT_BUTTON_ORDER_PRODUCT') ?>
                                    </span>
                                </a>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
                <div class="element-description">
                    <div class="element-name">
                        <a class="intec-cl-text-hover" href="<?= $sDetailPage ?>">
                            <?= $sName ?>
                        </a>
                    </div>
                    <?php if ($bDisplayPreview && !empty($sPreviewText)) { ?>
                        <div class="element-preview-text">
                            <?= $sPreviewText ?>
                        </div>
                    <?php } ?>
                    <?php if ($bDisplayProperties && !empty($arElement['DISPLAY_PROPERTIES'])) { ?>
                        <div class="element-properties">
                            <ul class="element-properties-ul">
                                <?php foreach ($arElement['DISPLAY_PROPERTIES'] as $property) { ?>
                                    <li>
                                        <span>
                                            <?= $property['NAME'].' &mdash; ' ?>
                                            <?= is_array($property['VALUE']) ? implode(', ', $property['VALUE']) : $property['DISPLAY_VALUE'] ?>
                                        </span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php } ?>
        <?php if ($bDisplayCounter) { ?>
            <script type="text/javascript">
                (function ($, api) {

                    <?php if (!empty($arPriceItems)) {?>
                    var productItemsPrice = <?= JavaScript::toObject($arPriceItems) ?>;
                    <?php }?>

                    $(document).ready(function () {
                        $('.item-quantity').control('numeric', {}, function (settings, instance) {
                            var node = this;

                            if (instance === null) {
                                api.extend(settings, this.data('settings'));
                            } else {
                                instance.on('change', function (event, value) {
                                    node.closest('.element-catalog')
                                        .find('[data-basket-add]')
                                        .data('basket-quantity', value);

                                    <?php if (!empty($arPriceItems)) {?>
                                    element = node.closest('.catalog-section-element');

                                    productID = element.data('product-id');
                                    if (api.isDeclared(productItemsPrice[productID])) {
                                        currentOffer = productItemsPrice[productID];
                                        if (currentOffer.length > 1) {
                                            var newPrice;
                                            var oldPrice;

                                            intec.each(currentOffer, function(i, property){
                                                if (property['QUANTITY_FROM'] == null
                                                    && property['QUANTITY_TO'] != null
                                                    && property['QUANTITY_TO'] >= value) {

                                                    newPrice = property['PRINT_PRICE'];

                                                    if (property['PRICE'] != property['BASE_PRICE'])
                                                        oldPrice = property['PRINT_BASE_PRICE'];

                                                } else if (property['QUANTITY_TO'] == null
                                                    && property['QUANTITY_FROM'] != null
                                                    && property['QUANTITY_FROM'] <= value) {

                                                    newPrice = property['PRINT_PRICE'];

                                                    if (property['PRICE'] != property['BASE_PRICE'])
                                                        oldPrice = property['PRINT_BASE_PRICE'];

                                                } else if (property['QUANTITY_FROM'] != null
                                                    && property['QUANTITY_TO'] != null
                                                    && property['QUANTITY_FROM'] <= value
                                                    && property['QUANTITY_TO'] >= value) {

                                                    newPrice = property['PRINT_PRICE'];

                                                    if (property['PRICE'] != property['BASE_PRICE'])
                                                        oldPrice = property['PRINT_BASE_PRICE'];

                                                }
                                            });

                                            $('.newprice span', element).html(newPrice);
                                            $('.oldprice', element).html(oldPrice);
                                        }
                                    }
                                    <?php }?>
                                });
                            }
                        });
                    })
                })(jQuery, intec);
            </script>
        <?php } ?>
    </div>
    <!-- items-container -->
    <div class="clear"></div>
    <?php if ($bShowLazyLoad) { ?>
        <div class="row bx-<?= $arParams['TEMPLATE_THEME'] ?>">
            <div class="show-more show-more-btn intec-cl-text"
                 data-use="show-more-<?= $navParams['NavNum'] ?>">
                <i class="glyph-icon-show-more intec-cl-background"></i>
                <?= $arParams['MESS_BTN_LAZY_LOAD'] ?>
            </div>
        </div>
    <?php } ?>
    <?php if ($bShowBottomPager) { ?>
        <div data-pagination-num="<?= $navParams['NavNum'] ?>">
            <!-- pagination-container -->
            <?= $arResult['NAV_STRING'] ?>
            <!-- pagination-container -->
        </div>
    <?php } ?>
<?php }

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<script>
    BX.message({
        BTN_MESSAGE_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
        BASKET_URL: '<?= $arParams['BASKET_URL'] ?>',
        ADD_TO_BASKET_OK: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
        TITLE_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
        TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
        TITLE_SUCCESSFUL: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
        BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        BTN_MESSAGE_SEND_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS') ?>',
        BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
        BTN_MESSAGE_CLOSE_POPUP: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
        COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
        COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
        COMPARE_TITLE: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
        PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX') ?>',
        RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
        RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
        BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
        BTN_MESSAGE_LAZY_LOAD: '<?= $arParams['MESS_BTN_LAZY_LOAD'] ?>',
        BTN_MESSAGE_LAZY_LOAD_WAITER: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER') ?>',
        SITE_ID: '<?= SITE_ID ?>'
    });
    var <?= $obName ?> = new JCCatalogSectionComponent({
        siteId: '<?= CUtil::JSEscape(SITE_ID) ?>',
        componentPath: '<?= CUtil::JSEscape($componentPath) ?>',
        navParams: <?= CUtil::PhpToJSObject($navParams) ?>,
        deferredLoad: false, // enable it for deferred load
        initiallyShowHeader: '<?= !empty($arResult['ITEM_ROWS']) ?>',
        bigData: <?= CUtil::PhpToJSObject($arResult['BIG_DATA']) ?>,
        lazyLoad: !!'<?= $bShowLazyLoad ?>',
        loadOnScroll: !!'<?= ($arParams['LOAD_ON_SCROLL'] === 'Y') ?>',
        template: '<?= CUtil::JSEscape($signedTemplate) ?>',
        ajaxId: '<?= CUtil::JSEscape($arParams['AJAX_ID']) ?>',
        parameters: '<?= CUtil::JSEscape($signedParams) ?>',
        container: '<?= $containerName ?>'
    });
</script>