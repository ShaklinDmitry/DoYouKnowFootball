<?php 
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php'; 
?>
<?php
	Session::checkSession();
	$question = $quiz->getQuestion();
	$total    = $quiz->getTotalRows();
?>
<div class="main">
	<div class='greetingExternal row'>
		<div class="greetingInternal text-center">Добро пожаловать в игру</div>
	</div>
	<div class="row">
		<div class="col-xs-5 text-center" style="margin:0 auto; padding-bottom: 30px">
			<img src="img/test.png"/>
		</div>
	
		<div class="col-xs-7 text-center segment">
		<h2>Начать игру</h2>
		<ul>
			<li><a href="test.php?q=<?php echo $question['quesNo']; ?>">Начать</a></li>
		</ul>
		</div>
	</div>
	
  </div>
<?php include 'inc/footer.php'; ?>