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
    <?= Html::tag($sTag, $sName, [
        'class' => "menu-item-name intec-cl-text-hover",
        'href' => $sTag == 'a' ? $sLink : null
    ])?>
</div>