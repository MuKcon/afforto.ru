<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\constructor\models\build\Template;

global $data;

/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global array $settings
 * @global Template $template
 */

?>
<?php $APPLICATION->IncludeComponent(
    'intec.constructor:template',
    '',
    array(
        'TEMPLATE_ID' => $template->id,
        'DISPLAY' => 'FOOTER',
        'DATA' => $data,
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => 3600
    ),
    false,
    array('HIDE_ICONS' => 'Y')
); ?>