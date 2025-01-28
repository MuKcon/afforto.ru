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
<div id="anchor-characteristics" class="item-info-tabs">
    <ul class="nav nav-tabs intec-tabs">
        <?php if ($hasTab['description']) { ?>
            <li role="presentation" class="<?= $activeTab == 'description' ? 'active' : '' ?>">
                <a href="#tab-description" aria-controls="tab-description" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_DESCRIPTION') ?></a></li>
        <?php }
        if ($hasTab['characteristics']) { ?>
            <li role="presentation" class="<?= $activeTab == 'characteristics' ? 'active' : '' ?>">
                <a href="#tab-characteristics" aria-controls="tab-characteristics" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_CHARACTERISTICS') ?></a></li>
        <?php }
        if ($hasTab['store_amount']) { ?>
            <li role="store-amount" class="<?= $activeTab == 'store-amount' ? 'active' : '' ?>">
                <a href="#tab-store-amount" aria-controls="tab-store-amount" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_STORE_AMOUNT') ?></a></li>
        <?php }
        if ($hasTab['documents']) { ?>
            <li role="presentation" class="<?= $activeTab == 'documents' ? 'active' : '' ?>">
                <a href="#tab-documents" aria-controls="tab-documents" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_DOCUMENTS') ?></a></li>
        <?php }
        if ($hasTab['video']) { ?>
            <li role="presentation" class="<?= $activeTab == 'video' ? 'active' : '' ?>">
                <a href="#tab-video" aria-controls="tab-video" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_VIDEO') ?></a></li>
        <?php }
        if ($hasTab['reviews']) { ?>
            <li role="presentation" class="<?= $activeTab == 'reviews' ? 'active' : '' ?>">
                <a href="#tab-reviews" aria-controls="tab-reviews" role="tab" data-toggle="tab">
                    <?= GetMessage('TAB_REVIEWS') ?></a></li>
        <?php } ?>
    </ul>
    <div class="tab-content clearfix">
        <?php
        if ($hasTab['description']) { ?>
            <div role="tabpanel" id="tab-description" class="tab-pane item-description <?= $activeTab == 'description' ? 'active' : '' ?>">
                <div><?= $arResult['DETAIL_TEXT'] ?></div>
            </div>
        <?php }
        if ($hasTab['store_amount']) { ?>
            <div role="tabpanel" id="tab-store-amount" class="tab-pane item-description <?= $activeTab == 'store-amount' ? 'active' : '' ?>">
                <?php $APPLICATION->IncludeComponent(
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
        <?php }
        if ($hasTab['characteristics']) { ?>
            <div role="tabpanel" id="tab-characteristics" class="tab-pane <?= $activeTab == 'characteristics' ? 'active' : '' ?>">
                <?php if ($arParams['DETAIL_VIEW'] == 'tabs_right') { ?>
                    <ul class="properties-list">
                        <?php foreach ($characteristics as $key => $property) { ?>
                            <li class="col-xs-12 col-md-6" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <span itemprop="name">
                                    <?= $property['NAME'] ?>
                                </span>
                                -
                                <span itemprop="value">
                                    <?= $property['VALUE'] ?>;
                                </span>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <div class="item-characteristics-full">
                        <?php foreach ($characteristics as $key => $property) { ?>
                            <div class="clearfix characteristic" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                <div class="col-xs-6 characteristic-name" itemprop="name"><?= $property['NAME'] ?></div>
                                <div class="col-xs-6 characteristic-value" itemprop="value"><?= is_array($property['DISPLAY_VALUE']) ? implode(", ",$property['DISPLAY_VALUE']) : $property['DISPLAY_VALUE'] ?></div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
        if ($hasTab['documents']) { ?>
            <div role="tabpanel" id="tab-documents" class="tab-pane <?= $activeTab == 'documents' ? 'active' : '' ?>">
                <div class="row item-file-list">
                    <?php foreach ($documents as $document) { ?>
                        <div class="<?= $arParams['DETAIL_VIEW'] != 'tabs_right' ? 'col-lg-3' : '' ?> col-md-4 col-sm-6 col-xs-12 item-file">
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
            <div role="tabpanel" id="tab-video" class="tab-pane <?= $activeTab == 'video' ? 'active' : '' ?>">
                <div class="row item-videos-list">
                    <?php foreach ($videoLinks as $video) { ?>
                        <div class="item-video col-xs-6 <?= $arParams['DETAIL_VIEW'] != 'tabs_right' ? 'col-md-4 col-lg-4' : '' ?>">
                            <div class="item-video-wrap">
                                <iframe allowfullscreen frameborder="0" src="<?= $video['URL'] ?>"></iframe>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }
        if ($hasTab['reviews']) { ?>
            <div role="tabpanel" id="tab-reviews" class="tab-pane reviews-wrap <?= $activeTab == 'reviews' ? 'active' : '' ?>">
                <div class="reviews-container"></div>
            </div>
        <?php } ?>
    </div>
</div>