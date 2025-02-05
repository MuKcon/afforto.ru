<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\component\InnerTemplate;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\Type;

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $arData
 * @var InnerTemplate $this
 */

$sTemplateId = $arData['id'];
$sTemplateType = $arData['type'];
$bPanelShow = false;
$bContainerShow = false;

$arMenuMain = $arResult['MENU']['MAIN'];
$arMenuInfo = $arResult['MENU']['INFO'];

foreach (['AUTHORIZATION', 'ADDRESS', 'EMAIL'] as $sBlock)
    $bPanelShow = $bPanelShow || $arResult[$sBlock]['SHOW']['DESKTOP'];

if ($arMenuInfo['SHOW'])
    $bPanelShow = true;

$bContactsShow =
    $arResult['ADDRESS']['SHOW']['DESKTOP'] ||
    $arResult['REGIONALITY']['USE'] ||
    $arResult['EMAIL']['SHOW']['DESKTOP'];

if ($bContactsShow)
    $bPanelShow = true;

foreach (['LOGOTYPE', 'TAGLINE', 'CONTACTS', 'BASKET', 'DELAY', 'COMPARE'] as $sBlock)
    $bContainerShow = $bContainerShow || $arResult[$sBlock]['SHOW']['DESKTOP'];

$bBasketShow =
    $arResult['BASKET']['SHOW']['DESKTOP'] ||
    $arResult['DELAY']['SHOW']['DESKTOP'] ||
    $arResult['COMPARE']['SHOW']['DESKTOP'];

$sMenuPosition = false;
$sSearchPosition = false;
$sPhonesPosition = false;
$sSocialPosition = false;

if ($arMenuMain['SHOW']['DESKTOP'])
    $sMenuPosition = $arMenuMain['POSITION'];

if ($sMenuPosition === 'top')
    $bContainerShow = true;

if ($arResult['SEARCH']['SHOW']['DESKTOP']) {
    $sSearchPosition = 'bottom';

    if ($sMenuPosition == 'top')
        $sSearchPosition = 'top';
}

if ($sSearchPosition === 'top')
    $bPanelShow = true;

if ($sSearchPosition === 'bottom')
    $bContainerShow = true;

if ($arResult['CONTACTS']['SHOW']['DESKTOP'])
    $sPhonesPosition = $arResult['CONTACTS']['POSITION'];

if ($sPhonesPosition === 'top')
    $bPanelShow = true;

if ($arResult['SOCIAL']['SHOW']['DESKTOP'])
    $sSocialPosition = $arResult['SOCIAL']['POSITION'];

if ($sSocialPosition !== false)
    $bPanelShow = true;

$arContacts = [];
$arContact = null;

if ($arResult['CONTACTS']['SHOW']) {
    $arContacts = $arResult['CONTACTS']['VALUES'];
    $arContact = $arResult['CONTACTS']['SELECTED'];
}

?>
<div class="widget-view-desktop-1<?= $sMenuPosition !== 'bottom' ? ' widget-view-desktop-1-bordered' : null ?>">
    <?php //$APPLICATION->ShowViewContent('template-header-desktop-before') ?>
    <?php if ($bPanelShow) { ?>
        <div class="widget-panel">
            <div class="intec-content intec-content-visible intec-content-primary">
                <div class="intec-content-wrapper">
                    <div class="widget-panel-wrapper">
                        <?= Html::beginTag('div', [
                            'class' => [
                                'intec-grid' => [
                                    '',
                                    'wrap',
                                    'a-h-center',
                                    'a-v-center',
                                    'i-h-20',
                                    'i-v-5'
                                ]
                            ]
                        ])?>
                            <?php if ($sSocialPosition === 'left') { ?>
                                <?php include(__DIR__.'/../../../parts/social.php') ?>
                            <?php } ?>
                            <?php if (($bContactsShow && $sSocialPosition !== 'left') || $arMenuInfo['SHOW']) { ?>
                                <div class="widget-panel-items-wrap intec-grid-item-auto">
                                    <div class="widget-panel-items widget-panel-items-visible" >
                                        <div class="widget-panel-items-wrapper">
                                            <?php if ($arMenuInfo['SHOW']) { ?>
                                                <div class="widget-panel-item">
                                                    <div class="widget-panel-item-wrapper">
                                                        <?php include(__DIR__.'/parts/menu/info.php') ?>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <?php include(__DIR__.'/parts/region.php') ?>
                                                <?php include(__DIR__.'/parts/address.php') ?>
                                                <?php include(__DIR__.'/parts/email.php') ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($sSocialPosition === 'center') { ?>
                                <div class="intec-grid-item"></div>
                                <?php include(__DIR__.'/../../../parts/social.php') ?>
                            <?php } ?>
                            <div class="intec-grid-item"></div>
                            <?php if ($sPhonesPosition === 'top') { ?>
                                <div class="widget-panel-phone-wrap intec-grid-item-auto">
                                    <div class="widget-panel-phone intec-ui-align intec-grid intec-grid-a-v-center" data-block="phone" data-multiple="<?= !empty($arContacts) ? 'true' : 'false' ?>" data-expanded="false">
                                        <div class="widget-panel-phone-icon intec-ui-icon intec-ui-icon-phone-1 intec-cl-text"></div>
                                        <div class="widget-panel-phone-content intec-grid intec-grid-o-vertical">
                                            <div class="widget-panel-phone-wrapper intec-grid intec-grid-o-vertical">
                                                <?php if ($arResult['CONTACTS']['ADVANCED']) { ?>
                                                    <?php foreach ($arContact as $arContactItem) { ?>
                                                        <a href="tel:<?= $arContactItem['PHONE']['VALUE'] ?>" class="tel widget-panel-phone-text intec-cl-text-hover" data-block-action="popup.open">
                                                            <span class="value"><?= $arContactItem['PHONE']['DISPLAY'] ?></span>
                                                        </a>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php foreach ($arContact as $arContactItem) { ?>
                                                        <a href="tel:<?= $arContactItem['VALUE'] ?>" class="tel widget-panel-phone-text intec-cl-text-hover" data-block-action="popup.open">
                                                            <span class="value"><?= $arContactItem['DISPLAY'] ?></span>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if (!empty($arContacts)) { ?>
                                                <div class="widget-panel-phone-popup" data-block-element="popup">
                                                    <div class="widget-panel-phone-popup-wrapper scrollbar-inner">
                                                        <?php if ($arResult['CONTACTS']['ADVANCED']) {
                                                            $sScheduleString = '';
                                                        ?>
                                                            <?php foreach ($arContacts as $arContact) { ?>
                                                                <div class="widget-panel-phone-popup-contacts">
                                                                    <?php if (!empty($arContact['PHONE'])) { ?>
                                                                        <a href="tel:<?= $arContact['PHONE']['VALUE'] ?>" class="tel widget-panel-phone-popup-contact phone intec-cl-text-hover">
                                                                            <span class="value"><?= $arContact['PHONE']['DISPLAY'] ?></span>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if (!empty($arContact['ADDRESS'])) { ?>
                                                                        <div class="adr widget-panel-phone-popup-contact address">
                                                                            <span class="locality"><?= $arContact['ADDRESS'] ?></span>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if (!empty($arContact['SCHEDULE'])) { ?>
                                                                        <div class="widget-panel-phone-popup-contact schedule">
                                                                            <?php if (is_array($arContact['SCHEDULE'])) { ?>
                                                                                <?php foreach ($arContact['SCHEDULE'] as $sValue) { ?>
                                                                                    <?= $sValue ?>
                                                                                    <?php $sScheduleString .= $sValue.', '; ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?= $arContact['SCHEDULE'] ?>
                                                                                <?php $sScheduleString .= $arContact['SCHEDULE'].', '; ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if (!empty($arContact['EMAIL'])) { ?>
                                                                        <a href="mailto:<?= $arContact['EMAIL'] ?>" class="email widget-panel-phone-popup-contact email intec-cl-text-hover">
                                                                            <?= $arContact['EMAIL'] ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php }
                                                                $sScheduleString = substr($sScheduleString, 0, (strlen($sScheduleString) - 2));
                                                            ?>
                                                            <span class="workhours">
                                                                <span class="value-title" title="<?=$sScheduleString?>"></span>
                                                            </span>
                                                            <?php unset($sScheduleString); ?>
                                                        <?php } else { ?>
                                                            <?php foreach ($arContacts as $arContact) { ?>
                                                                <a href="tel:<?= $arContact['VALUE'] ?>" class="tel widget-panel-phone-popup-item intec-cl-text-hover">
                                                                    <span class="value"><?= $arContact['DISPLAY'] ?></span>
                                                                </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($arContacts)) { ?>
                                            <div class="widget-panel-phone-arrow" data-block-action="popup.open">
                                                <i class="far fa-chevron-down"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (($bContactsShow && $arMenuInfo['SHOW']) || ($bContactsShow && $sSocialPosition === 'left')) { ?>
                                <div class="widget-panel-items-wrap intec-grid-item-auto">
                                    <div class="widget-panel-items widget-panel-items-visible">
                                        <div class="widget-panel-items-wrapper">
                                            <?php include(__DIR__.'/parts/region.php') ?>
                                            <?php include(__DIR__.'/parts/address.php') ?>
                                            <?php include(__DIR__.'/parts/email.php') ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (
                                $arResult['AUTHORIZATION']['SHOW']['DESKTOP'] ||
                                $sSearchPosition === 'top'
                            ) { ?>
                                <div class="widget-panel-buttons-wrap intec-grid-item-auto">
                                    <div class="widget-panel-buttons">
                                        <div class="widget-panel-buttons-wrapper">
                                            <?php if ($sSearchPosition === 'top') { ?>
                                                <div class="widget-panel-button">
                                                    <div class="widget-panel-button-wrapper">
                                                        <?php $arSearchParams = [
                                                            'INPUT_ID' => $arParams['SEARCH_INPUT_ID'].'-desktop'
                                                        ] ?>
                                                        <?php include(__DIR__.'/../../../parts/search/popup.1.php') ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($arResult['AUTHORIZATION']['SHOW']['DESKTOP']) { ?>
                                                <?php include(__DIR__.'/../../../parts/auth/panel.1.php') ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?= Html::endTag('div') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($bContainerShow) { ?>
        <div class="widget-container">
            <div class="intec-content intec-content-visible intec-content-primary">
                <div class="intec-content-wrapper">
                    <?= Html::beginTag('div', [
                        'class' => [
                            'widget-container-wrapper',
                            'intec-grid' => [
                                '',
                                'nowrap',
                                'a-h-start',
                                'a-v-center',
                                'i-h-10'
                            ]
                        ]
                    ]) ?>
                        <?php if ($arResult['LOGOTYPE']['SHOW']['DESKTOP']) { ?>
                            <div class="widget-container-logotype-wrap intec-grid-item-auto">
                                <?= Html::beginTag($arResult['LOGOTYPE']['LINK']['USE'] ? 'a' : 'div', [
                                    'href' => $arResult['LOGOTYPE']['LINK']['USE'] ? $arResult['LOGOTYPE']['LINK']['VALUE'] : null,
                                    'class' => Html::cssClassFromArray([
                                        'widget-container-item' => true,
                                        'widget-container-logotype' => true,
                                        'intec-ui-picture' => true
                                    ], true),
                                    'style' => [
                                        'width' => $arResult['LOGOTYPE']['DESKTOP']['WIDTH'].'px'
                                    ]
                                ]) ?>
                                    <?php include(__DIR__.'/../../../parts/logotype.php') ?>
                                <?= Html::endTag($arResult['LOGOTYPE']['LINK']['USE'] ? 'a' : 'div') ?>
                            </div>
                        <?php } ?>
                        <?php if ($arResult['TAGLINE']['SHOW']['DESKTOP']) { ?>
                            <div class="widget-container-tagline-wrap intec-grid-item-auto">
                                <div class="widget-container-item widget-container-tagline">
                                    <?php if ($arResult['LOGOTYPE']['SHOW']['DESKTOP']) { ?>
                                        <div class="widget-container-tagline-delimiter"></div>
                                    <?php } ?>
                                    <div class="widget-container-tagline-text">
                                        <?= $arResult['TAGLINE']['VALUE'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($sMenuPosition === 'top') { ?>
                            <div class="widget-container-menu-wrap intec-grid-item intec-grid-item-shrink-1">
                                <div class="widget-container-item widget-container-menu">
                                    <?php $arMenuParams = [
                                        'TRANSPARENT' => 'Y'
                                    ] ?>
                                    <?php include(__DIR__.'/../../../parts/menu/main.horizontal.1.php') ?>
                                </div>
                            </div>
                        <?php } else if ($sSearchPosition === 'bottom') { ?>
                            <div class="widget-container-search-wrap intec-grid-item">
                                <div class="widget-container-item widget-container-search">
                                    <?php include(__DIR__.'/../../../parts/search/input.1.php') ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="intec-grid-item"></div>
                        <?php } ?>

                        <?php if ($sPhonesPosition === 'bottom') { ?>
                            <div class="widget-container-contacts-wrap intec-grid-item-auto">
                                <div class="widget-container-item widget-container-contacts" data-block="phone" data-multiple="<?= !empty($arContacts) ? 'true' : 'false' ?>" data-expanded="false">
                                    <div class="widget-container-phone">
                                        <div class="widget-container-phone-icon intec-ui-icon intec-ui-icon-phone-1 intec-cl-text"></div>
                                        <div class="widget-container-phone-content">
                                            <?php if ($arResult['CONTACTS']['ADVANCED']) { ?>
                                                <?php foreach ($arContact as $arContactItem) { ?>
                                                    <a id="top_1" href="tel:<?= $arContactItem['PHONE']['VALUE'] ?>" class="tel widget-container-phone-text intec-cl-text-hover" data-block-action="popup.open">
                                                        <span class="value"><?= $arContactItem['PHONE']['DISPLAY'] ?></span>
                                                    </a>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php foreach ($arContact as $arContactItem) { ?>
                                                    <a id="top_2" href="tel:<?= $arContactItem['VALUE'] ?>" class="tel widget-container-phone-text intec-cl-text-hover" data-block-action="popup.open">
                                                        <span class="value"><?= $arContactItem['DISPLAY'] ?></span>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if (!empty($arContacts)) { ?>
                                                <div class="widget-container-phone-popup" data-block-element="popup">
                                                    <div class="widget-container-phone-popup-wrapper scrollbar-inner">
                                                        <?php if ($arResult['CONTACTS']['ADVANCED']) {
                                                            $sScheduleString = '';
                                                            ?>
                                                            <?php foreach ($arContacts as $arContact) { ?>
                                                                <div class="widget-container-phone-popup-contacts">
                                                                    <?php if (!empty($arContact['PHONE'])) { ?>
                                                                        <a id="top_3" href="tel:<?= $arContact['PHONE']['VALUE'] ?>" class="tel widget-container-phone-popup-contact phone intec-cl-text-hover">
                                                                            <span class="value"><?= $arContact['PHONE']['DISPLAY'] ?></span>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if (!empty($arContact['ADDRESS'])) { ?>
                                                                        <div class="widget-container-phone-popup-contact address adr">
                                                                            <?php if (Type::isArray($arContact['ADDRESS'])) { ?>
                                                                                <?php foreach ($arContact['ADDRESS'] as $sValue) { ?>
                                                                                    <div class="locality"><?= $sValue ?></div>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <span class="locality"><?= $arContact['ADDRESS'] ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if (!empty($arContact['SCHEDULE'])) { ?>
                                                                        <div  class="widget-container-phone-popup-contact schedule">
                                                                            <?php if (Type::isArray($arContact['SCHEDULE'])) { ?>
                                                                                <?php foreach ($arContact['SCHEDULE'] as $sValue) { ?>
                                                                                    <?= $sValue ?>
                                                                                    <?php $sScheduleString .= $sValue.', '; ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?= $arContact['SCHEDULE'] ?>
                                                                                <?php $sScheduleString .= $arContact['SCHEDULE'].', '; ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if (!empty($arContact['EMAIL'])) { ?>
                                                                        <a href="mailto:<?= $arContact['EMAIL'] ?>" class="widget-container-phone-popup-contact email intec-cl-text-hover">
                                                                            <span class="value"><?= $arContact['EMAIL'] ?></span>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php }
                                                            $sScheduleString = substr($sScheduleString, 0, (strlen($sScheduleString) - 2));
                                                            ?>
                                                            <span class="workhours">
                                                                <span class="value-title" title="<?=$sScheduleString?>"></span>
                                                            </span>
                                                        <?php
                                                            unset($sScheduleString);
                                                        } else { ?>
                                                            <?php foreach ($arContacts as $arContact) { ?>
                                                                <a href="tel:<?= $arContact['VALUE'] ?>" class="tel widget-container-phone-popup-item intec-cl-text-hover">
                                                                    <?= $arContact['DISPLAY'] ?>
                                                                </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($arContacts)) { ?>
                                            <div class="widget-container-phone-arrow far fa-chevron-down" data-block-action="popup.open"></div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($arResult['FORMS']['CALL']['SHOW']) { ?>
                                        <div class="widget-container-button-wrap">
                                            <div class="widget-container-button intec-cl-text-hover intec-cl-border-hover" data-action="forms.call.open">
                                                <?= Loc::getMessage('C_HEADER_TEMP1_DESKTOP_TEMP1_BUTTON') ?>
                                            </div>
                                            <?php include(__DIR__.'/../../../parts/forms/call.php') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($bBasketShow) { ?>
                            <div class="widget-container-basket-wrap intec-grid-item-auto">
                                <div class="widget-container-item widget-container-basket">
                                    <?php include(__DIR__.'/../../../parts/basket.php') ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?= Html::endTag('div') ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($sMenuPosition === 'bottom') { ?>
        <?= Html::beginTag('div', [
            'class' => Html::cssClassFromArray([
                'widget-menu' => [
                    '' => true,
                    'transparent' => $arResult['MENU']['MAIN']['TRANSPARENT']
                ]
            ], true)
        ]) ?>
            <?php if ($arResult['MENU']['MAIN']['TRANSPARENT']) $arMenuParams = [
                'TRANSPARENT' => $arResult['MENU']['MAIN']['TRANSPARENT'] ? 'Y' : 'N'
            ] ?>
            <?php include(__DIR__.'/../../../parts/menu/main.horizontal.1.php') ?>
        <?= Html::endTag('div') ?>
    <?php } ?>
    <?php if ($sPhonesPosition !== false && !empty($arContacts) && !defined('EDITOR')) { ?>
        <script type="text/javascript">
            template.load(function (data) {
                var $ = this.getLibrary('$');
                var root = data.nodes;
                var block = $('[data-block="phone"]', root);
                var popup = $('[data-block-element="popup"]', block);
                var scrollContacts = $('.scrollbar-inner', popup);

                popup.open = $('[data-block-action="popup.open"]', block);
                popup.open.on('mouseenter', function () {
                    block.attr('data-expanded', 'true');
                });

                block.on('mouseleave', function () {
                    block.attr('data-expanded', 'false');
                });

                scrollContacts.scrollbar();
            }, {
                'name': '[Component] intec.universe:main.header (template.1) > desktop (template.1) > phone.expand',
                'nodes': <?= JavaScript::toObject('#'.$sTemplateId) ?>,
                'loader': {
                    'name': 'lazy'
                }
            });
        </script>
    <?php } ?>
    <?php //$APPLICATION->ShowViewContent('template-header-desktop-after') ?>
</div>
