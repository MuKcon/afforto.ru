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

$bFirstTab = true;

?>
<div class="widget-tabs">
    <?= Html::beginTag('ul', [
        'class' => [
            'nav',
            'nav-tabs',
            'widget-tabs-content' => [
                '',
                $arVisual['TABS']['POSITION']
            ]
        ]
    ]) ?>
        <?php foreach ($arResult['SECTIONS'] as $arSection) {

            if (empty($arSection['ITEMS']))
                continue;

        ?>
            <?= Html::beginTag('li', [
                'class' => Html::cssClassFromArray([
                    'widget-tabs-element' => true,
                    'active' => $bFirstTab
                ], true)
            ]) ?>
                <?= Html::tag('a', $arSection['NAME'], [
                    'href' => '#'.$sTemplateId.'_'.$arSection['ID'],
                    'class' => Html::cssClassFromArray([
                        'widget-tabs-element-name' => true,
                        'intec-cl-background' => $bFirstTab,
                        'intec-cl-background-hover' => true,
                        'intec-cl-border' => true
                    ], true),
                    'data-toggle' => 'tab'
                ]) ?>
            <?= Html::endTag('li') ?>
            <?php $bFirstTab = false ?>
        <?php } ?>
    <?= Html::endTag('ul') ?>
</div>
<div class="widget-tabs-container tab-content">
    <?php $bFirstTab = true ?>
    <?php foreach ($arResult['SECTIONS'] as $arSection) { ?>
        <?php if (!empty($arSection['ITEMS'])) {

            $iCount = 0;

        ?>
            <?= Html::beginTag('div', [
                'id' => $sTemplateId.'_'.$arSection['ID'],
                'class' => Html::cssClassFromArray([
                    'widget-tabs-tab' => true,
                    'tab-pane fade' => true,
                    'in active' => $bFirstTab
                ], true)
            ]) ?>
                <?php if ($arVisual['SECTION']['DESCRIPTION']['SHOW'] && !empty($arSection['DESCRIPTION'])) { ?>
                    <?= Html::tag('div', $arSection['DESCRIPTION'], [
                        'class' => [
                            'widget-tabs-tab-description' => [
                                '',
                                $arVisual['SECTION']['DESCRIPTION']['POSITION']
                            ]
                        ]
                    ]) ?>
                <?php } ?>
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
                        <?php foreach ($arSection['ITEMS'] as $arItem) {

                            if ($arVisual['SECTION']['MAX_COUNT']['USE'] && $arVisual['SECTION']['MAX_COUNT']['VALUE'] <= $iCount)
                                break;

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
                                    <?php } ?>
                                    <?php if ($arVisual['ELEMENT_DESCRIPTION']['SHOW'] && !empty($sDescription)) { ?>
                                        <div class="widget-element-description">
                                            <?= $sDescription ?>
                                        </div>
                                    <?php } ?>
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
                                        </div>
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
            <?= Html::endTag('div') ?>
            <?php $bFirstTab = false ?>
            <?php if (defined('EDITOR')) break ?>
        <?php } ?>
    <?php } ?>
</div>