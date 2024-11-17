<?php
use Bitrix\Main;
use Yandex\Delivery;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

global $APPLICATION;
$APPLICATION->RestartBuffer();

try
{
	if (!Main\Loader::includeModule('yandex.delivery'))
	{
		throw new Main\SystemException('require module yandex.delivery');
	}

	$logger = new Delivery\Logger\Logger();

	$result = Main\Text\Encoding::convertEncoding($_POST['data'], 'UTF-8', SITE_CHARSET);

	$logBody = [
		'REQUEST' => serialize([
			'headers' => '',
			'query' => $result,
			'address' => 'https://widgets.delivery.yandex.ru/widget/',
		]),
		'RESPONSE' => serialize([
			'headers' => '',
			'response' => '',
		]),
		'URL_TYPE' => Delivery\Psr\Log\LogUrl::WIDGET,
		'ENTITY_TYPE' => 'delivery_get_widget',
		'TYPE' => 'GET'
	];

	$logger->info('Status 200', $logBody);

}
catch (Main\SystemException $exception)
{

    \CAdminMessage::ShowMessage([
		'TYPE' => 'ERROR',
		'MESSAGE' => $exception->getMessage(),
	]);
}

//require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_popup_admin.php';

