<!--   CSS /css/page_garantii.css  ------>
<link rel="stylesheet" type="text/css"  href="/css/tab_1.css?rnd=9"/>
<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<div id="error"></div>

<link rel="stylesheet" type="text/css"  href="/css/navigation_bar_vert_FACT.css?rnd=9"/>


<?
$added_url = '';
?>
<!--div style="float:left;position:fixed;margin-top:270px;margin-left:5px;">
<a href="/calculations/inputdata_fact/?id=<?=$data['id']?><?=$added_url?>"><img src="/images/btnPrevious.png" width="50px" title="Повернутись в галузеві гарантії"></a>
</div--><?
// var_dump($data,$data['sets_array']);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
$db = new SafeMySQL();
$work_days_director=$db->getOne ("SELECT SUM(`work_days_director`*8-`before_days_holydays`) FROM      `zvit_1_min_zp`   WHERE `period` LIKE '%".date('Y')."'");//houars per year
if($work_days_director<1)$work_days_director=2000;
    $work_days_director=($work_days_director/12);

if($data['calcul']=='calcul'){$calcul='calcul';$calcultable='calcul';$modelc= new Model_calcul();$c57='57';$c_57='_57';$dNight=0.35;$dEv=0.2;}
else {$calcul='calculations';$calcultable='calculation';$modelc= new Model_calculations();$c57='';$c_57='';$dNight=0.4;$dEv=0.2;}





//$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` ORDER BY `id` DESC limit 1");

$tarif_date=date('m').'/'.date('Y');

$id_tarif =$db->getRow("SELECT * FROM `archiv_tarifs` WHERE  `id`=?s",$_GET['id_tarif']);
$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
if($_GET['sfera']==0&&$id_tarif['min_zp']>0){$min_zp = $id_tarif['min_zp'];}

//=if(strpos($tarif_date,'/2017')) $min_zp=1600;
$bottom = $db->getOne("SELECT `bottom` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");


//$kontrakt= $db->getOne("SELECT `osnovna_zp_kontrakt` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
//$kontrakt= $db->getOne("SELECT `in kontrakt` FROM `calculation_garrantiesHeads` WHERE  `type`='director' AND `id_pidpriemstva`=?s",  $_GET['id']);
//$kontrakt= $db->getRow('SELECT * FROM `calculation_garrantiesHeads` WHERE  `id_pidpriemstva`=?s ORDER BY `seniority`',  $_GET['id']);
$region= $data['name']['region'];
$regional_coef=1;
// $data_redag= $db->getOne("SELECT `data_redag` FROM `calculation_workers` WHERE `id_pidpriemstva`=?s",$_GET['id']);
// $tabCalcW= $db->getRow("SELECT * FROM `calculation_workers` WHERE `id_pidpriemstva`=?s",$_GET['id']);
if ($region=='Донецька область') {$regional_coef =1.15;}
else {$regional_coef = 1;}
//		$xxx=$db->getRow("SELECT * FROM `calculation_garrantiesWorkers` WHERE   `id_pidpriemstva`=?s",  $_GET['id']);
// 			var_dump($tarif_date,$min_zp);	//
		//echo "Последнее изменение: " . date ("F d Y H:i:s.", getlastmod()) ;
		//echo "Файл в последний раз был изменен: " . date("F d Y H:i:s.", filemtime());

$url = $_SERVER['REQUEST_URI'];
$arr = parse_url($url);
//$arr["query"]

// 	$sfera=$db->getRow ("SELECT * FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$tab =$sfera=$data['name'];//= $db->getRow('SELECT * FROM `table_1` WHERE `id`=?s',  $_GET['id']);
    //$dodatkova_zp_kontrakt =   $db->getOne("SELECT `dodatkova_zp_kontrakt` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
//$sezon =   $db->getOne("SELECT `sezon` FROM `calculation_garrantiesWorkers` WHERE `id_pidpriemstva`=?s ORDER BY `seniority`",  $_GET['id']);
$sezon= $data['name']['sezon'];
// if(isset($_POST['min_zp'])){$min_zp=$_POST['min_zp'];if($min_zp<1600)$bottom=$min_zp;
// }
	?>
 <style type="text/css">



</style>
<meta charset="utf-8">
<?if(count($data['all_d'])>5){?>
<style>
.edit_a:before{    content: 'W';    font: 28px/28px FontAwesome;    color:#fff;background:#0051a3;text-decoration: none;padding:7px;
border:0px solid #fff;

}
    .edit_a:hover:before{    content: 'W';    font: 28px/28px FontAwesome;    color:#fff;background:#0051a3;text-decoration: none;padding:5px;
    box-shadow: 0 0 0 3px #fff, 0 0 0 5px #0051a3;
    /*border:3px solid #fff;*/

    }
</style>

<div id="" style="position:fixed;left:2px;top:315px;width:30px;height:30px;z-index:5;">
<ul class="navbar">
<li><a href="#workers" class="edit_a" title="Перехід до робітничого персонала">
    <!--<img width='40' alt="Workers"  src="/images/updown_h-.png" class="hover">-->
    <!--<span><img alt="W" title="" width='40' src="/images/updown.png"></span>-->
    </a></li>
</ul>
</div><?}?>
	<!-- Шапка -->
	<header class="inner">
		<div class="cont">
			<div class="sector_flex">
				<div class="logo">
					<a href="/calculations/cabinet/?id=<?=$_GET['id']?>">
						<span>
							<b><?=$data['name']['povne_naymenuvannya']?></b><br/>
							<?if($data['name']['region']=='м. Київ') {
			$data['name']['region']='';
			}?>
			<?=$data['name']['region']?><br/> місто <?=$data['name']['misto']?>
						</span></a>
<a href="//fru-gkh.com.ua/">
						<img src="/views/images/logo.png" alt="">
					</a>
				</div>

				<div class="wrap_tel">
					<div class="block_tel">
						<div class="title">Підтримка користувачів</div>

						<div class="tel"><a href="#" class="mini_modal_link" data-modal-id="#modal_telst"><b>044</b> 209 03 93</a></div>

						<div class="mini_modal" id="modal_telst">
							<div><b>099</b> 519 54 76</div>
                            <div><b>067</b> 829 44 42</div>
                            <div><b>063</b> 307 87 17</div>
							<div><b>044</b> 227 01 08</div>
						</div>
					</div>
				</div>
<?
$activity=$data['name']['activity'];

//var_dump($data['name']['activity']);


$c=substr_count($activity, '<div>');
$v=substr($activity, 5,9);

if($c==0){$v=substr($activity, 37,12);
$c=substr_count($activity, '<br/>');}
?>
				<div class="wrap_operation">
					<div class="operation">
						<div class="title">Сфери діяльності</div>

						<div class="link"><a href="#" class="mini_modal_link" data-modal-id="#modal_operation"><b><?=$v?></b> (<?=$c?>)</a></div>

						<div class="mini_modal" id="modal_operation">
							<?=$activity?>
						</div>
					</div>
				</div>
<?$instr="";

?>

				<div class="wrap_instruction">
					<div class="instruction">
						<a href="#" class="mini_modal_link" data-modal-id="#modal_inst">Інструкція</a>

						<div class="mini_modal" id="modal_inst" style="width: 500px;">
							<div ><?=$instr?>
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Шапка -->


  <style>
      section .main_titler{    position: relative;
      margin-top: 26px;    padding-left: 100px;    color: #606060;    font: 700 20px Ubuntu;    text-transform: undercase;    letter-spacing: .020em;}
      section .main_titler:before{    position: absolute;    top: 12px;    left: 0;    width: 80px;    height: 2px;    background: #cd1000;    content: '';}
  .ugoda:after{    position: relative;    top: -10;    right: -5;    font-family: FontAwesome;  color:#cd1000;
	 font-size: 14px;    font-weight: normal;    content: '\f005';}
  </style>
<?$ugoda_class='';
if($data['calcul']!=='calcul' && ($data['name']['ugoda']=='26'  || $data['name']['ugoda']==''))$ugoda_class='ugoda';
if($data['calcul']=='calcul' && $data['name']['ugoda']=='57' )$ugoda_class='ugoda';
// var_dump($data['calcul'],$data['name']['ugoda'],$ugoda_class);

if(!isset($_GET['diln']))$_GET['diln']=0;
?>

	<!-- Основная часть -->
	<section>
		<div class="cont">
			<div class="main_titler <?=$ugoda_class?>"><?=$data['table_name']?>
				<?if($_GET['diln']=='empty'  && count($data['diln'])>1)
  {      ?>Головне підприємство<?}?>
  <?if($_GET['diln']>0){?>Відокр. підрозділ №<?=$_GET['diln']?><?}?>
			</div>
		</div>
	</section>
		<section class="section_edit">
	<div class="bng_red">
			<div class="cont">
				<div class="box_flex box_flex--small">
<?if($data['calcul']!=='calcul'){?>
<div class="edit"><a href="/<?=$calcul?>/pererahunokSferaA/?<?=$arr["query"]?>" onClick='return confirmDelete();' class="submit_btn" >Оновити розрахунки</a></div><?}?>
<div class="edit"><a href="//fru-gkh.com.ua/request/visnovok/?cat=A&id=<?=$_GET['id']?>&sfera=<?=$_GET['sfera']?>" target="_blank" class="submit_btn" onClick="return confirmDelete();">Замовити висновок А</a></div>
<div class="edit"><a href="/models/Model_calcExel.php?<?=$arr["query"]?>&factor=A&calcul=<?=$calcul?>" target="_blank" class="submit_btn">Excel</a></div>
<?if($_SESSION['status']>'0'){?><div class="edit"><a href="/<?=$calcul?>/print_A/?min_zp=<?=$min_zp?>&<?=$arr["query"]?>" target="_blank" class="submit_btn">Друк висновку</a></div><?}?>
					<!--div class="edit"><a href="/models/Model_printVymogaTarif.php?<?=$arr["query"]?>" target="_blank" class="submit_btn">Вимога</a></div-->
				</div>
			</div>
		</div>
	</section>


 <style type="text/css">
.infosubmit{padding:4px;border: 0px solid #606060;color: #606060;font: 700 16px Ubuntu;background: #f8f8f8;
text-transform: undercase;font-size:100%;}
.infosubmit:hover{    color: #0051a3;    background: transparent;}
.consultant .name{    color: #606060;    font: 500 18px Ubuntu;    letter-spacing: .020em;}
.consultant .info{    margin-top: 22px;    color: #202020;    font: 700 16px Ubuntu;}
span .info .instructio:after{ position: absolute;    top: 0;    right: 0;
font-family: FontAwesome;    font-size: 21px;    font-weight: normal;    content: '\f107'}

	  .operatio .title{    color: #0051a3;    font: 500 15px Ubuntu;} .operatio .link a{    position: relative;    padding-right: 24px;    color: #0051a3;
	 font: 500 20px Ubuntu;    text-decoration: none;} .operatio .link a:after{    position: absolute;    top: 10;    right: 0;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';} .operatio .link{    margin-top: 10px;} .operatio .link a{    padding-right: 20px;
	 font-size: 16px;    line-height: 23px;} .operatio .link a:before{    font-size: 16px;} .operatio .link a b{    font-size: 20px;    font-weight: 500;}
	 .operatio .mini_modal{    position: absolute;    top: 100%;    left: 15%;    z-index: 999;    display: none;    width: 156px;    padding: 0 8px 14px;
	 color: #606060;    font: 300 20px Ubuntu;    background: #fff;    box-shadow: 0 2px 7px rgba(0,0,0,.30);} .operatio .mini_modal{    left: 30px;
	 width: 456px;    font-size: 16px;}.operatio .mini_modal div{    margin-top: 16px;} .operatio .mini_modal b{    font-size: 20px;    font-weight: 500;}
	/* .operatio .mini_modal b{    font-size: 25px;}*/

	.instructio a{    position: relative;    padding-right: 24px;    color: #0051a3;
	 font: 500 20px Ubuntu;    text-decoration: none;} .instructio a:after{    position: absolute;    top: 0;    right: -10;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';} .instructio{    margin-top: 10px;} .instructio a{    padding-right: 20px;
	 font-size: 16px;    line-height: 23px;} .instructio a:before{    font-size: 16px;} .instructio a b{    font-size: 20px;    font-weight: 500;}
	 .instructio .mini_modal{    position: absolute;    top: 100%;    left: 15%;    z-index: 999;    display: none;    width: 156px;    padding: 0 8px 14px;
	 color: #606060;    font: 300 20px Ubuntu;    background: #fff;    box-shadow: 0 2px 7px rgba(0,0,0,.30);} .instructio .mini_modal{    left: 550px;
	 width: 95px;    font-size: 16px;}.instructio .mini_modal div{    margin-top: 16px;} .instructio .mini_modal b{    font-size: 20px;    font-weight: 500;}
</style>


<section class="bng_section consultant">
		<div class="cont pl-50">
			<div class="">
			   <span class="name" >
	Мінімальна заробітна плата, що врахована в розрахунку </span>	<span class="info" style="padding:4px;">
<?=$bottom?> грн.</span></div>

	<?/*if(isset($_POST['min_zp'])){$min_zp=$_POST['min_zp'];if($min_zp<1600)$bottom=$min_zp;
}*/

//

/////////////////////////////////////////
$koef_rob_prof_zagal=1;
if($data['calcul']!=='calcul'){
$vsi_sfery = '';$i=0;$proff_prof ='';
while($i<44){$i++;
$vsi_sfery.=$sfera['sfera_'.$i].',';
}
foreach ($modelc->proff_proff as $sfera_d => $c):
				if (strstr($vsi_sfery, $sfera_d))

					{$proff_prof = $c;
					}
				endforeach;
/////////////
foreach ($modelc->coeff_proff as $sfera_d => $c):
					if (strstr($vsi_sfery, $sfera_d))
				{
								$koef_rob_prof_zagal = $c;
							}
endforeach;
}	else{
$proff_prof=$data['koef_rob_prof_zagalITR'][1];
$koef_rob_prof_zagal=$data['koef_rob_prof_zagalITR'][0];}
///////////////////////
// $data['quantity_workers'];
// $koef_rob_prof_zagal = 1;	$sets=array();
// foreach ($modelc->coeff_proff as $sfera_d => $c):
// 					$sets[$sfera_d]=0;
// 					endforeach;
//   var_dump($modelc->getkoef_rob_prof_zagalITR($_GET['id'],$_GET['sfera'],$_GET['id_tarif']),$koef_rob_prof_zagal,$data['koef_rob_prof_zagalITR']);
// foreach($data['all_w'] as $t){
// if($t['postachannia']!==''  && $t['postachannia'] !== '0'){
//     $sets[$t['postachannia']]+= $t['shtat_kilkist'];
//     // var_dump($t['postachannia'],$t['shtat_kilkist']);
// }
// }
// foreach($sets as $k=>$v){//$sets[$k]>0 && =$data['quantity_workers']*0.2
//     if( $v>0){
//       var_dump($k,$v);//,$modelc->coeff_proff[$k]);
//       $koef_rob_prof_zagal=$modelc->coeff_proff[$k];
//     }

//     }
//     var_dump($koef_rob_prof_zagal);////////////////////////////////
// if($koef_rob_prof_zagal == 1){
//     $max_sets=max($sets);
//     foreach($sets as $k=>$v){//$sets[$k]>0 &&
//     if( $v==$max_sets){
//       var_dump($k,$v,$modelc->coeff_proff[$k]);
//       $koef_rob_prof_zagal=$modelc->coeff_proff[$k];
//     }

//     }
// }
////////////////////////////////

// $proff_prof=$data['koef_rob_prof_zagalITR'][1];
//   var_dump('rr',max($sets),$vsi_sfery,$data['quantity_workers'],$data['koef_rob_prof_zagal'],$koef_rob_prof_zagal);

// $ddd=$db->getAll("SELECT * FROM `positions_prof` WHERE `type_of_position`='worker' ");
// foreach($ddd as $a){

//     foreach ($modelc->coef_workers  as $sfera_d => $c):
// 				if (strstr($a['type_of_work'], $sfera_d))

// 					{var_dump($a);
// 					$db->query("UPDATE `positions_prof` SET `koef_up`='$c' WHERE `id`=?s ",$a['id']);
// 					}
// 				endforeach;

// }
// $db->query("UPDATE `positions_prof` SET `koef_up`='1' WHERE `name_of_position`like '%Водій%' OR `name_of_position`like '%Машиніст%' or `name_of_position`like '%Тракторист%'");
?>

<div style="display:inline-block;"> <span class="name" >

	Прожитковий мінімум, що врахований в розрахунку 	</span>
	<span class="info"><!--a href="#" class="mini_modal_link info" data-modal-id="#modal_gtelst" style="padding:4px;"
	-->
 <input type="text" name="min_zp" class="info" style="border:0;background: #f8f8f8;text-align:right;" size="1" value="<?=$min_zp?>"> грн.


</span>
</div>
<div class="" style="margin-top:1%;">
			   <span class="name" >Працівник основної професії:
	 </span>	<span class="info" style="padding:4px;"> <?=$proff_prof?>
</span></div>

</section>
	<section class="section_edit">
<style type="text/css">
/*.table table{    width: 100%;    border-collapse: collapse;}*/
/*.tabledb table tr th{    min-width: 80px; }*/

 table .allall > td {
  background:rgba(205, 16, 0, 1);color:#fff;}
  </style>
  <style>
    /*.popup_calcult {
      overflow-y: scroll;
      display: block;
      min-height: 24em;
      max-height: 32em;
      float:left;width:100%;color:white;background:#aaaaaa;border-color:#FFFAFA;
      border-collapse:collapse;border-bottom-style: solid;border-width: 1px;
    }
   table.popup_workers tr td select[name=rozdil_day_select] {
    width: 75px;
}*/
   table .popup_calcult tr th{    min-width: 100px;    padding: 3px 7px;    color: #fff;    font: 15px/22px Ubuntu;    border-right: 1px solid #fff;
    border-left: 1px solid #fff;border-top: 1px solid #fff;    background: #0051a3;}table.popup_calcult tr th:first-child{    border-left: none;}
    table.popup_calcult tr th:last-child{    border-right: none;}/*.table table tr th.small.table table tr td.small{    width: 60px;    min-width: 60px;
    table-layout: fixed;}.table table tr th.big{    width: 230px;    table-layout: fixed;}*/
    table .popup_calcult tr td{    padding: 5px 17px;
    color: #202020;    font: 300 16px Ubuntu;    border: 1px solid #d3d3d3;    text-align: left;}table.popup_calcult tr:first-child td{    border-top: none;}
    table .popup_calcult tr td input{    padding: 0px 0px;
    color: #202020;    font: 300 16px Ubuntu;    border: 1px solid #d3d3d3;    text-align: left;}
    table .popup_calcult tr td select{    padding: 0px 0px;
    color: #202020;    font: 300 16px Ubuntu;    border: 1px solid #d3d3d3;    text-align: left;}
    th a:hover {text-decoration: underline;}
</style>

<div class="tabledb" style="margin-top:25px;">
				<table >
					<thead>
						<tr>
							<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
		<th>Професія  </th>
		<th>Код професії</th>
		<th>Категорія/група</th>
		<th>Коеф. І розряду </th>
		<th>Коеф. за посадою</th>
		<th>Коеф.робіт та проф.</th>
		<th>Терит.коеф.</th>
		<th>Штатна чисельність</th>
		<th>Оклад</th>
		<th>Доплата до рівня мін. з/п (грн.)</th>
		<th>Додаткова (грн)</th>
		<th><a href="/<?=$calcul?>/inputdataCA/?<?=$arr["query"]?>&min_zp=<?=$min_zp?>" style="color:#f00;" style="text-decoration:underline;"  target="_blank">Допл. та надб.(%)</a></th>
		<th>Премії(%)</th>
		<th>Заробітна плата (грн.)</th>
		<tbody>


	<?
// 	$all_oklad=0;$all_fop=0;$dodatkova_sum=0;$all_doplata=0;
//     $oklad = 0; $dodatkova=0; $all_dodatkova=0; $zarplata=0;$all_zarplata=0;
//     $oklad2=0; $dodatkova2=0; $all_dodatkova2=0; $zarplata2=0;$all_zarplata2=0;

// 	$oklad_off=0; $dodatkova_off=0; $all_dodatkova_off=0; $zarplata_off=0;$all_zarplata_off=0;
//     $teplo = 0; $vodo = 0; $inshe = 0; $tvp = 0; $nevidm = 0; $jitlo = 0;
//     $teplo_fop=0;$vodo_fop = 0; $inshe_fop = 0; $tvp_fop = 0; $nevidm_fop = 0; $jitlo_fop = 0;
//     $teplo_fop_rob=0;$vodo_fop_rob = 0;  $tvp_fop_rob = 0; $nevidm_fop_rob = 0; $jitlo_fop_rob = 0;
//     $teplo_fop_rob_off=0;$vodo_fop_rob_off = 0;  $tvp_fop_rob_off = 0; $nevidm_fop_rob_off = 0; $jitlo_fop_rob_off = 0;
//       $chiselnist=0;$inshe_fop_rob = 0;$inshi_fop=0;$inshi=0;$inshi_fop_rob_off =0;$trans_fop_rob_off =0;$trans_fop_rob = 0;$trans_fop=0;
//      $teplo_chiseln=0;$vodo_chiseln = 0; $tvp_chiseln = 0; $jitlo_chiseln = 0;$nevidm_off=0;$trans_chiseln = 0;
// $teplo_itog=0;$vodo_itog=0;$tvp_itog=0;$jitlo_itog=0;$inshi_itog=0;$trans_itog=0;  $lift_itog=0;
// $lift_fop=0;$lift_fop_rob_off=0; $lift_fop_rob=0;$lift_chiseln = 0;$vodovidvod_fop =0; $vodovidvod_chiseln =0;
//                         $RPV_fop =0; $RPV_chiseln=0;
// $blago_fop_rob = $blago_fop = $blago_fop_rob_off = $blago_chiseln =0;
// $fop_rob_off42=$fop_rob42=$fop42=$chiseln42=0;$fop_rob_off43=$fop_rob43=$fop43=$chiseln43=0;$fop_rob_off44=$fop_rob44=$fop44=$chiseln44=0;
// $fop_rob_off21=$fop_rob21=$fop21=$chiseln21=0;
//       $koef_posada_d =0;
$quantity_workers=0;$quantity_heads=0;$off_season = 0;

//	var_dump($data['group']);
	$sumlinno=$data['name']['sumlinnyj'];
//////////////////////////////////////////diln
	if($_GET['diln']=='empty' || $_GET['diln']>0)$data['all_d']=$data['all_d_diln'];
	/////////////////////////////////////////////
	$flag_diln='0';$flag_group='';
	$q_heads = $data['quantity_heads'];
	foreach($data['all_d'] as $d):

	if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1 && $flag_diln!==$d['dilnica']){


      if($d['dilnica']=='') {$fordiln_name='Головне підприємство';}
  else $fordiln_name='Відокремлений підрозділ '.$d['dilnica'];

  ?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}
	$groupgroup_name=$data['group_heads_popup'][$d['type']];
$group['group_name']=$groupgroup_name;
	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
/*		//////////////////////////////////diln
//if(($data['diln']) )://var_dump($data['diln']);
foreach($data['diln_h'] as $fordiln):
    if($_GET['diln']>0 && str_replace("№ ", "", $fordiln['dilnica'])!==$_GET['diln'])continue;
  if($_GET['diln']=='empty' && $fordiln['dilnica']!=='')continue;

  if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1)
  {
      if($fordiln['dilnica']=='') $fordiln_name='Головне підприємство';
  else $fordiln_name='Відокремлений підрозділ '.$fordiln['dilnica'];

  ?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}		foreach($data['group'] as $group):

$group_name = $group['group_name'];
	$type = $group['group_type'];
	$id = $data['id'];
	//$select = $this->model->selectforcicle($type, $id);
	 $select = $this->model->selectforcicleSfera($type, $id,$_GET['sfera'],$_GET['id_tarif'],'calculation');

	$c_diln=0;
        foreach($select as $d):
            if($d['dilnica']==$fordiln['dilnica'])$c_diln++;
            endforeach;
            if($c_diln==0)continue;

?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;"><?=$group['group_name']?></td></tr>
	<?


//	var_dump($type, $id,$_GET['sfera'],$_GET['id_tarif'],'fff',$select);
	foreach($select as $d):
	//if ($d['type']==$group['group_type']) {
	$q_heads = $data['quantity_heads'];

	if($d['dilnica']!==$fordiln['dilnica'])continue;
	*/?>

    <tr style="text-align:left;background:#fff;">

			<td style="text-align:left;vertical-align: middle;width:50px;white-space:nowrap;">

			<?
/*if($d['dilnica']!==''){ $d['dilnica']=str_replace("№ ", "", $d['dilnica']);
?><span   style="font-size:110%;padding-right:0px;">&nbsp;<?=$d['dilnica']?> </span><?}*/
					//if($d['dilnica']==''){
if($d['postachannia']!=='' && $d['postachannia'] !== '0'){
					if($d['postachannia']=='teplo' || $d['postachannia']=='Теплопостачання. Централізоване опалення' || $d['postachannia']=='Теплопостачання'){?><i  class='icon-adjust'  title="Сфера діяльності Теплопостачання. Централізоване опалення" style="color:rgba(178, 34, 34,  0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Виробництво теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Виробництво теплової енергії" style="color:rgba(178, 34, 34,  0.6);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Транспортування теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Транспортування теплової енергії" style="color:rgba(178, 34, 34,  0.7);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Постачання теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Постачання теплової енергії" style="color:rgba(178, 34, 34,  0.8);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Обслуговування сміттєзвалища'){?><i   class='icon-adjust' title="Сфера діяльності Обслуговування сміттєзвалища" style="color:rgba(172, 61, 139, 0.7 );padding-right:1px;">&nbsp;  </i><?}

					elseif($d['postachannia']=='vodo' || $d['postachannia']=='Водопостачання'){?><i  class='icon-adjust'  title="Сфера діяльності Водопостачання" style="color:rgba(0, 0, 255, 0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='jitlo' || strstr($d['postachannia'],'Управління та утримання')){?><i  class='icon-adjust'  title="Сфера діяльності Утримання житла" style="color:rgba(0, 100, 0, 0.5);padding-right:1px;">&nbsp; </i><?}
					elseif($d['postachannia']=='tvp' || $d['postachannia']=='Вивезення та переробка побутових відходів'){?><i class='icon-adjust'   title="Сфера діяльності Переробка
побутових відходів" style="color:rgba(0, 0, 0, 0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='grom_trans' || $d['postachannia']=='Громадський транспорт'){?><i  class='icon-adjust'  title="Сфера діяльності Громадський транспорт" style="color:rgba(255, 222, 173, 0.9);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='elevator' || $d['postachannia']=='Обслуговування ліфтів'){?><i   class='icon-adjust' title="Сфера діяльності Обслуговування ліфтів" style="color:rgba(72, 61, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='vodovidvod' || $d['postachannia']=='Водовідведення'){?><i   class='icon-adjust' title="Сфера діяльності Водовідведення" style="color:rgba(172, 61, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='RPV' || $d['postachannia']=='Вивіз рідких побутових відходів'){?><i   class='icon-adjust' title="Сфера діяльності Вивіз РПВ" style="color:rgba(72, 161, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
elseif($d['postachannia']=='Благоустрій'){?><i  class='icon-adjust'  title="Сфера діяльності Благоустрій" style="color:rgba(255, 215, 0, 1);padding-right:1px;">&nbsp;  </i><?}
					else {?><i  class='icon-adjust' title="Сфера діяльності <?=$d['postachannia']?>" style="color:rgba(105, 105, 105, 0.5 );padding-right:1px;">&nbsp; </i><?}

					}
					$flag_kontrakt='';
	///////////$osnovna_zp_kontrakt
	$osnovna_zp_kontrakt= $data['name']['osnovna_zp_kontrakt'];$dodatkova_zp_kontrakt= $data['name']['dodatkova_zp_kontrakt'];
$flag_kontrakt='';
if($osnovna_zp_kontrakt>0 && $d['dilnica']=='' && $d['type']=='director' && $data['sets_array'][12]!==''){
    // $koef_posada_teor=$modelc->director($_GET['id']);
    // var_dump($osnovna_zp_kontrakt,$dodatkova_zp_kontrakt,$data['sets_array'][12]);
    // $koef_posada=round($d['koef_posada'.$c_57.''],2);
    // if($koef_posada>$koef_posada_teor)
    $flag_kontrakt='<span style="color:#f00;">k</span>';
    //  var_dump($flag_kontrakt,$osnovna_zp_kontrakt,$dodatkova_zp_kontrakt);
}///
?></td>
			<td style="text-align:left;"><?=$d['positiosheads']?>
			<?=$flag_kontrakt?></td>

			<?$position_name = $d['positiosheads'];
		?>

				<td><?=$d['kod']?></td>
				<?
				// $kod_proff = $proffecy['kod_proffecy'];
				$category_flag=1;
				// var_dump($d['positiosheads'],$d['koef_posada'.$c_57.'']);
				if($tab['sfera_22']!==''){$category_flag=0;
	if($d['positiosheads']=='Архітектор'||$d['positiosheads']=='Інженер з проектно-кошторисної роботи'|| $d['positiosheads']=='Інженер-проектувальник (цивільне будівництво)'){
				    $category_flag=1;
				}
				}
				// if($d['type']=='director')$d['koef_posada'.$c_57.'']=round($d['koef_posada'.$c_57.''],4); else
				$d['koef_posada'.$c_57.'']=round($d['koef_posada'.$c_57.''],2);
				?>
			<td><?if($category_flag==1)echo $d['category'];?></td>



		<td ><?=$d['koef_I_rozr'.$c_57.'']?></td><!-- Коеф первого разряда-->
		<td ><?=$d['koef_posada'.$c_57.'']?></td><!-- Коеф. за посадою -->
		<td><?=round($d['koef_rob_prof'.$c_57.''],2)?></td>
		<td><?=$d['regional_koef'.$c_57.'']?></td>
		<td><?=$d['shtat_kilkist']?></td>


		<?
		$shtat_count = $d['shtat_kilkist'];
		/*if($_GET['sfera']==0)
$db->query("UPDATE `calculation_garrantiesHeads` SET `oklad`='$oklad_only',`dodatkova`='$dodatkova', `fop`='$zarplata' WHERE `id`=?s ",$d['id']);

		*/
		if($d['percent_inputA'.$c57.'']==0) {
			$d['percent_inputA'.$c57.''] = '';
		}
			if($d['doplata'.$c57.'']==0) {
			$d['doplata'.$c57.''] = '';
		}
			if($d['dodatkova'.$c57.'']==0) {
			$d['dodatkova'.$c57.''] = '';
		}
		if($d['zaohoch_percentA'.$c57.'']==0) {
			$d['zaohoch_percentA'.$c57.''] = '';
		}

	$quantity_heads+= $d['shtat_kilkist'];	?>
				<td ><?=$d['oklad'.$c57.'']?></td>
				<td><?=$d['doplata'.$c57.'']?></td>
		<td><?=$d['dodatkova'.$c57.'']?></td>
		<?
		if( $d['dodatkova'.$c57.'']>0 ||  $d['vacancia']==1 || $d['shtat_kilkist']==0)
		{
		    include 'garantiiA_doplaty.php';
if($d['percent_inputA'.$c57.'']==''&& ($Ev>0 || $Night>0))$d['percent_inputA'.$c57.'']='_';}
?>

<!--Доплати та Нaдбавки За інтенсивність праці 	Вечірні та нічні 	Ненорм. роб.день 	Шкідливість 	Сумлінний роботодавець-->
		<td><div class="doplataH" >
<a href="#modalWindow_positionsHeadsEdit<?=$d['id']?>" title="Доплати та Нaдбавки"> <?=$d['percent_inputA'.$c57.'']?> </a>
</div>

<a href="#modal" class="overlay" id="modalWindow_positionsHeadsEdit<?=$d['id']?>"></a>
<div class="popup_doplata " >

<div style="margin:0;height:300px;width:100%;">&nbsp;&nbsp;&nbsp; <b>Доплати та Нaдбавки (<?=$d['positiosheads']?>)</b><br/>
   <table  class="popup_calcult"  style="float:left;width:95%;border-collapse:collapse;border-bottom-style: solid;border-width: 1px;">
<tbody style="background:#bbbbbb;">
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за інтенсивність праці (%)
 </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$intensyvnist?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за суміщення  (грн.)      </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$sumisnyk?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Вечірні доплати (грн.)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$Ev?> </td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Нічні доплати (грн.)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$Night?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за шкідливі умови праці (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$shkidlyvo?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за святкові та вихідні дні (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$d['weekend']?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Надбавка за виконання особливо важливої роботи (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$especially_important?>
</td>
    </tr>

<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за державні нагороди (%)        </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$state_awards?></td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за почесні звання (%)      </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$honorary_title?></td>
    </tr>

<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за високі досягнення у праці (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$dosiagnennia?>
 </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за знання іноземної мови (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$foreign?></td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за науковий ступінь (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$science_degree?></td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за звання Сумлінний роботодавець (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$sumlinniy?> </td>
    </tr></tbody>
</table><?
?>
</div></div>
</td><td><?=$d['zaohoch_percentA'.$c57.'']?></td>


		<td><?if($d['vacancia']==1){
				echo 'Вакансія';}else{echo $d['fop'.$c57.''];}?></td>

		</tr>
	<?

	//}
	endforeach;
// 		endforeach;
// endforeach;//endif;
// 	var_dump($data['sets_array'][10]);
	if($_GET['diln']>0){
	    $diln_zp=$data['sets_array'][10];
	   $data['sets_array'][1]= $diln_zp['№ '.$_GET['diln']]['all_oklad'];
	   $data['sets_array'][2]= $diln_zp['№ '.$_GET['diln']]['all_doplata'];
	   $data['sets_array'][3]= $diln_zp['№ '.$_GET['diln']]['all_dodatkova'];
	   $data['sets_array'][4]= $diln_zp['№ '.$_GET['diln']]['all_zarplata'];
	 }
	 if($_GET['diln']=='empty'){
	    $diln_zp=$data['sets_array'][10];
	   $data['sets_array'][1]= $diln_zp['']['all_oklad'];
	   $data['sets_array'][2]= $diln_zp['']['all_doplata'];
	   $data['sets_array'][3]= $diln_zp['']['all_dodatkova'];
	   $data['sets_array'][4]= $diln_zp['']['all_zarplata'];
	  }
	?>


    <tr class="allall" style="">
	<td style="color:#fff;"></td>
		<td style="color:#fff;">ВСЬОГО </td>
		<td  style="color:#fff;" colspan="6" rowspan="1"></td>
		<td style="color:#fff;"><b><?=round($quantity_heads, 2)?></b></td>
		<!--$all_oklad-->
		<td style="color:#fff;"><b>  <?=round($data['sets_array'][1],2)?>    </b></td>
		<!--$all_doplata-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][2],2)?></b></td>
		<!--$all_dodatkova-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][3],2)?></b></td>
		<td style="color:#fff;"><b></b></td><td style="color:#fff;"><b></b></td>
		<!--$all_zarplata-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][4],2)?></b></td>
    </tr>
<tr style="background:rgba(185, 211, 238 ,0.6);color:black;text-align:left;">
	<td colspan="15">
	</td>
	<!--









-->
</tr>
    <tr style="background:rgba(124, 205, 124, 0.4);color:#8B3A3A;font-size:83%;">
	<th><a  id="workers"></a> </th>
		<th>Професія  </th>
		<th>Код професії</th>
		<th>Розряд</th>
		<th>коеф. І розряду</th>
		<th>Коеф. за розрядом</th>
		<th>Коеф.робіт та проф.</th>
		<th>Терит.коеф.</th>
		<th>Штатна чисельність</th>
		<th>Оклад</th><th>Доплата до рівня мін. з/п (грн.)</th>
		<th>Додаткова (грн)</th>
		<th><a href="/<?=$calcul?>/inputdataCA/?<?=$arr["query"]?>&min_zp=<?=$min_zp?>"  style="color:#f00;" style="text-decoration:underline;" target="_blank">Допл. та надб.(%)</a></th>
		<th>Премії(%)</th>
		<th>Заробітна плата (грн.)</th>
    </tr>


	<?
// 	$all_oklad2 = 0;$inshi_fop_rob=0;$all_doplata2=0;
// 	$off_season = $asezon=$zarplata_asezon=$all_zarplata_asezon= 0;
// 	$teplo_postachannia_off = 0;$vodo_postachannia_off = 0;$tvp_postachannia_off = 0;$jitlo_postachannia_off = 0;
// 	$teplo_postachannia = 0;$vodo_postachannia = 0;$tvp_postachannia = 0;$jitlo_postachannia = 0;
// 	$RPV_postachannia = 0;$vodovidvod_postachannia = 0;
// 	$vodovidvod_fop_rob =0; $vodovidvod_fop_rob_off =0;$RPV_fop_rob =0; $RPV_fop_rob_off =0;

		//////////////////////////////////////////diln
	if($_GET['diln']=='empty' || $_GET['diln']>0)$data['all_w']=$data['all_w_diln'];
	/////////////////////////////////////////////
	$flag_diln='0';$flag_group='';
	$q_workers = $data['quantity_workers'];
	foreach($data['all_w'] as $d):
	if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1 && $flag_diln!==$d['dilnica']){


      if($d['dilnica']=='') {$fordiln_name='Головне підприємство';}
  else $fordiln_name='Відокремлений підрозділ '.$d['dilnica'];

  ?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}
	$groupgroup_name=$d['type'];
	$group['group_name']=$groupgroup_name;
	if($d['type']=='Невиробничі види робіт і послуг (управління та утримання житлових будинків, санітарне утримання об`єктів та територій, зелене будівництво та садово-паркове господарство, технічна інвентаризація об`єктів нерухомості; відлов та догляд за безпритульними тваринами; обслуговування готелів та гуртожитків; побутові та індивідуальні послуги; оптова та роздрібна торгівля; громадське харчування; друкарська діяльність; послуги поштового та електрозв`язку; адміністративні та інформаційно-диспетчерські послуги; охоронна діяльність)') $groupgroup_name='Невиробничі види робіт і послуг';
if($d['type']=='Ремонт, налагодження, обслуговування устаткування, контрольно-вимірювальних приладів, автоматики, електронно-обчислювальної техніки, машин, механізмів, службових та виробничих приміщень, будівель та споруд, багатоквартирних будинків') $groupgroup_name='Ремонт, налагодження, обслуговування устаткування, приладів, автоматики, техніки, машин, механізмів, приміщень, будівель та споруд, багатоквартирних будинків';

	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
	/*	//////////////////////////////////////////diln
// 		if(($data['diln']) ):
foreach($data['diln_w'] as $fordiln):
  if($_GET['diln']>0 && str_replace("№ ", "", $fordiln['dilnica'])!==$_GET['diln'])continue;
  if($_GET['diln']=='empty' && $fordiln['dilnica']!=='')continue;

  if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1){
      if($fordiln['dilnica']=='') $fordiln_name='Головне підприємство';
  else $fordiln_name='Відокремлений підрозділ '.$fordiln['dilnica'];

  ?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}

	foreach($data['group_workers'] as $group):
     // var_dump($data['group_workers']);


 $count=0;$c_diln=0;
        foreach($data['all_w'] as $d)://var_dump($d['type'],$group['group_name']);
		if ($d['type']==$group['group_name'])
		{$count++;

               if($d['dilnica']==$fordiln['dilnica'])$c_diln++;

		} endforeach; if($count==0 || ($c_diln==0)) continue;

 $groupgroup_name=$group['group_name'];
 if($group['group_name']=='Невиробничі види робіт і послуг (управління та утримання житлових будинків, санітарне утримання об`єктів та територій, зелене будівництво та садово-паркове господарство, технічна інвентаризація об`єктів нерухомості; відлов та догляд за безпритульними тваринами; обслуговування готелів та гуртожитків; побутові та індивідуальні послуги; оптова та роздрібна торгівля; громадське харчування; друкарська діяльність; послуги поштового та електрозв`язку; адміністративні та інформаційно-диспетчерські послуги; охоронна діяльність)') $groupgroup_name='Невиробничі види робіт і послуг';
if($group['group_name']=='Ремонт, налагодження, обслуговування устаткування, контрольно-вимірювальних приладів, автоматики, електронно-обчислювальної техніки, машин, механізмів, службових та виробничих приміщень, будівель та споруд, багатоквартирних будинків') $groupgroup_name='Ремонт, налагодження, обслуговування устаткування, приладів, автоматики, техніки, машин, механізмів, приміщень, будівель та споруд, багатоквартирних будинків';
?>

			<tr >
			<td colspan="15" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td>
		</tr><tbody class="parents-doplata">
		<?
		foreach($data['all_w'] as $d):

	//	$q_workers = $data['quantity_workers'];

		if ($d['type']==$group['group_name'])
		{

			if($d['dilnica']!==$fordiln['dilnica'])continue;*/?>
			<tr style="text-align:left;background:#fff;">
				<td style="text-align:left;vertical-align: middle;white-space:nowrap;">



					<!-- Для введения записи -->
					<?
			/*	if($d['dilnica']!==''){ $d['dilnica']=str_replace("№ ", "", $d['dilnica']);
?><span   style="font-size:110%;padding-right:0px;">&nbsp;<?=$d['dilnica']?> </span><?}*/
	//if($d['dilnica']==''){
					if($d['postachannia']!=='' && $d['postachannia'] !== '0'){
					if($d['postachannia']=='teplo' || $d['postachannia']=='Теплопостачання. Централізоване опалення' || $d['postachannia']=='Теплопостачання'){?>
					<i  class='icon-adjust'  title="Сфера діяльності Теплопостачання. Централізоване опалення" style="color:rgba(178, 34, 34,  0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Виробництво теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Виробництво теплової енергії" style="color:rgba(178, 34, 34,  0.6);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Транспортування теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Транспортування теплової енергії" style="color:rgba(178, 34, 34,  0.7);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Постачання теплової енергії'){?><i  class='icon-adjust'  title="Сфера діяльності Постачання теплової енергії" style="color:rgba(178, 34, 34,  0.8);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='Обслуговування сміттєзвалища'){?><i   class='icon-adjust' title="Сфера діяльності Обслуговування сміттєзвалища" style="color:rgba(172, 61, 139, 0.7 );padding-right:1px;">&nbsp;  </i><?}

					elseif($d['postachannia']=='vodo' || $d['postachannia']=='Водопостачання'){?><i  class='icon-adjust'  title="Сфера діяльності Водопостачання" style="color:rgba(0, 0, 255, 0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='jitlo' || strstr($d['postachannia'],'Управління та утримання')) {?><i  class='icon-adjust'  title="Сфера діяльності Утримання житла" style="color:rgba(0, 100, 0, 0.5);padding-right:1px;">&nbsp; </i><?}
					elseif($d['postachannia']=='tvp' || $d['postachannia']=='Вивезення та переробка побутових відходів'){?><i class='icon-adjust'   title="Сфера діяльності Переробка
побутових відходів" style="color:rgba(0, 0, 0, 0.5);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='grom_trans' || $d['postachannia']=='Громадський транспорт'){?><i  class='icon-adjust'  title="Сфера діяльності Громадський транспорт" style="color:rgba(255, 222, 173, 0.9);padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='elevator' || $d['postachannia']=='Обслуговування ліфтів'){?><i   class='icon-adjust' title="Сфера діяльності Обслуговування ліфтів" style="color:rgba(72, 61, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='vodovidvod' || $d['postachannia']=='Водовідведення'){?><i   class='icon-adjust' title="Сфера діяльності Водовідведення" style="color:rgba(172, 61, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
					elseif($d['postachannia']=='RPV' || $d['postachannia']=='Вивіз рідких побутових відходів'){?><i   class='icon-adjust' title="Сфера діяльності Вивіз РПВ" style="color:rgba(72, 161, 139, 0.5 );padding-right:1px;">&nbsp;  </i><?}
elseif($d['postachannia']=='Благоустрій'){?><i  class='icon-adjust'  title="Сфера діяльності Благоустрій" style="color:rgba(255, 215, 0, 1);padding-right:1px;">&nbsp;  </i><?}
					else {?><i  class='icon-adjust' title="Сфера діяльності <?=$d['postachannia']?>" style="color:rgba(105, 105, 105, 0.5 );padding-right:1px;">&nbsp; </i><?}

					}
//}//с пустой дильницей
	if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']!=0){?><i  class='icon-cog' title="Сезонна професія" style="color:rgba(255, 69, 0, 0.7) ;padding-left:1px;"> </i><?}

	$quantity_workers+= $d['shtat_kilkist'];$off_season += $d['off_season'];

if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0){
    $quantity_workers+= $d['off_season'];
    ?><i  class='icon-cog' title="Acезонна професія" style="color:rgba(25, 69, 0, 0.7) ;padding-left:1px;"> </i><?}

				// if($d['shtat_kilkist']>'0')

				?>
</td>


					<td style="text-align:left;"><?=$d['positiosworkers']?>

				<?
				// var_dump($proffecy);
				?>
				</td>
				<?/*if($data['calcul']=='calcul')
				{$I_rozr=1.3;
			 include 'garantiiA_Worker57.php';}
			 else {$I_rozr=1.2;include 'garantiiA_Worker.php';}*/?>

				<td><?=$d['kod']?></td>
				<td><?=$d['rozryad'] ?></td>
				<td ><?=$d['koef_I_rozr'.$c_57.'']?></td><!-- Коеф первого разряда-->


				<td ><?=round($d['koef_posada'.$c_57.''],2)?></td><!-- Коеф. за посадою -->

				<td><?=round($d['koef_rob_prof'.$c_57.''],2)?></td>

				<td><?=$d['regional_koef'.$c_57.'']?></td>



				<td><?if($d['shtat_kilkist']>'0') echo $d['shtat_kilkist'];

else{echo $d['off_season'];}?></td>

				<?/*if($_GET['sfera']==0)
				    $db->query("UPDATE `calculation_garrantiesWorkers` SET `oklad`='$oklad2only',`dodatkova`='$dodatkova2', `fop`='$zarplata2', `zarplata_off`='$zarplata_off' WHERE `id`=?s ",$d['id']);
			*/	?>
			<?//$d['zaohoch_percent']=10;//premia
				if($d['percent_inputA'.$c57.'']==0) {
			$d['percent_inputA'.$c57.''] = '';
		}
			if($d['doplata'.$c57.'']==0) {
			$d['doplata'.$c57.''] = '';
		}
			if($d['dodatkova'.$c57.'']==0) {
			$d['dodatkova'.$c57.''] = '';
		}
		if($d['zaohoch_percentA'.$c57.'']==0) {
			$d['zaohoch_percentA'.$c57.''] = '';
		}
				?>

				<td ><?=($d['oklad'.$c57.''])?></td>
				<td><?=($d['doplata'.$c57.''])?></td>
				<!-- Оклад/100*30 percent_input     ВЫВОД ДОДАТКОВЙ ЗАРПЛАТЫ И ПРОЦЕНТОВ -->


				<td><?=$d['dodatkova'.$c57.'']
				// if($d['shtat_kilkist']!='0') echo $dodatkova2;
// if($d['shtat_kilkist']=='0') echo $dodatkova2off;

?> </td>

 <?//$d['EvNight']>0 ||$d['Night']>0 ||
 if( $d['dodatkova'.$c57.'']>0 ||  $d['vacancia']==1 || $d['shtat_kilkist']==0) {
     include 'garantiiA_doplaty.php';
if($d['percent_inputA'.$c57.'']==''&& ($Ev>0 || $Night>0))$d['percent_inputA'.$c57.'']='_';}
?>

<!--Доплати та Нaдбавки За інтенсивність праці 	Вечірні та нічні 	Ненорм. роб.день 	Шкідливість 	Сумлінний роботодавець-->
		<td>

<div class="doplataW" >
<a href="#modalWindow_positionsWorkersEdit<?=$d['id']?>" title="Доплати та Нaдбавки"> <?=$d['percent_inputA'.$c57.'']?> </a>
</div>

<a href="#modal" class="overlay" id="modalWindow_positionsWorkersEdit<?=$d['id']?>"></a>
<div class="popup_doplata " >

<div style="margin:0;height:300px;width:100%;">&nbsp;&nbsp;&nbsp; <b>Доплати та Нaдбавки (<?=$d['positiosworkers']?>)</b><br/>
   <table  class="popup_calcult"  style="float:left;width:95%;border-collapse:collapse;border-bottom-style: solid;border-width: 1px;">

<tbody style="background:#bbbbbb;">
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за інтенсивність праці (%)
 </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$intensyvnist?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за суміщення (грн.)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$sumisnyk?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Вечірні доплати (грн.)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$Ev?> </td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Нічні доплати (грн.)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$Night?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за шкідливі умови праці (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$shkidlyvo?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за святкові та вихідні дні (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$d['weekend']?> </td>
    </tr>
<?if(strstr($d['positiosworkers'],'Водій') ){?>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Доплата за ненормований робочий день (водіям, %)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$no_norm?></td></tr><?}?>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за робочий день з розділенням зміни на дві частини (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$rozdil?>
</td>
    </tr>
  <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за керівництво бригадою (%)       </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$brigada?>
 </td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата на період освоєння нових норм трудових затрат (%)    </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$development_norms?>
 </td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;    &nbsp;Доплата за керівництво практикою (%)        </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$practice_guide?>
 </td>
    </tr>

<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за високу професійну майстерність (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$masterstvo?></td>
    </tr>
<?if(strstr($d['positiosworkers'],'Водій') ){?>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за класність (водіям, %)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$klass?></td>
    </tr><?}?>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за високі досягнення у праці (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$dosiagnennia?>
 </td>
    </tr>
    <tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за виконання особливо важливої роботи (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$especially_important?> </td>
    </tr>
<tr><td   style="padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;  &nbsp;Надбавка за знання іноземної мови (%)         </td>
<td style="width:30%;  padding-left:5px;border-color:#FFFAFA;" >
 &nbsp;&nbsp;<?=$foreign?></td>
    </tr>
</tbody>
</table><?
?>
</div></div></td>

<td><?=$d['zaohoch_percentA'.$c57.'']?></td>
				<?/*if($zarplata2==0){$zarplata2='Вакансія';}*/?>
				<td><?if($d['vacancia']==1){
				echo 'Вакансія';}/*elseif($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0) {echo $zarplata_off;}*/
else{echo $d['fop'.$c57.''];}?><??></td>

			</tr>

				<?//}endforeach;	endforeach;
endforeach;	//endif;
// var_dump($data['quantity_workers'],$data['quantity_heads'],$data['off_season']);
	if($_GET['diln']>0){
	    $diln_zp=$data['sets_array'][10];
	   $data['sets_array'][5]= $diln_zp['№ '.$_GET['diln']]['all_oklad2'];
	   $data['sets_array'][6]= $diln_zp['№ '.$_GET['diln']]['all_doplata2'];
	   $data['sets_array'][7]= $diln_zp['№ '.$_GET['diln']]['all_dodatkova2'];
	   $data['sets_array'][8]= $diln_zp['№ '.$_GET['diln']]['all_zarplata2'];
	   $data['sets_array'][9]= $diln_zp['№ '.$_GET['diln']]['all_zarplata_off'];
	 }

	  if($_GET['diln']=='empty'){
	    $diln_zp=$data['sets_array'][10];
	   $data['sets_array'][5]= $diln_zp['']['all_oklad2'];
	   $data['sets_array'][6]= $diln_zp['']['all_doplata2'];
	   $data['sets_array'][7]= $diln_zp['']['all_dodatkova2'];
	   $data['sets_array'][8]= $diln_zp['']['all_zarplata2'];
	   $data['sets_array'][9]= $diln_zp['']['all_zarplata_off'];
	 }
	 ?>
	</tbody>
    <tr  class="allall">
	<td style="color:#fff;"></td>
		<td style="color:#fff;">ВСЬОГО </td>

		<td style="color:#fff;"></td>

		<td style="color:#fff;"></td>

		<td style="color:#fff;"></td><td style="color:#fff;"></td>

		<td style="color:#fff;"></td>

		<td style="color:#fff;"></td>

		<td style="color:#fff;"><b><?=$quantity_workers?></b></td>

		<!-----$all_oklad2----->
		<td style="color:#fff;">   <b><?=round($data['sets_array'][5],2)?></b>     </td>
		<!--$all_doplata2-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][6],2)?></b></td>
		<!--$all_dodatkova2-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][7],2)?></b></td>

		<td style="color:#fff;">  </td><td style="color:#fff;"></td>
		<!--$all_zarplata2-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][8],2)?></b></td>

    </tr><!------------------------->

    <tr class="allall">
		<td colspan="8" rowspan="1"style="color:#fff;text-align:left;"><b>Всього по підприємству:</b></td>
		<?$itog = round($data['sets_array'][4]+$data['sets_array'][8],2);//$all_zarplata+$all_zarplata2

	$all_oklad=$data['sets_array'][1];$all_oklad2=$data['sets_array'][5];
	$all_doplata=$data['sets_array'][2];$all_doplata2=$data['sets_array'][6];
	$all_dodatkova=$data['sets_array'][3];$all_dodatkova2=$data['sets_array'][7];
	$all_zarplata=$data['sets_array'][4];$all_zarplata2=$data['sets_array'][8];
	$all_zarplata_off=	$data['sets_array'][9];
$itog_chiseln = $quantity_workers+$quantity_heads;




		?>

		<td style="color:#fff;"><b><?=$quantity_workers+$quantity_heads?></b></td>
		<!--$all_oklad2+$all_oklad-->
		<td style="color:#fff;"> <b><?=round($data['sets_array'][1]+$data['sets_array'][5],2)?></b> </td>
		<!--$all_doplata+$all_doplata2-->
		<td style="color:#fff;" style="color:#fff;"><b><?=round($data['sets_array'][2]+$data['sets_array'][6],2)?></b></td>
		<!--$all_dodatkova2+$all_dodatkova-->
		<td style="color:#fff;"><b><?=round($data['sets_array'][3]+$data['sets_array'][7],2)?></b></td>

		<td style="color:#fff;"></td><td></td>
		<!--$all_zarplata2+$all_zarplata-->
		<td style="color:#fff;"><b><?=round($itog,2)?></b></td>

    </tr>
    <?
    ?><tbody>
    <tr >

		<td colspan="8" rowspan="1" style="text-align:left;"><b>Скорочення у міжсезонний період</b></td>



		<td><b>-<?=round(abs($quantity_workers-$off_season))?></b></td>

		<!---------->
		<td colspan="5" >   <b></b>     </td>



		<td><b>-<?=round(($all_zarplata2)-$all_zarplata_off)?></b></td>

    </tr><!------------------------->
	<tr>
	<!-- (Зар.плата – Додаткова)/Зар.плата*100 -->
		<?
		$chastka_fop = ($all_zarplata+$all_zarplata2);

		$chastka_dodatkova = ($all_dodatkova2+$all_dodatkova);
		?>

		<td colspan="14" rowspan="1" style="text-align:left;">

			<b>Частка посадового окладу у складі середньої заробітної плати працівників (не нижче 70%) </b>

		</td>
		<td>

			<b><?=round(($chastka_fop-$chastka_dodatkova)/$chastka_fop*100, 2)?></b>

		</td>
	</tr>




	<?
	//$all_fop_workers = 0;
	//$dodatkova_sum_workers = 0;
	/*foreach($data['group_workers'] as $group):
		foreach($data['all_w'] as $d):
			$q_workers = $data['quantity_workers'];
		//var_dump($q_workers);
			if ($d['type']==$group['group_name'] && $d['off_season']!==0)//кількість робочих у міжсезоння
			{
					$oklad_off = $min_zp*1.2*$d['koef_posada']*$d['koef_rob_prof'];
					$dodatkova_off = $oklad_off*$d['percent_input']/100;
					$all_dodatkova_off += $dodatkova_off;
					$zarplata_off = ($oklad_off+$dodatkova_off)*$d['off_season'];
					$all_zarplata_off += $zarplata_off;

			}
		endforeach;
	endforeach;

	echo($all_zarplata_off);*/
	$all_zarplata_asezon=0;
	?>



    <tr>
        <td colspan="14" rowspan="1" style="text-align:left;">
            <b>Середньомісячний ФОП</b>
        </td>
        <?$ser_fop=0; $ser_fop=round(round($all_zarplata)+(round($all_zarplata2+$all_zarplata_asezon)*$sezon+round($all_zarplata_off)*(12-$sezon))/12);?>
        <td>
            <b><?=$ser_fop?></b>
        </td>
    </tr>
<!-------------------------------->
<tr>
        <td colspan="14" rowspan="1" style="text-align:left;">
            <b>Середньомісячна чисельність</b>
        </td>
       <?$chiselnist = round(($quantity_heads)+ ($quantity_workers*$sezon+$off_season*(12-$sezon))/12);   ?>
        <td>
            <b><?=$chiselnist?></b>
        </td>
    </tr>
<!-------------------------------->
<tr>
        <td colspan="14" rowspan="1" style="text-align:left;">
            <b>Середньомісячна заробітна плата</b>
        </td>
        <td>
            <b><?=round($ser_fop/$chiselnist)?></b>
        </td>
    </tr>
<!-------------------------------->

<?/*$postach=0;$proporcia=0;$jitlo_postachannia=0;$teplo_postachannia=0;$vodo_postachannia=0;$tvp_postachannia=0;
$prjami_vytraty=0;$vyrobn_sobivart=0;$sobivart_lift=0; $lift_postachannia=0; $lift=0; $lift_postachannia_off=0;
$postachannia_off42=$postachannia42=$postachannia_off43=$postachannia43=$postachannia_off44=$postachannia44=$postachannia_off21=$postachannia21=0;
$p42=$p43=$p44=$p21=0;

		$teplo_postachannia=round($teplo_fop+$teplo_fop_rob);$teplo_postachannia_off=round($teplo_fop+$teplo_fop_rob_off);//Середньомісячні витрати за професіями згідно виду діяльності це середні витрати з урахуванням сезонності за видом діяльності =  (Впс/12*n)
    	$vodo_postachannia=round($vodo_fop+$vodo_fop_rob);$vodo_postachannia_off=round($vodo_fop+$vodo_fop_rob_off);
    	$tvp_postachannia=round($tvp_fop+$tvp_fop_rob);$tvp_postachannia_off=round($tvp_fop+$tvp_fop_rob_off);
    	$jitlo_postachannia=round($jitlo_fop+$jitlo_fop_rob);$jitlo_postachannia_off=round($jitlo_fop+$jitlo_fop_rob_off);
    	$inshe_postachannia=round($inshi_fop+$inshi_fop_rob);$inshe_postachannia_off=round($inshi_fop+$inshi_fop_rob_off);
$trans_postachannia=round($trans_fop+$trans_fop_rob);$trans_postachannia_off=round($trans_fop+$trans_fop_rob_off);
$lift_postachannia=round($lift_fop+$lift_fop_rob);$lift_postachannia_off=round($lift_fop+$lift_fop_rob_off);
$vodovidvod_postachannia=round($vodovidvod_fop+$vodovidvod_fop_rob);$vodovidvod_postachannia_off=round($vodovidvod_fop+$vodovidvod_fop_rob_off);
$RPV_postachannia=round($RPV_fop+$RPV_fop_rob);$RPV_postachannia_off=round($RPV_fop+$RPV_fop_rob_off);
$blago_postachannia=round($blago_fop+$blago_fop_rob);$blago_postachannia_off=round($blago_fop+$blago_fop_rob_off);
 $postachannia42=round($fop42+$fop_rob42);$postachannia_off42=round($fop42+$fop_rob_off42);
 $postachannia43=round($fop43+$fop_rob43);$postachannia_off43=round($fop43+$fop_rob_off43);
 $postachannia44=round($fop44+$fop_rob44);$postachannia_off44=round($fop44+$fop_rob_off44);
 $postachannia21=round($fop21+$fop_rob21);$postachannia_off21=round($fop21+$fop_rob_off21);

    	$postach=$teplo_postachannia+$vodo_postachannia+$tvp_postachannia+$jitlo_postachannia+$trans_postachannia+$lift_postachannia+$vodovidvod_postachannia+
    	$RPV_postachannia+$blago_postachannia+$inshe_postachannia+$postachannia42+$postachannia43+$postachannia44+$postachannia21;

$proporcia=$itog-$postach;//ne razmecheny

$prjami_vytraty=$nevidm_fop_rob;//Середньомісячні розподілені загальновиробничі витрати =  (Вз/12*n)/100*d//$all_zarplata2-
$prjami_vytraty_off=$nevidm_fop_rob_off;

$teplo= round($teplo_postachannia/$postach,2);//відсоток
$vodo= round($vodo_postachannia/$postach,2);
$tvp= round($tvp_postachannia/$postach,2);
$jitlo= round($jitlo_postachannia/$postach,2);
$trans= round($trans_postachannia/$postach,2);
$lift= round($lift_postachannia/$postach,2);
$RPV=round($RPV_postachannia/$postach,2);
$vodovidvod=round($vodovidvod_postachannia/$postach,2);
$blago=round($blago_postachannia/$postach,2);
$inshe=round($inshe_postachannia/$postach,2);
$p42=$postachannia42/$postach;$p43=$postachannia43/$postach;$p44=$postachannia44/$postach;$p21=$postachannia21/$postach;


//var_dump($proporcia,$itog,$postach,$prjami_vytraty,$prjami_vytraty_off,$tvp,$jitlo,$tvp_postachannia,$jitlo_postachannia);
//$teplo=30;$tvp=70;chastka_sobivart_teplo_diyalnosti chastka_sobivart_vodo_diyalnosti chastka_sobivart_tvp_diyalnosti chastka_sobivart_jitlo_diyalnosti
$inshi_procent=0;$inshi_procent=100-$teplo-$tvp-$vodo-$jitlo-$trans-$lift-$RPV-$vodovidvod;

$vyrobn_sobivart=$nevidm_fop;//Середньомісячні розподілені адміністративні витрати =  (Ва/12*n)/100*a
$sobivart_teplo= $db->getOne ("SELECT `chastka_sobivart_teplo_diyalnosti` FROM `table_1` WHERE `id`=?s",  $_GET['id']);//відсоток
$sobivart_vodo= $db->getOne ("SELECT `chastka_sobivart_vodo_diyalnosti` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$sobivart_tvp= $db->getOne ("SELECT `chastka_sobivart_tvp_diyalnosti` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$sobivart_jitlo= $db->getOne ("SELECT `chastka_sobivart_jitlo_diyalnosti` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$sobivart_lift= $db->getOne ("SELECT `chastka_sobivart_elevator` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$sobivart_trans= $db->getOne ("SELECT `chastka_sobivart_grom_trans_diyalnosti` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$sobivart_RPV=$sfera['chastka_sobivart_RPV'];
$sobivart_vodovidvod=$sfera['chastka_sobivart_14'];

$inshi_sobivart=0;$inshi_sobivart=100-$sobivart_teplo-$sobivart_tvp-$sobivart_vodo-$sobivart_jitlo-$sobivart_trans-$sobivart_lift-$sobivart_RPV-$sobivart_vodovidvod;

$dd=0;//$roow=$data['sfera_5'];

if ( $sfera['sfera_6']!==''  || $sfera['sfera_7']!=='' || $sfera['sfera_8']!=='' || $sfera['sfera_9']!==''  || $sfera['sfera_10']!=='' ||
$sfera['sfera_12']!=='' || $sfera['sfera_13']!=='' || $sfera['sfera_15']!==''  || $sfera['sfera_16']!=='' || $sfera['sfera_17']!==''
|| $sfera['sfera_18']!==''  || $sfera['sfera_19']!=='' ||  $sfera['sfera_22']!==''||  $sfera['sfera_23']!==''
|| $sfera['sfera_24']!==''||  $sfera['sfera_25']!=='' || $sfera['sfera_26']!=='') {$dd++;}
?>
		    <!-------------------------------->

<?*/
if($_GET['sfera']==0){
    //
//
	if($_GET['diln']>0){
	    $sets_diln=$data['sets_array'][11];
 $data['sets_array'][0]= $sets_diln['№ '.$_GET['diln']];
	 }
	 if($_GET['diln']=='empty'){
	    $sets_diln=$data['sets_array'][11];
 $data['sets_array'][0]= $sets_diln[''];
	 }
// var_dump($data['sets_array'][0]);
?>
    <tr>
        <td colspan="21" rowspan="1" style="background:rgba(20,81,163, 1);color:#fff;text-align:left;">
            <b>Розподіл витрат з оплати праці за видами діяльності </b>
        </td>
    </tr><?//;}?><!-------------------------------->


    <?
    $postach=0;//array_sum ( array array );//$teplo_postachannia+$vodo_postachannia+$tvp_postachannia+$jitlo_postachannia+$trans_postachannia+$lift_postachannia+$vodovidvod_postachannia+
    // 	$RPV_postachannia+$blago_postachannia+$inshe_postachannia+$postachannia42+$postachannia43+$postachannia44+$postachannia21;

$proporcia=$data['sets_array'][0]['nevidm']['fop'];//$itog-$postach;//ne razmecheny
$proporcia_chiseln=$data['sets_array'][0]['nevidm']['chiseln'];
$postach_chiseln=$itog_chiseln-$proporcia_chiseln;
$postach=$itog-$proporcia;
//  var_dump($proporcia_chiseln,$proporcia,$postach_chiseln,$postach,$itog,'tt');
foreach($data['sets_array'][0] as $k=>$s):
        if($s['chiseln']>0){
            if($k=='nevidm')continue;
            if($k=='inshe')$k='Інші сфери діяльності';


   $plus_chiseln= round($proporcia_chiseln*$s['chiseln']/$postach_chiseln,1);//відсоток
   $teplo= round($s['fop']/$postach,2);//відсоток
$s_itog=round((($s['fop']+$proporcia*$teplo)*$sezon+($s['fop_off']+$proporcia*$teplo)*(12-$sezon))/12);

//  var_dump($plus_chiseln,$s['chiseln'],$teplo,'rr');
 /////////////////////
   ?>
   <tr>
        <td colspan="8" rowspan="1" style="text-align:left;">
            <?=$k?>         </td>
        <td>  <?=$s['chiseln']+$plus_chiseln?>            </td>
        <td colspan="5"></td>
        <td><?=$s_itog?></td>
    </tr><?}
    endforeach;
    //




//Запись в базу итога по айди
		$ident = $data['id'];//$this->model->savedataredag($ident,$data_redag);
		//$this->model->savegarantii($ident, $itog,$ser_fop,$teplo_itog,$vodo_itog,$tvp_itog,$jitlo_itog,$lift_itog,$inshi_itog,$trans_itog,$RPV_itog,$vodovidvod_itog);
//var_dump($ident);
/*if($_GET['sfera']==0){
$db->query("update `calculation_workers` SET `all_money` = '$itog', `ser_fop`= '$ser_fop', `all_money_1`='$teplo_itog',`all_money_2`='$vodo_itog',`all_money_3`='$tvp_itog',`all_money_4`='$jitlo_itog', `all_money_5`='$lift_itog', `all_money_inshi`='$inshi_itog',`all_money_11`='$trans_itog', `all_money_14`='$vodovidvod_itog',`all_money_20`='$RPV_itog',`all_money_27`='$blago_itog' WHERE `id_pidpriemstva`='$ident'");

$db->query("update `calculation_workers` SET `procent_1`='$teplo',`procent_2`='$vodo',`procent_3`='$tvp',`procent_4`='$jitlo', `procent_5`='$lift', `procent_11`='$trans', `procent_14`='$vodovidvod',`procent_20`='$RPV', `procent_27`='$blago' WHERE `id_pidpriemstva`='$ident'");
}*/
}?>
</tbody>

</table>
</div>
<br/><br/>
</section>



<div style="height:250px;"></div>

<style>
#content{margin-top:0px;padding-top:0px;}
</style>

		<!--     МОДАЛЬНЫЕ ОКНА ОШИБОК      onclick="show_alert()"      -->



