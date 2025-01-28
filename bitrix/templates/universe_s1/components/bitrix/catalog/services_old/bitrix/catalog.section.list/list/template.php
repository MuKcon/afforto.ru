<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use intec\core\bitrix\Component;
use intec\core\helpers\Html;

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

$bDisplaySections = !empty($arResult['SECTIONS']);
$this->setFrameMode(true);
$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));
?>
<div class="services-sections services-sections-list">
    <?php if ($bDisplaySections) { ?>
        <div class="services-sections-items">
            <div class="services-sections-items-wrapper">
                <?php $bFiresItem = true ?>
                <?php foreach ($arResult['SECTIONS'] as $arSection) { ?>
                <?php
                    $sId = $sTemplateId.'_'.$arSection['ID'];
                    $sAreaId = $this->GetEditAreaId($sId);
                    $this->AddEditAction($sId, $arSection['EDIT_LINK']);
                    $this->AddDeleteAction($sId, $arSection['DELETE_LINK']);
                    $sImage = $arSection['PICTURE'];

                    $sImage = CFile::ResizeImageGet($sImage, array(
                        'width' => 480,
                        'height' => 195
                    ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);

                    if (!empty($sImage)) {
                        $sImage = $sImage['src'];
                    } else {
                        $sImage = null;
                    }
                ?>
                    <?php if (!$bFiresItem) { ?>
                        <div class="services-sections-delimiter">
                            <div class="services-sections-delimiter-wrapper"></div>
                        </div>
                    <?php } ?>
                    <div class="services-sections-item">
                        <div class="services-sections-item-wrapper" id="<?= $sAreaId ?>">
                            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="services-sections-item-image intec-image-effect" style="background-image: url('<?= $sImage ?>')"></a>
                            <div class="services-sections-item-information">
                                <div class="services-sections-item-name">
                                    <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="services-sections-item-name-wrapper intec-cl-text">
                                        <?= $arSection['NAME'] ?>
                                    </a>
                                </div>
                                <div class="services-sections-item-description">
                                    <?= $arSection['DESCRIPTION'] ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php if ($bFiresItem) $bFiresItem = false ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>