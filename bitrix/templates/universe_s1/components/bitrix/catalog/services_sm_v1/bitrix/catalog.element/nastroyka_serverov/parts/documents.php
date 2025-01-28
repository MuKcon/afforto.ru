<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\FileHelper;
use intec\core\helpers\StringHelper;

/**
* @var array $arData
* @var string $sHeaderDocuments
* @var array $bDocumentsValue
*/
?>

<div class="gallery-section">
    <div class="service-caption">
        <?= $sHeaderDocuments ?>
    </div>
    <div class="service-documents intec-grid intec-grid-wrap intec-grid-a-h-start intec-grid-i-5 intec-grid-a-v-stretch">
        <?php foreach ($bDocumentsValue as $arDocument){ ?>
            <?
            $sExtension = FileHelper::getFileExtension($arDocument['SRC']);
            $sFileName = FileHelper::getFileNameWithoutExtension('-'.$arDocument['ORIGINAL_NAME']);
            $sFileName = StringHelper::cut($sFileName, 1);
            $sFileSize = CFile::FormatSize($arDocument['FILE_SIZE']);
            ?>
            <div class="intec-grid-item-4 intec-grid-item-1000-3 intec-grid-item-800-2 intec-grid-item-600-1">
                <a class="service-documents-item intec-cl-text-hover" target="_blank" href="<?= $arDocument['SRC'] ?>">
                    <span class="service-documents-file-name"><?= $sFileName ?></span>
                    <span class="service-documents-file-size"><?= $sFileSize; ?></span>
                    <span class="service-documents-file-extension">.<?= $sExtension; ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>