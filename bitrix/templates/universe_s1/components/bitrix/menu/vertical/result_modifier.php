<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CBitrixComponentTemplate $this
 */

if (!CModule::IncludeModule('intec.core'))
    return;

$iIBlockId = ArrayHelper::getValue($arParams, 'IBLOCK_ID');
$sPropertyImage = ArrayHelper::getValue($arParams, 'PROPERTY_IMAGE');

$sPageUrl = $APPLICATION->GetCurPage();

foreach ($arResult as &$arItem) {
    $arItem['ACTIVE'] = false;

    if ($arItem['LINK'] == $sPageUrl)
        $arItem['ACTIVE'] = true;

    unset($arItem);
}

/**
 * @param array $arResult
 * @return array
 */
$fBuild = function ($arResult) {
    $bFirst = true;

    if (empty($arResult))
        return [];

    $fBuild = function () use (&$fBuild, &$bFirst, &$arResult) {
        $iLevel = null;
        $arItems = array();
        $arItem = null;

        if ($bFirst) {
            $arItem = reset($arResult);
            $bFirst = false;
        }

        while (true) {
            if ($arItem === null) {
                $arItem = next($arResult);

                if (empty($arItem))
                    break;
            }

            if ($iLevel === null)
                $iLevel = $arItem['DEPTH_LEVEL'];

            if ($arItem['DEPTH_LEVEL'] < $iLevel) {
                prev($arResult);
                break;
            }

            if ($arItem['IS_PARENT'] === true)
                $arItem['ITEMS'] = $fBuild();

            $arItems[] = $arItem;
            $arItem = null;
        }

        return $arItems;
    };

    return $fBuild();
};

foreach ($arResult as &$arItem) {
    if (!empty($arItem['PARAMS']['SECTION'])) {
        $arSection = &$arItem['PARAMS']['SECTION'];

        if (!empty($arSection[$sPropertyImage])) {
            $arItem['IMAGE'] = CFile::GetFileArray($arSection[$sPropertyImage]);
        } elseif (!empty($arSection['PICTURE'])) {
            $arItem['IMAGE'] = CFile::GetFileArray($arSection['PICTURE']);
        }
    }
}

$arResult = $fBuild($arResult);
