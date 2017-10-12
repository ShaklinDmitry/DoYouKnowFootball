<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php'; 
?>
<?php

	Session::checkLogin();
?>

<div class="main">
	<div class='row' style="margin-top: 30px; font-size: 24px;">
		<div class='gameName col-xs-12 text-center'>Что ты знаешь о футболе?</div>
	</div>

	<div class="row">

	<div class="ball_index_img col-xs-5 text-center">
		<img src="img/test.png"/>
	</div>
	<div class="segment col-xs-7 text-center">
		<span>Войти</span>
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" id="email"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password" id="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="loginsubmit" value="Войти">
			   </td>
			 </tr>
       </table>
	   </form>

	   <p>Новый игрок ? <a href="register.php">Регистрация</a> </p>
	   <span class="empty" style="display: none">Field must not be empty</span>
	   <span class="error" style="display: none">Email or password not matched</span>
	   <span class="disable" style="display: none">User ID Disabled</span>
	</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>