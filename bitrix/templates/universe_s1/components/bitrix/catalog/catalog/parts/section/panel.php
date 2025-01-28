<?php if (defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true) ?>
<?php

use intec\core\helpers\Html;

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $arSort
 * @var array $arViews
 * @var array $arFilter
 * @var array $arElements
 * @var CBitrixComponent
 */

?>
<div class="catalog-panel intec-grid intec-grid-nowrap intec-grid-i-h-10 intec-grid-a-v-center">
    <?php if ($arFilter['SHOW']) { ?>
        <div class="catalog-panel-filter intec-grid-item-auto">
            <div class="catalog-panel-filter-button intec-cl-background" data-role="filter.button">
                <i class="far fa-filter"></i>
            </div>
        </div>
    <?php } ?>
    <div class="catalog-panel-sorting intec-grid-item-auto" data-order="<?= $arSort['ORDER'] ?>">
        <div class="catalog-panel-sorting-wrapper intec-grid intec-grid-nowrap intec-grid-i-h-10 intec-grid-a-v-center">
            <?php foreach ($arSort['PROPERTIES'] as $sSortProperty => $arSortProperty) { ?>
            <?php
                $sSortOrder = $arSort['ORDER'];

                if ($arSortProperty['ACTIVE'])
                    $sSortOrder = $arSort['ORDER'] === 'asc' ? 'desc' : 'asc';
            ?>
                <?= Html::beginTag('a', [
                    'href' => $APPLICATION->GetCurPageParam('sort='.$arSortProperty['VALUE'].'&order='.$sSortOrder, ['sort', 'order']),
                    'class' => [
                        'catalog-panel-sort',
                        'intec-grid-item-auto',
                        $arSortProperty['ACTIVE'] ? 'intec-cl-text' : 'intec-cl-text-hover'
                    ],
                    'data' => [
                        'active' => $arSortProperty['ACTIVE'] ? 'true' : 'false'
                    ]
                ]) ?>
                    <i class="catalog-panel-sort-icon <?= $arSortProperty['ICON'] ?>"></i>
                    <div class="catalog-panel-sort-text">
                        <?= $arSortProperty['NAME'] ?>
                    </div>
                    <div class="catalog-panel-sort-order">
                        <i class="catalog-panel-sort-order-icon catalog-panel-sort-order-icon-asc far fa-angle-up"></i>
                        <i class="catalog-panel-sort-order-icon catalog-panel-sort-order-icon-desc far fa-angle-down"></i>
                    </div>
                <?= Html::endTag('a') ?>
            <?php } ?>
            <?php
                unset($sSortOrder);
                unset($arSortProperty);
                unset($sSortProperty);
            ?>
        </div>
    </div>
    <div class="intec-grid-item"></div>
    <div class="catalog-panel-views intec-grid-item-auto">
        <div class="catalog-panel-views-wrapper intec-grid intec-grid-nowrap intec-grid-i-h-10 intec-grid-a-v-center">
            <?php foreach($arViews as $sView => $arView) { ?>
                <?= Html::beginTag('a', [
                    'href' => $APPLICATION->GetCurPageParam('view='.$arView['VALUE'], ['view']),
                    'class' => [
                        'catalog-panel-view',
                        'intec-grid-item-auto'
                    ],
                    'data' => [
                        'active' => $arView['ACTIVE'] ? 'true' : 'false'
                    ]
                ]) ?>
                    <i class="<?= $arView['ICON'] ?>"></i>
                <?= Html::endTag('a') ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php if ($arFilter['SHOW']) { ?>
    <div class="catalog-filter-mobile" data-role="filter">
        <?php $APPLICATION->IncludeComponent(
            'bitrix:catalog.smart.filter',
            'vertical.1',
            [
                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'SECTION_ID' => $arSection['ID'],
                'FILTER_NAME' => $arParams['FILTER_NAME'],
                'PRICE_CODE' => $arParams['FILTER_PRICE_CODE'],
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME'],
                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                'SAVE_IN_SESSION' => 'N',
                'XML_EXPORT' => 'Y',
                'SECTION_TITLE' => 'NAME',
                'SECTION_DESCRIPTION' => 'DESCRIPTION',
                'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'SEF_MODE' => $arParams['SEF_MODE'],
                'SEF_RULE' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['smart_filter'],
                'SMART_FILTER_PATH' => $arResult['VARIABLES']['SMART_FILTER_PATH'],
                'PAGER_PARAMS_NAME' => $arParams['PAGER_PARAMS_NAME'],
                'MOBILE' => 'Y'
            ],
            $component
        ) ?>
    </div>
<?php } ?>