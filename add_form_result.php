<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	 define("NO_KEEP_STATISTIC", true);
	 define("NOT_CHECK_PERMISSIONS", true);
	 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
	 ?>
 
	 <?
	 if (!empty($_REQUEST['name']) and !empty($_REQUEST['description'])) {
 
	   CModule::IncludeModule('iblock');
 
	   echo 'Вот такие данные мы передали';
	   echo '<pre>';
	   print_r($_POST);
	   echo '<pre>';
 
	   //Погнали
	   $el = new CIBlockElement;
	   $iblock_id = 14;
	  /*  $section_id = false;
	   $section_id[$i] = $_POST['section_id']; //Разделы для добавления */
 
	   //Свойства
	   $PROP = array();
 
	   $PROP['LINE'] = $_POST['line']; //Свойство Строка
	   $PROP['SELECTOR'] = $_POST['selector']; //Свойство список
	   $PROP['CHEK_BOX'] = $_POST['chek_box']; //Свойство чекбокс
	   $PROP['FILE_POL'] = $_FILES['file_pol']; //Свойство файл
	   $PROP['SECTIONS_SV'][$c] = $_POST['sections_sv']; //Чекбоксы привязка к разделам
 
	   //Основные поля элемента
	   $fields = array(
	     "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
	     "CREATED_BY" => $GLOBALS['USER']->GetID(),  //Передаем ID пользователя кто добавляет
	     "IBLOCK_SECTION" => $section_id[$i], //ID разделов
	     "IBLOCK_ID" => $iblock_id, //ID информационного блока он 24-ый
	     "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств
	     "NAME" => strip_tags($_REQUEST['name']),
	     "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
	     "PREVIEW_TEXT" => strip_tags($_REQUEST['description']), //Анонс
	     "PREVIEW_PICTURE" => $_FILES['image'], //изображение для анонса
	     "DETAIL_TEXT"  => strip_tags($_REQUEST['description_detail'],
	     "DETAIL_PICTURE" => $_FILES['image_detail'] //изображение для детальной страницы
	   );
	  
	   //Результат в конце отработки
	   if ($ID = $el->Add($fields)) {
	     echo "Сохранено";
	   } else {
	     echo 'Произошел как-то косяк Попробуйте еще разок';
	   }
	 }
	 ?>
