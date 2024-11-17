<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
?>
<style>
  

   

   

  .accordion__item_show span.widget-element-question-icon-wrapper.accordion__item_show  ,
span.widget-element-question-icon-wrapper.accordion__item_show    span.widget-element-question-icon-wrapper.accordion__item_show   {
      transform: rotate(-180deg);
    }

  

    .accordion__item:not(.accordion__item_show) .accordion__header {
      border-bottom-right-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
    }

    .accordion__content {
      padding: 0.75rem 1rem;
      background: #fff;
      border-bottom-right-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
    }

    .accordion__item:not(.accordion__item_show) .accordion__body {
      display: none;
    }
  </style>
  <script>
    class ItcAccordion {
      constructor(target, config) {
        this._el = typeof target === 'string' ? document.querySelector(target) : target;
        const defaultConfig = {
          alwaysOpen: true,
          duration: 350
        };
        this._config = Object.assign(defaultConfig, config);
        this.addEventListener();
      }
      addEventListener() {
        this._el.addEventListener('click', (e) => {
          const elHeader = e.target.closest('.accordion__header');
          if (!elHeader) {
            return;
          }
          if (!this._config.alwaysOpen) {
            const elOpenItem = this._el.querySelector('.accordion__item_show');
            if (elOpenItem) {
              elOpenItem !== elHeader.parentElement ? this.toggle(elOpenItem) : null;
            }
          }
          this.toggle(elHeader.parentElement);
        });
      }
      show(el) {
        const elBody = el.querySelector('.accordion__body');
        if (elBody.classList.contains('collapsing') || el.classList.contains('accordion__item_show')) {
          return;
        }
        elBody.style['display'] = 'block';
        const height = elBody.offsetHeight;
        elBody.style['height'] = 0;
        elBody.style['overflow'] = 'hidden';
        elBody.style['transition'] = `height ${this._config.duration}ms ease`;
        elBody.classList.add('collapsing');
        el.classList.add('accordion__item_slidedown');
        elBody.offsetHeight;
        elBody.style['height'] = `${height}px`;
        window.setTimeout(() => {
          elBody.classList.remove('collapsing');
          el.classList.remove('accordion__item_slidedown');
          elBody.classList.add('collapsess');
          el.classList.add('accordion__item_show');
          elBody.style['display'] = '';
          elBody.style['height'] = '';
          elBody.style['transition'] = '';
          elBody.style['overflow'] = '';
        }, this._config.duration);
      }
      hide(el) {
        const elBody = el.querySelector('.accordion__body');
        if (elBody.classList.contains('collapsing') || !el.classList.contains('accordion__item_show')) {
          return;
        }
        elBody.style['height'] = `${elBody.offsetHeight}px`;
        elBody.offsetHeight;
        elBody.style['display'] = 'block';
        elBody.style['height'] = 0;
        elBody.style['overflow'] = 'hidden';
        elBody.style['transition'] = `height ${this._config.duration}ms ease`;
        elBody.classList.remove('collapsess');
        el.classList.remove('accordion__item_show');
        elBody.classList.add('collapsing');
        window.setTimeout(() => {
          elBody.classList.remove('collapsing');
          elBody.classList.add('collapsess');
          elBody.style['display'] = '';
          elBody.style['height'] = '';
          elBody.style['transition'] = '';
          elBody.style['overflow'] = '';
        }, this._config.duration);
      }
      toggle(el) {
        el.classList.contains('accordion__item_show') ? this.hide(el) : this.show(el);
      }
    }
  </script>













<style type="text/css">
	i.fa.fa-print {
    margin-right: 10px;
}
.c-faq.c-faq-template-1 .widget-header + .widget-content {
    margin-top: 25px;
}
.c-faq.c-faq-template-1 .widget-tabs .nav.nav-tabs {
    font-size: 0;
    padding: 0 0 20px 0;
    margin: 0;
    list-style: none;
    border-bottom: none;
}
.c-faq.c-faq-template-1 .widget-tabs .nav.nav-tabs.align-left {
    text-align: left;
}
.c-faq.c-faq-template-1 .widget-tabs .nav.nav-tabs.align-center {
    text-align: center;
}
.c-faq.c-faq-template-1 .widget-tabs .nav.nav-tabs.align-right {
    text-align: right;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab {
    display: inline-block;
    padding: 10px 15px;
    float: none;
    margin-bottom: 0;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab a {
    display: inline-block;
    font-size: 14px;
    line-height: 1;
    color: #363532;
    text-decoration: none;
    padding: 0 0 15px 0;
    margin: 0;
    border: none;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab a:focus {
    background-color: transparent!important;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    border-bottom: 2px solid;
    border-color: inherit;
    opacity: 0;
    -webkit-transition: border-color, width 0.4s, 0.4s;
    -moz-transition: border-color, width 0.4s, 0.4s;
    -ms-transition: border-color, width 0.4s, 0.4s;
    -o-transition: border-color, width 0.4s, 0.4s;
    transition: border-color, width 0.4s, 0.4s;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab a:hover::after {
    width: 100%;
    opacity: 1;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab:hover a {
    background-color: transparent;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab.active a {
    position: relative;
    border: none;
    background-color: transparent;
}
.c-faq.c-faq-template-1 .widget-tabs .widget-tabs-tab.active a::after {
    width: 100%;
    opacity: 1;
}
.c-faq.c-faq-template-1 .widget-elements,
.c-faq.c-faq-template-1 .widget-tabs-content-tab {
    border-left: 1px solid #e8e8e8;
    border-right: 1px solid #e8e8e8;
    border-bottom: 1px solid #e8e8e8;
}
.c-faq.c-faq-template-1 .widget-element-wrap {
    border-top: 1px solid #e8e8e8;
}
.c-faq.c-faq-template-1 .widget-element.align-center {
    text-align: left;
}
.c-faq.c-faq-template-1 .widget-element.align-center {
    text-align: center;
}
.c-faq.c-faq-template-1 .widget-element-question {
    padding: 35px 45px;
    cursor: pointer;
}
.c-faq.c-faq-template-1 .widget-element-question-text {
    position: relative;
    font-size: 16px;
    line-height: 20px;
    font-weight: bold;
    -webkit-transition: 0.4s;
    -moz-transition: 0.4s;
    -ms-transition: 0.4s;
    -o-transition: 0.4s;
    transition: 0.4s;
}
.c-faq.c-faq-template-1 .widget-element-question-text-wrap {
    display: block;
    padding-right: 75px;
}
.c-faq.c-faq-template-1 .align-center .widget-element-question-text-wrap {
    padding-left: 75px;
}
.c-faq.c-faq-template-1 .widget-element-question-icon-wrapper {
    display: inline-block;
    position: absolute;
    top: 50%;
    right: 0;
    width: 22px;
    height: 22px;
    margin-top: -11px;
    vertical-align: middle;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    -ms-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}
.c-faq.c-faq-template-1 .widget-element-question-icon-wrapper.active {
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    transform: rotate(180deg);
}
.c-faq.c-faq-template-1 .widget-element-question-icon {
    display: inline-block;
}
.c-faq.c-faq-template-1 .widget-element-answer {
    padding: 35px 45px 35px 45px;
    background-color: #fafafa;
    border-top: 1px solid #e8e8e8;
 
}
.c-faq.c-faq-template-1 .widget-element-answer-text {
    font-size: 14px;
    line-height: 21px;
    display: none;
}
.c-faq.c-faq-template-1 .widget-footer {
    margin-top: 25px;
}
.c-faq.c-faq-template-1 .widget-footer-all {
    display: inline-block;
    font-size: 14px;
    line-height: 1;
    text-decoration: none;
    padding: 15px;
    border: 2px solid;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    -ms-transition: all 0.4s;
    -o-transition: all 0.4s;
    transition: all 0.4s;
}
.c-faq.c-faq-template-1 .widget-footer-all:hover {
    color: #FFF;
}

@media all and (max-width: 720px) {
    .c-faq.c-faq-template-1 .widget-header .widget-title {
        font-size: 36px;
    }
    .c-faq.c-faq-template-1 .widget-element-question {
        padding: 25px;
    }
    .c-faq.c-faq-template-1 .widget-element-answer {
        padding: 35px 25px 35px 25px;
    }
    .c-faq.c-faq-template-1 .align-center .widget-element-question-text-wrap {
        padding-left: 40px;
        padding-right: 40px;
    }
}
@media all and (max-width: 500px) {
    .c-faq.c-faq-template-1 .align-center .widget-element-question-text-wrap {
        padding-left: 0;
    }
}
/* End */
	
	
	/* #print-content{
		display: none;
	}
	#print-content2{
		display: none;
	} */

.uslugi2{
    border: 1px solid #e8e8e8;
    width:100%;
	}
	.uslugi_razdel_h3{
		color: #232121;
	    margin-right: 70px;
	  /*   font-size: 16px; */
	    line-height: 1.5;
	    margin-top: 10px;
	}
	.uslugi_razdel_p{
		 color: #888888;
	    font-size: 13px;
	    line-height: 24px;
	   
	    overflow-x: auto;
    	max-height: 300px;
    	
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
	   /*  height: 77px;
	    overflow: hidden; */
	    transition-property: height;
	    transition-duration: 1s;
	}
.plus {
  height: 24px;
  width: 24px;
  display: inline-block;
  background-color: #353fbd;
  color: white;
 /*  font-size: 24px; */
  line-height: 0px;
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
  line-height: 0px;
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
 /*    display: none; */
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
  /*   margin-left: 15px;
    margin-right: 15px; */
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
  /*   	display: none; */
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
.default_itogo {
	display:none;
}
@media print  {


.flying-basket-mobile-buttons-wrap,
.flying-basket_buttons_wrap,
.noPrint,

 
.intec-content-wrapper,
div[class^='constructor-block-'],
.container-2022,
 .service.landing,
#panel_setup,
#panel,
.no_print, 
tr.no_print, 
.navbar,
.header,
.footer,
.bx-breadcrumb,
.cart_tovar_delete,
.cart_b,
.btn,
.main_menu_gorizontal,
.title_page_main,
.map,
.index_contacts,
.index_slider,
ul,
.default_main_menu,
.fixed_main_menu,
.name_price_xs
    { display: none !important; }

  .print,#price_print { display: block !important; }



.print .name {
  width: 40%;
  float: left;
  display: inline-block;
}

.print .print_adres_tel {
  display: inline-block;
  text-align: right;
  width: 60%;
}

.print .print_adres_tel>div { display: inline-block; text-align: left; }

.print h1{ font-size: 25px; font-family: "normal" }



.main { display: block !important; }
img { width: 100px; height: auto; }

.col-md-1 {  width: 8.33333333% !important; float: left !important; }
.col-md-2 { width: 16.66666667% !important; float: left !important; }
.col-md-5 { width: 41.66666667% !important; float: left !important;  }
.col-md-6 { width: 50% !important; float: left !important;  }
.col-md-8 { width: 66.66666667% !important; float: left !important;  }

.cart_itog { border: none !impotr; }

input { border: none !important; font-size: 18px; font-family: "normal"; }

.hidden-xs { display: block !important; }

a[href^="/"]:after {content: "";}
    
#toolbar { display: none !important; }


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


<div class="col-md-12">
  			
			<div class="print top_logo">
<img  src="https://afforto.ru/images/logo.png"  >
<p class="p_url">https://afforto.ru</p>
</div>
</div>



<?if($arResult["HEADER"]!=""){?>
<div class="main_b intec-content">
	<div class="titleUslg qq">
               <?=$arResult["HEADER"];?>            </div>
</div>
<?}?>

<style>
.top_logo {
z-index:-1;
	position:absolute;
	width:100%;
}
.top_logo p {
	text-algn:right;
}
	#total_price .download { font-size: 18px; }


.default_total_price {
 
  
}


.fixed_total_price {
    position: fixed;
    top: 100px;
    z-index: 20000;
  /*   width: 270px; */
    /*margin-top: 30px;*/
}
.default_total_price .total_price {
	padding:5px;
		
}
.total_price {
	text-align: center;
	padding: 20px;
	border: 1px #EDEDED solid;
    box-shadow: 0 0 30px rgba(0,0,0, .05);
    border-radius: 3px;
    margin-bottom: 20px;
    background: white;  }

/*.total_price label { font-family: 'light'; font-size: 14px; }    */

.kol_tovar_plus_minus .input-group-btn .btn{ padding: 4px 8px !important; }    
.kol_tovar_plus_minus .form-control{ padding: 3px 6px !important; height: 35px !important }    


table.price { font-size: 16px; }
table.price td { vertical-align: middle !important; }

.total_price .title { font-size: 20px; font-family: "Roboto", sans-serif;}
.total_price .summa { font-size: 30px; font-family: "Roboto", sans-serif; margin: 10px 0 5px }


@media print {
	.c-faq.c-faq-template-1 .widget-element-answer {
		padding:0;
	}
	.titleUslg {
		padding:0;
	}
.top_logo {position:absolute;top:-100px; width:100%;}


.p_url {
	position:absolute;
	right:20px;
	top:0px;
}
.uslugi_tables_summ.alCentr {
	text-align:center;
}
.alCentr {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    justify-content: center;
} 
.uslugi_tables_name.alCentr,.uslugi_razdel_table {
	display: flex;
    align-items: left;
	text-align:left;
	   justify-content: left;
}
.colvo_inputdiv {
	width:100%;
}
.total_price .title { font-size: 30px; font-family: "Roboto", sans-serif;float:left;}
 .summa { font-size: 30px; font-family: "Roboto", sans-serif; margin: 10px 100px 5px }

#noPrint {

}

.type_price, #show_price div[id$="noPrint"], #show_price tr[id$="noPrint"] {
	display: none !important;
}

.default_total_price, .fixed_total_price {
    position: relative !important;
    width: 100%;
    text-align: left !important;
    padding: 0 !important;
    border: none !important;
    margin: 0 !important;
    top: 0;
}
.total_price { font-size: 20px; font-family: "Roboto", sans-serif; }
.total_price {border: none !important; padding: 0 !important; text-align: left;}


}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; 
    -webkit-appearance: none;
    margin: 0;
}  
i.fa.fa-print {
    margin-right: 10px;
}


</style>

<div  id="topchik">
 <div class="container" id="price_print">
  	<div class="row">

  	  		
  	  		<div class="col-md-12">
  			<div class="main">

  			




	<div class="row">
		<div id="catalog_uslug" class="col-md-12 col-sm-12">
	
	
	
<div class="intec-content accordion">
<div class="content-wrapper  ">
<div class="widget c-faq c-faq-template-1" >
	<div class="widget-content">	
	<div class="widget-elements" id="category_block">
	

	
<? 
	$category = 10;
	$tovar = 10;
	?>
	<?foreach($arElementGroups as $key=>$ar){ $category++ ;?>
	
	<div class="widget-element-wrap  " id="show_price">
		<div class="widget-element align-left accordion__item" id="category_<?=$category?>_noPrint">
<div class="widget-element-question intec-cl-text-hover accordion__header">
<div class="widget-element-question-text">
<span class="widget-element-question-text-wrap">
	<?=$ar["NAME"]?></span>
<span class="widget-element-question-icon-wrapper accordion__item_show">
<svg class="widget-element-question-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
<path d="M443.5 162.6l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L224 351 28.5 155.5c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.7 4.8-12.3.1-17z" class="">
</path>
</svg>
</span>
</div>
</div>
<div class="widget-element-answer print accordion__body">



	<div id="" class="table1-responsive">
		
		<div class="uslugi_razdel_p">
				
					 <?=$ar["DESCRIPTION"]?>
				
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
				<?foreach($ar["ELEMENTS"] as $key=>$ELEMENTS){ $tovar++;
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
				<div id="product_<?=$tovar?>_noPrint" class="uslugi_tables_flex uslugi_tables_flex2">
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
						<span id="price_<?=$tovar?>">
				<?=$arPricex?></span> ₽
							
						</div>
					</div> 
					<div class="uslugi_tables_colvo alCentr">
						<div class="uslugi_razdel_table ">
							<div class="colvo_inputdiv">
									<button onclick="onMinus(<?=$tovar?>,<?=$category ?>)" class="minus noPrint"></button>

<input type="number" value="0" class="colvo_input" id="compareid_<?=$tovar?>" oninput="onKeyboard(<?=$tovar?>,<?=$category ?>)" min="0" autofocus="" pattern="[0-9]*" style="text-align: center;">
							
								<button onclick="onPlus(<?=$tovar?>,<?=$category ?>)" class="plus noPrint"></button>
							</div>	
						</div>
					</div>
					<div class="uslugi_tables_summ alCentr">
						<div class="uslugi_razdel_table ">
						<span id="sum_<?=$tovar?>"></span>
							
						</div>
				   </div>
				</div>
				</div>
				
				<?}?>
				
				
			
				
				<strong style=" font-size: 20px;">По разделу: <span id="categorySum_<?=$category ?>">0</span> ₽</strong>
				
				
			</div>	
				</div>
				</div>
				</div>
				</div>
		<?}?>
		</div>
		</div>
		</div>
		</div>
		</div>
		  <script>
    new ItcAccordion(document.querySelector('.accordion'), {
      alwaysOpen: true
    });
  </script>	
		</div>
		<div  id="itogo" class="default_itogo">

			<div id="total_price" class="default_total_price">

				<div class="total_price">
					 <div class="title print">Итого на сумму:</div>

					<div class="summa">
					<span id="total_sum" class="print">0</span>
					</div>
					<a href="javaScript:window.print();" class="CallPrint noPrint" style="margin-top: 5px; width: 100%;"><i class="fa fa-print"></i><span> </span> Распечатать</a>
					<div class="type_price ">
						<div class="checkbox">
							<label>
								<input type="checkbox" onclick="onCheckBox(this)" checked="">   Только заполненные							</label>
						</div>
					</div>	
				</div>
								
			</div>

</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	
		
	
	<script>/* (function ($, api) {
$(document).ready(function () {
var root = $('#category_block');
var elements = $('.widget-element .widget-element-question', root);
var answers = $('.widget-element .widget-element-answer', root);
var answersText = $('.widget-element-answer-text', answers);
var icons = $('.widget-element-question-icon-wrapper', elements);
elements.on('click', function () {
var self = $(this);
var answer = self.next();
var answerText = $('.widget-element-answer-text', answer);
var icon = self.find('.widget-element-question-icon-wrapper');
if (answer.is(':hidden')) {
icons.removeClass('active');
icon.addClass('active');
answers.slideUp(500);
answersText.fadeOut(300);
answerText.fadeIn(800);
answer.slideDown(500);
} else {
icon.removeClass('active');
answer.slideUp(500);
answerText.fadeOut(300);
}
});
});
})(jQuery, intec); */</script>	
		


		<script>

		function onCheckBox(checkBox){

			if(!checkBox.checked){
				$('[id^= "show_price" ]').each(function(){
					this.id = "show_price_all";
				});
			}
			if(checkBox.checked){
				$('[id^= "show_price" ]').each(function(){
					this.id = "show_price";
				});
			}
		}


		function countFunc(id, categoryNum){

			var productSum = 0;
			var totalSum = 0;
			var categorySum = 0;
			var quantity = document.getElementById('compareid_'+id).value;
			var price = document.getElementById('price_'+id).innerHTML.replace(' ', '');

			/*вспомагательные переменные для поиска элементов по id*/
			var buff1 = "category_"+categoryNum;
			var buff2 = "category_"+categoryNum+"_print";

			productSum = price*quantity;

			/*форматируем выводимую сумму товара*/
			if(productSum != 0){
				document.getElementById('sum_'+id).innerHTML = 
				(productSum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' ' + '<span>  ₽</span>';
			}
			else{
				document.getElementById('sum_'+id).innerHTML = '';	
			}

			/*общая сумма*/
			$('[id^= "sum_" ]').each(function(){
				var temp = this.innerHTML;

				temp = temp.replace('<span> ₽</span>', '');
				temp = temp.replace(/[ ]/g, "");

				totalSum += temp*1;

				if (this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.id == buff2){
					categorySum += temp*1;
				}

			});

			document.getElementById('total_sum').innerHTML = (totalSum+'  ₽').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			document.getElementById('categorySum_' + categoryNum).innerHTML = (categorySum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			
	var $itogo = $("#itogo");
	var $catalog_uslug = $("#catalog_uslug");		
if (totalSum > 0 ) {
		
	$itogo.removeClass("default_itogo").addClass("col-md-3 col-sm-3  text-right");
	$catalog_uslug.removeClass("col-md-12 col-sm-12").addClass("col-md-9 col-sm-9");
} ;
	if (totalSum == 0 ) {
	$itogo.removeClass("col-md-3 col-sm-3  text-right").addClass("default_itogo");
	$catalog_uslug.removeClass("col-md-9 col-sm-9").addClass("col-md-12 col-sm-12");
	
};		
			
		}


		function onKeyboard(id, categoryNum){

			if(document.getElementById('compareid_'+id).value == "" || document.getElementById('compareid_'+id).value < 0){
				document.getElementById('compareid_'+id).value = 0;
				return;
			}

			var buff1 = "product_" + id + "_";
			var buff2 = "category_" + categoryNum + "";

			/*ставим раздел и продукт на печать*/
			if(document.getElementById('compareid_'+id).value > 0){

				$('[id^= "'+buff2+'" ]').each(function(){
					
					if(this.id != buff2 + "_print"){

						this.id = buff2 + "_print";
		   			//alert(this.id);
		   		}

		   	});				

				$('[id^= "'+buff1+'_" ]').each(function(){

					if(this.id != buff1 + "_print"){
						this.id = "product_" + id + "_print";
		   			//alert(this.id);
		   		}

		   	});
			}

			/*меняем id товара*/
			if(document.getElementById('compareid_'+id).value == 0){

				var buff1 = "product_" + id + "";
				var buff2 = "category_" + categoryNum + "";

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = buff1 + "_noPrint";
		       	//alert(this.id);
		       });
				
			}

			var counter = 0;
			/*идем по категории*/
			$('[id^= "'+buff2+'" ]').each(function(){
				for(var i = 0; i < this.getElementsByTagName('input').length; i++){
					counter += this.getElementsByTagName('input')[i].value;
				}
			});	

			if(counter == 0){
				$('[id^= "'+buff2+'" ]').each(function(){
					this.id = buff2 + "_noPrint";
	       		//alert(this.id);
	       	});
			}




			countFunc(id, categoryNum);

		}


		function onPlus(id, categoryNum){


			var buff1 = "product_" + id + "";
			var buff2 = "category_" + categoryNum + "";

			/*ставим раздел и продукт на печать*/
			if(document.getElementById('compareid_'+id).value == 0){

				$('[id^= "'+buff2+'" ]').each(function(){
					
					if(this.id != buff2 + "_print"){

						this.id = buff2 + "_print";
		       			/*alert(this.id);*/
		       		}

		       	});				

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = "product_" + id + "_print";
		       		//alert(this.id);
		       	});
			}

			document.getElementById('compareid_'+id).value++;

			countFunc(id, categoryNum);

		}

		function onMinus(id, categoryNum){

			if(document.getElementById('compareid_'+id).value == 0){
				return;
			}

			document.getElementById('compareid_'+id).value--;

			/*меняем id товара*/
			if(document.getElementById('compareid_'+id).value == 0){

				var buff1 = "product_" + id + "";
				var buff2 = "category_" + categoryNum + "";

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = buff1 + "_noPrint";
		       	//alert(this.id);
		       });
				
			}

			var counter = 0;
			/*идем по категории*/
			$('[id^= "'+buff2+'" ]').each(function(){
				for(var i = 0; i < this.getElementsByTagName('input').length; i++){
					counter += this.getElementsByTagName('input')[i].value;
				}
			});	

			if(counter == 0){
				$('[id^= "'+buff2+'" ]').each(function(){
					this.id = buff2 + "_noPrint";
	       		//alert(this.id);
	       	});
			}
			countFunc(id, categoryNum);
		}	


	</script>

	<script>

		$(document).ready(function(){

		
			
			$(window).scroll(function(){
				var $total_price = $("#total_price");
			$topchik = (document.getElementById('topchik').getBoundingClientRect().top +window.scrollY);	
			$topchik_b = (document.getElementById('topchik').getBoundingClientRect().bottom +window.scrollY);	
			
			
			 if ($(window).width() > 800){
        if ( $(this).scrollTop() > $topchik && $total_price.hasClass("default_total_price") ){
					$total_price.removeClass("default_total_price").addClass("fixed_total_price");
				}  if(($(this).scrollTop() <= $topchik  && $total_price.hasClass("fixed_total_price")) || ($(this).scrollTop() > $topchik_b && $total_price.hasClass("fixed_total_price")) ) {
					$total_price.removeClass("fixed_total_price").addClass("default_total_price");
				}
        
    }
				
        });//scroll
		});
	</script>




<!--
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
-->