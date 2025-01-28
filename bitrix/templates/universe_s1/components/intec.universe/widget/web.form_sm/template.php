<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

?>
<div class="widget c-widget c-widget-web-form ask-question-container" id="<?= $sTemplateId ?>" data-print="false">
    <div class="web-form-container">
        <div class="intec-grid intec-grid-wrap intec-grid-a-v-center intec-grid-i-v-15 intec-grid-i-h-25">
            <div class="web-form-name intec-grid-item-auto intec-grid-item-shrink-1 intec-grid-item-1024-1">
                <div class="web-form-name-container intec-grid intec-grid-a-v-center intec-grid-i-h-25">
                    <div class="intec-grid-item intec-grid-item-1024-1">
                        <div class="web-form-name-text">
                            <?= htmlspecialcharsbx($arResult['ELEMENT']['NAME'] ?: 'Название не задано') ?>
                        </div>
                    </div>
                    <div class="web-form-name-decoration intec-grid-item-auto">
                        <div class="web-form-name-decoration-item intec-cl-background"></div>
                    </div>
                </div>
            </div>
            <div class="web-form-description intec-grid-item intec-grid-item-shrink-1 intec-grid-item-1024-1">
                <div class="web-form-description-text">
                    <?= htmlspecialcharsbx($arResult['ELEMENT']['PREVIEW_TEXT'] ?: 'Описание отсутствует') ?>
                </div>
            </div>
            <div class="web-form-buttons intec-grid-item-auto intec-grid-item-shrink-1 intec-grid-item-1024-1">
                 <a href="<?= htmlspecialcharsbx($arResult['ELEMENT']['PROPERTY_BUTTON_LINK_VALUE'] ?: '#') ?>" 
                    class="intec-ui intec-ui-control-button intec-ui-scheme-current intec-ui-size-4 intec-ui-mod-transparent intec-ui-mod-round-2 widget-web-form-2-button">
                    <?= htmlspecialcharsbx($arResult['ELEMENT']['PROPERTY_BUTTON_TEXT_VALUE'] ?: 'Текст кнопки') ?>
                 </a>
            </div>
        </div>
    </div>
</div>
