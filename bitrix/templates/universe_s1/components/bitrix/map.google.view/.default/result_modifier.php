<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 * @var array $arParams
 */

$arResult['VISUAL'] = [
    'OVERLAY' => ArrayHelper::getValue($arParams, 'OVERLAY') == 'Y'
];