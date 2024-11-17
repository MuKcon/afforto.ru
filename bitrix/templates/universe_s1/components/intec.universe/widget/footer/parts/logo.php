<?if($arParams["FOOTER_LOGO"] == "Y"){?>
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR."include/logo.php",
        )
    );?>
<?}?>