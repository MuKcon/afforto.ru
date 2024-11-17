<?php

use Bitrix\Main;
use Yandex\Delivery;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

try
{
	if (!Main\Loader::includeModule('yandex.delivery'))
	{
		throw new Main\SystemException('require module yandex.delivery');
	}

	if ($APPLICATION->GetGroupRight('sale') < 'W')
	{
		throw new Main\AccessDeniedException();
	}

	$httpRequest = Main\Context::getCurrent()->getRequest();
	$httpRequestData = $httpRequest->getPostList()->toArray();

	$processor = new Delivery\Api\OAuth\AccessToken\ExchangeCode();
	$processResult = $processor->run($httpRequestData);

	if (!$processResult->isSuccess())
	{
		$errorMessage = implode('<br />', $processResult->getErrorMessages());
		throw new Main\SystemException($errorMessage);
	}

	$processData = $processResult->getData();
	$responseToken = [
		'ID' => (string)$processData['ID'],
		'LOGIN' => (string)$processData['LOGIN']
	];

	echo Main\Web\Json::encode([
		'status' => 'ok',
		'token' => $responseToken,
		'data' => $processData
	]);
}
catch (Main\SystemException $exception)
{
	echo Main\Web\Json::encode([
		'status' => 'error',
		'message' => $exception->getMessage(),
		'trace' => $exception->getTraceAsString()
	]);
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin_after.php';
