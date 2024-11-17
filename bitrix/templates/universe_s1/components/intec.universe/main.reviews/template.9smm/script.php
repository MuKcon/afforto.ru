<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var array $arSlider
 * @var array $sTemplateId
 */

$arSlider = $arSlider['SLIDER'];

?>
<script>
    (function ($, api) {
        $(document).ready(function () {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
			$('.widget-content', root).lightGallery();
            var slider = $('.owl-carousel', root).owlCarousel({
                items: 1,
                autoplay: <?= $arSlider['AUTO_PLAY_USE'] ? 'true' : 'false' ?>,
                autoplaySpeed: <?= !empty($arSlider['SLIDE_SPEED']) ? $arSlider['SLIDE_SPEED'] : '500' ?>,
                autoplayTimeout: <?= !empty($arSlider['AUTO_PLAY_TIME']) ? $arSlider['AUTO_PLAY_TIME'] : '10000' ?>,
                autoplayHoverPause: <?= $arSlider['AUTO_PLAY_PAUSE'] ? 'true' : 'false' ?>,
                loop: <?= $arSlider['LOOP'] ? 'true' : 'false' ?>,
                nav: true,
                navText: [
                    '<i class="far fa-angle-left"></i>',
                    '<i class="far fa-angle-right"></i>'
                ],
                dots: false,
                dotsData: false
            });
        });
    })(jQuery, intec)
</script>