<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\JavaScript;

/**
 * @var string $sFeedbackTitle
 * @var string $sFeedbackText
 * @var string $sFeedbackFormID
 * @var string $sTemplateId
 * @var string $sFeedbackButton
 */

?>
<?$APPLICATION->IncludeComponent(
	"intec.universe:widget",
	"web.form",
	Array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "web.form",
		"CONSENT" => "",
		"CONSENT_URL" => "",
		"ID" => "",
		"NAME" => "",
		"TEMPLATE" => ".default",
		"WEB_FORM_ID" => "5",
		"WEB_FORM_TEMPLATE" => "template.1"
	)
);?>