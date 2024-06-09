<?php
$login_session="" ;
 $url="";
 $status="";
include("conn.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_seller']))
{
  header("Location:./dashboard.php");
  exit;
}
$error="";
$show="display:none;";
$alert="";
if (isset($_POST['register'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $sname = test_input($_POST["sname"]);
	 $smob = test_input($_POST["smob"]);
	 $spass = test_input($_POST["spass"]);
	 $altmob = test_input($_POST["altmob"]);
	 $address = test_input($_POST["address"]);
	 $btype = test_input($_POST["btype"]);
	 $gst = test_input($_POST["gst"]);
	 $email = test_input($_POST["email"]);
	 $bank_name = test_input($_POST["bank_name"]);
	 $ac_name = test_input($_POST["ac_name"]);
	 $ac_no = test_input($_POST["ac_no"]);
	 $conf_ac_no = test_input($_POST["conf_ac_no"]);
	 $ifsc = test_input($_POST["ifsc"]);
	 $pincode = test_input($_POST["pincode"]);
	 $regdate= date("Y-m-d");
	 $status=2;
	 if($ac_no==$conf_ac_no){
     $sql = "SELECT smob FROM seller WHERE smob='$smob' AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
      if ($count >0){
        $error="Seller mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO seller (sname, smob, spass, altmob, btype, gst, email, pincode, address, bank_name, ac_name, ac_no, ifsc, regdate, status) 
		VALUES ('$sname','$smob','$spass','$altmob','$btype','$gst','$email','$pincode','$address','$bank_name','$ac_name','$ac_no','$ifsc','$regdate', $status)";
		if($conn->query($sql)===TRUE){			
			//$message="Hi, ".$euname."! Your Account is Successfully created on Megavision.org.in. Your User Name: ".$eumob." and password:".$eupass." Thank You.";
			//$mobile_number=$eumob;
			//$message1= sms_unicode($message);
			//sentsms($message1, $mobile_number);
			//SMS to Admin
			//$message="New Account created by ".$euname." on Megavision.org.in. User Name: ".$eumob." and password:".$eupass." Thank You.";
			//$mobile_number="7506192211";
			//$message1= sms_unicode($message);
			//sentsms($message1, $mobile_number);
			$error="Seller Account Is Created Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
			$_SESSION['login_seller']=$smob;
			header("location:./dashboard.php");
			die();
		}
		else{
			$error="Proccess Is Invalid!";
			$show="display:show;";
			$alert="alert alert-danger";
		}
	  }
	  header( "Refresh:1; url=./login.php", true, 303);
  }
  else
  {
    $error="Your Confirm Account Number is not Match!";
    $show="display:show;";
    $alert="alert alert-danger";
  }
	}
}
if (isset($_GET['alert'])) {
 $alert=$_GET['alert'];
 $error=$_GET['error'];
 $show=$_GET['show'];
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title> Create Seller Account </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function validation(){
      var counter=0;
      var f1 = document.getElementById("ac_no").value;
      var f2 = document.getElementById("conf_ac_no").value;
      //var r= parseFloat(f1)*parseFloat(f2);
      if(f1==f2)
      {
          document.getElementById("msg").innerHTML="Password Is Match";
          document.getElementById("ac_no").style.borderColor = "#008000";
          document.getElementById("conf_ac_no").style.borderColor = "#008000";
		  return true;
      }
      else
      {
        document.getElementById("msg").innerHTML="Password Is Not Match";
        document.getElementById("ac_no").style.borderColor = "#E34234";
        document.getElementById("conf_ac_no").style.borderColor = "#E34234";
		return false;
      }
   }
  </script>
</head>
<body>
<nav class="navbar navbar-default" style="background-color: #004c91">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" style="border-color: #fff;" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" style="color: white" href="#"> Seller Panel </a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a style="color: white" href="login.php">Login</a></li>
      </ul>
     <!-- <ul class="nav navbar-nav navbar-right">    
        <li>
          <a href="./signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="container" style="margin-top:20px">
	<div class="row">
		<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
		<div class="panel panel-info">
		    <div class="panel-heading" style="background-color:#004c91;color:white" align="center"> Seller Account Creation </div>
		    <div class="panel-body">
				<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
				<form enctype="multipart/form-data" method="POST" action="" onsubmit="return validation()">
					<div class="row">
						<div class="col-md-6">	
						<div class="form-group">
						  <label class="control-label">Name</label>
							<input class="form-control" type="text" id="sname" name= "sname" placeholder="Seller Name" required>
						</div>		
						  <div class="form-group">
						  <label class="control-label">Mobile Number</label>
							<input class="form-control" type="number" id="smob" name= "smob" placeholder="Mobile Number" required>
						  </div>
						 <div class="form-group">
						  <label class="control-label">Password</label>
							<input class="form-control" type="password" id="spass" name= "spass" placeholder="Password" required>
						  </div>
						  <div class="form-group">
							 <label class="control-label">Alt Mobile</label>
							<input class="form-control" type="number" id="altmob" name= "altmob"  placeholder="Alt Mobile Number" required>
						  </div>
						  <div class="form-group">
						  <label class="control-label">Email Id </label>
							<input class="form-control" type="email" id="email" name= "email" placeholder="Email Id" required>
						</div>
						  <div class="form-group">
							<label class="control-label">Pick-Up Address</label>
							<textarea class="form-control" rows="2" id="address" name= "address" required></textarea>
						  </div>
						  <div class="form-group">
						  <label class="control-label">Pick-Up PIN Code </label>
							<input class="form-control" type="number" id="pincode" name= "pincode" placeholder="PIN Code" required>
						</div>
						</div> 
						<div class="col-md-6">	
							<div class="form-group">
								<label class="control-label">Select Business Type </label>
									<select class="form-control" id="btype" name="btype" required>
									  <option value="">Select Business Type</option>
									 <option value="Solo Proprietorship">Solo Proprietorship</option>					  
									 <option value="Partnership">Partnership</option>					  					  
									 <option value="Pvt.Ltd">Pvt.Ltd</option>					  					  
									 <option value="LLP">LLP</option>					  					  
									 <option value="Foundation">Foundation(Self Help Group)</option>					  					  
									</select>
							  </div>						
						<div class="form-group">
						  <label class="control-label">GST Number </label>
							<input class="form-control" type="text" id="gst" name= "gst" placeholder="GST Number" required>
						</div>						
						<div class="form-group">
						  <label class="control-label">Bank Name </label>
							<input class="form-control" type="text" id="bank_name" name= "bank_name" placeholder="Bank Name" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Account Name </label>
							<input class="form-control" type="text" id="ac_name" name= "ac_name" placeholder="Bank Account Name" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Account Number </label>
							<input class="form-control" type="number" id="ac_no" name= "ac_no" placeholder="Bank Account Number" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Confirm Account Number </label>
							<input class="form-control" type="number" id="conf_ac_no" name= "conf_ac_no" placeholder="Confirm Bank Account Number" required>
						</div>
						<h5 id="msg"></h5>
						<div class="form-group">
						  <label class="control-label">IFSC Code </label>
							<input class="form-control" type="text" id="ifsc" name= "ifsc" placeholder="IFSC Code" required>
						</div>						
						</div>			
					</div>	
				  <div class="form-group" align="center">
				  <button type="submit" class="btn btn-info" style="background-color:#004c91" name="register" id="register">Create an Account</button>
				  </div>
				</form>
			</div> <!-- Close panel Body -->
		</div> <!-- Close Panel -->
	</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>