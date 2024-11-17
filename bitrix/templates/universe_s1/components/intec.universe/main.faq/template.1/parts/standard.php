<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 * @var array $arVisual
 * @var string $sTemplateId
 */

$sIdTab = $sTemplateId.'_block';

?>
<div class="widget-elements" id="<?= $sIdTab ?>">
    <?php foreach ($arResult['ITEMS'] as $arItem) {

        $sId = $sTemplateId.'_'.$arItem['ID'];
        $sAreaId = $this->GetEditAreaId($sId);
        $this->AddEditAction($sId, $arItem['EDIT_LINK']);
        $this->AddDeleteAction($sId, $arItem['DELETE_LINK']);

        $sQuestion = ArrayHelper::getValue($arItem, 'NAME');
        $sAnswer = ArrayHelper::getValue($arItem, 'PREVIEW_TEXT');

    ?>
        <div class="widget-element-wrap">
            <div class="widget-element align-<?= $arVisual['TEXT_ALIGN'] ?>" id="<?= $sAreaId ?>">
                <div class="widget-element-question intec-cl-text-hover">
                    <div class="widget-element-question-text">
                        <span class="widget-element-question-text-wrap">
                            <?= $sQuestion ?>
                        </span>
                        <span class="widget-element-question-icon-wrapper">
                            <svg class="widget-element-question-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M443.5 162.6l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L224 351 28.5 155.5c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.7 4.8-12.3.1-17z" class=""></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="widget-element-answer">
                    <div class="widget-element-answer-text">
                        <?= $sAnswer ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php include(__DIR__.'/script.php') ?>