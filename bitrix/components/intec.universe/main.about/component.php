<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\StringHelper;

/**
 * @var array $arResult
 * @var array $arParams
 */

if ($this->startResultCache()) {
    $arResult = [
        'FILE_PATH' => null
    ];

    $sPath = ArrayHelper::getValue($arParams, 'FILE_PATH', null);
    $sPath = trim($sPath);

    if (!empty($sPath))
        $arResult['FILE_PATH'] = StringHelper::replaceMacros($sPath, ['SITE_DIR' => SITE_DIR]);

    $this->includeComponentTemplate();
}