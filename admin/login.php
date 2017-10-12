<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/loginheader.php');
	include_once ($filepath.'/../classes/Admin.php');
	$ad = new Admin();
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$admin_data = $ad->getAdminData($_POST);
	}
?>

<div class="main" style="border:none; width:100%;">
	<div class="row">
		<div class="text-center" style="width: 100%;font-size: 40px;">
			Admin Login
		</div>
	</div>

<div class="adminlogin" style="font-size: 30px; width: 80%;">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login" style="font-size:30px;"/></td>
			</tr>
			<tr colspan='2'>
				<?php
					if(isset($admin_data))
					{
						echo $admin_data;
					}
				?> 
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>