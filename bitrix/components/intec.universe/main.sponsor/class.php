<?php

use intec\core\helpers\ArrayHelper;
use intec\core\bitrix\components\IBlockElements;

class IntecSponsorComponent extends IBlockElements {
    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->arResult = [
                'HEADER_BLOCK' => null,
                'VISUAL' => null,
                'SYSTEM_PROPERTIES' => null,
                'ITEM' => null
            ];

            $arParams = $this->arParams;

            $mode = ArrayHelper::fromRange(['id', 'code'],ArrayHelper::getValue($arParams, 'MODE'));

            $this->setIBlockId(ArrayHelper::getValue($arParams, 'IBLOCK_ID'));
            $this->setIBlockType(ArrayHelper::getValue($arParams, 'IBLOCK_TYPE'));

            if ($mode == 'id')
                $this->setElementsId(ArrayHelper::getValue($arParams, 'ELEMENT'));
            elseif ($mode = 'code')
                $this->setElementsCode(ArrayHelper::getValue($arParams, 'ELEMENT'));

            $arElement = $this->getElements();
            $this->arResult['ITEM'] = ArrayHelper::shift($arElement);

            $headerSource = ArrayHelper::fromRange(['parameters', 'element'], ArrayHelper::getValue($arParams, 'HEADER_SOURCE'));

            $this->arResult['HEADER_BLOCK'] = [
                'SHOW' => ArrayHelper::getValue($arParams, 'HEADER_SHOW') == 'Y',
                'POSITION' => ArrayHelper::fromRange(['center', 'left', 'right'], ArrayHelper::getValue($arParams, 'HEADER_POSITION')),
                'TEXT' => null
            ];

            if ($headerSource == 'parameters')
                $this->arResult['HEADER_BLOCK']['TEXT'] = ArrayHelper::getValue($arParams, 'HEADER_TEXT');
            elseif ($headerSource == 'element')
                $this->arResult['HEADER_BLOCK']['TEXT'] = $this->arResult['ITEM']['NAME'];

            $this->arResult['HEADER_BLOCK']['SHOW'] = $this->arResult['HEADER_BLOCK']['SHOW'] && !empty($this->arResult['HEADER_BLOCK']['TEXT']);

            $textSource = ArrayHelper::fromRange(['preview', 'detail'], ArrayHelper::getValue($arParams, 'TEXT_SOURCE'));

            $this->arResult['SYSTEM_PROPERTIES']['TEXT'] = $this->arResult['ITEM'][strtoupper($textSource).'_TEXT'];

            $this->includeComponentTemplate();
        }

        return null;
    }
}