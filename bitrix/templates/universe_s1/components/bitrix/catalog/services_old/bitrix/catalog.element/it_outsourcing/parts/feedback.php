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
<div class="service-question">
<?$APPLICATION->IncludeComponent(
	"intec.universe:widget",
	"web.form.2",
	Array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "web.form",
		"CONSENT" => "Y",
		"CONSENT_URL" => "/company/consent/",
		"ID" => "",
		"NAME" => "",
		"TEMPLATE" => ".default",
		"WEB_FORM_ID" => "5",
		"WEB_FORM_TEMPLATE" => ".default"
	)
);?>
</div>