<?php
$login_session="" ;
 $url="";
 $status="";
 $euname="";
 $eumob="";
 include('lock.php');
 include ("conn.php");
 if (isset($_POST['submitbymob'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$eumob = test_input($_POST["txtmob"]);
		$sql = "SELECT * FROM seller WHERE smob='$eumob'";
	}
}
else if (isset($_POST['submitbyname'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$euname = test_input($_POST["txtname"]);
		$sql = "SELECT * FROM seller WHERE sname='$euname'";
	}
}
else if (isset($_POST['submitbystatus'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$status = test_input($_POST["status"]);
		if($status==0){
			$sql = "SELECT * FROM seller ORDER BY sid DESC";
		}
		else{
		$sql = "SELECT * FROM seller WHERE status=$status ORDER BY sid DESC";
		}
	}
}
else{
	$sql = "SELECT * FROM seller WHERE status=2 ORDER BY sid DESC";
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
 <title> Manage Seller  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
<script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./resources/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="./resources/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./resources/jquery-ui.min.js"></script>
<script src="./sss.js"></script>
<script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto1").autocomplete({
    source: "searchmob.php",
    minLength: 1
  });       
});
</script>
<script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto").autocomplete({
    source: "searchname.php",
    minLength: 1
  });       
});
</script>
</head>
<body>
<?php
include('./header.php');
?>




<div class="container-fluid" style="margin-top:20px">
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-info" style="border-color: #004c91;">
		  <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Search Seller User</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto1" type="number" id="txtmob" name= "txtmob" placeholder="Mobile Number" value="<?php echo $eumob?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" style="background-color: #004c91;border-color: #004c91;" id ="submitbymob" name="submitbymob">Search By Mobile</button>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto" type="text" id="txtname" name= "txtname" placeholder="User Name" value="<?php echo $euname?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info auto" style="background-color: #004c91;border-color: #004c91;" id ="submitbyname" name="submitbyname">Search By Name</button>
					</div>
				</div>
				<div class="col-md-4" >
					 <div class="form-group">
						<label class="control-label">Select Status </label>
							<select class="form-control" id="status" name="status">
							  <option value="">Select Status</option>    
							  <option value="1">Approved Seller</option>    
							  <option value="3">Rejected Seller</option>    
							  <option value="2">Pending Seller</option>    
							  <option value="0">All Seller</option>    
							</select>
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" style="background-color: #004c91;border-color: #004c91;" id ="submitbystatus" name="submitbystatus">Search By Status</button>
					</div>
				</div>
			</form>
	</div> <!-- Close panel Body -->
	</div> <!-- Close Panel -->
	</div> <!-- Close Col -->
</div>
<div class="row">
<div class="col-md-12">

<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Seller User Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      error_reporting(E_ALL);      
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
			  <th>Seller Name </th>
              <th>Mobile </th>
              <th>Password </th>
              <th>Alt Mobile </th>              
			  <th>Email</th>
			  <th>Address</th>			  
			  <th>Date </th>			 
			  <th>Status </th>			 
			  <th>Action</th>
           </tr>
          </thead>


          <tbody>";
          while($row = $result->fetch_assoc()) {
            
           echo"<tr>";             
              echo "<td>".$row['sname']."</td>";
              echo "<td>".$row['smob']."</td>";
              echo "<td>".$row['spass']."</td>";
              echo "<td>".$row['altmob']."</td>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['address']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
			   if($row['status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['status']==2){echo "<td class='warning'>Pending</td>";}			
			   else if($row['status']==3){echo "<td class='danger'>Rejected</td>";}			
			   else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>
			<li><a type='button' href='./edit_seller_profile.php?sid=".$row['sid']."'>Edit</a></li>
			<li><a type='button' href='./seller_view.php?sid=".$row['sid']."'>View/Print</a></li>
			<li><a type='button' onclick='approve_seller(".$row['sid'].")'>Approve</a></li>
			<li><a type='button' onclick='reject_seller(".$row['sid'].")'>Reject</a></li>
			</ul>
			</div></td>";			
           echo "</tr>";
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



<?php
include('footer.php');
?>
</body>
</html>