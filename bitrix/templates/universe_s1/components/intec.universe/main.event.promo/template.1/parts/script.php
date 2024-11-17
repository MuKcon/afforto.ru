<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 */

?>
<script>
    (function ($, api) {
        var root = $(<?= JavaScript::toObject('#'.$sTemplateId)?>),
            button = $('[data-role="button"]', root);

        button.on('click', function (event) {
            event.preventDefault();

            var self = $(this),
                id = self.attr('href'),
                top = $(id);

            if (top.length > 0) {
                top = top.offset().top;

                $('html, body').animate({scrollTop: top}, 750);
            }
        });

    })(jQuery, intec);
</script>