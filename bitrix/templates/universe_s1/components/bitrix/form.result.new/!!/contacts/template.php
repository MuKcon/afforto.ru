<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true ) die() ?>
<?php
use intec\Core;
use intec\core\helpers\Html;
use intec\constructor\models\Build;
?>
<?
$oBuild = Build::getCurrent();
if (!empty($oBuild)) {
    $oPage = $oBuild->getPage();
    $oProperties = $oPage->getProperties();
    $personal_data = $oProperties->get('inform_about_processing_personal_data');
}
$request = Core::$app->request;
?>
<div class="contacts-form intec-form">
    <?php if ($arResult['isFormNote'] == 'Y') { ?>
        <div class="contacts-form-note">
            <?= $arResult["FORM_NOTE"] ?>
        </div>
    <?php } else { ?>
     <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_2' && $arResult['arForm']['NAME']=='Обратная связь' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_obratnaiasviaz" id="contact_form_obratnaiasviaz_id" ', 5, 0);} ?> -->
        <?= $arResult['FORM_HEADER'] ?>
        <?php if ($arResult['isFormTitle'] == 'Y') { ?>
            <div class="contacts-form-title">
                <?= $arResult["FORM_TITLE"] ?>
            </div>
        <?php } ?>
        <?php if ($arResult["isFormErrors"] == 'Y') { ?>
            <div class="contacts-form-error">
                <?= $arResult["FORM_ERRORS_TEXT"] ?>
            </div>
        <?php } ?>
		<input style="display:none;" type="text" value="" name="ANTIBOT[NAME]">
       
		

	   <div class="contacts-form-fields">
            <div class="contacts-form-fields-wrapper">
                <?php foreach ($arResult["QUESTIONS"] as $iFieldId => $arField) { ?>
                <?php
                    $iId = $arField['STRUCTURE'][0]['FIELD_ID'];
                    $sType = $arField['STRUCTURE'][0]['FIELD_TYPE'];
                    $sName = 'form_'.$sType.'_'.$iId;
                    $sTitle = $arField['CAPTION'];

                    if ($sType != 'text' && $sType != 'textarea' && $sType != 'email')
                        continue;
                ?>
                    <div class="contacts-form-field contacts-form-field-<?= $sType ?>">
                        <div class="contacts-form-field-title">
                            <?= $sTitle ?><?= $arField['REQUIRED'] == 'Y' ? ' *' : null ?>
                        </div>
                        <div class="contacts-form-field-content intec-form-value">
                            <?php if ($sType == 'text' || $sType == 'email') { ?>
                                <input type="text" value="<?= Html::encode($request->post($sName)) ?>" name="<?= $sName ?>" />
                            <?php } else { ?>
                                <textarea name="<?= $sName ?>"><?= Html::encode($request->post($sName)) ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
				<input type="hidden" name="recaptcha_token" value="">
                <?php if ($arResult['isUseCaptcha'] == 'Y') { ?>
                    <div class="contacts-form-field contacts-form-field-captcha">
                        <div class="contacts-form-field-title">
                            <?= GetMessage('F_R_N_CONTACTS_FIELD_CAPTCHA') ?> *
                        </div>
                        <div class="contacts-form-field-content intec-form-value">
                            <input type="hidden" name="captcha_sid" value="<?= Html::encode($arResult["CAPTCHACode"]) ?>" />
                            <div class="contacts-form-captcha-image">
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= Html::encode($arResult["CAPTCHACode"]) ?>" width="180" height="40" />
                            </div>
                            <input type="text" name="captcha_word" size="30" maxlength="50" value="" />
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="contacts-form-footer clearfix">
            <input type="hidden" name="web_form_apply" value="Y" />
			
            <input type="submit"
                   class="intec-button intec-button-cl-common intec-button-s-5"
                   style="float: right;"
                   value="<?= GetMessage('F_R_N_CONTACTS_BUTTON_SEND') ?>"
           onclick="this.form.recaptcha_token.value = window.recaptcha.getToken()" />
            <?if($personal_data){?>
                <div class="consent" style="float: left; margin-right: 13px; margin-top: 9px;">
                    <div class="intec-contest-checkbox checked" style="margin-right: 5px; float: left;"></div>
                    <?=GetMessage("F_R_N_CONTEST", [
                        '#URL#' => $arParams['CONSENT_URL']
                    ]);?>
                </div>
            <?}?>

        </div>
        <div class="clearfix"></div>
        <?= $arResult["FORM_FOOTER"] ?>
    <?php } ?>
</div>