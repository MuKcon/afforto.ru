<div class="advantages">
    <div class="advantages-container">
        <h2 class="text-center"><?= htmlspecialcharsbx($arResult['TITLE']) ?></h2>
        <div class="advantages-items">
            <?php foreach ($arResult['ITEMS'] as $item): ?>
                <div class="advantages-item">
                    <div class="advantages-icon">
                        <img src="<?= htmlspecialcharsbx($item['PREVIEW_PICTURE']) ?>" alt="<?= htmlspecialcharsbx($item['NAME']) ?>">
                    </div>
                    <h3><?= htmlspecialcharsbx($item['NAME']) ?></h3>
                    <p><?= htmlspecialcharsbx($item['PREVIEW_TEXT']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
