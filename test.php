<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php'); 
Session::setHideHeaderMenu(true);
include 'inc/header.php';
?>
<?php 
	Session::checkSession();
	if(isset($_GET['q']))
	{
		$number = (int)$_GET['q'];
	}else
	{
		echo "<script>location.href='exam.php';</script>";
	}
	$total = $quiz->getTotalRows();
	$question = $quiz->getQuesByNumber($number);
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$process = $pro->processData($_POST);
	}
?>

<div class="main">
<h1 style="font-size:20px; margin-top: 55px;">Вопрос <?php echo $question['quesNo']; ?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3><?php echo $question['ques']; ?></h3>
				</td>
			</tr>

			<?php 
				$answer = $quiz->getAnswer($number);

				if($answer)
				{
					while($result = $answer->fetch_assoc())
					{
			?>
						<tr>
							<td>
								<a href="test.php?ans=<?php echo $result['id'];?>&" class="someLink"><?php echo $result['ans'];?></a>

							 <input type="radio" name="ans" value="<?php echo $result['id'];?>"/><?php echo $result['ans'];?>
							</td>
						</tr>
			<?php
					}
				}
			?>

			<tr>
			  <td>
				<input type="submit" name="submit" value="Ответить"/>
				<input type="hidden" name="number" value="<?php echo $question['quesNo']; ?>" />
				<input type="hidden" name="ans" value="" />

			  </td>
			</tr>
			
		</table>
	</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>