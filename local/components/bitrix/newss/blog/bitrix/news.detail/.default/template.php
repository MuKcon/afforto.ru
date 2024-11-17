<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\Type;

/**
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arResult
 * @var array $arParams
 */

$this->setFrameMode(true);

$arCodes = ArrayHelper::getValue($arResult, 'PROPERTY_CODES');
$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');

$sDate = ArrayHelper::getValue($arResult, 'DISPLAY_ACTIVE_FROM');
$sPreviewText = ArrayHelper::getValue($arResult, 'PREVIEW_TEXT');
$sDetailText = ArrayHelper::getValue($arResult, 'DETAIL_TEXT');
$sDetailPicture = ArrayHelper::getValue($arResult, ['DETAIL_PICTURE', 'SRC']);
$sListPage = ArrayHelper::getValue($arResult, 'LIST_PAGE_URL');

$arTags = ArrayHelper::getValue($arResult, ['PROPERTIES', $arCodes['TAG'], 'VALUE']);
$arDetailPicture = [
    'class' => 'news-detail-text-image',
    'style' => ['background-image' => "url($sDetailPicture)"]
];

$bTagsShowTop = !empty($arCodes['TAG']) && Type::isArray($arTags) && ($arViewParams['TAG_SHOW'] == 'top' || $arViewParams['TAG_SHOW'] == 'all');
$bTagsShowBottom = !empty($arCodes['TAG']) && Type::isArray($arTags) && ($arViewParams['TAG_SHOW'] == 'bottom' || $arViewParams['TAG_SHOW'] == 'all');

$iCounter = 0;

$sProductsBuying = "SYSTEM_ASSOCIATED";
$arProductsBuying = ArrayHelper::getValue($arResult, ['PROPERTIES', $sProductsBuying, 'VALUE']);

$arServices = ArrayHelper::getValue($arResult, ['PROPERTIES', "SYSTEM_SERVICES", 'VALUE']);
?>
<div class="intec-content">
    <div class="intec-content-wrapper">
        <div class="ns-bitrix c-news-detail c-news-detail-default" style="font-size: 14px">
            <?php if ($bTagsShowTop || $arViewParams['DATE_SHOW']) { ?>
                <div class="news-detail-header">
                    <?php if ($arViewParams['DATE_SHOW']) { ?>
                        <div class="news-detail-header-date">
                            <?= $sDate ?>
                        </div>
                    <?php } ?>
<div class="news-detail-header-time">
<span class="btime">Время на чтение:</span>
<span class="btimeval">
<?
$wrds = explode(" ", $sDetailText);
//$len = str_word_count($sDetailText);
$len = count($wrds);

$timeread=ceil((($len/100)*40)/60);
echo $timeread;
?> минут(ы)
</span>
</div>

<div class="news-detail-header-numrev">
<?
CModule::IncludeModule("forum");
$iCommentsCount = CForumMessage::GetListEx(
   Array("ID"=>"DESC"),
   Array(
      "FORUM_ID"   => 1,
      "TOPIC_ID"   => $arResult["PROPERTIES"]["FORUM_TOPIC_ID"]["VALUE"]
   ),
   true
);
//echo  $arResult["PROPERTIES"]["FORUM_TOPIC_ID"]["VALUE"];
?>

<?
CModule::IncludeModule("forum");
$arTopic = CForumTopic::GetByID($arResult["PROPERTIES"]["FORUM_TOPIC_ID"]["VALUE"]);
?>
<div class="toprepl">
<img src="/bitrix/templates/universe_s1/images/rep.png"  alt="Кол*во отзывов" width="20" /> 
<?
echo isset($arTopic['POSTS']) ? $arTopic['POSTS'] : 0;
?></div>
</div>
<div class="news-detail-header-rate">
<span class="btrate">Рейтинг: </span>
<div class="btrateline">
<?$APPLICATION->IncludeComponent(
            "bitrix:iblock.vote",
            "stars",
            array(
                "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "ELEMENT_ID" => $arResult['ID'],
                "ELEMENT_CODE" => "",
                "MAX_VOTE" => "5",
                "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                "SET_STATUS_404" => "N",
                "DISPLAY_AS_RATING" => "vote_avg",
                "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                "CACHE_TIME" => $arParams['CACHE_TIME']
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );?>
	</div>

</div>
<div class="news-detail-toptags">
                    <?php if ($bTagsShowTop) { ?>
                        <?php foreach ($arTags as $sTag) {

                            $iCounter++;

                        ?>
                            <div class="news-detail-tag news-detail-tag-color-<?= $iCounter ?>">
                                <?= '#'.$sTag ?>
                            </div>
                            <?php if ($iCounter == 5) $iCounter = 0 ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
</div>
            <div class="news-detail-content">
                <div class="news-detail-text">

<?
/********************************/
$text =$sDetailText;
$newsDetailText=$sDetailText;
$text = stripslashes($text);
preg_match_all("/<h3.*?>(.*?)<\/h3>|<h2.*?>(.*?)<\/h2>/i", $text, $items);

if (isset($items) && !empty($items[0]) && !empty($items[1])) { ?>    
<script>
jQuery(document).ready(function($) {
$(".soderzh li").on("click","a", function (event) {

		event.preventDefault();

		var id  = $(this).attr('href');
		var top = $(id).offset().top - 120;

		$('body,html').animate({scrollTop: top}, 200);

	});

$(".soderzh .soderzhhide").on("click", function (event) {
$(".soderzhul").toggle();
if ($(".soderzhhide").text() =="[Скрыть]") {
$(".soderzhhide").text("[Раскрыть]");
} else {
$(".soderzhhide").text("[Скрыть]");
}
});

});

</script>
 <?


if (!empty($items[1])) {
	?>
	<div class="soderzh" style="">
		<div class="lh3">Оглавление</div><span class="soderzhhide">[Скрыть]</span>
		<div class="soderzhul">
		<ul>
			<?php
			foreach ($items[1] as $i => $row) {
$j= ++$i;
				echo '<li><a  href="#tag-' .$j . '">' . $row . '</a></li>';
			}
			?>					
		</ul>
		</div>
	</div>
	<?php	
}

if (!empty($items[0]) && !empty($items[1])) {
	foreach ($items[0] as $i => $row) {
$j= ++$i;
		$text = str_replace($row, '<a  id="tag-' . $j . '" name="tag-' .$j . '"></a>' . $row, $text);
	} 
}

$newsDetailText=$text;
} else {

$newsDetailText= $sDetailText;
}
/*******************************/
?><br/>
                    <?php if ($arViewParams['PREVIEW_SHOW'] && !empty($sPreviewText)) { ?>
                        <div class="news-detail-text-preview">
                            <?= $sPreviewText ?>
                        </div>
                    <?php } ?>
                    <?php if ($arViewParams['IMAGE_SHOW'] && !empty($sDetailPicture)) { ?>
                        <div class="news-detail-text-image-wrap">
                            <?= Html::tag('div', '', $arDetailPicture) ?>
                        </div>
                    <?php } ?>
                    <div class="news-detail-text-detail">
                        <?= $newsDetailText ?>
                    </div>


<div class="botline" style="">

<div class="newsbot1">
<div class="newsbotsoc">
<div class="soctxt">Поделиться:</div>
	<script src="https://yastatic.net/share2/share.js"></script>
	<div class="ya-share2" data-curtain data-shape="round" data-color-scheme="whiteblack" data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp,skype"></div>
</div>
<?
$author  = ArrayHelper::getValue($arResult, ['PROPERTIES', 'author', 'VALUE']);
$authortxt  = ArrayHelper::getValue($arResult, ['PROPERTIES', 'authortxt', 'VALUE']);
if ($author =="") {$author="Александр Смирнов";}
if ($authortxt =="") {$authortxt="Технический специалист";}
?>
<div class="newsbotautor"><span class="auttxt">Автор: </span><span class="authorname"><? echo $author; ?></span></div>
<div class="newsbotautor2"><span class="authortxt"><? echo $authortxt; ?></span></div>
</div>



<div class="newsbot2">
	<div class="botrate">
	<div class="botratename">Оцените материал!</div>
	<div class="botrateline">
<?
// echo $arParams['IBLOCK_ID']; 

//echo  ArrayHelper::getValue($arResult, ['PROPERTIES', 'vote_sum', 'VALUE']);
?>
<?$APPLICATION->IncludeComponent(
            "bitrix:iblock.vote",
            "stars",
            array(
                "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "ELEMENT_ID" => $arResult['ID'],
                "ELEMENT_CODE" => "",
                "MAX_VOTE" => "5",
                "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                "SET_STATUS_404" => "N",
                "DISPLAY_AS_RATING" => "vote_avg",
                "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                "CACHE_TIME" => $arParams['CACHE_TIME']
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );?>
	</div>
	<div class="botratetext">
	<? 
/*$db_props = CIBlockElement::GetProperty("28", $arResult['ID'], array("sort" => "asc"), Array("CODE"=>"vote_sum" ));
	if($ar_props = $db_props->Fetch()) {
	$votesValue =  $ar_props["VALUE"];
	}*/
$votesValue  = ArrayHelper::getValue($arResult, ['PROPERTIES', 'vote_sum', 'VALUE']);
	/*$db_props = CIBlockElement::GetProperty("28", $arResult['ID'], array("sort" => "asc"), Array("CODE"=>"vote_count" ));
	if($ar_props = $db_props->Fetch()) {
	$votesCount =  $ar_props["VALUE"];
	}*/
$votesCount   = ArrayHelper::getValue($arResult, ['PROPERTIES', 'vote_count', 'VALUE']);
?>
<?if ($votesValue > 0 && $votesCount > 0) { echo '<span class="bratetxt">('.$votesCount;?> голоса, в среднем: <? echo $votesValue.' из 5)</span>'; } else { echo "(пока не было оценок)";}?>
	</div>
	</div>
</div>



</div>
<div style="clear:both"></div>
<div class="blogcomment"  style="">
<div class="lh3">Добавить комментарий</div>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:forum.topic.reviews",
        "",
        array(
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "0",
            "MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
            "USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
            "PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
            "FORUM_ID" => 1,
            "URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
            "SHOW_LINK_TO_FORUM" => "N",
            "DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
            "ELEMENT_ID" => $arResult["ID"],
            "AJAX_POST" => "Y",
	    "SHOW_MINIMIZED"=> "N",
            "IBLOCK_ID" =>28,
            "URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
        ),
        $component
    );
    ?>

</div>


<? /*****************************/?>
                    <?php if ($bTagsShowBottom) {

                        $iCounter = 0;

                    ?>
                        <div class="news-detail-tags-list">
                            <?php foreach ($arTags as $sTag) {

                                $iCounter++;

                            ?>
                                <div class="news-detail-tag news-detail-tag-color-<?= $iCounter ?>">
                                    <?= '#'.$sTag ?>
                                </div>
                                <?php if ($iCounter == 5) $iCounter = 0 ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
				<?
				if (!empty($arServices)) {
					echo '<div class="service-section"><h3>Сопутствующие услуги</h3>';
					$APPLICATION->IncludeComponent(
						"intec.universe:iblock.elements",
						"tiles.landing.3",
						array(
							"ELEMENTS_ID" => $arServices,
							"LINK_TO_ELEMENTS" => "",
							"NAME_PROP_PRICE" => "SYSTEM_PRICE"
						),
						$component
					);
					echo '</div>';
				}
				if (!empty($arProductsBuying)) {
					echo '<h3>Сопутствующие товары</h3>';
					$GLOBALS['arrFilter'] = array(
						'ID' => $arProductsBuying
					);
					$APPLICATION->IncludeComponent(
						'bitrix:catalog.section',
						'small-products',
						array(
							'IBLOCK_TYPE' => 'catalogs',
							'IBLOCK_ID' => 13,
							'SECTION_USER_FIELDS' => array(),
							'SHOW_ALL_WO_SECTION' => 'Y',
							'FILTER_NAME' => 'arrFilter',
							'TITLE' => GetMessage('BUYING_WITH'),
							'PRICE_CODE' => $arParams['PRICE_CODE'],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID']
						),
						$component
					);
				}
				?>
                <?php if ($arViewParams['READ_ALSO_SHOW'] && !empty($arResult['FILTER']['ID'])) { ?>
                    <?php $GLOBALS['arrFilter'] = $arResult['FILTER'] ?>
                    <div class="news-detail-read-also">
                        <?php $APPLICATION->IncludeComponent(
                            'bitrix:news.list',
                            'news.'.($arViewParams['READ_ALSO_VIEW'] == 'blocks' ? 'blocks' : 'tile'),
                            array(
                                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                'NEWS_COUNT' => $arViewParams['READ_ALSO_VIEW'] == 'blocks' ? 3 : 4,
                                'LINE_COUNT' => $arViewParams['READ_ALSO_VIEW'] == 'blocks' ? 3 : 4,
                                'SORT_BY1' => 'SORT',
                                'SORT_ORDER1' => 'ASC',
                                'FIELD_CODE' => $arParams['FIELD_CODE'],
                                'PROPERTY_CODE' => $arParams['PROPERTY_CODE'],
                                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                'SET_TITLE' => 'N',
                                'SET_LAST_MODIFIED' => 'N',
                                'SET_STATUS_404' => 'N',
                                'SHOW_404' => 'N',
                                'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                                'DISPLAY_TOP_PAGER' => 'N',
                                'DISPLAY_BOTTOM_PAGER' => 'N',
                                'PAGER_SHOW_ALWAYS' => 'N',
                                'DISPLAY_DATE' => 'Y',
                                'DISPLAY_NAME' => 'Y',
                                'DISPLAY_PICTURE' => 'Y',
                                'DISPLAY_TITLE' => 'Y',
                                'TITLE' => $arViewParams['READ_ALSO_HEADER'],
                                'ACTIVE_DATE_FORMAT' => $arParams['ACTIVE_DATE_FORMAT'],
                                'FILTER_NAME' => 'arrFilter'
                            ),
                            $component
                        ) ?>
                    </div>
                <?php } ?>
            </div>
			
			
			
            <?php if ($arViewParams['BACK_SHOW'] || $arViewParams['SOCIAL_SHOW']) { ?>
                <div class="news-detail-footer clearfix">
                    <?php if ($arViewParams['BACK_SHOW']) { ?>
                        <a class="news-detail-footer-back intec-cl-text-hover" href="<?= $sListPage ?>">
                            <span class="news-detail-footer-back-icon fal fa-angle-left"></span>
                            <span class="news-detail-footer-back-text">
                                <?= $arViewParams['BACK_TEXT'] ?>
                            </span>
                        </a>
                    <?php } ?>
                    <?php if ($arViewParams['SOCIAL_SHOW']) { ?>
                        <div class="news-detail-footer-social">
                            <?php $APPLICATION->IncludeComponent(
                                "bitrix:main.share",
                                "flat",
                                array(
                                    'HANDLERS' => $arViewParams['SOCIAL_LIST'],
                                    'PAGE_URL' => $arResult["DETAIL_PAGE_URL"],
                                    "PAGE_TITLE" => $arResult["NAME"]
                                ),
                                $component
                            ); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- *************************************************** -->



