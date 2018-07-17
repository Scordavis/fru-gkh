<!-- HEADER -->
<?if($data['title']=='Установка сайту') {
	$data['phone'] = '044 202 75 58';
	$data['a_phone'] = '044 202 75 58';
	$data['site_name'] = 'назва підприємства';
}


?>
<script>
$(document).ready(function() {
     $(window).load(function() {
		 m_w = 800;
		 width = $(window).width();
                if (width <= m_w){
           //$('#polosa').css('font-size','1.2em')
		   //$('.header-nav').css('display', 'none');
           }
    });
});

</script>
<?if($data['color']!=='daa520') {
	$background_color = $data['color'];
	/*
	#FFD700 для чорного
	#FFFF00  для красного
	#C0FF3E для зеленого
	*/
	$icons_color = '#fff';
	if($data['color']=='045FB4') {
		$color = '7cb0df';
		$icons_color = '#8DB6CD';
		$table_color = $icons_color;
		$im = '<img src="/tpl/images/e1.png" style="width:100%;">';
	}

	if($data['color']=='006400') {//60 179 113
		$color = 'C0FF3E';
		$icons_color = 'rgba(50, 205, 50, 0.7)';
		$table_color = $icons_color;
		$im = '<img src="/tpl/images/e3.png" style="width:100%;">';
	}

	if($data['color']=='DF0101') {//255 69 0
		$color = 'FFE4E1';
		$icons_color = '#CDBA96';
		$table_color = $icons_color;
		$im = '<img src="/tpl/images/e2.png" style="width:100%;">';
	}

	if($data['color']=='1C1C1C') {
		$color = 'FFD700';
		$icons_color = '#FFD700';
		$table_color = $icons_color;
		$im = '<img src="/tpl/images/e4.png" style="width:100%;">';
	}

	if($data['color']=='daa520') {
		$color = '7cb0df';
		$icons_color = '#daa520';
		$table_color = $icons_color;
		$im = '<img src="/tpl/images/e5.png" style="width:90%;">';
	}

	if($data['color']=='A1C3AA') {
		$table_color = 'rgba(161, 195, 170, 0.548)';
	}

	if($data['color']=='4993A5') {
		$table_color = 'rgba(73, 147, 165, 0.308)';
	}

	if($data['color']=='FFD700') {
		$table_color = 'rgba(255, 217, 0, 0.651)';
	}

	if($data['color']=='92476E') {
		$table_color = 'rgba(146, 71, 110, 0.527)';
	}

	if($data['color']=='363636') {
		$table_color = '#363636a4';
	}
}
else {
	$background_color = 'daa520';$im = '<img src="/tpl/images/e5.png" style="width:100%;">';$color = 'ffffff';$icons_color = '#daa520';
}?>

			<div style="clear:both;"></div>
		<header class="header">



			<div class="header-top">
				<div class="container" style="height: auto">

					<div class="header-location">
						<i class="i-location" style="color:<?=$icons_color?>;"></i>
						<span style="text-transform:uppercase;color:#fff;"><?=$data['misto']?>.UA</span>
					</div>
					<?
						$data['phone'] = rtrim($data['phone'], '/');
						$phone_list = explode('/', $data['phone']);
						$count = count($phone_list);
						$ii = 0;

					?>
					<div class="header-phone" >
						<i class="i-phone" style="color:<?=$icons_color?>"></i>
						<div class="select">
							<p class="selected-item" style="color:#fff"><?=$phone_list[0]?></p>
							<?if($count>1) {?>
							<ul class="select-list" style="min-width:400px;">
							<?while($ii<$count){
								if($ii!==0){?>

								<li class="select-item" style="white-space:nowrap;min-width:100%;"><?=$phone_list[$ii]?></li>

								<?}$ii++;}?></ul><?}?>
						</div>
					</div>

					<?if($data['emergency_service'] != 0) {?>
					<div class="header-phone dif-select">
						<i class="i-attention" style="color:<?=$icons_color?>"></i>
						<div class="select-wrap">
							<div class="phone-wrap" style="color:#<?=$color?>">
								<span class="phone-number" data-phone="header-first" style="color:#fff"><?=$data['a_phone']?></span>

							</div>

							<span class="sep" style="color:#<?=$color?>">/</span>
							<!-- onclick="showZ('<?=$data['factory_id']?>', '')" -->
							<div class="select">
								<p class="selected-item phone-name bl"><a href="#modal-49" data-fancybox>Аварійна служба</a></p>
							</div>
						</div>
					</div><?}?>

					<div class="header-top-logo">
						<span class="for-img">
							<a href="//fru-gkh.com.ua"><img src="/tpl/images/header-logo-0.png" alt="Федерація роботодавців ЖКГ України" style="margin-top:4px;"></a>
						</span>
						<div class="for-text">
							<p class="logo-title" style="color:#fff">ФРУ - ЖКГ</p>
							<p class="logo-subtitle" style="color:#fff">інвестиції в працю</p>
						</div>
					</div>
				</div>
			</div>
			<? $menu_theme = explode(';', $data['menu_theme']);

			   $m_pic = $menu_theme[0];
			   $m_color = $menu_theme[1];
			   if($m_pic != 'sitecolor' && $m_pic != ''){
					$menustyle = " background-image: url('/tpl/images/menu_images/".$m_pic.".png');
								   background-color: white;";

					$tx_color = "#505050";
					$triangle_m_left;
					$triangle_b_top;
					$container_padding = "padding-right: 0; margin-right: 0;";

					$triangle_style = "left: -2px;
    					border-top: 105px solid white;
						border-right: 45px solid transparent;";
					$nav_list = "margin-left: 35px;";
					$nav_item = "text-shadow: white -1px -1px 9px, white 1px 1px 9px, white 1px 0 9px,
					white 0 1px 9px, white -2px -2px 9px, white 2px 2px 9px, white 2px 0 9px, white 0 2px 9px;";

					/*$header_bottom = "url('/tpl/images/menu_images/".$m_pic.".png') repeat-x"; */
			   }
			   else {
				   $menustyle = "background:#$background_color;";
				   $tx_color = "white";

				   $triangle_style = "left: -50px;
				  					 margin-left: 0px;
				   					 margin-top: -49px;
				   					 border: 50px solid transparent;
				   					 border-bottom: 105px solid #$background_color;
				   					 border-right: 97px solid transparent;*/";
			   }
			?>

			<div class="header-bottom" style="height:106px;<?=$header_bottom?>">
				<div class="container" style="height:100%;<?=$container_padding?>">
					<div class="header-logo" style="width:50%; height:100%; overflow:hidden;">
						<a href="/" style="margin:5%">
						<img src="//info-gkh.com.ua/user_uploads/<?=$data['folder']?>/<?=$data['logo']?>" alt=""style="display:block; max-width:100%; height:auto;"></a>
					</div>
					<nav class="header-nav" style="height:auto; <?=$menustyle?> width:100%; padding:40px;">
						<ul class="nav-list" style="<?=$nav_list?>">
						<?//var_dump($data['menu'],$data['menu'][0]);
						if($data['menu'])
						foreach($data['menu'][0] as $m) {
							$id=$m['origin_id'];
							if($m['visibility']!=='1') {

							?>
							<li class="nav-item">
								<a href="#" class="nav-link" style="<?=$nav_item?>position:relative;color:<?=$tx_color?>;font-weight:normal;"
								onmouseover="$('.sub_i<?=$id?>').css('visibility', 'visible')"><?=$m['menu_title']?>	</a>
							<?

								if(isset($data['menu'][$id]))
								{?>
									<ul class="sub_i<?=$id?>" style="visibility:hidden">
										<?foreach($data['menu'][$id] as $m1)
										{
											if(trim($m1['menu_title'])=='Нормативні акти') {?>
												<li class="h"><a onclick="openLink('<?=$data['url']?>', 'acts', '<?=$m1['id']?>'); $('.sub_i<?=$id?>').css('visibility', 'hidden'); return false;" > <?=$m1['menu_title']?></a></li>

											<?}else
											if(trim($m1['menu_title'])=='Пільги') {?>
												<li class="h"><a onclick="openLink('<?=$data['url']?>', 'pilgi', '<?=$m1['id']?>'); $('.sub_i<?=$id?>').css('visibility', 'hidden'); return false;" > <?=$m1['menu_title']?></a></li>

											<?}

											else if(trim($m1['menu_title'])=='Субсидії') {?>
												<li class="h"><a onclick="openLink('<?=$data['url']?>', 'subsidii', '<?=$m1['id']?>'); $('.sub_i<?=$id?>').css('visibility', 'hidden'); return false;" > <?=$m1['menu_title']?></a></li>

											<?}

											else if(($data['url']=='popasne-vodokanal.info-gkh.com.ua') && (trim($m1['menu_title'])=='Структура підприємства')) {?>
												<li class="h"><a onclick="openLink('<?=$data['url']?>', 'popasne_structura', '<?=$m1['id']?>'); $('.sub_i<?=$id?>').css('visibility', 'hidden'); return false;" > <?=$m1['menu_title']?></a></li>

											<?}


											else {?>
										<!--
												<li class="h"><a onclick="openLink('<?=$data['url']?>', 'page', '<?=$m1['id']?>'); $('.sub_i<?=$id?>').css('visibility', 'hidden');return false;" href="/index/page/?id=<?=$m1['id']?>"> <?=$m1['menu_title']?></a></li>
												<li style="padding:5px;"></li>     -->
												<li class="h">
													<a href="/index/page/?id=<?=$m1['id']?>&script=0"><?=$m1['menu_title']?></a>
												</li>

											<?}}?>
									</ul>

								<?}?>
						</li>


						<?}}if($data['factory_id']!=='1991'){?>
							<?if($data['factory_id']=='1975'){?>
								<li class="nav-item" ><a href="//www.abonentinfo.com/" class="nav-link" target="_blank" style="<?=$nav_item?>color:<?=$tx_color?>;font-weight:normal;">КАБІНЕТ</a>

							<?}else {
							//&site=<?=$_SERVER['HTTP_HOST']>
							?>
						<li class="nav-item" ><a href="https://pay-center.fru-gkh.com.ua///?id=<?=$data ['factory_id']?>" class="nav-link" target="_blank" style="<?=$nav_item?>color:<?=$tx_color?>;font-weight:normal;">КАБІНЕТ</a>
						</li>
						<?}?>
						<?}?>
						</ul>

					</nav>

					<div class="mobile-menu">
						<span class="mobile-menu-text">Меню <i class="i-right-arrow" style="color:#<?=$color?>"></i></span>
						<div class="menu-icon">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="Wmodal-background" style="display:none">
			<div class="Wmodal" style="padding-left:0px;z-index:1001;">

				<div class="Wmodal_container" style="margin-left:0px;">


				</div>
			</div>
		</div>

		<div class="container pt-0 emergency-service" id="modal-49" style="display:none;">
			<?include Q_PATH.'/avar_window/index.html';?>
		</div>
<style>
.header {
		border-bottom: 1px solid #<?=$background_color?>;
}
.header-logo img {
	max-height: 96px;
}
.header-bottom {
	background: linear-gradient(to right, #fff 64%, #<?=$background_color?> 36%);
	z-index: 999;
}

.select p {
	position: relative;
	margin: 0 0 0 -10px;
	padding: 0 20px 0 10px;
}
.select p:after {
	position: absolute;
	top: 50%;
	margin-top: -2px;
	right: 0;
	display: block;
	content: '';
	width: 0;
	height: 0;
	border-top: 6px solid <?=$icons_color?>;
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
}

					</style>

		<div id="bg">
		<!-- HEADER END -->
		<style>
.nav-item a{
	padding:3px;
	text-transform:uppercase;
  color:grey;font-weight:bold;cursor:pointer;
}
.nav-item > ul {

position:absolute;z-index:10;background:#fff;
width:220px;

  opacity: 0;
  transition: visibility 0s, opacity 0.5s linear;
}
.nav-item:hover > ul{

  visibility: visible;
  opacity: 1;
}
.nav-item > ul li.h {
	padding:4px;
}

.nav-item > ul li.h:hover {

	background:#<?=$background_color?>;
}
.nav-item > ul li a {
	margin-bottom:10px;

}
.nav-item > ul li:hover a{

	color:#fff;
}
/*Scor edit*/
.nav-link{
	position: relative;
}
.nav-link::after{
	position: relative;
	display: none;
	content: '\00BB';
}
@media screen and (max-width: 1023px) {
	.nav-link::after{
		display: inline-block;
	}
}
#close a{
	float:right;padding:7px;color:red;font-weight:bolder;cursor:pointer;
}

.header-nav::before {
    content: "";
    position: absolute;
	top: 0;
	<?=$triangle_style?>
    /*left: -50px;
    margin-left: 0px;
    margin-top: -49px;
    border: 50px solid transparent;
    border-bottom: 105px solid <?=$triangle_color?>;
    border-right: 97px solid transparent;*/
}

@media screen and (max-width: 1023px) {
	.header-nav::before {
		display:none;
	}

}

</style>
<script>
        function closeModal() {
            $('.Wmodal-background').fadeOut(500);
        }
    </script>

