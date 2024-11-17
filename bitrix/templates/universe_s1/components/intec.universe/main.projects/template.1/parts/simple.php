<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var array $arVisual
 * @var string $sTemplateId
 * @var string $sTag
 */

?>
<?= Html::beginTag('div', [
    'class' => Html::cssClassFromArray([
        'widget-content' => [
            '' => true,
            'slider' => $arVisual['SLIDER']['USE'],
            'slider-nav' => $arVisual['SLIDER']['USE'] && $arVisual['SLIDER']['CONTROLS']['NAV'],
            'slider-dots' => $arVisual['SLIDER']['USE'] && $arVisual['SLIDER']['CONTROLS']['DOTS']
        ],
        'intec-grid' => [
            '' => !$arVisual['SLIDER']['USE'],
            'wrap' => !$arVisual['SLIDER']['USE'],
            'a-v-start' => !$arVisual['SLIDER']['USE'],
            'a-h-center' => !$arVisual['SLIDER']['USE']
        ],
        'owl-carousel' => $arVisual['SLIDER']['USE'],
    ], true)
]) ?>
    <?php foreach ($arResult['ITEMS'] as $arItem) {

        $sId = $sTemplateId.'_'.$arItem['ID'];
        $sAreaId = $this->GetEditAreaId($sId);
        $this->AddEditAction($sId, $arItem['EDIT_LINK']);
        $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

        $sDetailUrl = $arItem['DETAIL_PAGE_URL'];
        $sPreviewPicture = $arItem['PREVIEW_PICTURE']['SRC'];
        $sName = $arItem['NAME'];

    ?>
        <?= Html::beginTag('div', [
            'id' => $sAreaId,
            'class' => Html::cssClassFromArray([
                'widget-element' => true,
                'intec-grid-item' => [
                    $arVisual['LINE_COUNT'] => !$arVisual['SLIDER']['USE'],
                    '1100-3' => !$arVisual['SLIDER']['USE'] && $arVisual['LINE_COUNT'] >= 4,
                    '900-2' => !$arVisual['SLIDER']['USE'] && $arVisual['LINE_COUNT'] >= 3,
                    '600-1' => !$arVisual['SLIDER']['USE']
                ]
            ], true)
        ]) ?>
            <?= Html::beginTag($sTag, [
                'class' => 'widget-element-wrapper',
                'href' => $sTag == 'a' ? $sDetailUrl : null,
                'style' => [
                    'background-image' => 'url('.$sPreviewPicture.')'
                ]
            ]) ?>
                <div class="widget-element-name-wrap">
                    <div class="widget-element-name">
                        <?= $sName ?>
                    </div>
                </div>
            <?= Html::endTag($sTag) ?>
        <?= Html::endTag('div') ?>
    <?php } ?>
<?= Html::endTag('div') ?>