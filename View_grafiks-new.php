<?
//header('Content-Length: '.filesize($yourimage));
 //header('Content-Type: image/png');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//session_start();


require_once  'core/db.php';
//include 'core/model.php';
//require_once '../core/lib/Classes/PHPExcel.php';

$db = new SafeMySQL();
if(isset($_GET['id'])) {
	$id = $_GET['id'];
}

$callStartTime = microtime(true);

///$model = new Model();
//$sfera=$db->getRow ("SELECT * FROM `table_1` WHERE `id`=?s",  $_GET['id']);$aa=0;
$sfera=$tab=$data['d'];
//var_dump($callStartTime);
include_once 'models/Model_calculations.php';
$modelc = new Model_calculations();
//include 'models/Model_grafiks.php';
$modelg = new Model_grafiks();


$ugoda=$sfera['ugoda'];
if($ugoda=='26'  || ($ugoda=='')){$c57='';$c_57='';$dNight=0.4;$dEv=0.2;}else {$c57='57';$c_57='_57';$dNight=0.35;$dEv=0.2;}
$dosiagnennia_dir=0;
$work_days_director=$modelc->work_days_director();
$osnovna_zp_kontrakt=$sfera['osnovna_zp_kontrakt'];$dodatkova_zp_kontrakt=$sfera['dodatkova_zp_kontrakt'];
//main proffecy and cod
$proff_prof ='';
//Сфера деятельности предприятия
$sfera_activity='';$activity='';$act=0;//var_dump($sfera['sfera_1'],$sfera['sfera_2']);
$sfera_activity.=$sfera['sfera_1'].=$sfera['sfera_2'].=$sfera['sfera_3'].=$sfera['sfera_4'].=$sfera['sfera_5'].=$sfera['sfera_6'].=$sfera['sfera_7'].=$sfera['sfera_8']
.=$sfera['sfera_9'].=$sfera['sfera_10'].=$sfera['sfera_11'].=$sfera['sfera_12'].=$sfera['sfera_13'].=$sfera['sfera_14'].=$sfera['sfera_15']
.=$sfera['sfera_16'].=$sfera['sfera_17'].=$sfera['sfera_18'].=$sfera['sfera_19'].=$sfera['sfera_20'].=$sfera['sfera_21'].=$sfera['sfera_22']
.=$sfera['sfera_23'].=$sfera['sfera_24'].=$sfera['sfera_25'].=$sfera['sfera_26'].=$sfera['sfera_27'];//var_dump($sfera['sfera_1'],$tab['sfera_2']);
foreach ($modelc->proff_proff as $sfera_d => $c):
				if (strstr($sfera_activity, $sfera_d))

					{$proff_prof = $c;
					}
				endforeach;
$db->query("UPDATE `calculation_garrantiesHeads` SET `proff_prof`='$proff_prof'	 WHERE `id_pidpriemstva`=?s AND `type`='director' AND `typeB`=''", $_GET['id']);//
/*foreach ($modelc->coeff_proff as $sfera_d => $c):

						if (strstr($sfera_activity, $sfera_d))
						{$act++;
								//$activity .= $act.') '.$sfera_d.';<br/>';
								$activity .='<img src="/images/tick_64.png">'.'&nbsp;&nbsp; '.$sfera_d.';<br/>';
							}

					endforeach;
	$activity= substr($activity, 0, -6); */
///$db->query("UPDATE `table_1` SET `activity`='$activity'	 WHERE `id`=?s ", $_GET['id']);
//var_dump($activity,$proff_prof);
$activity=$sfera['activity'];
$shtat = $sfera['kilkist_shtatnich_pracivn_gal_garant'];
$sezon= $sfera['sezon'];

$all_zarplata_fact=$all_zarplata2_fact=$all_zarplata_off_fact=0;


//if(strpos($zp['period'],'2017'))$min_zp=1600;
//=if(date('Y')=='2017')$min_zp=1600;
/////////////////////////////////
$getgroup = $db->getAll("SELECT * FROM `calculations_groups` WHERE `id_factory`='$id' AND `group_type`!='worker' AND `group_type`!='fun' ORDER BY `group_order`");
 $getgroupB = $db->getAll("SELECT * FROM `calculations_groups` WHERE `id_factory`='$id' AND `group_type`='fun' ORDER BY `group_order`");
 $group_workers = $db->getAll("SELECT * FROM `calculations_groups` WHERE `id_factory`='$id' AND `group_type`='worker' ORDER BY `group_order`");
 $getrecordWorkers= $db->getAll("SELECT * FROM `calculation_garrantiesWorkers` WHERE `id_pidpriemstva`=?s ORDER BY `positiosworkers`", $_GET['id']);
 $getrecordWorkersB= $db->getAll("(SELECT * FROM `calculation_garrantiesWorkersB` WHERE `id_pidpriemstva`=?s ORDER BY `type`, `positiosworkers`)  ", $_GET['id']);

 //----------------

$d= $db->getRow("SELECT * FROM `calculation_garrantiesSfera_0` WHERE `id_pidpriemstva`='$id' AND `type`='director' AND `typeB`='' AND `dilnica`='' ");

 $kontrakt= $db->getOne("SELECT `in kontrakt` FROM `calculation_garrantiesHeads` WHERE  `type`='director' AND `id_pidpriemstva`=?s",  $_GET['id']);

 $region= $db->getOne("SELECT `region` FROM `table_1` WHERE `id`=?s",$_GET['id']);$regional_coef=0;
 if ($region=='Донецька область') {$regional_coef =1.15;}
 else {$regional_coef = 1;}
// $ser_fop_begin =$db->getOne("SELECT `ser_fop` FROM `calculation_workers`  WHERE  `id_pidpriemstva`=?s",  $_GET['id']);
// $ser_fop_begin = 0;//$ser_fop_begin/1000;

// $select =$d= $db->getRow("SELECT * FROM `calculation_garrantiesHeads` WHERE `id_pidpriemstva`='$id' AND `type`='director' AND `typeB`=''");

// //$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `id`='$ker_id'");
// if(isset($d)){if($d['regional_koef_fact']==0) { $d['regional_koef_fact'] = 1;	}
// $oklad_fact = round($min_zp*$d['koef_I_rozr_fact']*$d['koef_posada_fact']*$d['koef_rob_prof_fact']*$d['regional_koef_fact']);
// 			$dodatkova_fact = $d['sumisnyk']+$d['EvNight']+round(($d['percent_input']+$d['zaohoch_percent'])*$oklad_fact/100)*$d['shtat_kilkist'];
// }//var_dump($min_zp,$d['koef_I_rozr_fact'],$d['koef_posada_fact'],$d['koef_rob_prof_fact'],$d['regional_koef_fact'],$d['percent_input'],$d['zaohoch_percent'],$oklad_fact,$dodatkova_fact);
$y_1=date("Y",strtotime("-1 years"));$y_2=date("Y",strtotime("-2 years"));$y_3=date("Y",strtotime("-3 years"));
////$kontrakt_data = $data_boss['d']['period_start'];
//$pib_boss_now=$tab['pib_kerivnika'];
$pib_boss = $db->getAll("SELECT `name`  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`!='' GROUP BY `name` ORDER BY `id` DESC ");//
if(isset($_GET['archive_name']))$pib_boss_now=$_GET['archive_name'];
elseif($pib_boss) $pib_boss_now=$pib_boss[0]['name'];
elseif ($tab['pib_kerivnika']!=='')$pib_boss_now=$tab['pib_kerivnika'];
else $pib_boss_now='';
 $data_boss_arhiv = $db->getAll("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`!='' AND `name`!='$pib_boss_now' GROUP BY `name` ORDER BY `id` DESC ");//


if($sfera['kontrakt_kerivnika']==''){$sfera['kontrakt_kerivnika']='б/н';}


$sezon= $tab['sezon'];

$data_boss_now = $db->getAll("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ORDER BY `id` ");
//var_dump($min_zp,$data_boss_now);

 if(empty($data_boss_now)){

	$num_contr_boss=$tab['kontrakt_kerivnika'];
	$data_start_boss=$tab['kontrakt_kerivnika_data'];
	if($tab['kontrakt_kerivnika_data']=='')$data_start_boss=$tab['data_obliku'];
	$data_end_boss='теперішній час';
	$oklad_boss=$tab['osnovna_zp_kontrakt'];
	$doplata_boss=$tab['osnovna_zp_kontrakt'];//*$tab['dodatkova_zp_kontrakt']/100;//$tab['dodatkova_zp_kontrakt'];
	$salary_boss=$oklad_boss+$tab['osnovna_zp_kontrakt']*$tab['dodatkova_zp_kontrakt']/100;
//	var_dump($min_zp,'data_boss_now');
     $db->query("INSERT INTO `boss` (`name`,`num_contr`, `period_start`, `period_end`, `oklad`, `doplata`, `salary`, `id_pidpriemstva`) values ('$pib_boss_now',
     '$num_contr_boss','$data_start_boss','$data_end_boss','$oklad_boss',
        '$doplata_boss', '$salary_boss','$id')");
        $data_boss_now = $db->getAll("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ORDER BY `id` ");

      //  if(empty($data_boss_now)){$data_boss_now = $db->getAll("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='1150'  AND `name`='$pib_boss_now' ORDER BY `id` ");}
 }

$table=$table2=$table3='';
$table.='<table style="text-align: center; width: 100%;margin:0 0;margin-top:-15px;" class="tables"
 cellpadding="0" cellspacing="0">
      <tr style="background:rgba(124, 205, 124,0.4);color:black;text-align:center;"><td colspan="3">
	<strong>
Сума різниці (грн.) </strong> <span style="font-size: 75%;">*без врахування індексації та компенсації за порушення термінів виплати заробітної плати</span>
</td> </tr>

    <tr style="background:rgba(185, 211, 238 ,0.6);color:#8B3A3A;font-size:83%;">

		<td>Період</td>
		<td>Розмір мінімальної заробітної плати (грн.) </td>
		<td>Різниця (грн.)</td>
    </tr>';
?>
<? $pidtverdjeno_regional = '';$pidtverdjeno_pidpr = '';

//Для админа
if ($_SESSION['status']=='1')
				{



					if($data_boss_now[0]['pidverdjeno_pidpr'] !=='')
					{
							$pidtverdjeno_pidpr = 'Підтверджено підприємством';
								$pidtverdjeno_pidpr = ' <a style="color:#fff;" href="/grafiks/pidpys/?unlock&id='.$id.'" >Підтверджено підприємством</a> ';
							$bcg1 = 'rgba(0, 81, 163, 1)';
					}else
						{
							$pidtverdjeno_pidpr = 'Не підтверджено підприємством';
							$pidtverdjeno_pidpr = ' <a style="color:#fff;" href="/grafiks/pidpys/?lock&id='.$id.'" >Не підтверджено підприємством</a> ';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}
						if($data_boss_now[0]['pidverdjeno_regional'] !=='')
						{
							$pidtverdjeno_regional = 'Підтверджено регіональним керівником';
						$pidtverdjeno_regional = '<a style="color:#fff;"href="/grafiks/pidpys_region/?unlock&id='.$id.'" >Підтверджено регіональним керівником</a> ';
							$bcg2 = 'rgba(0, 81, 163, 1)';

						}
					else
						{
							$pidtverdjeno_regional = 'Не підтверджено регіональним керівником';
							$pidtverdjeno_regional = '<a  style="color:#fff;" href="/grafiks/pidpys_region/?lock&id='.$id.'" >Не підтверджено регіональним керівником</a> ';
							$bcg2 = 'rgba(205, 16, 0, 1)';
						}

			}?>
				<br/>
		<?
		//Подтверждение предприятием
		if($_SESSION['status']=='0')
			{
				if($data_boss_now[0]['pidverdjeno_pidpr'] !=='')
					{
						$pidtverdjeno_pidpr = ' <a href="/grafiks/pidpys/?unlock&id='.$id.'" style="color:#fff;" >Підтверджено підприємством</a> ';
						$bcg1 = 'rgba(0, 81, 163, 1)';
					}else
						{
							$pidtverdjeno_pidpr = '<a href="/grafiks/pidpys/?lock&id='.$id.'"style="color:#fff;">Не підтверджено підприємством</a>';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}
				if($data_boss_now[0]['pidverdjeno_regional'] !=='')
					{
						$pidtverdjeno_regional = 'Підтверджено регіональним керівником';
						$bcg2 = 'rgba(0, 81, 163, 1)';
					}else
					{
						$pidtverdjeno_regional = 'Не підтверджено регіональним керівником';
						$bcg2 = 'rgba(205, 16, 0, 1)';
					}
			}

			//Подтверждение региональным представителем
			if(($_SESSION['status']=='2') ){

				if($data_boss_now[0]['pidverdjeno_regional'] !=='')
					{
						$pidtverdjeno_regional = '<a href="/grafiks/pidpys_region/?unlock&id='.$id.'"style="color:#fff;" >Підтверджено регіональним керівником</a> ';
						$bcg2 = 'rgba(0, 81, 163, 1)';
					}else
					{
						$pidtverdjeno_regional = '<a href="/grafiks/pidpys_region/?lock&id='.$id.'"style="color:#fff;">Не підтверджено регіональним керівником</a>';
						$bcg2 = 'rgba(205, 16, 0, 1)';
					}

					if($data_boss_now[0]['pidverdjeno_pidpr'] !=='')
					{
						$pidtverdjeno_pidpr = 'Підтверджено підприємством';
						$bcg1 = 'rgba(0, 81, 163, 1)';
					}else
						{
							$pidtverdjeno_pidpr = 'Не підтверджено підприємством';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}


			}?>

<link rel="stylesheet" type="text/css"  href="/css/navigation_bar_vert_FACT.css?rnd=9"/>
<?/*
<style>
			.container_g{overflow:hidden;width:100%;background:rgb(42,86,155);min-height:auto;}
			.container_g_bottom{overflow:hidden;width:100%;background:rgb(42,86,155);min-height:auto;border-top:1px solid #fff;}
.box_g{}
.box_g div{display:inline-block;vertical-align:top;}
			</style>
<div class="container_g" style="margin-top:5%;">
  <div class="box_g">
	<div style="margin-top:10px;font-weight:bolder;padding-left:30px;width:20%;color:#fff;min-height:100px;">
		<span style="font-size:120%;">
			<?=$tab['povne_naymenuvannya']?>
			<p style="font-size:80%; margin: 0;
    padding: 0;">(код ЄДРПОУ <?=$tab['EDRPOU']?>)<p>
		</span><br/>
		<span style="font-size:80%;">
			<?if($tab['region']=='м. Київ') {
			$tab['region']='';
			}?>
			<?=$tab['region']?><br/>


			<?='місто'. ' '.$tab['misto']?>
		</span>
		<div style="margin-top:12px;color:rgba(218, 165, 32, 0.7);padding:0px;height:auto;font-size:75%;">Підтримка користувачів: <br/>
			<div style="margin-bottom:4px;"><img src="/images/kyivstar-16.png" width="20px" valign="middle">&nbsp;&nbsp;&nbsp;	067 829 44 42	&nbsp;&nbsp;&nbsp;<br/></div>
			<div style="margin-bottom:4px;"><img src="/images/vodafone-16.png" width="20px" valign="middle">&nbsp;&nbsp;&nbsp;	099 519 54 76  	&nbsp;&nbsp;&nbsp;<br/></div>

			<div style="margin-bottom:4px;"><img src="/images/lifecell-16.png" width="20px" valign="middle">&nbsp;&nbsp;&nbsp;	063 307 87 17	&nbsp;&nbsp;&nbsp;<br/></div>
			<div style="margin-bottom:4px;"><img src="/images/intertelecom-16.png" width="20px" valign="middle">&nbsp;&nbsp;&nbsp;	044 227 01 08<br/></div>
		<br/>
		</div>
		</div>
   <div style="padding:15px;width:24.9%;color:rgba(218, 165, 32, 0.7);border-right:1px solid #fff;border-left:1px solid #fff;min-height:190px;">Сфери діяльності:<br/>
		<span style="color:#fff;">
			<?=$activity?>
		</span>


	</div>

			<div style="width:30%;min-height:110px;margin-top:15px;padding-left:15px;position:relative;">
    <table style="width:100%;font-size:13px;color:#fff;padding:7px;">
				<tr style="padding:4px;background:rgba(0, 0, 128, 0.1);white-space:no-wrap;"><td style="background:<?=$bcg1?>"></td>
				<td style="padding:4px;"><p style="color:#fff;"><?=$pidtverdjeno_pidpr?></p></td>
				<td style="padding:4px;"><p style="color:#fff;"><?=$data_boss_now[0]['pidverdjeno_pidpr']?></p></td></tr>
				<tr style="padding:4px;background:rgba(0, 0, 128, 0.1);white-space:no-wrap;"><td style="width:20px;background:<?=$bcg2?>"></td>
				<td style="padding:4px;"><p style="color:#fff;"><?=$pidtverdjeno_regional?></p></td>
				<td style="padding:4px;"><p style="color:#fff;"><?=$data_boss_now[0]['pidverdjeno_regional']?></p></td></tr>
				<tr style="padding:4px;background:rgba(0, 0, 128, 0.1);"><td style="width:20px;"></td>
				<td style="padding:4px;"><p style="color:#fff;">Дата останнього висновку</p></td> <td style="width:80px;padding:4px;">
				    <p style="color:#fff;"><?=$data_boss_now[0]['control_request']?></p></td></tr>
</table>


		</div>


  </div>
</div>
<div class='container_g_bottom'>
		<div class="box_g">
			<div style="height:51px;display:inline-block;margin-left:30px;margin-top:15px;font-weight:normal;padding-left:3px;width:47%;color:#fff;font-family:Arial;font-size:75%;">
				<div style="margin-left:0%;font-family: Times New Roman;"><h1>Оплата праці керівника (гарантії С)</h1>
				</div>
				</div>



			<div style="display:inline-block;width:49%;color:rgba(218, 165, 32, 0.7);border-left:1px solid #fff;border-left:1px solid #fff;height:66px;">
			<div id="NavigationBar1" style="display:inline-block;width:40px;margin:7px;height:40px;z-index:1;">
					<ul class="navbar">
						<li><a href=""><img alt="" width='50' height="50" src="/images/edit_h.png" class="hiderKontrakt hover"><span><img alt="" width='50' src="/images/edit.png"></span></a></li>
					</ul>
				</div>
				<!--<a href="#modalWindBoss" title=""><input type="button"  value="Створити новий запис" /></a>-->
				<div id="NavigationBar1" style="display:inline-block;width:40px;margin:7px;height:40px;z-index:1;">
					<ul class="navbar">
						<li><a href="#modalWindBoss"><img alt="" width='50' height="50" src="/images/plus.png" class="hover"><span><img alt="" width='50' height="50" src="/images/plus_1.png"></span></a></li>
					</ul>
				</div>


				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<!--li><a href="/grafiks/boss_calendar/?id=<?=$id?>"><img alt="" width='50' height="50" src="/images/refresh_h.png" class="hover">
						<span><img alt="" width='50' height="50" src="/images/refresh.png"></span></a></li-->
						<li><a href="#"><!--button  type="submit" form="boss_calendar" class="hover"-->
						    <img alt="" width='50' height="50" src="/images/refresh_h.png"  onclick="$('#boss_calendar').submit()" class="hover">
						<span><img alt="" width='50' height="50" src="/images/refresh.png"></span></a></li>
					</ul>
				</div>
		<!--form id="example"> $('#boss_calendar').submit()
кнопка выглядит так
<button  type="submit" form="boss_calendar" formaction="/page" formmethod="get">сохранить</button-->

				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar" id="menu"  style="display:inline-block;font-size:170%;">
		<li>
			<a href="#"><img alt="" width='50' height="50"src="/images/archive_h.png" class="hover">
			<span><img alt="" width='50' height="50" src="/images/archive.png"></span></a>
				<ul >
					<?foreach($data_boss_arhiv as $archive):?>
					<li style="width:200px;font-size:12px;z-index:12;margin-bottom:-15px;">
						<a href="/grafiks/T1/?archive_name=<?=$archive['name']?>&id=<?=$id?>" style="color:black;">
						    <?=$archive['name']?> <?=$archive['period_start']?></a>
					</li>
					<?endforeach;?>
				</ul>
		</li>
	</ul>
				</div>

				<!--div  class="yacheika2kontrakt" style="float:left;position:absolute;top:42%;left:80%;font-size:100%;">

	<ul id="menu"  style="display:inline-block;font-size:170%;">
		<li>
			<a href="#"><input type="button"  value="Архів" /></a>
				<ul style="width:200px;font-size:12px;">
					<?foreach($data_boss_arhiv as $archive):?>
					<li>
						<a href="/grafiks/boss_archive/?archive_name=<?=$archive['name']?>&id=<?=$id?>" style="color:black;"><?=$archive['name']?> <?=$archive['period_start']?></a>
					</li>
					<?endforeach;?>
				</ul>
		</li>
	</ul>

</div-->


				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printInfo.php?id=<?=$id?>"><img alt="" width='50' height="50" src="/images/gu3_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/gu3.png"></span></a></li>
					</ul>
				</div>
				<?if($_SESSION['status']>0){?>
				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printRiznicyaTarifv.php?id=<?=$id?>"><img alt="" width='50' height="50" src="/images/print.png" class="hover"><span><img alt="" width='50' height="50" src="/images/print.png"></span></a></li>
					</ul>
				</div>

				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printText.php?id=<?=$id?>"><img alt="" height="50" width='50' src="/images/vimoga_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/vimoga.png"></span></a></li>
					</ul>
				</div>
			<?}?>
				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/grafiks/send/?id=<?=$id?>&send=C"><img alt="" width='50' height="50" src="/images/zamovVisnC_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/zamovVisnC.png"></span></a></li>
					</ul>
				</div>
				<?if($_SESSION['status']>0){?>
				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printRozrahunok.php?id=<?=$id?>"><img alt="" width='50' height="50" src="/images/riznicya_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/riznicya.png"></span></a></li>
					</ul>
				</div><?}?>
				<!-- zamovVisnC.png
				<div style="width:60%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?if($_SESSION['username']=='main_admin'||$_SESSION['username']=='kosta'){?><a href="/models/Model_printRiznicyaTarifv.php?id=<?=$id?>"
style=" background-color: #c1c1c1; color: black; text-decoration:none;padding:3px;border:1px solid #e8e8e8;">Друк</a>&nbsp;&nbsp;&nbsp;
<a href="/models/Model_printRozrahunok.php?id=<?=$id?>"
style=" background-color: #c1c1c1; color: black; text-decoration:none;padding:3px;border:1px solid #e8e8e8;">Розрахунок</a>&nbsp;&nbsp;&nbsp;
<a href="/models/Model_printGarantiya.php?id=<?=$id?>"
style=" background-color: #c1c1c1; color: black; text-decoration:none;padding:3px;border:1px solid #e8e8e8;">Інформація</a>&nbsp;&nbsp;&nbsp;
<?}?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/grafiks/send/?id=<?=$id?>&send=C"
style="background-color: #c1c1c1; color: black;text-decoration:none;padding:3px;border:1px solid #e8e8e8;">Замовити висновок С</a>&nbsp;&nbsp;&nbsp;
<a href="/grafiks/send/?id=<?=$id?>&send=Y"
style="background-color: #c1c1c1; color: black;text-decoration:none;padding:3px;border:1px solid #e8e8e8;">Замовити звернення до Мінсоцполітики</a>

</div>-->




			</div>
		</div>
	</div>
	<? */
 ?>



			<!-- Шапка -->
	<header class="inner">
		<div class="cont cont--small">
			<div class="sector_flex">
				<div class="logo">
					<a href="/calculations/cabinet/?id=<?=$_GET['id']?>" title="В кабінет підприємства">
						<span>
							<b><?=$data['name']['povne_naymenuvannya']?></b><br/>
							<?if($data['name']['region']=='м. Київ') {
			$data['name']['region']='';
			}?>
			<?=$data['name']['region']?><br/> місто <?=$data['name']['misto']?>
						</span></a>
<a href="//fru-gkh.com.ua/" title="Федерація роботодавців в сфері ЖКГ України">
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
//var_dump($activity);
$c=substr_count($activity, '<div>');
$v=substr($activity, 5,9);

if($c==0){$v=substr($activity, 37,12);
$c=substr_count($activity, '<br/>');}

// $row='word1 text, world1, text word2';
// preg_match_all("/<b>(.*)<\/b>/",$activity,$matches);
// var_dump($matches);
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
<?$instr="1.       Через кнопку <b>«Редагувати»</b> внести відомості про фактичні умови оплати праці керівника підприємства окремо за кожний період дії певних умов,
    починаючи з дати приєднання підприємства до Галузевої угоди; Для чинних умов замість кінцевої дати обирається значення <b>«теперішній час»</b>;
<br/>
2.       В календарі зняти відмітку з робочих днів, які не були відпрацьовані керівником з тих чи інших підстав (відпустка, відгул, лікарняний, прогул тощо);
Розрахунок різниці здійснюється лише за окладом та постійними доплатами, і не враховує різницю за лікарняними, відпускними;
<br/>
3.       Натиснути кнопку <b>«Оновити розрахунки»</b>;
<br/>
4.       Роздрукувати форму ГУ-3 та за підписом керівника надіслати поштою на адресу Федерації;
<br/>
5.       Замовити висновок «С» шляхом натискання відповідної кнопки, який буде надіслано на поштову адресу підприємства протягом 5 (п’яти) днів з дня
отримання запиту.
<br/>
6.       Натиснути кнопку <b>«Новий запис»</b> в разі необхідності створити запис про нового керівника.<br/>";//; За кнопкою <b>«Архів»</b> можна переглянути інформацію щодо попередніх
//керівників.<br/>";

?>

				<div class="wrap_instruction">
					<div class="instruction">
						<a href="#" class="mini_modal_link" data-modal-id="#modal_inst">Інструкція</a>

						<div class="mini_modal" id="modal_inst" style="width: 700px;">
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
      margin-top: 26px;    padding-left: 100px;    color: #606060;    font: 700 20px Ubuntu;    text-transform: uppercase;    letter-spacing: .020em;}
      section .main_titler:before{    position: absolute;    top: 12px;    left: 0;    width: 80px;    height: 2px;    background: #cd1000;    content: '';}

  .submit_btn{    display: inline-block;    vertical-align: top;    padding: 0 2px;    color: #fff;    font: 700 13px Ubuntu;
  border: 1px solid #cd1000;    background: #cd1000;    text-transform: uppercase;}.form .submit_btn{    height: 50px;    cursor: pointer;}

 section .box_flex .edit a{    display: block;    min-width: 105px; /*   padding: 0 10px;
 color: #fff;    font: 700 13px/48px Ubuntu;    border: 1px solid #fff;    text-align: center;
 text-decoration: none;    text-transform: uppercase;}
 section .box_flex .edit a:hover,section .box_flex .edit a.active{    color: #cd1000;    background: #fff;*/} </style>

	<!-- Основная часть -->
	<section>
		<div class="cont cont--small">
			<div class="main_titler">Оплата праці керівника <span style="color:#cd1000;">(гарантії С)</span> </div>
		</div>

	</section>
		<section class="section_edit">
	<div class="bng_red">
			<div class="cont cont--small">
				<div class="box_flex box_flex--small">

<div class="edit"><a href="#modalWindBoss" class="submit_btn">Новий запис</a></div>
<div class="edit"><a href="#" onclick="$('#boss_calendar').submit()" class="submit_btn">Оновити розрахунки</a></div>

<?/*div class="edit"><ul class="" style="margin-top:-25px;" id="menu"  >
		<li><a href="#" class="submit_btn">Архів</a>
<ul >
					<?foreach($data_boss_arhiv as $archive):?>
					<li style="width:150px;font-size:12px;z-index:12;margin-bottom:-5px;">
						<a href="/grafiks/T1/?archive_name=<?=$archive['name']?>&id=<?=$id?>" style="color:#cd1000;">
						    <?=$archive['name']?> <?=$archive['period_start']?></a>
					</li>
					<?endforeach;?>
				</ul>
	</li>
	</ul>				</div*/?>
<div class="edit"><a href="/models/Model_printInfo.php?id=<?=$id?>" target="_blank" class="submit_btn">ГУ-3</a></div>
<?if($_SESSION['status']>0){?><div class="edit"><a href="/models/Model_printRiznicyaTarifv.php?id=<?=$id?>" target="_blank" class="submit_btn">Друк</a></div>
<!--div class="edit"><a href="/models/Model_printText.php?id=<?=$id?>" target="_blank" class="submit_btn">Вимога</a></div--><?}?>
<div class="edit"><a href="/grafiks/send/?id=<?=$id?>&send=C" target="_blank" class="submit_btn" onClick="return confirmDelete();">Замовити висновок С</a></div>
<div class="edit"><a href="/models/Model_printRozrahunok.php?id=<?=$id?>" target="_blank" class="submit_btn">Різниця</a></div>
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
/*.instructio:after {font-family: FontAwesome;    font-size: 21px;  font-weight: normal;
    content: "\f107";
	}*/
	input[name=work_procent]{background: #f8f8f8;border: 1px solid #606060;}
	input[name=admin_procent]{background: #f8f8f8;border: 1px solid #606060;

	}

	/*.operatio{    position: relative;    padding-left: 7%;}
		/* .operatio:after{    position: absolute;    top: 50%;    left: 0;    width: 45px;    height: 45px;    background: url(../images/tel2.png) 0 0 no-repeat;
	 content: '';    transform: translateY(-50%);} .operatio:after{    background-image: url(../images/icon1.png);}
*/
	  .operatio .title{    color: #0051a3;    font: 500 15px Ubuntu;} .operatio .link a{    position: relative;    padding-right: 24px;    color: #0051a3;
	 font: 500 20px Ubuntu;    text-decoration: none;} .operatio .link a:after{    position: absolute;    top: 10;    right: 0;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';} .operatio .link{    margin-top: 10px;} .operatio .link a{    padding-right: 20px;
	 font-size: 16px;    line-height: 23px;} .operatio .link a:before{    font-size: 16px;} .operatio .link a b{    font-size: 20px;    font-weight: 500;}
	 .operatio .mini_modal{    position: absolute;    bottom: 100%;    left: 15%;    z-index: 999;    display: none;       padding: 0 8px 14px;
	 color: #606060;    font: 300 20px Ubuntu;    background: #fff;    box-shadow: 0 2px 7px rgba(0,0,0,.30);} .operatio .mini_modal{
	 width: 356px;    font-size: 16px;}.operatio .mini_modal div{    margin-top: 16px;} .operatio .mini_modal b{    font-size: 20px;    font-weight: 500;}
	/* .operatio .mini_modal b{    font-size: 25px;}*/

	.instructio a{    position: relative;    padding-right: 24px;    color: #0051a3;
	 font: 500 20px Ubuntu;    text-decoration: none;} .instructio a:after{    position: absolute;    top: 0;    right: -10;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';} .instructio{    margin-top: 10px;} .instructio a{    padding-right: 20px;
	 font-size: 16px;    line-height: 23px;} .instructio a:before{    font-size: 16px;} .instructio a b{    font-size: 20px;    font-weight: 500;}
	 .instructio .mini_modal{    position: absolute;    top: -100%;    left: 15%;    z-index: 999;    display: none;    width: 156px;    padding: 0 8px 14px;
	 color: #606060;    font: 300 20px Ubuntu;    background: #fff;    box-shadow: 0 2px 7px rgba(0,0,0,.30);} .instructio .mini_modal{    left: 550px;
	 width: 95px;    font-size: 16px;}.instructio .mini_modal div{    margin-top: 16px;} .instructio .mini_modal b{    font-size: 20px;    font-weight: 500;}
</style>




	<?//{ $savebox_style="margin-top:-30px;";}
	$sign_archives=0;
if($data_boss_now[0]['pidverdjeno_regional'] !==''&& $data_boss_now[0]['pidverdjeno_pidpr'] !=='')$sign_archives=1;
$statusus='Не підтверджено';
if($sign_archives==1)$statusus='Підтверджено ('.$data_boss_now[0]['pidverdjeno_regional'].')';
	?>
<section class="bng_section savebox" style="margin-top:0px;">
		<div class="cont cont--small" >
			<div class="link"><a href="#modal_savebox" class="modal_link"><span>Статус даних: <?=$statusus?></span></a></div>
		</div>
	</section>
<div class="modal modal_chat" id="modal_savebox" style="display: none;">
		<div class="pad">
			<!--div class="title">спілкування для своїх</div-->
			<div class="title" style="color:#fff;background:<?=$bcg1?>"><?=$pidtverdjeno_pidpr?> <?=$data_boss_now[0]['pidverdjeno_pidpr']?></div><!--br/-->
			<div class="title" style="color:#fff;background:<?=$bcg2?>"><?=$pidtverdjeno_regional?> <?=$data_boss_now[0]['pidverdjeno_regional']?></div>
			</div>

</div>



	<?$wrong=0;//2017-03-15
	if($data_boss_now[0]['period_start']==''||$data_boss_now[0]['period_start']=='0000-00-00'|| $data_boss_now[0]['period_start']=='00/00/0000'){
	    $data_boss_now[0]['period_start']=$tab['data_obliku'];$wrong=1;}//date('d').'/'.date('m').'/'.date('Y');
	if($data_boss_now[count($data_boss_now)-1]['period_end']=='' ||$data_boss_now[count($data_boss_now)-1]['period_end']=='0000-00-00'){
	    $data_boss_now[count($data_boss_now)-1]['period_end']=date('d').'/'.date('m').'/'.date('Y');$wrong=1;}
	if($data_boss_now[0]['salary']=='0'){$data_boss_now[0]['salary']=$data_boss_now[0]['oklad'];$wrong=1;}
	if(strpos($data_boss_now[0]['period_start'],'-')){$d0=explode('-',$data_boss_now[0]['period_start']);
	    $data_boss_now[0]['period_start']=$d0[2].'/'.$d0[1].'/'.$d0[0];$wrong=1;}
	    if(strpos($data_boss_now[count($data_boss_now)-1]['period_end'],'-')){$d0=explode('-',$data_boss_now[count($data_boss_now)-1]['period_end']);
	    $data_boss_now[count($data_boss_now)-1]['period_end']=$d0[2].'/'.$d0[1].'/'.$d0[0];$wrong=1;}
//var_dump()

	$oblik_data0=$tab['data_obliku'];
	$oblik_data=substr($tab['data_obliku'], 3);
	$obl_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$oblik_data'");
	$kontrakt_data=substr($data_boss_now[0]['period_start'], 3);
	$kontrakt_data0=$data_boss_now[0]['period_start'];

//	var_dump($kontrakt_data0);
	if($data_boss_now[0]['period_start']==''){$kontrakt_data=$oblik_data;$kontrakt_data0=$oblik_data0;
	}
	    $ker_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kontrakt_data'");


//	var_dump($obl_id,$oblik_data,$kontrakt_data,$kontrakt_data0,$ker_id);
if( $obl_id>$ker_id){
    $ker_id=$obl_id;
   $kontrakt_data=$oblik_data;$kontrakt_data0=$oblik_data0;
}
// $data_end_bos='эі';
// if(preg_match('/[a-zA-ZА-Яа-я]/',$data_end_bos)) $data_end_bos='теперішній час';
// var_dump($data_end_bos,preg_match('/[А-Яа-я]/',$data_end_bos),preg_match('/[a-zA-ZА-Яа-я]/',$data_end_bos));

	$startDirJS=$kontrakt_data0;//$data_boss_now[0]['period_start'];
		$endDirJS=$data_boss_now[count($data_boss_now)-1]['period_end'];
if($endDirJS=='теперішній час') {$period=date('m').'/'.date('Y');
if(date('d')=='01'){$mm=(date('m')-1);if($mm<10)$mm='0'.$mm;$period=$mm.'/'.date('Y');}
    if(date('d')=='01'&&date('m')=='01'){$period='12/'.(date('Y')-1);}
}
//$endDirJS='01/09/2017';
if($endDirJS!=='теперішній час') {$period=substr($endDirJS, 3);//$period='теперішній час';
    if(substr($endDirJS, 0,2)=='01'){$mm=(substr($endDirJS, 3,2)-1);if($mm<10)$mm='0'.$mm;$period=$mm.'/'.substr($endDirJS, 6,4);}
    if(substr($endDirJS, 0,5)=='01/01'){$period='12/'.(substr($endDirJS, 6,4)-1);}
}
//var_dump($endDirJS,substr($endDirJS, 0,5),substr($endDirJS, 3,2),substr($endDirJS, 6,4),$period);

	$multipleDate=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`='$period' ",$sfera['EDRPOU']);
	if($multipleDate=='') $multipleDate=$db->getOne("SELECT `work_director` FROM `zvit_1_min_zp` WHERE `period`='$period' ");
	$CountDateDir=$db->getOne("SELECT `work_days_director` FROM `zvit_1_min_zp` WHERE `period`='$period' ");


	$preemnik=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`='$period' ",$sfera['EDRPOU']);


	$startDir=$data_boss_now[0]['period_start'];
	$startDir=substr($startDir, 3);
	//var_dump($data_boss_now,count($data_boss_now)-1,$startDirJS,$endDirJS,$period);
if($period==$startDir){//var_dump('oo');
    if(count($pib_boss)>1 && $multipleDate!==''){ $multipleDate=$preemnik;}

}
$perDate=date('m').'/'.date('Y');
	$holidaysDate=$db->getOne("SELECT `holidays` FROM `zvit_1_min_zp` WHERE `period`='$period' ");
	$beforeDate=$db->getOne("SELECT `before_holydays` FROM `zvit_1_min_zp` WHERE `period`='$period' ");
 //&& $data_boss_now['duration']>=8
	/*require_once '../core/db.php';
$db = new SafeMySQL();
//$holidaysDate=$db->getOne("SELECT `holidays` FROM `zvit_1_min_zp` WHERE `period`='06/2017' ");
echo $holidaysDate;var   holyDaysAnother="<?/*php include_once 'core/db.php';
$db = new SafeMySQL();
$holidaysDate=$db->getOne("SELECT `holidays` FROM `zvit_1_min_zp` WHERE `period`='<script>document.write(period)</script>' ");

 echo $holidaysDate;?>";
 //$('#holidaysDateDir').val();*/

// $multipleDatew=$db->getOne("SELECT COUNT(`work_director`) FROM `table_2` WHERE `EDRPOU`=?s AND `period`='11/2016' ",$sfera['EDRPOU']);
// if( ($multipleDatew)==0 )var_dump('$multipleDatew');
// var_dump( $multipleDatew);
	?>
	<style>
#dataTimeBalanceDir  .datepicker--cells  .-selected-
{
     background: none #0051a3;

}
#dataTimeBalanceDir  .datepicker--cells   .before_holidays.-selected-
{
     background: none #00aBaf;
     //color: #000000;
    // border: 1px solid #BF5A0C;
}

.consultant .name{    color: #606060;    font: 500 18px Ubuntu;    letter-spacing: .020em;}
.consultant .info{    margin-top: 22px;    color: #202020; padding:5px;   font: 700 16px Ubuntu;}
.consultant .cont div{margin:5px;}
.consname,.datepicker-here{    color: #606060;    font: 500 18px Ubuntu;    letter-spacing: .020em;}
.consnamered{    color: #cd1000;    font: 500 18px Ubuntu;    letter-spacing: .020em;}
.consinfo{    margin-top: 22px;    color: #202020; padding:5px;   font: 700 16px Ubuntu;}
</style>


<section class="bng_section consultant" style="margin-top:-5px;">
		<div class="cont cont--small">
			<div class="">
			   <span class="name" > ПІБ керівника:
	 </span>	<span class="info" style="padding:4px;"> <?=$data_boss_now[0]['name']?>
</span></div>

<?


//var_dump($obl_id,$oblik_data,$kontrakt_data,$ker_id);
$years=array();$koef_posady=array();
$year_start=substr($tab['data_obliku'],-4);
if($tab['data_obliku']=='')$year_start=date('Y');
//
$years[]=$year_start;
while($year_start<date('Y')){
    $year_start++;$years[]=$year_start;
}
//
///$tab['data_obliku']='11/04/2015';
	?>
 	<div class="">
			   <span class="name" >Обіймає посаду з <span class="info"><?=$data_boss_now[0]['period_start']?></span>
     по <span class="info"><?=$data_boss_now[count($data_boss_now)-1]['period_end']?></span>;
	 </span>	</div>
<div class="">
			   <span class="name" >Дата приєднання підприємства до Галузевої угоди:
	 </span>	<span class="info" style="padding:4px;"> <?=$tab['data_obliku']?>
</span></div>
<div class="">
			   <span class="name" >Працівник основної професії:
	 </span>	<span class="info" style="padding:4px;"> <?=$d['proff_prof']?>
</span></div>
 <div class="">
			   <span class="name" >Чисельність працівників згідно звіту 1-ПВ:

	 <?
$count_years=-1;
    foreach($years as $y){$count_years++;
        $yy=$y-1;
        $yyy=$tab['kilkist_shtatnich_pracivn_gal_garant_'.$yy.''];
        $koef_posady[$yy]=$modelg->director_tarif($yyy);
    ?>
    <span class="info"><?=$yy?></span> рік
        <span class="info"><?=$yyy?></span> чол.;
        <?//if($count_years%2==1) echo '<br/>';
    }
   // var_dump($koef_posady);
    ?></span>
    </div>
<!--<div><span class="name"></span></div>-->
	</div>
	<br/>
	</section>

<section class="bng_section" style="margin-top:-5px;padding-bottom:10px;padding-top:20px;">
		<div class="cont cont--small" >

<div class=""><form id="boss_calendar" method="post" action="/grafiks/boss_calendar/?id=<?=$id?>">
<!--</div> style="float: right;margin-left:15%;width:50%;height:30%;
    margin-right: 1%;
    margin-top: 20px;
    font-family: tahoma, sans-serif;
    line-height: 1.7;">
    <!--div style="float: left;margin-right:1%;width:44%;"-->

<div style="z-index:99;position: relative;"
id='dataTimeBalanceDir'
    class="datepicker-here"
    data-multiple-dates="31"
    data-multiple-dates-separator="; "
    data-date-format="dd/mm/yyyy"
    data-position='right top'>
</div>

<input type="hidden" name="multipleDate" id="multipleDateDir"value="<?=$multipleDate?>"/><!--/textarea-->
<input type="hidden" name="holydaysDate" id="holidaysDateDir"value="<?=$holidaysDate?>"/>

<input type="hidden" name="before_holidaysDate" id="before_holidaysDir"value="<?=$beforeDate?>"/>


<input type="hidden" name="perDateDir" id="perDateDir"value="<?=$perDate?>"/>
<input type="hidden" name="startDir" id="startDir"value="<?=$startDirJS?>"/>
<input type="hidden" name="endDir" id="endDir"value="<?=$endDirJS?>"/>
<div id="rrr">
     <br/> <span class="consnamered" >Фактично відпрацьований час: </span><!--input type="submit"   value="Готово" /-->
<br/>
    <span class="consname" >Кількість робочих днів у поточному місяці:</span> <span  id="CountDateDir" class="consinfo"><?=$CountDateDir?>;</span></div>

</form></div>


<div class="" style="padding-left:40%;margin-top:-395px;width:40%;"id="grafikDir">
			   <span class="name" >
	 </span>	<span class="info" style="padding:4px;">
</span></div>

</div>
</section>

<style>
    .table table tr td .clos{    display: block;
    height: 23px;    color: #cd1000;    font: 17px/22px FontAwesome;
        text-align: center;    text-decoration: none;}
        .inputout{       height: 20px;
        border: 1px solid #99b9da;    padding: 0 5px;    background: #fff;
        font: 14px Ubuntu;    color: #606060;    text-align: center;}
        .table table tr td .input{    width: 100%;    height: 20px;    border: 1px solid #99b9da;    padding: 0 5px;
        background: #fff;    font: 14px Ubuntu;    color: #606060;    text-align: center;}
</style>
<section class="section_edit ">
		<div class="bng_red">
			<div class="cont cont--small">
				<div class="box_flex box_flex--small">
					<div class="name"></div>
<div class="edit"><a href="" class="hiderKontrakt submit_btn" >Редагувати</a></div>
					<!--div class="edit"><a href="#" class="edit_btn hiderKontrakt">Редагуватиn</a></div-->
				</div>
			</div>
		</div>
		</section>
		<section class="section_edit consultant" style="background:#f8f8f8;padding-top:-30px;">

<div class="cont cont--small" >
			<div class="titleSmall">Відомості про фактичні умови оплати праці</div>
			<div class="table form_edit">
				<form method="post" action="/grafiks/boss_now/?id=<?=$id?>">
					<table>
						<thead>
							<tr>
							<th>Наявність контракту (так/ні)</th>
		<th>№ контракту/ № додаткової угоди</th>
		<th>Тривалість робочого дня</th>
		<th>Початкова дата періоду</th>
		<th>Кінцева дата періоду</th>
		<th>Оклад (грн.)</th>
		<th>Постійні доплати та надбавки (%)</th>
		<th>Премії (%)</th>
		<th class="">Заробітна плата</th>
		<th class="small"></th>
							</tr>
						</thead>
						<tbody class="editKontrakt1">

		<?
		$table1='<tr class = "gray">
		<td>Наявність контракту (так/ні)</td>
		<td>№ контракту/ № додаткової угоди</td>
		<td>Тривалість робочого дня</td>
		<td>Початкова дата періоду</td>
		<td>Кінцева дата періоду</td>
		<td>Оклад (грн.)</td>
		<td>Постійні доплати та надбавки (%)</td>
		<td>Премії (%)</td>
		<td>Заробітна плата</td>
	</tr>';


			foreach($data_boss_now as $now):
		if($now['check_contr']==1)$check_contr='Так';if($now['check_contr']==0)$check_contr='Ні';

?>  <tr><td >

			<?=$check_contr?>
		</td>
		<td >

		<div>	<?=$now['num_contr']?></div>
		</td>
		<td >

		<div>	<?=$now['duration']?></div>
		</td>
		<td >
		    <?=$now['period_start']?>
		</td>
		<td >
		    <?=$now['period_end']?>
		</td>
		<td >
		    <?=$now['oklad']?>
		</td>
		<td >
		    <?=$now['doplata']?>
		</td>
			<td >
		    <?=$now['premia']?>
		</td>
		<?$now['salary']=round($now['oklad']*(100+$now['doplata']+$now['premia'])/100*($now['duration']/8));?>
		<td >
		    <?=$now['salary']?>
		</td>
		<td class="small">
		    	<? if($_SESSION['status']<'4') {?><a href="/calculations/delposkontrakt/?id=<?=$now['id']?>&id_factory=<?=$id?>"
		    	onClick='return confirmDelete();' title="Видалити даний рядок" class="del clos fa-times">
			</a><?}?>

		</td></tr>

	<tr>

	<?$table1.='<tr><td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">

			'.$check_contr.'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">

			'.$now['num_contr'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">

			'.$now['duration'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['period_start'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['period_end'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['oklad'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['doplata'].'
		</td>
			<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['premia'].'
		</td>
		<td class="grey" style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">
		    '.$now['salary'].'
		</td></tr>';
	//var_dump((1+$now['doplata']+$now['premia']));
	endforeach;?>
</tbody>


<tbody class="editKontrakt hide" style="display:none;">
		<?$x=-1;	foreach($data_boss_now as $now):
		$x++;
?><input type = "hidden" name="id_id_boss[<?=$x?>]" value="<?=$now['id']?>">
    <tr><td >
        <?if($now['check_contr']=='0') {?>
<input type="checkbox" name="check_contr[<?=$x?>]" class="input"value="1">
<?}if($now['check_contr']=='1'){?>
<input type="checkbox" name="check_contr[<?=$x?>]" class="input"value="1" checked="checked">
<?}?>
		  </td>
		<td >
		    <input type = "text" name="num_contr[<?=$x?>]" class="input"value="<?=$now['num_contr']?>">
		</td>
		<td >
		    <input type = "text" name="duration[<?=$x?>]" class="input"value="<?=$now['duration']?>">
		</td>
		<td >
		    <input type = "text" class="date_kilkist input"  name="period_start[<?=$x?>]" value="<?=$now['period_start']?>">
		</td>
		<td >
		    <input type = "text" name="period_end[<?=$x?>]" class="datedirend input"value="<?=$now['period_end']?>">
		</td>
		<td >
		    <input type = "text" name="oklad[<?=$x?>]" class="input"value="<?=$now['oklad']?>">
		</td>
		<td >
		    <input type = "text" name="doplata[<?=$x?>]" class="input"value="<?=$now['doplata']?>">
		</td>
		<td >
		    <input type = "text" name="premia[<?=$x?>]" class="input"value="<?=$now['premia']?>">
		</td>
		<?$now['salary']=round($now['oklad']*(100+$now['doplata']+$now['premia'])/100);?>

		<td >
		    <input type = "text" name="salary[<?=$x?>]" class="input"value="<?=$now['salary']?>">
		</td>
		<td></td></tr>

	<tr>

	<?endforeach;$x++;?>
</tbody>

<tbody class="editKontrakt hide" style="display:none;">
	<input type = "hidden" name="id_id_boss[<?=$x?>]" value="new_row">
    <tr><td >

<input type="checkbox" name="check_contr[<?=$x?>]" class="input"value="1" checked="checked">

		  </td>
		  <td >
		    <input type = "text" name="num_contr[<?=$x?>]" class="input"value="">
		</td>
		<td >
		    <input type = "text" name="duration[<?=$x?>]" class="input"value="">
		</td>
		<td >
		    <input type = "text" class="date_kilkist input"  name="period_start[<?=$x?>]" value="">
		</td>
		<td >
		    <input type = "text" class="datedirend input" name="period_end[<?=$x?>]" value="">
		</td>
		<td >
		    <input type = "text" name="oklad[<?=$x?>]" class="input"value="">
		</td>
		<td >
		    <input type = "text" name="doplata[<?=$x?>]"class="input" value="">
		</td>
		<td >
		    <input type = "text" name="premia[<?=$x?>]" class="input"value="">
		</td>

		<td >
		    <input type = "text" name="salary[<?=$x?>]" class="input"value="">
		</td>
		<td></td></tr>

	<tr>

</tbody>
</table>
	 <span class="name editKontrakt" style="display:none;">ПІБ керівника:
		    <input type = "text" name="name" class="editKontrakt inputout" style="display:none;" value="<?=$data_boss_now[0]['name']?>" size='35'></span>

				<div class="submit editKontrakt"><input type="submit" value="зберегти" class="submit_btn"></div>
				</form>
			</div>
	<!--/div></section-->
<?if(($_SESSION['status']>'0') && ($_SESSION['status']<'4')){?>
<!--<div class="yacheika2kontrakt" style="float:left;position:absolute;top:37%;left:80%;">
<input type="submit" class="hiderKontrakt" value="Редагувати записи" />
</div>

<!--<div class="yacheika2kontrakt" style="float:left;position:absolute;top:40%;left:80%;">
<a href="#modalWindBoss" title=""><input type="button"  value="Створити новий запис" /></a>
</div>	-->
<?}?>
<!--a href = '/grafiks/pdf_1/?id=<?=$id?>'>1 </a-->
<a href="#modal" class="overlay" id="modalWindBoss"></a>
					<div class="popup_calculat" style="width:90%;">
	<section class="section_edit consultant" >

<div class="cont cont--small" >
			<div class="titleSmall">Введіть дані</div>
			<div class="table form_edit">
				<form action="/grafiks/insertboss/?id=<?=$id?>" method="POST">
					<table>
						<thead>
							<tr>
							    <th class="big">ПІБ керівника</th>
							<th>Наявність контракту (так/ні)</th>
		<th>№ контракту/ № додаткової угоди</th>
		<th>Тривалість робочого дня</th>
		<th>Початкова дата періоду</th>
		<th>Кінцева дата періоду</th>
		<th>Оклад (грн.)</th>
		<th>Постійні доплати та надбавки (%)</th>
		<th>Премії (%)</th>
		<th >Заробітна плата</th>

							</tr>
						</thead>

		<tbody>
	 <tr>
	     <td >
		    <input type = "text" name="name" class="input" value="<?=$data_boss_now[0]['name']?>" size='35'>
		</td>
		<td >

<input type="checkbox" name="check_contr" class="input" value="1" checked="checked">

		  </td>
		<td >
		    <input type = "text" name="num_contr"class="input" size='5'>
		</td>
		<td >
		    <input type = "text" name="duration" class="input" value="8"size='1'>
		</td>
		<td >
		    <input type = "text" id="kontrakt_kerivnika_data"  class="input" name="period_start"size='15'>
		</td>
		<td >
		    <input type = "text" class="datedirend input" name="period_end" value="теперішній час"size='15'>
		</td>
		<td >
		    <input type = "text" name="oklad"class="input"  value=""size='5'>
		</td>
		<td >
		    <input type = "text" name="doplata"class="input"  value=""size='2'>
		</td>
		<td >
		    <input type = "text" name="premia"class="input"  value=""size='2'>
		</td>
		<td >
		    <input type = "text" name="salary" class="input" value=""size='5'>
		</td></tr>

	<tr>

</tbody>
</table>
<div class="submitd "><input type="submit" name="insert" value="зберегти" class="submit_btn"></div>
				</form>
			</div>
</div></section>
<a class="close" href="#close"></a>
</div>





<?//font-family: Geneva, Arial, Helvetica, sans-serif; font-family: Georgia, 'Times New Roman', Times, serif;
/*if(($_SESSION['status']>'0') && ($_SESSION['status']<'4')){?>
<div  class="yacheika2kontrakt" style="float:left;position:absolute;top:42%;left:80%;font-size:100%;">

	<ul id="menu"  style="display:inline-block;font-size:170%;">
		<li>
			<a href="#"><input type="button"  value="Архів" /></a>
				<ul style="width:200px;font-size:12px;">
					<?foreach($data_boss_arhiv as $archive):?>
					<li>
						<a href="/grafiks/boss_archive/?archive_name=<?=$archive['name']?>&id=<?=$id?>" style="color:black;"><?=$archive['name']?> <?=$archive['period_start']?></a>
					</li>
					<?endforeach;?>
				</ul>
		</li>
	</ul>

</div>
			<?}*/?>


<script type="text/javascript">
		$('.datedirend').keyup(function(){
  var value = $(this).val();
  //$(this).value= $(this).value.replace(/[^\d\/|теперішній час]/g, '');
  value= value.replace(/[^\d\/|^теперішній час]/g, '');
  $(this).val(value);//console.log(value);
});


</script>

<div class="titleSmall" style="margin-top:25px;">Розрахунок галузевих гарантій оплати праці</div>
<div class="table">
				<table>
					<thead>
						<tr>
						    <th class="big">Період</th>
		<th>Розмір мінімальних державних гарантій для розрахунку (грн.) </th>
		<th>Коефіцієнт І розряду</th>
		<th>Коефіцієнт за посадою</th>
		<th>Коефіцієнт за видом робіт</th>
		<th>Територ. коефіцієнт</th>
		<th>Оклад (грн.)</th>
		<th>Постійні доплати та надбавки (%)</th>
		<th>Премії (%)</th>
		<th>Заробітна плата (грн.)</th>

    </tr>
   </thead>
					<tbody>

<?$table2.='<tr class="gray" style="font-size: 75%;">

		<td>Період</td>
		<td>Розмір мінімальних <br/>державних гарантій <br/>для розрахунку (грн.) </td>
		<td>Коефіцієнт І розряду</td>
		<td>Коефіцієнт за посадою</td>
		<td>Коефіцієнт за видом робіт</td>
		<td>Територ. коефіцієнт</td>
		<td>Оклад (грн.)</td>
		<td>Постійні доплати та надбавки (%)</td>
		<td>Премії (%)</td>
		<td>Заробітна плата (грн.)</td>

    </tr>
';
	$tarif= array(
	'1' => $sfera['teplo_date'],
	'2' => $sfera['vodo_date'],
	'3' => $sfera['tvp_date'],
	'4' => $sfera['zitlo_date'],
	'11' => $sfera['grom_trans_date'],
	'5' => $sfera['elevator_date'],
	'14' => $sfera['date_14'],
	'20' => $sfera['RPV_date'],
'27' => $sfera['blago_date']
);
$end_formula='';
$teplo ='';$vodo ='';$tvp ='';$zitlo =''; $elevator =''; $grom_trans=''; $month='';$day='';$year='';$min=0;
$last_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` ORDER BY `id` DESC limit  1");//ORDER BY `id` DESC limit  1
$endDir=$data_boss_now[count($data_boss_now)-1]['period_end'];
if($endDir=='теперішній час'&& date('d')!=='01' && date('m')!=='01') {$tarif_date=date('m').'/'.date('Y');$end_formula=date('d').'/'.date('m').'/'.date('Y');}
elseif($endDir=='теперішній час'&& date('d')=='01' && date('m')!=='01') {$m=(date('m')-1);if(strlen($m)==1)$m='0'.$m;
$tarif_date=$m.'/'.date('Y');
    $end_formula=$modelg->last_day($tarif_date).'/'.$tarif_date;//var_dump($tarif_date,$m,$kontrakt_data);

}
elseif($endDir=='теперішній час'&& date('d')=='01' && date('m')=='01') {$tarif_date='12/'.(date('Y')-1);
    $end_formula='31/'.$tarif_date;
}
elseif($endDir!=='теперішній час'&&$endDir!==''){$tarif_date=substr($endDir, 3);$end_formula=$endDir;}
//$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
$max_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
//

//var_dump($endDir,$kontrakt_data,$kontrakt_data0,$tarif_date,$end_formula);
if($kontrakt_data!='' ){//&& $kontrakt_zp!=''
list ( $day, $month,$year) = explode('/', $kontrakt_data0);
//$kontrakt_data=$month.'/'.$year;
$kerivnika_day=1-$day/30;
//$ker_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kontrakt_data'");
$minzp_ker = $db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id' ");

///////////////////////////////////
 $minzp_ker_sm = $db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id'   GROUP BY `zp` ");//AND `period` NOT LIKE '%2017%'
//if(empty($minzp_ker_sm))$minzp_ker_sm=$db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE  `id`='$ker_id'  AND `period` LIKE '%2017%' GROUP BY `zp` ");
if(empty($minzp_ker_sm))$minzp_ker_sm=$db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id'   GROUP BY `zp` ");
//var_dump($minzp_ker_sm,$max_id,$ker_id,'j');
///if($max_id==$ker_id)$minzp_ker_sm=$db->getRow("SELECT * FROM `zvit_1_min_zp`  WHERE `id`='$ker_id'    ");
//if(empty($minzp_ker_sm))
//$minzp_ker_sm=$db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`='$ker_id'  ");

$minzp_ker_small= array();$year_start0=substr($tab['data_obliku'],-4); $koef_posady_start = $koef_posady[$year_start0-1];
foreach ($koef_posady as $y=>$k){
if($k!==$koef_posady_start){ $step=$y+1;$minzp_ker_small[] = '01/'.$step;$koef_posady_start=$k;


}//var_dump($koef_posady,$step,$koef_posady_start,$k,$y);
    }
foreach($data_boss_now as $dbn){
 $dbn['period_start']=substr($dbn['period_start'], 3);//var_dump($dbn['period_start']);
$kk = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`=?s",$dbn['period_start']);
if($kk>=$ker_id) { //$step=$y+1;
  $minzp_ker_small[] = $dbn['period_start'];


}
}
    $idpduble = '.*';$countduble=-1;$flagduble=0;
foreach ($minzp_ker_sm as $p){$minzp_ker_small[] = $p['period'];
$countduble++;
     foreach ($data_boss_now  as $dbn):$idp=substr($dbn['period_start'], 0, 2);$idpp=substr($dbn['period_start'],3);
         if($idpp==$p['period'] && $idp>1 && $countduble>0){//var_dump($p['period']);
             $idpduble .=$p['period'].'.*|.*';$flagduble++;
         }
         endforeach;
}//var_dump($idpduble,$max_id,$ker_id);
$idp = '.*';foreach($minzp_ker_small as $v):$idp .=$v.'.*|.*';endforeach;$idp=substr($idp, 0, -3);
         $dd='SELECT * FROM `zvit_1_min_zp` WHERE `period` REGEXP "'.$idp.'" ORDER BY `id` ASC';
        $minzp_ker_small=$db->getAll ($dd);

   $idpduble=substr($idpduble, 0, -3);$minzp_ker_smallduble=array();
  if($flagduble>0) { $ddd='SELECT * FROM `zvit_1_min_zp` WHERE `period` REGEXP "'.$idpduble.'"  ORDER BY `id` ASC';$minzp_ker_smallduble=$db->getAll ($ddd);

$minzp_ker_small=array_merge($minzp_ker_small, $minzp_ker_smallduble);///////////////////////////////////
//var_dump($idpduble,$idp,$minzp_ker_smallduble);
foreach ($minzp_ker_small as $key => $row) {//var_dump($key,$row['id']);
    $volume[$key]  = $row['id'];
    }

// Сортируем данные по volume по убыванию и по edition по возрастанию
// Добавляем $data в качестве последнего параметра, для сортировки по общему ключу
array_multisort($volume,  SORT_ASC, $minzp_ker_small);
//var_dump($minzp_ker_small);
}//end $flagduble
//периоды дя босса и для мин. з/п
$minzp_ker_big= array();$period_boss_now = $db->getAll("SELECT `period_start`,`period_end`  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ORDER BY `id` ");

$idpduble = '.*';$countduble=-1;$flagduble=0;
foreach ($minzp_ker_sm as $p){
$countduble++;
     foreach ($data_boss_now  as $dbn):$idp=substr($dbn['period_start'], 0, 2);$idpp=substr($dbn['period_start'],3);
         if($idpp==$p['period'] && $idp>1 && $countduble>0){
             $idpduble .=$p['period'].'.*|.*';$flagduble++;
         }
         endforeach;
}
   $idpduble=substr($idpduble, 0, -3);$minzp_ker_bigduble=array();
  if($flagduble>0) { $ddd='SELECT * FROM `zvit_1_min_zp` WHERE `period` REGEXP "'.$idpduble.'"  ORDER BY `id` ASC';$minzp_ker_bigduble=$db->getAll ($ddd);}


foreach ($period_boss_now as $p){//$p['granica']=substr($p['period_start'], 0,2);
$p['period_start']=substr($p['period_start'], 3);//var_dump($p['granica']);
$kk = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`=?s",$p['period_start']);
if($kk>$ker_id) {$minzp_ker_big[] = $p['period_start'];}}//
foreach ($minzp_ker_small as $p){$minzp_ker_big[] = $p['period'];
}
$idp = '.*';foreach($minzp_ker_big as $v):$idp .=$v.'.*|.*';endforeach;$idp=substr($idp, 0, -3);
         $dd='SELECT * FROM `zvit_1_min_zp` WHERE `period` REGEXP "'.$idp.'" ORDER BY `id` ASC';
   $minzp_ker_biggest=$db->getAll ($dd);
   //foreach($minzp_ker_biggest as $mkb){
     //  $mkb['influacia']=1;
   //}
$minzp_ker_biggest=array_merge($minzp_ker_biggest, $minzp_ker_bigduble);///////////////////////////////////
//var_dump($minzp_ker_bigduble,$minzp_ker_biggestt,'oi');
foreach ($minzp_ker_biggest as $key => $row) {//var_dump($key,$row['id']);
    $volumebig[$key]  = $row['id'];
    }

// Сортируем данные по volume по убыванию и по edition по возрастанию
// Добавляем $data в качестве последнего параметра, для сортировки по общему ключу
array_multisort($volumebig,  SORT_ASC, $minzp_ker_biggest);
//var_dump($volumebig);
///////////////////////////////////
//var_dump($idp,$minzp_ker_biggest);

}else {//$minzp_ker= Array(  );$minzp_ker_small= Array(  ); data_obliku
echo "<p style='color:red;font-size:200%;'>Не вказана дата контракту керівника (початку дії галузевої угоди) </p>";
$kerivnika_day=1;
$ker_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
$minzp_ker = $db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id' ");
$minzp_ker_small = $db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id' GROUP BY `zp` ");
 $minzp_ker_biggest=$db->getAll("SELECT * FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$ker_id' GROUP BY `zp` ");
}
$aa=0;
/*foreach ($tarif as $sf=>$dt){
$diff_id=1;$dat='';var_dump($sf,$dt,$tab['sfera_'.$sf.''],$tab[''.$dt.'']);
if($tab['sfera_'.$sf.'']!='' && $tab[''.$dt.'']!=''){$dat=$tab[''.$dt.''];$aa++;}
if($dat!=''){
// разграничителями могут быть slash, dot или hyphen
list ( $day, $month,$year) = explode('/', $dat);
$dat=$month.'/'.$year;
//$dat = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$dat'");
//var_dump($dat,$min_zp);
//$min_zp =1450;
$min_id = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$dat'");

$diff_id=$last_id-$min_id;//var_dump($diff_id,$min,'klk');
if($min<$diff_id){
  $min=$diff_id;$tarif=$sf;//var_dump($min,$tarif,'min');
  $minzp3 = $db->getAll("SELECT `id`,`zp`,`period` FROM `zvit_1_min_zp`  WHERE `id`<='$max_id' AND `id`>='$min_id' ");}

}

}//endforeach
*/
//////if($tab['data_obliku']==''){$kontrakt_data=$dat;
//}
//var_dump($min,$tarif,$kerivnika_day);
if($shtat==0){$shtat=1;}
  if(!isset($minzp3))$minzp3=$minzp_ker;

///////////////////////////////////////////////

///////////////////////////////////////////////
  $granica_small=array();
  $count=-1;$size=count($minzp_ker_small);
  $perduble='';$period_boss_now2=$period_boss_now;
  $period_st='';  $period_ed='';
   //strtotime('01/12/2016');
 // var_dump('$rper',strtotime('01/12/2016'),$period_boss_now,$minzp_ker_small,'//');

   foreach (($minzp_ker_small)  as $zp):$count++;
   $granica_small[$count]['start']='01/01/2000';
 $granica_small[$count]['end']='31/01/2000';
//  $granica_small[$count]['start']='';
//  $granica_small[$count]['end']='';

 //var_dump('$per',$period_boss_now,$count);

foreach ($period_boss_now as $p){//var_dump($zp['period'],date('m').'/'.date('Y'));
$time_start=strtotime(substr($p['period_start'], 3,2).'/'.substr($p['period_start'], 0,2).'/'.substr($p['period_start'], 6,4));
$time_end=strtotime(substr($p['period_end'], 3,2).'/'.substr($p['period_end'], 0,2).'/'.substr($p['period_end'], 6,4));
//var_dump('$rr',$time_start,$p['period_start'],$time_end,$p['period_end']);
     $period_start=substr($p['period_start'], 3);//
     $period_end=substr($p['period_end'], 3);
     $period_start0=substr($p['period_start'], 0,2);//
     $period_end0=substr($p['period_end'], 0,2);
if($zp['period']==$period_start) $granica_small[$count]['start']=$p['period_start'];//substr($p['period_start'], 0,2);
if($zp['period']==$period_end && $p['period_end']!=='теперішній час') $granica_small[$count-1]['end']=$p['period_end'];
if($granica_small[0]['start']=='01/01/2000')$granica_small[0]['start']=$kontrakt_data0;
//var_dump($granica_small,$zp['period'],$perduble,'$perduble',$period_start,$period_end,$period_start0,$period_end0,$p['period_start'],$p['period_end'],'kkkk');
if($perduble!==''&&$perduble!==$zp['period']){//var_dump($count,'rt');
if($zp['period']==$period_start &&$period_start0>1) $granica_small[$count]['start']='01'.'/'.$zp['period'];//substr($p['period_start'], 0,2);
$zpid=$zp['id']-1;$kid0 = $db->getOne("SELECT `period` FROM `zvit_1_min_zp` WHERE `id`='$zpid'");
if($zp['period']==$period_end && $zp['period']!==$period_start&& $p['period_end']!=='теперішній час'&&$period_end0<$modelg->last_day($kid0))
$granica_small[$count-1]['end']=$modelg->last_day($kid0).'/'.$kid0;
if($zp['period']==$period_end && $zp['period']==$period_start && $p['period_end']!=='теперішній час'&&$period_end0<$modelg->last_day($kid0))
{///var_dump($granica_small,$perduble,$period_start,$period_end,$period_start0,$period_end0,$zp['period'],$p['period_start'],$p['period_end'],'kkkk5');
$granica_small[$count-1]['end']=$p['period_end'];}
// if($zp['period']==$period_end && $p['period_end']!=='теперішній час')
// {var_dump($granica_small,$perduble,$period_start,$period_end,$period_start0,$period_end0,$zp['period'],$p['period_start'],$p['period_end'],'kkkk5');
// $granica_small[$count-1]['end']=$p['period_end'];}
//$modelg->last_day($kid0).'/'.$zp['period'];
}
if( $p['period_end']=='теперішній час') {$dg=(date('d')-1);if(strlen($dg)==1)$dg='0'.$dg; $granica_small[$size-1]['end']=$dg.'/'.date('m').'/'.date('Y');}
if( $p['period_end']=='теперішній час'&& date('d')=='01') { $m=(date('m')-1);if(strlen($m)==1)$m='0'.$m;
$kid0=$m.'/'.date('Y'); $granica_small[$size-1]['end']=$modelg->last_day($kid0).'/'.$kid0;}
if( $p['period_end']=='теперішній час'&& date('d')=='01' && date('m')=='01') {  $granica_small[$size-1]['end']='31/12/'.(date('Y')-1);}

}$perduble=$zp['period'];
endforeach;

//var_dump($kontrakt_data0,$granica_small);
  $data_boss_now2=$data_boss_now;
  foreach ($data_boss_now  as $dbn):
     $kk0=substr($dbn['period_start'], 3);//$kk1=substr($data_boss_now[1]['period_start'], 3);
  $kid0 = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kk0'");
  if($dbn['period_end']!=='теперішній час') $kk_end=substr($dbn['period_end'], 3);//$kk1=substr($data_boss_now[1]['period_start'], 3);
  else $kk_end='';
  $kid_end = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kk_end'");
  //var_dump($kk0,$kid0,$kk_end,$kid_end);
  if($kid0<=$ker_id && ($kid_end>=$ker_id || $dbn['period_end']=='теперішній час'))//&& isset($data_boss_now[1]) &&
  {$data_boss_now_later=$dbn;$data_boss_now=$dbn;}

      endforeach;

$diff_kontrakt_all=$min_zp_potochniy=$oklad_dir_fact=0;
$koef_I_rozr=$koef_posada=1;
  // var_dump('select',$select);
$count=-1;
foreach (($minzp_ker_small)  as $zp): //array_reverse($minzp3)
 $min_zp=$zp['zp'];$count++;
 //=if(strpos($zp['period'],'2017'))$min_zp=1600;
 //$teplo_fop =0; $teplo_chiseln =0; $all_zarplata  =0; $all_dodatkova  =0; $all_oklad=0;
 $all_oklad=0;$all_fop=0;$dodatkova_sum=0;
    $oklad = 0; $dodatkova=0; $all_dodatkova=0; $zarplata=0;$all_zarplata=0;
    $oklad2=0; $dodatkova2=0; $all_dodatkova2=0; $zarplata2=0;$all_zarplata2=0;
$zpp=$zp["period"];

 $zpperiod=$last_period_view='';
 //var_dump('select',$oklad_dir,$kontrakt_zp,$diff_kontrakt,$diff_kontrakt_all);//}
if($count==0)$zpperiod=$kontrakt_data0; else $zpperiod='01/'.$zp['period'];
//if($tarif_date==$last_period)$last_period_view=$end_formula;
 $granica_end0=$granica_end=$granica_start0=$granica_start='';
  $granica_end0=substr($granica_small[$count]['end'], 0,2);$granica_end=substr($granica_small[$count]['end'], 3);
 $granica_start0=substr($granica_small[$count]['start'], 0,2);$granica_start=substr($granica_small[$count]['start'], 3);
if($granica_start0>1)$zpperiod=$granica_small[$count]['start'];

$databossnow = $db->getRow("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now'
AND `period_start` LIKE '%$zpp%'  ORDER BY `id` ");
$databossnow = $db->getRow("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now'
AND `period_start`='$zpperiod'  ORDER BY `id` ");
if(isset($databossnow))$data_boss_now=$databossnow;

  $oklad_off=0; $dodatkova_off=0; $all_dodatkova_off=0; $zarplata_off=0;$all_zarplata_off=0;
    $teplo = 0; $vodo = 0; $inshe = 0; $tvp = 0; $nevidm = 0; $jitlo = 0;
    $teplo_fop=0;$vodo_fop = 0; $inshe_fop = 0; $tvp_fop = 0; $nevidm_fop = 0; $jitlo_fop = 0;
    $teplo_fop_rob=0;$vodo_fop_rob = 0;  $tvp_fop_rob = 0; $nevidm_fop_rob = 0; $jitlo_fop_rob = 0;
    $teplo_fop_rob_off=0;$vodo_fop_rob_off = 0;  $tvp_fop_rob_off = 0; $nevidm_fop_rob_off = 0; $jitlo_fop_rob_off = 0;
      $chiselnist=0;$inshe_fop_rob = 0;$inshi_fop=0;$inshi=0;$inshi_fop_rob_off =0;$trans_fop_rob_off =0;$trans_fop_rob = 0;$trans_fop=0;
     $teplo_chiseln=0;$vodo_chiseln = 0; $tvp_chiseln = 0; $jitlo_chiseln = 0;$nevidm_off=0;$trans_chiseln = 0;
$teplo_itog=0;$vodo_itog=0;$tvp_itog=0;$jitlo_itog=0;$inshi_itog=0;$trans_itog=0;  $lift_itog=0;
$lift_fop=0;$lift_fop_rob_off=0; $lift_fop_rob=0;$lift_chiseln = 0;$oklad_dir=0;
$premia=0;

  //foreach($select as $d):
  //if ($d['type']==$group['group_type']) {
  //$q_heads = $data['quantity_heads'];
  if(isset($d)){
 if ($d['shtat_kilkist']=='') {$d['shtat_kilkist']='1';}

//oklad_fact
if($d['regional_koef_fact']==0) { $d['regional_koef_fact'] = 1; }
$oklad_fact = round($min_zp*$d['koef_I_rozr_fact']*$d['koef_posada_fact']*$d['koef_rob_prof_fact']*$d['regional_koef_fact']);
      $dodatkova_fact = $d['sumisnyk']+$d['EvNight']+round(($d['percent_input']+$d['zaohoch_percent'])*$oklad_fact/100)*$d['shtat_kilkist'];
      $oklad_dir_fact = round(($oklad_fact)*$d['shtat_kilkist']+$dodatkova_fact);
//var_dump($oklad_dir_fact,$d['percent_input'],$d['zaohoch_percent'],$oklad_fact,$dodatkova_fact);

        $year=substr($zp['period'],-4)-1;
        $koef_posada = $koef_posady[$year];//$d['koef_posada'];

    $koef_I_rozr=$d['koef_I_rozr'];//1.2;
    if ($d['koef_posada']=='0') {$koef_posada=1;}
$multi_koef=($koef_I_rozr*$koef_posada*$d['koef_rob_prof']*$regional_coef);
$multi_koef_fact=(1*$d['koef_I_rozr_fact']*$d['koef_posada_fact']*$d['koef_rob_prof_fact']*$d['regional_koef_fact']);

if( $multi_koef<$multi_koef_fact && $d['type']=='director' ){
//var_dump($multi_koef_fact,$multi_koef,$koef_posada);
$koef_posada=round(($multi_koef_fact/$multi_koef)*$koef_posada,2);}


        /*if($d['type']=='director' && $kontrakt!==0 ) {
      $oklad = $kontrakt;
      //$oklad_for_calc = $min_zp*1.2*$d['koef_posada']*$regional_coef;//для розрахунку окладу адміністрації пропорційно зарплати директора
      $dodatkova = round(($d['percent_input']+$d['zaohoch_percent'])*$oklad/100)*$d['shtat_kilkist'];//$dodatkova = $dodatkova_zp_kontrakt;
      $koef_posada_d = $koef_posada;
      }

    if($d['type']=='director' && $kontrakt==0 ) { */
       $oklad = round($min_zp*$koef_I_rozr*$koef_posada*$d['koef_rob_prof']*$regional_coef);
      $dodatkova = round(($d['percent_input']+$d['zaohoch_percent'])*$oklad/100);//}//

  //var_dump($oklad,$dodatkova,$oklad+$dodatkova);
$zarplata = round(($oklad)*$d['shtat_kilkist']+$dodatkova);
#####################$now['salary']=round($now['oklad']*(100+$now['doplata']+$now['premia'])/100);

//$oklad=$d['oklad']; $dodatkova=$d['dodatkova'];$zarplata=$d['fop'];
$tabCalcW= $db->getRow("SELECT * FROM `calculation_workers` WHERE `id_pidpriemstva`=?s",$_GET['id']);
$type="director";
$data['intensyvnist'] = array();$koef_posada_d =0;  $bottom=$zp['bottom'];$quantity_heads=0;
$group['group_name']='Керівники';$flag_procenta='';
$sumlinno=$db->getOne("SELECT `sumlinnyj` FROM `table_1` WHERE `id`=?s",$_GET['id']);
$d['koef_posada'] = $koef_posady[$year];$all_doplata=0;//var_dump($d,$d['koef_posada'],$d['koef_I_rozr'],$d['regional_koef_fact'],$d['koef_rob_prof']);
// if($d['koef_I_rozr']<=0)$d['koef_I_rozr']=1.2;
// if($d['regional_koef_fact']<=0)$d['regional_koef_fact']=1;
// if($d['koef_rob_prof']<=0)$d['koef_rob_prof']=1;var_dump($d['koef_posada'],$d['koef_I_rozr'],$d['regional_koef_fact'],$d['koef_rob_prof']);
include 'garantiiA_Head.php';
$premia=0;//$data_boss_now['premia'];//if($d['zaohoch_percent']>$premia && strpos($zp['period'],'2017') )$premia=$d['zaohoch_percent'];
$dodatkova=0;//$data_boss_now['doplata'];
if($percent_input>$dodatkova)$dodatkova=$percent_input;
#####################
//  $d['koef_rob_prof'] $d['regional_koef_fact']$koef_I_rozr.$koef_posada
 // var_dump($dodatkova,$zarplata,$oklad);
  //$premia=$d['zaohoch_percent'];//round($oklad*0.1*$d['shtat_kilkist']);
  //$dodatkova=$percent_input;//-=$premia;
  if($data_boss_now['duration']<=0)$data_boss_now['duration']=8;
 $duration=$data_boss_now['duration']/8;
 //var_dump($duration);
 $all_zarplata += $zarplata;$all_dodatkova += $dodatkova;$all_oklad += $oklad;

 $zarplata=round($duration*$oklad*$d['shtat_kilkist']*(100+$dodatkova+$premia)/100);
 $oklad*=$duration;
  }//isset $d
 $plus=$diff_kontrakt=0;$last_period='';$oklad_dir=$zarplata;
 foreach($minzp_ker as $ker)://=if(strpos($ker['period'],'2017'))$ker['zp']=1600;
 if($count+1<$size){$last_period_id=$minzp_ker_small[$count+1]['id']-1;//var_dump($last_period,$count,$size);
 $last_period = $db->getOne("SELECT `period` FROM `zvit_1_min_zp` WHERE `id`='$last_period_id'");}
 if($count+1==$size) {$last_period_id=$max_id;$last_period=$ker['period'];}


 if($ker['zp']==$min_zp && $ker['id']>=$zp['id'] && $ker['id']<=$last_period_id){//$plus++;$last_period=$ker['period'];
if($ker['id']==$ker_id){$diff_kontrakt+=round(($oklad_dir-$oklad_dir_fact)*($kerivnika_day));}
else $diff_kontrakt+=($oklad_dir-$oklad_dir_fact);

 }
 endforeach;
//var_dump($minzp_ker);
 //$diff_kontrakt=($oklad_dir-$kontrakt_zp)*$plus;
// if($zp['id']==$ker_id){$diff_kontrakt=round(($oklad_dir-$kontrakt_zp)*($plus-1+$kerivnika_day));}

$diff_kontrakt_all+=$diff_kontrakt;
 //var_dump('select',$oklad_dir,$kontrakt_zp,$diff_kontrakt,$diff_kontrakt_all);//}

$last_period_view=$modelg->last_day($last_period).'/'.$last_period;
if($granica_end0<$modelg->last_day($granica_end))$last_period_view=$granica_small[$count]['end'];



$table2.='<tr style="font-size: 75%;">

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$zpperiod.' - '.$last_period_view.'  </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$min_zp.' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$koef_I_rozr.' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$koef_posada.' </td>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$d['koef_rob_prof'].'</td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$d['regional_koef_fact'].' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$oklad.' </td>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$dodatkova.' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$premia.'  </td>


      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$zarplata.' </td>
      ';?>

    <tr >

      <td ><?=$zpperiod?> - <?=$last_period_view?> </td>
      <td ><?=$min_zp?> </td>
      <td ><?=$koef_I_rozr?> </td>
      <td ><?=$koef_posada?> </td>
      <td ><?=$d['koef_rob_prof']?> </td>
      <td ><?=$d['regional_koef_fact']?> </td>
      <td ><?=$oklad?> </td>

      <td ><?=$dodatkova?> </td>
      <td ><?=$premia?> </td>


      <td ><?=$zarplata?></td>
      <?
      $table.='<tr><td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$zp["period"].' - '.$last_period.' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$min_zp.' </td>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.round($diff_kontrakt).'</td>';

    //endforeach;


endforeach;?>


  <!--<tr style="background:rgba(205, 104, 57, 0.5);color:#1C1C1C;">
  <td></td>
  <td></td>
    <td></td>

    </tr> -->

</table>
</div>


<div class="titleSmall" style="margin-top:25px;">Розрахунок різниці (грн.) </strong> <span style="font-size: 75%;">*без врахування індексації та компенсації за порушення термінів виплати заробітної плати</span></div>

			<div class="table">
				<table>
					<thead>
						<tr>
							<th class="big">Період</th>
    <!--td>Розмір мінімальних <br/>державних гарантій <br/>для розрахунку (грн.) </td-->
    <!--td>Розмір окладу в контракті</td-->
    <!--td>Заробітна плата згідно контракту(грн.)</td-->
    <th>Нарахування згідно контракту (грн.)</th>
    <th>Нарахування згідно галузевих гарантій (грн.)</th>
    <th>Різниця між галузевими гарантіями та контрактом (грн.)</th>
    <th>Різниця наростаючим підсумком (грн.)</th>
    </tr>
    </thead>
					<tbody>

<?$table3.='<tr class="gray" style="font-size: 75%;">

    <td>Період</td>
    <td>Нарахування згідно <br/>контракту (грн.)</td>
    <td>Нарахування згідно <br/>галузевих гарантій (грн.)</td>
    <td>Різниця між галузевими гарантіями <br/>та контрактом (грн.)</td>
    <td>Різниця наростаючим <br/>підсумком (грн.)</td>
    </tr>';

$diff_kontrakt_all=$min_zp_potochniy=0;
  $oklad_dir_late=$oklad_dir;
  // var_dump('select',$oklad_dir);
  $i = 0;
  $k = 0;$count=-1;$size=count($minzp_ker_biggest);
/*  $kk0=substr($data_boss_now[0]['period_start'], 3);//$kk1=substr($data_boss_now[1]['period_start'], 3);
  $kid0 = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kk0'");
  if($kid0<=$ker_id )//&& isset($data_boss_now[1]) &&
  {$data_boss_now_later=$data_boss_now[0];$data_boss_now=$data_boss_now[0];}*/

  $granica=array();
  //$granica_start= $granica=1;

  $allFOP=0;//var_dump($data_boss_now,$data_boss_now_later,'kk');
  $perduble='';
  foreach (($minzp_ker_biggest)  as $zp):$count++;
   $granica[$count]['start']='01/01/2000';
 $granica[$count]['end']='31/01/2000';//var_dump($kontrakt_data0,$zp['period']);
foreach ($period_boss_now2 as $p){//var_dump($zp['period'],date('m').'/'.date('Y'));
     $period_start=substr($p['period_start'], 3);//
     $period_end=substr($p['period_end'], 3);
     $period_start0=substr($p['period_start'], 0,2);//
     $period_end0=substr($p['period_end'], 0,2);
if($zp['period']==$period_start) $granica[$count]['start']=$p['period_start'];//substr($p['period_start'], 0,2);
if($zp['period']==$period_end && $p['period_end']!=='теперішній час') $granica[$count-1]['end']=$p['period_end'];
//var_dump($perduble,$count,$zp['period'],$p['period_start'],$p['period_end']);
if($granica[0]['start']=='01/01/2000')$granica[0]['start']=$kontrakt_data0;
if($perduble!==''&&$perduble!==$zp['period']){//var_dump('$perduble');
if($zp['period']==$period_start &&$period_start0>1) $granica[$count]['start']='01'.'/'.$zp['period'];//substr($p['period_start'], 0,2);
$zpid=$zp['id']-1;$kid0 = $db->getOne("SELECT `period` FROM `zvit_1_min_zp` WHERE `id`='$zpid'");
if($zp['period']==$period_end && $p['period_end']!=='теперішній час'&&$period_end0<$modelg->last_day($kid0))
$granica[$count-1]['end']=$modelg->last_day($kid0).'/'.$kid0;
}if( $p['period_end']=='теперішній час') {$dg=(date('d')-1);if(strlen($dg)==1)$dg='0'.$dg; $granica[$size-1]['end']=$dg.'/'.date('m').'/'.date('Y');}
if( $p['period_end']=='теперішній час'&& date('d')==1) { $m=(date('m')-1);if(strlen($m)==1)$m='0'.$m;
$kid0=$m.'/'.date('Y');
//var_dump($kid0,$modelg->last_day($kid0));
    $granica[$size-1]['end']=$modelg->last_day($kid0).'/'.$kid0;}
if( $p['period_end']=='теперішній час'&& date('d')=='01' && date('m')=='01') {  $granica[$size-1]['end']='31/12/'.(date('Y')-1);}

}$perduble=$zp['period'];
endforeach;
//var_dump($minzp_ker_biggest,$granica,$period_start);
foreach ($data_boss_now2  as $dbn):
     $kk0=substr($dbn['period_start'], 3);//var_dump($kk0,$dbn['period_start']);//$kk1=substr($data_boss_now[1]['period_start'], 3);
  $kid0 = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kk0'");
  if($dbn['period_end']!=='теперішній час') $kk_end=substr($dbn['period_end'], 3);//$kk1=substr($data_boss_now[1]['period_start'], 3);
  else $kk_end='';
  $kid_end = $db->getOne("SELECT `id` FROM `zvit_1_min_zp` WHERE `period`='$kk_end'");
  //var_dump($kk0,$kid0,$kk_end,$kid_end);
  if($kid0<=$ker_id && ($kid_end>=$ker_id || $dbn['period_end']=='теперішній час'))//&& isset($data_boss_now[1]) &&
  {$data_boss_now_later=$dbn;$data_boss_now=$dbn;}

      endforeach;

$diff_garant_kontrakt_grafik=array();$days_balanse=array();$days_fact=array();$hours_fact=array();
$count=-1;
foreach (($minzp_ker_biggest)  as $zp): //array_reverse($minzp3)
$count++; $min_zp=$zp['zp'];
//= if(strpos($zp['period'],'2017'))$min_zp=1600;


 //$teplo_fop =0; $teplo_chiseln =0; $all_zarplata  =0; $all_dodatkova  =0; $all_oklad=0;
 $salaryboss=$salaryboss_garant=0;

 $zpp=$zp["period"];
 $zpperiod=$last_period_view='';
 //var_dump('select',$oklad_dir,$kontrakt_zp,$diff_kontrakt,$diff_kontrakt_all);//}
if($count==0)$zpperiod=$kontrakt_data0; else $zpperiod='01/'.$zp['period'];
//if($tarif_date==$last_period)$last_period_view=$end_formula;
 $granica_end0=$granica_end=$granica_start0=$granica_start='';
  $granica_end0=substr($granica[$count]['end'], 0,2);$granica_end=substr($granica[$count]['end'], 3);
 $granica_start0=substr($granica[$count]['start'], 0,2);$granica_start=substr($granica[$count]['start'], 3);
if($granica_start0>1)$zpperiod=$granica[$count]['start'];
//var_dump($granica_end0,$granica_end,$granica_start0,$granica_start);
$databossnow = $db->getRow("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now'
AND `period_start` LIKE '%$zpp%'  ORDER BY `id` ");
$databossnow = $db->getRow("SELECT *  FROM `boss` WHERE  `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now'
AND `period_start`='$zpperiod'  ORDER BY `id` ");

if(isset($databossnow))$data_boss_now=$databossnow;
///$data_boss_now['table_2']=$data_boss_now['table_3']='';
//var_dump($data_boss_now);

 $all_oklad=0;$all_fop=0;$dodatkova_sum=0;
    $oklad = 0; $dodatkova=0; $all_dodatkova=0; $zarplata=0;$all_zarplata=0;
    $oklad2=0; $dodatkova2=0; $all_dodatkova2=0; $zarplata2=0;$all_zarplata2=0;

  $oklad_off=0; $dodatkova_off=0; $all_dodatkova_off=0; $zarplata_off=0;$all_zarplata_off=0;
    $teplo = 0; $vodo = 0; $inshe = 0; $tvp = 0; $nevidm = 0; $jitlo = 0;
    $teplo_fop=0;$vodo_fop = 0; $inshe_fop = 0; $tvp_fop = 0; $nevidm_fop = 0; $jitlo_fop = 0;
    $teplo_fop_rob=0;$vodo_fop_rob = 0;  $tvp_fop_rob = 0; $nevidm_fop_rob = 0; $jitlo_fop_rob = 0;
    $teplo_fop_rob_off=0;$vodo_fop_rob_off = 0;  $tvp_fop_rob_off = 0; $nevidm_fop_rob_off = 0; $jitlo_fop_rob_off = 0;
      $chiselnist=0;$inshe_fop_rob = 0;$inshi_fop=0;$inshi=0;$inshi_fop_rob_off =0;$trans_fop_rob_off =0;$trans_fop_rob = 0;$trans_fop=0;
     $teplo_chiseln=0;$vodo_chiseln = 0; $tvp_chiseln = 0; $jitlo_chiseln = 0;$nevidm_off=0;$trans_chiseln = 0;
$teplo_itog=0;$vodo_itog=0;$tvp_itog=0;$jitlo_itog=0;$inshi_itog=0;$trans_itog=0;  $lift_itog=0;
$lift_fop=0;$lift_fop_rob_off=0; $lift_fop_rob=0;$lift_chiseln = 0;$oklad_dir=0;


  //foreach($select as $d):
  //if ($d['type']==$group['group_type']) {
  //$q_heads = $data['quantity_heads'];
  if(isset($d)){
 if ($d['shtat_kilkist']==''||$d['shtat_kilkist']==0) {$d['shtat_kilkist']='1';}

//oklad_fact
if($d['regional_koef_fact']==0) { $d['regional_koef_fact'] = 1; }
$oklad_fact = round($min_zp*$d['koef_I_rozr_fact']*$d['koef_posada_fact']*$d['koef_rob_prof_fact']*$d['regional_koef_fact']);
      $dodatkova_fact = $d['sumisnyk']+$d['EvNight']+round(($d['percent_input']+$d['zaohoch_percent'])*$oklad_fact/100)*$d['shtat_kilkist'];
      $oklad_dir_fact = round(($oklad_fact)*$d['shtat_kilkist']+$dodatkova_fact);
//var_dump($oklad_dir_fact,$d['percent_input'],$d['zaohoch_percent'],$oklad_fact,$dodatkova_fact);



        $year=substr($zp['period'],-4)-1;
        $koef_posada = $koef_posady[$year];//$d['koef_posada'];

    $koef_I_rozr=$d['koef_I_rozr'];//1.2;
    if ($d['koef_posada']=='0') {$koef_posada=1;}
$multi_koef=($koef_I_rozr*$koef_posada*$d['koef_rob_prof']*$regional_coef);
$multi_koef_fact=(1*$d['koef_I_rozr_fact']*$d['koef_posada_fact']*$d['koef_rob_prof_fact']*$d['regional_koef_fact']);

if( $multi_koef<$multi_koef_fact && $d['type']=='director' ){
//var_dump($multi_koef_fact,$multi_koef,$koef_posada);
$koef_posada=round(($multi_koef_fact/$multi_koef)*$koef_posada,2);}


        /*if($d['type']=='director' && $kontrakt!==0 ) {
      $oklad = $kontrakt;
      //$oklad_for_calc = $min_zp*1.2*$d['koef_posada']*$regional_coef;//для розрахунку окладу адміністрації пропорційно зарплати директора
      $dodatkova = round(($d['percent_input']+$d['zaohoch_percent'])*$oklad/100)*$d['shtat_kilkist'];//$dodatkova = $dodatkova_zp_kontrakt;
      $koef_posada_d = $koef_posada;
      }

    if($d['type']=='director' && $kontrakt==0 ) { */


    $i++;

    $kontrakt = $kontrakt * $i;

       $oklad = round($min_zp*$koef_I_rozr*$koef_posada*$d['koef_rob_prof']*$regional_coef);
      $dodatkova = round(($d['percent_input']+$d['zaohoch_percent'])*$oklad/100);//}//

  //var_dump($oklad,$dodatkova,$oklad+$dodatkova);
$zarplata = round(($oklad)*$d['shtat_kilkist']+$dodatkova);
#####################
//$oklad=$d['oklad']; $dodatkova=$d['dodatkova'];$zarplata=$d['fop'];
$tabCalcW= $db->getRow("SELECT * FROM `calculation_workers` WHERE `id_pidpriemstva`=?s",$_GET['id']);
$type="director";
$data['intensyvnist'] = array();$koef_posada_d =0;  $bottom=$zp['bottom'];$quantity_heads=0;
$group['group_name']='Керівники';$flag_procenta='';
$sumlinno=$db->getOne("SELECT `sumlinnyj` FROM `table_1` WHERE `id`=?s",$_GET['id']);
$d['koef_posada'] = $koef_posady[$year];$all_doplata=0;
include 'garantiiA_Head.php';
$premia=0;//$data_boss_now['premia'];//if($d['zaohoch_percent']>$premia && strpos($zp['period'],'2017'))$premia=$d['zaohoch_percent'];
$dodatkova=0;//$data_boss_now['doplata'];
if($percent_input>$dodatkova)$dodatkova=$percent_input;
#####################
//$premia=$d['zaohoch_percent']+$data_boss_now['premia'];
//$dodatkova=$percent_input+$data_boss_now['doplata'];

//
########################preemnik preemnik_days
  }
 //$all_zarplata += $zarplata;$all_dodatkova += $dodatkova;$all_oklad += $oklad;
 if($data_boss_now['duration']<=0)$data_boss_now['duration']=8;
 $duration=$data_boss_now['duration']/8;


  $zarplata=round($oklad*$duration*$d['shtat_kilkist']*(100+$dodatkova+$premia)/100);


 $plus=$diff_kontrakt=0;$last_period='';$oklad_dir=$zarplata;
 $data_boss_now['salary']=round($data_boss_now['oklad']*$duration*(100+$data_boss_now['doplata']+$data_boss_now['premia'])/100);
 if($data_boss_now['salary']==0)$data_boss_now['salary']=round($data_boss_now['oklad']*$duration);
 $diff_garant_kontrakt = $zarplata - ($data_boss_now['salary']);//var_dump($diff_garant_kontrakt);
 foreach($minzp_ker as $ker):
     //var_dump($ker['id'],$ker['period']);
     $granica_end0=$granica_end=$granica_start0=$granica_start='';
        //=if(strpos($ker['period'],'2017'))$ker['zp']=1600;

        //var_dump($diff_garant_kontrakt_grafik[$ker['period']],$ker['period']);
       if(!isset($diff_garant_kontrakt_grafik[$ker['period']])) $diff_garant_kontrakt_grafik[$ker['period']]=0;
       //$days_balanse=array();
       if(!isset($days_balanse[$ker['period']])) $days_balanse[$ker['period']]=0;
       if(!isset($days_fact[$ker['period']])) $days_fact[$ker['period']]=0;
       if(!isset($hours_fact[$ker['period']])) $hours_fact[$ker['period']]=0;//$data_boss_now['duration']


 if($count+1<$size){$last_period_id=$minzp_ker_biggest[$count+1]['id']-1;

  $granica_end0=substr($granica[$count]['end'], 0,2);$granica_end=substr($granica[$count]['end'], 3);
 $granica_start0=substr($granica[$count]['start'], 0,2);$granica_start=substr($granica[$count]['start'], 3);

 if($granica_end0<$modelg->last_day($granica_end)){$last_period_id=$minzp_ker_biggest[$count+1]['id'];}
 $last_period = $db->getOne("SELECT `period` FROM `zvit_1_min_zp` WHERE `id`='$last_period_id'");

 }
 if($count+1==$size) { $granica_end0=substr($granica[$count]['end'], 0,2);$granica_end=substr($granica[$count]['end'], 3);
 $granica_start0=substr($granica[$count]['start'], 0,2);$granica_start=substr($granica[$count]['start'], 3);
 //var_dump($granica_end0,$granica_start0,$granica_end,$granica_start,$ker['period'],'w2');
 $last_period_id=$max_id;$last_period=$ker['period'];}

  if($ker['zp']==$min_zp  && $ker['id']>=$zp['id'] && $ker['id']<=$last_period_id){ //if($ker['id']!==$ker_id)$plus++;

 //var_dump('ee',$count,$granica[$count]['end'],'k',$granica_end,$granica_end0,'ll');
 /*if($granica_end0<$modelg->last_day($granica_end)){
     $work_days_director=$ker['work_director'];
 }*/
 /////////////////////////////////////IF
/*///if($ker['id']==$ker_id){//$diff_kontrakt+=round(($oklad_dir-$oklad_dir_fact)*($kerivnika_day));
$real=1;
$preemnik=$db->getOne("SELECT `preemnik_days` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_days_director_real=$db->getOne("SELECT `work_days_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
if($preemnik>0){$real=$preemnik/$ker['work_days_director'];$days_balanse[$ker['period']]+=$ker['work_days_director'];$days_fact[$ker['period']]+=$preemnik;}
elseif($work_days_director_real>0) {$real=$work_days_director_real/$ker['work_days_director'];
//var_dump('ee2');
$to=substr($kontrakt_data0, 0,2);
$work_list_director=$ker['work_director'];
$to_days=0;
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr>=$to){$to_days++;}
}
$days_balanse[$ker['period']]+=$to_days;$days_fact[$ker['period']]+=$work_days_director_real;}
else {$to=substr($kontrakt_data0, 0,2);//$kerivnika_day
//var_dump('ee');
  $preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$to_days_real=$to_days=0;
foreach($work_list_director_real as $wr){
    $wr=substr($wr, 0,2);if($wr>=$to){$to_days_real++;}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr>=$to){$to_days++;}
}
if($to_days_real==0)$to_days_real=$to_days;
$days_balanse[$ker['period']]+=$to_days;$days_fact[$ker['period']]+=$to_days_real;
$real_locale_to=$to_days_real/$to_days;
$kerivnika_day=$to_days/$ker['work_days_director'];
//$real=$real_locale_to*$real_locales_to;
//var_dump($to_days,$to,'jj',$ker['period'],$real,$real_locale_to,$kerivnika_day,$ker['work_days_director']);

    $real=$kerivnika_day;//$work_days_director_real/$ker['work_days_director'];
}/////end $kerivnika_day;
if($real==0 ){$real=1;$days_balanse[$ker['period']]+=$ker['work_days_director'];$days_fact[$ker['period']]+=$ker['work_days_director'];}

//var_dump($granica_end0,$granica_start0,$ker['period'],'w1');
 if($granica_end0<$modelg->last_day($granica_end) && $ker['period']==$granica_end){$to=$granica_end0;//var_dump('to1');
  $preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$to_days_real=$to_days=0;
foreach($work_list_director_real as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to){$to_days_real++;}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to){$to_days++;}
}

$days_balanse[$ker['period']]=$days_fact[$ker['period']]=0;
$days_balanse[$ker['period']]+=$to_days;$days_fact[$ker['period']]+=$to_days_real;
$real_locale_to=$to_days_real/$to_days;
$real_locales_to=$to_days/$work_days_director;
$real=$real_locale_to*$real_locales_to;
//var_dump($to_days_real,$to,'jj',$ker['period'],$real,$real_locale_to,$real_locales_to,$work_days_director);
 }//end $granica[$count]['end']

//
   //var_dump($work_days_director_real,$preemnik,$real,$kerivnika_day,$ker['work_days_director'],'rr0');
   $allFOP+=round($diff_garant_kontrakt*$real);
    $salaryboss+=$data_boss_now['salary']*$real;
    $salaryboss_garant+=$zarplata*$real;
    $diff_garant_kontrakt_grafik[$ker['period']]+=round($diff_garant_kontrakt*$real);
 //   var_dump($salaryboss_garant,$zarplata,$oklad,$d['shtat_kilkist'],$dodatkova);
}
/////////////////////////////////////////////////////////////ELSE
else */
{ //$diff_kontrakt+=1*($oklad_dir-$oklad_dir_fact);
//var_dump($granica_start,$granica_end,$ker['period'],'oo');
 //var_dump($granica_start0,$granica_start,$granica_end);
 if($granica_start0>1 && $ker['period']==$granica_start && $granica_start!==$granica_end){$from=$granica_start0;//var_dump('to21');
 //var_dump($granica_start,$granica_end,$ker['period'],$from,'gg31');
 $preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU` LIKE '%?i%' AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
//var_dump('ju',$work_list_director_real,$sfera['EDRPOU'],$ker['period']);
if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$from_days_real=$from_days=0;
$work_days_director=$ker['work_days_director'];//var_dump($work_list_director_real,$wr,'ff');
foreach($work_list_director_real as $wr){
    $wr=substr($wr, 0,2);
    if($wr>=$from){$from_days_real++;}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr>=$from){$from_days++;}
}
//before_holydays
$bhh=0;
if($ker['before_holydays']!==''&& $data_boss_now['duration']>=8){
$bh=explode('; ', $ker['before_holydays']);
foreach($bh as $wr){
    $wr=substr($wr, 0,2);if($wr>=$from){$bhh++;}
}
}
//$days_balanse[$ker['period']]=$days_fact[$ker['period']]=0;
$days_balanse[$ker['period']]+=$from_days;$days_fact[$ker['period']]+=$from_days_real;
$hours_fact[$ker['period']]+=($from_days_real*$data_boss_now['duration']-$bhh);
$real_locale=$from_days_real/$from_days;
$real_locales=$from_days/$work_days_director;
$real=$real_locale*$real_locales;
//if($work_list_director_real[0]==''){$real=$real_locales_to;$days_fact[$ker['period']]+=$to_days;$hours_fact[$ker['period']]+=$to_days*$data_boss_now['duration'];}
//1741
//var_dump($from_days_real,$from_days,$from,$work_days_director,'jj',$hours_fact[$ker['period']],$days_fact[$ker['period']],$ker['period'],$real,$real_locale,$real_locales,'kkkk', $from_days_real,$from_days,$real_locale,$data_boss_now['salary'],$real,$zarplata);
 }///////////////////////////end $granica[$count]['start']
 elseif($granica_start0>1 && $ker['period']==$granica_start && $granica_start==$granica_end){$from=$granica_start0;
 //var_dump('to219');
 //var_dump($granica_start,$granica_end,$ker['period'],$from,'gg319');
 $preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$from_days_real=$from_days=0;
$work_days_director=$ker['work_days_director'];
foreach($work_list_director_real as $wr){
    $wr=substr($wr, 0,2);if($wr>=$from){$from_days_real++;}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr>=$from){$from_days++;}
}
//before_holydays
$bhh=0;
if($ker['before_holydays']!==''&& $data_boss_now['duration']>=8){
$bh=explode('; ', $ker['before_holydays']);
foreach($bh as $wr){
    $wr=substr($wr, 0,2);if($wr>=$from){$bhh++;}
}
}
//$days_balanse[$ker['period']]=$days_fact[$ker['period']]=0;
$days_balanse[$ker['period']]+=$from_days;$days_fact[$ker['period']]+=$from_days_real;
$hours_fact[$ker['period']]+=($from_days_real*$data_boss_now['duration']-$bhh);
$real_locale=$from_days_real/$from_days;
$real_locales=$from_days/$work_days_director;
$real=$real_locale*$real_locales;
//if($work_list_director_real[0]==''){$real=$real_locales_to;$days_fact[$ker['period']]+=$to_days;$hours_fact[$ker['period']]+=$to_days*$data_boss_now['duration'];}
//1741
//var_dump($from_days_real,$from_days,$from,$work_days_director,'jj',$hours_fact[$ker['period']],$days_fact[$ker['period']],$ker['period'],$real,$real_locale,$real_locales);
 }///////////////////////////end $granica[$count]['start']

 elseif($granica_end0<$modelg->last_day($granica_end) && $ker['period']==$granica_end && $granica_start!==$granica_end){$to=$granica_end0;//var_dump('to2');
 //var_dump($ker['period'],'gg32');
$preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$null_day= $db->getOne("SELECT `null_day` FROM `table_2` WHERE  `EDRPOU`=?i AND  `period`=?s  ",$sfera['EDRPOU'],$ker['period']);

if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$to_days_real=$to_days=0;
$work_days_director=$ker['work_days_director'];
foreach($work_list_director_real as $wr){//var_dump($wr,'oo',$to_days_real);
  if($wr!==''){  $wr=substr($wr, 0,2);if($wr<=$to){$to_days_real++;}}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to){$to_days++;}
}
//before_holydays
$bhh=0;
if($ker['before_holydays']!==''&& $data_boss_now['duration']>=8){
$bh=explode('; ', $ker['before_holydays']);
foreach($bh as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to){$bhh++;}
}
}
//$days_balanse[$ker['period']]=$days_fact[$ker['period']]=0;
$days_balanse[$ker['period']]+=$to_days;$days_fact[$ker['period']]+=$to_days_real;$hours_fact[$ker['period']]+=($to_days_real*$data_boss_now['duration']-$bhh);
$real_locale_to=$to_days_real/$to_days;
$real_locales_to=$to_days/$work_days_director;
$real=$real_locale_to*$real_locales_to;
//var_dump($work_list_director_real,$null_day,$sfera['EDRPOU'],$ker['period'],'ss');
if($work_list_director_real[0]==''&&$null_day==0){$real=$real_locales_to;$days_fact[$ker['period']]+=$to_days;$hours_fact[$ker['period']]+=($to_days*$data_boss_now['duration']-$bhh);}
//var_dump($work_list_director_real,$to_days_real,$data_boss_now['duration'],'jj',$to_days,$to,$work_days_director,'j4j',$hours_fact[$ker['period']],$days_fact[$ker['period']],$ker['period'],$real,$real_locale_to,$real_locales_to,$work_days_director);
 }//////////////////////end $granica[$count]['end']

  elseif($granica_end0<$modelg->last_day($granica_end) && $ker['period']==$granica_end &&$granica_start0>=1 && $granica_end==$granica_start){$to=$granica_end0;//var_dump('to2');
$from=$granica_start0;
 //var_dump($from,$to,$ker['period'],'gg333');
$preemnik_list=$db->getOne("SELECT `preemnik` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$work_list_director_real=$db->getOne("SELECT `work_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
$null_day= $db->getOne("SELECT `null_day` FROM `table_2` WHERE  `EDRPOU`=?i AND  `period`=?s  ",$sfera['EDRPOU'],$ker['period']);
if($preemnik_list!=='' && $work_list_director_real!=='')$work_list_director_real=$preemnik_list;
$work_list_director=$ker['work_director'];
$work_list_director_real=explode('; ', $work_list_director_real);
$to_days_real=$to_days=0;
$work_days_director=$ker['work_days_director'];
foreach($work_list_director_real as $wr){//var_dump($wr,'oo',$to_days_real);
  if($wr!==''){  $wr=substr($wr, 0,2);if($wr<=$to && $wr>=$from){$to_days_real++;}}
}
$work_list_director=explode('; ', $work_list_director);
foreach($work_list_director as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to && $wr>=$from){$to_days++;}
}
//before_holydays
$bhh=0;
if($ker['before_holydays']!==''&& $data_boss_now['duration']>=8){
$bh=explode('; ', $ker['before_holydays']);
foreach($bh as $wr){
    $wr=substr($wr, 0,2);if($wr<=$to && $wr>=$from){$bhh++;}
}
}
//$days_balanse[$ker['period']]=$days_fact[$ker['period']]=0;
$days_balanse[$ker['period']]+=$to_days;$days_fact[$ker['period']]+=$to_days_real;$hours_fact[$ker['period']]+=($to_days_real*$data_boss_now['duration']-$bhh);
$real_locale_to=$to_days_real/$to_days;
$real_locales_to=$to_days/$work_days_director;
$real=$real_locale_to*$real_locales_to;
//var_dump($work_list_director_real,$null_day,$sfera['EDRPOU'],$ker['period'],'3ss');
if($work_list_director_real[0]=='' &&$null_day==0){$real=$real_locales_to;$days_fact[$ker['period']]+=$to_days;$hours_fact[$ker['period']]+=($to_days*$data_boss_now['duration']-$bhh);}
//var_dump($work_list_director_real,$to_days_real,$to_days,$to,$work_days_director,'j4j',$days_balanse[$ker['period']],$days_fact[$ker['period']],$ker['period'],$real,$real_locale_to,$real_locales_to,$work_days_director);
 }

else{//var_dump($ker['period'],'gg3v');
$preemnik=$db->getOne("SELECT `preemnik_days` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
    $work_days_director_real=$db->getOne("SELECT `work_days_director` FROM `table_2` WHERE `EDRPOU`=?s AND `period`=?s ",$sfera['EDRPOU'],$ker['period']);
  $null_day= $db->getOne("SELECT `null_day` FROM `table_2` WHERE  `EDRPOU`=?i AND  `period`=?s  ",$sfera['EDRPOU'],$ker['period']);
  if($preemnik>0 && $work_days_director_real>0)$work_days_director_real=$preemnik;
  //$work_days_director=$db->getOne("SELECT `work_days_director` FROM `zvit_1_min_zp` WHERE `period`=?s ",$ker['period']);
  $work_days_director=$ker['work_days_director'];
  //before_holydays
$bhh=0;
if($ker['before_holydays']!==''&& $data_boss_now['duration']>=8){$bhh= $ker['before_days_holydays'];}
  $days_balanse[$ker['period']]+=$ker['work_days_director'];$days_fact[$ker['period']]+=$work_days_director_real;
  $hours_fact[$ker['period']]+=($work_days_director_real*$data_boss_now['duration']-$bhh);
 // var_dump($work_days_director_real,$null_day,$work_days_director,$days_fact[$ker['period']],$hours_fact[$ker['period']], $ker['period'],'rr');
 $real=$work_days_director_real/$work_days_director;
 if($real==0 &&$work_days_director_real==0 &&$null_day==0){$real=1;$days_fact[$ker['period']]+=$ker['work_days_director'];
     $hours_fact[$ker['period']]+=($ker['work_days_director']*$data_boss_now['duration']-$bhh);
 }

}
///////if($work_days_director_real==0) $work_days_director_real=$work_days_director;

//var_dump($bhh,$real,'rr2');
if($bhh>0){////$real=$real-$bhh/($hours_fact[$ker['period']]+$bhh);
//var_dump($bhh,$ker['period'],$hours_fact[$ker['period']],$real,'rr6');
    }

$allFOP+=round($diff_garant_kontrakt*$real);
    $salaryboss+=round($data_boss_now['salary']*$real);
    $salaryboss_garant+=round($zarplata*$real);
    $diff_garant_kontrakt_grafik[$ker['period']]+=round($diff_garant_kontrakt*$real);
   // var_dump('ff',$allFOP,$diff_garant_kontrakt_grafik[$ker['period']],$ker['period']);
}
 }//var_dump('ll',$salaryboss,$salaryboss_garant,$allFOP,$diff_garant_kontrakt);

 endforeach;



 //$diff_kontrakt=($oklad_dir-$kontrakt_zp)*$plus;
// if($zp['id']==$ker_id){$diff_kontrakt=round(($oklad_dir-$kontrakt_zp)*($plus-1+$kerivnika_day));}

$diff_kontrakt_all+=$diff_kontrakt;

//$zpperiod=$last_period_view='';
$period_start=substr($data_boss_now['period_start'], 3);
//var_dump($last_period_view,$granica[$count]['end'],$zp['period']);
 //var_dump($salaryboss,$salaryboss_garant,$oklad_dir,$diff_kontrakt,$diff_kontrakt_all);//}
//if($count==0)$zpperiod=$kontrakt_data0;
//elseif($period_start==$zp['period'])$zpperiod=$data_boss_now['period_start'];
//else $zpperiod='01/'.$zp['period'];
$last_period_view=$modelg->last_day($last_period).'/'.$last_period;
if($granica_end0<$modelg->last_day($granica_end))$last_period_view=$granica[$count]['end'];
//if($tarif_date==$last_period)$last_period_view=$end_formula;

$table3.='<tr>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$zpperiod.' - '.$last_period_view.'  </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.round($salaryboss).' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.round($salaryboss_garant).' </td>
      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.round($salaryboss_garant-$salaryboss).' </td>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.($allFOP).'</td>';
?>

    <tr>

      <td ><?=$zpperiod?> - <?=$last_period_view?>  </td>
      <!--td ><?=$data_boss_now['salary']?> </td-->
      <td ><?=round($salaryboss)?> </td>
      <td ><?=round($salaryboss_garant)?> </td>
      <td ><?=round($salaryboss_garant-$salaryboss)?> </td>

      <td ><?=($allFOP)?></td>
      <?
      $table.='<tr><td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$zp["period"].' - '.$last_period.' </td><td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.$min_zp.' </td>

      <td style="background:rgba(185, 211, 238 ,0.6);text-align:center;color:#1C1C1C;">'.round($diff_kontrakt).'</td>';

    //endforeach;


endforeach;?>

<!--<tr style="background:rgba(205, 104, 57, 0.5);color:#1C1C1C;">
  <td>ВСЬОГО </td>
  <td></td>
    <td><b>  <?=round($diff_kontrakt_all)?>    </b></td>

    </tr>
  <tr style="background:rgba(205, 104, 57, 0.5);color:#1C1C1C;">
  <td></td>
  <td></td>
    <td></td>-->

    </tr>


					</tbody>
				</table>
			</div>

			<div style="margin-top:50px;font-weight:bolder;padding-left:30px;width:25%;color:#fff;min-height:100px;"> </div>

</div></section>
<?


?>
<?
$table.='<tr style="background:rgba(205, 104, 57, 0.5);color:#1C1C1C;">
  <td>ВСЬОГО </td><td></td>
    <td><b>'.round($diff_kontrakt_all).'   </b></td>

    </tr>
</table>';


$db->query('UPDATE table_1 SET `table`=?s,difference=?s WHERE id=?i',$table,round($diff_kontrakt_all),$_GET['id']);
$db->query("UPDATE `boss` SET `table_2`='$table2' WHERE `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ");
$db->query("UPDATE `boss` SET `table_3`='$table3' WHERE `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ");
$db->query("UPDATE `boss` SET `table_1`='$table1',`difference_all`='$allFOP',`oklad_garant_late`='$oklad_dir_late', `days_balanse`=?s,`days_fact`=?s  WHERE `id_pidpriemstva`='$id'  AND `name`='$pib_boss_now' ",array_sum($days_balanse),array_sum($days_fact));

//style="position:absolute;left:48%;top:115%;padding:4px 14px;"
	?>
	<div id="rrr1" >
<span class="consname">Кількість робочих днів всього </span><span class="consinfo"><?=array_sum($days_balanse)?>;</span> <br/>
<span class="consname">Фактично відпрацьовані дні/години </span><span class="consinfo"><?=array_sum($days_fact)?>/<?=array_sum($hours_fact)?>;</span>
</div>
<?//var_dump($allFOP,$oklad_dir,array_sum($days_balanse),array_sum($days_fact));
//var_dump($hours_fact,$days_balanse,$days_fact,$kontrakt_data0,$diff_garant_kontrakt_grafik);
if(date('d')!=='01'){
$fruit = array_pop($diff_garant_kontrakt_grafik);$fruit1 = array_pop($minzp_ker);}
//var_dump(date('d'),$kontrakt_data0,$diff_garant_kontrakt_grafik,$minzp_ker);
//$diff_garant_kontrakt_grafik['08/2017']=0;$diff_garant_kontrakt_grafik['09/2017']=0;
/* Подключаем классы 1*/
  require_once 'js/pChart/pChart/pData.class';
  require_once 'js/pChart/pChart/pChart.class';
  $DataSet = new pData(); // Создаём объект pData
$count=-1;

if(count($diff_garant_kontrakt_grafik)>1){
//var_dump($diff_garant_kontrakt_grafik);
//$dfd=array(110, 1, 8, 27, 64, 125, 216, 343, 512, 729, 1000,110, 1, 8, 27, 64, 125, 216, 343, 512);
$DataSet->AddPoint($diff_garant_kontrakt_grafik, "SerieA");
 // $DataSet->AddPoint(array(110, 1, 8, 27, 64, 125, 216, 343, 512, 729, 1000), "Serie2"); // Загружаем данные графика 2
  $DataSet->AddAllSeries(); // Добавить все данные для построения
  $DataSet->SetXAxisName("Місяць");
  $DataSet->SetYAxisName("Різниця (грн.)");
   //$DataSet->SetYAxisUnit("тис. грн.");
  $DataSet->SetSerieName("Різниця (грн.)","SerieA");
 //$DataSet->SetSerieName("","id");
 //$DataSet->SetSerieSymbol("id","");

  $Test = new pChart(700, 400); // Рисуем графическую плоскость//создаем место для график шириной в 800 и высотой в 300 px
  $Test->setFontProperties('js/pChart/Fonts/UbuntuRegular.ttf', 12); // Установка шрифта
//координаты левой верхней вершины и правой нижней
//вершины графика
  $Test->setGraphArea(120, 60, 585, 250); // Установка области графика
  $Test->drawFilledRoundedRectangle(7, 7, 663, 370, 5, 0, 81, 163); // Выделяем плоскость прямоугольником185, 211, 238 ,0.6 blue
  ///$Test->drawRoundedRectangle(355, 5, 1025, 335, 5, 330, 330, 330); // Делаем контур графической плоскости
  $Test->drawGraphArea(255, 255, 255, true); // Рисуем графическую плоскость
  $Test->setColorPalette(0,205, 16, 0);//color 0 line (red)
 // $Test->drawLegend(890,60,$DataSet->GetDataDescription(),0, 81, 163,-1,-1,-1,255,255,255,false);
  //drawLegend($XPos,$YPos,$DataDescription,$R,$G,$B,$Rs=-1,$Gs=-1,$Bs=-1,$Rt=0,$Gt=0,$Bt=0,$Border=FALSE)
  //var_dump($kontrakt_data0,$count);//array_reverse($minzp3));
  foreach (($minzp_ker)  as $zp){ //array_reverse
   $count++;
  if($count==0)$zp['period']=$kontrakt_data0; else $zp['period']='01/'.$zp['period'];
   $DataSet->AddPoint(' '.$zp['period'], "id");//XAxis
    }
    //устанавливаем точки с датами
//на ось абсцисс
$DataSet->SetAbsciseLabelSerie("id");
  $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 255, 255, 255, true, 90, 2); // Рисуем оси и график
  $Test->drawGrid(1, false, 0, 81, 163, 25); // Рисуем сетку

  $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription()); // Соединяем точки графика линиями
  $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(), 3, 2, 205, 16, 0); // Рисуем точки
  $Test->drawTitle(5, 42, 'Різниця між галузевими гарантіями та фактичними умовами оплати праці (грн.)', 255,255,255, 685); // Выводим заголовок графика

 //$Test->Stroke(); // Выводим график в окно браузера;
 $go=   'uploaded/grafiks/grafiks_zp_'.$id.''.uniqid().'.png';
// $go1=   '/uploaded/grafiks/grafiks_zp_'.$id.'.png';
 $Test->Render($go);

//var_dump($go);//'.uniqid().'
}else{
 $Test = new pChart(700, 400); // Рисуем графическую плоскость//создаем место для график шириной в 800 и высотой в 300 px
  $Test->setFontProperties('js/pChart/Fonts/UbuntuRegular.ttf', 12); // Установка шрифта
//координаты левой верхней вершины и правой нижней
//вершины графика
  $Test->setGraphArea(120, 60, 585, 250); // Установка области графика
  //$Test->drawFilledRoundedRectangle(7, 7, 663, 370, 5, 0, 81, 163); // Выделяем плоскость прямоугольником185, 211, 238 ,0.6 blue
  ///$Test->drawRoundedRectangle(355, 5, 1025, 335, 5, 330, 330, 330); // Делаем контур графической плоскости
 // $Test->drawGraphArea(255, 255, 255, true); // Рисуем графическую плоскость
 // $Test->setColorPalette(0,205, 16, 0);//color 0 line (red)
 // $Test->drawLegend(890,60,$DataSet->GetDataDescription(),0, 81, 163,-1,-1,-1,255,255,255,false);
  //drawLegend($XPos,$YPos,$DataDescription,$R,$G,$B,$Rs=-1,$Gs=-1,$Bs=-1,$Rt=0,$Gt=0,$Bt=0,$Border=FALSE)
  //var_dump($kontrakt_data0,$count);//array_reverse($minzp3));
//   foreach (($minzp_ker)  as $zp){ //array_reverse
//   $count++;
//   if($count==0)$zp['period']=$kontrakt_data0; else $zp['period']='01/'.$zp['period'];
//   $DataSet->AddPoint(' '.$zp['period'], "id");//XAxis
//     }
    //устанавливаем точки с датами
//на ось абсцисс
// $DataSet->SetAbsciseLabelSerie("id");
//   $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 255, 255, 255, true, 90, 2); // Рисуем оси и график
//   $Test->drawGrid(1, false, 0, 81, 163, 25); // Рисуем сетку

//   $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription()); // Соединяем точки графика линиями
//   $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(), 3, 2, 205, 16, 0); // Рисуем точки
 // $Test->drawTitle(5, 42, 'Різниця між галузевими гарантіями та фактичними умовами оплати праці (грн.)', 255,255,255, 685); // Выводим заголовок графика

 //$Test->Stroke(); // Выводим график в окно браузера;
 $go=   'uploaded/grafiks/grafiks_zp_'.$id.''.uniqid().'.png';
// $go1=   '/uploaded/grafiks/grafiks_zp_'.$id.'.png';
 $Test->Render($go);
}




?>
<img src="/<?=$go?>" style="z-index:9;position: relative;" id="grafikDir1" >
<!--table style="text-align: left; margin:0 -50;margin-top:25px;margin-left:-25%; width: 95%;" class="features-table"
 cellpadding="0" cellspacing="0">



    <tr class="gray" >

    <td><img src="/<?=$go?>" style=""></td>
     <td></td>
  </table-->

  <!--section class="bng_section consultantb" style="margin-top:-15px;" >
		<div class="cont cont--small" >
<!--p style="margin-left:25%;"><img src="/<?=$go?>"
 align="left"
 vspace="5" hspace="5"><br/ clear="all">
  </p-->
  <!--/div></section>
    <!--p  style="margin-left:-25%;margin-top:5px;font-weight:bolder;padding-left:30px;width:30%;color:#fff;min-height:100px;"> weight="1120" height="350"
    <img src="/<?=$go?>" style=""><span style="margin-top:5px;width:50%;"></span></p-->
<div style="margin-top:50px;font-weight:bolder;padding-left:30px;width:25%;color:#fff;min-height:100px;"> </div>

<!--style>
#content{margin-top:0px;padding-top:0px;}
</style-->


<?$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
//var_dump($callTime);
