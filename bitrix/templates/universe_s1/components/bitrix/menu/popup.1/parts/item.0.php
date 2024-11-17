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
<?= Html::beginTag('div', [
    'class' => [
        'menu-item' => [
            '',
            'level-'.$iLevel
        ],
        'intec-grid-item' => [
            '4',
            '768-3',
            '500-2'
        ]
    ],
    'data' => [
        'role' => 'item',
        'level' => $iLevel
    ]
]) ?>
    <?= Html::tag($sTag, $sName, [
        'class' => "menu-item-name intec-cl-text-hover",
        'href' => $sTag == 'a' ? $sLink : null
    ])?>
    <?php if (!empty($arChildren)) { ?>
        <div class="menu-item-items" data-role="items">
            <?php foreach ($arChildren as $arChild) {
                $fRenderItem($arChild, $iLevel + 1, $arItem, $bActive);
            } ?>
        </div>
    <?php } ?>
<?= Html::endTag('div') ?>