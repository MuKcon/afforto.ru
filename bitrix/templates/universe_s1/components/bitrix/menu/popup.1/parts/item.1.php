<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\Html;

/**
 * @var array $arItem
 * @var array|null $arParent
 * @var integer $iLevel
 * @var bool $bActive
 * @var string $sName
 * @var string $sLink
 * @var string $sTag
 * @var array $arChildren
 * @var Closure $fRenderItem
 */

?>
<div class="menu-item menu-item-level-<?= $iLevel ?>" data-role="item" data-level="<?= $iLevel ?>">
    <div class="menu-item-content intec-grid intec-grid-nowrap intec-grid-a-v-center intec-grid-i-h-4">
        <div class="intec-grid-item-auto">
            <?= Html::tag($sTag, $sName, [
                'class' => "menu-item-name intec-cl-text-hover",
                'href' => $sTag == 'a' ? $sLink : null
            ])?>

        </div>
        <?php if (!empty($arChildren)) { ?>
            <div class="intec-grid-item-auto" data-action="menu.item.toggle">
                <div class="menu-item-icon intec-cl-background-hover">
                    <i class="fal fa-angle-down"></i>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if (!empty($arChildren)) { ?>
        <div class="menu-item-items" data-role="items">
            <?php foreach ($arChildren as $arChild) {
                $fRenderItem($arChild, $iLevel + 1, $arItem, $bActive);
            } ?>
        </div>
    <?php } ?>
</div>