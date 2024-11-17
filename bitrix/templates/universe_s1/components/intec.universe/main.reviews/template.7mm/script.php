<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var array $arVisual
 * @var string $sTemplateId
 */

$arSlider = $arVisual['SLIDER'];

?>
<script type="text/javascript">
    (function ($, api) {
        var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
        var settings;
        var slider;

        settings = <?= JavaScript::toObject([
            'slider' => [
                'loop' => $arSlider['LOOP'],
                'dots' => $arSlider['DOTS'],
                'nav' => $arSlider['NAV'],
                'auto' => [
                    'use' => $arSlider['AUTO']['USE'],
                    'time' => $arSlider['AUTO']['TIME'],
                    'speed' => $arSlider['AUTO']['SPEED'],
                    'pause' => $arSlider['AUTO']['PAUSE']
                ]
            ]
        ]) ?>;

        slider = settings.slider;

        slider = $('.owl-carousel', root).owlCarousel({
            'items': 1,
            'autoplay': slider.auto.use,
            'autoplaySpeed': slider.auto.speed,
            'autoplayTimeout': slider.auto.time,
            'autoplayHoverPause': slider.auto.pause,
            'loop': slider.loop,
            'nav': slider.nav,
            'navText': [
                '<i class="far fa-angle-left"></i>',
                '<i class="far fa-angle-right"></i>'
            ],
            'dots': slider.dots
        });
    })(jQuery, intec)
</script>