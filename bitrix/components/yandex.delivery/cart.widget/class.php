<?php

namespace Yandex\Delivery\Components;

use Bitrix\Main;
use Yandex\Delivery;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) { die(); }

class CartWidget extends \CBitrixComponent
{
	public function onPrepareComponentParams($params)
	{
		$params['SENDER_ID'] = trim($params['SENDER_ID']);
		$params['API_KEY'] = trim($params['API_KEY']);
		$params['STORE_ID'] = trim($params['STORE_ID']);
		$params['SERVICE_TYPE'] = trim($params['SERVICE_TYPE']);

		return $params;
	}

	public function executeComponent()
	{
		try
		{
			$this->checkRequiredParameters();

			$this->includeComponentTemplate();
		}
		catch (Main\SystemException $exception)
		{
			$this->showError($exception->getMessage());
		}
	}

	protected function checkRequiredParameters()
	{
		foreach ($this->getRequiredParameters() as $parameterKey)
		{
			if (empty($this->arParams[$parameterKey]))
			{
				$message = $this->getLang('PARAMETER_REQUIRED', [ '#NAME#' => $parameterKey ]);

				throw new Main\ArgumentException($message);
			}
		}
	}

	protected function getRequiredParameters()
	{
		return [
			'SENDER_ID',
			'API_KEY',
		];
	}

	protected function getLang($key, $replaces = null)
	{
		return Main\Localization\Loc::getMessage('YANDEX_DELIVERY_' . $key, $replaces);
	}

	protected function showError($message)
	{
		if ($this->request->isAdminSection())
		{
			$message = new \CAdminMessage([
				'TYPE' => 'ERROR',
				'MESSAGE' => $message,
			]);

			echo $message->Show();
		}
		else
		{
			ShowError($message);
		}
	}
}
