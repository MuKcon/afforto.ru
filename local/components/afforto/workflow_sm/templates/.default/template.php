<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="workflow-component">
    <h2><?= htmlspecialcharsbx($arResult['HEADER']) ?></h2>
    <div class="workflow-stages">
        <?php foreach ($arResult['STAGES'] as $stage): ?>
            <div class="workflow-stage">
                <div class="workflow-icon">
                    <img src="<?= htmlspecialcharsbx($stage['ICON']) ?>" alt="<?= htmlspecialcharsbx($stage['TITLE']) ?>">
                </div>
                <h3><?= htmlspecialcharsbx($stage['TITLE']) ?></h3>
                <p><?= htmlspecialcharsbx($stage['DESCRIPTION']['TEXT']['TEXT']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
