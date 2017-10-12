<?php 
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php'; 
?>
<?php
	$question = $quiz->getQuestion();
	$total    = $quiz->getTotalRows();
?>

	<div class="row" style="margin-top: 70px;">
		<div class="text-center" style="width:100%">
			Вы проиграли
		</div>
	</div>
	<div class="row">
		<div class="text-center" style="margin-top: 50px; width:100%;">
			<a href="test.php?q=<?php echo $question['quesNo']; ?>">Попробовать еще раз</a>
		</div>
	</div>


<?php include 'inc/footer.php'; ?>