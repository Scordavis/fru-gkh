 		<img src="/images/142.gif" id="preloader1" style="position:fixed;left:43%;top:25%;">

	<link rel="stylesheet" type="text/css"  href="/css/style_kotelna.css?rnd=5"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css"  href="/css/css_dilnicy_garB.css?rnd=5"/>
	<style>

</style>



<div id='main_block1' style='height:0px;display:none;'>
	<div id='error_message'></div>
	<input type="hidden" name="form_name" value="introduceB">
	<?

	ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
	$added_url = '';

	$c = 0;$c1 = 0;//ini_set('display_errors', 1);//
	$db = new SafeMySQL();
$sfera=$db->getRow ("SELECT * FROM `table_1` WHERE `id`=?s",  $_GET['id']);
$data['d']=$sfera;
	$editRecordT10 =$db->getRow('SELECT * FROM `table_10` WHERE `id_pidpriemstva`=?i', $_GET['id']);//
	$sezon= $db->getOne("SELECT `sezon` FROM  `calculation_workers` WHERE `id_pidpriemstva`=?s",  $_GET['id']);//
$sferaB=$db->getAll ("SELECT * FROM `calculation_garrantiesWorkersB` WHERE `id_pidpriemstva`=?s ORDER BY `positiosworkers`" ,  $_GET['id']);

$logo_href='href="/usercabinet//?id='.$_GET['id'].'" title="В кабінет підприємства"';
			if( $_SESSION['status']=='4' )$logo_href='href="#"';

?>

<!-- Шапка -->
	<header class="inner">
		<div class="cont">
			<div class="sector_flex">
				<div class="logo">
					<a <?=$logo_href?>>
						<span>
							<b><?=$data['name']['povne_naymenuvannya']?></b><br/>

			<?=$data['name']['region']?><br/>  <?=$data['name']['misto']?>
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

  </style>
<?if($data['name']['ugoda']=='26'  || ($data['name']['ugoda']==''))$ugoda_class26='ugoda26';else $ugoda_class26='';//|| $data['name']['data_obliku']!==''
if($data['name']['ugoda']=='57' )$ugoda_class57='ugoda57';else $ugoda_class57='';//|| $data['name']['ugoda_date']!==''
?>


	<!-- Основная часть -->
	<section>
		<div class="cont">
			<div class="main_titler">Виробничі дільниці підприємства </div>
		</div>
	</section>

		<section class="section_edit">
	<div class="bng_red">
			<div class="cont">
				<div class="box_flex box_flex--small">
<div class="edit"><a href="/calculations/inputdataB/?id=<?=$sfera['id'].$added_url?>&user=" class="<?=$ugoda_class26?>" target="_blank" >
            				    Нормативні витрати <span style="color:#959595;">(гарантії B № 26)</span></a>
            				    </div>

            				    <div class="edit">
    <a href="/calcul/inputdataB/?id=<?=$sfera['id'].$added_url?>&user=" class=" <?=$ugoda_class57?>" target="_blank" >
            				    Нормативні витрати <span style="color:#959595;">(гарантії B № 57)</span></a>
</div>
<?if( $_SESSION['status']!=='4' ){?>	<div class="edit"><a href="/calculations/creator/?id=<?=$_GET['id'].$added_url?>" target="_blank" class="submit_btn">
    Створити нову дільницю</a></div>
<div class="edit">
    <input type="hidden" data-product="<?=$_GET['id']?>;<?=$sfera['povne_naymenuvannya']?>" id="transport_dil" value="">
<form id="price" style="float:left;" action="/calculations/editsearch_dilnycia/?id=<?=$_GET['id'].$added_url?>" method="POST">
<?$ccc=0;$count_dilnic = $db->getOne("SELECT COUNT(id) FROM  `table_10` WHERE `id_pidpriemstva`=?s AND `tip_dilnyci`!= 'Будинок'",  $_GET['id']);
//AND `tip_dilnyci`!= 'Будинок'
while ($ccc < $count_dilnic) {$ccc++;//var_dump($ccc);
?>
<input type="hidden" name="search_dil<?=$ccc?>" id="search_dil<?=$ccc?>" value="">
<?}?>
<div class="form_edit  "><a href="#modal_skladova" class="modal_link" Id="hidevhileloading1"  onClick="repeatForms1();document.forms['price'].submit();">Оновити штатну чисельність
</a></div>
<script>
document.getElementById("hidevhileloading1").setAttribute("style", "visibility: hidden");
window.onload = function() {
   document.getElementById("hidevhileloading1").setAttribute("style", "visibility: visible");
   };
</script>
</form></div><?}?>
				</div>
			</div>
		</div>
	</section>

<div class="modal modal_chat" id="modal_skladova" style="display: none;">
		<div class="pad">
			<div class="title" style="color:#cd1000;">Зачекайте... іде оновлення даних в гарантіях В.</div>
			</div>
	<div class="form">
				<div class="pad bord">
					<div class="line_form">
					    	<div id="proffecy_alert" style="max-height:300px;overflow-y: scroll;"></div>
					</div>
</div>

	</div>
</div>
<style>

</style>






   <input type="hidden" name="id" value='<?=$_GET['id']?>'>

<div class="lt__wrapper">
	<table class="lt__1">
	    <tr class="lt__row">
				<th colspan="3">Характеристики підприємства</th>
		</tr>
	 <? include 'introduceB_left.php';?>
	</table>



	<!--===============================================-->








<table class="lt__1">
<tr class="lt__row">
				<th colspan="4">Перелік виробничих дільниць</th>
			</tr>

	<? $repeatForms=0;$modalWindow_bud=0;$bud=1;
$floor=-1;
$fl='';
$floor_id=0;$floor_idstring='';$floor_idstringnone='';$floor_idnone=0;
//var_dump($floor,'$floor');
$cch=0;$firstnet=0;$countForms=0;

  $prev_tip_dilnyci="-+"; //вложенна таблица с домами
  $prev_floor="-+"; //вложенна таблица с домами
	//$data_positions = array();
	$sql  = "delete from `infogkhc_u462869922_test`.`tmp_positionsdata` where `id_pidpriemstva` =?i ";
	$db->query($sql,$_GET['id']);

   foreach($data['dd'] as $d):
		$repeatForms++;
		if( $d['tip_dilnyci']!='Будинок') $countForms++;
		$results='results'.$repeatForms;
		$fishka=0;

		$class= '';
		if(($d['tip_dilnyci']=='Насосна станція')
		|| $d['tip_dilnyci']=='Насосні установки водопроводу'
		|| $d['tip_dilnyci']=='Насосна станція водопроводу'
		|| $d['tip_dilnyci']=='Споруди водопроводу'
		|| ($d['tip_dilnyci']=='Водозабір підземних вод')
		|| ($d['tip_dilnyci']=='Насосна станція каналізації')
		|| ($d['tip_dilnyci']=='Очисні споруди водопроводу')
		|| ($d['tip_dilnyci']=='Агрегат підкачування')
		|| ($d['tip_dilnyci']=='Водопровідна мережа')
		|| ($d['tip_dilnyci']=='Повітродувна машина')
		|| ($d['tip_dilnyci']=='Споруди для переміщення води')
		|| ($d['tip_dilnyci']=='Озонаторна станція')
		|| ($d['tip_dilnyci']=='Споруда для запасу та зберігання води')
		|| ($d['tip_dilnyci']=='Водозапірна споруда')
		|| ($d['tip_dilnyci']=='Пульт дистанційно-автоматичного керування')
		|| ($d['tip_dilnyci']=='Облік витрат води')
		|| ($d['tip_dilnyci']=='Ремонт та установлення водомірів')
		|| ($d['tip_dilnyci']=='Каналізаційна (дренажна) насосна станція')
		|| ($d['tip_dilnyci']=='Каналізаційні мережі')
		|| ($d['tip_dilnyci']=='Очисні каналізаційні споруди')
		|| ($d['tip_dilnyci']=='Поле фільтрації')
		|| ($d['tip_dilnyci']=='Біоставок')
		|| ($d['tip_dilnyci']=='Споруди для зберігання та запасу води')		//Споруди для зберігання та запасу води
		|| ($d['tip_dilnyci']=='Лабораторія ВКГ')
		|| ($d['tip_dilnyci']=='Сховище хлору')
		|| ($d['tip_dilnyci']=='Споруди каналізації')
		|| ($d['tip_dilnyci']=='АРС (водопостачання)')
		|| ($d['tip_dilnyci']=='Ультрафіолетові установки (водовід)')
		|| ($d['tip_dilnyci']=='Ультрафіолетові установки (каналізація)')
		|| ($d['tip_dilnyci']=='Лабораторії хіміко-бактеріологічного аналізу')
		|| ($d['tip_dilnyci']=='Поле фільтрації/біоставок')) {

			$class= 'vodo_dil';
			$color = 'rgba(0, 0, 255, 0.5);';

		}
	   //Котельня  Бюро технічної інвентаризації
	   if($d['tip_dilnyci']=='Бюро технічної інвентаризації') {
		   $class= 'bti_dil';
			$color = 'rgba(255,221,0,  0.5);';
	   }
		if(($d['tip_dilnyci']=='Котельна')
		|| ($d['tip_dilnyci']=='Автоматизована котельня')
		|| ($d['tip_dilnyci']=='Котельня')
		|| ($d['tip_dilnyci']=='Тепловий пункт')
		|| ($d['tip_dilnyci']=='Теплова мережа')
		|| ($d['tip_dilnyci']=='Облік витрат теплової енергії')
		|| ($d['tip_dilnyci']=='Ремонт та установлення приладів обліку')
		|| ($d['tip_dilnyci']=='Ремонтна дільниця (теплопостачання)')
		|| ($d['tip_dilnyci']=='Лабораторія ХВО')
		|| ($d['tip_dilnyci']=='АРС (теплопостачання)'))
		{
			$class= 'cotel';
			$color = 'rgba(237,55,9,  0.5);';
		}
   if(($d['tip_dilnyci']=='Громадський транспорт')
   || ($d['tip_dilnyci']=='Шляхове господарство')  || ($d['tip_dilnyci']=='Електричний транспорт'))
		{
			$class = 'transport_dil';
		   $color = 'rgba(235, 135, 15, 0.7 );';
		}






		if ($d['tip_dilnyci']=='Трансформаторна підстанція'
			|| $d['tip_dilnyci']=='Підстанції 6-750 кВ'
			|| $d['tip_dilnyci']=='Підстанція'

			|| $d['tip_dilnyci']=='Підстанції (чергові) напругою 35-750 кВ'
			|| $d['tip_dilnyci']=='Контактна мережа'
			|| $d['tip_dilnyci']=='Лінії напругою 0.4-35 кВ'
			|| $d['tip_dilnyci']=='Лінії напругою понад 35 кВ'
			|| $d['tip_dilnyci']=='Кабельні лінії'
			|| $d['tip_dilnyci']=='Повітряні лінії електропередачі та зовнішнє освітлення')
			{
				$class = 'electro_dil';
				$color = 'rgba(248,149,0, 0.7);';
			}






if($d['tip_dilnyci']=='Готелі-гуртожитки'
		|| ($d['tip_dilnyci']=='Лазні')

		|| ($d['tip_dilnyci']=='Пральні та послуги хімічного чищення')
		|| ($d['tip_dilnyci']=='Громадське харчування')
		|| ($d['tip_dilnyci']=='Паркувальні майданчики')
		|| $d['tip_dilnyci']=='Роздрібна торгівля') {
		   $color = 'rgba(244, 164, 96, 0.4 );';//245, 222, 179
		}





		if($d['tip_dilnyci']=='Кладовище, колумбарій, крематорій'
		|| $d['tip_dilnyci']=='Бюро ритуальних послуг') {
			$class = 'cemetry_dil';
			$color = 'rgba(131, 139, 139, 0.7 );';
		}

if(($d['tip_dilnyci']=='Будинок')
		|| ($d['tip_dilnyci']=='АРС (будинок)'))
		{
			$class = 'house_dil';
		  $color = 'rgba(0, 100, 0, 0.3);';
		}

		if($d['tip_dilnyci']=='Обслуговування об’єктів зеленого господарства' || $d['tip_dilnyci']=='Озеленення'  || $d['tip_dilnyci']=='Догляд за озелененими територіями міст' || $d['tip_dilnyci']=='Парки культури та дозвілля') {
			$class = 'flag_green';
			$color = 'rgba(50, 205, 50, 0.6);';
		}

//Збір та вивезення ТПВ та РПВ
		 if(($d['tip_dilnyci']=='Збір та вивезення ТПВ') || ($d['tip_dilnyci']=='Збір та вивезення ТПВ та РПВ')
		|| ($d['tip_dilnyci']=='Збір та вивезення РПВ')
		|| ($d['tip_dilnyci']=='Сміттєзвалище'))
		{
			$class = 'smittya_dil';
		  $color = 'rgba(139, 139, 0, 0.8)';
		}
		 if($d['tip_dilnyci']=='Виробничі приміщення та території' || ($d['tip_dilnyci']=='Виробнича територія')
		|| ($d['tip_dilnyci']=='Виробниче приміщення')
		|| ($d['tip_dilnyci']=='Службове приміщення')

		|| ($d['tip_dilnyci']=='Офісні та громадські приміщення')
		|| ($d['tip_dilnyci']=='Ковальня')
		|| ($d['tip_dilnyci']=='Склад') || ($d['tip_dilnyci']=='Транспортна дільниця')
		|| ($d['tip_dilnyci']=='Охорона')

		|| ($d['tip_dilnyci']=='Контроль за споживанням та оплатою послуг')
		|| ($d['tip_dilnyci']=='Ремонт та повірка приладів обліку')
		|| $d['tip_dilnyci']=='Абонентська служба'
		|| $d['tip_dilnyci']=='Диспетчерська служба (транспортна)'
		|| $d['tip_dilnyci']=='Диспетчерська служба (мережі та управління будиками)')  {
			$class = 'dispetcher_dil';
			 $color = '#8B7765';
		 }


		  if($d['tip_dilnyci']=='Обслуговування доріг') {
			  //$color = 'rgba(112, 128, 144, 1)';
			  $class = 'dorogi_dil';
			  $color='rgba(98,89,97, 0.7)';
		  }
		//rgba(255, 218, 185, 1)
?>

<style>
.lt__wrapper td.<?=$class?> {background:<?=$color?>;}
	.bt :hover{
		 box-shadow: 0 0 10px rgba(0,0,0,0.5);
	}
</style>

<?


//вложенна таблица с домами
  if ( ( $d['tip_dilnyci']=='Будинок' && $prev_floor!==$d['floor'] && $prev_tip_dilnyci=='Будинок' ) || ( $d['tip_dilnyci']!=='Будинок' && $prev_tip_dilnyci=='Будинок' ) ) {
?>	</table>
<?
  }
  //вложенна таблица с домами

//$floor=-1;
	if ($d['tip_dilnyci']=='Будинок' )
	{
		//	var_dump($d['floor'],$floor,$d['id'],$data['floor']);
		//if ( $d['floor']==0)$d['floor']=1;
		$kilk_floor=0;$cch++;
		if($cch==$count_houses)$fishka=$all_squere_houses;//$k_squere_yes;//$all_squere_houses;//передача общей площади в последнюю дыльницю из будинкыв
		//var_dump($cch,$count_houses,$fishka,$k_squere_yes);

		foreach($data['floor'] as $dv){
			if(isset($dv[''.$d['floor'].''])) $kilk_floor=$dv[''.$d['floor'].''];
		}

		if ( $d['floor']!=$floor)
		{

			$fl='';$floor_id++;$floor_idstring='floor'.$floor_id;$floor_idstringnone='';//$floor_idnone++;?>
			<tr style="<?=$fl?>" class="<?=$floor_idstringnone?> lt__row">
				<td class="td__color house_dil"></td>
				<td class="lt__td2"><?=$d['tip_dilnyci']?></td>
				<td >Кількість <?=$d['floor']?>-поверхових будинків дорівнює <?=$kilk_floor?>.</td>
				<td >
					<a style="float:right;margin-top:10px;font-size:100%;" href="#" class="<?=$floor_idstring?>">
					<i class="icon-plus icon-large" style="color:red;padding-left:10px;padding-right:10px;"></i></a>
				</td>
			</tr>


			<?
			$fl='display: none;';$floor_idstringnone='floornone'.$floor_id;
			?>
			<tr id= "<?=$floor_idstringnone?>" style="<?=$fl?>">
				<td colspan="4"  class="<?=$floor_idstringnone?>" >
					<table  class="lt__1">

		<?}

			$floor=$d['floor'];//вложенна таблица с домами
			//$modalWindow_bud=0;//для отображения Зміна характеристик будинків только 1-й раз
			$fl='display: none;';$floor_idstringnone='floornone'.$floor_id;
	}//end Будинок

			if ($d['tip_dilnyci']!=='Будинок' ) {$floor_idstring='';$fl='';$floor_idstringnone='';}
			//if ($d['tip_dilnyci']=='Кладовище' ) {$f = $d['tip_dilnyci']; $d['tip_dilnyci']='Ритуальні послуги';}
			if ($d['tip_dilnyci']=='Транспортна дільниця' ) {
			 //$fishka=$all_squere_houses;//передача общей площади в последнюю дыльницю из будинкыв
			}?>


    <tr style="<? /*=$fl вложенна таблица с домами	  */ ?>" class="<?=$floor_idstringnone?>" class="lt__row">
	<td class="td__color <?=$class?>"></td>
    <td class="lt__td2"><?=$d['tip_dilnyci']?>
<?//if(isset($f)) {$d['tip_dilnyci'] = $f;}?>

<!--div id="<?=$results?>">вывод <?=$results?></div-->
</td><?unset($color);?>
	<td  style="text-align:left;" >





<? $getid=$_GET['id'];//var_dump($_POST);
if($_SESSION['status']<'5') {?>

				<?if ( $d['tip_dilnyci']=='Будинок' ) {?>
					<a href="#modalWindow0" onClick='loadModal("<?=($modal_window)?>", "<?=str_replace("\"","\\\"",json_encode(array('first'=>$first_dil, 'added_url'=>$added_url, 'r'=>$d['id'],'u'=>$d['nazva_dilnyci'],'n'=>$data['norms'],	'i'=>$d['id_pidpriemstva'],'form_id'=>$countForms, 'fishka'=>$fishka)))?>", "<?=str_replace("\"","\\\"", json_encode($_GET))?>"'><?=$d['nazva_dilnyci']?></a>
				<?} else {?>

<a href="#modalWindow<?=$d['id']?>"><?=$d['nazva_dilnyci']?></a>

				<?} ?>


<?}else {echo $d['nazva_dilnyci'];}?>


			<?
			$class = '';
			$modal_window = 'edit_budynok';

if ($d['tip_dilnyci']=='Споруди водопроводу') {$modal_window = 'edit_vodopidgotovki_K';}
if ($d['tip_dilnyci']=='Споруди каналізації') {$modal_window = 'edit_reshitka';}
if ($d['tip_dilnyci']=='Споруди для зберігання та запасу води') {$modal_window = 'edit_greblia_K';}
if ($d['tip_dilnyci']=='Споруди для переміщення води') {$modal_window = 'edit_kanal';}
if ($d['tip_dilnyci']=='Насосна станція водопроводу'|| $d['tip_dilnyci']=='Насосна станція' || $d['tip_dilnyci']=='Насосні установки водопроводу') {$modal_window = 'edit_nasosna_ustanovka';$color = 'blue';}
if ($d['tip_dilnyci']=='Насосна станція каналізації') {$modal_window = 'edit_Knasosna_ustanovka';}

if ($d['tip_dilnyci']=='Поле фільтрації/біоставок') {$modal_window = 'edit_filtracia';}
if ($d['tip_dilnyci']=='Сховище хлору') {$modal_window = 'edit_hlor';}//
if ($d['tip_dilnyci']=='Водопровідна мережа') {$modal_window = 'edit_vodomerezha';}
if ($d['tip_dilnyci']=='Каналізаційні мережі') {$modal_window = 'edit_kanalmerezha';}
if ($d['tip_dilnyci']=='Лабораторії хіміко-бактеріологічного аналізу') {$modal_window = 'edit_laboratoria';}
if ($d['tip_dilnyci']=='Внутрішньобудинкова водопровідна мережа') {$modal_window = 'edit_introhouse_vodomerezha';}
if ($d['tip_dilnyci']=='Парки культури та дозвілля') {$modal_window = 'edit_park';}
if ($d['tip_dilnyci']=='Агрегат підкачування') {$modal_window = 'edit_agregat';}
			if ($d['tip_dilnyci']=='Споруда для запасу та зберігання води') {$modal_window = 'edit_sporuda';}
			if ($d['tip_dilnyci']=='Водозабір підземних вод') {$modal_window = 'edit_vodozabir';}
			if ($d['tip_dilnyci']=='Пульт дистанційно-автоматичного керування') {$modal_window = 'edit_pult';}
			if ($d['tip_dilnyci']=='Облік витрат води') {$modal_window = 'edit_oblik';}
			if ($d['tip_dilnyci']=='Ремонт та установлення водомірів') {$modal_window = 'edit_vodomiry';}
					if ($d['tip_dilnyci']=='Біоставок') {$modal_window = 'edit_biostavok';}
						if ($d['tip_dilnyci']=='АРС (водопостачання)') {$modal_window = 'edit_ARSvodo';}
			if ($d['tip_dilnyci']=='АРС (мереж каналізації)') {$modal_window = 'edit_ARSkanal';}

			if ($d['tip_dilnyci']=='Котельна'||$d['tip_dilnyci']=='Котельня') {$modal_window = 'edit_kotelna';$class = 'cotel';}
			if ($d['tip_dilnyci']=='Тепловий пункт') {$modal_window = 'edit_teplopunkt';}
			if ($d['tip_dilnyci']=='Теплова мережа') {$modal_window = 'edit_teplomerezha';}
			if ($d['tip_dilnyci']=='Ремонтна дільниця (теплопостачання)') {$modal_window = 'edit_rem_dilnycia';}
			if ($d['tip_dilnyci']=='Облік витрат теплової енергії') {$modal_window = 'edit_vytraty_teplenergia';}
			if ($d['tip_dilnyci']=='Ремонт та установлення приладів обліку') {$modal_window = 'edit_prylad_oblik';}
			if ($d['tip_dilnyci']=='Лабораторія ХВО') {$modal_window = 'edit_laboratoriaHVO';}
			if ($d['tip_dilnyci']=='АРС (теплопостачання)') {$modal_window = 'edit_ARSteplo';}

			if ($d['tip_dilnyci']=='АРС (будинок)') {$modal_window = 'edit_ARSbudynok';}


			if ($d['tip_dilnyci']=='Збір та вивезення ТПВ' || $d['tip_dilnyci']=='Збір та вивезення ТПВ та РПВ' ) {$modal_window = 'edit_TPV';}
			if ($d['tip_dilnyci']=='Збір та вивезення РПВ') {$modal_window = 'edit_RPV';}


			if ($d['tip_dilnyci']=='Виробничі приміщення та території' || $d['tip_dilnyci']=='Виробниче приміщення') {$modal_window = 'edit_vyrobn_prymishchehhya';}
		//	if ($d['tip_dilnyci']=='Виробниче приміщення') {$modal_window = 'edit_vyrobn_prymishchehhyaold';}
			if ($d['tip_dilnyci']=='Виробнича територія') {$modal_window = 'edit_vyrobn_teritoria';}
			if ($d['tip_dilnyci']=='Службове приміщення'||$d['tip_dilnyci']=='Офісні та громадські приміщення') {$modal_window = 'edit_sluzhba_prymishchehhya';}
			if ($d['tip_dilnyci']=='Служба аварійно-відновлювальних робіт') {$modal_window = 'edit_sluzhbaAVR';}///
			if ($d['tip_dilnyci']=='Транспортна дільниця') {$modal_window = 'edit_avtodilnyca';}

			if ($d['tip_dilnyci']=='Ковальня') {$modal_window = 'edit_kovalnia';}
			if ($d['tip_dilnyci']=='Склад') {$modal_window = 'edit_sklad';}


			if ($d['tip_dilnyci']=='Трансформаторна підстанція') {$modal_window = 'edit_trans_pidstancia';}
			if ($d['tip_dilnyci']=='Підстанції 6-750 кВ') {$modal_window = 'edit_rem_ustatc_TRPIDST';}//Підстанції 6-750 кВ
			if ($d['tip_dilnyci']=='Підстанція') {$modal_window = 'edit_pidstancia';}
			if ($d['tip_dilnyci']=='Підстанції 6-750 кВ') {$modal_window = 'PIDSTANCIYA_6_750kV';}//Підстанції 6-750 кВ
			if ($d['tip_dilnyci']=='Підстанції (чергові) напругою 35-750 кВ') {$modal_window = 'PIDSTANCIYA_35_750kV';}
			if ($d['tip_dilnyci']=='Контактна мережа') {$modal_window = 'KONTAKTNA_MEREZHA';}
			if ($d['tip_dilnyci']=='Лінії напругою 0.4-35 кВ') {$modal_window = 'POVITRYANI_LINII_REMONT';}
			if ($d['tip_dilnyci']=='Лінії напругою понад 35 кВ') {$modal_window = 'POVITRYANI_LINII_REMONT_35kV';}
			if ($d['tip_dilnyci']=='Кабельні лінії') {$modal_window = 'edit_kabel';}
			if ($d['tip_dilnyci']=='Повітряні лінії електропередачі та зовнішнє освітлення') {$modal_window = 'edit_povitria';}


			if ($d['tip_dilnyci']=='Сміттєзвалище') {$modal_window = 'edit_smittia';}

			if ($d['tip_dilnyci']=='Охорона') {$modal_window = 'edit_ohorona';}
			//if ($d['tip_dilnyci']=='Диспетчерська') {$modal_window = 'edit_dispetcher';}//
			if ($d['tip_dilnyci']=='Озеленення') {$modal_window = 'edit_green';}
			if ($d['tip_dilnyci']=='Кладовище, колумбарій, крематорій') {$modal_window = 'edit_tombs';}
			if ($d['tip_dilnyci']=='Бюро ритуальних послуг') {$modal_window = 'buro_ritual';}
			if ($d['tip_dilnyci']=='Абонентська служба' || $d['tip_dilnyci']=='Служба збуту та робота з абонентами') {$modal_window = 'edit_abonent';}

			//////////////////////////
			if ($d['tip_dilnyci']=='Диспетчерська служба (мережі та управління будиками)') {$modal_window = 'edit_dispatcher';}
			if ($d['tip_dilnyci']=='Диспетчерська служба (транспортна)') {$modal_window = 'edit_dispatcher_t';}

			/////////////////////////

			if ($d['tip_dilnyci']=='Електричний транспорт') {$modal_window = 'GR_ELECTROTRANSPORT';}


			if ($d['tip_dilnyci']=='Комп`ютерне забезпечення') {$modal_window = 'edit_komp';}

                        if ($d['tip_dilnyci']=='Пральня') {$modal_window = 'edit_pralna';}
if ($d['tip_dilnyci']=='Готелі та гуртожитки' || $d['tip_dilnyci']=='Готелі-гуртожитки') {$modal_window = 'edit_hotel';}
            if ($d['tip_dilnyci']=='Громадське харчування') {$modal_window = 'edit_food';}


			if ($d['tip_dilnyci']=='Контроль за споживанням та оплатою послуг') {$modal_window = 'edit_kontrol';}
			if ($d['tip_dilnyci']=='Ремонт та повірка приладів обліку') {$modal_window = 'edit_povirka';}

			if ($d['tip_dilnyci']=='Автоматизована котельня') {$modal_window = 'edit_avtokotelna';}
			if ($d['tip_dilnyci']=='Внутрішньобудинкові теплові мережі') {$modal_window = 'edit_interhouse_teplomerezha';}


			//Громадський транспорт
			if ($d['tip_dilnyci']=='Громадський транспорт') {$modal_window = 'GR_ELECTROTRANSPORT';}
			if ($d['tip_dilnyci']=='Шляхове господарство') {$modal_window = 'edit_shlyahgosp';}

			//Озеленення
			if ($d['tip_dilnyci']=='Догляд за озелененими територіями міст') {$modal_window = 'GREEN_1';}
			if ($d['tip_dilnyci']=='Обслуговування об’єктів зеленого господарства') {$modal_window = 'GREEN_2';}

			if($d['tip_dilnyci']=='Обслуговування доріг') {$modal_window = 'ROADS';}
	if($modal_window=='edit_vodomerezha' || $modal_window=='edit_kanalmerezha' || $modal_window=='edit_teplomerezha') {
		$first_dil++;
	}
			?>




<?if ( $d['tip_dilnyci']!=='Будинок' ) {?>

			<a href="#modal" class="overlay" id="modalWindow<?=$d['id']?>"></a>

					<div class="popup_introduce" style="box-shadow: 20px 30px 40px rgba(0,0,0,0.9);">
						<?
						$this->model->modalWindow(($modal_window), array('first'=>$first_dil, 'added_url'=>$added_url, 'r'=>$d['id'],'u'=>$d['nazva_dilnyci'],'n'=>$data['norms'],	'i'=>$d['id_pidpriemstva'],'form_id'=>$countForms, 'fishka'=>$fishka));?>
						<a class="close" href="#close"></a>

					</div>

<?} else {
		unset($data_pos_tmp);
		$data_pos_tmp = $this->model->modalWindowData(($modal_window), array('first'=>$first_dil, 'added_url'=>$added_url, 'r'=>$d['id'],'u'=>$d['nazva_dilnyci'],'n'=>$data['norms'],	'i'=>$d['id_pidpriemstva'],'form_id'=>$repeatForms, 'fishka'=>$fishka));


}
?>






					</td>
	<?if( $_SESSION['status']!=='4' ){?>				<td >
					<?$factory_id = $d['id_pidpriemstva'];?>
	<a href="/calculations/delete_dilnycia/?id=<?=$d['id']?>&id_pidpriemstva=<?=$d['id_pidpriemstva']?>&nazva_dilnyci=<?=$d['nazva_dilnyci']?>&<?=$added_url?>" onClick='return confirmDelete();' title="Видалити дільницю">
				<img src="/images/delete-i.png" alt="удалить"</a>

	</td><?}?>
   </tr>

  <?

  $prev_tip_dilnyci=$d['tip_dilnyci'];//вложенна таблица с домами
  $prev_floor=$d['floor'];//вложенна таблица с домами


  endforeach;

//вложенна таблица с домами
if ( $prev_tip_dilnyci=='Будинок'  ) {
?>	</table></td>
   </tr>

<?
}
//вложенна таблица с домами


  ?>






<?
	/*вывод скрытых форм с просуммированной информацией для расчета по домам. Суммируем и группируем в таблице tmp_positionsdata*/



	$sql  = "select id_pidpriemstva, `x`, idprof, type_of_work, name_of_position, postachannia, tip_dilnyci
	,sum(shtaty) `shtaty`
	, rozradnist
	, kil_zmin
	, sezon
	, min
	, F
	, mashine_type
	, sum(mashine_count) `mashine_count`
	, output
	, min(form_id) `form_id`
	from `infogkhc_u462869922_test`.`tmp_positionsdata`
			where `id_pidpriemstva` =?i
			group by id_pidpriemstva, idprof, type_of_work, name_of_position, postachannia, tip_dilnyci, x
	, rozradnist
	, kil_zmin
	, sezon
	, min
	, F
	, mashine_type
	, output
	order by `form_id`, x
	";

	$db->getAll($sql,$_GET['id']);

	$total = $db->getAll($sql,$_GET['id']);

	$current_id = 0;

	foreach ($total as $positiinsdata_line) {


			if ($current_id	!= $positiinsdata_line["form_id"])
			{
				if ($current_id != 0){
				?>	</form></td></tr>		<?
				}
				?>	<tr display="none"><td>
				<a href="#modal" class="overlay" id="modalWindow<?=$positiinsdata_line["form_id"]?>" a>
					<div class="popup_introduce" style="box-shadow: 20px 30px 40px rgba(0,0,0,0.9);" id="modal">
				<form name="garranty" id="myForms<?=$positiinsdata_line["form_id"]?>"  >	<?

			}

			$output_h = '1';
			$output = '0';
			$x = $positiinsdata_line["x"];
			include Q_PATH.'/helpers/'.'edit_budynok_hid.php';


			$current_id	= $positiinsdata_line["form_id"];
			}
	if ($current_id != 0){
					?>
					</form></div></td></tr>
					<?

	}



 	$sql  = "delete from `infogkhc_u462869922_test`.`tmp_positionsdata` where `id_pidpriemstva` =?i ";
// 	$db->query($sql,$_GET['id']);
?>





   <input type="hidden" id="floor_number" value="<?=$floor_id?>">
   <input type="hidden" id="form_number" value="<?=$countForms?>">
   </table>
   </div>

<!--  динамическое модальное окно begin -->
	<a href="#modal" class="overlay" id="modalWindow0"></a>
					<div class="popup_introduce" style="box-shadow: 20px 30px 40px rgba(0,0,0,0.9);" id="modal">
						<div class="wrap" id="wrap"></div>
						<a class="close" href="#close"></a>

					</div>

<script>
	function loadModal(modal_window, arg_id, arg_get, arg_Q_PATH, arg_status)
	{
    /*var wrap = this.getContent().find("div.wrap");
    if (wrap.is(":empty")) {
    wrap.load();*/

	$.ajax({
        url: "/helpers/modal.php",
        data:{"modal_window":modal_window,"id":arg_id,"get":arg_get,"Q_PATH":arg_Q_PATH,"status":arg_status},
        type: "POST",
        error: function(){alert('Ошибка')},
        success: function(response){
          $("#wrap").html(response)
        },
        complete: function(){
			//alert('complete')
          $('#modal').fadeIn('fast')
		  document.getElementById("modal").setAttribute("style", "visibility: visible");
		  document.getElementById("modal").setAttribute("style", "opacity: 100");
        }
      })

	}
</script>
<!--  динамическое модальное окно end -->




								</div>

</div>
<script>
//$('#squere_zagalna').val()='';


 $("#preloader1").css("display",'none');
        $("#main_block1").css("display",'block');
		 $("#main_block1").css("height",'auto');

		if($('#squere_zagalna').val()!=='' || $('#squere_zagalna').val()!=='undefined') {
			$('#dorogi_1').css('display', 'table-row');
			$('#dorogi_1_squere_zagalna').html('<b>'+$('#squere_zagalna').val()+'</b>');
		}

		function clearScreen() {
			$("#preloader1").css("display",'inline');
        $("#main_block1").css("display",'none');
		}
	</script>



