<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main;
use Bitrix\Sale;
use Yandex\Delivery;

$response = [
	'result' => false,
	'message' => null
];

if ($APPLICATION->GetGroupRight('sale') < 'W')
{
	$response['message'] = 'access denied';
}
else if (!Main\Loader::includeModule('yandex.delivery'))
{
	$response['message'] = 'require module yandex.delivery';
}
else
{
	$response['result'] = true;
	$response['tokenList'] = [];

	$queryTokens = Delivery\Api\Internals\TokenTable::getList();

	while ($token = $queryTokens->fetch())
	{
		$response['tokenList'][] = [
			'id' => $token['ID'],
			'name' => $token['ID']
		];
	}
}

if (!Main\Application::isUtfMode())
{
	$response = Main\Text\Encoding::convertEncoding($response, LANG_CHARSET, 'UTF-8');
}

echo Main\Web\Json::encode($response);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';