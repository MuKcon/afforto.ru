<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/**
 * @var $APPLICATION
 * @var array $arResult
 * @var array $arParams
 * @var array $characteristics
 * @var array $videoLinks
 * @var array $hasTab
 * @var array $activeTab
 * @var array $component
 * @var array $documents
 */
?>

<div class="item-info-column">
    <?php if ($hasTab['description']) { ?>
        <div>
            <div class="item-sub-title"><?= GetMessage('TAB_DESCRIPTION') ?></div>
            <div><?= $arResult['DETAIL_TEXT'] ?></div>
        </div>
    <?php } ?>
    <?php if ($hasTab['store_amount']) { ?>
        <div id="store-amount">
            <div class="item-sub-title"><?= GetMessage('TAB_STORE_AMOUNT') ?></div>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.store.amount",
                    ".default",
                    Array(
                        "ELEMENT_ID" => $arResult['ID'],
                        "STORE_PATH" => $arParams["STORE_PATH"],
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000",
                        "MAIN_TITLE" => '',
                        "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
                        "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                        "STORES" => $arParams["STORES"],
                        "SHOW_EMPTY_STORE" => $arParams["SHOW_EMPTY_STORE"],
                        "SHOW_GENERAL_STORE_INFORMATION" => $arParams["SHOW_GENERAL_STORE_INFORMATION"],
                        "USER_FIELDS" => $arParams["USER_FIELDS"],
                        "FIELDS" => $arParams["FIELDS"]
                    ),
                    $component,
                    array(
                        "HIDE_ICONS" => "Y"
                    )
                );?>
        </div>
    <?php } ?>
    <?php if ($hasTab['characteristics']) { ?>
        <div id="anchor-characteristics">
            <div class="item-sub-title"><?= GetMessage('TAB_CHARACTERISTICS') ?></div>
            <div class="item-characteristics-full">
                <?php foreach ($characteristics as $key => $property) { ?>
                    <div class="clearfix characteristic" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                        <div class="col-xs-6 characteristic-name" itemprop="name"><?= $property['NAME'] ?></div>
                        <div class="col-xs-6 characteristic-value" itemprop="value"><?= is_array($property['DISPLAY_VALUE']) ? implode(", ",$property['DISPLAY_VALUE']) : $property['DISPLAY_VALUE']?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
    if ($hasTab['documents']) { ?>
        <div>
            <div class="item-sub-title"><?= GetMessage('TAB_DOCUMENTS') ?></div>
            <div class="row item-file-list">
                <?php foreach ($documents as $document) { ?>
                    <div class="col-xs-6 col-sm-4 col-md-2 item-file">
                        <div class="item-file-icon"></div>
                        <div class="item-file-info">
                            <a class="item-file-name" href="<?= $document['SRC'] ?>"><?= $document['ORIGINAL_NAME'] ?></a>
                            <div class="item-file-size"><?= $document['FILE_SIZE_KB'] ?> Kb</div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
    if ($hasTab['video']) { ?>
        <div>
            <div class="item-sub-title"><?= GetMessage('TAB_VIDEO') ?></div>
            <div class="row item-videos-list">
                <?php foreach ($videoLinks as $video) { ?>
                    <div class="col-md-6 col-lg-4 item-video">
                        <div class="item-video-wrap">
                            <iframe allowfullscreen frameborder="0" src="<?= $video['URL'] ?>"></iframe>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
    if ($hasTab['reviews']) { ?>
        <div class="reviews-wrap">
            <div class="item-sub-title"><?= GetMessage('TAB_REVIEWS') ?></div>
            <div class="reviews-container"></div>
        </div>
    <?php } ?>
</div>
