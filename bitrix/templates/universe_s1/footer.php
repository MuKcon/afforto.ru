<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\FileHelper;

global $APPLICATION;
global $USER;
global $directory;
global $properties;
global $template;
global $part;

if (empty($template))
    return;

?>




        <?php include($directory.'/parts/'.$part.'/footer.php'); ?>
        <?php if (FileHelper::isFile($directory.'/parts/custom/body.end.php')) include($directory.'/parts/custom/body.end.php') ?>
		<!-- Latest compiled and minified JavaScript -->

		
	<script>	

	 $( ".form-result-new-submit-button" ).click(function() {
    $( ".form-result-new-submit-button" ).css('background', 'green');
  });
		</script>
		
    </body>
</html>
<?php if (FileHelper::isFile($directory.'/parts/custom/end.php')) include($directory.'/parts/custom/end.php') ?>