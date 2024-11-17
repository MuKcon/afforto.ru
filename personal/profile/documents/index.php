<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансовые документы");?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>

<section class="intec-content">
    <div class="intec-content-wrapper">
        <div class="docsFilter">
            <span>Фильтр по дате документа</span>
            <form method="get" action="/personal/profile/documents/index.php">
                <input autocomplete="off" placeholder="2020-01-01" type="text" id="dateFrom" name="from" value="<?=$_REQUEST['from']?>">
                <input autocomplete="off" placeholder="2020-12-31" type="text" id="dateTo" name="to" value="<?=$_REQUEST['to']?>">

                <button type="submit">Применить</button>
            </form>
            <?if($_REQUEST['from'] or $_REQUEST['to']):?>
                <a href="/personal/profile/documents/index.php">Сбросить фильтр</a>
            <?endif;?>
        </div>


        <?
        global $USER;

        $userID = $USER->GetID();
        $rsUser = CUser::GetByID($userID);
        $arUser = $rsUser->Fetch();
        $userCode = $arUser['UF_P_CODE'];
        $userCodes = explode(",", $userCode);
        $codesFilter = "( " . implode(" || ", $userCodes) . " )";
        //var_export($userCode);

        $useFilter = 'Y';
        $elCount = "25";
        if(empty($userCodes)){
            $useFilter = 'N';
            $elCount = "0";
        }

        $GLOBALS['codeFilter'] = [
            "?PROPERTY_PARTNER_CODE" => $codesFilter
            //"=PROPERTY_PARTNER_CODE" => $userCode
        ];

        if($_REQUEST['from'] && !$_REQUEST['to']){
            //От этой даты до текущего дня
            $GLOBALS['codeFilter'][">=PROPERTY_DATE"] = $_REQUEST['from'];
        }
        if($_REQUEST['to'] && !$_REQUEST['from']){
            //то выводить документы ДО этой даты от начала времен
            $GLOBALS['codeFilter']["<=PROPERTY_DATE"] = $_REQUEST['to'];
        }

        if($_REQUEST['to'] && $_REQUEST['from']){
            $GLOBALS['codeFilter']  =  array (
                "PROPERTY"  =>  array ( 'DATE'  =>  array ( $_REQUEST['to'], $_REQUEST['from'] )),
                "?PROPERTY_PARTNER_CODE" => $codesFilter
            );
        }

        if ($userCode):
        ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "1cDocs",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("",""),
                "USE_FILTER" => $useFilter,
                "FILTER_NAME" => "codeFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "35",
                "IBLOCK_TYPE" => "1c_docs",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => $elCount,
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("TIME","DATE","PARTNER_CODE","PARTNER_NAME","DOCUMENT_ID","SUMM","FILE",""),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "PROPERTY_DATE",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        );?>
        <?else:?>
            <h2>Документы не найдены</h2>
        <? endif; ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script>
    const pickerFrom = new Litepicker({
        element: document.getElementById('dateFrom')
    });

    const pickerTo = new Litepicker({
        element: document.getElementById('dateTo')
    });
</script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>