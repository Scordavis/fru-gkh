<!--   CSS /css/page_garantii.css  ------>
<link rel="stylesheet" type="text/css"  href="/css/tab_1.css?rnd=9"/>
<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<div id="error"></div>
<?
$added_url = '';
// if($data['calcul']=='calcul'){$calcul='calcul';$calcultable='calcul';}
// else {$calcul='calculations';$calcultable='calculation';}
//var_dump($_POST);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);

$db = new SafeMySQL();
$dosiagnennia_dir=$especially_important_dir=0;
$work_days_director=$data['work_days_director'];
    //
if($data['calcul']=='calcul'){$calcul='calcul';$calcultable='calcul';$modelc= new Model_calcul();$c57='57';$c_57='_57';$dNight=0.35;$dEv=0.2;$titletitle='категорії A № 57';}
else {$calcul='calculations';$calcultable='calculation';$modelc= new Model_calculations();$c57='';$c_57='';$dNight=0.4;$dEv=0.2;$titletitle='категорії A № 26';}

$colspan_work=17;
if(isset($_GET['fact'])&& $_GET['fact']=='fact'){$c57='_fact';
    $dNight=0.4;$dEv=0.2;$titletitle='ШТАТНИЙ РОЗПИС';$colspan_work=18;
}


//$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` ORDER BY `id` DESC limit 1");

$tarif_date=date('m').'/'.date('Y');
if($_GET['sfera']!=='0'&& $_GET['period_start']!==''){$tarif_date=substr($_GET['period_start'], 3);}
$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
$bottom = $db->getOne("SELECT `bottom` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");

$region= $db->getOne("SELECT `region` FROM `table_1` WHERE `id`=?s",$_GET['id']);$regional_coef=0;
if ($region=='Донецька область') {$regional_coef =1.15;}
else {$regional_coef = 1;}

	$sfera=$data['name'];//$db->getRow ("SELECT * FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$tab =$sfera;// $db->getRow('SELECT * FROM `table_1` WHERE `id`=?s',  $_GET['id']);
    //$dodatkova_zp_kontrakt =   $db->getOne("SELECT `dodatkova_zp_kontrakt` FROM `table_1` WHERE `id`=?s",  $_GET['id']);
//$sezon =   $db->getOne("SELECT `sezon` FROM `calculation_garrantiesWorkers` WHERE `id_pidpriemstva`=?s ORDER BY `seniority`",  $_GET['id']);
$sezon= $sumlinno=$data['name']['sezon'];
	$sumlinno=$data['name']['sumlinnyj'];
//if($_SESSION['status']==1) {
		?><!--Одна сфера діяльності-->
		<?$aa=0;$bb=0;$cc=0;$vsi_sfery='';?>


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
<?$instr="ВИСНОВОК КАТЕГОРІЇ «А»: підтверджуються галузеві гарантії з оплати праці на підставі наданих підприємством даних щодо
фактичного чисельно-кваліфікаційного складу працівників та запроваджених заохочувальних та компенсаційних виплат;";

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
	/*table{
		word-break: break-all;
	}*/
	.tabledb table tr th{
		font-size: 12px;
	}
	section .main_titler{
		position: relative;
		margin-top: 26px;
		padding-left: 100px;
		color: #606060;
		font: 700 20px Ubuntu;
		text-transform: uppercase;
		letter-spacing: .020em;
	}
	section .main_titler:before{
		position: absolute;
		top: 12px;
		left: 0;
		width: 80px;
		height: 2px;
		background: #cd1000;
		content: '';
    }
  </style>

	<!-- Основная часть -->
	<section>
		<div class="cont">
			<div class="main_titler">Доплати та надбавки <?=$data['table_name']?>
				<?if($_GET['diln']=='empty'  && count($data['diln'])>1)
  {      ?>Головне підприємство<?}?>
  <?if($_GET['diln']>0){?>Відокр. підрозділ №<?=$_GET['diln']?><?}?></div>
		</div>
	</section>


 <style type="text/css">
.infosubmit{padding:4px;border: 0px solid #606060;color: #606060;font: 700 16px Ubuntu;background: #f8f8f8;
text-transform: undercase;font-size:100%;}
.infosubmit:hover{    color: #0051a3;    background: transparent;}
.consultant .name{    color: #606060;    font: 500 18px Ubuntu;    letter-spacing: .020em;}
.consultant .info{    margin-top: 22px;    color: #202020;    font: 700 16px Ubuntu;}

	.instructio a{    position: relative;    padding-right: 24px;    color: #0051a3;
	 font: 500 20px Ubuntu;    text-decoration: none;} .instructio a:after{    position: absolute;    top: 0;    right: -10;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';} .instructio{    margin-top: 10px;} .instructio a{    padding-right: 20px;
	 font-size: 16px;    line-height: 23px;} .instructio a:before{    font-size: 16px;} .instructio a b{    font-size: 20px;    font-weight: 500;}
	 .instructio .mini_modal{    position: absolute;    top: 100%;    left: 15%;    z-index: 999;    display: none;    width: 156px;    padding: 0 8px 14px;
	 color: #606060;    font: 300 20px Ubuntu;    background: #fff;    box-shadow: 0 2px 7px rgba(0,0,0,.30);} .instructio .mini_modal{    left: 550px;
	 width: 95px;    font-size: 16px;}.instructio .mini_modal div{    margin-top: 16px;} .instructio .mini_modal b{    font-size: 20px;    font-weight: 500;}
a.disabled {
    pointer-events: none; /* делаем ссылку некликабельной */
    cursor: default;}
    </style>


<section class="bng_section consultant">
		<div class="cont">
			<div class="">
			   <span class="name" >
	Мінімальна заробітна плата, що врахована в розрахунку </span>	<span class="info" style="padding:4px;">
<?=$bottom?> грн.</span></div>

	<?if(isset($_POST['min_zp'])){$min_zp=$_POST['min_zp'];if($min_zp<1600)$bottom=$min_zp;
}

//var_dump($tarif_date);
?>
	<form style="display:inline-block;" id="form_minzp" action="/calculations/inputdataSfera/?<?=$arr["query"]?>" method="POST">

<div style="display:inline-block;"> <span class="name" >

	Прожитковий мінімум, що врахований в розрахунку 	</span>
	<span class="instructio0"><a href="#" class="mini_modal_link info disabled" data-modal-id="#modal_gtelst" style="padding:4px;"
	>
<?/*<select  id="instructio0"class="info instructio0" name="min_zp" style="border:0;background: #f8f8f8;-webkit-appearance: none;
         -moz-appearance: none;      text-indent: 0.01px;       text-overflow: '';            -ms-appearance: none;      appearance: none!important;"
         onChange='$("#form_minzp").submit()' >
<option  value='<?=$min_zp?>'><?=$min_zp?></option>
<?$y=0;while($y<count($data['min_zp'])){foreach($data['min_zp'][$y] as $zp):
?>
<option  value='<?=$zp?>'><?=$zp?></option>
<?$y++;endforeach;}?>
</select>*/?> <input type="text" name="min_zp" class="info" style="border:0;background: #f8f8f8;text-align:right;" size="1" value="<?=$min_zp?>"> грн.</a>

<?/*div class="mini_modal" id="modal_gtelst" >
  <?$y=0;while($y<count($data['min_zp'])){foreach($data['min_zp'][$y] as $zp):
?>
<div onClick='$("input[name=min_zp]").val(this.innerHTML.replace(" грн.",""));$("#form_minzp").submit()' ><?=$zp?> грн.</div>
<?$y++;endforeach;}?>
</div*/?>
</span>
</div>
</form>
</section>


		<!--/table>
		<div style="position:absolute;top:64%;right:20%;color:#fff;font-size:28px;">
			<span style="font-size:90%;">Доплати та надбавки категорії <span style="font-size:250%;font-family:'Nunito', sans-serif;font-weight:bolder;">A</span></span><br/>
			<span style="font-size:11px;margin-bottom:10px;" title="ВИСНОВОК КАТЕГОРІЇ «А»: підтверджуються галузеві гарантії з оплати праці на підставі наданих підприємством даних щодо фактичного чисельно-кваліфікаційного складу працівників та запроваджених заохочувальних та компенсаційних виплат;">Що це?</span>

		</div>
	</div>
  </div>
</div-->
 <style type="text/css">



</style>


	<section class="section_edit">
<style type="text/css">
.table table{    width: 100%;    border-collapse: collapse;}
/*.tabledb table tr th{    min-width: 70px; }*/
 /*.tabledb table tr th{    min-width: 50px; }*/
 @media (max-width: 930px) {

       .tabledb { padding-left:0%;
     }
     .tabledb table tr th{    min-width: 5px; max-width: 35px;}
      .tabledb table:first-child tr th{    min-width: 5px; max-width: 50px;}
 }
 table .allall > td {
  background:rgba(205, 16, 0, 1);color:#fff;}
  </style>


<div class="tabledb" style="margin-top:25px;">
				<table >
					<thead>
						<tr>

		<tbody>



<!--table style="text-align: center; width: 90%;margin:0 auto;margin-top:15px;" class="tables"
 cellpadding="0" cellspacing="0">
  <tbody style=""-->
    <!--tr style="background:rgba(185, 211, 238 ,0.6);color:black;text-align:left;"><td colspan="16">

</td> </tr-->
    <tr style="background:rgba(124, 205, 124, 0.4);color:#8B3A3A;font-size:83%;">
	<!--td> </td-->
		<th>Професія </th>
		<th>Інтенс. праці</th>
    <th>Суміщення (грн.)</th>
    <th>Вечірні доплати (грн.)</th>
    <th>Нічні доплати (грн.)</th>
    <th style="width: 3%;">Шкідлив.</th>
<th >Святк. та вих. дні</th>
    <th>Держ. нагороди</th>
    <th>Почесні звання</th>
    <!--<th>Висока проф. майстерн.</th>   --->
    <!--<th>Класність</th> --->

    <th>Наук. ступінь</th>
    <th>Сумлінний роботодавець</th>
	<th>Високі досягнення у праці</th>
	<th>Викон. особл. важливої роботи</th>

    <th>Знання ін. мови</th>
		<!--th>Заробітна плата (грн.)</th-->
    </tr>

	<?
// 	$all_oklad=0;$all_fop=0;$dodatkova_sum=0;
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
//       $koef_posada_d =0;
// $quantity_workers=0;$quantity_heads=0;
	//var_dump($data['group']);


// 	$sumlinno=$db->getOne("SELECT `sumlinnyj` FROM `table_1` WHERE `id`=?s",$_GET['id']);
	/////////////////////////////////////////
	if($_GET['diln']=='empty' || $_GET['diln']>0)$data['all_d']=$data['all_d_diln'];
	/////////////////////////////////////////////
	$flag_diln='0';$flag_group='';
// 	$q_heads = $data['quantity_heads'];
	foreach($data['all_d'] as $d):

	if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1 && $flag_diln!==$d['dilnica']){


      if($d['dilnica']=='') {$fordiln_name='Головне підприємство';}
  else $fordiln_name='Відокремлений підрозділ '.$d['dilnica'];

  ?>
	<tr><td colspan="16" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}
	$groupgroup_name=$data['group_heads_popup'][$d['type']];

	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="16" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
	/*	//if(($data['diln']) )://var_dump($data['diln']);
foreach($data['diln_h'] as $fordiln):
    if($_GET['diln']>0 && str_replace("№ ", "", $fordiln['dilnica'])!==$_GET['diln'])continue;
  if($_GET['diln']=='empty' && $fordiln['dilnica']!=='')continue;

  if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1)
  {
      if($fordiln['dilnica']=='') $fordiln_name='Головне підприємство';
  else $fordiln_name='Відокремлений підрозділ '.$fordiln['dilnica'];

  ?>
	<tr><td colspan="16" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
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
	<tr><td colspan="16" rowspan="1" style="text-align:left;"><?=$group['group_name']?></td></tr>
	<?


//	var_dump($type, $id,$_GET['sfera'],$_GET['id_tarif'],'fff',$select);
	foreach($select as $d):
	//if ($d['type']==$group['group_type']) {
	$q_heads = $data['quantity_heads'];

	if($d['dilnica']!==$fordiln['dilnica'])continue;
 /////////////////////////
/*foreach($data['group'] as $group):?>
	<tr><td colspan="16" rowspan="1" style="text-align:left;"><?=$group['group_name']?></td></tr>
	<?
	$type = $group['group_type'];
	$id = $data['id'];//var_dump($type, $id);
	//$select = $this->model->selectforcicle($type, $id);
	 $select = $this->model->selectforcicleSfera($type, $id,$_GET['sfera'],$_GET['id_tarif'],$calcultable);
//var_dump($select);
	foreach($select as $d):
	//if ($d['type']==$group['group_type']) {
	$q_heads = $data['quantity_heads'];

*/	?>

    <tr  style="text-align:left;background:#fff;">

			<!--td style="text-align:left;vertical-align: middle;width:50px;">

			<? ?></td-->
			<td style="text-align:left;"><?=$d['positiosheads']?></td>
			<?
// 			$modal_window = 'edit_garranty';
// 			if ($d['type']=='director') {$modal_window = 'edit_heads';}
// 			if ($d['type']=='master') {$modal_window = 'edit_garranty_master';}
// 			if ($d['type']=='professional') {$modal_window = 'edit_garranty_professional';}
// 			if ($d['type']=='expert') {$modal_window = 'edit_garranty_expert';}
// 			if ($d['type']=='technician') {$modal_window = 'edit_garranty_technician';}
// 			if ($d['type']=='Technical_officer') {$modal_window = 'edit_garranty_Technical_officer';}
			?>


			<?include 'garantiiA_doplaty.php';
// 			if($d['id']==1917) var_dump($d['EvNight'],$d['Night'],$work_days_director,$Ev,$Night,$dNight,$dEv,$d['oklad'.$c57.'']);
			?>


				<td><?=$intensyvnist?></td>
			<td><?=$sumisnyk?></td>
				<td><?=$Ev?></td>
				<td><?=$Night?></td>
			<td><?=$shkidlyvo?></td>
<td><?=$d['weekend']?></td>

		<td ><?=$state_awards?></td>
		<td><?=$honorary_title?></td>
		<!--<td><=$masterstvo?></td>-->
		<!--<td><=$klass?></td>-->

		<td><?=$science_degree?>
</td><td><?=$sumlinniy?></td>
<td><?=$dosiagnennia?></td>
<td ><?=$especially_important?></td>
		<td><?=($foreign)?> </td>
		</tr>
	<?
	//}
	endforeach;
// 		endforeach;	endforeach;
		?>


    <!--tr class="allall">

		<td style="color: #fff;">ВСЬОГО </td>
		<td colspan="14" rowspan="1" style="color: #fff;"></td>


		<td style="color: #fff;"><b><?=($all_zarplata)?></b></td>
    </tr-->
    </table >
    <style>
        /*.table table tr th{    min-width: 100px;    padding: 13px 7px;    color: #fff;    font: 15px/22px Ubuntu;    border-right: 1px solid #fff;    border-left: 1px solid #fff;    background: #0051a3;}*/

    </style><table >
					<thead>
						<tr>

		<tbody>

<tr style="background:rgba(185, 211, 238 ,0.6);color:black;text-align:left;">
	<td colspan="<?=$colspan_work?>">
	</td>

</tr>
    <tr style="background:rgba(124, 205, 124, 0.4);color:#8B3A3A;font-size:83%;">
	<!--td> </td-->
		<th>Професія </th>
		<th>Інтенс. праці</th>
    <th>Суміщ.  (грн.)</th>
     <th>Вечірні доплати (грн.)</th>
    <th>Нічні доплати (грн.)</th>
    <th >Шкідлив.</th>
<th >Святк. та вих. дні</th>
    <th>Ненорм. роб. день</th>
    <th>Роб. день з розд. на дві частини</th>
    <th>Керівн. бригадою</th>
    <th>Освоєння нов. норм труд. затрат</th>
    <th>Кер-во практикою</th>
   <?if(isset($_GET['fact'])&& $_GET['fact']=='fact'){?> <th>Розшир. зони обслуг. /збіл. обсягу робіт</th><?}?>

    <th>Висока проф. майстерн.</th>
    <th>Класн.</th>
    <th>Високі досягн. у праці</th>
    <th>Вик. особл. важл. роботи</th>
    <th>Знання ін. мови</th>

<!--th >Доплата до рівня мін.з/п (грн.)</th-->
		<!--th>Заробітна плата (грн.)</th-->
    </tr>


	<?
// 	$all_oklad2 = 0;$inshi_fop_rob=0;
// 	$off_season = $asezon=$zarplata_asezon=$all_zarplata_asezon= 0;
// 	$teplo_postachannia_off = 0;$vodo_postachannia_off = 0;$tvp_postachannia_off = 0;$jitlo_postachannia_off = 0;
// 	$teplo_postachannia = 0;$vodo_postachannia = 0;$tvp_postachannia = 0;$jitlo_postachannia = 0;
// 	$RPV_postachannia = 0;$vodovidvod_postachannia = 0;
// 	$vodovidvod_fop_rob =0; $vodovidvod_fop_rob_off =0;$RPV_fop_rob =0; $RPV_fop_rob_off =0;
	if($_GET['diln']=='empty' || $_GET['diln']>0)$data['all_w']=$data['all_w_diln'];
	/////////////////////////////////////////////
	$flag_diln='0';$flag_group='';
// 	$q_workers = $data['quantity_workers'];
// 	$dds=0;
	foreach($data['all_w'] as $d):
// 		$www++;var_dump($www);
// 	$dds++;
// 	if($dds==5)	break;

	if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1 && $flag_diln!==$d['dilnica']){


      if($d['dilnica']=='') {$fordiln_name='Головне підприємство';}
  else $fordiln_name='Відокремлений підрозділ '.$d['dilnica'];

  ?>
	<tr><td colspan="<?=$colspan_work?>" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}
	$groupgroup_name=$d['type'];
	if($d['type']=='Невиробничі види робіт і послуг (управління та утримання житлових будинків, санітарне утримання об`єктів та територій, зелене будівництво та садово-паркове господарство, технічна інвентаризація об`єктів нерухомості; відлов та догляд за безпритульними тваринами; обслуговування готелів та гуртожитків; побутові та індивідуальні послуги; оптова та роздрібна торгівля; громадське харчування; друкарська діяльність; послуги поштового та електрозв`язку; адміністративні та інформаційно-диспетчерські послуги; охоронна діяльність)') $groupgroup_name='Невиробничі види робіт і послуг';
if($d['type']=='Ремонт, налагодження, обслуговування устаткування, контрольно-вимірювальних приладів, автоматики, електронно-обчислювальної техніки, машин, механізмів, службових та виробничих приміщень, будівель та споруд, багатоквартирних будинків') $groupgroup_name='Ремонт, налагодження, обслуговування устаткування, приладів, автоматики, техніки, машин, механізмів, приміщень, будівель та споруд, багатоквартирних будинків';

	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="<?=$colspan_work?>" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
	/*
foreach($data['diln_w'] as $fordiln):
  if($_GET['diln']>0 && str_replace("№ ", "", $fordiln['dilnica'])!==$_GET['diln'])continue;
  if($_GET['diln']=='empty' && $fordiln['dilnica']!=='')continue;

  if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1){
      if($fordiln['dilnica']=='') $fordiln_name='Головне підприємство';
  else $fordiln_name='Відокремлений підрозділ '.$fordiln['dilnica'];

  ?>
	<tr><td colspan="<?=$colspan_work?>" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
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
			<td colspan="<?=$colspan_work?>" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td>
		</tr><tbody class="parents-doplata">
		<?
		foreach($data['all_w'] as $d):

	//	$q_workers = $data['quantity_workers'];

		if ($d['type']==$group['group_name'])
		{

			if($d['dilnica']!==$fordiln['dilnica'])continue;
  /*foreach($data['group_workers'] as $group):?>

		<tr>
			<td colspan="16" rowspan="1" style="text-align:left;"><?=$group['group_name']?></td>
		</tr><tbody class="parents-doplata">
		<?
		foreach($data['all_w'] as $d):

		$q_workers = $data['quantity_workers'];

		if ($d['type']==$group['group_name'])
		{*/?>
			<tr  style="text-align:left;background:#fff;">
				<!--td style="text-align:left;vertical-align: middle;">



					<?
				?>
</td-->


					<td style="text-align:left;"><?=$d['positiosworkers']?>


				</td>
				<?include 'garantiiA_doplaty.php';?>
				<td><?=$intensyvnist?></td>
			<td><?=$sumisnyk?></td>
				<td><?=$Ev?></td>
				<td><?=$Night?></td>
			<td><?=$shkidlyvo?></td>
			<td><?=$d['weekend']?></td>
				<td ><?=$no_norm?></td><!-- Коеф первого разряда-->
			<td ><?=$rozdil?></td><!-- Коеф. за посадою -->
				<td><?=$brigada?></td>

				<td><?=$development_norms?></td>
				<td><?=$practice_guide?></td>
		<?if(isset($_GET['fact'])&& $_GET['fact']=='fact'){?>		<td><?=$increase_work?></td><?}?>

				<td><?=$masterstvo?></td>
				<td><?=$klass?></td>
				<td><?=$dosiagnennia?></td>

				<td><?=$especially_important?> </td>
<td><?=$foreign?> </td>
			</tr>

				<?
		//	}
// 			endforeach;	endforeach;
		endforeach;
//var_dump($teplo, $vodo, $tvp,$jitlo,$inshe, $nevidm,$all_zarplata_off);
		?>
	</tbody>
    <!--tr class="allall">

		<td  style="color: #fff;">ВСЬОГО </td>

		<td  style="color: #fff;" colspan="14"></td>



		<td style="color: #fff;"><b><?=round($all_zarplata2)?></b></td>

    </tr>

    <tr class="allall">
		<td colspan="10" rowspan="1"style="text-align:left;color: #fff;"><b>Всього по підприємству:</b></td>
		<?//$itog = round($all_zarplata+$all_zarplata2);



		?>

		<td><b></b></td>
		<td> <b></b> </td>

		<td><b></b></td>

		<td></td><td></td>

		<td  style="color: #fff;"><b><?=round($all_zarplata2+$all_zarplata)?></b></td>

    </tr>


</tbody-->

</table>
</div>
<br/><br/>
</section>




<div style="height:250px;"></div>



		<!--     МОДАЛЬНЫЕ ОКНА ОШИБОК      onclick="show_alert()"      -->



