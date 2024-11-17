<?php
$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/www";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" );

use CModule;

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define('CHK_EVENT', true);

//error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set("error_log", "/home/bitrix/www/import1c/php-error.log");

@set_time_limit(0);
@ignore_user_abort(true);

require 'vendor/autoload.php';
set_time_limit(9000);

//error_reporting(E_ALL);
//ini_set('display_errors', true);
//marketing@afforto.ru

$to = "kastiel63@gmail.com, marketing@afforto.ru";
$subject = "Крон задание afforto.ru";
$message = "Добавлены элементы: ";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: afforto.ru <robot@afforto.ru>';


$tr = 'Нечего добавлять';
$cnt = 0;

$files = getFileList();

foreach ($files as $j => $file){

    $fileName = explode("ftp://docs.afforto.ru//",  $file['ссылка_на_файл'])[1];
    if(!existItem($fileName)){

        CModule::IncludeModule("iblock");
        $el = new CIBlockElement;

        $dates = explode("T", $file['дата']);
        moveFile($fileName);
        $docsPath = 'https://docs.afforto.ru/' . $fileName;

        $PROP = array();
        $PROP[305] = $file['код_партнера'];
        $PROP[306] = $file['наименование_партнера'];
        $PROP[307] = $file['номер_документа'];
        $PROP[308] = $file['сумма'];
        $PROP[309] = $docsPath;
        $PROP[314] = $dates[0];
        $PROP[315] = $dates[1];

        $arLoadProductArray = Array(
            "MODIFIED_BY"    => 1,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 35,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => $file['наименование_партнера'] . ' ('.$file['номер_документа'].')',
            "ACTIVE"         => "Y"
        );

        if($el->Add($arLoadProductArray)){
            $tr .= '<tr><th align="left">добавлен документ</th><td align="left">'.$fileName.'</td></tr>';
            $cnt++;
        }else{
            echo "Error: ".$el->LAST_ERROR;
        }
    }
}


$body = '
<html>
<head>
    <title>'.$subject.'</title>
</head>
<body>
    <table width="" border="0"  style="margin: 0 auto;" cellpadding="0" cellspacing="0">
        <tr><td  align="center">
            <table width="465px;" style="background:#F7F7F7; border-left: 1px solid rgb(221, 221, 221); border-right: 1px solid rgb(221, 221, 221); border-top: 1px solid rgb(221, 221, 221);" cellpadding="5">
                <tr><td><table width="100%" style="border-top: 1px dashed #ddd;">
                        '.$tr.'
                        </table>
                    </td>
                </tr>
            </table>
        </td></tr>
        <td></td>
    </table>
</body>
</html>';

mail($to, $subject, $body, $headers);


function existItem($docID){
    $items = false;
    if (CModule::IncludeModule("iblock")){
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PROPERTY_DOCUMENT_ID");
        $arFilter = Array("IBLOCK_ID"=> 35, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "%PROPERTY_FILE" => $docID);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        while($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            if($arFields) $items = true;
            //dd($arFields);
        }
    }

    return $items;
}

function moveFile($fileName){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://docs.afforto.ru/index.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('moveFile' => 1, 'fileName' => $fileName)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $server_output = curl_exec($ch);
    curl_close ($ch);

    return $server_output;
}

function getFileList(){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://docs.afforto.ru/index.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"postvar1=value1&postvar2=value2&postvar3=value3");

    curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(array('getFiles' => 1)));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $server_output = curl_exec($ch);
    curl_close ($ch);

    return json_decode($server_output, true);
}


//echo '<pre>'; print_r(json_decode($files, true)); echo '</pre>'; die;