<?php

use Bitrix\Main\Loader;
use intec\constructor\models\Build;
use intec\core\helpers\ArrayHelper;

if (
    Loader::includeModule('intec.constructor') ||
    Loader::includeModule('intec.constructorlite')
) {
    if (!defined('EDITOR')) {
        $build = Build::getCurrent();

        if (!empty($build)) {
            $page = $build->getPage();
            $properties = $page->getProperties();
            $propertiesUse = $properties->get('use_global_settings');

            if ($propertiesUse) {
                $blocks = $properties->get('main_blocks');
                $banner = ArrayHelper::getValue($blocks, ['templates', 'main_banner']);
                $basketUse = $properties->get('use_basket');
                $fixedHeaderUse = $properties->get('use_fixed_header');

                $mobileHeaderFixed = $properties->get('use_fixed_mobile_header');
                $mobileTemplate = $properties->get('template_mobile_header');

                $template = $properties->get('template_menu');

                $arParams['AUTHORIZATION_SHOW_MOBILE'] = 'N';
                $arParams['TRANSPARENCY'] = 'N';

                $arParams['MOBILE'] = 'template.1';
                $arParams['MOBILE_FIXED'] = 'N';
                $arParams['MOBILE_FILLED'] = 'N';

                $arParams['FIXED'] = 'template.1';

                switch ($template) {
                    case 1:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'bottom';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'Y';
                        $arParams['DELAY_SHOW'] = 'Y';
		                $arParams['COMPARE_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 2:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'Y';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 3:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'N';
                        $arParams['EMAIL_SHOW'] = 'N';
                        $arParams['AUTHORIZATION_SHOW'] = 'N';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'N';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 4:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.3';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_MAIN_ROOT'] = 'catalog';
                        $arParams['MENU_MAIN_CHILD'] = 'catalog';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'Y';
                        $arParams['DELAY_SHOW'] = 'Y';
                        $arParams['COMPARE_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'N';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 5:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'Y';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'Y';
                        $arParams['DELAY_SHOW'] = 'Y';
                        $arParams['COMPARE_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 6:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'bottom';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'Y';
                        $arParams['MENU_MAIN_ROOT'] = 'catalog';
                        $arParams['MENU_MAIN_CHILD'] = 'catalog';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'Y';
                        $arParams['DELAY_SHOW'] = 'Y';
                        $arParams['COMPARE_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 7:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'bottom';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'Y';
                        $arParams['MENU_MAIN_ROOT'] = 'catalog';
                        $arParams['MENU_MAIN_CHILD'] = 'catalog';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 8:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'top';
                        $arParams['SOCIAL_SHOW'] = 'Y';
                        $arParams['SOCIAL_POSITION'] = 'center';

                        break;
                    case 9:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'N';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'Y';
                        $arParams['SOCIAL_POSITION'] = 'left';

                        break;
                    case 10:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.1';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'Y';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'left';

                        break;
                    case 11:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.2';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'Y';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'Y';
                        $arParams['DELAY_SHOW'] = 'Y';
                        $arParams['COMPARE_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'left';

                        break;
                    case 12:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'N';
                        $arParams['DESKTOP'] = 'template.2';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['MENU_MAIN_POSITION'] = 'top';
                        $arParams['MENU_MAIN_TRANSPARENT'] = 'N';
                        $arParams['MENU_INFO_SHOW'] = 'Y';
                        $arParams['SEARCH_SHOW'] = 'Y';
                        $arParams['BASKET_SHOW'] = 'N';
                        $arParams['DELAY_SHOW'] = 'N';
                        $arParams['COMPARE_SHOW'] = 'N';
                        $arParams['MENU_MAIN_DELIMITERS'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';
                        $arParams['PHONES_POSITION'] = 'bottom';
                        $arParams['SOCIAL_SHOW'] = 'N';
                        $arParams['SOCIAL_POSITION'] = 'left';

                        break;
                    case 13:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.4';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';

                        break;
                    case 14:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.5';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';

                        break;
                    case 15:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.6';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';

                        break;
                    case 16:
                        $arParams['LOGOTYPE_SHOW'] = 'Y';
                        $arParams['PHONES_SHOW'] = 'Y';
                        $arParams['ADDRESS_SHOW'] = 'Y';
                        $arParams['EMAIL_SHOW'] = 'Y';
                        $arParams['TAGLINE_SHOW'] = 'Y';
                        $arParams['DESKTOP'] = 'template.7';
                        $arParams['MENU_MAIN_SHOW'] = 'Y';
                        $arParams['FORMS_CALL_SHOW'] = 'Y';

                        break;
                }

                if (!$basketUse) {
                    $arParams['BASKET_SHOW'] = 'N';
                    $arParams['BASKET_SHOW_FIXED'] = 'N';
                    $arParams['BASKET_SHOW_MOBILE'] = 'N';
                    $arParams['DELAY_SHOW'] = 'N';
                    $arParams['DELAY_SHOW_FIXED'] = 'N';
                    $arParams['DELAY_SHOW_MOBILE'] = 'N';
                    $arParams['COMPARE_SHOW'] = 'N';
                    $arParams['COMPARE_SHOW_FIXED'] = 'N';
                    $arParams['COMPARE_SHOW_MOBILE'] = 'N';
                }

                if (!$fixedHeaderUse)
                    $arParams['FIXED'] = null;

                if ($mobileHeaderFixed)
                    $arParams['MOBILE_FIXED'] = 'Y';

                switch ($mobileTemplate) {
                    case 'white': break;
                    case 'colored': $arParams['MOBILE_FILLED'] = 'Y'; break;
                    case 'white_with_icons': $arParams['AUTHORIZATION_SHOW_MOBILE'] = 'Y'; break;
                    case 'colored_with_icons':
                        $arParams['MOBILE_FILLED'] = 'Y';
                        $arParams['AUTHORIZATION_SHOW_MOBILE'] = 'Y';

                        break;
                }

                if (!empty($arParams['BANNER'])) {
                    switch ($banner) {
                        case 5: $arParams['BANNER'] = 'template.2'; break;
                        case 6: $arParams['BANNER'] = 'template.1'; break;
                        case 7: $arParams['BANNER'] = 'template.3'; break;
                        case 8: $arParams['BANNER'] = 'template.4'; break;
                        case 9: $arParams['BANNER'] = 'template.5'; $arParams['BANNER_WIDE'] = 'Y'; break;
                        case 10: $arParams['BANNER'] = 'template.5'; $arParams['BANNER_WIDE'] = 'N'; break;
                        default: $arParams['BANNER'] = null; break;
                    }

                    if ($banner >= 5 && $banner <= 8) {
                        $arParams['TRANSPARENCY'] = 'Y';
                    }
                }
            }
        }
    }
}