<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 * @var CBitrixComponentTemplate $this
 */

if (!Loader::includeModule('intec.core'))
    return;

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arTransParams = array(
    'INIT_MAP_TYPE' => $arParams['INIT_MAP_TYPE'],
    'INIT_MAP_LON' => $arResult['POSITION']['google_lon'],
    'INIT_MAP_LAT' => $arResult['POSITION']['google_lat'],
    'INIT_MAP_SCALE' => $arResult['POSITION']['google_scale'],
    'MAP_WIDTH' => '100%',
    'MAP_HEIGHT' => '100%',
    'CONTROLS' => $arParams['CONTROLS'],
    'OPTIONS' => $arParams['OPTIONS'],
    'MAP_ID' => $arParams['MAP_ID'],
    'API_KEY' => $arParams['API_KEY'],
    'OVERLAY' => 'Y'
);

$sId = Type::toString($arParams['MAP_ID']);

$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');

$arFormParameters = [];

if ($arViewParams['ORDER_CALL_SHOW']) {
    $arFormParameters = [
        'id' => $arViewParams['ORDER_CALL_FORM'],
        'template' => $arViewParams['ORDER_CALL_FORM_TEMPLATE'],
        'parameters' => [
            'AJAX_OPTION_ADDITIONAL' => $sTemplateId . '_FORM_ASK',
            'CONSENT_URL' => $arViewParams['ORDER_CALL_CONSENT']
        ],
        'settings' => [
            'title' => $arViewParams['ORDER_CALL_TITLE']
        ]
    ];

    $arButtonAttributes = [
        'class' => 'google-map-view-button intec-cl-background intec-cl-background-light-hover',
        'onclick' => 'universe.forms.show('.JavaScript::toObject($arFormParameters).')'
    ];
}

?>
<?php if ($arParams['WIDTH'] != 'Y') { ?>
    <div class="intec-content">
        <div class="intec-content-wrapper">
<?php } ?>
<div id="<?= $sTemplateId ?>" class="ns-bitrix c-google-map-view c-google-map-view-template-1">
    <?php if ($arViewParams['INFO_SHOW']) { ?>
        <div class="google-map-view-info<?= $arViewParams['BLOCK_INFO_POSITION'] == 'over' ? " block-over-map " : ""?>">
            <?php if (!empty($arViewParams['INFO_TITLE'])) { ?>
                <div class="google-map-view-info-title">
                    <?= $arViewParams['INFO_TITLE'] ?>
                </div>
            <?php } ?>
            <?php if ($arViewParams['ADDRESS_SHOW']) { ?>
                <div class="google-map-view-address google-map-view-info-block">
                    <div class="google-map-view-info-header">
                        <?= Loc::getMessage('T_MGV_TEMP1_HEADER_ADDRESS') ?>
                    </div>
                    <?php if (!empty($arViewParams['ADDRESS_CITY'])) { ?>
                        <div class="google-map-view-address-city">
                            <?= $arViewParams['ADDRESS_CITY'] ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($arViewParams['ADDRESS_STREET'])) { ?>
                        <div class="google-map-view-address-street">
                            <?= $arViewParams['ADDRESS_STREET'] ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if ($arViewParams['PHONE_SHOW'] || $arViewParams['ORDER_CALL_SHOW']) { ?>
                <div class="google-map-view-phones google-map-view-info-block">
                    <div class="google-map-view-info-header">
                        <?= Loc::getMessage('T_MGV_TEMP1_HEADER_PHONE') ?>
                    </div>
                    <div class="google-map-view-phones<?= $arViewParams['ORDER_CALL_SHOW'] ? ' with-button' : '' ?>">
                    <?php foreach ($arViewParams['PHONE_NUMBER'] as $arPhone) {?>
                        <div class="google-map-view-phone">
                            <a href="tel:<?= $arPhone['HREF'] ?>">
                                <?= $arPhone['PRINT'] ?>
                            </a>
                        </div>
                    <?php } ?>
                    </div>
                    <?php if ($arViewParams['ORDER_CALL_SHOW']) { ?>
                        <div class="google-map-view-buttons">
                            <?= Html::tag('div', $arViewParams['ORDER_CALL_TEXT'], $arButtonAttributes) ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if ($arViewParams['EMAIL_SHOW']) {?>
                <div class="google-map-view-emails google-map-view-info-block">
                    <div class="google-map-view-info-header">
                        <?= Loc::getMessage('T_MGV_TEMP1_HEADER_EMAIL') ?>
                    </div>
                    <?php foreach ($arViewParams['EMAIL_ADDRESS'] as $sEmail) {?>
                        <div class="google-map-view-email">
                            <a href="mailto:<?= $sEmail ?>">
                                <?= $sEmail ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="google-map-view-map<?= !$arViewParams['INFO_SHOW'] || $arViewParams['BLOCK_INFO_POSITION'] == 'over' ? ' full-width' : '' ?>" style="height: <?= $arParams['MAP_HEIGHT'].'px' ?>">
        <?php $APPLICATION->IncludeComponent(
            'bitrix:map.google.system',
            '.default',
            $arTransParams,
            false,
            array('HIDE_ICONS' => 'Y')
        ) ?>
    </div>
</div>
<?php if ($arParams['WIDTH'] != 'Y') { ?>
        </div>
    </div>
<?php } ?>
<script>
    (function () {
        BX.ready(function () {
            if (!window.maps) return;
            var map = window.maps[<?= JavaScript::toObject($sId) ?>];
            if (!map) return;

            <?php if (Type::isArray($arResult['POSITION']['PLACEMARKS'])) { ?>
                <?php foreach ($arResult['POSITION']['PLACEMARKS'] as $placemark) {

                    $latitude = Type::toFloat($placemark['LAT']);
                    $longitude = Type::toFloat($placemark['LON']);
                    $title = Type::toString($placemark['TEXT']);

                ?>
                    new google.maps.Marker({
                        position: new google.maps.LatLng(
                            <?= JavaScript::toObject($latitude)?>,
                            <?= JavaScript::toObject($longitude)?>
                        ),
                        map: map,
                        title: <?= JavaScript::toObject($title) ?>
                    });
                <?php } ?>
            <?php } ?>
        });
    })();
</script>

