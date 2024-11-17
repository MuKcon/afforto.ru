<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arCurrentValues
 */

if (!CModule::IncludeModule('iblock'))
    return;

$arTemplateParameters = array();

$arIBlocksTypes = CIBlockParameters::GetIBlockTypes();
$sIBlockType = $arCurrentValues['IBLOCK_TYPE'];

$arIBlocks = array();
$arIBlocksFilter = array();
$arIBlocksFilter['ACTIVE'] = 'Y';

if (!empty($sIBlockType))
    $arIBlocksFilter['TYPE'] = $sIBlockType;

$rsIBlocks = CIBlock::GetList(array('SORT' => 'ASC'), $arIBlocksFilter);

while ($arIBlock = $rsIBlocks->Fetch())
    $arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];

$iIBlockId = (int)$arCurrentValues['IBLOCK_ID'];

$arTemplateParameters['IBLOCK_TYPE'] = array(
    'PARENT' => 'BASE',
    'TYPE' => 'LIST',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_IBLOCK_TYPE'),
    'VALUES' => $arIBlocksTypes,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
);
$arTemplateParameters['IBLOCK_ID'] = array(
    'PARENT' => 'BASE',
    'TYPE' => 'LIST',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_IBLOCK_ID'),
    'VALUES' => $arIBlocks,
    'ADDITIONAL_VALUES' => 'Y',
    'REFRESH' => 'Y'
);

if (!empty($iIBlockId)) {
    $arProperties = array();
    $arPropertiesBoolean = array();
    $arPropertiesFile = array();
    $arPropertiesDocument = array();

    $arServiceIBlocks = array();
    $arServiceProperties = array();
    $arServicePropertiesText = array();

    $arProjectIBlocks = array();
    $arProjectProperties = array();
    $arProjectPropertiesText = array();

    $rsProperties = CIBlockProperty::GetList(array('SORT' => 'ASC'), array(
        'IBLOCK_ID' => $iIBlockId
    ));

    while ($arProperty = $rsProperties->Fetch()) {
        if (!empty($arProperty['CODE'])) {
            $sName = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];

            if ($arProperty['PROPERTY_TYPE'] == 'S' && $arProperty['LIST_TYPE'] == 'L') {
                $arPropertiesText[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
            } elseif ($arProperty['PROPERTY_TYPE'] == 'L' && $arProperty['LIST_TYPE'] == 'C') {
                $arPropertiesBoolean[$arProperty['CODE']] = $sName;
            } elseif ($arProperty['PROPERTY_TYPE'] == 'E' && $arProperty['LIST_TYPE'] == 'L'){
                $arPropertiesFile[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
            } elseif ($arProperty['PROPERTY_TYPE'] == 'F' && $arProperty['LIST_TYPE'] == 'L') {
                $arPropertiesDocument[$arProperty['CODE']] = '[' . $arProperty['CODE'] . '] ' . $arProperty['NAME'];
            }
        }

        $arProperties[$arProperty['CODE']] = $arProperty;
    }

    $arTemplateParameters['PROPERTY_DISPLAY'] = array(
        'PARENT' => 'DATA_SOURCE',
        'TYPE' => 'LIST',
        'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_DISPLAY'),
        'VALUES' => $arPropertiesBoolean,
        'ADDITIONAL_VALUES' => 'Y'
    );

    /** Список инфоблоков для видео */
    $arIBlockTypes = CIBlockParameters::GetIBlockTypes();

    if (!empty($arCurrentValues['VIDEO_SHOW'] == 'Y' && $arCurrentValues['PROPERTY_VIDEO'])) {
        if (!empty($arCurrentValues['VIDEO_IBLOCK_TYPE'])) {
            $rsVideoIBlocks = CIBlock::GetList(
                array(),
                array(
                    'TYPE' => $arCurrentValues['VIDEO_IBLOCK_TYPE']
                )
            );
        } else {
            $rsVideoIBlocks = CIBlock::GetList();
        }

        while ($arVideoIBlock = $rsVideoIBlocks->Fetch()) {
            $arVideoIBlocks[$arVideoIBlock['ID']] = '[' . $arVideoIBlock['ID'] . '] ' . $arVideoIBlock['NAME'];
        }

        /** Свойства инфоблока "Видео" */
        if (!empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
            $rsVideoProperties = CIBlockProperty::GetList(
                array(),
                array(
                    'IBLOCK_ID' => $arCurrentValues['VIDEO_IBLOCK_ID']
                )
            );

            while ($arVideoProperty = $rsVideoProperties->Fetch()) {
                if ($arVideoProperty['PROPERTY_TYPE'] == 'S' && $arVideoProperty['LIST_TYPE'] == 'L') {
                    $arVideoPropertiesText[$arVideoProperty['CODE']] = '[' . $arVideoProperty['CODE'] . '] ' . $arVideoProperty['NAME'];
                } elseif ($arVideoProperty['PROPERTY_TYPE'] == 'L' && $arVideoProperty['LIST_TYPE'] == 'C') {
                    $arPropertiesCheckbox[$arVideoProperty['CODE']] = '[' . $arVideoProperty['CODE'] . '] ' . $arVideoProperty['NAME'];
                }
            }
        }
    }

    $arTemplateParameters['PROPERTY_POSITION'] = array(
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_POSITION'),
        'TYPE' => 'LIST',
        'VALUES' => $arPropertiesText,
        'ADDITIONAL_VALUES' => 'Y'
    );

    if ($arCurrentValues['VIEW_DESKTOP'] == "blocks.video") {
        $arTemplateParameters['VIDEO_SHOW'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_SHOW'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y'
        );
    }
    if ($arCurrentValues['VIDEO_SHOW'] == 'Y') {
        $arTemplateParameters['PROPERTY_VIDEO'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_VIDEO'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesFile,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        );

        if (!empty($arCurrentValues['PROPERTY_VIDEO'])) {
            $arTemplateParameters['VIDEO_IBLOCK_TYPE'] = array(
                'PARENT' => 'DATA_SOURCE',
                'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_IBLOCK_TYPE'),
                'TYPE' => 'LIST',
                'VALUES' => $arIBlockTypes,
                'ADDITIONAL_VALUES' => 'Y',
                'REFRESH' => 'Y'
            );
            $arTemplateParameters['VIDEO_IBLOCK_ID'] = array(
                'PARENT' => 'DATA_SOURCE',
                'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_IBLOCK_ID'),
                'TYPE' => 'LIST',
                'VALUES' => $arVideoIBlocks,
                'ADDITIONAL_VALUES' => 'Y',
                'REFRESH' => 'Y'
            );

            if (!empty($arCurrentValues['VIDEO_IBLOCK_ID'])) {
                $arTemplateParameters['VIDEO_IBLOCK_PROPERTY_LINK'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_IBLOCK_PROPERTY_LINK'),
                    'TYPE' => 'LIST',
                    'VALUES' => $arVideoPropertiesText,
                    'ADDITIONAL_VALUES' => 'Y',
                );
                $arTemplateParameters['VIDEO_IBLOCK_PROPERTY_IMAGE_USE'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_IBLOCK_PROPERTY_IMAGE_USE'),
                    'TYPE' => 'LIST',
                    'VALUES' => $arPropertiesCheckbox,
                    'ADDITIONAL_VALUES' => 'Y'
                );
                $arTemplateParameters['VIDEO_IMAGE_QUALITY'] = array(
                    'PARENT' => 'DATA_SOURCE',
                    'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_IMAGE_QUALITY'),
                    'TYPE' => 'LIST',
                    'VALUES' => array(
                        'mqdefault' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_VIDEO_IMAGE_QUALITY_MQ'),
                        'hqdefault' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_VIDEO_IMAGE_QUALITY_HQ'),
                        'sddefault' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_VIDEO_IMAGE_QUALITY_SD'),
                        'maxresdefault' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_VIDEO_VIDEO_IMAGE_QUALITY_MAX')
                    ),
                    'DEFAULT' => 'hqdefault'
                );
            }
        }
    }

    if ($arCurrentValues['VIEW_DESKTOP'] == "blocks.video") {
        $arTemplateParameters['DOCUMENT_SHOW'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_DOCUMENT_SHOW'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y'
        );
    }
    if ($arCurrentValues['DOCUMENT_SHOW'] == 'Y') {
        $arTemplateParameters['PROPERTY_DOCUMENT'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_DOCUMENT'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesDocument,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        );
    }

    if ($arCurrentValues['VIEW_DESKTOP'] == "blocks.video") {
        $arTemplateParameters['SERVICE_SHOW'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_SERVICE_SHOW'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y'
        );
    }
    if ($arCurrentValues['SERVICE_SHOW'] == 'Y') {
        $arTemplateParameters['PROPERTY_SERVICE'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_SERVICE'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesFile,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        );
    }
    if ($arCurrentValues['VIEW_DESKTOP'] == "blocks.video") {
        $arTemplateParameters['PROJECT_SHOW'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROJECT_SHOW'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y'
        );
    }
    if ($arCurrentValues['PROJECT_SHOW'] == 'Y') {
        $arTemplateParameters['PROPERTY_PROJECT'] = array(
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('C_W_REVIEWS_PARAMETERS_PROPERTY_PROJECT'),
            'TYPE' => 'LIST',
            'VALUES' => $arPropertiesFile,
            'ADDITIONAL_VALUES' => 'Y',
            'REFRESH' => 'Y'
        );
    }
}

$arTemplateParameters['USE_SETTINGS'] = array(
    'PARENT' => 'BASE',
    'TYPE' => 'CHECKBOX',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_USE_SETTINGS'),
    'DEFAULT' => 'Y'
);

$arTemplateParameters['ITEMS_LIMIT'] = array(
    'PARENT' => 'BASE',
    'TYPE' => 'STRING',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_ITEMS_LIMIT'),
    'DEFAULT' => 20
);

$arTemplateParameters['PAGE_URL'] = array(
    'PARENT' => 'URL_TEMPLATES',
    'TYPE' => 'STRING',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_PAGE_URL')
);

$arTemplateParameters['DISPLAY_TITLE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_DISPLAY_TITLE'),
    'TYPE' => 'CHECKBOX',
    'REFRESH' => 'Y'
);
if ($arCurrentValues['DISPLAY_TITLE'] == 'Y') {
    $arTemplateParameters['ALIGN_TITLE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_ALIGHT_TITLE'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    );
    $arTemplateParameters['TITLE'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_TITLE'),
        'TYPE' => 'STRING'
    );
}

$arTemplateParameters['DISPLAY_DESCRIPTION'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_DISPLAY_DESCRIPTION'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N',
    'REFRESH' => 'Y'
);
if ($arCurrentValues['DISPLAY_DESCRIPTION'] == 'Y') {
    $arTemplateParameters['ALIGN_DESCRIPTION'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_ALIGHT_DESCRIPTION'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N'
    );
    $arTemplateParameters['DESCRIPTION'] = array(
        'PARENT' => 'VISUAL',
        'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_DESCRIPTION'),
        'TYPE' => 'STRING'
    );
}
$arTemplateParameters['DISPLAY_BUTTON_ALL'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_DISPLAY_BUTTON_ALL'),
    'TYPE' => 'CHECKBOX',
    'REFRESH' => 'Y'
);

$arTemplateParameters['VIEW_DESKTOP'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP'),
    'TYPE' => 'LIST',
    'VALUES' => array(
        'default.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP_DEFAULT'),
        'slider.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP_SLIDER'),
        'blocks.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP_BLOCKS'),
        'blocks.2.desktop' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP_BLOCKS_2'),
        'blocks.video' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_DESKTOP_VIDEO')
    ),
    'REFRESH' => 'Y'
);

$arTemplateParameters['VIEW_MOBILE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE'),
    'TYPE' => 'LIST',
    'VALUES' => array(
        'default.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE_DEFAULT'),
        'slider.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE_SLIDER'),
        'blocks.all' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE_BLOCKS'),
        'blocks.2.mobile' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE_BLOCKS_2'),
        'blocks.video' => GetMessage('C_W_REVIEWS_PARAMETERS_VIEW_MOBILE_VIDEO')
    ),
    'REFRESH' => 'Y'
);
if($arCurrentValues["VIEW_DESKTOP"] == "blocks.all"
    || $arCurrentValues["VIEW_DESKTOP"] == "blocks.2.desktop") {
    $arTemplateParameters['COUNT_IN_ROW'] = array(
        'PARENT' => "VISUAL",
        'NAME' => GetMessage("C_W_REVIEWS_PARAMETERS_COUNT_IN_ROW"),
        'TYPE' => 'LIST',
        'VALUES' => array(
            "two" => "2",
            "three" => "3",
            "four" => "4"
        )
    );
}
