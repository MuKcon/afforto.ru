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

// Если выбран инфоблок, добавляем параметр для выбора разделов
if (!empty($arCurrentValues['IBLOCK_ID'])) {
    $arSections = [];
    $dbSections = CIBlockSection::GetList(
        ['SORT' => 'ASC'], // Сортировка
        ['IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y'], // Фильтр по выбранному инфоблоку
        false,
        ['ID', 'NAME']
    );
    while ($arSection = $dbSections->Fetch()) {
        $arSections[$arSection['ID']] = '[' . $arSection['ID'] . '] ' . $arSection['NAME'];
    }

    $arTemplateParameters['SECTION_ID'] = [
        'PARENT' => 'BASE',
        'NAME' => 'Раздел для отображения',
        'TYPE' => 'LIST',
        'VALUES' => $arSections,
        'MULTIPLE' => 'N', // Один раздел
        'SIZE' => 10, // Количество строк в списке
        'ADDITIONAL_VALUES' => 'Y', // Позволяет ввести значение вручную
    ];
}

// Добавление параметра для заголовка
$arTemplateParameters['COMPONENT_TITLE'] = [
    'PARENT' => 'VISUAL',
    'NAME' => 'Заголовок блока',
    'TYPE' => 'STRING',
    'DEFAULT' => 'Преимущества', // Заголовок по умолчанию
];

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
