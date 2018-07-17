<!--<link rel="stylesheet" href="/admin_rc/css/steps.css" /> -->
<div id="show">
<?
require_once  Q_PATH.'/sys/db.php';
require_once  Q_PATH.'/sys/db_factory.php';
$db=new Settlement();
$dbf=new Factory();

//$db = new SafeMysql();
$page = 1;

$region = '';
$misto = '';
if (isset($_GET['region'])) {
	$region = $_GET['region'];
}
if (isset($_GET['misto'])) {
	$misto = $_GET['misto'];
}

$factory_id = $_GET['id'];


$template_name = 'streets_and_houses';

$mini = 0;
if(isset($_GET['mini'])) {
	if ( $_GET['mini'] == '1')
	{
			$mini = 1;
			$template_name = $template_name.'-mini';
	}
}


$flors = $db->getAll("SELECT distinct height FROM `houses` WHERE `factory_id`='".$factory_id."' ORDER BY height ");

	if(!isset($_GET['search'])) {


	$num = 20;
	$page2left = $pervpage =$page1left =$page2right  = $page1right = $nextpage  =null;


		if(isset($_GET['start'])) {
			$page = $_GET['start'];
		}

	$posts = $db->getOne("SELECT COUNT(id) FROM `houses` WHERE `factory_id`='".$factory_id."'");



	$total = intval(($posts - 1) / $num) + 1;

	$page = intval($page);

	if(empty($page) or $page < 0) $page = 1;
	if($page >= $total) $page = $total;

	$start = $page * $num - $num;

	$data['d'] = $db->getAll("SELECT * FROM `houses` WHERE `factory_id`='".$factory_id."' ORDER BY `street_id`, house_num DESC LIMIT $start, $num");
?>
Загальна кількість будинків:<?=$posts?> <?
	}else if($_GET['search']=='1'){

		$data['d'] = $db->getAll("SELECT * FROM `houses` WHERE `factory_id`='".$factory_id."' AND `street_id`='".$_GET['street_id']."'ORDER BY `id` ASC ");

	}else if($_GET['search']=='2'){
		$data['d'] = $db->getAll("SELECT * FROM `houses` WHERE `factory_id`='".$factory_id."' AND `height`='".$_GET['floor']."'ORDER BY `street_id` ASC ");

	}

	else if($_GET['search']=='3'){
		$data['d'] = $db->getAll("SELECT * FROM `houses` WHERE `factory_id`='".$factory_id."' AND `".$_GET['posluga']."`='1' ORDER BY `street_id` ASC ");

	}
?>

<div id="saved_message" style="position:absolute;left:40%; width:20%;padding:10px;top:100px;z-index:10;background: #fc0;box-shadow: 0 0 10px rgba(0,0,0,0.5);text-align:center;color:#8B4726;display:none;"><h1><strong>ЗБЕРЕЖЕННЯ</strong></h1>
<div><center><img src="/images/preloader.gif" ></center></div>


</div>
<div style="height:20px;"></div>
<div style="width:1200px;margin:0 auto;">
<div class="button">
	<a href="/ReestrBudinkiv/dataeditor_1step/?id=<?=$factory_id?>&misto=<?=$misto?>&region=<?=$region?>&all=1">Без фільтрів</a>
</div>
<div class="button" style="width:200px;" onclick="$('#poslugi').css('display','none');$('#search_by_street_block').css('display','block');$('#search_by_floor').css('display','none')">
	Введіть назву вулиці

</div>
<div class="button" style="width:200px;" onclick="$('#poslugi').css('display','none');$('#search_by_street_block').css('display','none');$('#search_by_floor').css('display','block')">
	Введіть етажність</div>
<div class="button" style="width:200px;" onclick="$('#poslugi').css('display','block');$('#search_by_street_block').css('display','none');$('#search_by_floor').css('display','none')">
	Фільтр:послуги

</div>
<!--<div id="button">
	<a href="/models/exel_exportStreets.php?misto=<?=$misto?>&region=<?=$region?>">Експорт</a>

</div>-->


<div style="height:20px;"></div>



<div id="search_by_street_block" style="display:none;padding-left: 150px; ">
		<input type="text" id="xsearch_by_street" class="who" name="referal"  autocomplete="off">
		<ul class="xsearch_result"></ul>
		<br>
		<br>
	</div>
<div id="search_by_floor" style="display:none;padding-left: 150px;">
	Введіть етажність:<br>
	<form name="filtr_floors" id="filtr_floors" method="POST" action="/ReestrBudinkiv/search_floor/">
		<input type="hidden" name="factory_id" value="<?=$factory_id?>">
		<select class="who" name="floor" style="" autocomplete="off" id="search_by_floor_val" >
		    <option value="">*</option>
		    <? foreach ($flors as $flor) {  ?>
        <option value="<? echo $flor['height']; ?>"><?echo $flor['height']; ?></option>
        <?} ?>
        </select>

	</form>

	</div>

<div id="poslugi" style="display:none;padding-left: 150px;">
    <form method="POST" action="/ReestrBudinkiv/search_poslugi/" id="filtr_poslugi">
	    <input type="hidden" name="factory_id" value="<?=$factory_id?>">
		<select name="posluga" id="posluga_val" >
		    <option value="">*</option>
			<option value="a101">Санітарне утримання </option>
			<option value="a102">Прибирання сходових кліток</option>
			<option value="a103">Поточний ремонт </option>
			<option value="a104">Системи холодного водоп/водов </option>
			<option value="a105">Системи гарячого водоп/теплоп</option>
			<option value="a106">Обсл. електричних мереж</option>
			<option value="a107">Обслуговування ліфтів</option>
		</select><br>
		<!--<input type="submit" name="ok" value="Пошук" style="font-size:10px;">-->
	</form>
	</div>




</div>

<div style="height:20px;"></div>

<div style="width:1200px;margin:0 auto;">


<?php
  if(!isset($_GET['search'])) {

    $total_records = $db->getOne("SELECT COUNT(id) FROM `houses` WHERE `factory_id`='".$factory_id."'");
    $total_pages = ceil($total_records/$num)+1;
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($page > 1)
    {
     echo "<span class='paginate'><a href='/ReestrBudinkiv/dataeditor_1step/?id=".$factory_id."&mini=".$mini."&misto=".$misto."&region=".$region."&start=1'><<</a></span>";
     echo "<span class='paginate'><a href='/ReestrBudinkiv/dataeditor_1step/?id=".$factory_id."&mini=".$mini."&misto=".$misto."&region=".$region."&start=".($page - 1)."'>< </a></span>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {
		if($i>0) {
			if($i==$page) {
				echo "<span class='pag'>".$i."</span>";
			}else {

				echo "<span class='paginate'><a href='/ReestrBudinkiv/dataeditor_1step/?id=".$factory_id."&mini=".$mini."&misto=".$misto."&region=".$region."&start=".$i."'> ".$i." </a></span>";
			}

		}

    }
    if($page < $end_loop)
    {
     echo "<span class='paginate'><a href='/ReestrBudinkiv/dataeditor_1step/?id=".$factory_id."&mini=".$mini."&misto=".$misto."&region=".$region."&start=".($page + 1)."'> ></a></span>";
     echo "<span class='paginate'><a href='/ReestrBudinkiv/dataeditor_1step/?id=".$factory_id."&mini=".$mini."&misto=".$misto."&region=".$region."&start=".$total_pages."'>>></a></span>";
    }

  }
    ?>

</div>


<style>
.pag {padding:4px;border:1px solid #DCDCDC;margin-left:5px;background:#DCDCDC;color:red;font-weight:bold;}
.paginate a{
	padding:4px;border:1px solid #DCDCDC;margin-left:5px;
}
.paginate a:hover{
	background:rgba(255, 228, 181, 1);
}
.xsearch_by_street{
   position:relative;
}
table {
    table-layout: fixed; /* Фиксированная ширина ячеек */
width:10%;
   }
   table td{
	   overflow:hidden;
   }
.xsearch_result{
	position:absolute;
    background: #FFF;
    border: 1px #ccc solid;
    width: 350px;
    border-radius: 4px;
    max-height:150px;
    overflow-y:scroll;
    display:none;
	z-index:20;
}

.xsearch_result li{
    list-style: none;
    padding: 5px 10px;
    margin: 0 0 0 -10px;
    color: #0896D3;
    border-bottom: 1px #ccc solid;
    cursor: pointer;
    transition:0.3s;
}

.xsearch_result li:hover{
    background: #F9FF00;
}
 /*#button{*/
	/* display:inline-block;*/
	/* padding:12px;*/
	/* background:blue;*/
	/* cursor:pointer;*/
	/* color:#fff;font-weight:bold;font-size:16px;*/
 /*}*/
 /*#button a, #button span  {*/
	/* color:#fff;font-weight:bold;font-size:16px;*/
 /*}*/
 /*#button a:hover,  #button span:hover {*/
	/* color:blue;*/
 /*}*/
 /*#not {*/
	/* background:transparent; */
 /*}*/
 /*#button:hover {*/
	/*  background:transparent;*/
	/*  color:blue;font-weight:normal;*/
 /*}*/
 .coln {
	 width:100px;
 }
 .coln1 {
	 width:60px;
 }
 .hh {
		height:20px;overfow:hidden;
	}


</style>

						<div class="tblWrapper" style="width:95%; min-width:800px; max-width:1400px; padding-left:5px;">
<table id="t1" style="width:100%;">
<col  class="coln" span="74">
<!--<col  class="coln1" span="74">-->
<tr style="color:#fff;">
	<td style="color:#fff;" ><br><br><br><br>Мiсто <br><br><br></td>
	<td style="color:#fff;" ><br><br><br><br>Вулиця	<br><br><br></td>
	<td style="color:#fff;">Кв</td>
	<td style="color:#fff;">№ будинку</td>
	<td style="color:#fff;">№ будинку (буква)</td>

    <? $template = $dbf->getAll("SELECT * FROM excel_templates WHERE template_name='$template_name' and ( excel_column='D' or LENGTH(db_column_name)>0 or LENGTH(db2_column_name)>0 ) order by length(excel_column), excel_column");

    $ncol = 0;
            foreach ($template as $template_column){
                if ( $ncol>2 ) {
    ?>              <td><?=$template_column['header_text']?></td>
    <?
                }
            $ncol++;
            }

    ?>
</tr>


<?$count_street = 0;

				$c='';
				foreach ($data['d'] as $one)
				{

						$oneid=$one['id'];




					$id = $one['id'];

							$count_street++;





							?>


								<tr >
									<td id="" class="city-<?=$one['id']?>">
									<? $city_name=$db->getOne("SELECT c.city_name FROM cities c, streets s WHERE s.id='".$one['street_id']."' and s.city_id=c.id ");
									echo $city_name;
										?>
									</td>

									<td id="" class="heigh-<?=$one['id']?>">
										<?
											$street_name = $db->getRow("SELECT * FROM `streets` WHERE `id`='".$one['street_id']."'");
											$street_name['street_name']=mb_convert_case($street_name['street_name'], MB_CASE_TITLE , "UTF-8");
										?>
									<?if(strpos($c , $street_name['street_name'])===false){

										?>
										<div style="color:blue;cursor:pointer;" >

											<div>
												<a onclick="editHouse('<?=$count_street?>', '<?=$street_name['id']?>', '<?=$one['id']?>')" style="color:#fff;"><b><?=$street_name['street_name']?></b></a>
											</div>

											<!--<div style="float:right;padding-left:4px;padding-right:4px;background:#fff">
												<a style="cursor:pointer;color:green;" onclick="editHouse('0', '<?=$street_name['id']?>', '0')" title="Додати новий запис про будинок на цій вулиці">+</a>
											</div>-->



										</div>
									<?$c = $street_name['street_name'];}else {?>

										<span style="color:#fff;cursor:pointer;"
										onclick="editHouse('<?=$count_street?>', '<?=$street_name['id']?>', '<?=$one['id']?>')">
											<?=$street_name['street_name']?>
										</span>
									<?}?>
									</td>
									<td id="flats-<?=$one['id']?>" class="heigh-<?=$one['id']?>"><a href="/ReestrBudinkiv/viewHouse_RC_editortableFlatsList/?id=<?=$one['id']?>&misto=<?=$misto?>&region=<?=$region?>&factory_id=<?=$factory_id?>" style="cursor:pointer;color:#fff;">кв</a></td>
									<td id="house_num<?=$one['id']?>" class="heigh-<?=$one['id']?>" style="color:#fff;cursor:pointer;"><?=$one['house_num']?></td>
									<td id="house_let<?=$one['id']?>" class="heigh-<?=$one['id']?>" style="color:#fff;cursor:pointer;"><?=$one['house_let']?></td>
									<?
										$poslugi = '';
								// 		If($one['a101']!=='0'  && $one['a101']!=='')
										if($one['a101']==1){
											$poslugi .= '1;';
										}
								// 		If($one['a102']!=='0' && $one['a102']!=='')
										if($one['a102']==1){
											$poslugi .= '2;';
										}
								// 		If($one['a103']!=='0'  && $one['a103']!=='')
										if($one['a103']==1){
											$poslugi .= '3;';
										}
								// 		If($one['a104']!=='0' && $one['a104']!=='')
										if($one['a104']==1){
											$poslugi .= '4;';
										}
								// 		If($one['a105']!=='0' && $one['a105']!=='')
										if($one['a105']==1){
											$poslugi .= '5;';
										}
								// 		If($one['a106']!=='0' && $one['a106']!=='')
										if($one['a106']==1){
											$poslugi .= '6;';
										}
								// 		If($one['a107']!=='0' && $one['a107']!=='')
										if($one['a107']==1){
											$poslugi .= '7';
										}

									?>


									<td id="poslugi_select-<?=$one['id']?>" style="width:25px;"><div class="hh"><?=$poslugi?></div></td>

									<?

                                        $ncol = 0;
                                                foreach ($template as $template_column){
                                                    if ( $ncol>3 ) {
                                                        if ( strlen($template_column['db2_column_name'])>1  ) {
                                                            $colname = $template_column['db2_column_name'];
                                                        } else {
                                                             $colname = $template_column['db_column_name'];
                                                        }
                                                        $datacol="";
                                                        if ( strlen($colname)>0 ) {
                                                            $datacol=$one[$colname];
                                                        }




                                        ?>              <td id="<?=$colname?>-<?=$one['id']?>"><div class="hh"><?=$datacol?></div></td>
                                        <?
                                                    }
                                                $ncol++;
                                                }

                                        ?>


								</tr>


								<?

			}


				?>

    <tr><td style="background:transparent;"><br></td></tr>
</table>

</div>
</div>

<div id="editor_window"></div>






<script>


$(function(){
//Автодополнение по поиску улицы
	$('#xsearch_by_street').bind("change keyup input click", function() {
		if(this.value.length >= 2){
		console.log(this.value);
			$.ajax({
				type: 'post',
				url: "/ReestrBudinkiv/autocomplete_street",
				data: {'search_by_street':this.value, factory_id:<?=$factory_id?>},
				response: 'text',
				success: function(data){
					console.log(data);
					$(".xsearch_result").html(data).fadeIn();
			   }
		   })
		}
	})

	$(".xsearch_result").hover(function(){
		$("#search_by_street").blur();
	})

	$(".xsearch_result").on("click", "li", function(){

		street = $(this).text();
		$("#xsearch_by_street").val(street);
		$(".xsearch_result").fadeOut();

		 $.ajax({
				type: 'post',
				url: "/ReestrBudinkiv/search_street_dataeditor/",
				data: {search_by_street:street, factory_id:<?=$factory_id?>},
				response: 'text',
				success: function(html){
					$('#show').html(html);
			   }
		   })
	})

	$('#search_by_floor_val').bind("change", function() {
		if(this.value.length >= 1){
		console.log(this.value);
			document.getElementById("filtr_floors").submit();
		}
	})

	$('#posluga_val').bind("change", function() {
		if(this.value.length >= 1){
		console.log(this.value);
			document.getElementById("filtr_poslugi").submit();
		}
	})


})

old_id = null;

$('#t1').on('dblclick', 'td', function() {
	c = 0;
	clspan = 1;
		id = $(this).attr("id");

		$('td#'+old_id).siblings().css({'background':'#fff','color':'#000'});
		$('td#'+old_id).attr('colspan', '1');
		old_id = id;

		clicked_id = $(this).attr("id").split('-');
		house_id = clicked_id[1];
//		$('.heigh-'+house_id).height($(this).height()+5);
		cell = 'a';
		$(this).siblings().css({'background':'red', 'color':'#fff'});
		console.log($(this).next());
		d = $(this).text();

		if(d.length>7) {
			clspan = Math.round(d.length/7),
			$(this).attr('colspan', ''+clspan+'').css('text-align', 'left');
		}

		if(clicked_id[0]!=='poslugi_select') {
			cell = clicked_id[0];
		}
		$(this).attr("contenteditable",'true');
		$('[contenteditable]').keydown(function(e) {
			charCode = (e.which) ? e.which : event.keyCode
			console.log(charCode);
			if(charCode !== 8) {
				c++;
			if(c>8) {
				c = 0;
				clspan = clspan+1;
				$(this).attr('colspan', clspan).css('text-align', 'left');
			}
			}else {
				c++;
				if(c>8) {
					c = 0;
					clspan = clspan-1;
					$(this).attr('colspan', clspan).css('text-align', 'left');
				}
			}if(charCode == 13) {
				oldVal = $(this).text();
				$(this).css({'background':'yellow','color':'#000'});
				saveData(id,oldVal);

			}
		})
		$('[contenteditable]').focus(function(){
			oldVal = $(this).text();
			$(this).css({'background':'yellow','color':'#000'});
		})
		.blur(function()
		{
			saveData(id, oldVal);
		})
});

function saveData(id, oldVal) {
	$('#'+id).attr('colspan', '').css('text-align', 'center');
			$('#'+id).siblings().css({'background':'#fff', 'color':'#000'});
			$('#'+id).attr("contenteditable",'false').css('background','#fff');
			newVal = $('#'+id).text();
			if(newVal!==oldVal) {
				$('#saved_message').css('display', 'block');
				$.ajax({
					type: "POST",
					url: '/ReestrBudinkiv/updatecell/',
					data: {cell:cell, house_id:house_id, celldata:newVal},
					cache: false,
						success: function(html) {
							setTimeout(function() {$("#saved_message").fadeOut(500);}, 4000);
								$('#saved_message').css('display', 'none');
						}
					})
				}
}

function gid(i) {return document.getElementById(i);}
function CEL(s) {return document.createElement(s);}
function ACH(p,c) {p.appendChild(c);}

function getScrollWidth() {
	var dv = CEL('div');
	dv.style.overflowY = 'scroll'; dv.style.width = '50px'; dv.style.height = '50px'; dv.style.position = 'absolute';
	dv.style.visibility = 'hidden';
	ACH(document.body,dv);
	var scrollWidth = dv.offsetWidth - dv.clientWidth;
	document.body.removeChild(dv);
	return (scrollWidth);
}

$( document ).ready(function () {

	work_width = window.innerWidth - 10;
	if ( work_width > 1400 ){
	     work_width=1400;
	}
	if ( work_width<800 ) {
	     work_width=800;
	}

	FixHeaderCol(gid('t1'),1,5,work_width,450);

})
function FixHeaderCol(tbl, fixRows, fixCols, ww, hh) {
	var scrollWidth = getScrollWidth(), cont = CEL('div'), tblHead = CEL('table'), tblCol = CEL('table'), tblFixCorner = CEL('table');
	cont.className = 'divFixHeaderCol';
	cont.style.width = ww + 'px'; cont.style.height = hh + 'px';
	tblFixCorner.style.color='#FFFFFF';
	tblCol.style.color='#FFFFFF';
	tbl.parentNode.insertBefore(cont,tbl);
	ACH(cont,tbl);

	var rows = tbl.rows, rowsCnt = rows.length, i=0, j=0, colspanCnt=0, columnCnt=0, newRow, newCell, td;
	for (j=0; j<rows[0].cells.length; j++) {columnCnt += rows[0].cells[j].colSpan;}
	var delta = columnCnt - fixCols;

	for (i=0; i<rowsCnt; i++) {
		columnCnt = 0; colspanCnt = 0;
		newRow = rows[i].cloneNode(true), td = rows[i].cells;
		for (j=0; j<td.length; j++) {
			columnCnt += td[j].colSpan;
			if (i<fixRows) {
				newRow.cells[j].style.width = getComputedStyle(td[j]).width;
				ACH(tblHead,newRow);
			}
		}

		newRow = CEL('tr');
		for (j=0; j<fixCols; j++) {
			if (!td[j]) continue;
			colspanCnt += td[j].colSpan;
			if (columnCnt - colspanCnt >= delta) {
				newCell = td[j].cloneNode(true);
				newCell.style.width = getComputedStyle(td[j]).width;
				newCell.style.height = 5 + td[j].clientHeight - parseInt(getComputedStyle(td[j]).paddingBottom) - parseInt(getComputedStyle(td[j]).paddingTop) + 'px';
				ACH(newRow,newCell);
			}

		}
		if (i<fixRows) {ACH(tblFixCorner,newRow);}
		ACH(tblCol,newRow.cloneNode(true));
	}

	tblFixCorner.style.position = 'absolute'; tblFixCorner.style.zIndex = '3'; tblFixCorner.className = 'fixRegion';
	//tblHead.style.position = 'absolute'; tblHead.style.zIndex = '2'; tblHead.style.width = tbl.offsetWidth + 'px'; tblHead.className = 'fixRegion';
	tblHead.style.position = 'absolute'; tblHead.style.zIndex = '2'; tblHead.className = 'fixRegion';
	tblCol.style.position = 'absolute'; tblCol.style.zIndex = '2'; tblCol.className = 'fixRegion';

	cont.insertBefore(tblHead,tbl);
	cont.insertBefore(tblFixCorner,tbl);
	cont.insertBefore(tblCol,tbl);
// console.log(tblCol.offsetWidth,tblCol.offsetHeight,newCell.style.height);
var hcell=parseInt(newCell.style.height);
cont.style.height = tblCol.offsetHeight+hcell + 'px';

	var bodyCont = CEL('div');
	bodyCont.style.cssText = 'position:absolute;margin:0px;';

	// Горизонтальная прокрутка
	var divHscroll = CEL('div'), d1 = CEL('div');
	divHscroll.style.cssText = 'width:100%; bottom:0; overflow-x:auto; overflow-y:hidden; position:absolute; z-index:3;margin:0px;';
	divHscroll.onscroll = function () {
		var x = -this.scrollLeft + 'px';
		bodyCont.style.left = x;
		tblHead.style.left = x;
	}

	d1.style.width = tbl.offsetWidth + scrollWidth + 'px';
	d1.style.height = '2px';

	ACH(divHscroll,d1);
	ACH(cont,divHscroll);
	ACH(bodyCont,tbl);
	ACH(cont,bodyCont);

	// Вертикальная прокрутка
	var divVscroll = CEL('div'), d2 = CEL('div');
	divVscroll.style.cssText = 'height:100%; right:0; overflow-x:hidden; overflow-y:auto; position:absolute; z-index:3;margin:0px;';
	divVscroll.onscroll = function () {
		var y = -this.scrollTop + 'px';
		bodyCont.style.top = y;
		tblCol.style.top = y;
	}

	d2.style.height = tbl.offsetHeight + scrollWidth + 'px';
	d2.style.width = scrollWidth + 'px';

	ACH(divVscroll,d2);
	ACH(cont,divVscroll);

	cont.addEventListener('wheel', myWheel);
	function myWheel(e) {
		e = e || window.event;
		var delta = e.deltaY || e.detail || e.wheelDelta;
		var z = delta > 0 ? 1 : -1;
		divVscroll.scrollTop = divVscroll.scrollTop + z*17;
		e.preventDefault ? e.preventDefault() : (e.returnValue = false);
	}


} //FixHeaderCol


function editHouse(count_street, street_id, house_id) {
	    console.log(count_street, street_id, house_id);
		$.ajax({
		type: "POST",
		url: '/ReestrBudinkiv/viewHouse_RC_editortable/',
		data: {street_id:street_id, house_id:house_id},
		cache: false,
		success: function(html) {
			$('#editor_window').fadeIn(500).html(html);


		},
		error: function() {
			alert('error');
		}
	})

	}


function flatsList(house_id) {
	$.ajax({
		type: "POST",
		url: '/ReestrBudinkiv/viewHouse_RC_editortableFlatsList/',
		data: {street_id:street_id, house_id:house_id},
		cache: false,
		success: function(html) {
			$('#editor_window').fadeIn(500).html(html);


		},
		error: function() {
			alert('error');
		}
})

}




	/*
	function editcell(id) {
		$(this).attr('contenteditable', 'true');
	}









$('tr').on('click', function() {

	$(this).css({'background':'#FFDAB9', 'z-index':'12'});

})
*/


</script>

<style>



	.selected {
		background:yellow;
	}
	#editor_window {
		background:rgba(135, 206, 235, 1);
		height:500px;
		overflow-y:scroll;
		display:none;
		position:fixed;
		left:25%;top:20px;
		max-width:1200px;
		width:50%;z-index:13;padding:20px;
		 box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	}

#table_flats {

	max-width:1200px;margin:0 auto;
}
#table_flats::-webkit-scrollbar { width: 0; }
#table_flats { -ms-overflow-style: none; }
#table_flats { overflow: -moz-scrollbars-none; }

* {font-family: "Ubuntu";font-size:13px;}

p {margin:28px 0 3px 0;}
.divFixHeaderCol {
  position:absolute;
  border:0;
  border-left:1px solid #d0d0d0;
  border-bottom:1px solid #d0d0d0;
  overflow:hidden;
}
.divFixHeaderCol  {margin-top:20px;}
.divFixHeaderCol table {border-collapse:collapse;}
.divFixHeaderCol td {
 font-family: "wf_SegoeUILight";

  padding:2px;
  border:1px solid #d0d0d0;
  border-left:0;
  background:#fff;
text-align:center;
  min-height:14px;

}

.divFixHeaderCol .fixRegion td {
	margin-top:5px;
  background:rgb(0,81,163) no-repeat;
  background-image:linear-gradient(rgb(0,81,163)), rgb(0,81,163));
  background-position:1px 1px;

}
.cntr {text-align:center;}
/*
#button{
	 display:inline-block;
	 padding:12px;
	 background:rgb(0,81,163);
	 cursor:pointer;
	 color:#fff;font-weight:bold;font-size:16px;
 }
 #button a  {
	 color:#fff;font-size:16px;
 }
 #button a:hover  {
	 color:blue;
 }
 #not {
	 background:transparent;
 }
 #button:hover {
	  background:transparent;
	  color:blue;font-weight:normal;
 }
	.close_window {
		cursor:pointer;
		width:120px;color:red;
		text-align:center;

	}
	.close_window a{
		color:red;
	}
	.close_window:hover {
		background:red;
	}
	.close_window:hover strong {
		color:#fff;
	}
*/

/*#button{*/
/*	 display:inline-block;*/
/*	 width:15%;*/
/*	 padding:10px;*/
/*	 background:#EEEEE0;*/
/*	 border:2px solid #0051a3;*/
/*	 cursor:pointer;*/
/*	 color:#0051a3;font-weight:bold;font-size:14px;*/

/*	 text-align: center;*/
/*	 margin-left:10px;*/
/*	 margin-right:10px;*/

/* }*/
/* #button a  {*/
/*	 color:#0051a3;font-weight:bold;font-size:14px;*/
/* }*/
/* #button a:hover  {*/
/*	 color:#fff;background:#0051a3;*/
/* }*/
/* #not {*/
/*	 background:transparent; */
/* }*/
/* #button:hover {*/
/*	  background:#0051a3;*/
/*	  color:#fff;font-weight:bold;*/
/* } */


</style>
