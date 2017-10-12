<?php
 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Process
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function processData($data)
		{
		/*	$selectedAns =  $this->fm->validation($data['ans']);
			$number      = $this->fm->validation($data['number']);

			$selectedAns = mysqli_real_escape_string($this->db->link, $selectedAns);
			$number      = mysqli_real_escape_string($this->db->link, $number);*/

			if(isset($data['ans']))
			{
				$selectedAns = $data['ans'];
			}else
			{
				echo "<script>location.href='fail.php';</script>";
				exit();
			}
			$number = $data['number'];

			$next = $number + 1;

			if(!isset($_SESSION['score']))
			{
				$_SESSION['score'] = '0';
			}

			$total = $this->getTotal();
			$right = $this->rightAns($number);

			if($right == $selectedAns)
			{
				$_SESSION['score']++;
			}

			if($right != $selectedAns)
			{
				echo "<script>location.href='fail.php';</script>";
				exit();
			}

			if($number == $total)
			{
				echo "<script>location.href='final.php';</script>";
				exit();
			}else
			{
				echo "<script>location.href='test.php?q=".$next."';</script>";
			}
		}

		private function getTotal()
		{
			$query     = "SELECT * FROM tbl_ques";
			$getResult = $this->db->select($query);
			$total     = $getResult->num_rows;
			return $total;
		}

		private function rightAns($number)
		{
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' AND rightAns = '1'";
			$getData = $this->db->select($query)->fetch_assoc();
			$result = $getData['id'];
			return $result;
		}

	}

?>