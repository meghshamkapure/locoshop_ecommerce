<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
 include('conn.php');
$error="";
$show="display:none;";
$alert="";
if (isset($_POST['submit'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $pid = test_input($_POST["pid"]);
	 $price = test_input($_POST["price"]);
	 $cgst = test_input($_POST["cgst"]);
	 $sgst = test_input($_POST["sgst"]);
	 $igst = test_input($_POST["igst"]);
	 $today=date('Y-m-d');
     $sql = "SELECT * FROM rate WHERE price='$price' AND cgst='$cgst' AND sgst='$sgst' AND igst='$igst' AND pid=$pid AND rate_status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
	 $today=date("Y-m-d");
      if ($count >0){
        $error="Given Product Price and GST Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "Update rate SET rate_status=0 WHERE pid=$pid";
		if($conn->query($sql)===TRUE){
			$sql = "INSERT INTO rate (pid, price, cgst, sgst, igst, rate_status, rate_date, uid) 
			VALUES ($pid, '$price', '$cgst', '$sgst', '$igst', 1, '$today', $user_id)";
			if($conn->query($sql)===TRUE){
				$error="Product Price and GST Is Updated Successfully!";
				$show="display:show;";
				$alert="alert alert-success";
			}
			else{
				$error="Proccess Is Invalid!";
				$show="display:show;";
				$alert="alert alert-success";
			}
		}
		else{
			$error="Proccess Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
			}		
	  }
	  header( "Refresh:3; url=./update_rate.php?alert=$alert&show=$show&error=$error", true, 303);
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
 <title> Update Product Price </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
</head>
<body>
<?php
include('./header.php');
?>
<div class="container-fluid" style="margin-top:20px">
<div class="row">
    <div class="col-md-12">
      <div align="center" class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  <div class = "col-md-3">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Update Product Price & GST </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="">
   <div class="form-group">
        <label class="control-label">Select Product </label>
            <select class="form-control" id="pid" name="pid" required>
              <option value="">Select Product</option>
			  <?php
				$query = "SELECT pid, pname from products where status=1 ORDER BY pname ASC";
				$result = $conn->query($query);  
					while($row = $result->fetch_assoc()) {                                                 
					echo "<option value='".$row['pid']."'>".$row['pname']."</option>";
					}
				?>     
            </select>
    </div>
	  <div class="form-group">
	   <label class="control-label">Enter Price</label>
		<input class="form-control" type="number" id="price" name= "price" placeholder="Enter Price" required>
	  </div> 
	  <div class="form-group">
	   <label class="control-label">Enter CGST (%)</label>
		<input class="form-control" type="number" id="cgst" name= "cgst" placeholder="Enter CGST (%)" required>
	  </div>
	  <div class="form-group">
	   <label class="control-label">Enter SGST (%)</label>
		<input class="form-control" type="number" id="sgst" name= "sgst" placeholder="Enter SGST (%)" required>
	  </div>
	  <div class="form-group">
	   <label class="control-label">Enter IGST (%)</label>
		<input class="form-control" type="number" id="igst" name= "igst" placeholder="Enter IGST (%)" required>
	  </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit">Update Price</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-9">
<div class="panel panel-info">
      <div class="panel-heading" align="center">Products Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT * FROM products p, sub_category sc, rate r WHERE sc.sc_id=p.sc_id AND p.pid=r.pid AND r.rate_status=1 AND p.status=1 ORDER BY p.pid DESC;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Image</th>
			  <th>Sub Category</th>
              <th>Product Name</th>              
              <th>Product Code</th>
              <th>HSN Code</th>
              <th>Price</th>
              <th>GST(CSG %)</th>
              <th>Added Date</th>
           </tr>
          </thead>
          <tbody>";
          while($row = $result->fetch_assoc()) {            
           echo"<tr>";
		   echo "<td><img src='".$row['imgpath']."' height='50' width='50'/></td>";              
              echo "<td>".$row['sc_name']."</td>";
              echo "<td>".$row['pname']."</td>";
              echo "<td>".$row['pcode']."</td>";
              echo "<td>".$row['hsncode']."</td>";
              echo "<td>".$row['price']."</td>";
              echo "<td>".$row['cgst']."-".$row['sgst']."-".$row['igst']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";             
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