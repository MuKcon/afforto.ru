<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

// Проверяем подключение модуля инфоблоков
if (!Loader::includeModule('iblock')) {
    return;
}

// Получение списка инфоблоков
$arIBlocks = [];
$dbIBlock = CIBlock::GetList(
    ['SORT' => 'ASC'], // Сортировка
    ['ACTIVE' => 'Y']  // Только активные инфоблоки
);
while ($arIBlock = $dbIBlock->Fetch()) {
    $arIBlocks[$arIBlock['ID']] = '[' . $arIBlock['ID'] . '] ' . $arIBlock['NAME'];
}

// Параметр выбора инфоблока
$arTemplateParameters['IBLOCK_ID'] = [
    'PARENT' => 'BASE',
    'NAME' => 'Инфоблок для данных',
    'TYPE' => 'LIST',
    'VALUES' => $arIBlocks,
    'REFRESH' => 'Y', // При изменении обновляет параметры
];

// Если выбран инфоблок, добавляем параметр для выбора элемента
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arElements = [];
    $dbElements = CIBlockElement::GetList(
        ['SORT' => 'ASC'], // Сортировка
        ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y'], // Фильтр по выбранному инфоблоку
        false,
        false,
        ['ID', 'NAME']
    );
    while ($arElement = $dbElements->Fetch()) {
        $arElements[$arElement['ID']] = '[' . $arElement['ID'] . '] ' . $arElement['NAME'];
    }

    $arTemplateParameters['ELEMENT_ID'] = [
        'PARENT' => 'BASE',
        'NAME' => 'Элемент для отображения',
        'TYPE' => 'LIST',
        'VALUES' => $arElements,
        'ADDITIONAL_VALUES' => 'Y', // Позволяет ввести значение вручную
    ];
}

// Настройки кэша
$arTemplateParameters['CACHE_TYPE'] = [
    'PARENT' => 'CACHE_SETTINGS',
    'NAME' => 'Тип кэширования',
    'TYPE' => 'LIST',
    'VALUES' => [
        'A' => 'Авто',
        'Y' => 'Кэшировать',
        'N' => 'Не кэшировать',
    ],
    'DEFAULT' => 'A',
];

$arTemplateParameters['CACHE_TIME'] = [
    'PARENT' => 'CACHE_SETTINGS',
    'NAME' => 'Время кэширования (секунды)',
    'TYPE' => 'STRING',
    'DEFAULT' => '3600',
];
