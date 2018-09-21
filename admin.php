<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
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
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/prescr.js" type="text/javascript"></script>
<style>
#left_column{
height: 470px;
}

</style>
</head>
    <style>
        body{
            background-image: url(dimages/sam.jpg);
            background-size: cover;
        }</style>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg" class="img"></a> Pharmacy Sys</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php">Home</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
<div id="main">
    
 <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="admin.php" class="dashboard-module">
                	<img src="images/admin_icon.jpg" width="75" height="75" alt="edit" />
                	<span>Dashboard</span>
                </a>
                <a href="admin_pharmacist.php" class="dashboard-module">
                	<img src="images/pharmacist_icon.jpg"  width="75" height="75" alt="edit" />
                	<span>Pharmacist</span>
                </a>
                
                <a href="admin_manager.php" class="dashboard-module">
                	<img src="images/manager_icon.png"  width="75" height="75" alt="edit" />
                	<span>Manager</span>
                </a>
                  
                <a href="admin_cashier.php" class="dashboard-module">
                	<img src="images/cashier_icon.jpg" width="75" height="75" alt="edit" />
                	<span>Cashier</span>
                </a>
                 <a href="delete.php" class="dashboard-module">
                	<img src="images/clear.jpg" width="75" height="75" alt="edit" />
                	<span>Clear data</span>
                </a>
			</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018.</div>
</div>
</body>
</html>
