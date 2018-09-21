<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['first_name'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> - Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
    <link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<style>
#left_column{
height: 470px;
}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg" class="img"></a> Pharmacy Sys</h1>
    <?php 
	include('connect_db.php');
	$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
	$ros=mysqli_num_rows($qury);
	if($ros>0){
		?>
	 <p class="dd"><img src="images/red.png" class="imgc">: Low stock</p>
	<?php
	}else{
		?>
	<p class="ddc"><img src="images/green.png" class="imgc">: Enough stock</p>
	<?php
		
	}
	?>
   <p class="user">User:<?php echo $fname." ".$lname; ?></p> </div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="pharmacist.php">Home</a></li>
			<li><a href="prescription.php">Prescription</a></li>
			<li><a href="stock_pharmacist.php">Stock</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="pharmacist.php" class="dashboard-module">
                	<img src="images/pharmacist_icon.jpg" width="100" height="100" alt="edit" />
                	<span>Dashboard</span>
                </a>
                             
                <a href="prescription.php" class="dashboard-module">
                	<img src="images/prescri.jpg"  width="100" height="100" alt="edit" />
                	<span>Prescription</span>
                </a>
	            <a href="stock_pharmacist.php" class="dashboard-module">
                	<img src="images/stock_icon.jpg" width="100" height="100" alt="edit" />
                	<span>Stock</span>
                </a>
              </div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018.</div>
</div>
</body>
</html>
