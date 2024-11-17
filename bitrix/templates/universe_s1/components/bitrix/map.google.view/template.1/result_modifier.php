<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\Type;

/**
 * @var array $arResult
 * @var array $arParams
 */

$sAddressCity = ArrayHelper::getValue($arParams, 'ADDRESS_CITY');
$sAddressCity = trim($sAddressCity);
$sAddressCity = !empty($sAddressCity) ? $sAddressCity : null;
$sAddressStreet = ArrayHelper::getValue($arParams, 'ADDRESS_STREET');
$sAddressStreet = trim($sAddressStreet);
$bAddressShow = ArrayHelper::getValue($arParams , 'ADDRESS_SHOW');
$bAddressShow = $bAddressShow == 'Y' && (!empty($sAddressCity) || !empty($sAddressStreet));

$arPhoneNumber = ArrayHelper::getValue($arParams, 'PHONE_NUMBER');
$arPhoneNumber = array_filter($arPhoneNumber);
$bPhoneShow = ArrayHelper::getValue($arParams, 'PHONE_SHOW');
$bPhoneShow = $bPhoneShow == 'Y' && !empty($arPhoneNumber);

foreach ($arPhoneNumber as $iKey => $sPhone) {
    $arPhone = [
        'PRINT' => $sPhone,
        'HREF' => StringHelper::replace($sPhone, [
            '(' => '',
            ')' => '',
            ' ' => '',
            '-' => ''
        ])
    ];

    $arPhoneNumber[$iKey] = $arPhone;
}

$arEmailAddress = ArrayHelper::getValue($arParams, 'EMAIL_ADDRESS');
$arEmailAddress = array_filter($arEmailAddress);
$bEmailAddressShow = ArrayHelper::getValue($arParams, 'EMAIL_SHOW');
$bEmailAddressShow = $bEmailAddressShow == 'Y' && !empty($arEmailAddress);

$bInfoShow = ArrayHelper::getValue($arParams, 'INFO_SHOW');
$bInfoShow = $bInfoShow == 'Y' && ($bAddressShow || $bPhoneShow || $bEmailAddressShow);
$sInfoTitle = ArrayHelper::getValue($arParams, 'INFO_TITLE');
$sInfoTitle = trim($sInfoTitle);

$sOrderCallConsent = ArrayHelper::getValue($arParams, 'ORDER_CALL_CONSENT');
$sOrderCallConsent = trim($sOrderCallConsent);
$sOrderCallConsent = StringHelper::replaceMacros($sOrderCallConsent, ['SITE_SIR' => SITE_DIR]);
$sOrderCallForm = ArrayHelper::getValue($arParams, 'ORDER_CALL_FORM');
$sOrderCallFormTemplate = ArrayHelper::getValue($arParams, 'ORDER_CALL_FORM_TEMPLATE');
$sOrderCallTitle = ArrayHelper::getValue($arParams, 'ORDER_CALL_TITLE');
$sOrderCallTitle = trim($sOrderCallTitle);
$sOrderCallText = ArrayHelper::getValue($arParams, 'ORDER_CALL_TEXT');
$sOrderCallText = trim($sOrderCallText);
$sOrderCallText = !empty($sOrderCallText) ? $sOrderCallText : Loc::getMessage('T_MGV_TEMP1_FORM_CALL_TEXT_DEFAULT');
$bOrderCallShow = ArrayHelper::getValue($arParams, 'ORDER_CALL_SHOW');
$bOrderCallShow = $bOrderCallShow == 'Y' && !empty($sOrderCallForm);

$bOverlay = ArrayHelper::getValue($arParams, 'OVERLAY') == 'Y';

$arResult['VIEW_PARAMETERS'] = [
    'WIDTH' => ArrayHelper::getValue($arParams, 'WIDTH') == 'Y',
    'INFO_SHOW' => $bInfoShow,
    'BLOCK_INFO_POSITION' => ArrayHelper::getValue($arParams, 'BLOCK_INFO_VIEW'),
    'INFO_TITLE' => Html::encode($sInfoTitle),
    'ADDRESS_SHOW' => $bAddressShow,
    'ADDRESS_CITY' => $sAddressCity,
    'ADDRESS_STREET' => $sAddressStreet,
    'PHONE_SHOW' => $bPhoneShow,
    'PHONE_NUMBER' => $arPhoneNumber,
    'ORDER_CALL_SHOW' => $bOrderCallShow,
    'ORDER_CALL_FORM' => $sOrderCallForm,
    'ORDER_CALL_FORM_TEMPLATE' => $sOrderCallFormTemplate,
    'ORDER_CALL_CONSENT' => $sOrderCallConsent,
    'ORDER_CALL_TITLE' => Html::encode($sOrderCallTitle),
    'ORDER_CALL_TEXT' => Html::encode($sOrderCallText),
    'EMAIL_SHOW' => $bEmailAddressShow,
    'EMAIL_ADDRESS' => $arEmailAddress,
    'OVERLAY' => $bOverlay
];