<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\StringHelper;
use intec\core\helpers\RegExp;
use intec\core\helpers\Type;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!CModule::IncludeModule('intec.core'))
    return;

$sIBlockType = $arParams['IBLOCK_TYPE'];
$iIBlockId = $arParams['IBLOCK_ID'];

$arProperties = array(
    'PROPERTY_TITLE' => 'TITLE',
    'PROPERTY_TITLE_TEXT_COLOR' => 'TITLE_TEXT_COLOR',
    'PROPERTY_DESCRIPTION' => 'DESCRIPTION',
    'PROPERTY_DESCRIPTION_TEXT_COLOR' => 'DESCRIPTION_TEXT_COLOR',
    'PROPERTY_LINK' => 'LINK',
    'PROPERTY_LINK_TARGET' => 'LINK_TARGET',
    'PROPERTY_BUTTON_SHOW' => 'BUTTON_SHOW',
    'PROPERTY_BUTTON_TEXT' => 'BUTTON_TEXT',
    'PROPERTY_BUTTON_TEXT_COLOR' => 'BUTTON_TEXT_COLOR',
    'PROPERTY_BUTTON_COLOR' => 'BUTTON_COLOR',
    'PROPERTY_POSITION' => 'POSITION',
    'PROPERTY_IMAGE' => 'IMAGE',
    'PROPERTY_IMAGE_POSITION' => 'IMAGE_POSITION',
);

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['SYSTEM_PROPERTIES'] = [];

    foreach ($arProperties as $sPropertyKey => $sPropertyName) {
        $arItem['SYSTEM_PROPERTIES'][$sPropertyName] = null;

        $sPropertyParameter = ArrayHelper::getValue($arParams, $sPropertyKey);

        if (!empty($sPropertyParameter))
            if (ArrayHelper::keyExists($sPropertyParameter, $arItem['PROPERTIES'])) {
                $arProperty = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyParameter]);

                if ($sPropertyName == 'TITLE' || $sPropertyName == 'DESCRIPTION') {
                    $sValue = ArrayHelper::getValue($arProperty, 'VALUE');

                    if (Type::isArray($sValue)) {
                        $sType = ArrayHelper::getValue($sValue, 'TYPE');
                        $sValue = ArrayHelper::getValue($sValue, 'TEXT');

                        if ($sType == 'HTML') {
                            $sValue = Html::decode($sValue);
                        }
                    }

                    $arProperty['VALUE'] = $sValue;
                }

                if ($sPropertyName == 'IMAGE') {
                    $sValue = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyParameter]);

                    if (Type::isArray($sValue)) {
                        if(!empty($sValue['VALUE'])) {
                            $img = CFile::ResizeImageGet(
                                $sValue['VALUE'],
                                array(
                                    'width' => 480,
                                    'height' => 480
                                ),
                                BX_RESIZE_IMAGE_PROPORTIONAL_ALT
                            );
                            $sValue['VALUE'] = $img['src'];
                        }
                    }
                    $arProperty = $sValue;
                }

                $arItem['SYSTEM_PROPERTIES'][$sPropertyName] = $arProperty;
        }
    }
}

unset($arItem);

//Доп. баннеры
$arCBElements = ArrayHelper::getValue($arParams, 'COMPLEX_BANNER_ELEMENTS');

if ($arCBElements) {
    $iBlockTypeCB = $arParams['IBLOCK_TYPE_COMPLEX_BANNER'];
    $iBlockIDCB = $arParams['IBLOCK_ID_COMPLEX_BANNER'];

    $arCBProperties = array(
        'PROPERTY_COMPLEX_BANNER_LINK_BLANK' => 'LINK_BLANK',
        'PROPERTY_COMPLEX_BANNER_LINK' => 'LINK',
        'PROPERTY_COMPLEX_BANNER_TEXT_COLOR' => 'TEXT_COLOR'
    );

    $i = 0;
    $arFields = array();
    $arCBFilter = array(
        'IBLOCK_TYPE' => $iBlockTypeCB,
        'IBLOCK_ID' => $iBlockIDCB,
        'ACTIVE' => 'Y',
        'ID' => $arCBElements
    );
    $rsElements = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        $arCBFilter,
        false,
        false,
        array()
    );
    while ($arElement = $rsElements->GetNextElement()) {
        $arFields[$i] = $arElement->GetFields();
        $arFields[$i]['PROPERTIES'] = $arElement->GetProperties();
        $i++;
    }
    foreach ($arFields as $key => $arItem) {
        $previewPic = ArrayHelper::getValue($arItem, 'PREVIEW_PICTURE');
        if ($previewPic) {
            $pic = CFile::ResizeImageGet(
                $previewPic,
                array(
                    'width' => 500,
                    'height' => 500
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL_ALT
            );
            $arItem['PREVIEW_PICTURE'] = $pic['src'];
        }

        $arItem['SYSTEM_PROPERTIES'] = [];

        foreach ($arCBProperties as $sPropertyKey => $sPropertyName) {
            $arItem['SYSTEM_PROPERTIES'][$sPropertyName] = null;
            $sPropertyParameter = ArrayHelper::getValue($arParams, $sPropertyKey);
            if (!empty($sPropertyParameter)) {
                if (ArrayHelper::keyExists($sPropertyParameter, $arItem['PROPERTIES'])) {
                    $arProperty = ArrayHelper::getValue($arItem, ['PROPERTIES', $sPropertyParameter]);
                    $arItem['SYSTEM_PROPERTIES'][$sPropertyName] = $arProperty;
                }
            }
        }

        $arResult['CBANNER'][$key] = $arItem;
    }
}