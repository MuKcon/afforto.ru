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
        var handler;
        var slider;

        settings = <?= JavaScript::toObject([
            'selector' => $arVisual['SELECTOR'],
            'attribute' => $arVisual['ATTRIBUTE'],
            'class' => $arVisual['CLASS'],
            'slider' => [
                'use' => $arSlider['USE'],
                'speed' => $arSlider['SPEED'],
                'loop' => $arSlider['LOOP'],
                'dots' => $arSlider['DOTS'],
                'nav' => $arSlider['NAV'],
                'auto' => [
                    'use' => $arSlider['AUTO']['USE'],
                    'speed' => $arSlider['SPEED'],
                    'time' => $arSlider['AUTO']['TIME'],
                    'pause' => $arSlider['AUTO']['PAUSE']
                ]
            ]
        ]) ?>;

        slider = settings.slider;
        handler = function () {
            var container;
            var element;
            var color;

            if (settings.slider.use) {
                element = $('.owl-item.active .widget-slide', root);
            } else {
                element = $('.widget-slide', root).eq(0);
            }

            color = element.data('color');

            if (color === 'white') {
                color = 'black';
            } else {
                color = 'white';
            }

            root.attr('data-color', color);

            if (settings.selector) {
                container = root.closest(settings.selector);

                if (settings.attribute)
                    container.attr(settings.attribute, color);

                if (settings.class) {
                    container.removeClass(settings.class + '-white');
                    container.removeClass(settings.class + '-black');
                    container.addClass(settings.class + '-' + color);
                }
            }
        };

        if (slider.use) {
            slider.use = false;

            slider = $('.owl-carousel', root).owlCarousel({
                'items': 1,
                'autoplay': slider.auto.use,
                'autoplaySpeed': slider.auto.speed,
                'autoplayTimeout': slider.auto.time,
                'autoplayHoverPause': slider.auto.pause,
                'loop': slider.loop,
                'nav': slider.nav,
                'navText': [
                    '<i class="fal fa-angle-left intec-cl-background-hover"></i>',
                    '<i class="fal fa-angle-right intec-cl-background-hover"></i>'
                ],
                'dots': slider.dots,
                'onInitialized': function () {
                    settings.slider.use = true;
                    handler();
                },
                'onTranslated': handler
            });
        }

        $(document).on('ready', handler);

        handler();
    })(jQuery, intec)
</script>