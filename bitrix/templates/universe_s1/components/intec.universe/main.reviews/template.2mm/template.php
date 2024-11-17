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
$arDescription = $arResult['DESCRIPTION_BLOCK'];
$arFooter = $arResult['FOOTER_BLOCK'];
$arVisual = $arResult['VISUAL'];
$arCodes = $arResult['PROPERTY_CODES'];

$iCount = count($arResult['ITEMS']);
$iCounter = 0;

$bNoHeaderButtonTop = !$arHeader['SHOW'] && !$arDescription['SHOW'] && $arFooter['POSITION'] == 'top-right';
$bNoHeaderButtonTop = $bNoHeaderButtonTop ? ' no-header' : null;

?>
<div class="intec-content">
    <div class="intec-content-wrapper">
        <div class="widget c-reviews c-reviews-template-2<?= $bNoHeaderButtonTop ?>" id="<?= $sTemplateId ?>">
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
            <div class="widget-content owl-carousel">
                <?php foreach ($arResult['ITEMS'] as $arItem) {

                    $sId = $sTemplateId.'_'.$arItem['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arItem['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

                    $iCounter++;

                    $sName = ArrayHelper::getValue($arItem, 'NAME');
                    $sDescription = ArrayHelper::getValue($arItem, 'DETAIL_TEXT');
                    $sPicture = ArrayHelper::getValue($arItem, ['PREVIEW_PICTURE', 'SRC']);
                    $sPosition = ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['POSITION'], 'VALUE']);

                    $arLogotype = [
                        'SHOW' => false,
                        'PICTURE' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['LOGOTYPE'], 'VALUE']),
                        'LINK' => ArrayHelper::getValue($arItem, ['PROPERTIES', $arCodes['LINK'], 'VALUE']),
                        'TAG' => 'div'
                    ];
                    $arLogotype['SHOW'] = $arVisual['LOGOTYPE_SHOW'] && !empty($arLogotype['PICTURE']);
                    $arLogotype['TAG'] = $arLogotype['SHOW'] && !empty($arLogotype['LINK']) ? 'a' : $arLogotype['TAG'];

                ?>
                    <div class="widget-element-wrap">
                        <div class="widget-element clearfix" id="<?= $sAreaId ?>">
                            <div class="widget-element-picture-wrap">
                                <?= Html::tag('div', '', [ /** Картинка элемента */
                                    'class' => 'widget-element-picture',
                                    'style' => [
                                        'background-image' => 'url('.$sPicture.')'
                                    ]
                                ]) ?>
                                <?php if ($arVisual['COUNTER_SHOW']) { ?>
                                    <div class="widget-element-date">
                                        <?= $iCounter.'/'.$iCount ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="widget-element-info">
                                <div class="widget-element-description">
                                    <?= $sDescription ?>
                                </div>
                                <div class="widget-element-data-wrap clearfix">
                                    <div class="widget-element-data">
                                        <div class="widget-element-name">
                                            <?= $sName ?>
                                        </div>
                                        <?php if ($arVisual['POSITION_SHOW'] && !empty($sPosition)) { ?>
                                            <div class="widget-element-position">
                                                <?= $sPosition ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($arLogotype['SHOW']) { ?>
                                        <?= Html::beginTag($arLogotype['TAG'], [ /** Логотип */
                                            'class' => 'widget-element-logo-wrap',
                                            'href' => $arLogotype['TAG'] == 'a' ? $arLogotype['LINK'] : null,
                                            'target' => $arLogotype['TAG'] == 'a' ? '_blank' : null
                                        ]) ?>
                                            <?= Html::img($arLogotype['PICTURE']) ?>
                                        <?= Html::endTag($arLogotype['TAG']) ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($arFooter['SHOW']) { ?>
                <div class="widget-footer align-<?= $arFooter['POSITION'] ?>">
                    <a class="widget-footer-all" href="<?= $arFooter['LIST_PAGE'] ?>">
                        <span class="widget-footer-all-text">
                            <?= $arFooter['TEXT'] ?>
                        </span>
                        <svg class="widget-footer-all-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path>
                        </svg>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php include(__DIR__.'/script.php') ?>
    </div>
</div>