<?php
class Session
{
	 public static $initSession = false;
	 public static function init()
	 {
	 	$initSession = true;
	 	session_start();
	 }
	 
	 public static function set($key, $val)
	 {
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key)
	 {
	 	if (isset($_SESSION[$key])) 
	 	{
	 		return $_SESSION[$key];
	 	} else 
	 	{
	 		return false;
	 	}
	 }


	public static function checkAdminSession()
	{
	 	self::init();
	 	if (self::get("adminLogin") == false) 
	 	{
	 		self::destroy();
	 		echo "<script>location.href='login.php';</script>";
	 	}
	 }

    public static function checkAdminLogin()
    {
	 	self::init();
	 	if (self::get("adminLogin") == true) 
	 	{
	 		echo "<script>location.href='index.php';</script>";
	 	}
	 }


	 public static function checkSession()
	 {
	 	if (self::get("login") == false) 
	 	{
	 		self::destroy();
	 		echo "<script>location.href='index.php';</script>";
	 	}
	 }

	 public static function checkLogin()
	 {
	 	if (self::get("login") == true) 
	 	{
	  		echo "<script>location.href='exam.php';</script>";
	 	}
	 }

	 public static function setHideHeaderMenu($state)
	 {
	 	global $initSession;

	 	if($initSession == false)
	 	{
		 	Session::init();
	 	}
		Session::set('hide_header_menu',$state);
	 }

	 public static function destroy()
	 {
	 	session_destroy();
	 	session_unset();
	 }
}

?>