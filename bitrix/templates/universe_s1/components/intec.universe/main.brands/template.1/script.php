<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\JavaScript;

/**
 * @var array $arResult
 * @var array $arVisual
 * @var string $sTemplateId
 */

$arSlider = $arVisual['SLIDER'];

$arResponsiveReady = [];

$arResponsive = [
    '1' => ['0' => ['items' => 1]],
    '2' => ['401' => ['items' => 2]],
    '3' => ['501' => ['items' => 3]],
    '4' => ['801' => ['items' => 4]],
    '5' => ['1001' => ['items' => 5]]
];

$sLineElements = ArrayHelper::getValue($arVisual, 'LINE_COUNT');

foreach ($arResponsive as $iKey => $arLineElements) {
    if ($iKey <= $sLineElements)
        $arResponsiveReady += $arLineElements;
}

$arResponsiveReady = JavaScript::toObject($arResponsiveReady);

?>
<script>
    (function ($, api) {
        var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
        var slider = $('.owl-carousel', root).owlCarousel({
            items: <?= $arSlider['ITEMS'] ?>,
            autoplay: <?= $arSlider['AUTO_PLAY_USE'] ? 'true' : 'false' ?>,
            autoplaySpeed: <?= !empty($arSlider['AUTO_PLAY_SPEED']) ? $arSlider['AUTO_PLAY_SPEED'] : '500' ?>,
            autoplayTimeout: <?= !empty($arSlider['AUTO_PLAY_TIME']) ? $arSlider['AUTO_PLAY_TIME'] : '10000' ?>,
            autoplayHoverPause: <?= $arSlider['AUTO_PLAY_HOVER_PAUSE'] ? 'true' : 'false' ?>,
            loop: <?= $arSlider['LOOP_USE'] ? 'true' : 'false' ?>,
            nav: <?= $arSlider['ARROWS_USE'] ? 'true' : 'false' ?>,
            navText: [
                '<span class="fal fa-angle-left"></span>',
                '<span class="fal fa-angle-right"></span>'
            ],
            dots: <?= $arSlider['DOTS_USE'] ? 'true' : 'false' ?>,
            dotsData: false,
            responsive: <?= $arResponsiveReady ?>
        });
    })(jQuery, intec)
</script>
