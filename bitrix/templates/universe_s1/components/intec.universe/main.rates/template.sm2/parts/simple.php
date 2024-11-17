<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;

/**
 * @var array $arResult
 * @var array $arCodes
 * @var array $arVisual
 * @var string $sTemplateId
 */

$iCount = 0;

$arButton = $arVisual['BUTTON'];

if ($arButton['TYPE'] == 'order') {
    $arButton['FORM']['POPUP'] = [
        'id' => $arButton['FORM']['ID'],
        'template' => $arButton['FORM']['TEMPLATE'],
        'parameters' => [
            'AJAX_OPTION_ADDITIONAL' => $sTemplateId.'_FORM_CALL',
            'CONSENT_URL' => $arButton['FORM']['CONSENT']
        ],
        'settings' => [
            'title' => $arButton['FORM']['TITLE']
        ]
    ];
}

?>
<?= Html::beginTag('div', [
    'class' => Html::cssClassFromArray([
        'widget-content' => [
            '' => true,
            'slider' => $arVisual['SLIDER']['USE'],
            'slider-nav' => $arVisual['SLIDER']['USE'] && $arVisual['SLIDER']['CONTROLS']['NAV']
        ]
    ], true)
]) ?>
    <?= Html::beginTag('div', [
        'class' => Html::cssClassFromArray([
            'widget-content-wrapper' => true,
            'owl-carousel' => $arVisual['SLIDER']['USE'],
            'intec-grid' => [
                '' => true,
                'wrap' => true,
                'a-v-stretch' => true,
                'a-h-start' => true
            ]
        ], true)
    ]) ?>
        <?php foreach ($arResult['ITEMS'] as $arItem) {

            $sId = $sTemplateId.'_'.$arItem['ID'];
            $sAreaId = $this->GetEditAreaId($sId);
            $this->AddEditAction($sId, $arItem['EDIT_LINK']);
            $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

            $sName = $arItem['NAME'];
            $sCurrency = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['CURRENCY'], 'VALUE']);
            $sDiscount = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DISCOUNT'], 'VALUE']);
            $sDiscountType = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DISCOUNT_TYPE'], 'VALUE_XML_ID']);
            $sDescription = $arItem['PREVIEW_TEXT'];

            if ($sDiscountType == 'percent' || empty($sDiscountType))
                $sDiscountType = '%';
            else if ($sDiscountType == 'value')
                $sDiscountType = $sCurrency;

            if (!empty($arVisual['ELEMENT_DESCRIPTION']['LENGTH']))
                $sDescription = TruncateText($sDescription, $arVisual['ELEMENT_DESCRIPTION']['LENGTH']);

            $arPrice = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['PRICE'], 'VALUE']);
            $arButton['DETAIL_URL'] = null;

            if ($arButton['SHOW'] && !empty($arButton['TEXT'])) {
                if ($arButton['TYPE'] == 'detail') {
                    $arButton['TAG'] = 'a';
                    $arButton['DETAIL_URL'] = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['DETAIL_URL'], 'VALUE']);

                    if (empty($arButton['DETAIL_URL'])) {
                        $arButton['DETAIL_URL'] = null;
                        $arButton['SHOW'] = false;
                    } else {
                        $arButton['SHOW'] = true;
                    }
                } else if ($arButton['TYPE'] == 'order' && !empty($arButton['FORM']['ID'])) {
                    $arButton['TAG'] = 'div';
                    $arButton['SHOW'] = true;
                    $arButton['FORM']['POPUP']['fields'] = [$arButton['FORM']['FIELD'] => $sName];
                } else {
                    $arButton['SHOW'] = false;
                }
            }

        ?>
            <?= Html::beginTag('div', [
                'id' => $sAreaId,
                'class' => Html::cssClassFromArray([
                    'widget-element' => [
                        '' => true,
                    ],
                    'intec-grid-item' => [
                        $arVisual['LINE_COUNT'] => true,
                        '1150-3' => $arVisual['LINE_COUNT'] >= 4,
                        '950-2' => $arVisual['LINE_COUNT'] >= 3,
                        '700-1' => true
                    ]
                ], true)
            ]) ?>
                <?= Html::tag('div', '', [
                    'class' => Html::cssClassFromArray([
                        'widget-element-effect' => [
                            '' => true,
                            'active' => !$arVisual['SLIDER']['USE']
                        ]
                    ], true)
                ]) ?>
                <?php if ($arVisual['DISCOUNT']['STICKER']['SHOW'] && !empty($sDiscount)) { ?>
                    <div class="widget-element-sticker intec-cl-background">
                        <?= '-'.$sDiscount ?>
                        <?= $sDiscountType ?>
                    </div>
                <?php } ?>
                <?= Html::beginTag('div', [
                    'class' => Html::cssClassFromArray([
                        'widget-element-wrapper' => [
                            '' => true,
                            'button' => $arButton['SHOW']
                        ]
                    ], true)
                ]) ?>
                    <?php if ($arVisual['COUNT']['SHOW']) { ?>
                        <div class="widget-element-count">
                            <?= $arVisual['COUNT']['TEXT'].' '.++$iCount ?>
                        </div>
                    <?php } ?>
                    <div class="widget-element-name">
                        <?= $arItem['NAME'] ?>
                    </div>
                    <?php if ($arVisual['PRICE']['SHOW'] && !empty($arPrice)) { ?>
                        <div class="widget-element-price-wrap">
                            <div class="widget-element-price">
                                <span class="widget-element-price-value intec-cl-text">
                                    <?= $arPrice['VALUE'] ?>
                                </span>
                                <?php if (!empty($sCurrency)) { ?>
                                    <span class="widget-element-price-currency">
                                        <?= $sCurrency ?>
                                    </span>
                                <?php } ?>
                            </div>
                            <?php if (!empty($arPrice['OLD_VALUE'])) { ?>
                                <div class="widget-element-discount">
                                    <span class="widget-element-discount-value">
                                        <?= $arPrice['OLD_VALUE'] ?>
                                    </span>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($arVisual['ELEMENT_DESCRIPTION']['SHOW'] && !empty($sDescription)) { ?>
                        <div class="widget-element-description">
                            <?= $sDescription ?>
                        </div>
                    <?php } ?>
                    <?php if ($arVisual['PROPERTY_LIST']['SHOW'] && !empty($arCodes['LIST'])) { ?>
                        <div class="widget-element-property-list">
                            <?php foreach ($arCodes['LIST'] as $sCode) {

                                $arProperty = ArrayHelper::getValue($arItem, ['PROPERTIES', $sCode]);

                                if (empty($arProperty['VALUE']))
                                    continue;

                            ?>
                                <div class="widget-element-property">
                                    <?= $arProperty['VALUE'].' '.$arProperty['NAME'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($arButton['SHOW']) { ?>
                        <?= Html::tag($arButton['TAG'], $arButton['TEXT'], [
                            'class' => [
                                'widget-element-button',
                                'intec-cl-background' => [
                                    '',
                                    'light-hover'
                                ]
                            ],
                            'href' => $arButton['DETAIL_URL'],
                            'onclick' => $arButton['TYPE'] == 'order' ? 'universe.forms.show('.JavaScript::toObject($arButton['FORM']['POPUP']).')' : null
                        ]) ?>
                    <?php } ?>
                <?= Html::endTag('div') ?>
            <?= Html::endTag('div') ?>
        <?php } ?>
    <?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>