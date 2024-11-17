<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 * @var array $arVisual
 */

$arSlider = $arVisual['SLIDER'];
$arResponsiveReady = [];

if ($arSlider['ITEMS'] > 1) {
    $arResponsive = [
        '1' => ['0' => ['items' => 1]],
        '2' => ['1001' => ['items' => 2]]
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

            <?php if ($arSlider['USE']) { ?>
                var slider = $('.owl-carousel', root).owlCarousel({
                    items: <?= $arSlider['ITEMS'] ?>,
                    autoplay: <?= $arSlider['AUTO_PLAY_USE'] ? 'true' : 'false' ?>,
                    autoplaySpeed: <?= !empty($arSlider['SLIDE_SPEED']) ? $arSlider['SLIDE_SPEED'] : '500' ?>,
                    autoplayTimeout: <?= !empty($arSlider['AUTO_PLAY_TIME']) ? $arSlider['AUTO_PLAY_TIME'] : '10000' ?>,
                    autoplayHoverPause: <?= $arSlider['AUTO_PLAY_PAUSE'] ? 'true' : 'false' ?>,
                    loop: <?= $arSlider['LOOP'] ? 'true' : 'false' ?>,
                    nav: false,
                    navText: ['', ''],
                    dots: true,
                    dotsData: false,
                    <?php if ($arSlider['ITEMS'] > 1) { ?>
                        responsive: <?= $arResponsiveReady ?>
                    <?php } ?>
                });
            <?php } ?>

            <?php if (!defined('EDITOR') && $arVisual['VIDEO']['SHOW']) { ?>
                $('.widget-element-video-wrap', root).lightGallery();
            <?php } ?>
        });
    })(jQuery, intec)
</script>