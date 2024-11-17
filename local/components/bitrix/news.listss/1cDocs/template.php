<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="docsList">
    <div class="docsHead">
        <div class="item _name">Наименование</div>
        <div class="item">Дата документа</div>
        <div class="item">Номер документа</div>
        <div class="item summ">Сумма документа</div>
    </div>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        //echo '<pre>'; print_r($arItem['PROPERTIES']['PARTNER_NAME']['VALUE']); die;
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="prop name">
                <div class="mobileHead">Наименование\Номер документа</div>
                <?=$arItem['PROPERTIES']['PARTNER_NAME']['VALUE'];?>
            </div>
            <div class="prop">
                <div class="mobileHead">Дата\Сумма</div>
                <?=$arItem['PROPERTIES']['DATE']['VALUE'];?>
            </div>

            <div class="prop">
                <a href="<?=$arItem['PROPERTIES']['FILE']['VALUE'];?>" target="_blank" rel="nofollow"><?=$arItem['PROPERTIES']['DOCUMENT_ID']['VALUE'];?></a>
            </div>
            <div class="prop summ"><?=number_format($arItem['PROPERTIES']['SUMM']['VALUE'], 2, ',', ' ');?> ₽</div>
        </div>
    <?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>