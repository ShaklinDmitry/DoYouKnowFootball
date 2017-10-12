<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/lib/Session.php');
Session::setHideHeaderMenu(false);
include 'inc/header.php';
 ?>
<div class="main">
  <div class="row">
    <div class="col-xs-12 text-center" style="width: 100%;">Регистрация</div>
  </div>

<div class="row">
	<div class="segment col-xs-12 text-center" style="margin-top:50px;">

	<form action="" method="post">
		<table>
		     <tr>
           <td>Name</td>
           <td><input type="text" name="name" id="name"></td>
         </tr>
		     <tr>
           <td>Username</td>
           <td><input name="username" type="text" id="username"></td>
         </tr>
         <tr>
           <td>Password</td>
           <td><input type="password" name="password" id="password"></td>
         </tr>
         <tr>
           <td>E-mail</td>
           <td><input name="email" type="text" id="email"></td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" id="regsubmit" value="Signup">
           </td>
         </tr>
       </table>
	   </form>
	   <p>Already Registered ? <a href="index.php">Login</a> Here</p>
     <span id='state'></span>
	</div>
</div>

	
</div>
<?php include 'inc/footer.php'; ?>