<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use intec\core\helpers\ArrayHelper;

/**
 * @var array $arParams
 * @var array $arResult
 */

$bSubscribe = false;

if (!CModule::IncludeModule('iblock'))
    return;

if (Loader::includeModule('subscribe'))
    $bSubscribe = true;

if (empty($arParams['FILTER_NAME']))
    $arParams['FILTER_NAME'] = 'arFilterNews';

$arDisplayIn = [
    'list',
    'detail',
    'both'
];

/** VISUAL */
$arResult['VISUAL'] = [
    'TWO_COLUMNS' => [
        'USE' => ArrayHelper::getValue($arParams, 'TWO_COLUMNS_USE') == 'Y',
        'IN' => ArrayHelper::fromRange($arDisplayIn, ArrayHelper::getValue($arParams, 'TWO_COLUMNS_IN'))
    ],
    'RIGHT_COLUMN' => [
        'NEWS_TOP' => [
            'SHOW' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_SHOW') == 'Y',
            'IN' => ArrayHelper::fromRange($arDisplayIn, ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_SHOW_IN')),
            'LINE_COUNT' => ArrayHelper::fromRange([4, 1, 2, 3, 5], ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_LINE_COUNT')),
            'HEADER' => [
                'SHOW' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_HEADER_SHOW'),
                'TEXT' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_HEADER_TEXT')
            ],
            'DATE_SHOW' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_TOP_NEWS_DATE_SHOW')
        ],
        'SUBSCRIBE' => [
            'SHOW' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_SHOW') == 'Y' && $bSubscribe,
            'IN' => ArrayHelper::fromRange($arDisplayIn, ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_SHOW_IN')),
            'RUBRICS' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_RUBRICS'),
            'TYPE' => ArrayHelper::fromRange(['html', 'text'], ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_TYPE')),
            'ALLOW_ANONYMOUS' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_ALLOW_ANONYMOUS'),
            'CONSENT' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_CONSENT'),
            'HEADER' => [
                'SHOW' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_HEADER_SHOW'),
                'POSITION' => ArrayHelper::fromRange(['center', 'left', 'right'], ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_HEADER_POSITION')),
                'TEXT' => ArrayHelper::getValue($arParams, 'RIGHT_COLUMN_SUBSCRIBE_HEADER_TEXT')
            ]
        ]
    ]
];

if ($arResult['VISUAL']['TWO_COLUMNS']['USE'] &&
    !$arResult['VISUAL']['RIGHT_COLUMN']['NEWS_TOP']['SHOW'] &&
    !$arResult['VISUAL']['RIGHT_COLUMN']['SUBSCRIBE']['SHOW']
)
    $arResult['VISUAL']['TWO_COLUMNS']['USE'] = false;