<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 */

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arHeader = $arResult['HEADER_BLOCK'];
$arDescription = $arResult['DESCRIPTION_BLOCK'];
$arVisual = $arResult['VISUAL'];
$arCodes = $arResult['PROPERTY_CODES'];

?>
<div class="intec-content intec-content-visible">
    <div class="intec-content-wrapper">
        <div class="widget c-rates c-rates-template-1" id="<?= $sTemplateId ?>">
            <?php if ($arHeader['SHOW'] || $arDescription['SHOW']) { ?>
                <div class="widget-header">
                    <?php if ($arHeader['SHOW']) { ?>
                        <div class="widget-title align-<?= $arHeader['POSITION'] ?>">
                            <?= $arHeader['TEXT'] ?>
                        </div>
                    <?php } ?>
                    <?php if ($arDescription['SHOW']) { ?>
                        <div class="widget-description align-<?= $arDescription['POSITION'] ?>">
                            <?= $arDescription['TEXT'] ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="widget-content-wrap">
                <?php if ($arVisual['VIEW'] == 'simple') {
                    include(__DIR__.'/parts/simple.php');
                } else if ($arVisual['VIEW'] == 'tabs') {
                    include(__DIR__.'/parts/tabs.php');
                } ?>
            </div>
        </div>
        <?php if ($arVisual['SLIDER']['USE'] || $arVisual['VIEW'] == 'tabs')
            include(__DIR__.'/script.php')
        ?>
    </div>
</div>