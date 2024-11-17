<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\Html;

/**
 * @var array $arVisual
 * @var CMain $APPLICATION
 */

?>
<?php return function (&$arForm) use (&$arVisual, &$APPLICATION) {

    $vInputTextarea = include(__DIR__.'/form/input.textarea.php');
    $vInputText = include(__DIR__.'/form/input.text.php');
    $vSelect = include(__DIR__.'/form/input.select.php');
    $vCaptcha = include(__DIR__.'/form/input.captcha.php');

?>
    <?php if ($arForm['STATUS'] === 'empty') { ?>
        <div class="reviews-form-open">
            <?= Html::beginTag('div', [
                'class' => [
                    'reviews-form-button-open',
                    'intec-ui' => [
                        '',
                        'control-button',
                        'scheme-current',
                        'size-4',
                        'mod-round-half'
                    ]
                ],
                'data-role' => 'form.toggle'
            ]) ?>
                <span class="reviews-form-button-open-icon intec-ui-part-icon"></span>
                <span class="reviews-form-button-open-text intec-ui-part-content">
                    <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_OPEN') ?>
                </span>
            <?= Html::endTag('div') ?>
        </div>
        <?= Html::beginTag('div', [
            'class' => 'reviews-form-content',
            'data' => [
                'role' => 'form.content',
                'expanded' => !empty($arForm['ERROR']) ? 'true' : 'false'
            ]
        ]) ?>
            <?= Html::beginForm($APPLICATION->GetCurPageParam(), 'post', [
                'class' => [
                    'reviews-form',
                    'intec-ui-form'
                ],
                'data-role' => 'form.body'
            ]) ?>
                <?php if (!empty($arForm['ERROR'])) { ?>
                    <div class="reviews-form-errors">
                        <div class="intec-ui intec-ui-control-alert intec-ui-scheme-red">
                            <?php foreach ($arForm['ERROR'] as $error) { ?>
                                <div class="reviews-form-error">
                                    <?php if ($error === 'required') { ?>
                                        <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_ERROR_REQUIRED') ?>
                                    <?php } else if ($error === 'captcha') { ?>
                                        <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_ERROR_CAPTCHA') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="reviews-form-fields intec-ui-form-fields">
                    <?= bitrix_sessid_post() ?>
                    <?php foreach ($arForm['FIELDS'] as $arField) { ?>
                        <?php if ($arField['TYPE'] === 'hidden') { ?>
                            <?= Html::hiddenInput($arField['NAME'], $arField['VALUE']) ?>
                        <?php } ?>
                    <?php } ?>
                    <?php foreach ($arForm['FIELDS'] as $arField) {
                        if ($arField['TYPE'] === 'textarea') {
                            $vInputTextarea($arField);
                        } else if ($arField['TYPE'] === 'text') {
                            $vInputText($arField);
                        } else if ($arField['TYPE'] === 'select' && !empty($arField['OPTIONS'])) {
                            $vSelect($arField);
                        }
                    } ?>
                </div>
                <?php if (!empty($arForm['CAPTCHA']))
                    $vCaptcha($arForm['CAPTCHA']);
                ?>
                <?php if ($arVisual['FORM']['CONSENT']['SHOW']) { ?>
                    <div class="reviews-form-consent">
                        <label class="intec-ui intec-ui-control-checkbox intec-ui-scheme-current">
                            <?= Html::input('checkbox', null, null, [
                                'checked' => 'checked',
                                'onchange' => 'this.checked = !this.checked'
                            ]) ?>
                            <span class="intec-ui-part-selector"></span>
                            <span class="intec-ui-part-content">
                                <?php if (!empty($arVisual['FORM']['CONSENT']['URL'])) { ?>
                                    <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_CONSENT_URL', [
                                        '#URL#' => $arVisual['FORM']['CONSENT']['URL']
                                    ]) ?>
                                <?php } else { ?>
                                    <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_CONSENT_DEFAULT') ?>
                                <?php } ?>
                            </span>
                        </label>
                    </div>
                <?php } ?>
                <div class="reviews-form-buttons">
                    <?= Html::beginTag('button', [
                        'type' => 'submit',
                        'class' => [
                            'intec-ui' => [
                                '',
                                'control-button',
                                'scheme-current',
                                'size-4',
                                'mod-round-half'
                            ]
                        ]
                    ]) ?>
                        <span class="intec-ui-part-icon">
                            <i class="fas fa-paper-plane"></i>
                        </span>
                        <span class="reviews-form-button-submit-text intec-ui-part-content">
                            <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_SUBMIT') ?>
                        </span>
                    <?= Html::endTag('button') ?>
                </div>
            <?= Html::endForm() ?>
        <?= Html::endTag('div') ?>
    <?php } else if ($arForm['STATUS'] === 'exists') { ?>
        <div class="reviews-form-message" data-success="true">
            <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_REVIEW_EXISTS') ?>
        </div>
    <?php } else if ($arForm['STATUS'] === 'added') { ?>
        <div class="reviews-form-message" data-success="true">
            <?php if ($arVisual['FORM']['ADD_MODE'] === 'disabled') { ?>
                <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_REVIEW_ADDED_DISABLED') ?>
            <?php } else if ($arVisual['FORM']['ADD_MODE'] === 'active') { ?>
                <?= Loc::getMessage('C_REVIEWS_2_TEMPLATE_1_TEMPLATE_FORM_REVIEW_ADDED_ACTIVE') ?>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>




<div class="reviews-box" id="<?= $arResult['COMPONENT_HASH'] ?>">

	<a href="#reviews-form"
	   class="button intec-bt-button button-big"
	   data-toggle="collapse">
        <?= GetMessage('WRITE_REVIEW') ?>
    </a>

	<?php if (!empty($arResult['FROM_RESULT'])) { ?>
		<br><br>
		<div class="reviews-form-result result-status-<?= $arResult['FORM_RESULT_STATUS'] ?>">
			<?= $arResult['FROM_RESULT'] ?>
		</div>
	<?php } ?>
	<div id="reviews-form"
		 class="form collapse <?= $_REQUEST["NAME"] || $_REQUEST["PREVIEW_TEXT"] ? "in" : "" ?>" aria-expanded="false">
		<form action="<?= $APPLICATION->GetCurPageParam() ?>" method="post">
			<div class="row">
				<div class="label">
                    <?= GetMessage('NAME') ?>
                    <span class="needed">
                        *
                    </span>
                </div>
				<div class="control">
					<input type="text"
						   name="NAME"
						   class="control-text"
						   value="<?= $_REQUEST["NAME"] ? $_REQUEST["NAME"] : "" ?>"
                    />
				</div>
			</div>
			<div class="row" style="margin-bottom: 10px;">
				<div class="label">
                    <?= GetMessage('DESCRIPTION') ?>
                    <span class="needed">
                        *
                    </span>
                </div>
				<div class="control">
					<textarea class="control-text" name="PREVIEW_TEXT" style="height: 100px"><?= $_REQUEST["PREVIEW_TEXT"] ? $_REQUEST["PREVIEW_TEXT"] : "" ?></textarea>
				</div>
			</div>
			<?php if ($arParams['USE_CAPTCHA'] == 'Y') { ?>
				<div class="row">
					<div class="control label">
						<input type="hidden" name="CAPTCHA_SID" value="<?= $capCode ?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $capCode ?>"
							 width="180" height="40" />
					</div>
					<div class="control">
						<input name="CAPTCHA" type="text" value="" size="40" class="control-text" />
					</div>
				</div>
			<?php } ?>
			<?php if ($personal_data) { ?>
				<div class="consent">
					<div class="intec-contest-checkbox checked" style="margin-right: 5px; float: left;"></div>
					<?= GetMessage("SOF_CONTEST") ?>
				</div>
			<?php } ?>
			<div class="row control" style="text-align: right;margin-top: 10px;">
                <button type="submit"
                        class="submit-btn button right intec-bt-button button-big"
                        name="submit"
                        value="send">
                    <i class="fas fa-paper-plane"></i> <?= GetMessage('SEND_REVIEW') ?>
                </button>
			</div>
		</form>
	</div>

	<div class="reviews">
		<?php foreach ($arResult['ELEMENTS'] as $arElement) { ?>
			<div class="review">
                <div class="intec-grid intec-grid-i-12">
                    <div class="intec-grid-item intec-grid-item-auto">
                        <div class="avatar"></div>
                        <div class="date">
                            <?= date('d-m-Y', $arElement['DATE_CREATE_UNIX']) ?>
                        </div>
                    </div>
                    <div class="intec-grid-item">
                        <div class="name">
                            <?= $arElement['NAME'] ?>
                        </div>
                        <div class="description">
                            <?= $arElement['PREVIEW_TEXT'] ?>
                        </div>
                    </div>
                </div>

				<div class="clear"></div>
                <div itemscope itemtype="http://schema.org/Review" style="display: none">
	                <span itemprop="datePublished">
                        <?= date('Y-m-d', $arElement['DATE_CREATE_UNIX']) ?>
                    </span>
                    <span itemprop="reviewBody">
                        <?= $arElement['PREVIEW_TEXT'] ?>
                    </span>
                    <span itemprop="author">
                        <?= $arElement['NAME'] ?>
                    </span>
                    <span itemprop="itemReviewed">
                        <?= ArrayHelper::getValue($arParams, 'ITEM_NAME', 'Товар') ?>
                    </span>
                </div>
			</div>
		<?php } ?>
	</div>
</div>