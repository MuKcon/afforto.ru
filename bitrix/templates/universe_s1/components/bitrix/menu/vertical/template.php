<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

$this->setFrameMode(true);
$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

if (!in_array($arParams['TYPE_SUBMENU'], array('default', 'picture', 'picture_with_submenu'))) {
    $arParams['TYPE_SUBMENU'] = 'default';
}

?>
<?php $fDraw = function ($arItem, $iLevel) use (&$fDraw, &$arParams, &$useArrow) {
    $arItems = $arItem['ITEMS'];

    if (!empty($arItems)) {
        foreach($arItems as $key=>$value) {
            if (!empty($value['IMAGE'])) {
                $sImage = CFile::ResizeImageGet($value['IMAGE'], array(
                    'width' => 45,
                    'height' => 45
                ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);

                if (!empty($sImage)) {
                    $sImage = $sImage['src'];
                } else {
                    $sImage = null;
                }

                $arItems[$key]['PICTURE'] = $sImage;
            }
        }
    }
?>
    <?php if ($arParams['TYPE_SUBMENU'] == 'default') { ?>
        <div class="catalog-menu-submenu catalog-menu-submenu-<?= $iLevel ?>" data-role="menu">
            <div class="catalog-menu-submenu-wrapper">
                <?php foreach ($arItems as $arItem) {

                    $bSelected = ArrayHelper::getValue($arItem, 'SELECTED');
                    $bSelected = Type::toBoolean($bSelected);
                    $bActive = ArrayHelper::getValue($arItem, 'ACTIVE');
                    $sTag = $bActive ? 'div' : 'a';

                ?>
                    <div class="catalog-menu-submenu-item<?= $bSelected ? ' catalog-menu-submenu-item-active' : null ?>" data-role="item">
                        <?= Html::beginTag($sTag, [
                            'class' => [
                                'catalog-menu-submenu-item-text',
                                'intec-cl-text-hover'
                            ],
                            'href' => !$bActive ? $arItem['LINK'] : null
                        ]) ?>
                            <?= $arItem['TEXT'] ?>
                            <?php if (!empty($arItem['ITEMS'])) { ?>
                                <div class="menu-vertical-item-arrow far fa-angle-right"></div>
                            <?php } ?>
                        <?= Html::endTag($sTag) ?>
                        <?php if (!empty($arItem['ITEMS'])) $fDraw($arItem, $iLevel + 1) ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else if ($arParams['TYPE_SUBMENU'] == 'picture') { ?>
        <div class="catalog-menu-submenu catalog-menu-submenu-picture" data-role="menu">
            <div class="catalog-menu-submenu-wrapper auto-clear">
                <?php foreach ($arItems as $arItem) {

                    $bSelected = ArrayHelper::getValue($arItem, 'SELECTED');
                    $bSelected = Type::toBoolean($bSelected);
                    $bActive = ArrayHelper::getValue($arItem, 'ACTIVE');
                    $sTag = $bActive ? 'div' : 'a';

                ?>
                    <div class="catalog-menu-item-picture<?= $bSelected ? ' catalog-menu-submenu-item-active' : null ?>" data-role="item">
                        <?php if ($arItem['PICTURE']) { ?>
                            <?= Html::beginTag($sTag, [
                                'class' => 'catalog-menu-item-picture-wrap',
                                'href' => !$bActive ? $arItem['LINK'] : null
                            ]) ?>
                                <div class="image intec-image">
                                    <div class="intec-aligner"></div>
                                    <img src="<?= $arItem['PICTURE'] ?>" alt="<?= $arItem['TEXT'] ?>" title="<?= $arItem['TEXT'] ?>"/>
                                </div>
                            <?= Html::endTag($sTag) ?>
                        <?php } ?>
                        <?= Html::tag($sTag, $arItem['TEXT'], [
                            'class' => [
                                'catalog-menu-item-pucture-text',
                                'intec-cl-text-hover'
                            ],
                            'href' => !$bActive ? $arItem['LINK'] : null
                        ]) ?>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } else if ($arParams['TYPE_SUBMENU'] == 'picture_with_submenu') { ?>
        <div class="catalog-menu-submenu catalog-menu-submenu-picture" data-role="menu">
            <div class="catalog-menu-submenu-wrapper auto-clear">
                <?php foreach ($arItems as $arItem) {

                    $bSelected = ArrayHelper::getValue($arItem, 'SELECTED');
                    $bSelected = Type::toBoolean($bSelected);
                    $bActive = ArrayHelper::getValue($arItem, 'ACTIVE');
                    $sTag = $bActive ? 'div' : 'a';

                ?>
                    <div class="catalog-menu-item-picture<?= $bSelected ? ' catalog-menu-submenu-item-active' : null ?>" data-role="item">
                        <?php if ($arItem['PICTURE']) { ?>
                            <?= Html::beginTag($sTag, [
                                'class' => 'catalog-menu-item-picture-wrap',
                                'href' => !$bActive ? $arItem['LINK'] : null
                            ]) ?>
                                <div class="image intec-image">
                                    <div class="intec-aligner"></div>
                                    <img src="<?= $arItem['PICTURE'] ?>" alt="<?= $arItem['TEXT'] ?>" title="<?= $arItem['TEXT'] ?>"/>
                                </div>
                            <?= Html::endTag($sTag) ?>
                        <?php } ?>
                        <?= Html::tag($sTag, $arItem['TEXT'], [
                            'class' => [
                                'catalog-menu-item-pucture-text',
                                'intec-cl-text-hover'
                            ],
                            'href' => !$bActive ? $arItem['LINK'] : null
                        ]) ?>
                        <?php if ($arItem['ITEMS']) { ?>
                            <div class="catalog-menu-sub-item-picture">
                                <?php foreach($arItem['ITEMS'] as $subItem) {

                                    $bSubItemActive = ArrayHelper::getValue($arItem, 'ACTIVE');
                                    $sSubItemTag = $bSubItemActive ? 'div' : 'a';

                                ?>
                                    <?= Html::tag($sSubItemTag, $subItem['TEXT'], [
                                        'class' => 'intec-cl-text-hover',
                                        'href' => !$bSubItemActive ? $subItem['LINK'] : null
                                    ]) ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!empty($arResult)) { ?>
    <div id="<?= $sTemplateId ?>" class="catalog-menu catalog-menu-vertical">
        <div class="catalog-menu-wrapper">
            <?php foreach ($arResult as $arItem) {

                $bSelected = ArrayHelper::getValue($arItem, 'SELECTED');
                $bSelected = Type::toBoolean($bSelected);
                $bActive = ArrayHelper::getValue($arItem, 'ACTIVE');
                $sTag = $bActive ? 'div' : 'a';

            ?>
                <div class="catalog-menu-item intec-cl-text-hover<?= $bSelected ? ' catalog-menu-item-active intec-cl-background intec-cl-border' : null ?>" data-role="item">
                    <?= Html::beginTag($sTag, [
                        'class' => 'catalog-menu-item-text',
                        'href' => !$bActive ? $arItem['LINK'] : null
                    ]) ?>
                        <?= $arItem['TEXT'] ?>
                        <?php if (!empty($arItem['ITEMS'])) { ?>
                            <div class="menu-vertical-item-arrow far fa-angle-right"></div>
                        <?php } ?>
                    <?= Html::endTag($sTag) ?>
                    <?php if (!empty($arItem['ITEMS'])) $fDraw($arItem, 1) ?>
                </div>
            <?php } ?>
        </div>
        <script type="text/javascript">
            (function ($, api) {
                $(document).ready(function () {
                    var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
                    var items = root.find('[data-role=item]');
                    var getItemMenu = function (item) {
                        return $(item).children('[data-role=menu]');
                    };

                    items.on('mouseover', function () {
                        var menu = getItemMenu(this);

                        menu.show().stop().animate({
                            'opacity': 1
                        }, 300);
                    }).on('mouseout', function () {
                        var menu = getItemMenu(this);

                        menu.stop().animate({
                            'opacity': 0
                        }, 300, function () {
                            menu.hide();
                        });
                    });
                });
            })(jQuery, intec);
        </script>
    </div>
<?php } ?>