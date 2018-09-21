<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
if (!preg_match("/^[a-zA-Z ]*$/",$fname))
  {
  $nameErr = "Only letters and white space allowed";
  }
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$sql1=mysqli_query($conn, "SELECT * FROM cashier WHERE username='$user'")or die(mysql_error());
 $result=mysqli_fetch_array($sql1);
 if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysqli_query($conn, "INSERT INTO cashier(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$pas',NOW())");
if($sql>0) {echo '<script type="text/javascript">'; 
echo 'alert("Cahier successifully added.");'; 
echo 'window.location.href = "admin.php";';
echo '</script>';
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $username;?> - Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
	<link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
<script src="js/prescr.js" type="text/javascript"></script>
<script src="js/validation_script.js" type="text/javascript"></script>
<!--<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>-->
 
<style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
 
</head>
 
    </style>
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
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Cashier</h4> 
<hr/>	
    <div class="tabbed_area">  
	
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">VIEW CASHIER</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">ADD CASHIER</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message;
			  echo $message1;
			  
		/* 
		View
        Displays all data from 'Cashier' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($conn, "SELECT * FROM cashier") 
                or die(mysqli_error());
				
					    
        // display data in table
        
        echo "<table border='0' cellpadding='5' align='center'>";
        echo "<tr> <th>ID</th><th>Firstname </th> <th>Lastname </th> <th>Username </th><th>Update </th><th>Delete</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array($result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                
                echo '<td>' . $row['cashier_id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				?>
				<td><a href="update_cashier.php?id=<?php echo $row['cashier_id']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete_cashier.php?cashier_id=<?php echo $row['cashier_id']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  
        <div id="content_2" class="content">  
		           <!--Cashier-->
		<?php echo $message;
			  echo $message1;
			  ?>
			<fieldset><legend>Add cashier</legend>
		<form name="form1"  onsubmit="return validateForm(validation_script.js);" action="admin_cashier.php" method="post" class="insert">
				
				<p><input name="first_name" type="text" style="width:170px" placeholder="First Name" required="required"  id="first_name" /></p>
				<p><input name="last_name" type="text" style="width:170px" placeholder="Last Name" required="required" id="last_name" /></p>
				<p><input name="staff_id" type="text" style="width:170px" placeholder="Staff ID" required="required" id="staff_id"/></p> 
				<p><input name="postal_address" type="text" style="width:170px" placeholder="Address" required="required" id="postal_address" /> </p> 
				<p class="phone"><input name="phone" type="text" style="width:170px"placeholder="Phone"  required="required" id="phone" /></p>
				<p class="email"><input name="email" type="text" style="width:170px" placeholder="Email" required="required" id="email" /></p>   
				<p class="userv"><input name="username" type="text" style="width:170px" placeholder="Username" required="required" id="username"/></p>
			<p class="pass"><input name="password" type="text" style="width:170px" placeholder="Password" required="required" id="password"/></p>
			<p class="subm"><input name="submit" type="submit" value="Submit"></p>
				
           
		</form>
				</fieldset>
        </div>   
        
      
    </div>  
  
</div>
 
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018.</div>
</div>
</body>
</html>
