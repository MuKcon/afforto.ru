<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arParams
 */

$arResult = [
    'URL' => null,
    'VISUAL' => []
];

$youtube = function ($url) {
    $arrUrl = parse_url($url);

    if (isset($arrUrl['query'])) {
        $arrUrlGet = explode('&', $arrUrl['query']);
        foreach ($arrUrlGet as $value) {
            $arrGetParam = explode('=', $value);
            if (!strcmp(array_shift($arrGetParam), 'v')) {
                $videoID = array_pop($arrGetParam);
                break;
            }
        }
        if (empty($videoID)) {
            $videoID = array_pop(explode('/', $arrUrl['path']));
        }
    } else {
        $videoID = array_pop(explode('/', $url));
    }

    return array(
        'iframe' => 'https://www.youtube.com/embed/'.$videoID,
        'src' => 'https://www.youtube.com/watch?v='.$videoID,
        'sddefault' => 'https://img.youtube.com/vi/'.$videoID.'/sddefault.jpg',
        'mqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg',
        'hqdefault' => 'https://img.youtube.com/vi/'.$videoID.'/hqdefault.jpg',
        'maxresdefault' => 'https://img.youtube.com/vi/'.$videoID.'/maxresdefault.jpg',
        'id' => $videoID
    );
};

$sUrl = ArrayHelper::getValue($arParams, 'URL');
$sUrl = trim($sUrl);

if (!empty($sUrl))
    $sUrl = $youtube($sUrl);

$arResult['URL'] = $sUrl;

$this->includeComponentTemplate();