<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php $user?> Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/legend.css">
    <link rel="stylesheet" type="text/css" href="style/forme.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<link rel="stylesheet" href="style/table2.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="style/drop.css" type="text/css" media="screen" /> 
<script src="js/function1.js" type="text/javascript"></script>
   <style>#left-column {height: 477px;}
 #main {height: 477px;}
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
       <p class="user">User:<?php echo $fname." ".$lname; ?></p></div>
<div id="left_column">
<div id="button">
		<ul>
			<li><a href="manager.php">Home</a></li>
			<li><a href="view.php">View Users</a></li>
			<li><a href="view_prescription.php">View Prescriptions</a></li>
			<li><a href="stock.php">Manage Stock</a></li>
			     <li><a href="stat.php">Statistics</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>View statistics</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Statistics </a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">******</a></li>
			<li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">*****</a></li>
              
        </ul>  
        
        <div id="content_1" class="content"> 
			  <fieldset><legend>Statistics</legend>
            <form action="" method="post">
        <P class="sel">
 Date:<select name="day" onmousedown="if(this.options.length>5){this.size=3;}" onchange="this.blur()"  onblur="this.size=0;" required>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
 <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
 <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="30">31</option>
</select> 
 Month:<select name="month"  onmousedown="if(this.options.length>5){this.size=3;}" onchange="this.blur()"  onblur="this.size=0;" required>
  <option value="January">January</option>
  <option value="February">February</option>
  <option value="March">March</option>
  <option value="April">April</option>
<option value="May">May</option>
<option value="June">June</option>
<option value="July">July</option>
<option value="August">August</option>
<option value="September">September</option>
<option value="October">October</option>
 <option value="November">November</option>
<option value="December">December</option>
</select> 
          
 Year:<select name="year" onmousedown="if(this.options.length>5){this.size=3;}" onchange="this.blur()"  onblur="this.size=0;" required>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
 <option value="2027">2027</option>
<option value="2028">2028</option>
</select>
            <input type="submit" value="submit" name="su">
        
            <p>
              
            <?php
                
                include_once('connect_db.php');
                if(isset($_POST['su'])){
                    $date=$_POST['day'];
                    $month=$_POST['month'];
                    $year=$_POST['year'];
                    
                     $result = mysqli_query($conn,"select DISTINCT drug,drug_name from sales LEFT JOIN stock ON sales.drug=stock.stock_id where day='$date' and month='$month' and year='$year'")or die(mysqli_error());
		// display data in table
        echo "<table border='0' cellpadding='3'>";
        echo "<tr> <th>Drug Name</th><th>Unit Cost</th><th>Quantity Sold</th><th>Total sales</th></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
               $costs=mysqli_query($conn,"select cost from sales where drug='".$row['drug']."'");
            $cost=mysqli_fetch_array($costs);
           $count=mysqli_query($conn,"select SUM(quantity) as tot from sales where drug='".$row['drug']."'");
		$sam=mysqli_fetch_assoc($count);
            $tot=$cost['cost']* $sam['tot'];
                echo "<tr>";
                echo '<td>' . $row['drug_name'] . '</td>';
                echo '<td>' . $cost['cost'] . '</td>';
                echo '<td>' . $sam['tot'] . '</td>';
               echo '<td>' . $tot. '</td>';
              echo "</tr>";
           
				?>
				
				<?php
         
		 } 
        
        echo "</table>";

                    
                    
                    
                    
                }
                
                
                
                
                
                ?>
            
            
            
            
            
            
            </p>
            
               
            </P>
    </form>
				  </fieldset>
        </div>  
        <div id="content_2" class="content">  
		          
        </div>  
		 <div id="content_3" class="content">  
		     
        </div>
			  
    </div>  
</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018.</div>
</div>
</body>
</html>