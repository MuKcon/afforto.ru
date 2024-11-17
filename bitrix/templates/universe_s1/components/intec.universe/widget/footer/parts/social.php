<?if($arParams["FOOTER_SHOW_SOCIAL"] === "Y") {?>
    <div class="social-title">
        <?=GetMessage("FOOTER_SOCIAL_TITLE");?>
    </div>
    <ul class="social">
        <?if($arParams["FOOTER_VKONTACTE"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_VKONTACTE"]?>">
                    <i class="glyph-icon-vk"></i>
                </a>
            </li>
        <?}?>
        <?if($arParams["FOOTER_FACEBOOK"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_FACEBOOK"]?>">
                    <i class="glyph-icon-facebook"></i>
                </a>
            </li>
        <?}?>
        <?if($arParams["FOOTER_INSTAGRAM"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_INSTAGRAM"]?>">
                    <i class="glyph-icon-instagram"></i>
                </a>
            </li>
        <?}?>
  <?if($arParams["FOOTER_TWITTER"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_TWITTER"]?>">
                    <i class="glyph-icon-twitter"></i>
                </a>
            </li>
        <?}?>
  <?if($arParams["FOOTER_YOUTUBE"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_YOUTUBE"]?>">
                    <i class="glyph-icon-youtube"></i>
                </a>
            </li>
        <?}?>
  <?if($arParams["FOOTER_TELEGA"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_TELEGA"]?>">
                    <i class="glyph-icon-telega"></i>
                </a>
            </li>
        <?}?>
  <?if($arParams["FOOTER_ZEN"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_ZEN"]?>">
                    <i class="glyph-icon-zen"></i>
                </a>
            </li>
        <?}?>
  <?if($arParams["FOOTER_ODNOKLASSNIKI"]){?>
            <li>
                <a target="_blank" href="<?=$arParams["FOOTER_ODNOKLASSNIKI"]?>">
                    <i class="glyph-icon-odnoklassniki"></i>
                </a>
            </li>
        <?}?>
    </ul>
<?}?>