<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once($filepath.'/../classes/User.php');

	$usr = new User();
?>

<style>
.adminpanel
{
	width:500px;color:#999;margin:30px auto 0;padding:50px;border:1px solid #ddd;
}

</style>

<?php
	if(isset($_GET['dis']))
	{
		$disId = (int)$_GET['dis'];
		$disUser = $usr->DisableUser($disId);
	}
	if(isset($_GET['ena']))
	{
		$enaId = (int)$_GET['ena'];
		$enaUser = $usr->EnableUser($enaId);
	}
	if(isset($_GET['del']))
	{
		$delId = (int)$_GET['del'];
		$delUser = $usr->DeleteUser($delId);
	}
?>


<div class="main">
	<?php 
		if(isset($disUser))
		{
			echo $disUser;
		}
		if(isset($enaUser))
		{
			echo $enaUser;
		}
		if(isset($delUser))
		{
			echo $delUser;
		}

	?>
	<div class='manageuser'>
		<table class='tblone'>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
<?php
	$userData = $usr->getAllUser();
	if($userData)
	{
		$i = 0;
		while($result = $userData->fetch_assoc())
		{
			$i++;
?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $result['name'];?></td>
				<td><?php echo $result['username'];?></td>
				<td><?php echo $result['email'];?></td>
				<td>
					<?php 
						if($result['status'] == '0')
						{
					?>
						<a onclick = "return confirm('Are you sure to enable?')" href='?ena=<?php echo $result['userid'];?>'>Enable</a> ||

					<?php 
						}else
						{
					?>

					<a onclick = "return confirm('Are you sure to disable?')" href='?dis=<?php echo $result['userid'];?>'>Disable</a> ||

					<?php
						}
					?>

					<a onclick = "return confirm('Are you sure to remove?')" href='?del=<?php echo $result['userid'];?>'>Remove</a>
				</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>