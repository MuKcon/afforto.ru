<?php

use Bitrix\Main\Loader;
use intec\constructor\models\Build;
use intec\core\helpers\ArrayHelper;

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
                $mapVendor = $properties->get('map_vendor');

                $arParams['MAP_VENDOR'] = $mapVendor;
            }
        }
    }
}