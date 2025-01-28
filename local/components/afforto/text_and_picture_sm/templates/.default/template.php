<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$imagePosition = $arResult['IMAGE_POSITION'] === 'left' ? 'image-left' : 'image-right';
$hasDetailImage = !empty($arResult['DETAIL_IMAGE']);
?>

<div class="textandpicture-component <?= $imagePosition ?>">
    <div class="text-center">
        <h2 class="textandpicture-title"><?= htmlspecialcharsbx($arResult['TITLE']) ?></h2>
    </div>

    <div class="textandpicture-container <?= !$hasDetailImage ? 'no-detail-image' : '' ?>">
        <!-- Если детальная картинка есть, выводим её -->
        <?php if ($hasDetailImage): ?>
            <div class="textandpicture-image detail-image">
                <img src="<?= htmlspecialcharsbx($arResult['DETAIL_IMAGE']) ?>" alt="<?= htmlspecialcharsbx($arResult['TITLE']) ?>">
            </div>
        <?php endif; ?>

        <!-- Блок текста -->
        <div class="textandpicture-content">
            <p class="textandpicture-short-description"><?= $arResult['SHORT_DESCRIPTION'] ?></p>
            <div class="textandpicture-detailed-description"><?= $arResult['DETAILED_DESCRIPTION'] ?></div>
        </div>

        <!-- Если анонсная картинка есть, выводим её -->
        <?php if ($arResult['PREVIEW_IMAGE']): ?>
            <div class="textandpicture-image preview-image">
                <img src="<?= htmlspecialcharsbx($arResult['PREVIEW_IMAGE']) ?>" alt="<?= htmlspecialcharsbx($arResult['TITLE']) ?>">
            </div>
        <?php endif; ?>
    </div>
</div>
