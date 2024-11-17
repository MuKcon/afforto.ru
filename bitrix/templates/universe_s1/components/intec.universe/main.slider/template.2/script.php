<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 * @var boolean $bDotsShow
 * @var boolean $bLoopUse
 * @var string $sSlideSpeed
 * @var boolean $bAutoPlayUse
 * @var string $sAutoPlayTime
 * @var boolean $bAutoPlayPause
 * @var boolean $bInHeader
 * @var string $sHeight
 * @var string $sInHeaderSelector
 */

?>
<script type="text/javascript">
    (function ($, api) {
        $(document).ready(function () {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
            var heightOriginal = <?= $sHeight ?>;
            var slider = $('.owl-carousel', root).owlCarousel({
                items: 1,
                autoplay: <?= $bAutoPlayUse ? 'true' : 'false' ?>,
                autoplaySpeed: <?= $sSlideSpeed ?>,
                autoplayTimeout: <?= $sAutoPlayTime ?>,
                autoplayHoverPause: <?= $bAutoPlayPause ? 'true' : 'false' ?>,
                loop: <?= $bLoopUse ? 'true' : 'false' ?>,
                nav: false,
                navText: ['', ''],
                dots: <?= $bDotsShow ? 'true' : 'false' ?>,
                <?php if ($bDotsShow || $bInHeader) { ?>
                onInitialized: function () {
                    var elementColor = root.find('.owl-item.active .widget-slider-element').data('color');
                    var color = elementColor === 'white' ? 'black' : 'white';
                    <?php if ($bDotsShow) { ?>
                        var windowWidth = $(window).width();
                        var dots = root.find('.owl-dot span');
                        var dotActive = root.find('.owl-dot.active span');
                        dots.css({'border-color': color});
                        dotActive.css({'background-color' : color});
                    <?php } ?>
                    <?php if ($bInHeader) { ?>
                        var headerTheme = color === 'black' ? 'dark-theme' : 'light-theme';
                        var header = root.closest('<?= $sInHeaderSelector ?>')
                            .find('.widget-header-desktop');
                        var headerHeight = 150;
                        var sliderHeight = root.height();
                        var sliderElement = root.find('.widget-slider-element');
                        if (windowWidth > 720) {
                            root.css({
                                'height': sliderHeight + headerHeight
                            });
                            sliderElement.css({
                                'height': sliderHeight + headerHeight,
                                'padding-top': headerHeight
                            });
                        }
                        header.removeClass('light-theme')
                            .removeClass('dark-theme')
                            .addClass(headerTheme);
                    <?php } ?>
                },
                onChanged: function (event) {
                    var elementColor = root.find('.owl-item').eq(event.item.index).find('[data-color]').data('color');
                    var color = elementColor === 'white' ? 'black' : 'white';
                    <?php if ($bDotsShow) { ?>
                        var dots = root.find('.owl-dot span');
                        var dotActive = root.find('.owl-dot.active span');
                        dots.css({'border-color': color, 'background-color' : 'transparent'});
                        dotActive.css({'background-color' : color});
                    <?php } ?>
                    <?php if ($bInHeader) { ?>
                        var headerTheme = color === 'black' ? 'dark-theme' : 'light-theme';
                        var header = root.closest('<?= $sInHeaderSelector ?>')
                            .find('.widget-header-desktop');
                        header.removeClass('light-theme')
                            .removeClass('dark-theme')
                            .addClass(headerTheme);
                    <?php } ?>
                }
                <?php } ?>
            });
        });
    })(jQuery, intec)
</script>