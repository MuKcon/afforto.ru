<?php
/**
 * @var array $arResult
 * @var array $arParams
 */

use \intec\core\helpers\Html;
use intec\core\bitrix\Component;
use intec\core\helpers\JavaScript;

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this, true));
?>

<div class="ns-bitrix c-form-result-new c-form-result-new-template-1 intec-form" id="<?= $sTemplateId ?>">
    <?php if ($arResult['isFormNote'] == 'Y') { ?>
        <div class="contacts-form-note">
            <?= $arResult["FORM_NOTE"] ?>
        </div>
    <?php } else { ?>
    <!-- <? if ($arResult['WEB_FORM_NAME']=='SIMPLE_FORM_2' && $arResult['arForm']['NAME']=='Обратная связь' ){$arResult['FORM_HEADER'] = substr_replace($arResult['FORM_HEADER'],' class="contact_form_zakazat_consultaciu" id="contact_form_zakazat_consultaciu_id" ', 5, 0);} ?> -->
        <?= $arResult['FORM_HEADER'] ?>

        <?php if ($arResult["isFormErrors"] == 'Y') { ?>
            <div class="contacts-form-error">
                <?= $arResult["FORM_ERRORS_TEXT"] ?>
            </div>
        <?php } ?>

        <div class="intec-form-description"><?= $arResult['arForm']['DESCRIPTION'] ?></div>

        <?php foreach ($arResult['QUESTIONS'] as $question) { ?>
            <div class="form-result-new-form-field">
                <div class="form-result-new-form-caption">
                    <?= $question['CAPTION'] . ($question['REQUIRED'] == 'Y' ? $arResult['REQUIRED_SIGN'] : '') ?>
                    <?= $question['IS_INPUT_CAPTION_IMAGE'] == 'Y' ? '<br />'. $question['IMAGE']['HTML_CODE'] : '' ?>
                </div>
                <div class="form-result-new-form-value">
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
            <div class="form-result-new-consent">
                <label class="intec-ui intec-ui-control-checkbox intec-ui-scheme-current">
                    <input type="checkbox" checked="checked" onchange="this.checked = !this.checked" />
                    <label class="intec-ui-part-selector"></label>
                    <label class="intec-ui-part-content"><?= GetMessage('FRN_DEFAULT_CONSENT', [
                        '#URL#' => $arResult['CONSENT']['URL']
                    ]) ?></label>
                </label>
            </div>
        <? } ?>

        <div class="form-result-new-form-buttons-wrap">
            <input <?= intval($arResult['F_RIGHT']) < 10 ? "disabled=\"disabled\"" : '' ?>
                   class="form-result-new-form-button intec-button intec-button-cl-common intec-button-s-6"
                   type="submit"
                   name="web_form_submit"
                   value="<?= htmlspecialcharsbx(strlen(trim($arResult['arForm']['BUTTON'])) <= 0 ? GetMessage('FORM_ADD') : $arResult['arForm']['BUTTON']) ?>" />
            &nbsp;<input class="form-result-new-form-button intec-button intec-button-cl-common intec-button-s-6" type="reset" value="<?= GetMessage('FORM_RESET') ?>" />
        </div>
    <?php } ?>

    <?= $arResult['FORM_FOOTER'] ?>
    <script>
        (function ($, api) {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
            var form = $('form', root);

            var inputs = $('.form-result-new-form-value input[type="text"], .form-result-new-form-value select, .form-result-new-form-value textarea', root);
            var update;

            update = function() {
                var self = $(this);

                if (self.val() != '') {
                    self.addClass('completed');
                } else {
                    self.removeClass('completed');
                }
            };

            $(document).ready(function () {
                inputs.each(function () {
                    update.call(this);
                });
            });

            inputs.on('change', function () {
                update.call(this);
            });

            form.on('submit', function () {
                if (window.yandex && window.yandex.metrika) {
                    window.yandex.metrika.reachGoal('forms');
                    window.yandex.metrika.reachGoal(<?= JavaScript::toObject('forms.'.$arResult['arForm']['ID']) ?>);
                }
            });
        })(jQuery, intec)
    </script>
</div>