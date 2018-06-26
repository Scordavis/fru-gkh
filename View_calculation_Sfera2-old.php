<!--   CSS /css/page_garantii.css  ------>

<link rel="stylesheet" type="text/css"  href="/css/tab_1.css?rnd=9"/>
<link rel="stylesheet" type="text/css"  href="/css/navigation_bar_vert_FACT.css?rnd=9"/>
<style>
/*@font-face {
    font-family: 'PT Sans';
    src: url('ptsans-regular.eot');
    src: url('ptsans-regular.eot?#iefix') format('embedded-opentype'),
         url('ptsans-regular.woff2') format('woff2'),
         url('ptsans-regular.woff') format('woff'),
         url('ptsans-regular.ttf') format('truetype'),
         url('ptsans-regular.svg#PT Sans Regular') format('svg');
    font-weight: normal;
    font-style: normal;
}

body {
    font-family: "PT Sans";
}
body { font-family: "wf_SegoeUILight"; }
*/


.tel{	font: 300 20px "Ubuntu";	color: #fff;	text-decoration: none;	border: none;	position: relative;	padding-right: 45px;}
    .mini_modall{	display: none;	position: relative;	background: #fff;color: #606000;	width: 580px;	padding: 10px;	left: -10px;}
</style>

<?//var_dump(time(),date("F j, Y, g:i:s a"));
if(isset($_GET['id'])) {
	$idi = $_GET['id'];
}
	$added_url = '';
$number = $_GET['sfera'];
if($data['calcul']=='calcul'){$calcul='calcul';$calcultable='calcul';$modelc = new Model_calcul();}
else {$calcul='calculations';$calcultable='calculation';$modelc = new Model_calculations();}



//  var_dump($_SESSION);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL ^ E_DEPRECATED);
//$min_zp = $data['min_zp'];k
$db = new SafeMySQL();
$modelc = new Model_calculations();
$id_tarif =$db->getRow("SELECT * FROM `archiv_tarifs` WHERE  `id`=?s",$_GET['id_tarif']);
//if($id_tarif['sign_archives'] !==''){$sign_archives=1;}else
$sign_archives=0;
if($id_tarif['pidverdjeno_regional'] !==''&& $id_tarif['pidverdjeno_pidpr'] !=='')$sign_archives=1;
$sfera=$data['name'];//$db->getRow ("SELECT * FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$tab = $sfera; //$db->getRow('SELECT * FROM `table_1` WHERE `id`=?s',  $_GET['id']);
$ugoda=$sfera['ugoda'];
$tarif_date=date('m').'/'.date('Y');
if($_GET['sfera']!=='0'&& $_GET['period_start']!==''){$tarif_date=substr($_GET['period_start'], 3);}

$url = $_SERVER['REQUEST_URI'];
$arr = parse_url($url);
//$arr["query"]
if($_GET['period_start']==''){$_GET['period_start']=$id_tarif['period_start'];
    $arr["query"].=$id_tarif['period_start'];
}


$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
if($_GET['sfera']==0&&$id_tarif['min_zp']>0){$min_zp = $id_tarif['min_zp'];}

$min = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");
//if(date('Y')=='2017')
//=if(strpos($tarif_date,'/2017'))$min_zp=$min=1600;
$bottom = $db->getOne("SELECT `bottom` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");

// $arr["query"];
//var_dump($_SERVER['REQUEST_URI'],$arr,$id_tarif['period_start']);
//var_dump($data['url_heads'],$data['url_headss']);

$sfera_for_select = '';$i=0;
while($i<44){$i++;
$sfera_for_select.=$sfera['sfera_'.$i].',';
}

$postachannia_mini=$data['postachannia_mini'];
?>
<input type="hidden" class="id_for_select" value="<?=$sfera_for_select?>">


		<?
/*
$groupsheads = array(
	'1' => 'Загальне керівництво основним виробництвом, комплектування та підготовка кадрів, організаційний відділ.',
	'2' => 'Організація технічної підготовки виробництва, технічного контролю, охорони праці та техніка безпеки.',
	'3' => 'Оперативне керівництво експлуатацією та ремонтом обладнання котельних та теплових мереж.',
	'4' => 'Ремонт та обслуговування електрообладнання, механізмів, допоміжного обладнання, КВП і автоматики, споруд і будівель.',
	'5' => 'Техніко-економічне планування, організація праці та заробітної плати, менеджмент.',
	'6' => 'Бухгалтерський облік та фінансова діяльність, організація взаєморозрахунків із споживачами.',
	'8' => 'Господарчі функції (матеріально-технічне постачання, адміністративно-господарська діяльність).');
//
//$selt = $this->model->groupsheads;var_dump($groupsheads ['1']);
/*	$tarif= array(
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
$tarif_date ='';$month='';
$flag=strtotime("01/10/1980");
$flag2=0;
foreach($tarif as $num=>$tar):
if($tar!='')
{ //var_dump($tar);
$tar = DateTime::createFromFormat('d/m/Y', $tar)->format('Y-m-d');
$tarif_date=$tar;$flag2=strtotime($tarif_date);
if($flag2>$flag ){ $flag=$flag2;}}

endforeach;
if($flag2!=0)$tarif_date= date("d/m/Y",$flag);


if($tarif_date!=''){
// разграничителями могут быть slash, dot или hyphen
list ( $day, $month,$year) = explode('/', $tarif_date);//'[/.-]'
$tarif_date=$month.'/'.$year;
$min_zp = $db->getOne("SELECT `zp` FROM `zvit_1_min_zp` WHERE `period`='$tarif_date'");}
*/
$region= $sfera['region'];
if ($region=='Донецька область') {$regional_coef =1.15;}
else {$regional_coef = 1;}

	$all_doplata=$all_doplata2=0;

$sezon= $sfera['sezon'];

if($sign_archives==0 && $_SESSION['status']!=='4' ) {
		?>
<div id="NavigationBar1" style="position:fixed;left:1px;top:315px;width:30px;height:30px;z-index:2;">
<ul class="navbar">
<li><a href="#modalWindow_positionsHeads"><img alt="" title="Керівні професії" src="/images/k+_h.png" width='40' class="hover"><span><img alt="" width='40' title="" src="/images/k+.png"></span></a></li>
</ul>
</div>
<div id="NavigationBar2" style="position:fixed;left:1px;top:360px;width:30px;height:30px;z-index:2;">
<ul class="navbar">
<li><a href="#modalWindow_positionsWorkers"><img alt="" width='40' src="/images/p+_h.png" class="hover"><span><img alt="" title="Робітничі професії" width='40' src="/images/p+.png"></span></a></li>
</ul>
</div>

<div id="NavigationBar3" style="position:fixed;left:1px;top:405px;width:30px;height:30px;z-index:3;">
<ul class="navbar">
<li><a href="/<?=$calcul?>/last/?<?=$arr["query"]?>"><img width='40' alt="" title="Клон останньої доданої професії" src="/images/2window_h.png" class="hover"><span><img alt="" width='40' title="" src="/images/2window.png"></span></a></li>
</ul>
</div>
<div id="NavigationBar4" style="position:fixed;left:1px;top:450px;width:30px;height:30px;z-index:4;">
<ul class="navbar">
<li><a href="/<?=$calcul?>/last_undo/?<?=$arr["query"]?>"><img width='40' alt="" title="Скасування  останнього видалення професії" src="/images/back_h.png" class="hover"><span><img alt="" title="" width='40' src="/images/back.png"></span></a></li>
</ul>
</div>
<div id="NavigationBar5" style="position:fixed;left:2px;top:495px;width:30px;height:30px;z-index:5;">
<ul class="navbar">
<li><a href="/<?=$calcul?>/last_delete/?<?=$arr["query"]?>"><img width='40' alt="" title="Оновлення новоствореної професії коефіцієнтами щойно видаленої професії
(1. Видалили професію; 2. Створили професію;
3. Натиснувши на кнопку, повернули коєфіцієнти.)" src="/images/updown_h.png" class="hover"><span><img alt="" title="" width='40' src="/images/updown.png"></span></a></li>
</ul>
</div>
<!--Одна сфера діяльності-->
		<?}


 $no_change = 0;

if(count($data['all_d'])>5){?>
<style>
.edit_a:before{    content: 'W';    font: 28px/28px FontAwesome;    color:#fff;background:#0051a3;text-decoration: none;padding:7px;
border:0px solid #fff;

}
    .edit_a:hover:before{    content: 'W';    font: 28px/28px FontAwesome;    color:#fff;background:#0051a3;text-decoration: none;padding:5px;
    box-shadow: 0 0 0 3px #fff, 0 0 0 5px #0051a3;
    /*border:3px solid #fff;*/

    }
</style>

<div id="" style="position:fixed;left:2px;top:550px;width:30px;height:30px;z-index:5;">
<ul class="navbar">
<li><a href="#workers" class="edit_a" title="Перехід до робітничого персонала">
    <!--<img width='40' alt="Workers"  src="/images/updown_h-.png" class="hover">-->
    <!--<span><img alt="W" title="" width='40' src="/images/updown.png"></span>-->
    </a></li>
</ul>
</div><?}?>

<tr><td><?//=$tab('dogovir')?></tr></td>

 <? $pidtverdjeno_regional = '';$pidtverdjeno_pidpr = '';

//Для админа
if ($_SESSION['status']=='1')
				{
					if($id_tarif['sign_archives'] !=='')
					{
							$bcg3 = 'rgba(0, 81, 163, 0.5)';//0051a3
					}else
						{
							$bcg3 = 'rgba(205, 16, 0, 0.5)';//#cd1000
						}


					if($id_tarif['pidverdjeno_pidpr'] !=='')
					{
							$pidtverdjeno_pidpr = 'Підтверджено підприємством';
								$pidtverdjeno_pidpr = ' <a style="color:#fff;" href="/'.$calcul.'/pidpys_tarif/?unlock&'.$arr['query'].'" >Підтверджено підприємством</a> ';
							$bcg1 = 'rgba(0, 81, 163, 1)';
					}else
						{
							$pidtverdjeno_pidpr = 'Не підтверджено підприємством';
								$pidtverdjeno_pidpr = ' <a style="color:#fff;" href="/'.$calcul.'/pidpys_tarif/?lock&'.$arr['query'].'" >Не підтверджено підприємством</a> ';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}
						if($id_tarif['pidverdjeno_regional'] !=='')
						{
							$pidtverdjeno_regional = 'Підтверджено регіональним керівником';
						$pidtverdjeno_regional = '<a style="color:#fff;"href="/'.$calcul.'/pidpys_region_tarif/?unlock&'.$arr['query'].'" >Підтверджено регіональним керівником</a> ';
							$bcg2 = 'rgba(0, 81, 163, 1)';

						}
					else
						{
							$pidtverdjeno_regional = 'Не підтверджено регіональним керівником';
						$pidtverdjeno_regional = '<a  style="color:#fff;" href="/'.$calcul.'/pidpys_region_tarif/?lock&'.$arr['query'].'" >Не підтверджено регіональним керівником</a> ';
							$bcg2 = 'rgba(205, 16, 0, 1)';
						}
			}?>
				<br/>
		<?

		//Подтверждение предприятием
		if($_SESSION['status']=='0')
			{
			    if($id_tarif['sign_archives'] !=='')
					{
							$bcg3 = 'rgba(34, 139, 34, 0.5)';
					}else
						{
							$bcg3 = 'rgba(255, 0, 0, 0.5)';
						}
				if($id_tarif['pidverdjeno_pidpr'] !=='')
					{
					if($_GET['sfera']=='0')	$pidtverdjeno_pidpr = ' <a style="color:#fff;" href="/'.$calcul.'/pidpys_tarif/?unlock&'.$arr['query'].'" >Підтверджено підприємством</a> ';
					if($_GET['sfera']!=='0')	$pidtverdjeno_pidpr = 'Підтверджено підприємством';		$bcg1 = 'rgba(30, 81, 163, 0.5)';
					}else
						{
							$pidtverdjeno_pidpr = '<a style="color:#fff;" href="/'.$calcul.'/pidpys_tarif/?lock&'.$arr['query'].'">Не підтверджено підприємством</a>';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}
				if($id_tarif['pidverdjeno_regional'] !=='')
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

				if($id_tarif['pidverdjeno_regional'] !=='')
					{
					if($_GET['sfera']=='0')	$pidtverdjeno_regional = '<a style="color:#fff;" href="/'.$calcul.'/pidpys_region_tarif/?unlock&'.$arr['query'].'" >Підтверджено регіональним керівником</a> ';
					if($_GET['sfera']!=='0')	$pidtverdjeno_regional = 'Підтверджено регіональним керівником';
						$bcg2 = 'rgba(0, 81, 163, 1)';
					}else
					{
						$pidtverdjeno_regional = '<a style="color:#fff;" href="/'.$calcul.'/pidpys_region_tarif/?lock&'.$arr['query'].'">Не підтверджено регіональним керівником</a>';
						$bcg2 = 'rgba(205, 16, 0, 1)';
					}

					if($id_tarif['pidverdjeno_pidpr'] !=='')
					{
						$pidtverdjeno_pidpr = 'Підтверджено підприємством';
						$bcg1 = 'rgba(0, 81, 163, 1)';
					}else
						{
							$pidtverdjeno_pidpr = 'Не підтверджено підприємством';
							$bcg1 = 'rgba(205, 16, 0, 1)';
						}


			}
// 		if(empty($data['all_w']))
// 			var_dump($data['all_w']);
			$logo_href='/usercabinet//?id='.$_GET['id'];
			if( $_SESSION['status']=='4' )$logo_href='#';
			?>

			<!-- Шапка -->
	<header class="inner">
		<div class="cont">
			<div class="sector_flex">
				<div class="logo">
					<a href="<?=$logo_href?>">
						<span>
							<b><?=$data['name']['povne_naymenuvannya']?></b><br/>
							<?/*if($data['name']['region']=='м. Київ') {
			$data['name']['region']='';
			}*/?>
			<?=$data['name']['region']?><br/>  <?=$data['name']['misto']?>
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
<?$instr="Рознесіть дані щодо витрат, які були фактично враховані в діючому тарифі;<br/>
При роботі можна скористатись наступними інструментами експорту:<br/>
-	експортувати дані с діючого штатного розкладу;<br/>
-	експортувати дані з попередніх тарифів;<br/>
-	експортувати дані з галузевих гарантій (тільки розмір коефіцієнтів);<br/>
-	виділити витрати за видом діяльності або за окремим підрозділом;<br/>
Інструменти розподілу трудовитрат між різними видами діяльності та виробничими підрозділами дозволяють відокремити трудовитрати
загальновиробничого та адміністративного персоналу пропорційно до питомої частки (%) послуги визначеної підприємством згідно його облікової політики
(пропорційно до прямих виробничих витрат; виробничій собівартості; витрат на оплату праці персоналу безпосередньо зайнятого на виробництві тощо).<br/>";

if($_GET['sfera']=='0')$instr="<b>Внесіть до програми дані діючого штатного розпису за допомогою кнопок розташованих в лівій частині
екрану</b> («К<span style='color:#f00;'>+</span>» - додати професію КПФТС; «Р<span style='color:#f00;'>+</span>» - додати робітничу професію; Зробити копію останньої
доданої професії; Відмінити видалення; Відтворити коефіцієнти щойно видаленої професії).<br/><b>
Відкоригуйте коефіцієнти, доплати та надбавки внесених професій шляхом натискання на назву професії.</b>
В разі приведення діючого штатного розпису до розміру галузевих гарантій можна скористатись
функцією експорту з гарантій А в меню <b>«Інструменти редагування»</b> (всі коефіцієнти приймуть значення
згідно галузевих гарантій).";

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


			<!--style>
			.container_g{overflow:hidden;width:100%;background:rgb(42,86,155);min-height:auto;}
			.container_g_bottom{overflow:hidden;width:100%;background:rgb(42,86,155);min-height:auto;border-top:1px solid #fff;}
.box_g{}
.box_g div{display:inline-block;vertical-align:top;}
			</style>
			</style>
<!--div class="container_g">
  <div class="box_g">
-->
<!--div class='container_g_bottom'>
		<div class="box_g">
			<div style="height:51px;display:inline-block;margin-top:15px;font-weight:normal;padding-left:30px;width:57.3%;color:#fff;font-family:Arial;font-size:120%;">
				<div style="margin-left:5%;">
				</div>
				</div>

			<div style="display:inline-block;width:30%;color:rgba(218, 165, 32, 0.7);border-left:1px solid #fff;border-left:1px solid #fff;height:51px;">

				<div id="NavigationBar2" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printVymogaTarif.php?<?=$arr["query"]?>"><img alt="" height="50" width='50' src="/images/vimoga_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/vimoga.png"></span></a></li>
					</ul>
				</div>

			<div id="NavigationBar3" style="margin:7px;display:inline-block;width:100px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><span style="width:100px;height:50px;background:<?=$bcg1?>">
						    <p style="color:#fff;font-size:75%;"><?=$pidtverdjeno_pidpr?> <?=$id_tarif['pidverdjeno_pidpr']?></p></span>
						</li>
					</ul>
				</div>
				<div id="NavigationBar3" style="margin:7px;display:inline-block;width:100px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><span style="width:100px;height:50px;background:<?=$bcg2?>">
						    <p style="color:#fff;font-size:75%;"><?=$pidtverdjeno_pidpr?> <?=$id_tarif['pidverdjeno_pidpr']?></p></span>
						</li>
					</ul>
				</div>
				<div id="NavigationBar4" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><span><img alt="" width='50' height="50" src="/images/vimoga.png"></span>
						</li>
					</ul>
				</div>
				<div id="NavigationBar5" style="margin:7px;display:inline-block;width:40px;height:40px;z-index:2;">
					<ul class="navbar">
						<li><a href="/models/Model_printVymogaTarif.php?<?=$arr["query"]?>"><img alt="" height="50" width='50' src="/images/vimoga_h.png" class="hover"><span><img alt="" width='50' height="50" src="/images/vimoga.png"></span></a></li>
					</ul>
				</div>


			</div>
		</div>
	</div-->

  <style>
      section .main_titler{    position: relative;
      margin-top: 26px;    padding-left: 100px;    color: #606060;    font: 700 20px Ubuntu;    text-transform: undercase;    letter-spacing: .020em;}
      section .main_titler:before{    position: absolute;    top: 12px;    left: 0;    width: 80px;    height: 2px;    background: #cd1000;    content: '';}
      /*.ugoda:after{*/
          /*color:#00ff00;position: absolute;    top: 50%;    left: 0;    width: 45px;    height: 45px;    background: url(/images/tel2.png) 0 0 no-repeat;    content: '';    transform: translateY(-50%);*/
      /* position: absolute;    top: 0;    right: 0;    font-family: FontAwesome;    font-size: 21px;    font-weight: normal;    content: '\f107';*/
          /*<i class="fa fa-camera-retro"></i>*/
      /*}*/
       .ugoda26:after,.ugoda57:after{    position: relative;    top: -0;    right: -5;    font-family: FontAwesome;
	 font-size: 21px;    font-weight: normal;    content: '\f107';}
  </style>
<?if($ugoda=='26'  || ($data['name']['ugoda']==''))$ugoda_class26='ugoda26';else $ugoda_class26='';//|| $data['name']['data_obliku']!==''
if($ugoda=='57' )$ugoda_class57='ugoda57';else $ugoda_class57='';//|| $data['name']['ugoda_date']!==''
if(!isset($_GET['diln']))$_GET['diln']=0;
// var_dump($data['diln']);
if($ugoda=='57'){$c57='57';$c_57='_57';$dNight=0.35;}
else {$c57='';$c_57='';$dNight=0.4;}?>

	<!-- Основная часть -->
	<section>
		<div class="cont">
			<div class="main_titler"><?=$data['table_name']?>
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
					<!--div class="name">Коригування штатного розпису</div-->
<div class="edit"><a href="/<?=$calcul?>/inputdataSferaA/?<?=$arr["query"]?>" target="_blank" class="submit_btn <?=$ugoda_class26?>" >Гарантії А (№26) </a></div>
<div class="edit"><a href="/calcul/inputdataSferaA/?<?=$arr["query"]?>&calcul=calcul" target="_blank" class="submit_btn <?=$ugoda_class57?>" >Гарантії А (№57)</a></div>
<div class="edit"><a href="/<?=$calcul?>/inputdataGu/?<?=$arr["query"]?>" target="_blank" class="submit_btn">ГУ-1</a></div>
<div class="edit"><a href="/models/Model_calcExel.php?<?=$arr["query"]?>&factor=F&calcul=<?=$calcul?>" target="_blank" class="submit_btn">Excel</a></div>
<?if($_GET['sfera']!=='0'){?><div class="edit"><a href="/models/Model_printRozrahunokTarif.php?<?=$arr["query"]?>" target="_blank" class="submit_btn">Різниця</a></div><?}?>
<?if($_GET['sfera']=='0'){?><div class="edit"><a href="/<?=$calcul?>/print_shtatniyRozpis/?<?=$arr["query"]?>" target="_blank" class="submit_btn">ШТАТНИЙ РОЗПИС</a></div><?}?>
<?/*div class="edit"><a href="/<?=$calcul?>/analise/?<?=$arr["query"]?>" target="_blank" class="submit_btn">Аналітика</a></div*/?>
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
a.disabled {
    pointer-events: none; /* делаем ссылку некликабельной */
    cursor: default;  /* устанавливаем курсор в виде стрелки */
    /*color: #999; /* цвет текста для нективной ссылки */
}
input[disabled]{background:#fff;
/*border:0;*/

}
</style>


<section class="bng_section consultant" >
		<div class="cont pl-50">
			<div class="">
			   <span class="name" >
	Мінімальна заробітна плата, що врахована в розрахунку </span>	<span class="info" style="padding:4px;">
<?=$bottom?> грн.</span></div>

	<?if(isset($_POST['min_zp'])){$min_zp=$_POST['min_zp'];if($min_zp<1600)$bottom=$min_zp;
}
if($_GET['sfera']=='0'  && $_SESSION['status']!=='4'){$disabled='';$instructio='instructio';}else {$disabled='disabled';$instructio='';}
//var_dump($tarif_date);
?><?/*<select  id="instructio0"class="info instructio0" name="min_zp" style="border:0;background: #f8f8f8;-webkit-appearance: none;
         -moz-appearance: none;      text-indent: 0.01px;       text-overflow: '';            -ms-appearance: none;      appearance: none!important;"
         onChange='$("#form_minzp").submit()' >
<option  value='<?=$min_zp?>'><?=$min_zp?></option>
<?$y=0;while($y<count($data['min_zp'])){foreach($data['min_zp'][$y] as $zp):
?>
<option  value='<?=$zp?>'><?=$zp?></option>
<?$y++;endforeach;}?>
</select>*/?>


<div style="display:inline-block;"> <span class="name" >
			   <form style="display:inline-block;" id="form_minzpp" name="searchform" action="/<?=$calcul?>/inputdataSfera/?<?=$arr['query']?>" method="POST">
	<p class="d-inline-block">Прожитковий мінімум, що врахований в розрахунку</p> 	</span>
	<span class="<?=$instructio?>"><a href="#" class="mini_modal_link info <?=$disabled?>" data-modal-id="#modal_gtelst" style="padding:4px;"
	>
<input type="text" name="min_zp" class="info" style="border:0;background: #f8f8f8;text-align:right;" size="1" value="<?=$min_zp?>"> грн.</a>
<?if($_GET['sfera']=='0' && $_SESSION['status']!=='4'){?>
<div class="mini_modal" id="modal_gtelst" >
  <?$y=0;while($y<count($data['min_zp'])){foreach($data['min_zp'][$y] as $zp):
//$("input[name=min_zp]").val(this.innerHTML.replace(" грн.",""));
?>
<div onclick="$('input[name=min_zp]').val(this.innerHTML.replace(' грн.',''));document.forms['searchform'].submit();" ><?=$zp?> грн.</div>
<?$y++;endforeach;}?>
</div><?}?>
</span></form>
</div>
<!--<div class="" style="display:inline-block;" onClick="$('#form_minzpp').submit();">	2Питома вага трудовитрат:$("input[name=min_zp]").val(this.innerHTML.replace(" грн.",""));</div>-->

<?if($_GET['sfera']!=='0'){?><br/><br/>
<div class="" style="display:inline-block;" onClick="document.forms['search-form'].submit();">
			   <span class="name" >
	Питома вага трудовитрат: </span>

<?/*if($sign_archives==0) {?>	<span class="info" style="padding:4px;">
		    <form method="post" action="/calculations/workdifference_procent/?<?=$arr['query']?>" style="display:inline-block;">
<span class="info" style="padding:4px;">
адміністративний персонал <input type="text" size="1"name="admin_procent"value="<?=$id_tarif['admin_procent']?>" />%
    ;</span>
<span class="info" style="padding:4px;">загальновиробничий персонал <input type="text" size="1"name="work_procent"value="<?=$id_tarif['work_procent']?>" />%
    .
    </span>

    <span class="info" style="padding:4px;">
<input class="infosubmit" type="submit" style=""value="Готово" />
    </span>
</form></span><?}else{*/?>
<span class="info" style="padding:4px;">
<span class="info" style="padding:4px;">адміністративний персонал <?=$id_tarif['admin_procent']?>%;</span>
<span class="info" style="padding:4px;">загальновиробничий персонал <?=$id_tarif['work_procent']?>%.  </span>
    </span>
<?}?>
</div>
<??>
	</div>
	</section>
<section class="bng_section" style="padding-top:10px;padding-bottom:10px;">
    <div class="cont px-20 d-flex justify-content-between align-items-center">
		<div class="operatio keys">
			<div class="link"><a href="#modal_optionsq" class="modal_link"><span>Налаштування</span></a></div>
		</div>
		<!---->
		<div class="modal modal_chat" id="modal_optionsq" style="display: none;">
		<div class="pad">
			<div class="title" style="color:#0051a3;background:#fff"> налаштування розрахунку</div>

	</div>
<?if($sign_archives==0 && $_SESSION['status']!=='4') $readonly='';else{$readonly='disabled';}?>
<div class="form">
			<form name="comment" method="POST" action="/<?=$calcul?>/kilkist/?<?=$arr['query']?>">

				<div class="pad bord">
			<?if($sign_archives==0 && $_SESSION['status']!=='4') {?>		<div class="title_form">Заповніть дані для розрахунку</div><?}?>

				<div class="pad bord">
					<div class="line_form" align="right">
					  Зарплата керівника у контракті  <input type="text" name="osnovna_zp_kontrakt" size="3"value="<?=$sfera['osnovna_zp_kontrakt']?>" <?=$readonly?>>грн.
				</div>
				<div class="line_form"  align="right">
					   Додаткова з/п керівника  <input type="text" name="dodatkova_zp_kontrakt" size="3" value="<?=$sfera['dodatkova_zp_kontrakt']?>" <?=$readonly?>>%&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<!---->
						<? $checked='';
    if(($sfera['oklad_and_dodatkova_for_premia']==1) ) $checked='checked="checked"';
?>
<div class="line_form" align="right">
					  Принцип нарахування премії <span style="padding-right:54px;"></span><br/>(на оклад з доплатами та надбавками)  <input type = "checkbox" name="oklad_and_dodatkova_for_premia"  <?=$checked?> value="1" <?=$readonly?>> Так
				</div>
				<div class="line_form"  align="right">
					   Тривалість сезону (для сезонних робіт)  <select name ="sezon" style="width:54px;" <?=$readonly?>>
	 <option><?=$sfera['sezon']?></option>
		<option >1</option>	<option >2</option>
		<option >3</option>		<option >4</option>
		<option >5</option>		<option >6</option>
		<option >7</option>		<option >8</option>
		<option >9</option>		<option >10</option>
		<option >11</option>	<option >12</option>
	</select>міс.
						</div>
		<?if($sign_archives==0 && $_SESSION['status']!=='4') {?>	<div class="submit"><input type="submit" name="ok" value="Готово" class="submit_btn"></div><?}?>
				</div></div>
			</form>

	</div>
<!--img src="/cabinet/images/close.png" width="25" style="position:absolute;top:10px;right:10px;"--></div>
<!---->
	<?//$sign_archives=1;
// 	if($_GET['diln']=='empty'  && count($data['diln'])>1)
//   {      if($_GET['diln']>0){

if($sign_archives==0 && $_SESSION['status']!=='4' && $_GET['diln']=='0') {
$data_boss_now=$db->getAll("SELECT *  FROM `archiv_tarifs` WHERE  `id_pidpriemstva`=?s  AND `sfera`=0 ORDER BY `id` ",$_GET['id']);

$savebox_style="margin-top:-58px;padding-left:60%;";?>	<div class="operatio keys">
			<div class="link"><a href="#" class="mini_modal_link" data-modal-id="#modal_ktelstq"><span> Інструменти редагування</span></a></div>
				<div class="mini_modal" id="modal_ktelstq" >

		<?if($_GET['sfera']!=='0' && count($data_boss_now)==1){?>
						<div><a href="/<?=$calcul?>/export_fact/?fromfact=<?=$data_boss_now[0]['id']?>&<?=$arr["query"]?>" onClick='return confirmDelete();'><b>Експорт з факту</b></a></div>
<?}
if( count($data_boss_now)>1){
foreach($data_boss_now as $dbn){
if($dbn['id']==$_GET['id_tarif']) continue;?>
						<div><a href="/<?=$calcul?>/export_fact/?fromfact=<?=$dbn['id']?>&<?=$arr["query"]?>" onClick='return confirmDelete();'><b>Експорт з факту "<?=$dbn["admin_text"]?>" з <?=$dbn["period_start"]?></b></a></div>
<?}}
if($_GET['sfera']!=='0'){?>
<div class="cont"><a href="#modal_skladova" class="modal_link" ><b>Виділити складову тарифа</b></a></div>
<?}?>
<?/*if($id_tarif['dilnica']>0){?><div><a href="/<?=$calcul?>/export_fact_select_dilnica/?<?=$arr["query"]?>" onClick='return confirmDeleteSfera();'><b>Виділити складову відокр. підрозділу №<?=$id_tarif['dilnica']?></b></a></div>
<?}*/?>
<div><a href="/<?=$calcul?>/export_A/?<?=$arr["query"]?>" onClick='return confirmDeleteSferaG();'><b>Експорт з галузевих гарантій поточного розпису (тарифу)</b></a></div>
<?{?><div><a href="/<?=$calcul?>/export_delete/?<?=$arr["query"]?>" onClick='return confirmDeleteAll();'><b>Видалити всі дані по професіям</b></a></div><?}?>

						</div>
			</div><?}?>
			<!---->
			<?$statusus='Не підтверджено';
if($sign_archives==1)$statusus='Підтверджено ('.$id_tarif['pidverdjeno_regional'].')';
	?>
			<div class="savebox" style="display: inline-block; " >
			<div class="link"><a href="#modal_saveboxq" class="modal_link"><span>Статус розрахунку: <?=$statusus?></span></a></div>
		</div>
		<!---------------------------------------------------------------------->
<div class="modal modal_chat" id="modal_saveboxq" style="display: none;">
		<div class="pad">
			<!--div class="title">спілкування для своїх</div-->
			<div class="title" style="color:#fff;background:<?=$bcg1?>"><?=$pidtverdjeno_pidpr?> <?=$id_tarif['pidverdjeno_pidpr']?></div><!--br/-->
			<div class="title" style="color:#fff;background:<?=$bcg2?>"><?=$pidtverdjeno_regional?> <?=$id_tarif['pidverdjeno_regional']?></div>

		</div>
	</div>
	</div></section>



<!---------------------------------------------------------------------->
 <?/*//$sign_archives=1;
if($sign_archives==0) { $savebox_style="margin-top:-58px;padding-left:60%;";?>
<section class="bng_section keys" style="margin-top:0px;padding-top:10px;">
		<div class="operatio cont">
			<div class="link"><a href="#" class="mini_modal_link" data-modal-id="#modal_ktelst"><span> Інструменти редагування</span></a></div>
	<!---------------------------------------------------------------------->				<div class="mini_modal" id="modal_ktelst" >

		<?if($_GET['sfera']!=='0'){?>
						<div><a href="/<?=$calcul?>/export_fact/?<?=$arr["query"]?>" onClick='return confirmDelete();'><b>Експорт з факту</b></a></div>

<?$y=0;while($y<count($data['list_archive'])){foreach($data['list_archive'][$y] as $zp):
?>
<div><a href="/calculations/export_archive/?<?=$arr["query"]?>&archive=<?=$zp?>" onClick='return confirmDelete();'><b>Експорт з архіву №<?=$zp?></b></a></div>
<?$y++;endforeach;}?>
<div class="cont"><a href="#modal_skladova" class="modal_link" ><b>Виділити складову</b></a></div>
<?}?>
<?if($id_tarif['dilnica']>0){?><div><a href="/<?=$calcul?>/export_fact_select_dilnica/?<?=$arr["query"]?>" onClick='return confirmDeleteSfera();'><b>Виділити складову вир. дільниці №<?=$id_tarif['dilnica']?></b></a></div>
<?}?>
<div><a href="/<?=$calcul?>/export_A/?<?=$arr["query"]?>" onClick='return confirmDeleteSferaG();'><b>Експорт з галузевих гарантій</b></a></div>
<?if($_GET['sfera']!=='0'){?><div><a href="/<?=$calcul?>/export_delete/?<?=$arr["query"]?>" onClick='return confirmDeleteAll();'><b>Видалити експортовані дані</b></a></div><?}?>

						</div>
			</div>


	</section>	<?}?>

	<?
	if($sign_archives==1) { $savebox_style="margin-top:0px;";}
$statusus='Не підтверджено';
if($sign_archives==1)$statusus='Підтверджено ('.$id_tarif['pidverdjeno_regional'].')';
	?>
<section class="bng_section savebox" style="padding-top:10px;padding-bottom:10px;<?=$savebox_style?>">
		<div class="cont" >
			<div class="link"><a href="#modal_savebox" class="modal_link"><span>Статус розрахунку: <?=$statusus?></span></a></div>
		</div>
	</section>
	<!--------------------------------------------------------->

	<!---------------------------------------------------------------------->
<div class="modal modal_chat" id="modal_savebox" style="display: none;">
		<div class="pad">
			<!--div class="title">спілкування для своїх</div-->
			<div class="title" style="color:#fff;background:<?=$bcg1?>"><?=$pidtverdjeno_pidpr?> <?=$id_tarif['pidverdjeno_pidpr']?></div><!--br/-->
			<div class="title" style="color:#fff;background:<?=$bcg2?>"><?=$pidtverdjeno_regional?> <?=$id_tarif['pidverdjeno_regional']?></div>

		<?	<div class="title" style="color:#fff;background:<?=$bcg3?>">
			    <?if($id_tarif['sign_archives']==''){?><a href="/calculations/archive_sfera/?<?=$arr["query"]?>" style="color:#fff;" >Зберегти в архів</a><?}?>
			<?if($id_tarif['sign_archives']!==''&& $_SESSION['status']=='1' ){?>
				<a href="/calculations/archive_sfera_change/?<?=$arr["query"]?>" style="color:#fff;" >Дозволити зміни в архіві</a><?}?>
				<?=$id_tarif['sign_archives']?></div>?>
		</div>


<!--img src="/cabinet/images/close.png" width="25" style="position:absolute;top:10px;right:10px;"--></div>

<?`type`='director' AND*/
$nm=$_GET['sfera'];$director= $db->getOne("SELECT `shtat_kilkist` FROM `calculation_garrantiesSfera_".$nm."`
WHERE  `archive`=?s AND `id_pidpriemstva`=?s",$_GET['id_tarif'],$_GET['id']);
if($director>=1)$alarm="Обережно! Будуть видалені професії, що не відносяться до даного тарифу!";
if($director<1 && $director>0)$alarm="Спочатку видаліть експортовані дані та заново експортуйте з факту.";
if($director==0)$alarm="";
?>
<div class="modal modal_chat" id="modal_skladova" style="display: none;">
		<div class="pad">
			<div class="title" style="color:#cd1000;"><?=$alarm?></div>
			</div>
	<div class="form">
			<form name="comment" method="POST" action="/<?=$calcul?>/workdifference_procent/?<?=$arr['query']?>">

				<div class="pad bord">
					<div class="title_form">Введіть частку персонала для тарифу</div>

					<!--<form method="post" action="" style="display:inline-block;">-->

				<div class="pad bord">
					<div class="line_form" align="right">
					  адміністративний персонал  <input type="text" name="admin_procent" size="3"value="<?=$id_tarif['admin_procent']?>">%
				</div>
                <div class="line_form"  align="right">
					   загальновиробничий персонал  <input type="text" name="work_procent" size="3" value="<?=$id_tarif['work_procent']?>">%
						</div>

					<div class="submit"><input type="submit" name="ok" value="Готово" class="submit_btn"></div>
				</div></div>
			</form>

	</div>
</div>

<style>
 .popup_calcult tr td{    padding-left:10px;
}
.divprof::-webkit-scrollbar { width: 10px}

.divprof::-webkit-scrollbar-track { background: #F7F7F7 }

.divprof::-webkit-scrollbar-thumb { -webkit-border-radius: 0px; border-radius: 0px; background: #0051a3; }

.divprof::-webkit-scrollbar-thumb:window-inactive { background: #0051a3; }

.divprof::-webkit-scrollbar-thumb:hover { background: #3d6b92; width:20px}

/*.popup_calcult2 a {*/
/*    color: #202020;*/
/*}*/
.divprof{
    float:right;width:54%;overflow-y: auto;max-height:80vh;margin-bottom:8px;margin-left:1%;
}
.popup_calcult,.divprof_row{
    /*display: block;font:400 14px/20px 'wf_SegoeUILight';*/
    /*font-family: Ubuntu;*/
    /*font:500 14px/20px Ubuntu;*/
}
.divprof_row:last-child div{
    border-bottom-style: solid;
}
.divprof_row_left{
   display: table-cell; float:left;width:83%;height:21px;overflow: auto; padding-left:5px;color:#202020;border-style:  solid  ;border-color:#202020;border-width: 1px;border-collapse:collapse;border-bottom-style: none;
}
.divprof_row_right{
    float:left;width:15.9%;height:21px;border-style:  solid  ;border-color:#202020;border-width: 1px;border-bottom-style: none;border-left-style: none;
}

.divprof_row a,.divprof_row{
    color: #202020; font-weight: normal;
}
.popup_calcult_close{margin-right:0.3%;margin-top:0px;height: 15px;width:15px;text-align:center;border:2px solid #0051a3;background:#fff;float:right;color:#0051a3;line-height: 0.5;
}
 .divprof_row:nth-child(2n+1) div,.popup_calcult tr:nth-child(2n+1) td   {
	background: #fff;/* фон нечетных строк */
}
.divprof_row:nth-child(2n) div,.popup_calcult tr:nth-child(2n) td  {
	background: #f4f4f4;/* фон четных строк */
}
.divprof_row:hover div,.divprof_row:hover div+div{
	background: #B4FFF2;
}
/**/

   .popup_calcult tr td {
    /*background: green;*/
    /*border-radius: 10px;*/
    /*padding: 20px;*/
    position: relative;
    /*color: #fff;*/
   }
   .popup_calcult tr td::after {
    content: '';
    position: absolute;
    right: -30px;
    /*top: 50%-20px; */
    /* Firefox */
/*top: -moz-calc(50% - 20px);*/
/* WebKit */
/*top: -webkit-calc(50% - 20px);*/
/* Opera */
/*top: -o-calc(50% - 20px);*/
/* Standard */
top: calc(50% - 10px);
   border: 10px solid transparent;
   /*border-left: 10px solid #0051a3;*/
   }
  .popup_calcult tr td.treangular:after
{
    border-left: 20px solid #0051a3;
}
.popup_calcult{float:left;width:45%;border-collapse:collapse;border-bottom-style: solid;border-width: 1px;
/*max-height: 85vh;*/

}
.popup_calcult tr td{float:left;width:100%;border-style: solid solid none solid ;border-color:#aaaaaa;border-width: 1px;
/*line-height:1.5;font-size: 20px;*/

}
</style>
<style>
.popup_proff{
overflow:hidden;
left:5%;
width: 90%;
}

  .popup_workers {
      /*width: 90%;*/
      overflow-y: auto;
      /*!important;*/
      display: block;
      min-height: 20em;
      max-height: 28em;
      height: 90vh;
      /*background:#aaaaaa;*/
      float:left;
      width:100%;
      color:white;
      /*border-color:#FFFAFA;*/
      border-collapse:collapse;
      /*border-bottom-style: solid;border-width: 1px;*/
      margin-bottom:20px;
    }
/*   table.popup_workers tr td select[name=rozdil_day_select] {*/
/*    width: 75px;*/
/*}*/
   table .popup_workers tr th{    min-width: 100px;    padding: 3px 7px;    color: #fff;    font: 15px/22px ;
   border-right: 1px solid #888888;
    border-left: 1px solid #888888;border-top: 1px solid #888888;
    /*background: #0051a3;*/
    background: #888888;
    text-align: left;
    color:white;border-style: solid solid none solid ;border-color:#aaaaaa;border-width: 1px;
   }
   table .popup_workers tr th:first-child{width:65%;
   }
       table .popup_workers tr th:last-child{width:35%;
   }

   table .popup_workers tr td{    padding: 0px 0px;
    padding-left:5px;
    color: #202020;    font: 300 14px ;    border: 0px solid #888888;    text-align: left;}
    table .popup_workers tr td:first-child{border-left: 1px solid #888888;
    }
    table .popup_workers tr td:last-child{border-right: 1px solid #888888;
    }
    table .popup_workers tr:last-child{border-bottom: 1px solid #888888;
    }
   table .popup_workers tr td:nth-child(2){
       width:30%;}
    table.popup_workers tr:first-child td{    border-top: none;}
    table .popup_workers tr td input{    padding: 0px 0px;
    color: #202020;    font: 300 14px ;    border: 1px solid #d3d3d3;    text-align: left;}
    table .popup_workers tr td select{    padding: 0px 0px;
    color: #202020;    font: 300 14px ;    border: 1px solid #d3d3d3;    text-align: left;}
    .popup_workers tr:nth-child(1)  {

}
table .popup_workers tr td label,table .popup_workers tr td input[type=text]{
    border: 1px solid #d3d3d3; color:#202020;
    display: inline-block;
    width:60px;
}


table .popup_workers tr td label input[type=text]{
    border: 0;width:40px;height: 20px;
}
   .popup_workers tr:nth-child(2n+1),.popup_workers tr:nth-child(2n+1) td input ,.popup_workers tr:nth-child(2n+1) td select  {
	background: #ffffff;/* фон нечетных строк */
}
.popup_workers tr:nth-child(2n),.popup_workers tr:nth-child(2n) td input ,.popup_workers tr:nth-child(2n) td select  {
	background: #f8f8f8;/* фон нечетных строк */
}
/**/
table .popup_workers tr td .checkbox_label   {
    border: 0;
}
table .popup_workers tr td .checkbox_label  input[type=checkbox] {
    /*border: 0;*/
    /*background: #ffffff;*/
    display: none;
}
.checkbox-custom {
	position: relative;      /* Обязательно задаем, чтобы мы могли абсолютным образом позиционировать псевдоэлемент внютри нашего кастомного чекбокса */
	width: 20px;             /* Обязательно задаем ширину */
	height: 20px;            /* Обязательно задаем высоту */
	border: 2px solid #ccc;
	border-radius: 3px;
	top: -2px;
}
.checkbox-custom
 {
	display: inline-block;
	vertical-align: middle;
}
 .checkbox_label  input[type=checkbox]:checked +  .checkbox-custom::before {
	content: "\2713";             /* Добавляем наш псевдоэлемент */
	display: block;			 /* Делаем его блочным элементом */
	position: absolute;      /* Позиционируем его абсолютным образом */
	color: #202020;/*top: 0px;*/
	/*right: 0px;*/
	/*bottom: 0px;*/
	/*left: 0px;*/
	/*background: #413548;      Добавляем фон. Если требуется, можете поставить сюда картинку в виде "галочки", которая будет символизировать, что чекбокс отмечен */
	border-radius: 2px;
}
/*     content: "\A0\A0\A0";*/

table .popup_workers tr:hover td,table .popup_workers tr:hover td input ,table .popup_workers tr:hover td select{
	background: #B4FFF2;
}
.popup_workers_close{margin-right:2%;margin-bottom:2%;height: 20px;width:20px;text-align:center;border:2px solid #0051a3;background:#fff;float:right;color:#0051a3;line-height: 1.0;
}
.popup_workers_submit{
    text-align:center;background-color:#0404B4;color:#fffbfb;border:0;font-size:150%;padding:10px 15px;
}

</style>
<?
if ($_SESSION['status']<'3'  && $no_change=='0') {
//797
?>

<a href="#modal" class="overlay" id="modalWindow_positionsWorkers"></a>
<div class="popup_calculat" style="max-height: 90vh;overflow-y:auto;" >

<div style="margin:0;height:400px;width:100%;">&nbsp;&nbsp;&nbsp; <b>Робітники</b>
<a class="popup_calcult_close" href="#close" style="">x</a><br/>
   <table  class="popup_calcult"  style="">


<?//var_dump($data['group_workers_popup'],$data['url_workers']);
//if($ugoda_class57!=='')
foreach($data['group_workers_popup'] as $num => $title) :
// $flag_title=0;$bg="#FFFAFA";
$urlw=0;
foreach ($data['url_workers'] as $url):
			if($url['type_of_work']==$title) {$urlw++;break;
			}
			endforeach;
if($urlw==0){continue;}

// if(isset($_GET['title'])&& $title==$_GET['title']){$flag_title=1;$bg="rgba(124, 205, 124, 0.4)";}
// 		var_dump($title);
		?>

    <tr><td style="" >
        <span class="navigatorItem"  style="padding-left:0px;font-size: 100%;" data-product="<?=$_GET['id']?>;;;<?=$num?>;;;<?=$title?>;;;<?=$added_url?>;;;<?=$_GET['sfera']?>;;;<?=$_GET['id_tarif']?>;;;<?=$calcul?>;;;<?=$_GET['diln']?>">
<a href="//database.fru-gkh.com.ua/<?=$calcul?>/inputdata_fact/?id=<?=$_GET['id'].$added_url?>&sfera=<?=$_GET['sfera']?>&id_tarif=<?=$_GET['id_tarif']?>&num=<?=$num?>&title=<?=$title?>#modalWindow_positionsWorkers"  style="" onclick="return false;" ><?=$title?> </a></span>
        </td>
    </tr>

<?endforeach;
?>
</table><?
?>

<div id="results"></div>
</div>

</div>





<!--закінчення Вибір робітничих професій за видом робіт-->

 <!--Вибір професій за групами (не робітничі професії) beginning...-->
<a href="#modal" class="overlay" id="modalWindow_positionsHeads"></a>
					<div class="popup_calculat" style="max-height: 90vh;overflow-y:hidden;" >

<div style="margin:0;height:100%;width:100%;">&nbsp;&nbsp;&nbsp; <b>Керівники</b>
<a class="popup_calcult_close" href="#close" style="">x</a><br/>
   <table  class="popup_calcult"  style="">
	<?$order=0;
foreach($data['group_heads_popup'] as $num => $title) :$order++;
// $flag_title=0;$bg="#FFFAFA";

$urlh=0;
foreach ($data['url_heads'] as $url):
			if($url['type_of_position']==$num) {$urlh++;break;
			}
			endforeach;
if($urlh==0){continue;}

// if(isset($_GET['title_g'])&& $title==$_GET['title_g']){$flag_title=1;$bg="rgba(124, 205, 124, 0.4)";}
						?>

    <tr>
<td style="" >
    <span class="navigatorItemHead"  style="padding-left:0px;" data-product="<?=$_GET['id']?>;;;<?=$num?>;;;<?=$title?>;;;<?=$order?>;;;<?=$added_url?>;;;<?=$_GET['sfera']?>;;;<?=$_GET['id_tarif']?>;;;<?=$calcul?>;;;<?=$_GET['diln']?>">
<a href="/<?=$calcul?>/inputdata_fact/?id=<?=$_GET['id']?><?=$added_url?>&sfera=<?=$_GET['sfera']?>&id_tarif=<?=$_GET['id_tarif']?>&num_g=<?=$num?>&title_g=<?=$title?>&order_g=<?=$order?>#modalWindow_positionsHeads"  style="" onclick="return false;" ><?=$title?> </a>
        </td>
    </tr>

<?endforeach;?>
</table><div id="resultsHead"></div>

 </div>

</div>
<?
}?>



<div class="tabledb" style="margin-top:25px;">
				<table >
					<thead>
						<tr>
							<th>&nbsp; </th>
		<th class="big">Професія  </th>
		<th>Код професії</th>
		<th>Категорія/група</th>
		<th>Коеф. І розряду </th>
		<th>Коеф. за посадою</th>
		<th>Коеф.робіт та проф.</th>
		<th>Терит. коеф.</th>
		<th>Штатна чисельність</th>
		<th>Оклад</th>
		<th>Доплата <br/>до рівня <br/>мін. з/п (грн.)</th>
		<th>Додаткова (грн)</th>
		<th><a href="/<?=$calcul?>/inputdataCA/?<?=$arr["query"]?>&min_zp=<?=$min_zp?>&fact=fact"  style="color:#f00;" style="text-decoration:underline;" target="_blank">Допл. та надб.(%)</a></th>
		<th>Премії(%)</th>
		<th>Заробітна плата (грн.)</th>
		<tbody>

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
// $teplo_itog=0;$vodo_itog=0;$tvp_itog=0;$jitlo_itog=0;$inshi_itog=0;$trans_itog=0;  $lift_itog=0;$RPV_itog=0;$vodovidvod_itog=0;
// $lift_fop=0;$lift_fop_rob_off=0; $lift_fop_rob=0;$lift_chiseln = 0;
// $vodovidvod_fop =0; $vodovidvod_chiseln =0;
//                         $RPV_fop =0; $RPV_chiseln=0;
$koef_posada_d = 0;
$quantity_workers=0;$quantity_heads=0;
// $blago_fop_rob = $blago_fop = $blago_fop_rob_off = $blago_chiseln =$blago=0;
// $fop_rob_off42=$fop_rob42=$fop42=$chiseln42=0;$fop_rob_off43=$fop_rob43=$fop43=$chiseln43=0;$fop_rob_off44=$fop_rob44=$fop44=$chiseln44=0;
// $fop_rob_off21=$fop_rob21=$fop21=$chiseln21=0;
        ?>
	<style>
		 .icon-remove-sign {
			 color:#708090;
		 }
		 .icon-remove-sign:hover {
			 color:#B22222;
		 }

		</style>

		<?

// if(count($data['diln'])>1){$count_h=array();
// foreach ($data['diln'] as $fordiln){
//     $count_h[$fordiln['dilnica']]=0;}
// 	foreach($data['all_d'] as $d):if($d['dilnica']==''){$count_h++;
//   	}
//   	if($count_h>0)break;
//   	endforeach;
// }
// var_dump($data['group']);
// foreach($data['all_d'] as $d){var_dump($d['id'],$d['positiosheads'],'h');}
// foreach($data['all_w'] as $d){var_dump($d['id'],$d['positiosworkers'],'w');}
// var_dump(count($data['group']),count($data['all_w']));$www=0;
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
// 	$groupgroup_name=$data['group']['group_heads'][$d['type']];
	$groupgroup_name=$data['group_heads_popup'][$d['type']];

	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
	?>

    <tr style="text-align:left;background:#fff;" class="profDelete0H" >

			<td style="text-align:left;background:#fff;"><div style="float:left">
			<? if($_SESSION['status']<'3' && ($sign_archives==0)) {?><a class="profDeleteH" href="/<?=$calcul?>/delpositions/?id=<?=$d['id']?>&sfera=<?=$_GET['sfera']?>&id_tarif=<?=$_GET['id_tarif']?>&diln=<?=$_GET['diln']?>&period_start=<?=$_GET['period_start']?>&position=positiosheads&id_factory=<?=$data['id']?><?=$added_url?>"
			onClick='profDeleteH();' title="Видалити даний рядок" class="del">
			<i class='icon-remove-sign' style="padding-right:5px;"></i></a><?}?>
			<?
/*if($d['dilnica']!==''){ $d['dilnica']=str_replace("№ ", "", $d['dilnica']);
?><span   style="font-size:110%;padding-right:0px;">&nbsp;<?=$d['dilnica']?> </span><?}*/

if($d['postachannia']!=='' && $d['postachannia'] !== '0'){
					if($d['postachannia']=='teplo' || $d['postachannia']=='Теплопостачання'|| $d['postachannia']=='Теплопостачання. Централізоване опалення'){?>
					<i  class='icon-adjust'  title="Сфера діяльності Теплопостачання. Централізоване опалення" style="color:rgba(178, 34, 34,  0.5);padding-right:1px;">&nbsp;  </i><?}
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
// 	$osnovna_zp_kontrakt= $data['name']['osnovna_zp_kontrakt'];$dodatkova_zp_kontrakt= $data['name']['dodatkova_zp_kontrakt'];
// $flag_kontrakt='';
// if($osnovna_zp_kontrakt>0 && $d['type']=='director'){
//     $koef_posada_teor=$modelc->director($_GET['id']);
//     // $dodatkova_zp_kontrakt
//     $koef_posada=round($d['koef_posada'.$c_57.''],2);
//     if($koef_posada>$koef_posada_teor)$flag_kontrakt='<span style="color:#f00;">k</span>';
//     // var_dump($flag_kontrakt,$osnovna_zp_kontrakt,$dodatkova_zp_kontrakt);
// }////////////
			?></div></td><td style="text-align:left;">
			<? if($_SESSION['status']<'3'  && ($sign_archives==0)) {?><a href="#modalWindow<?=$d['id']?>"><?=$d['positiosheads']?></a><?}else {echo $d['positiosheads'];}?>
			<?=$flag_kontrakt?>
			<?
			$modal_window = 'edit_garranty';
			?>
			<a href="#modal" class="overlay" id="modalWindow<?=$d['id']?>"></a>
					<div class="popup_proff">
						<?

if($ugoda_class57=='ugoda57')$calcul='calcul';else $calcul='calculations';

						$this->model->modalWindow($modal_window, array('added_url'=>$added_url, 'r'=>$d['id'],'heads'=>$d,'postachannia_mini'=>$postachannia_mini,'vacancia_select'=>$data['vacancia_select'],
						'intensyvnist'=>$data['intensyvnist'],
						'shkidlyvist'=>$data['shkidlyvist'],
						'table'=>'positiosheads','sfera'=>$_GET['sfera'],'tarif'=>$_GET['id_tarif'], 'i'=>$d['id_pidpriemstva'], 'diln'=>$_GET['diln'],'calcul'=>$calcul));?>
						<a class="close" href="#close"></a>
					</div>
			</td>
			 <?//include 'garantiiFact_Head.php';
		$quantity_heads+= $d['shtat_kilkist'];


			if($d['percent_input_fact']==0) {
			$d['percent_input_fact'] = '';
		}
			if($d['doplata_fact']==0) {
			$d['doplata_fact'] = '';
		}
			if($d['dodatkova_fact']==0) {
			$d['dodatkova_fact'] = '';
		}
		if($d['zaohoch_percent']==0) {
			$d['zaohoch_percent'] = '';
		}?>

				<td><?=$d['kod']?> </td>
			<td><?if($tab['sfera_22']=='')echo $d['category'];?></td>
			<td title="<?=$d['koef_I_rozr'.$c_57.'']?>"><?=$d['koef_I_rozr_fact']?></td><!-- Коеф первого разряда-->
	<td title="<?=$d['koef_posada'.$c_57.'']?>"><?=round($d['koef_posada_fact'],2)?></td><!-- Коеф. за посадою -->
		<td title="<?=round($d['koef_rob_prof'.$c_57.''],2)?>"><?=round($d['koef_rob_prof_fact'],2)?></td>
		<td><?=$d['regional_koef_fact']?></td>
		<td><?=$d['shtat_kilkist']?></td>
		<td title="<?=$d['oklad'.$c57.'']?>"><?=$d['oklad_fact']?></td>
		<td title="<?=$d['doplata'.$c57.'']?>"> <?=($d['doplata_fact'])?><?//var_dump($oklad,$dodatkova_update);?></td>


		<td title="<?=$d['dodatkova'.$c57.'']?>"><?=($d['dodatkova_fact'])?></td>

		<td title="<?=$d['percent_inputA'.$c57.'']?>"><?=$d['percent_input_fact']?></td>
		<td><?=$d['zaohoch_percent']?></td>

		<td title="<?=$d['fop'.$c57.'']?>"><?if($d['vacancia']==1){
				echo 'Вакансія';}else{echo $d['fop_fact'];}?></td>

		</tr>
	<?
	//}
	endforeach;
// 		endforeach;
// 		endforeach;endif;

		$all_oklad=round($data['sets_array'][1],2);
		$all_doplata=round($data['sets_array'][2],2);
		$all_dodatkova=round($data['sets_array'][3],2);
		$all_zarplata=round($data['sets_array'][4],2);

	if($_GET['diln']>0){
	    $diln_zp=$data['sets_array'][10];
	   $all_oklad= $diln_zp['№ '.$_GET['diln']]['all_oklad'];
	   $all_doplata= $diln_zp['№ '.$_GET['diln']]['all_doplata'];
	   $all_dodatkova= $diln_zp['№ '.$_GET['diln']]['all_dodatkova'];
	   $all_zarplata= $diln_zp['№ '.$_GET['diln']]['all_zarplata'];
	 }
	 if($_GET['diln']=='empty'){
	    $diln_zp=$data['sets_array'][10];
	   $all_oklad= $diln_zp['']['all_oklad'];
	   $all_doplata= $diln_zp['']['all_doplata'];
	   $all_dodatkova= $diln_zp['']['all_dodatkova'];
	   $all_zarplata= $diln_zp['']['all_zarplata'];
	  }
	 ?>


    <tr style="background:rgba(205, 16, 0, 1);color:#fff;"><td> &nbsp;</td>
		<td style="color:#fff;">ВСЬОГО </td>
		<td style="color:#fff;" colspan="6" rowspan="1"></td>
		<td style="color:#fff;"><b><?=round($quantity_heads, 2)?></b></td>
		<td style="color:#fff;"><b>  <?=round($all_oklad,2)?>    </b></td><td style="color:#fff;"><b><?=round($all_doplata,2)?></b></td>
		<td style="color:#fff;"><b><?=round($all_dodatkova,2)?></b></td>
		<td style="color:#fff;"><b></b></td><td style="color:#fff;"><b></b></td>

		<td style="color:#fff;"><b><?=round($all_zarplata,2)?></b></td>
    </tr>
<tr style="background:rgba(185, 211, 238 ,0.6);color:black;text-align:left;">
	<td colspan="15"><a  id="workers"></a>	</td>

</tr>
    <tr style="background:rgba(124, 205, 124, 0.4);color:#8B3A3A;font-size:83%;">
    <th> &nbsp;</th>
		<th>Професія </th>
		<th>Код професії</th>
		<th>Розряд</th>
		<th>коеф. І розряду</th>
		<th>Коеф. за розрядом</th>
		<th>Коеф. робіт та проф.</th>
		<th>Терит. коеф.</th>
		<th>Штатна чисельність</th>
		<th>Оклад</th><th>Доплата <br/>до рівня <br/>мін. з/п (грн.)</th>
		<th>Додаткова (грн)</th>
		<th><a href="/<?=$calcul?>/inputdataCA/?<?=$arr["query"]?>&min_zp=<?=$min_zp?>&fact=fact"  style="color:#f00;" style="text-decoration:underline;"  target="_blank">Допл. та надб.(%)</a></th>
		<th>Премії(%)</th>
		<th>Заробітна плата (грн.)</th>
    </tr>
    <tbody class="parents-turn">


	<?
// 	$all_oklad2 = 0;$inshi_fop_rob=0;
	$off_season = 0;
// 	$teplo_postachannia_off = 0;$vodo_postachannia_off = 0;$tvp_postachannia_off = 0;$jitlo_postachannia_off = 0;
// 	$teplo_postachannia = 0;$vodo_postachannia = 0;$tvp_postachannia = 0;$jitlo_postachannia = 0;
// 	$RPV_postachannia = 0;$vodovidvod_postachannia = 0;
// 	$vodovidvod_fop_rob =0; $vodovidvod_fop_rob_off =0;$RPV_fop_rob =0; $RPV_fop_rob_off =0;
// 		//$all_fop_workers = 0;
	//$dodatkova_sum_workers = 0;
//var_dump($count_h,$d['positiosworkers']);

//var_dump($data['all_w_diln']);
	//////////////////////////////////////////diln
	if($_GET['diln']=='empty' || $_GET['diln']>0)$data['all_w']=$data['all_w_diln'];
	/////////////////////////////////////////////
	$flag_diln='0';$flag_group='';
	$q_workers = $data['quantity_workers'];
// 	$dds=0;
	foreach($data['all_w'] as $d):
// 		$www++;var_dump($www);
// 	$dds++;
// 	if($dds==5)	break;

	if($_GET['diln']==0 && $_GET['diln']!=='empty' && count($data['diln'])>1 && $flag_diln!==$d['dilnica']){


      if($d['dilnica']=='') {$fordiln_name='Головне підприємство';}
  else $fordiln_name='Відокремлений підрозділ '.$d['dilnica'];

  ?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;font: 700 16px Ubuntu;"><?=$fordiln_name?></td></tr>
	<?}
	$groupgroup_name=$d['type'];
	if($d['type']=='Невиробничі види робіт і послуг (управління та утримання житлових будинків, санітарне утримання об`єктів та територій, зелене будівництво та садово-паркове господарство, технічна інвентаризація об`єктів нерухомості; відлов та догляд за безпритульними тваринами; обслуговування готелів та гуртожитків; побутові та індивідуальні послуги; оптова та роздрібна торгівля; громадське харчування; друкарська діяльність; послуги поштового та електрозв`язку; адміністративні та інформаційно-диспетчерські послуги; охоронна діяльність)') $groupgroup_name='Невиробничі види робіт і послуг';
if($d['type']=='Ремонт, налагодження, обслуговування устаткування, контрольно-вимірювальних приладів, автоматики, електронно-обчислювальної техніки, машин, механізмів, службових та виробничих приміщень, будівель та споруд, багатоквартирних будинків') $groupgroup_name='Ремонт, налагодження, обслуговування устаткування, приладів, автоматики, техніки, машин, механізмів, приміщень, будівель та споруд, багатоквартирних будинків';

	if ($flag_group!==$groupgroup_name)
		{
	?>
	<tr><td colspan="15" rowspan="1" style="text-align:left;"><?=$groupgroup_name?></td></tr>
	<?}
	$flag_diln=$d['dilnica'];$flag_group=$groupgroup_name;
		?>
			<tr style="text-align:left;background:#fff;" class="profDelete0" >
				<td  style="text-align:left;vertical-align: middle;">

					<? if($_SESSION['status']<'3' && ($sign_archives==0)) {?><a class="profDelete" href="/<?=$calcul?>/delpositions/?id=<?=$d['id']?>&sfera=<?=$_GET['sfera']?>&id_tarif=<?=$_GET['id_tarif']?>&position=positiosworkers&diln=<?=$_GET['diln']?>&period_start=<?=$_GET['period_start']?>&id_factory=<?=$data['id']?><?=$added_url?>" onClick='profDelete();' title="Видалити даний рядок" class="del"><i class='icon-remove-sign' style="padding-right:5px;"></i></a><?}?>

					<!-- Для введения записи -->
					<?
/*if($d['dilnica']!==''){ $d['dilnica']=str_replace("№ ", "", $d['dilnica']);
?><span   style="font-size:110%;padding-right:0px;">&nbsp;<?=$d['dilnica']?> </span><?}*/

					if($d['postachannia']!=='' && $d['postachannia'] !== '0'){
					if($d['postachannia']=='teplo' || $d['postachannia']=='Теплопостачання'|| $d['postachannia']=='Теплопостачання. Централізоване опалення'){?>
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


					if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']!=0){?><i  class='icon-cog' title="Сезонна професія" style="color:rgba(255, 69, 0, 0.7) ;padding-left:1px;"> </i><?}
if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0){?><i  class='icon-cog' title="Acезонна професія" style="color:rgba(25, 69, 0, 0.7) ;padding-left:1px;"> </i><?}?>

</td>

					<td style="text-align:left;">

			<?/*	if($_SESSION['status']<'3' &&($sign_archives==0)) {?>	<a href="#modalWin"  onclick="showContent('/helpers/edit_garranty_workers_ajax.php?r=<?=$d['id']?>&workerr=<?=$d?>&postachannia_mini=<?=$postachannia_mini?>&table=positiosworkers&sfera=<?=$_GET['sfera']?>&tarif=<?=$_GET['id_tarif']?>&i=<?=$d['id_pidpriemstva']?>&calcul=<?=$calcul?>&diln=<?=$_GET['diln']?>')">
		      <?=$d['positiosworkers']?></a><?}else
					{echo $d['positiosworkers'];}/*?>

        <!-- <a href="#modalWin"  onclick="showContent('/calculations/edit_garranty_workers_ajax/?r=<?=$d['id']?>&table=positiosworkers&sfera=<?=$_GET['sfera']?>&tarif=<?=$_GET['id_tarif']?>&i=<?=$d['id_pidpriemstva']?>&calcul=<?=$calcul?>&diln=<?=$_GET['diln']?>')"title='' >-->
		      <!--<i class='icon-phone-sign' style="color:green;"></i></a>-->
		      <?*/

					if($_SESSION['status']<'3' &&($sign_archives==0)) {?><a href="#modalWindow<?=$d['id'].'1'?>"><?=$d['positiosworkers']?></a><?}else
					{echo $d['positiosworkers'];}

?>
<a href="#modal" class="overlay" id="modalWindow<?=$d['id'].'1'?>"></a>
					<div class="popup_proff">
					<?//include 'helpers/edit_garranty_workers_include.php';
					$this->model->modalWindow('edit_garranty_workers', array('r'=>$d['id'],'workerr'=>$d,'postachannia_mini'=>$postachannia_mini,
					'vacancia_select'=>$data['vacancia_select_w'],
						'intensyvnist'=>$data['intensyvnist'],'shkidlyvist'=>$data['shkidlyvist'],'table'=>'positiosworkers', 'sfera'=>$_GET['sfera'],'tarif'=>$_GET['id_tarif'],'i'=>$d['id_pidpriemstva'],'diln'=>$_GET['diln']));
					?>
					<a class="close" href="#close"></a>
					</div>


				</td>
				<?//include 'garantiiFact_Worker.php';
						if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0) {$echo_shtat_kilkist= $d['off_season'];}else{$echo_shtat_kilkist= $d['shtat_kilkist'];}

				$quantity_workers+= $d['shtat_kilkist'];$off_season += $d['off_season'];
	if($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0){
    $quantity_workers+= $d['off_season'];}

    	if($d['percent_input_fact']==0) {
			$d['percent_input_fact'] = '';
		}
			if($d['doplata_fact']==0) {
			$d['doplata_fact'] = '';
		}
			if($d['dodatkova_fact']==0) {
			$d['dodatkova_fact'] = '';
		}
		if($d['zaohoch_percent']==0) {
			$d['zaohoch_percent'] = '';
		}?>


				<td><?=$d['kod']?> <?//var_dump($proffecy['kod_proffecy']);
				?></td>
				<td><?=$d['rozryad'] ?></td>
				<td  title="<?=$d['koef_I_rozr'.$c_57.'']?>"><?=$d['koef_I_rozr_fact']?></td>
				<td title="<?=$d['koef_posada'.$c_57.'']?>"><?=$d['koef_posada_fact']?></td><!-- Коеф. за посадою -->
				<td title="<?=round($d['koef_rob_prof'.$c_57.''],2)?>"><?=round($d['koef_rob_prof_fact'],2)?></td>
				<td><?=$d['regional_koef_fact']?><?/*=$regional_coef*/?></td>
				<td><?=$echo_shtat_kilkist?>
</td>
<td title="<?=$d['oklad'.$c57.'']?>"><?=$d['oklad_fact']?></td>
		<td title="<?=$d['doplata'.$c57.'']?>"> <?=($d['doplata_fact'])?>
<td title="<?=$d['dodatkova'.$c57.'']?>"><?=($d['dodatkova_fact'])?></td>
<td title="<?=$d['percent_inputA'.$c57.'']?>"><?=$d['percent_input_fact']?></td>
		<td><?=$d['zaohoch_percent']?></td>
		<?	if($d['vacancia']==1){
					$titleA = 'Вакансія';
				}elseif($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0) {
					$titleA = $d['zarplata_off'.$c57.''];
				}else{
					$titleA = $d['fop'.$c57.''];
				}?>
				<td title="<?=$titleA?>"><?if($d['vacancia']==1){
				echo 'Вакансія';}elseif($d['shtat_kilkist']!==$d['off_season']&& $d['shtat_kilkist']==0) {echo $d['zarplata_off_fact'];}
else{echo $d['fop_fact'];}?>
</td>


			</tr>

				<?

			//var_dump($zarplata2,  $all_zarplata2);
			endforeach;
			///////////////////////////////////////////

	$all_oklad2=round($data['sets_array'][5],2);
		$all_doplata2=round($data['sets_array'][6],2);
		$all_dodatkova2=round($data['sets_array'][7],2);
		$all_zarplata2=round($data['sets_array'][8],2);
		$all_zarplata_off=round($data['sets_array'][9],2);


	if($_GET['diln']>0 ){
	    $diln_zp=$data['sets_array'][10];
	   $all_oklad2= $diln_zp['№ '.$_GET['diln']]['all_oklad2'];
	   $all_doplata2= $diln_zp['№ '.$_GET['diln']]['all_doplata2'];
	   $all_dodatkova2= $diln_zp['№ '.$_GET['diln']]['all_dodatkova2'];
	   $all_zarplata2= $diln_zp['№ '.$_GET['diln']]['all_zarplata2'];
	   $all_zarplata_off= $diln_zp['№ '.$_GET['diln']]['all_zarplata_off'];
	 }
	 if($_GET['diln']=='empty'){
	    $diln_zp=$data['sets_array'][10];
	   $all_oklad2= $diln_zp['']['all_oklad2'];
	   $all_doplata2= $diln_zp['']['all_doplata2'];
	   $all_dodatkova2= $diln_zp['']['all_dodatkova2'];
	   $all_zarplata2= $diln_zp['']['all_zarplata2'];
	   $all_zarplata_off= $diln_zp['']['all_zarplata_off'];
	 }
// 	number_format($number, 2, ',', ' ')
// var_dump($data['sets_array'],  $all_oklad2,$all_zarplata2);
?>
	</tbody>
	<tr style="background:rgba(205, 16, 0, 1);color:#fff;"><td> &nbsp&nbsp&nbsp</td>
		<td style="color:#fff;">ВСЬОГО </td>
		<td style="color:#fff;" colspan="6" rowspan="1"></td>
		<td style="color:#fff;"><b><?=round($quantity_workers, 2)?></b></td>
		<td style="color:#fff;"><b>  <?=round($all_oklad2,2)?>    </b></td><td style="color:#fff;"><b><?=round($all_doplata2,2)?></b></td>
		<td style="color:#fff;"><b><?=round($all_dodatkova2,2)?></b></td>
		<td style="color:#fff;"><b></b></td><td style="color:#fff;"><b></b></td>

		<td style="color:#fff;"><b><?=round($all_zarplata2,2)?></b></td>
    </tr>

    <!------------------------->

    <tr style="background:rgba(205, 16, 0, 1);color:#fff;">
		<td colspan="8" rowspan="1"style="text-align:left;color:#fff;"><b>Всього по підприємству:</b></td>
		<?$itog = $all_zarplata+$all_zarplata2;

	$itog_chiseln = $quantity_workers+$quantity_heads;
		$nbsp='&nbsp;';
		?>

		<td style="color:#fff;"><b><?=round($quantity_workers+$quantity_heads,2)?></b></td>
		<td style="color:#fff;"> <b><?=round($all_oklad2+$all_oklad,2)?></b> </td><td style="color:#fff;"><b><?=round($all_doplata2+$all_doplata,2)?></b> </td>

		<td style="color:#fff;"><b><?=round($all_dodatkova2+$all_dodatkova,2)?></b></td>

		<td style="color:#fff;"></td><td style="color:#fff;"></td>

		<td style="color:#fff;"><b><?=round($all_zarplata2+$all_zarplata,2)?></b></td>

    </tr>
    <??>
    <tr >

		<td colspan="8" rowspan="1" style="text-align:left;"><b>Скорочення у міжсезонний період</b></td>



		<td><b>-<?=round(abs($quantity_workers-$off_season),2)?><?/*var_dump($quantity_workers,$quantity_heads,$off_season)*/?></b></td>

		<!---------->
		<td colspan="5" >   <b></b>     </td>



		<td><b><?=round(($all_zarplata2)-$all_zarplata_off,2)?></b></td>

    </tr><!------------------------->

	<!-- (Зар.плата – Додаткова)/Зар.плата*100 -->
		<?
		$chastka_fop = ($all_zarplata+$all_zarplata2);

		$chastka_dodatkova = ($all_dodatkova2+$all_dodatkova);
		 if($chastka_fop>0){?>
		<tr>
		<td colspan="14" rowspan="1" style="text-align:left;">

			<b>Частка посадового окладу у складі середньої заробітної плати працівників (не нижче 70%) </b>

		</td>
		<td>

			<b><?=round(($chastka_fop-$chastka_dodatkova)/$chastka_fop*100, 2)?></b>

		</td>
	</tr>




	<?}
	?>



    <tr>
        <td colspan="14" rowspan="1" style="text-align:left;">
            <b>Середньомісячний ФОП</b>
        </td>
        <?$ser_fop=0; $ser_fop=round(round($all_zarplata,2)+(round($all_zarplata2,2)*$sezon+round($all_zarplata_off,2)*(12-$sezon))/12,2);?>
        <td>
            <b><?=$ser_fop?></b>
        </td>
    </tr>
<!-------------------------------->
<tr>
        <td colspan="14" rowspan="1" style="text-align:left;">
            <b>Середньомісячна чисельність</b>
        </td>
       <?$chiselnist = round(($quantity_heads)+ ($quantity_workers*$sezon+$off_season*(12-$sezon))/12,2);
      $ser_fop_chiselnist=0;
      if($chiselnist>0)$ser_fop_chiselnist=round($ser_fop/$chiselnist,2);?>
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
            <b><?=$ser_fop_chiselnist?></b>
        </td>
    </tr>
<!-------------------------------->
<?if($_GET['sfera']==0){
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
// var_dump($data['sets_array'][10],$data['sets_array'][11]);
// var_dump($data['sets_array'][0]);//nevidm
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

    //  $sezon=7;
   $plus_chiseln= round($proporcia_chiseln*$s['chiseln']/$postach_chiseln,2);//відсоток
   $teplo= round($s['fop']/$postach,2);//відсоток
$s_itog=round((($s['fop']+$proporcia*$teplo)*$sezon+($s['fop_off']+$proporcia*$teplo)*(12-$sezon))/12,2);

//  $teplo_postachannia=round($teplo_fop+$teplo_fop_rob);$teplo_postachannia_off=round($teplo_fop+$teplo_fop_rob_off);

//   var_dump($plus_chiseln,$s['chiseln'],$teplo,$s['fop'],$s['fop_off'],$proporcia,$sezon,'rr');
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

}?>

</tbody>
				</table>
			</div>

<br/><br/></section>




<div style="height:250px;"></div>


<?
// var_dump(time(),date("F j, Y, g:i:s a"));
?>
		<!--     МОДАЛЬНЫЕ ОКНА ОШИБОК      onclick="show_alert()"      -->


		<!--<a href="#modalWindow"></a>-->
		<!--<a href="#modal" class="overlay" id="modalWindowKilkist"></a>-->
		<!--		<div class="popup_introduce"> -->
		<!--			<?/*$this->model->modalWindow('kilkist', array('diln'=>$data['diln'],'id'=>$_GET['id'], 'added_url'=>$added_url));*/?>-->
		<!--			<a class="close" href="#close"></a>-->
		<!--		</div>-->

		<a href="#modalWindow"></a>
		<a href="#modal" class="overlay" id="modalWindowPidpys"></a>
				<div class="popup">
					<?$this->model->modalWindow('pidpys', array());?>
					<a class="close" href="#close"></a>
				</div>

		<a href="#modalWindow"></a>
		<a href="#modal" class="overlay" id="modalWindowZamok"></a>
				<div class="popup">
					<?$this->model->modalWindow('zamok', array());?>
					<a class="close" href="#close"></a>
				</div>

		<a href="#modal" class="overlay" id="error_message"></a>

			<div class="popup_calculations">
				<?
					$this->model->modalWindow('error_message', array('error'=>'Tака група вже існує в таблиці данного підприємства!<br/> Будьте уважним!'));
				?>
					<a class="close" href="#close"></a>
			</div>


		<!--a href="#modal" class="overlay" id="error_messagehigherGroup"></a>

			<div class="popup_calculations">
				<?
					$this->model->modalWindow('error_message', array('error'=>'Спочатку створіть профессію в группі керівник!<br/>За допомогою натисніть знак питання.'));
				?>
					<a class="close" href="#close"></a>
			</div-->


		<a href="#modal" class="overlay" id="input_for_kontrakt"></a>

			<div class="popup_calculations">
				<?
					$this->model->modalWindow('input_for_kontrakt', array());
				?>
					<a class="close" href="#close"></a>
			</div>

			<style>
#content{margin-top:0px;padding-top:0px;}
</style>
<script>



    function profDelete()
						{
							if (confirm("Ви впевнені?"))
							{
								$('.profDelete0').on('click', '.profDelete',
								function(e)
								{
									var href = $(this).attr('href');
						//	console.log(href,'wys',this.parentNode.parentNode);
									$.ajax({
										url:href,
										dataType:'html'//,
									});
					this.parentNode.parentNode.remove();

					//this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
					//alert('d');
// где this - это div.closed				//showContent('/ajax/ajax_comment_cabinet.php?id=<?=$_GET["id"]?>&cat='+cat);

									setTimeout( e.preventDefault(), 200);
								})

							} else
							{ event.preventDefault();
							    	//return false;
							}
						}
</script>

<script>
    function profDeleteH()
						{
							if (confirm("Ви впевнені?"))
							{
								$('.profDelete0H').on('click', '.profDeleteH',
								function(e)
								{
									var href = $(this).attr('href');
							//console.log(href,'wys',this.parentNode.parentNode);
									$.ajax({
										url:href,
										dataType:'html'//,
									});
					this.parentNode.parentNode.parentNode.remove();

							//showContent('/ajax/ajax_comment_cabinet.php?id=<?=$_GET["id"]?>&cat='+cat);

									setTimeout( e.preventDefault(), 200);
								})

							} else
							{
								event.preventDefault();
							}
						}
</script>
<script>
			function showContent(link) {

				var cont = document.getElementById('contentBody');
				var loading = document.getElementById('loading');

				cont.innerHTML = loading.innerHTML;

				var http = createRequestObject();					// создаем ajax-объект
				if( http ) {
					http.open('get', link);							// инициируем загрузку страницы
					http.onreadystatechange = function () {			// назначаем асинхронный обработчик события
						if(http.readyState == 4) {
							cont.innerHTML = http.responseText;		// присваиваем содержимое
				// 	console.log(http.responseText);
					}
					}
					http.send(null);
				} else {
					document.location = link;	// если ajax-объект не удается создать, просто перенаправляем на адрес
				}
			}

			// создание ajax объекта
			function createRequestObject() {
				try { return new XMLHttpRequest() }
				catch(e) {
					try { return new ActiveXObject('Msxml2.XMLHTTP') }
					catch(e) {
						try { return new ActiveXObject('Microsoft.XMLHTTP') }
						catch(e) { return null; }
					}
				}
			}
		</script>
		<script>
// 		$(function(){
//     $('#contentBody').on('click', '#contentK .koeffic', function(){
//          console.log('sss');
// 		      //  jQuery.scrollTo('#wrapper');
// 		      jQuery.mask("9.99");
// 		  //  jQuery(function($){
// 			 //   $('#contentK .koeffic').mask("9.99");
// 			 //$("#phone").mask("(999) 999-9999");
// 		  // });

// 		    });
// });

$.getScript("../../js/jquery.maskedinput.js", function(){

		    $('#contentBody').on('click', '#contentK .koeffic', function(){
		      //console.log('sss');
		      this.focus();
            this.setSelectionRange(0,0);
            $(this).mask("9.99");
         //return false;

// 		   function setSelectionRange(input, selectionStart, selectionEnd) {
//   if (input.setSelectionRange) {
//     input.focus();
//     input.setSelectionRange(selectionStart, selectionEnd);
//     //console.log(input.val());
//   }
//   else if (input.createTextRange) {
//     var range = input.createTextRange();
//     range.collapse(true);
//     range.moveEnd('character', selectionEnd);
//     range.moveStart('character', selectionStart);
//     range.select();
//   }
// }


		    });
});

$('#contentBody').on('change', 'select[name=postachannia] :not(:first-child)', function(){
// $(document).ready(function() {
//text = "Теплопостачання Управління та утримання будинків та прибудинкових територій";
//var mySel = document.getElementById('for_select').value;//
var mySel = $('.id_for_select').val(),mySelp = $(this).val(); //edit_heads.php
//$('#company-products').children('option:not(:first)').remove();
console.log(mySelp,mySel,'ff');
 if(typeof(mySelp)!='undefined' && typeof(mySel)!='undefined'){
$('select[name=postachannia] :not(:first-child)').each(function(){
if(mySel.indexOf(this.text) + 1==false & this.text!='inshe' ) {
this.remove();
}

});}
})
		</script>
		<a href="#modal1" class="overlay" id="modalWin" ></a>
        <div class="popup" style="width:90%;margin-top:-10%;margin-left:20%;">
		    <div id="contentBody"></div>

										<div id="loading" style="display: none">
											Завантаження даних, чекайте...
										</div>

         </div>
