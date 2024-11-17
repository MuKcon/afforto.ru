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
        'c-event-promo',
        'c-event-promo-template-1'
    ],
    'data-theme' => $arVisual['THEME'],
    'style' => [
        'background-image' => $arVisual['BACKGROUND']['USE'] ? 'url('.$arData['BACKGROUND']['SRC'].')' : null,
        'padding' => !empty($arVisual['BACKGROUND']['PADDING']) ? $arVisual['BACKGROUND']['PADDING'].'px 0' : null
    ]
]) ?>
    <div class="intec-content">
        <div class="intec-content-wrapper" id="<?= $sAreaId ?>">
            <?php if ($arHeader['SHOW']) { ?>
                <div class="widget-event-promo-header" data-align="<?= $arHeader['POSITION'] ?>">
                    <?= $arHeader['TEXT'] ?>
                </div>
            <?php } ?>
            <?= Html::beginTag('div', [
                'class' => [
                    'widget-event-promo-content',
                    'intec-grid' => [
                        '',
                        'wrap',
                        'a-v-start'
                    ]
                ]
            ]) ?>
                <div class="<?= Html::cssClassFromArray([
                    'widget-event-promo-content-text-wrap' => true,
                    'intec-grid-item' => [
                        'auto' => !$arVisual['PICTURE']['SHOW'],
                        '2' => $arVisual['PICTURE']['SHOW'],
                        '768-1' => $arVisual['PICTURE']['SHOW']
                    ]
                ], true) ?>">
                    <div class="widget-event-promo-content-text" data-align="<?= $arVisual['TEXT']['POSITION'] ?>">
                        <?= $arData['TEXT'] ?>
                    </div>
                    <?php if ($arVisual['BUTTON']['SHOW']) { ?>
                        <div class="widget-event-promo-content-button-wrap" data-align="<?= $arVisual['BUTTON']['POSITION'] ?>">
                            <?= Html::tag('a', $arVisual['BUTTON']['TEXT'], [
                                'class' => [
                                    'widget-event-promo-content-button',
                                    'intec-cl-background-light',
                                    'intec-cl-background-dark-hover'
                                ],
                                'href' => $arVisual['BUTTON']['LINK'],
                                'data-role' => $arVisual['BUTTON']['MODE'] == 'anchor' ? 'button' : null
                            ]) ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($arVisual['PICTURE']['SHOW']) { ?>
                    <div class="<?= Html::cssClassFromArray([
                        'widget-event-promo-content-picture-wrap' => true,
                        'intec-grid-item' => [
                            'auto' => !$arVisual['PICTURE']['SHOW'],
                            '2' => $arVisual['PICTURE']['SHOW']
                        ]
                    ], true) ?>">
                        <?= Html::img($arData['PICTURE']['SRC'], [
                            'class' => 'widget-event-promo-content-picture',
                            'alt' => $arResult['ITEM']['NAME'],
                            'title' => $arResult['ITEM']['NAME']
                        ]) ?>
                    </div>
                <?php } ?>
            <?= Html::endTag('div') ?>
        </div>
    </div>
<?= Html::endTag('div') ?>
<?php if ($arVisual['BUTTON']['MODE'] == 'anchor')
    include(__DIR__.'/parts/script.php')
?>
