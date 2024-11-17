<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

/**
 * @var string $code
 * @var array $blocks
 * @var integer $banner
 * @var Closure $templateInclude($template)
 */

$display = ArrayHelper::getValue($blocks, ['active', $code], 'Y') === 'Y';
$template = ArrayHelper::getValue($blocks, ['templates', $code], 'template.1');

if ($display) { ?>
    <?php if ($template !== null) { ?>
        <?php $templateInclude($template) ?>
    <?php } ?>
<?php }