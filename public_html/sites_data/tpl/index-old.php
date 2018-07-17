<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Переключение IE в последнию версию, на случай если в настройках пользователя стоит меньшая -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- Адаптирование страницы для мобильных устройств -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	
	<!-- Запрет распознования номера телефона -->
	<meta name="format-detection" content="telephone=no">
	
	<!-- Заголовок страницы -->
	
	<title><?=$data['site_name']?></title>
	
	<!-- Данное значение часто используют(использовали) поисковые системы -->
	<meta name="description" content="<?=$data['description']?>">
	<meta name="keywords" content="<?=$data['keywords']?>">
	
	<!-- Традиционная иконка сайта, размер 16x16, прозрачность поддерживается. Рекомендуемый формат: .ico или .png -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Иконка сайта для IPad от Apple, рекомендуемый размер 114x114, прозрачность не поддерживается -->
	<link rel="apple-touch-icon" href="apple-touch-icon-ipad.png">
	
	<!-- Иконка сайта для Iphone от Apple, рекомендуемый размер 72x72, прозрачность не поддерживается -->
	<link rel="apple-touch-icon" href="apple-touch-icon-iphone.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="/tpl/js/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" href="/tpl/css/jquery.bxslider.min.css" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="/tpl/css/fonts.css" />
	<link rel="stylesheet" href="/tpl/css/main.css" />
	<link rel="stylesheet" href="/tpl/css/zayavka.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
	<link rel="stylesheet" href=<?="'"."/tpl/css/color_schemes/".$data['color'].".css"."'"?>/>
	<script src="/tpl/js/site_js_function.js"></script>  

	<script src="/tpl/js/ads_request.js"></script>  
	<script type="text/javascript" src="/tpl/js/jquery.maskedinput.min.js"></script>
	
	
	
	
	
	
	
	<!-- Обучение старых версий IE тегам html5 -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<meta name="google-site-verification" content="_Uu6bFWswMuBKTKECWiyreW40IqDDIdf8_s1B_k_D2o" />
<script charset="UTF-8" src="//cdn.sendpulse.com/9dae6d62c816560a842268bde2cd317d/js/push/bf3355b156269af68a85483a437bc472_1.js" async></script>
</head>
<?$style='';
///tpl/images/maxresdefault.jpg
if($_SERVER['SERVER_NAME']=='brovary-ritualna-slujba.info-gkh.com.ua') {
	$style="background-size:100% 100%;background-attachment:fixed;";?><style>#bg {background:none;}</style><?}?>
<body style="<?=$style?>">
	
	<?
		
			include Q_PATH.'/tpl/header.php';
			if(!isset($_GET['id'])) {
		?>
		
			<!-- <div id="index_page">
				<?include Q_PATH.'/views/View_index.php';?>
				
		
		</div> -->
			
		
		<div id="preloader" class="loader" style="display:none;">
		
		</div>
			<div id="ajax_content"></div>
			
		
		<?	
			}else {
				include Q_PATH.'/views/View_'.$view.'.php';
			}
			include Q_PATH.'/tpl/footer.php';
		/*
		RewriteEngine on 
RewriteCond %{ENV:HTTPS} !on 
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [NC,R=301,L]
*/
	?>
</body>
<style>

.loader {
	
	position:fixed;top:50%;left:50%;
	background: rgba(189,195,199,1);
	height: 3em;
	width: 3em;
	
	animation: loadit 4s linear infinite;
}

@keyframes loadit {
  55% {
    background: rgba(189,195,199,0.4);
    border-radius: 100%;
    transform: rotate(360deg);
    box-shadow: 7em 0 0 rgba(189,195,199,0.3),-7em 0 0 rgba(189,195,199,0.3),3em 0 0 rgba(189,195,199,0.3),-3em 0 0 rgba(189,195,199,0.3),0 7em 0 rgba(189,195,199,0.3),0 -7em 0 rgba(189,195,199,0.3),0 3em 0 rgba(189,195,199,0.3),0 -3em 0 rgba(189,195,199,0.3);
  }
}



</style>

</html>