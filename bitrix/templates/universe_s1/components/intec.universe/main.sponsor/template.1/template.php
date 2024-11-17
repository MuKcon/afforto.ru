<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 */

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arHeader = $arResult['HEADER_BLOCK'];
$arVisual = $arResult['VISUAL'];
$arData = $arResult['SYSTEM_PROPERTIES'];

$sId = $sTemplateId.'_'.$arResult['ITEM']['ID'];
$sAreaId = $this->GetEditAreaId($sId);
$this->AddEditAction($sId, $arResult['ITEM']['EDIT_LINK']);
$this->AddDeleteAction($sId, $arResult['ITEM']['DELETE_LINK']);

?>
<?= Html::beginTag('div', [
    'id' => $sTemplateId,
    'class' => [
        'widget',
        'c-sponsor',
        'c-sponsor-template-1'
    ],
    'data-background' => $arVisual['BACKGROUND']['USE'] ? 'true' : 'false',
    'data-theme' => $arVisual['THEME'],
    'style' => [
        'background-image' => $arVisual['BACKGROUND']['USE'] ? 'url('.$arData['BACKGROUND']['SRC'].')' : null,
        'padding' => !empty($arVisual['BACKGROUND']['PADDING']) ? $arVisual['BACKGROUND']['PADDING'].'px 0' : null
    ]
]) ?>
    <div class="intec-content">
        <div class="intec-content-wrapper" id="<?= $sAreaId ?>">
            <?php if ($arHeader['SHOW']) { ?>
                <div class="widget-sponsor-header" data-align="<?= $arHeader['POSITION'] ?>">
                    <?= $arHeader['TEXT'] ?>
                </div>
            <?php } ?>
            <?= Html::beginTag('div', [
                'class' => [
                    'widget-sponsor-content',
                    'intec-grid' => [
                        '',
                        'wrap',
                        'a-v-start'
                    ]
                ],
                'data-logo' => $arVisual['LOGO']['SHOW'] ? 'true' : 'false'
            ]) ?>
                <div class="widget-sponsor-content-text-wrap intec-grid-item-auto intec-grid-item-768-1">
                    <div class="widget-sponsor-content-text">
                        <?= $arData['TEXT'] ?>
                    </div>
                </div>
                <?php if ($arVisual['LOGO']['SHOW']) { ?>
                    <div class="intec-grid-item-auto widget-sponsor-content-logo-wrap intec-grid-item-768-1">
                        <?php if ($arVisual['LOGO']['LINK']['USE']) { ?>
                            <?= Html::beginTag('a', [
                                'class' => 'widget-sponsor-content-logo-link',
                                'href' => $arData['LINK'],
                                'target' => $arVisual['LOGO']['LINK']['BLANK'] ? '_blank' : null
                            ]) ?>
                        <?php } ?>
                        <?= Html::img($arData['LOGO']['SRC'], [
                            'class' => 'widget-sponsor-content-logo',
                            'alt' => $arResult['ITEM']['NAME'],
                            'title' => $arResult['ITEM']['NAME']
                        ]) ?>
                        <?php if ($arVisual['LOGO']['LINK']['USE']) { ?>
                            <?= Html::endTag('a') ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?= Html::endTag('div') ?>
        </div>
    </div>
<?= Html::endTag('div') ?>