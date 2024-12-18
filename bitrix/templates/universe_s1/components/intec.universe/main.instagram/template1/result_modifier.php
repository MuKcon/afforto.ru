<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use Bitrix\Main\Localization\Loc;
use intec\core\helpers\Type;
use intec\core\helpers\StringHelper;

/**
 * @var array $arParams
 * @var array $arResult
 */

$arMacros = [
    'SITE_DIR' => SITE_DIR,
    'SITE_TEMPLATE_PATH' => SITE_TEMPLATE_PATH.'/',
    'TEMPLATE_PATH' => $this->GetFolder().'/'
];

/** Параметры заголовка */
$sHeaderText = ArrayHelper::getValue($arParams, 'HEADER_TEXT');
$sHeaderText = trim($sHeaderText);
$sHeaderText = !empty($sHeaderText) ? $sHeaderText : Loc::getMessage('GALLERY_TEMP1_HEADER_DEFAULT');
$bHeaderShow = ArrayHelper::getValue($arParams, 'HEADER_SHOW');
$bHeaderShow = $bHeaderShow == 'Y' && !empty($sHeaderText);

$arResult['HEADER_BLOCK'] = [
    'SHOW' => $bHeaderShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'HEADER_POSITION'),
    'TEXT' => Html::encode($sHeaderText)
];

/** Параметры описания */
$sDescriptionText = ArrayHelper::getValue($arParams, 'DESCRIPTION_TEXT');
$sDescriptionText = trim($sDescriptionText);
$bDescriptionShow = ArrayHelper::getValue($arParams, 'DESCRIPTION_SHOW');
$bDescriptionShow = $bDescriptionShow == 'Y' && !empty($sDescriptionText);

$arResult['DESCRIPTION_BLOCK'] = [
    'SHOW' => $bDescriptionShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'DESCRIPTION_POSITION'),
    'TEXT' => Html::encode($sDescriptionText)
];

$iLineCount = ArrayHelper::getValue($arParams, 'LINE_COUNT');
$iMaxElements = ArrayHelper::getValue($arParams, 'COUNT_ITEMS');

if (empty($iMaxElements)) {
    $iMaxElements = null;
} else if (!Type::isNumeric($iMaxElements) || $iMaxElements <= $iLineCount) {
    $iMaxElements = $iLineCount;
}

$arResult['VIEW_PARAMETERS'] = [
    'LINE_COUNT' => $iLineCount,
    'DESCRIPTION_ITEM_SHOW' => ArrayHelper::getValue($arParams, 'DESCRIPTION_ITEM_SHOW') == 'Y',
    'PADDING_USE' => ArrayHelper::getValue($arParams, 'PADDING_USE') == 'Y',
];

/** Параметры "Смотреть все" */
$sFooterText = ArrayHelper::getValue($arParams, 'FOOTER_TEXT');
$sFooterText = trim($sFooterText);
$sFooterText = !empty($sFooterText) ? $sFooterText : Loc::getMessage('GALLERY_TEMP1_FOOTER_DEFAULT');
$bFooterShow = ArrayHelper::getValue($arParams, 'FOOTER_SHOW');
$bFooterShow = $bFooterShow == 'Y' && !empty($sFooterText);
$sListPage = ArrayHelper::getValue($arParams, 'LIST_PAGE');
$sListPage = trim($sListPage);
$sListPage = StringHelper::replaceMacros($sListPage, $arMacros);

$arResult['FOOTER_BLOCK'] = [
    'SHOW' => $bFooterShow,
    'POSITION' => ArrayHelper::getValue($arParams, 'FOOTER_POSITION'),
    'TEXT' => Html::encode($sFooterText),
    'LIST_PAGE' => $sListPage
];