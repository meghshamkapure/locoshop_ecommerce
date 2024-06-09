<?php
$login_session="" ;
$url="";
$status="";
$error="";
$show="display:none;";
$alert="";
$currdate=date("Y/m/d");
include('lock.php');
include('../sms.php');
if (isset($_POST['submitbydate'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$currdate = test_input($_POST["txtdate"]);		
	}
}
if (isset($_POST['sendsms'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
      $sql = "SELECT * FROM end_user WHERE status=1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {        
          while($row = $result->fetch_assoc()) {			
			$bdate=$row['bdate'];
			$diff = abs(strtotime($currdate) - strtotime($row['bdate']));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$d=date_parse_from_format("Y-m-d",$bdate);
			$m=$d["month"];
			$m1=date("m");
			$d=$d["day"];
			$d1=date("d");			
			if($m==$m1 && $d==$d1){					
				$message="Hello ".$row['euname']." Wish You Many Many Happy Birthday From Auracakes.com - Have a Nice Day!!.";
				$message1= sms_unicode($message);
				$mobile_number=$row['eumob'];;
				sentsms($message1, $mobile_number);	
				$error="Birthday Wish SMS Sent Successfully";
				$show="display:show;";
				$alert="alert alert-success";
			}
          }
        }  
        else {
			$error="There is no any Member!";
			$show="display:show;";
			$alert="alert alert-success";	 
        }
	}
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
 <title>Today's Birthday  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  
       <script type="text/javascript">
  function printbill(){
    //alert("hiiiiiiiiiiii");
    var prtContent = document.getElementById("invoice");
    var WinPrint = window.open('Todays Cases', 'Todays Cases', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
   }
  </script>
  
  
  
</head>
<body>
<?php
include('./header.php');
?>




<div class="container" style="margin-top:20px">
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-info">
		  <div class="panel-heading" align="center">Search Birthday Members</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control" type="date" id="txtdate" name= "txtdate" placeholder="Date">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbydate" name="submitbydate">Search By Date</button>
					</div>
				</div>
				<div class="col-md-4" >					
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info auto" id ="sendsms" name="sendsms">Send Wish SMS</button>
					</div>
				</div>
			</form>
	</div> <!-- Close panel Body -->
	</div> <!-- Close Panel -->
	</div> <!-- Close Col -->
</div>
<div class="row">
    <div class="col-md-12">
	<div align="center" class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
<div class="col-md-12">

<div class="panel panel-info">
      <div class="panel-heading" align="center">Todays Birthday Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      error_reporting(E_ALL);
	  $count=0;
      $sql = "SELECT * FROM end_user WHERE status=1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              
              <tr>
              <th>#</th>
              <th>Name</th>
              <th>Mobile Number</th>
              <th>Birth Date</th>
              <th>Address</th>
              <th>Age</th>
              </tr>
              
           </tr>
          </thead>


          <tbody>";
          while($row = $result->fetch_assoc()) {			
			$bdate=$row['bdate'];
			$diff = abs(strtotime($currdate) - strtotime($row['bdate']));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$count++;
			$d=date_parse_from_format("Y-m-d",$bdate);
			$m=$d["month"];
			$m1=date("m");
			$d=$d["day"];
			$d1=date("d");			
			if($m==$m1 && $d==$d1){
					echo"<tr>";
						echo "<td>".$count."</td>";
						echo "<td>".$row['euname']."</td>";
						echo "<td>".$row['eumob']."</td>";
						echo "<td>".date( 'd/m/Y', strtotime($row['bdate']))."</td>";
						echo "<td>".$row['address']."</td>";
						echo "<td>".$years."</td>";
						
					echo "</tr>";	
			}
          }
           
          echo"</tbody>
      </table>";
        
        }  
        else {
         echo "0 results";
        }
        $conn->close();
	
        ?> 
      </div>
      </div><!-- Close panel Body -->

</div> <!-- Close Panel -->
</div>


</div> <!-- Close Row -->


</div> <!-- Close Container -->
<?php include('footer.php');?>
</body>
</html>