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
	$arResult = [
		'status' => 'ok',
	];

	$httpRequest = Main\Context::getCurrent()->getRequest();
	$httpRequestData = $httpRequest->getQueryList()->toArray();

	if($httpRequestData['CHANGE_ORDER'] ==='Y' && $httpRequestData['ORDER_ID'] !== '')
	{
		$value = Delivery\Config::getOption('ORDER_'.$httpRequestData['ORDER_ID'].'_PROFILE_DELIVERY_CHANGE','N');

		if($value === 'Y')
		{
			$arResult['status'] = 'error';
			$arResult['code'] = 'change_profile';
			Delivery\Config::removeOption('ORDER_'.$httpRequestData['ORDER_ID'].'_PROFILE_DELIVERY_CHANGE');
		}
	}

	header('Content-Type: application/json');
	echo json_encode($arResult);
	\CMain::FinalActions();
	die();

}
catch (Main\SystemException $exception)
{

	\CAdminMessage::ShowMessage([
		'TYPE' => 'ERROR',
		'MESSAGE' => $exception->getMessage(),
	]);
}