<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var array $arVisual
 * @var array $arResponsiveReady
 * @var string $sTemplateId
 */

$arSlider = $arVisual['SLIDER'];
$arResponsiveReady = [];

if ($arSlider['USE']) {
    $arResponsive = [
        '1' => ['0' => ['items' => 1]],
        '2' => ['551' => ['items' => 2]],
        '3' => ['751' => ['items' => 3]],
        '4' => ['901' => ['items' => 4]],
        '5' => ['1051' => ['items' => 5]]
    ];

    foreach ($arResponsive as $iKey => $arLineElements) {
        if ($iKey <= $arSlider['ITEMS'])
            $arResponsiveReady += $arLineElements;
    }

    $arResponsiveReady = JavaScript::toObject($arResponsiveReady);
}

?>
<script>
    (function ($, api) {
        $(document).ready(function () {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);

            <?php if (!defined('EDITOR')) { ?>
                $('.widget-content', root).lightGallery();
            <?php } ?>

            <?php if ($arSlider['USE']) { ?>
                var slider = $('.owl-carousel', root).owlCarousel({
                    items: <?= $arSlider['ITEMS'] ?>,
                    autoplay: <?= $arSlider['AUTO_PLAY_USE'] ? 'true' : 'false' ?>,
                    autoplaySpeed: <?= !empty($arSlider['AUTO_PLAY_SPEED']) ? $arSlider['AUTO_PLAY_SPEED'] : '500' ?>,
                    autoplayTimeout: <?= !empty($arSlider['AUTO_PLAY_TIME']) ? $arSlider['AUTO_PLAY_TIME'] : '10000' ?>,
                    autoplayHoverPause: <?= $arSlider['AUTO_PLAY_HOVER_PAUSE'] ? 'true' : 'false' ?>,
                    loop: <?= $arSlider['LOOP_USE'] ? 'true' : 'false' ?>,
                    nav: false,
                    navText: ['', ''],
                    dots: true,
                    dotsData: false,
                    responsive: <?= $arResponsiveReady ?>
                });
            <?php } ?>
        });
    })(jQuery, intec);
</script>
