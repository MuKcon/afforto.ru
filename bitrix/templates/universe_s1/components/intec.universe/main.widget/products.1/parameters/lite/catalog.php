<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\collections\Arrays;

/**
 * @var array $arCurrentValues
 */

$arPrices = Arrays::fromDBResult(CStartShopPrice::GetList([
    'SORT' => 'ASC'
], [
    'ACTIVE' => 'Y'
]))->asArray(function ($iIndex, $arPrice) {
    return [
        'key' => $arPrice['CODE'],
        'value' => '['.$arPrice['CODE'].'] '.$arPrice['LANG'][LANGUAGE_ID]['NAME']
    ];
});