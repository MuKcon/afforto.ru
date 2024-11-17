<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 */

?>
<script>
    (function ($, api) {
        $(document).ready(function () {
            var faqRoot = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
            var nav = faqRoot.find('.nav.nav-tabs');
            var element = $('li a', nav);

            $('.widget-tab-list-element', faqRoot).lightGallery();

            element.on('click', function () {
                var self = $(this);
                element.removeClass('intec-cl-text');
                self.addClass('intec-cl-text');
            });
        });
    })(jQuery, intec);
</script>