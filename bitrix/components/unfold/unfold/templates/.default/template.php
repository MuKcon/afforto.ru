<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
?>
<style type="text/css">
	#print-content{
		display: none;
	}
	#print-content2{
		display: none;
	}

.uslugi2{
    border: 1px solid #e8e8e8;
    width:100%;
	}
	.uslugi_razdel_h3{
		color: #232121;
	    margin-right: 70px;
	    font-size: 16px;
	    line-height: 1.5;
	    margin-top: 10px;
	}
	.uslugi_razdel_p{
		color: #888888;
	    font-size: 13px;
	    line-height: 24px;
	    margin-top:15px;
	    overflow-x: auto;
    	max-height: 300px;
    	min-height: 15px;
	}
	.uslugi_razdel_h3div{
		border-bottom:1px solid #e8e8e8;
		display: flex;
		justify-content: space-between;
		cursor:pointer;
		align-items: center;
		height: 82px;

	}
	.uslugi_tables{
		
		border:1px solid #e8e8e8;
	}
.uslugi_tables{
	border-top: 0;
}

	.uslugi_tables_name{
		width: 100%;
		border-right:1px solid #e8e8e8;
		border-top: 1px solid #e8e8e8;
	}

	.alCentr{
		display: flex;
    align-items: center;

	}
	.uslugi_tables_price{
		min-width:90px;
		border-right:1px solid #e8e8e8;
border-top: 1px solid #e8e8e8;
		/*font-weight: bold;*/
	}

	.flexhide .uslugi_tables_price{
		font-weight:unset;
	}
	.uslugi_tables_colvo{
		 min-width: 140px;
		border-right:1px solid #e8e8e8;
		border-top: 1px solid #e8e8e8;
	}
	.uslugi_tables_summ{
		 min-width:90px;
		 /*font-weight: bold;*/
		 border-top: 1px solid #e8e8e8;
	}
	.flexhide .uslugi_tables_summ{
		font-weight:unset;
	}
	.uslugi_tables_header{
		padding-top: 8px;
    	padding-left: 10px;
    	background:#f7f5f5;
    	padding-bottom: 10px;
    	height: 39px;
	}
	.uslugi_razdel_table{
		padding-top: 8px;
		padding-bottom: 8px;
    	padding-left: 10px;
    	font-size: 16px;
    	/*color: #737373;*/
    	/*border-top: 1px solid #e8e8e8;*/
	}
	.strlka{
		width:20px;
		height: 20px;
		
	}
	.strlka:before{
		 content: "\f078";
	}
	.uslugi_razdel{
		padding-left:20px;
		padding-right: 20px;
		border-bottom: 1px solid #e8e8e8;
	    height: 77px;
	    overflow: hidden;
	    transition-property: height;
	    transition-duration: 1s;
	}
.plus {
  height: 24px;
  width: 24px;
  display: inline-block;
  background-color: #353fbd;
  color: white;
  font-size: 24px;
  line-height: 24px;
  text-align: center;
  cursor: pointer;
}

.plus::before {
  content: "+";
}
.minus{
  height: 24px;
  width: 24px;
  display: inline-block;
  background-color: #353fbd;
  color: white;
  font-size: 24px;
  line-height: 24px;
  text-align: center;
  cursor: pointer;
}
.minus::before {
  content: "-";
}
.colvo_inputdiv{
	display: flex;
    justify-content: space-between;
    align-items: center;
    width: 114px;
}
.colvo_input{
	width: 50px;
}
.uslugi_itogo{
	min-width: 200px;
    height: 174px;
    /* position: fixed; */
    /* bottom: 364px; */
    /* right: 90px; */
    box-shadow: 3px 2px 14px 1px #888888;
    /* z-index: 1000; */
    background: white;
    border-radius: 7px;
    height: 214px;
    /* margin-right: 29px; */
    margin-right: 44px;
    margin-left: 41px;
    z-index: 300;
    display: none;
    margin-top: 10px;
}
.uslugi_tables_flex{
	display: flex;
}
.uslugi_itogo_p{
    /*margin-top: 23px;*/
    font-size: 20px;
    margin-left: 15px;
    padding-top: 16px;
}

.uslugi_itogo_p2{
	font-size: 27px;
    font-weight: bold;
}
.uslugi_itogo_div{
	/*width: 155px;*/
	width: auto;
    margin-left: 15px;
    display: flex;
    position: relative;
}
.close3p{
    position: absolute;
    right: 24px;
    top: 4px;
    width: 32px;
    height: 32px;
    opacity: 0.6;
    cursor:pointer;
}
.close3p:hover {
  opacity: 1;
}
.close3p:before, .close3p:after {
    position: absolute;
    left: 20px;
    content: ' ';
    height: 24px;
    width: 2px;
        background-color: #655b5b;
}
.close3p:before {
  transform: rotate(45deg);
}
.close3p:after {
  transform: rotate(-45deg);
}
.color_black{
	color:black;
	font-size: 16px;
}
.dd{
	background-image: url(/bitrix/templates/universe_s1/img/down-chevron-458459.png);
    height: 20px;
    width: 20px;
    background-size: cover;
    opacity: 0.5;
    transform: rotate(0deg);
}
.flexprint{
	color:red;
	display: flex;
}
.CallPrint{
	background-color: #352ca6;
    border-color: #352ca6;
    /* padding: 10px; */
    line-height: 23px;
    color: #fff;
    display: flex;
    /*width: 128px;*/
    width:auto;
    height: 38px;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
    margin-right: 15px;
    cursor: pointer;
    border-radius: 3px;

}
.checkbox{
	margin-left: 15px;
}
.main_b{
	
	display: flex;
}
.mobaleflex{
	display: flex;
}
.flexhide{
	display: flex;
}
.flexshow{
	display: none;
}
.uslugi_itogodiv1{
	min-width: 0px;
}

.uslugi_itogodiv1Show{
	min-width: 255px;
}

@media (max-width: 1035px) {
/*	.colvo_inputdiv{
		 width: 100%;
	    flex-direction: column;
	    height: 87px;
	}*/

	.colvo_input {
	   min-width: 37px;
	}
	.uslugi_tables_price{
		min-width: 90px;
	}
	.uslugi_tables_summ{
		min-width: 90px;
	}


}
@media (max-width: 945px) {
	.uslugi_itogodiv1{
		min-width: 0px;
	}

	.uslugi_itogodiv1Show{
		min-width: 0px;
	}

	.uslugi_tables_flex2{
		flex-wrap: wrap;
	}
	.flexhide{
	display: none;
	}
	.flexshow{
		display: flex;
	}
	.uslugi_itogo{	
	    height: 174px;
	    position: fixed;
	    height: 117px;
	    bottom: 37px;
	    left: 17px;
	    margin-left: 0;
    }
    .CallPrint{
    	display: none;
    }
    .checkbox{
    	display: none;
    }
    .mobaleflex{
    	width:100%;
    }
    .flexshow{
    	width:100%;
    }
    .uslugi_tables_summ{
    	width:100%;
    }
    .uslugi_tables_price{
    	width:100%;
    }
    .uslugi_itogodiv1{
	width: 0px;
	}
}
@media (max-width: 1024px) {
.uslugi_tables_mob_hide{
		display: none;
	}

	.main_b{
		justify-content: center;
	}
}

@media (max-width: 460px) {
	.uslugi2 {
		width:320px;
	}


		.uslugi_razdel_h3{
max-width: 230px;
}
}

@media (max-width: 370px) {
	.uslugi2 {
		width:270px;
	}
}

.titleUslg{
	    width: 100%;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    line-height: 34px;
    color: #2c2c2d;
    margin-bottom: 15px;
}

</style>

<!-- <link rel="stylesheet" type="text/css" href="/bitrix/templates/universe_s1/css/stylenew.css"> -->
<?
	// $arParams = $arResult["IBLOCK_IDY"];
	// $dbResSect = CIBlockSection::GetList(
	//    Array("SORT"=>"ASC"),
	//    Array("IBLOCK_ID"=>$arParams,"ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", 'SECTION_ID'=>74),
	//   false,
	//   Array("UF_PRICE")
	// );
	// while($sectRes = $dbResSect->GetNext())
	// {
	//  $arSections2[] = $sectRes["NAME"];
	// }
	// var_dump($arSections2);
	$arParams = $arResult["IBLOCK_IDY"];
	//print_r( $arResult["RAZDEL"]);
	$dbResSect = CIBlockSection::GetList(
	   Array("SORT"=>"ASC"),
	   Array("IBLOCK_ID"=>$arParams,"ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "ID" => $arResult["PODRAZDEL"]),
	  false,
	  Array("UF_PRICE")
	);
	while($sectRes = $dbResSect->GetNext())
	{
	 $arSections[] = $sectRes;
	}

$db_res = CCatalogProduct::GetList(
        array("ID" => "ASC")

);
while (($ar_res = $db_res->Fetch()) )
{
	$ar_res2[] = CIBlockElement::GetByID($ar_res["ID"])->GetNextElement()->GetFields();
}
//var_dump($ar_res2);
//..........................
 foreach($arSections as $arSection){   
 	 foreach($ar_res2 as $key=>$arItem){  
 	   if($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']){
 		   $arSection['ELEMENTS'][] =  $arItem;
		  
 	   }
 	 } 
	  $arElementGroups[] = $arSection;
 	}
$i = 0;
?>
<?if($arResult["HEADER"]!=""){?>
<div class="main_b intec-content">
	<div class="titleUslg">
               <?=$arResult["HEADER"];?>            </div>
</div>
<?}?>
<div class="main_b intec-content">
	
	
	<div class="uslugi2">
		<?foreach($arElementGroups as $key=>$ar){?>
		<div class="uslugi_razdel">
			<div class="uslugi_razdel_h3div">
				<h3 class="uslugi_razdel_h3"><?=$ar["NAME"]?></h2>
				<div class="dd">
					
				</div>
			</div>
			<div class="uslugi_razdel_p">
				<p>
					 <?=$ar["DESCRIPTION"]?>
				</p>
			</div>
			<div class="uslugi_tables">
				<div class="uslugi_tables_flex uslugi_tables_mob_hide">
				<div class="uslugi_tables_name">
				  
					<div class="uslugi_tables_header">
						<p>Наименование</p>
					</div>
				</div>
				<div class="flexhide">
					<div class="uslugi_tables_price">
						<div class="uslugi_tables_header">
							<p>Цена</p>
						</div>

					</div>
					<div class="uslugi_tables_colvo">
						<div class="uslugi_tables_header">
							<p>Кол-во</p>
						</div>
					</div>
					<div class="uslugi_tables_summ">
						<div class="uslugi_tables_header">
							<p>Сумма</p>
						</div>
					 </div>
				 </div>
				</div>
				<?foreach($ar["ELEMENTS"] as $key=>$ELEMENTS){
					$dbPrice = CPrice::GetList(
					        array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
					        array("PRODUCT_ID" => $ELEMENTS["ID"]),
					        false,
					        false,
					        array()
					    );
					$arPricex = 0;
					while ($arPrice = $dbPrice->Fetch())
					{
					    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
					            $arPrice["ID"],
					            $USER->GetUserGroupArray(),
					            "N",
					            SITE_ID
					        );
					    $discountPrice = CCatalogProduct::CountPriceWithDiscount(
					            $arPrice["PRICE"],
					            $arPrice["CURRENCY"],
					            $arDiscounts
					        );
					    $arPrice["DISCOUNT_PRICE"] = $discountPrice;
					    //$arPricex = $arPrice["PRICE"];
					    $arPricex = $arPrice["DISCOUNT_PRICE"];
					}
					$i++;
					?>
				<div class="uslugi_tables_flex uslugi_tables_flex2">
					<div class="uslugi_tables_name alCentr">
						<div class="uslugi_razdel_table">
							<p class="color_black" idprice3="<?=$i?>"><?=$ELEMENTS["NAME"]?></p>
							<?if($ELEMENTS["DETAIL_TEXT"]!=""){?><div class="uslugi_razdel_p" idprice4="<?=$i?>"><?=$ELEMENTS["DETAIL_TEXT"]?></div><?}?>
						</div>

					</div>
					<div class="flexshow uslugi_tables_mob_hide">
						<div class="uslugi_tables_price ">
							<div class="uslugi_tables_header">
								<p>Цена</p>
							</div>

						</div>
						<div class="uslugi_tables_colvo ">
							<div class="uslugi_tables_header">
								<p>Кол-во</p>
							</div>
						</div>
						<div class="uslugi_tables_summ ">
							<div class="uslugi_tables_header">
								<p>Сумма</p>
							</div>
						 </div>
					 </div>
					<div class="mobaleflex">
					<div class="uslugi_tables_price alCentr">
						<div class="uslugi_razdel_table ">
							<p idprice1="<?=$i?>"><?=$arPricex?> &#8381;</p>
						</div>
					</div>
					<div class="uslugi_tables_colvo alCentr">
						<div class="uslugi_razdel_table ">
							<div class="colvo_inputdiv" idprice="<?=$i?>">
								<div class="minus"></div> <input class="colvo_input" value="0">
								<div class="plus"></div>
							</div>	
						</div>
					</div>
					<div class="uslugi_tables_summ alCentr">
						<div class="uslugi_razdel_table ">
							<p idprice2="<?=$i?>"></p>
						</div>
				   </div>
				</div>
				</div>
				<?}?>
				
			</div>
		</div>
		<?}?>

	</div>
	<div class="uslugi_itogodiv1">
		<div class="uslugi_itogo">
			<p class="uslugi_itogo_p">Итого на сумму:</p>
			<div class="uslugi_itogo_div"><p class="uslugi_itogo_p2">0 &#8381;</p>
				<a  class="close3p"></a>
			</div>
			<div  title="Распечатать проект" class="CallPrint">Распечатать</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" id="checkbox1" checked="">   Только заполненные							
				</label>
			</div>
		</div>
	</div>

</div>


<div id="print-content">
			<div class="uslugi_tables_flex">
				<div class="uslugi_tables_name">
				  
					<div class="uslugi_tables_header">
						<p>Наименование</p>
					</div>
				</div>
				<div class="uslugi_tables_price">
					<div class="uslugi_tables_header">
						<p>Цена</p>
					</div>

				</div>
				<div class="uslugi_tables_colvo">
					<div class="uslugi_tables_header">
						<p>Кол-во</p>
					</div>
				</div>
				<div class="uslugi_tables_summ">
					<div class="uslugi_tables_header">
						<p>Сумма</p>
					</div>
				 </div>
				</div>

		</div>
<div id="print-content2">

</div>
<script type="text/javascript">
	$(".uslugi_razdel_h3div").on("click", function(){
		if(parseInt($($(this).parent()).css("height"))>77){
			
			$($(this).parent()).css({"height":"77px"});
			$($(this).find(".dd")).css({"transform": "rotate(0deg)"});
		}else{
			//$($(this).parent()).css({"height":$(this).parent()[0].scrollHeight+"px"});
			$($(this).parent()).css({"height":"auto"});
			$($(this).find(".dd")).css({"transform": "rotate(180deg)"});
			//$(".dd").css({"transform": "rotate(0deg)"});
		}
		
	});
	$(".close3p").on("click",function(){
		$(".uslugi_itogo").hide("slow");
		$(".uslugi_itogodiv1").removeClass("uslugi_itogodiv1Show");

	})
	var summ = {};
	var s = 0;
	function summprice(){
		s = 0;
		for(i in summ){
			s = s + (summ[i][0]*summ[i][1]);
		}
		if(s >0){
			$(".uslugi_itogo").show("slow");
			$(".uslugi_itogodiv1").addClass("uslugi_itogodiv1Show");
		}else{
			$(".uslugi_itogo").hide("slow");
			$(".uslugi_itogodiv1").removeClass("uslugi_itogodiv1Show");
		}
		$(".uslugi_itogo_p2").text(s+" ₽")

	}

	$(".minus").on("click",function(){
		//$($($(this).parent()).find(".colvo_input")).val()+1;
		var idprice = $($(this).parent()).attr("idprice");
		var element = $($($(this).parent()).find(".colvo_input"));
		var v = parseInt(element.val());
		if(v>0){
			element.val(v-1);
			v = v - 1;
		}
		console.log("[idprice1="+idprice+"]");
		var price = parseInt($("[idprice1="+idprice+"]").text());
		$("[idprice2="+idprice+"]").text(price*v+"₽");
		summ[idprice] = [price,v];

		summprice();
		//console.log(price);
	})
	$(".plus").on("click",function(){
		//$($($(this).parent()).find(".colvo_input")).val()+1;
		var idprice = $($(this).parent()).attr("idprice");
		var element = $($($(this).parent()).find(".colvo_input"));
		var v = parseInt(element.val());

		element.val(v+1);
		v = v + 1;
		console.log("[idprice1="+idprice+"]");
		var price = parseInt($("[idprice1="+idprice+"]").text());
		$("[idprice2="+idprice+"]").text(price*v+"₽");
		summ[idprice] = [price,v];
		summprice();
		//console.log(price);
	})
$(".CallPrint").on("click",function(){
	CallPrint()
})
function CallPrint() {
  var prtCSS =`<style type="text/css">
	.uslugi1{
		border:1px solid #e8e8e8;
		width:800px;
		margin:auto;
		width:80%;
	}
	.uslugi_razdel_h3{
		color: #232121;
	    margin-right: 70px;
	    font-size: 16px;
	    line-height: 1.5;
	}
	.uslugi_razdel_p{
		color: #888888;
	    font-size: 13px;
	    line-height: 24px;
	    margin-top:15px;
	}
	.uslugi_razdel_h3div{
		border-bottom:1px solid #e8e8e8;
		display: flex;
		justify-content: space-between;
		cursor:pointer;
		align-items: center;

	}
	.uslugi_tables{
		
		border:1px solid #e8e8e8;
	}
	.uslugi_tables_name{
		width: 100%;
		border-right:1px solid #e8e8e8;
	}
	.uslugi_tables_price{
		width:116px;
		border-right:1px solid #e8e8e8;
	}
	.uslugi_tables_colvo{
		 width: 201px;
		border-right:1px solid #e8e8e8;
	}
	.uslugi_tables_summ{
		 width: 172px;
	}
	.uslugi_tables_header{
		padding-top: 8px;
    	padding-left: 10px;
    	background:#f7f5f5;
    	padding-bottom: 10px;
	}
	.uslugi_razdel_table{
		padding-top: 8px;
		padding-bottom: 8px;
    	padding-left: 10px;
    	font-size: 14px;
    	color: #737373;
    	border-top: 1px solid #e8e8e8;
	}
	.strlka{
		width:20px;
		height: 20px;
		
	}
	.strlka:before{
		 content: "\f078";
	}
	.uslugi_razdel{
		padding-left:20px;
		padding-right: 20px;
		border-bottom: 1px solid #e8e8e8;
	    height: 53px;
	    overflow: hidden;
	    transition-property: height;
	    transition-duration: 1s;
	}
.plus {
  height: 24px;
  width: 24px;
  display: inline-block;
  background-color: #353fbd;
  color: white;
  font-size: 24px;
  line-height: 24px;
  text-align: center;
  cursor: pointer;
}

.plus::before {
  content: "+";
}
.minus{
  height: 24px;
  width: 24px;
  display: inline-block;
  background-color: #353fbd;
  color: white;
  font-size: 24px;
  line-height: 24px;
  text-align: center;
  cursor: pointer;
}
.minus::before {
  content: "-";
}
.colvo_inputdiv{
	display: flex;
    justify-content: space-between;
    align-items: center;
    width: 114px;
}
.colvo_input{
	width: 50px;
}
.uslugi_itogo{
    width: 188px;
    height: 132px;
    position: fixed;
    bottom: 95px;
    right: 52px;
    box-shadow: 3px 2px 14px 1px #888888;
    z-index: 1000;
    background: white;
    border-radius: 7px;
    display: none;
}
.uslugi_tables_flex{
	display: flex;
}
.uslugi_itogo_p{
	text-align: center;
    margin-top: 23px;
    font-size: 20px;
}

.uslugi_itogo_p2{
	font-size: 27px;
    font-weight: bold;
}
.uslugi_itogo_div{
	width: 155px;
    margin: auto;
    display: flex;
}
.close3p{
    position: absolute;
    right: 24px;
    top: 69px;
    width: 32px;
    height: 32px;
    opacity: 0.6;
    cursor:pointer;
}
.close3p:hover {
  opacity: 1;
}
.close3p:before, .close3p:after {
    position: absolute;
    left: 20px;
    content: ' ';
    height: 24px;
    width: 2px;
    background-color: #ff5656;
}
.close3p:before {
  transform: rotate(45deg);
}
.close3p:after {
  transform: rotate(-45deg);
}
.color_black{
	color:black;
}
.dd{
	background-image: url(/bitrix/templates/universe_s1/img/down-chevron-458459.png);
    height: 20px;
    width: 20px;
    background-size: cover;
    opacity: 0.5;
    transform: rotate(0deg);
}
.flexprint{
	color:red;
	display: flex;
}
  </style>`;

  var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
  WinPrint.document.write('<div id="print" class="contentpane">');
  WinPrint.document.write(prtCSS);
   WinPrint.document.write("<p><img src='/images/logo.png' style='width:150px'></p>");
  //WinPrint.document.write("<div class='uslugi_tables_flex'>");
  WinPrint.document.write($("#print-content").html());
  WinPrint.document.write(printparse());
  if(document.getElementById('checkbox1').checked) {
		WinPrint.document.write("<p>Итого на сумму "+s+" ₽</p>");
	} 
  
  WinPrint.document.write("</div>");
  //WinPrint.document.write('</div>');
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  //WinPrint.close();

}
function printparse(){
	var divstr = ``;
	if(document.getElementById('checkbox1').checked) {

	} else {
    	//console.log("ненажат");
    	for(var j = 0; j<$(".uslugi_tables_flex2").length; j++){
    		divstr = divstr+ `<div class="uslugi_tables_flex">`+ $($(".uslugi_tables_flex2")[j]).html() + `</div>`
    	}
    	$("#print-content2").html(divstr);
    	$("#print-content2 .colvo_inputdiv").remove();
    	return $("#print-content2").html();
    }
	for(i in summ){
			divstr = divstr+ `<div class="uslugi_tables_flex">
					<div class="uslugi_tables_name">
						<div class="uslugi_razdel_table">
							<p class="color_black">`+$("[idprice3 ="+i+"]").text()+`</p>
							<div class="uslugi_razdel_p">
							<p>
								`+$("[idprice4 ="+i+"]").text()+` 
							</p>
						</div>	
						</div>

					</div>
					<div class="uslugi_tables_price">
						<div class="uslugi_razdel_table">
							<p">`+$("[idprice1 ="+i+"]").text()+`</p>
						</div>
					</div>
					<div class="uslugi_tables_colvo">
						<div class="uslugi_razdel_table">
							<p>`+summ[i][1]+` шт</p>
						</div>
					</div>
					<div class="uslugi_tables_summ">
						<div class="uslugi_razdel_table">
							<p idprice2="">
								`+$("[idprice2 ="+i+"]").text()+`
							</p>
						</div>
				   </div>
				</div>`;
  	}
  	return divstr;
	
}
 if(window.innerWidth > 970){
	var x = 169;
	$(window).scroll(function () {
			//console.log($('.uslugi_itogo').offset().top - $(this).scrollTop());
			if(($('.uslugi_itogo').offset().top - $(this).scrollTop())<120){
				$('.uslugi_itogo').css({"position":"fixed","top":"95px"});
			}
			if(x >= $(this).scrollTop()){
				$('.uslugi_itogo').css({"position":"inherit"});
			}
			//if($('.uslugi_itogo').offset().top - 120 )
	});
}
if(window.innerWidth < 480){
	$(".uslugi2").css({"min-width":window.innerWidth - 50 +"px"})
}
$(window).resize(function(){
	 if(window.innerWidth < 480){
		$(".uslugi2").css({"min-width":window.innerWidth - 50 +"px"})
	}

	//$($(".uslugi_razdel_h3div").parent()).css({"height":$(".uslugi_razdel_h3div").parent()[0].scrollHeight+"px"});
});
</script>
