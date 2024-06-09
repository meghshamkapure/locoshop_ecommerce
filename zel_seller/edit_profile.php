<?php
$error="";
$show="display:none;";
$alert="";
include('./lock.php');
include('./conn.php');
//fetch Company Details
$sql = "SELECT * FROM seller WHERE sid = $user_id";
$query = $conn->query($sql);
while ($result = $query->fetch_assoc()) {
	$sid = $result['sid'];
	$sname = $result['sname'];
	$smob = $result['smob'];
	$spass = $result['spass'];
	$altmob = $result['altmob'];
	$email = $result['email'];
	$gst = $result['gst'];
	$bank_name = $result['bank_name'];
	$ac_name = $result['ac_name'];
	$ac_no = $result['ac_no'];
	$ifsc = $result['ifsc'];
	$address = $result['address'];
	$pincode = $result['pincode'];
	$regdate = $result['regdate'];
}
if (isset($_POST['register'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $sname = test_input($_POST["sname"]);
	 $smob = test_input($_POST["smob"]);
	 $spass = test_input($_POST["spass"]);
	 $altmob = test_input($_POST["altmob"]);
	 $address = test_input($_POST["address"]);
	 $gst = test_input($_POST["gst"]);
	 $email = test_input($_POST["email"]);
	 $bank_name = test_input($_POST["bank_name"]);
	 $ac_name = test_input($_POST["ac_name"]);
	 $ac_no = test_input($_POST["ac_no"]);
	 $conf_ac_no = test_input($_POST["conf_ac_no"]);
	 $ifsc = test_input($_POST["ifsc"]);
	 $pincode = test_input($_POST["pincode"]);
	 $regdate= date("Y-m-d");
	 $status=1;
	 if($ac_no==$conf_ac_no){
     $sql = "SELECT smob FROM seller WHERE smob='$smob' AND status=1 AND sid!=$user_id";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
      if ($count >0){
        $error="Seller mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "UPDATE seller SET sname='$sname', smob='$smob', spass='$spass', altmob='$altmob', gst='$gst', email='$email', pincode='$pincode', address='$address', bank_name='$bank_name', ac_name='$ac_name', ac_no='$ac_no', ifsc='$ifsc' WHERE sid=$user_id";
		if($conn->query($sql)===TRUE){			
			$error="Seller Account Is Updated Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
			
		}
		else{
			$error="Proccess Is Invalid!";
			$show="display:show;";
			$alert="alert alert-danger";
		}
	  }
	  header( "Refresh:1; url=./edit_profile.php?error=$error&show=$show&alert=$alert", true, 303);
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
 <title>Update My Profile</title>
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
<?php
include('header.php');
?>
<div class="container" style="margin-top:20px">
	<div class="row">
		<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
		<div class="panel panel-info">
		    <div class="panel-heading" style="background-color:#004c91;color:white" align="center"> Update Profile </div>
		    <div class="panel-body">
				<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
				<form enctype="multipart/form-data" method="POST" action="" onsubmit="return validation()">
					<div class="row">
						<div class="col-md-6">	
						<div class="form-group">
						  <label class="control-label">Name</label>
							<input class="form-control" type="text" id="sname" name="sname" value="<?php echo $sname;?>" placeholder="Seller Name" required>
						</div>		
						  <div class="form-group">
						  <label class="control-label">Mobile Number</label>
							<input class="form-control" type="number" id="smob" name= "smob" value="<?php echo $smob;?>" placeholder="Mobile Number"  readonly required>
						  </div>
						 <div class="form-group">
						  <label class="control-label">Password</label>
							<input class="form-control" type="password" id="spass" name= "spass" value="<?php echo $spass;?>" placeholder="Password" readonly required>
						  </div>
						  <div class="form-group">
							 <label class="control-label">Alt Mobile</label>
							<input class="form-control" type="number" id="altmob" name= "altmob" value="<?php echo $altmob;?>" placeholder="Alt Mobile Number" required>
						  </div>
						  <div class="form-group">
						  <label class="control-label">Email Id </label>
							<input class="form-control" type="email" id="email" name= "email" value="<?php echo $email;?>" placeholder="Email Id" required >
						</div>
						  <div class="form-group">
							<label class="control-label">Address</label>
							<textarea class="form-control" rows="2" id="address" name= "address"required><?php echo $address;?></textarea>
						  </div>
						  <div class="form-group">
						  <label class="control-label">PIN Code </label>
							<input class="form-control" type="number" id="pincode" name= "pincode" value="<?php echo $pincode;?>" placeholder="PIN Code" required>
						</div>
						</div> 
						<div class="col-md-6">												
						<div class="form-group">
						  <label class="control-label">GST Number </label>
							<input class="form-control" type="text" id="gst" name= "gst" value="<?php echo $gst;?>" placeholder="GST Number" required>
						</div>						
						<div class="form-group">
						  <label class="control-label">Bank Name </label>
							<input class="form-control" type="text" id="bank_name" name= "bank_name" value="<?php echo $bank_name;?>" placeholder="Bank Name" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Account Name </label>
							<input class="form-control" type="text" id="ac_name" name= "ac_name" value="<?php echo $ac_name;?>" placeholder="Bank Account Name" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Account Number </label>
							<input class="form-control" type="number" id="ac_no" name= "ac_no" value="<?php echo $ac_no;?>" placeholder="Bank Account Number" required>
						</div>
						<div class="form-group">
						  <label class="control-label">Confirm Account Number </label>
							<input class="form-control" type="number" id="conf_ac_no" name= "conf_ac_no" placeholder="Confirm Bank Account Number" required>
						</div>
						<h5 id="msg"></h5>
						<div class="form-group">
						  <label class="control-label">IFSC Code </label>
							<input class="form-control" type="text" id="ifsc" name= "ifsc" value="<?php echo $ifsc;?>" placeholder="IFSC Code" required>
						</div>						
						</div>			
					</div>	
				  <div class="form-group" align="center">
				  <button type="submit" class="btn btn-info" style="background-color:#004c91" name="register" id="register">Update Account</button>
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