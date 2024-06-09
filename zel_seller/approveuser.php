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
		$sql = "SELECT * FROM franchise WHERE mob='$eumob'";
	}
}
else if (isset($_POST['submitbyname'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$euname = test_input($_POST["txtname"]);
		$sql = "SELECT * FROM franchise WHERE name='$euname'";
	}
}
else if (isset($_POST['submitbystatus'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$status = test_input($_POST["status"]);
		if($status==0){
			$sql = "SELECT * FROM franchise ORDER BY fr_id DESC";
		}
		else{
		$sql = "SELECT * FROM franchise WHERE fr_status=$status ORDER BY fr_id DESC";
		}
	}
}
else{
	$sql = "SELECT * FROM franchise WHERE fr_status=2 ORDER BY fr_id DESC";
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
 <title> Approve Franchise User  </title>
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
	<div class="panel panel-info">
		  <div class="panel-heading" align="center">Search Franchise User</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto1" type="number" id="txtmob" name= "txtmob" placeholder="Mobile Number" value="<?php echo $eumob?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbymob" name="submitbymob">Search By Mobile</button>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto" type="text" id="txtname" name= "txtname" placeholder="User Name" value="<?php echo $euname?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info auto" id ="submitbyname" name="submitbyname">Search By Name</button>
					</div>
				</div>
				<div class="col-md-4" >
					 <div class="form-group">
						<label class="control-label">Select Status </label>
							<select class="form-control" id="status" name="status">
							  <option value="">Select Status</option>    
							  <option value="1">Approved User</option>    
							  <option value="3">Rejcted User</option>    
							  <option value="2">Pending User</option>    
							  <option value="0">All User</option>    
							</select>
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbystatus" name="submitbystatus">Search By Status</button>
					</div>
				</div>
			</form>
	</div> <!-- Close panel Body -->
	</div> <!-- Close Panel -->
	</div> <!-- Close Col -->
</div>
<div class="row">
<div class="col-md-12">

<div class="panel panel-info">
      <div class="panel-heading" align="center">Franchise User Details</div>
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
			  <th>Map Location </th>
			  <th>Franchise Name </th>
              <th>Mobile </th>
              <th>Password </th>
              <th>Alt Mobile </th>
              <th>Shop Location</th>	
			  <th>Rent/Owner</th>
			  <th>Shop Area </th>
			  <th>Partner/Owner</th>
			  <th>address</th>
			  <th>Date </th>			 
			  <th>Status </th>			 
			  <th>Action</th>
           </tr>
          </thead>


          <tbody>";
          while($row = $result->fetch_assoc()) {
            
           echo"<tr>";             
              echo "<td><a href='".$row['map_location']."' target='self'><img src='./images/map.png' height='50' width='50'/></a></td>";
              echo "<td>".$row['name']."</td>";
              echo "<td>".$row['mob']."</td>";
              echo "<td>".$row['pass']."</td>";
              echo "<td>".$row['altmob']."</td>";
              echo "<td>".$row['shop_location']."</td>";
              echo "<td>".$row['rent_owner']."</td>";
              echo "<td>".$row['shop_area']."</td>";
              echo "<td>".$row['partner_owner']."</td>";
              echo "<td>".$row['address']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
			   if($row['fr_status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['fr_status']==2){echo "<td class='warning'>Pending</td>";}			
			   else if($row['fr_status']==3){echo "<td class='danger'>Rejected</td>";}			
			   else {echo "<td class='primary'>None</td>";}			
              echo  "<td>
              <button type='button' class='btn btn-success btn-sm' onclick='approve_user(".$row['fr_id'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-ok'></span></button> <br/><br/> 
              <button type='button' class='btn btn-danger btn-sm' onclick='reject_user(".$row['fr_id'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-remove'></span></button>"; 
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