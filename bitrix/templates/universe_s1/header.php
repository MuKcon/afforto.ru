<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php

use Bitrix\Main\Localization\Loc;
use intec\Core;
use intec\core\helpers\FileHelper;
use intec\constructor\Module as Constructor;
use intec\constructor\models\build\Template;

Loc::loadMessages(__FILE__);

require(__DIR__.'/parts/preload.php');

$request = Core::$app->request;
$page->execute(['state' => 'loading']);

/** @var Template $template */
$template = $build->getTemplate();

if (empty($template))
    return;

foreach ($template->getPropertiesValues() as $key => $value)
    $properties->set($key, $value);

unset($value);
unset($key);

if (!Constructor::isLite())
    $template->populateRelation('build', $build);

if (FileHelper::isFile($directory.'/parts/custom/initialize.php'))
    include($directory.'/parts/custom/initialize.php');

require($directory.'/parts/metrika.php');
require($directory.'/parts/assets.php');

if (FileHelper::isFile($directory.'/parts/custom/start.php'))
    include($directory.'/parts/custom/start.php');

$APPLICATION->AddBufferContent([
    'intec\\template\\Marking',
    'openGraph'
]);

$page->execute(['state' => 'loaded']);
$part = Constructor::isLite() ? 'lite' : 'base';

?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
    <head>
        <?php if (FileHelper::isFile($directory.'/parts/custom/header.start.php')) include($directory.'/parts/custom/header.start.php') ?>
        <title><?php $APPLICATION->ShowTitle() ?></title>
        <?php $APPLICATION->ShowHead() ?>
        <?php  $APPLICATION->SetPageProperty("canonical", 'https://'.SITE_SERVER_NAME.$APPLICATION->GetCurDir());?>
		<?php header_remove('Cache-Control'); header_remove('Expires'); header_remove('Last-Modified'); header_remove('Pragma'); ?>
		<meta http-equiv="Expires" content="<?php echo gmdate('D, d M Y H:i:s', time()-3600) . ' GMT' ?>" />
        <meta name="viewport" content="initial-scale=1.0, width=device-width">
        <meta name="cmsmagazine" content="79468b886bf88b23144291bf1d99aa1c" />
        <?php $APPLICATION->ShowMeta('og:type', 'og:type') ?>
        <?php $APPLICATION->ShowMeta('og:title', 'og:title') ?>
        <?php $APPLICATION->ShowMeta('og:description', 'og:description') ?>
        <?php $APPLICATION->ShowMeta('og:image', 'og:image') ?>
        <?php $APPLICATION->ShowMeta('og:url', 'og:url') ?>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/favicon.png">
		<!-- Google Tag Manager -->
		<script>
		function goodbyeGTM() {
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-W8XLSDZ');
		}
		setTimeout(goodbyeGTM, 2000);
		</script>
		<!-- End Google Tag Manager -->

        <?php if (!Constructor::isLite()) { ?>
            <style rel="preload" type="text/css"><?= $template->getCss() ?></style>
            <style rel="preload" type="text/css"><?= $template->getLess() ?></style>
            <script type="text/javascript">
			function goodbyejs() {
			<?= $template->getJs() ?>
			}
			setTimeout( goodbyejs, 2000);
			</script>
        <?php } ?>
        <?php if (FileHelper::isFile($directory.'/parts/custom/header.end.php')) include($directory.'/parts/custom/header.end.php') ?>
		
		<style>

				@font-face{font-display: swap;}

		</style>
				

    </head>
	
    <body class="public intec-adaptive">
        

        <?php if (FileHelper::isFile($directory.'/parts/custom/body.start.php')) include($directory.'/parts/custom/body.start.php') ?>
        <?php $APPLICATION->IncludeComponent(
            'intec.universe:system',
            'basket.manager',
            array(
                'BASKET' => 'Y',
                'COMPARE' => 'Y',
                'COMPARE_NAME' => 'compare',
                'CACHE_TYPE' => 'N'
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        ); ?>
        <?php if (
            $properties->get('base-settings-show') == 'all' ||
            $properties->get('base-settings-show') == 'admin' && $USER->IsAdmin()
        ) { ?>
            <?php $APPLICATION->IncludeComponent(
                'intec.universe:system.settings',
                '.default',
                array(
                    'MODE' => 'render',
                    'MENU_ROOT_TYPE' => 'top',
                    'MENU_CHILD_TYPE' => 'left'
                ),
                false,
                array(
                    'HIDE_ICONS' => 'N'
                )
            ); ?>
        <? } ?>
        <?php include($directory.'/parts/'.$part.'/header.php'); ?>