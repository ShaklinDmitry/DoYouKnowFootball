<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once($filepath.'/../classes/Quiz.php');

	$quiz = new Quiz();
?>

<style>
.adminpanel
{
	width:500px;color:#999;margin:30px auto 0;padding:50px;border:1px solid #ddd;
}

</style>

<?php
	if(isset($_GET['delque']))
	{
		$queNo = (int)$_GET['delque'];
		$deletedData = $quiz->deleteQue($queNo);
	}
	
?>


<div class="main">

	<?php 
		if(isset($deletedData))
		{
			echo $deletedData;
		}
	?>

	<div class='quelist'>
		<table class='tblone'>
			<tr>
				<th width = '10%'>No</th>
				<th width = '60%'>Question</th>
				<th width = '30%'>Action</th>
			</tr>
<?php
	$getData = $quiz->getQueByOrder();
	if($getData)
	{
		$i = 0;
		while($result = $getData->fetch_assoc())
		{
			$i++;
?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['ques']; ?></td>
				<td>
					<a onclick = "return confirm('Are you sure to remove?')" href='?delque=<?php echo $result['quesNo'];?>'>Remove</a>
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