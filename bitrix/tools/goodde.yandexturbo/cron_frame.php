#!#PHP_PATH# -q
<?
/* replace #PHP_PATH# to real path of php binary
For example:
/user/bin/php
/usr/bin/perl
/usr/bin/env python
*/
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../../..");
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("BX_CRONTAB", true);
define('NO_AGENT_CHECK', true);
define('BX_WITH_ON_AFTER_EPILOG', true);
define('BX_NO_ACCELERATOR_RESET', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

set_time_limit(0);
ignore_user_abort(true);

if(!\Bitrix\Main\Loader::includeModule('goodde.yandexturbo'))
{
	die('No module goodde.yandexturbo');
}

CGOODDEYandexTurbo::runFileFeed();
?>