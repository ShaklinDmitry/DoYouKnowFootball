<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
	Session::destroy();
 	header("Location:index.php");
 	exit();
}

spl_autoload_register(
	function($class)
	{
		include_once("classes/".$class.".php");
	}
);	

$db   = new Database();
$fm   = new Format();
$usr  = new User();
$quiz = new Quiz();
$pro  = new Process();
?>
<html>
<head>
	<title>Online Exam System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

</head>
<body>
<div class="container">
<!--	<section class="headeroption"></section>-->
		<div class="row">
		<section class="maincontent">
		<div class="menu" style="margin-top: 30px;">
		<ul class="col-xs-7">
			<?php
			if(Session::get('hide_header_menu') == false)
			{
				$login = Session::get("login");
				if($login == true)
				{
			?>
					<li><a href="profile.php">Аккаунт</a></li>
					<li><a href="exam.php">Играть</a></li>
					<li><a href="?action=logout">Выйти</a></li>
			<?php
				}else
				{
			?>
					<li><a href="index.php">Войти</a></li>
					<li><a href="register.php">Регистрация</a></li>
			<?php
				}
			}
			?>

		</ul>

		<?php
			$login = Session::get("login");
			if($login == true)
			{
		?>
				<div class="col-xs-5 text-right" style="color:#888;margin-top:30px;">Добро пожаловать
					<strong>
						<?php echo Session::get("name"); ?>
					</strong>
		<?php
			}
		?>
				</div>
		</div>
	</div>
	