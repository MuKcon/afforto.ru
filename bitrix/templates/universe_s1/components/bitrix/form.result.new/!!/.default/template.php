<?php
/**
 * @var array $arResult
 * @var array $arParams
 */

use \intec\core\helpers\Html;
?>

<div class="intec-form">
    <?php if ($arResult['isFormNote'] == 'Y') { ?>
        <div class="contacts-form-note">
            <?= $arResult["FORM_NOTE"] ?>
        </div>
    <?php } else { ?>
    <!-- <?print_r($arResult); ?>  -->
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_1' && $arResult['arForm']['NAME']=='Заказать звонок' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_zakazat_zvonok" id="contact_form_zakazat_zvonok_id" ', 5, 0);} ?> -->
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_6' && $arResult['arForm']['NAME']=='Заказать услугу' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_zakazat_uslugu" id="contact_form_zakazat_uslugu_id" ', 5, 0);} ?> -->
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_5' && $arResult['arForm']['NAME']=='Задать вопрос' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_zadatvopros" id="contact_form_zadatvopros_id" ', 5, 0);} ?> -->
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_7' && $arResult['arForm']['NAME']=='Отправить резюме' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_otpravitresume" id="contact_form_otpravitresume_id" ', 5, 0);} ?> -->
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_4' && $arResult['arForm']['NAME']=='Заказать проект' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_zakazatproekt" id="contact_form_zakazatproekt_id" ', 5, 0);} ?> -->
        <?= $arResult['FORM_HEADER'] ?>

        <?php if ($arResult["isFormErrors"] == 'Y') { ?>
            <div class="contacts-form-error">
                <?= $arResult["FORM_ERRORS_TEXT"] ?>
            </div>
        <?php } ?>

        <div class="intec-form-description"><?= $arResult['arForm']['DESCRIPTION'] ?></div>

        <?php foreach ($arResult['QUESTIONS'] as $question) { ?>
            <div class="intec-form-field">
                <div class="intec-form-caption">
                    <?= $question['CAPTION'] . ($question['REQUIRED'] == 'Y' ? $arResult['REQUIRED_SIGN'] : '') ?>
                    <?= $question['IS_INPUT_CAPTION_IMAGE'] == 'Y' ? '<br />'. $question['IMAGE']['HTML_CODE'] : '' ?>
                </div>
                <div class="intec-form-value">
                    <?= $question['HTML_CODE'] ?>
                </div>
            </div>
        <?php } ?>
		<input style="display:none;" type="text" value="" name="ANTIBOT[NAME]">
        <?php if ($arResult['isUseCaptcha'] == 'Y') { ?>
            <div class="contacts-form-field contacts-form-field-captcha">
                <div class="contacts-form-field-title">
                    <?= GetMessage('FRN_DEFAULT_FIELD_CAPTCHA') ?> *
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

        <? if ($arResult['CONSENT']['SHOW']) { ?>
            <div class="consent">
                <label class="intec-input intec-input-checkbox">
                    <input type="checkbox" checked="checked" disabled="disabled" />
                    <label class="intec-input-selector"></label>
                    <label class="intec-input-text"><?= GetMessage('FRN_DEFAULT_CONSENT', [
                        '#URL#' => $arResult['CONSENT']['URL']
                    ]) ?></label>
                </label>
            </div>
        <? } ?>

        <div class="intec-form-buttons-wrap">
            <input <?= intval($arResult['F_RIGHT']) < 10 ? "disabled=\"disabled\"" : '' ?>
                   class="intec-button intec-button-cl-common intec-button-s-6"
                   type="submit"
                   name="web_form_submit"
                   value="<?= htmlspecialcharsbx(strlen(trim($arResult['arForm']['BUTTON'])) <= 0 ? GetMessage('FORM_ADD') : $arResult['arForm']['BUTTON']) ?>" />
            &nbsp;<input class="intec-button intec-button-cl-common intec-button-s-6" type="reset" value="<?= GetMessage('FORM_RESET') ?>" />
        </div>
    <?php } ?>

    <?= $arResult['FORM_FOOTER'] ?>
</div>
