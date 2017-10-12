<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once($filepath.'/../classes/Quiz.php');

	$quiz = new Quiz();
?>

<style>
.adminpanel
{
	width:600px;color:#999;margin:20px auto 0;padding:50px;border:1px solid #ddd;
}

</style>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$addQue = $quiz->addQuestions($_POST);
	}

	$total = $quiz->getTotalRows();
	$next = $total + 1;
?>

<div class="main">
<h1>Admin Panel</h1>
<?php
	if(isset($addQue))
	{
		echo $addQue;
	}
?>
<div class='adminpanel'>
	<form action="" method="post">
		<table>
			<tr>
				<td>Question No</td>
				<td>:</td>
				<td><input type="number" 
				value="<?php
							if(isset($next))
							{
								echo $next;
							}	
					   ?>"
				 name="quesNo"></td>
			</tr>
			<tr>
				<td>Question</td>
				<td>:</td>
				<td><input type="text" name="ques" placeholder="Enter Question" required></td>
			</tr>
			<tr>
				<td>Choice1</td>
				<td>:</td>
				<td><input type="text" name="ans1" placeholder="Enter Choice One" required></td>
			</tr>
			<tr>
				<td>Choice2</td>
				<td>:</td>
				<td><input type="text" name="ans2" placeholder="Enter Choice Two" required></td>
			</tr>
			<tr>
				<td>Choice3</td>
				<td>:</td>
				<td><input type="text" name="ans3" placeholder="Enter Choice Three" required></td>
			</tr>
			<tr>
				<td>Choice4</td>
				<td>:</td>
				<td><input type="text" name="ans4" placeholder="Enter Choice Four" required></td>
			</tr>
			<tr>
				<td>Correct Number</td>
				<td>:</td>
				<td><input type="number" name="rightAns" placeholder="Enter Answer Num" required></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><input type="submit" value="Add Question"></td>
			</tr>


		</table>

	</form>
</div>

	
</div>
<?php include 'inc/footer.php'; ?>