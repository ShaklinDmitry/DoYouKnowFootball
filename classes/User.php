<?php
 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');


	class User
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAllUser()
		{
			$query = "SELECT * FROM tbl_user ORDER BY userid DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getUserData($userid)
		{
			$query = "SELECT * FROM tbl_user WHERE userid='$userid'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateUserData($userid, $data)
		{
			$name = $this->fm->validation($data['name']);
			$username = $this->fm->validation($data['username']);
			$email = $this->fm->validation($data['email']);

			$name = mysqli_real_escape_string($this->db->link, $name);	
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email = mysqli_real_escape_string($this->db->link, $email);	

			$query = "UPDATE tbl_user 
					  SET 
					  name = '$name',
					  username = '$username',
					  email = '$email' 
					  WHERE userid = '$userid'";

			$updated_row = $this->db->update($query);

			if($updated_row)
			{
				$msg = "<span class='success'>User Data Updated</span>";
				return $msg;
			}else
			{
				$msg = "<span class='success'>User Data Not Updated</span>";
				return $msg;
			}
		}

		public function DisableUser($userid)
		{
			$query = "UPDATE tbl_user
					  SET
					  status = '0'
					  WHERE userid='$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row)
			{
				$msg = "<span class='success'>User Disabled</span>";
				return $msg;
			}else
			{
				$msg = "<span class='success'>User not Disabled</span>";
				return $msg;
			}
		}

		public function EnableUser($userid)
		{
			$query = "UPDATE tbl_user
					  SET
					  status = '1'
					  WHERE userid='$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row)
			{
				$msg = "<span class='success'>User Unabled</span>";
				return $msg;
			}else
			{
				$msg = "<span class='success'>User not Enabled</span>";
				return $msg;
			}
		}

		public function DeleteUser($userid)
		{
			$query = "DELETE FROM tbl_user WHERE userid = '$userid'";
			$delete_data = $this->db->delete($query);
			if($delete_data)
			{
				$msg = "<span class='success'>User Deleted</span>";
				return $msg;
			}else
			{
				$msg = "<span class='success'>User not Deleted</span>";
				return $msg;
			}
		}

		public function getAdminData($data)
		{
			$adminUser =  $this->fm->validation($data['username']);
			$adminPass = $this->fm->validation($data['password']);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));
		}


		public function userRegistration($name, $username, $password, $email)
		{
			$name     =  $this->fm->validation($name);
			$username =  $this->fm->validation($username);
			$password =  $this->fm->validation($password);
			$email    =  $this->fm->validation($email);

			$name     = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$password = mysqli_real_escape_string($this->db->link, md5($password));
			$email    = mysqli_real_escape_string($this->db->link, $email);

			if($name == '' || $username == '' || $password == '' || $email == '')
			{
				echo "<span class='error'>Fields must not be empty</span>";
				exit();
			}else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			{
				echo "<span class='error'>Invalid Email Address</span>";
				exit();
			}else
			{
				$chkquery = "SELECT * FROM tbl_user WHERE email = '$email' ";
				$chkresult = $this->db->select($chkquery);

				if($chkresult != false)
				{
					echo "<span class='error'>Email address already exists</span>";
					exit();
				}
				else
				{
					$query = "INSERT INTO tbl_user(name, username, password, email,status) VALUES('$name','$username','$password','$email','1')";
					$inserted_row = $this->db->insert($query);

					if($inserted_row)
					{
						echo "<span class='success'>Registration successfully completed</span>";
						exit();
					}
					else
					{
						echo "<span class='error'>Error... Not registered</span>";
						exit();
					}
				}
			}
		}

		public function userLogin($email, $password)
		{
			$email    =  $this->fm->validation($email);
			$password =  $this->fm->validation($password);
			
			if($email == '' || $password == '')
			{
				echo "empty";
				exit();
			}else
			{
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if($result != false)
				{
					$value = $result->fetch_assoc();
					if($value['status'] == '0')
					{
						echo "disable";
						exit();
					}else
					{
						Session::init();
						Session::set('login',true);
						Session::set('userid', $value['userid']);
						Session::set('username', $value['username']);
						Session::set('name', $value['name']);
					}
				}else
				{
					echo "error";
					exit();
				}
			}
		}


	}

?>