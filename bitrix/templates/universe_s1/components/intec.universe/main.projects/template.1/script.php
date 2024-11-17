<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 * @var array $arVisual
 */

$arSlider = $arVisual['SLIDER'];

$arResponsiveReady = [];
if ($arSlider['USE']) {
    $arResponsive = [
        '1' => ['0' => ['items' => '1']],
        '2' => ['651' => ['items' => '2']],
        '3' => ['951' => ['items' => '3']],
        '4' => ['1151' => ['items' => $arVisual['LINE_COUNT']]]
    ];

    foreach ($arResponsive as $iKey => $arElement) {
        if ($iKey <= $arVisual['LINE_COUNT']) {
            $arResponsiveReady += $arElement;
        }
    }
}

?>
<script>
    (function ($, api) {
        var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
        <?php if ($arSlider['USE']) { ?>
            var slider;

            slider = <?= JavaScript::toObject([
                'use' => $arSlider['USE'],
                'items' => $arVisual['LINE_COUNT'],
                'loop' => $arSlider['LOOP'],
                'speed' => $arSlider['SPEED'],
                'controls' => [
                    'nav' => $arSlider['CONTROLS']['NAV'],
                    'dots' => $arSlider['CONTROLS']['DOTS']
                ],
                'auto' => [
                    'use' => $arSlider['AUTO']['USE'],
                    'time' => $arSlider['AUTO']['TIME'],
                    'speed' => $arSlider['SPEED'],
                    'pause' => $arSlider['AUTO']['PAUSE']
                ],
                'responsive' => $arResponsiveReady
            ]) ?>;

            slider = $('.owl-carousel', root).owlCarousel({
                'items': slider.items,
                'autoplay': slider.auto.use,
                'autoplaySpeed': slider.auto.speed,
                'autoplayTimeout': slider.auto.time,
                'autoplayHoverPause': slider.auto.pause,
                'loop': slider.loop,
                'nav': slider.controls.nav,
                'navText': [
                    '<i class="fal fa-angle-left"></i>',
                    '<i class="fal fa-angle-right"></i>'
                ],
                'dots': slider.controls.dots,
                'dotsData': false,
                'responsive': slider.responsive
            });
        <?php } ?>
        <?php if ($arVisual['VIEW'] == 'tabs') { ?>
        var nav = $('.nav.nav-tabs', root);
        var element = $('li a', nav);

        element.on('click', function () {
            var self = $(this);
            element.removeClass('intec-cl-background');
            self.addClass('intec-cl-background');
        });
        <?php } ?>
    })(jQuery, intec);
</script>