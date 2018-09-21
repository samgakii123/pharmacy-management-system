<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
  setTimeout(function(){
    document.getElementById('alert-messo').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 2000);
</script>
<?php
include_once 'connect_db.php';
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];
$position=$_POST['position'];
	if($position!=''){
	
switch($position){
case 'Admin':
$result=mysqli_query($conn,"SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['admin_id']=$row[0];
$_SESSION['username']=$row[1];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Pharmacist':
$resultp=mysqli_query($conn, "SELECT * FROM pharmacist WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($resultp);
if($row>0){
session_start();
$_SESSION['pharmacist_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
	
}
break;
case 'Cashier':
$result=mysqli_query($conn, "SELECT cashier_id, first_name,last_name,staff_id,username FROM cashier WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['cashier_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cashier.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Manager':
$result=mysqli_query($conn, "SELECT manager_id, first_name,last_name,staff_id,username FROM manager WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['manager_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
}
}else{
echo'<script>window.alert("Please select your login category")</script>';
}
}
echo <<<LOGIN
<!DOCTYPE html>
<html>
<head>
<title>Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/login.css">
<style>
#content {
height: auto;
}
#main{
height: auto;}
body{
background-color:;
}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><img src="images/hd_logo.jpg">Pharmacy Sys</h1>
</div>
<div id="main">

  <section class="container">
  
     <div class="login">
	 <img src="images/avatar.png">
     <div class="form">
      <h1 class="head">Login here</h1>
	  $message
      <form method="post" action="index.php">
		 <p><input type="text" name="username" value="" placeholder="Username" required></p>
        <p><input type="password" name="password" value="" placeholder="Password" required></p>
		<select name="position">
	        <option>Pharmacist</option>
			<option>Admin</option>
			<option>Cashier</option>
			<option>Manager</option>
			</select>
        <p class="submit"><input type="submit" name="submit" value="Login"></p>
      </form>
      </div>
      </div>
   
    </section>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018. </div>
</div>
</body>
</html>
LOGIN;
?>
</html>