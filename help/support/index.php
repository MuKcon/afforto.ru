<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Техническая поддержка");
?><?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Здесь Вы сможете оставить заявку на оказание услуг технической поддержки в рамках договора IT Ауторсинга");
$APPLICATION->SetPageProperty("keywords", "техническая поддержка, техподдержка, ит поддержка, ит аутсорсинг, обслуживание компьютеров");
$APPLICATION->SetPageProperty("title", "Обращение в техническую поддержку компании Afforto");
$APPLICATION->SetTitle("Обращение в техническую поддержку с активным договором IT аутсорсинга или договором аренды виртуального сервера");
?>
<div class="intec-content">
	<div class="intec-content-wrapper">
 <img src="/images/support.jpg" style="max-width: 100%;"> <br>
		<h3>Какие существуют способы подачи заявок на экстренный и плановый выезды или удаленную помощь?</h3>
		<p>
			 Заказчики с активным договором IT аутсорсинга или договором аренды виртуального сервера могут выбрать любой удобный способ для подачи заявки в нашу систему HelpDesk:
		</p>
		<ul>
			<li>
			<p>
				 Написать письмо на электронную почту <a href="mailto:support@afforto.ru">support@afforto.ru</a>. В этом случае заявка создается автоматически. При этом описанием задачи будет то, чего Вы написали в теле письма.
			</p>
 </li>
			<li>
			<p>
				 Оставить обращение у нас на сайте в разделе Помощь – Техподдержка. Нажимаете кнопку внизу экрана "Техническая поддержка", после чего открывается форма обращения. Оставьте Ваши контактные данные и постарайтесь подробно описать задачу.
			</p>
 </li>
			<li>
			<p>
				 Оставить заявку через Telegram мессенджер. Мы сделали специального <a href="https://tlgg.ru/@afforto_helpdesk_bot">бота технической поддержки</a> (@afforto_helpdesk_bot), через которого можно быстро описать проблему прямо с телефона, а также получить обратную связь и комментарии от исполнителя.
			</p>
 </li>
			<li>
			<p>
				 Зайти в клиентский раздел <a href="https://afforto.okdesk.ru">нашей HelpDesk системы</a> и непосредственно там заполнить Ваше обращение. Там же Вы сможете отслеживать текущий статус заявки и получать обратную связь от исполнителя.
			</p>
 </li>
			<li>
			<p>
				 Скачать и установить мобильное приложение на телефон можно по ссылкам: <a href="https://play.google.com/store/apps/details?id=ru.okdesk.clientsmobile">Google Play</a> | <a href="https://itunes.apple.com/in/app/заявка-в-okdesk/id1434851819">AppStore</a>
			</p>
 </li>
			<li>
			<p>
				 Звонок по телефону технической поддержки +7 (495) 740 80 93. Вам ответит оператор и запишет обращение в нашу систему учета заявок, после чего передаст заявку исполнителю для решения задачи.
			</p>
 </li>
		</ul>
 <br>
		<table class="block-wrapper-inner-table" cellspacing="0" cellpadding="0" style="height:100%;width:100%;table-layout:fixed;">
		<tbody>
		<tr>
			<td style="width: 100%; text-align: center;" class="content-wrapper">
				<table class="valign-wrapper" cellspacing="0" cellpadding="0" style="display: inline-table; width: auto;">
				<tbody>
				<tr>
					<td class="button-wrapper" align="center" valign="middle" style="box-sizing: border-box; border: none; border-radius: 8px; padding: 15px 10px; background-color: #28217e; height: 46px;">
 <a class="mailbtn" href="https://download.anydesk.com/AnyDesk.exe" target="_blank" style="width:100%;display:inline-block;text-decoration:none;"> <span class="btn-inner" contenteditable="true" style="display: inline; font-size: 14px; font-family: Arial, Helvetica, sans-serif; line-height: 16.8px; color: #ffffff; background-color: #28217e; border: 0px; word-break: break-all;">Скачать программу для удаленной поддержки</span> </a>
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
 <script id='okdesk-script' type='text/javascript'>
        WebFormSettings = {
          btn_text: 'Техническая поддержка',
          btn_text_color: '#ffffff',
          btn_color: '#28217e',
          btn_border_color: '#28217e',
          btn_position: 'bottom',
          account_name: 'afforto',
          site_url: 'https://afforto.okdesk.ru/'
        };

        var scriptTag = document.createElement('script');
        scriptTag.type = 'text/javascript';
        scriptTag.charset = 'utf-8';
        scriptTag.src = ('https://afforto.okdesk.ru/web-form/web-form.js');
        document.body.appendChild(scriptTag);
</script> <br>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>