<? require_once  Q_PATH.'/sys/db_factories_sites.php';
$dbss = new SafeMySQL();
$a = $dbss->getRow("SELECT * FROM `sites_settings` WHERE `factory_id`='".$_GET['id']."'");
//var_dump($a);
$st = '';
if($_GET['id']=='251') $st = 'margin-top: -19px;';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<!-- <base href="/"> -->
	<title>Електронний кабінет споживача житлово-комунальних послуг</title>
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Template Basic Images Start -->
	<!-- <meta property="og:image" content="path/to/image.jpg"> -->
	<!-- Template Basic Images End -->
	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#000">
	<!-- Custom Browsers Color End -->
	<link rel="stylesheet" href="/admin_rc/css/login_page.css">
</head>
<body>
	<!-- .site-header -->
	<div class="container py-5 login-page">
		<div class="row">
						<div class="col-12 mb-4 text-center col-lg-4 text-lg-left">
				<img style="<?=$st?>" src="https://info-gkh.com.ua/user_uploads/<?=$a['user_folder_name']?>/<?=$a['site_logo']?>" alt="" class="login-page__logo">
			</div>
			<div class="col-12 mb-4 text-center col-lg-8 text-lg-left">
				<h1 class="login-page__heading">Електронний кабінет <span class="login-page__heading login-page__heading--small">споживача житлово-комунальних послуг</span></h1>
			</div>
			<!-- left side -->
			<div class="col-12 col-lg-7 py-4 login-page__li-wrapper">
				<p class="mb-1 pl-4 login-page__li-heading">В кабінеті ви можете:</p>
				<ul class="pl-4 login-page__ul">
					<li class="login-page__li">перевірити стан розрахунків та сплатити за спожиті послуги</li>
					<li class="login-page__li">переглянути статистику споживання та оплати</li>
					<li class="login-page__li">перевірити свої відомості для нарахування за послуги</li>
					<li class="login-page__li">роздрукувати рахунок та акт звіряння</li>
					<li class="login-page__li">передати показники лічильників</li>
					<li class="login-page__li">визвати майстра, перевірити повноваження контролера</li>
					<li class="login-page__li">замовити повірку, ремонт, пломбування лічильників</li>
					<li class="login-page__li">оформити договір, переглянути укладений договір</li>
				</ul>
				<div class="row pt-4 pb-2">
					<div class="col-8 offset-2">
						<div class="row justify-content-around">
							<!-- ico -->
							<div class="col-6 col-md-3 text-center">
								<img src="/tpl/images/cold.png" alt="" class="img-fluid mb-2 login-page__ico">
							</div>
							<!-- ico -->
							<div class="col-6 col-md-3 text-center">
								<img src="/tpl/images/energy.png" alt="" class="img-fluid mb-2 login-page__ico">
							</div>
							<!-- ico -->
							<div class="col-6 col-md-3 text-center">
								<img src="/tpl/images/gas.png" alt="" class="img-fluid mb-2 login-page__ico">
							</div>
							<!-- ico -->
							<div class="col-6 col-md-3 text-center">
								<img src="/tpl/images/hot.png" alt="" class="img-fluid mb-2 login-page__ico">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- right side -->
			<div class="col-12 col-lg-5 pt-5">
				<div class="ml-0 ml-lg-3 m-auto">  <!-- remove .login-page__form-wrapper -->
					<?
					include Q_PATH.'/views/View_'.$view.'.php';
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="/admin_rc/js/scripts.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
	<script src="/admin_rc/js/common_login_page.js"></script>
</body>
</html>
