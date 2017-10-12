<?php 
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php'; 
?>
<?php
	Session::checkSession();
?>
<div class="main">
<h1>Это победа!!!</h1>
	<div class='starttest'>
		<p>Поздравляем!</p>
		<p>Счет: 
			<?php 
				if(isset($_SESSION['score']))
				{
					echo $_SESSION['score'];
					unset($_SESSION['score']);
				}
			?>	
		</p>

		<a href="starttest.php">Еще раз</a>
	</div>	
</div>
<?php include 'inc/footer.php'; ?>