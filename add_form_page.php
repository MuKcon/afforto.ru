<?
	 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

	 //Подключаем модуль инфоблоков
	 CModule::IncludeModule('iblock');
	 $IBLOCK_ID = 14; //ИД инфоблока с которым работаем
	 ?>

	 <form name="add_my_ankete" action="/add_form_result.php" method="POST" enctype="multipart/form-data">

	Название
	 <input type="text" name="name" maxlength="255" value="">

	Картинка анонса
	 <input type="file" size="30" name="image" value="">

	 Свойство Строка
	 <input type="text" name="line" maxlength="255" value="">

	Выпадающий список не множественный
	   <select name='selector'>
	     <option value='#'>Выберите из списка</option>
	     <option value="60">1</option>
	     <option value="61">2</option>
	   </select>
	              
	   Текст анонса
	   <textarea name="description" placeholder="Заполните поле"></textarea>
	                
	   Выбор раздела- множественный
	   <select name='section_id[]' multiple>
	     <option value='#'>Выберите из списка или начните вводить название</option>
	     <?
	       $arFilter = array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y', "DEPTH_LEVEL" => "2");
	       $arSelect = array('ID', 'NAME');
	       $rsSection = CIBlockSection::GetTreeList($arFilter, $arSelect);
	       while ($arSection = $rsSection->Fetch()) {
	     ?>
	       <option value="<?= $arSection['ID']; ?>"><?= $arSection['NAME']; ?></option>
	     <?}?>
	   </select>
	             
	   Чекбокс
	   <label><input type="checkbox" name="chek_box" value="47"> Рассрочка </label>
	               
	   Произвольный файл
	   <input type="file" size="30" name="file_pol" value="">
	                    
	   Привязка к подразделам конкретного раздела другого мнфоблока чекбоксы                 
	   <?
	   $rsParentSection = CIBlockSection::GetByID(5741);
	   if ($arParentSection = $rsParentSection->GetNext()) {
	   $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'], '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'], '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
	   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
	   while ($arSect = $rsSect->GetNext()) {
	   ?>
	    <label><input name='service_dop[]' type="checkbox" value="<?= $arSect['ID']; ?>"> <?= $arSect['NAME']; ?></label>
	   <?}}?>            
	   <input type="submit" value="Отправить">
	 </form>    
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>