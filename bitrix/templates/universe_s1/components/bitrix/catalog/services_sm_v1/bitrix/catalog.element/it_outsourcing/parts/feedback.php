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
<!--
<div class="service-feedback clearfix">
    <div class="service-feedback-body">
        <div class="title-form pull-left">
            <?= $sFeedbackTitle ?>
        </div>
        <div class="separate intec-cl-background pull-left">
        </div>
        <div class="text pull-left">
            <?= $sFeedbackText ?>
        </div>
        <div class="pull-right button-feedback">
            <a class="intec-button-md intec-button intec-button-cl-common" data-role="form.button" onclick="universe.forms.show(<?= JavaScript::toObject([
                'id' => $sFeedbackFormID,
                'template' => '.default',
                'parameters' => [
                    'AJAX_OPTION_ADDITIONAL' => $sTemplateId.'_FORM_FEEDBACK',
                    'CONSENT_URL' => $arParams['CONSENT_URL']
                ],
                'settings' => [
                    'title' => $sFeedbackButton
                ]
            ]) ?>)">
                <?= $sFeedbackButton ?>
            </a>
        </div>
    </div>
</div> -->

 <?$APPLICATION->IncludeComponent(
	"intec.universe:widget", 
	"web.form.2", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "web.form.2",
		"CONSENT" => "Y",
		"CONSENT_URL" => "/company/consent/",
		"ID" => "",
		"NAME" => "",
		"TEMPLATE" => ".default",
		"WEB_FORM_ID" => "5",
		"WEB_FORM_TEMPLATE" => ".default",
		"GRAB_DATA" => "N",
		"TITLE" => "",
		"DESCRIPTION" => "",
		"BUTTON" => "",
		"FORM" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>