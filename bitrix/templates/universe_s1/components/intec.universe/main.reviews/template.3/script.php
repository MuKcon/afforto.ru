<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var array $arVisual
 * @var string $sTemplateId
 */

$arSlider = $arVisual['SLIDER'];

?>
<script>
    (function ($, api) {
        $(document).ready(function () {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
            var slider = $('.owl-carousel', root).owlCarousel({
                items: 1,
                autoplay: <?= $arSlider['AUTO_PLAY_USE'] ? 'true' : 'false' ?>,
                autoplaySpeed: <?= $arSlider['SLIDE_SPEED'] ?>,
                autoplayTimeout: <?= $arSlider['AUTO_PLAY_TIME'] ?>,
                autoplayHoverPause: <?= $arSlider['AUTO_PLAY_PAUSE'] ? 'true' : 'false' ?>,
                loop: <?= $arSlider['LOOP'] ? 'true' : 'false' ?>,
                nav: true,
                navText: [
                    '<i class="fal fa-angle-left"></i>',
                    '<i class="fal fa-angle-right"></i>'
                ],
                dots: false,
                dotsData: false
            });
        });
    })(jQuery, intec)
</script>
