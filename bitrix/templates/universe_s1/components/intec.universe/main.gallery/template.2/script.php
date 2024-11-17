<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sTemplateId
 */

?>
<script>
    (function ($, api) {
        $(document).ready(function () {
            var galleryRoot = $('#'+<?= JavaScript::toObject($sTemplateId) ?>);
            $('.widget-content-wrapper', galleryRoot).lightGallery();
        });
    })(jQuery, intec);
</script>