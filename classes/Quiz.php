<?php
 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');


	class Quiz
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getQueByOrder()
		{
			$query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function addQuestions($data)
		{
			$quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
			$ques   = mysqli_real_escape_string($this->db->link, $data['ques']);

			$ans = array();
			$ans[1] = $data['ans1'];
			$ans[2] = $data['ans2'];
			$ans[3] = $data['ans3'];
			$ans[4] = $data['ans4'];

			$rightAns = $data['rightAns'];

			$query = "INSERT INTO tbl_ques(quesNo, ques) VALUES ('$quesNo','$ques')";
			$insertedRow = $this->db->insert($query);

			if($insertedRow)
			{
				foreach ($ans as $key => $value) {
					if($value != '')
					{
						if($rightAns == $key)
						{
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES ('$quesNo','1','$ansName')";
						}else
						{
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES ('$quesNo','0','$ansName')";
						}
						$insertRow = $this->db->insert($rquery);
						if($insertRow)
						{
							continue;
						}else
						{
							die('error');
						}

						
					}
				}
				$msg = "<span>Question Added successfully</span>";
				return $msg;
			}
		}

		public function deleteQue($quesNo)
		{
			$tables = array('tbl_ques','tbl_ans');
			foreach ($tables as $table) 
			{
				$query = "DELETE FROM $table WHERE quesNo='$quesNo'";
				$deletedData = $this->db->delete($query);
			}
			
			if($deletedData)
			{
				$msg = "<span>Question deleted successfully</span>";
			}else
			{
				$msg = "<span>Question not deleted successfully</span>";
			}

			return $msg;

		}


		public function getTotalRows()
		{
			$query     = "SELECT * FROM tbl_ques";
			$getResult = $this->db->select($query);
			$total     = $getResult->num_rows;
			return $total;
		}

		public function getQuestion()
		{
			$query = "SELECT * FROM tbl_ques";
			$getdata = $this->db->select($query);
			$result = $getdata->fetch_assoc();
			return $result;
		}

		public function getQuesByNumber($number)
		{
			$query = "SELECT * FROM tbl_ques WHERE quesNo = '$number'";
			$getdata = $this->db->select($query);
			$result = $getdata->fetch_assoc();
			return $result;
		}

		
		public function getAnswer($number)
		{
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number'";
			$getData = $this->db->select($query);
			return $getData;
		}

	}

?>