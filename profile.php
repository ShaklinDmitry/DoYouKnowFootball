<?php 
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php'; 
?>
<?php
	Session::checkSession();
	$userid = Session::get('userid');
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$updateUser = $usr->updateUserData($userid, $_POST);
	}
?>
<style>
	.profile
	{
		width:370px;
		margin:0 auto;
		border:1px solid #ddd;
		padding: 50px;
	}
</style>

<div class='row'>
<div class="main text-center" style="width:100%;">
<h1>Ваш аккаунт</h1>
	<div class="profile">

	<?php
		if(isset($updateUser))
		{
			echo $updateUser;
		}
	?>

		<form action="" method="post">


		<?php
			$getData = $usr->getUserData($userid);

			if($getData)
			{
				$result = $getData->fetch_assoc()
		?>

			<table class="tbl">    
				 <tr>
				   <td>Имя</td>
				   <td><input name="name" type="text" value="<?php echo $result['name']?>"</td>
				 </tr>
				 <tr>
				   <td>Username</td>
				   <td><input name="username" type="text" value="<?php echo $result['username']?>"></td>
				 </tr>
				 <tr>
				   <td>Email</td>
				   <td><input name="email" type="text" value="<?php echo $result['email']?>"></td>
				 </tr> 
				 
				  <tr>
				  <td></td>
				   <td><input type="submit" value="Обновить">
				   </td>
				 </tr>
       		</table>

		<?php
			}
		?>

	   </form>
	</div>
</div>	
</div>
</div>
<?php include 'inc/footer.php'; ?>