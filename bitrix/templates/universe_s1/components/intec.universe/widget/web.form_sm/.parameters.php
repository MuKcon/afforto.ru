<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock')) {
    return;
}

// Получаем список инфоблоков
$arIBlocks = [];
$dbIBlock = Iblock\IblockTable::getList([
    'select' => ['ID', 'NAME'],
    'order' => ['SORT' => 'ASC']
]);
while ($arIBlock = $dbIBlock->fetch()) {
    $arIBlocks[$arIBlock['ID']] = '[' . $arIBlock['ID'] . '] ' . $arIBlock['NAME'];
}

// Параметры компонента
$arTemplateParameters['IBLOCK_ID'] = [
    'PARENT' => 'BASE',
    'NAME' => 'Инфоблок',
    'TYPE' => 'LIST',
    'VALUES' => $arIBlocks,
    'REFRESH' => 'Y'
];

// Если выбран инфоблок, получаем его элементы
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arElements = [];
    $dbElements = Iblock\ElementTable::getList([
        'filter' => ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']],
        'select' => ['ID', 'NAME'],
        'order' => ['SORT' => 'ASC']
    ]);
    while ($arElement = $dbElements->fetch()) {
        $arElements[$arElement['ID']] = '[' . $arElement['ID'] . '] ' . $arElement['NAME'];
    }

    $arTemplateParameters['ELEMENT_ID'] = [
        'PARENT' => 'BASE',
        'NAME' => 'Элемент инфоблока',
        'TYPE' => 'LIST',
        'VALUES' => $arElements,
        'ADDITIONAL_VALUES' => 'Y'
    ];
}
