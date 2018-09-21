<?php
session_start();
include_once('connect_db.php');

if(isset($_SESSION['username'])){
$id=$_SESSION['cashier_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}

?>
	<?php
		$SN= mysqli_query ($conn, "SELECT 1+MAX(serialno) FROM receipts");
		$invoice=mysqli_fetch_array($SN);
		if($invoice[0]=='')
		{$invoiceNo=1000; }
		else{$invoiceNo=$invoice[0];}
		$serno=$invoiceNo;
		
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -  Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
 <link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" SRC="js/superfish/hoverIntent.js"></script>
	<script type="text/javascript" SRC="js/superfish/superfish.js"></script>
	<script type="text/javascript" SRC="js/superfish/supersubs.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("ul.sf-menu").supersubs({ 
				minWidth:    12, 
				maxWidth:    27, 
				extraWidth:  1    
								  
			}).superfish();
							
		}); 
	</script>
	<script SRC="js/cufon-yui.js" type="text/javascript"></script>
	<script SRC="js/Liberation_Sans_font.js" type="text/javascript"></script>
    	<script SRC="js/.js" type="text/javascript"></script>
	<script SRC="js/jquery.pngFix.pack.js"></script>
	<script type="text/javascript">
        
		Cufon.replace('h1,h2,h3,h4,h5,h6');
		Cufon.replace('.logo', { color: '-linear-gradient(0.5=#FFF, 0.7=#DDD)' }); 
	</script>
   <style>#left-column {height: 477px;}
 #main {height: 500px;}
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
			<li><a href="cashier.php">Home</a></li>
			<li><a href="payment.php"target="_top">Process payment</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
-- <div id="tabbed_box" class="tabbed_box">  
    <h4> Manage Payments</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1">Process payments</a></li>  
              
        </ul>  
        
		
		
        <div id="content_1" class="content"> 
		<div id="viewer1"><span id="viewer2"></span></div>
		  <form name="myform" onsubmit="return validateForm(this);" action="receipt.php" method="post" >
			<table width="220" height="106" border="0" >	
				<tr><td ><input name="invoice_no" type="text" style="width:170px" placeholder="Invoice No" required="required" id="invoice_no" /></td></tr>
				<tr><td></td></tr>
		        <tr><td></td></tr>
				<tr><td ><?php
				echo"<select  class='input-small', name='payType', style='width:170px;', id='payment_type'>";
						 $getpayType=mysqli_query($conn, "SELECT * FROM paymentTypes");
						 echo"<option>Select Payment</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['Name']."</option>";
			}
		
		echo"</select>";?>  </td></tr>
				<tr><td></td></tr>
				
				<tr><td ><input name="serial_no" type="text" style="width:170px" placeholder="Serial No"  id="serial_no" value="<?php echo $serno ?>" /></td></tr>  
				<tr><td></td></tr>
				<tr><td><input name="tuma" id="tuma" type="submit" value="Submit"/></td></tr>
            </table>
              
              		<?php
		$_SESSION['invoice_no']=$invoice_no;
		$_SESSION['amount']=$amount;
		$_SESSION['payType']=$payType;
		$_SESSION['serial_no']=$serial_no;
		
		?>       
 <script>
			$(document).ready(function()
	{
	$("#invoice_no").change(function() 
		{	
			var invoice_no=$("#invoice_no").val();
			
			
			
			if(invoice_no.length >0)		
			
				{
					$.ajax(
				{
type: "POST", url: "check.php", data: 'invoice_no='+invoice_no , success: function(msg)
									
					{  
						$("#viewer2").ajaxComplete(function(event, request, settings)
							{ 
								
										
									if(msg)
									{ 
                                          

										$(this).html(msg);
                                       
									
										 				
										
									} 
									else
									{
										$(this).html('<font color="red"><strong>Invoice does not exist</strong></font>');
									}
								
									 
								   
							});
					}    
				}); 
				}else{
                    window.alert("Please provide an invoice number");
                }
	});		
	});		
		
		</script>
              
		</form>         
        </div>  
    </div>  
</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2018.</div>
</div>
</body>
    
</html>
