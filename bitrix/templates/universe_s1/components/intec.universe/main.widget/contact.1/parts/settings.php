<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use intec\constructor\models\Build;

if (
    Loader::includeModule('intec.constructor') ||
    Loader::includeModule('intec.constructorlite')
) {
    if (!defined('EDITOR')) {
        $build = Build::getCurrent();

        if (!empty($build)) {
            $page = $build->getPage();
            $properties = $page->getProperties();
            $propertiesUse = $properties->get('use_global_settings');

            if ($propertiesUse) {
                $arParams['MAP_VENDOR'] = $properties->get('map_vendor');
                $arParams['~MAP_VENDOR'] = $arParams['MAP_VENDOR'];
            }
        }
    }
}