<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 * @var CBitrixComponentTemplate $this
 */

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));
$this->setFrameMode(true);

$arContact = ArrayHelper::getValue($arResult, ['PROPERTIES', $arParams['PROPERTY_MAP'], 'VALUE']);
$arData = array();

if (!empty($arContact)) {
    $arCoordinates = StringHelper::explode($arContact);
    if (!empty($arCoordinates) && count($arCoordinates) == 2) {
        $arCoordinates[0] = Type::toFloat($arCoordinates[0]);
        $arCoordinates[1] = Type::toFloat($arCoordinates[1]);
    }

    if (!empty($arCoordinates)) {
        if ($arParams['MAP_VENDOR'] == 'google') {
            $arData['google_lat'] = $arCoordinates[0];
            $arData['google_lon'] = $arCoordinates[1];
            $arData['google_scale'] = 16;
        } else if ($arParams['MAP_VENDOR'] == 'yandex') {
            $arData['yandex_lat'] = $arCoordinates[0];
            $arData['yandex_lon'] = $arCoordinates[1];
            $arData['yandex_scale'] = 16;
        }

        $arData['PLACEMARKS'] = array();

        $arPlaceMark = array();

        $arPlaceMark['LAT'] = $arCoordinates[0];
        $arPlaceMark['LON'] = $arCoordinates[1];
        $arPlaceMark['TEXT'] = $arResult['NAME'];

        $arData['PLACEMARKS'][] = $arPlaceMark;
    }
}

$bMapShow = ArrayHelper::getValue($arParams, 'SHOW_MAP') == 'Y';

?>
<div class="ns-bitrix c-news-detail c-news-detail-store-1" id="<?= $sTemplateId ?>">
    <div class="news-detail-wrap" itemscope itemtype="http://schema.org/Product" data-map-show="<?= $bMapShow ? 'true' : 'false' ?>">
        <div class="intec-content">
            <div class="intec-content-wrapper">
                <div class="intec-grid intec-grid-wrap">
                    <?php if ($bMapShow) { ?>
                        <div class="intec-grid-item-2 news-detail-map intec-grid-item-800-1">
                            <?php if ($arParams['MAP_VENDOR'] == 'yandex') {
                                $APPLICATION->IncludeComponent(
                                    'bitrix:map.yandex.view',
                                    '.default',
                                    [
                                        'INIT_MAP_TYPE' => 'MAP',
                                        'MAP_DATA' => serialize($arData),
                                        'CONTROLS' => [
                                            'ZOOM',
                                        ],
                                        'OPTIONS' => [
                                            'ENABLE_SCROLL_ZOOM',
                                            'ENABLE_DBLCLICK_ZOOM',
                                            'ENABLE_DRAGGING',
                                        ],
                                        'MAP_ID' => $arParams['MAP_ID'],
                                        'MAP_WIDTH' => '100%',
                                        'MAP_HEIGHT' => '100%',
                                        'OVERLAY' => 'Y'
                                    ],
                                    $component
                                );
                            } else if ($arParams['MAP_VENDOR'] == 'google') {
                                $APPLICATION->IncludeComponent(
                                    'bitrix:map.google.view',
                                    '.default',
                                    [
                                        'INIT_MAP_TYPE' => 'MAP',
                                        'MAP_DATA' => serialize($arData),
                                        'CONTROLS' => [
                                            'ZOOM',
                                        ],
                                        'OPTIONS' => [
                                            'ENABLE_SCROLL_ZOOM',
                                            'ENABLE_DBLCLICK_ZOOM',
                                            'ENABLE_DRAGGING'
                                        ],
                                        'MAP_ID' => $arParams['MAP_ID'],
                                        'MAP_WIDTH' => '100%',
                                        'MAP_HEIGHT' => '100%',
                                        'OVERLAY' => 'Y'
                                    ],
                                    $component
                                );
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="intec-grid-item news-detail-properties intec-grid-item-800-1">
                        <?php if (!empty($arResult['ADDRESS'])) { ?>
                            <div class="news-detail-property news-detail-property-address" itemprop="description">
                                <i class="fas fa-map-marker-alt intec-cl-text"></i>
                                <div class="news-detail-property-text">
                                    <span class="news-detail-property-name">
                                        <?= Loc::getMessage('C_NEWS_DETAIL_STORE_1_ADDRESS') ?>:
                                    </span>
                                    <?= $arResult['ADDRESS'] ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($arResult['PHONE']['VALUE'])) { ?>
                            <div class="news-detail-property news-detail-property-phone" itemprop="description">
                                <i class="fas fa-phone intec-cl-text"></i>
                                <div class="news-detail-property-text">
                                    <span class="news-detail-property-name">
                                        <?= Loc::getMessage('C_NEWS_DETAIL_STORE_1_PHONE') ?>:
                                    </span>
                                    <a href="tel:<?= $arResult['PHONE']['VALUE'] ?>">
                                        <?= $arResult['PHONE']['DISPLAY'] ?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($arResult['EMAIL'])) { ?>
                            <div class="news-detail-property news-detail-property-email" itemprop="description">
                                <i class="fas fa-envelope intec-cl-text"></i>
                                <div class="news-detail-property-text">
                                    <span class="news-detail-property-name">
                                        <?= Loc::getMessage('C_NEWS_DETAIL_STORE_1_EMAIL') ?>:
                                    </span>
                                    <a href="mailto:<?= $arResult['EMAIL'] ?>">
                                        <?= $arResult['EMAIL'] ?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($arResult['SCHEDULE'])) { ?>
                            <div class="news-detail-property news-detail-property-schedule" itemprop="description">
                                <i class="far fa-clock intec-cl-text"></i>
                                <div class="news-detail-property-text">
                                    <span class="news-detail-property-name">
                                        <?= Loc::getMessage('C_NEWS_DETAIL_STORE_1_SCHEDULE') ?>:
                                    </span>
                                    <?php if (Type::isArray($arResult['SCHEDULE'])) { ?>
                                        <?php foreach ($arResult['SCHEDULE'] as $sSchedule) { ?>
                                            <div><?= $sSchedule ?></div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div><?= $arResult['SCHEDULE'] ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="news-detail-property intec-grid intec-grid-nowrap">
                            <?php if (!empty($arResult['DESCRIPTION'])) { ?>
                                <div class="intec-grid-item news-detail-description" itemprop="description">
                                    <?= $arResult['DESCRIPTION'] ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="news-detail-links">
                            <a class="news-detail-back intec-cl-text intec-cl-text-light-hover" href="javascript:history.back();">
                                <span class="news-detail-back-icon far fa-angle-left"></span>
                                <span class="news-detail-back-text">
                                    <?= Loc::getMessage('C_NEWS_DETAIL_STORE_1_BACK_URL') ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>