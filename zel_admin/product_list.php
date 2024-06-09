<?php
$login_session="" ;
$url="";
$status="";
include('lock.php');
include('conn.php');
$error="";
$show="display:none;";
$alert="";
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
 <title>Product List</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
  <script>
  function addnewline(){
	  text=document.getElementById('pdesc').value;
	  text=text.replace(/ /g, "[sp][sp]");
	  text=text.replace(/\n/g, "[nl]");
	  document.getElementById('pdesc').value=text;
	  return false;
  }
  </script>
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
<div class="col-md-12">
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Products Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT s.sname, p.pid, p.pname, p.manufacturer, p.pur_price, p.pcode, p.hsncode, p.pdesc, p.cod, p.delivery_charges, p.imgpath, p.regdate, sc.sc_name, r.price, r.cgst, r.sgst, r.igst FROM products p, seller s, sub_category sc, rate r WHERE s.sid=p.sid AND sc.sc_id=p.sc_id AND p.pid=r.pid AND r.rate_status=1 AND p.status=1 ORDER BY p.pid DESC;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Image</th>
              <th>Seller</th>
			  <th>Sub Category</th>
              <th>Product Name</th>                            
              <th>Manufacturer</th>                            
              <th>Pur Price</th>              
              <th>Sale Price</th>              
              <th>COD Status</th>              
              <th>Delivery Charges</th>              
              <th>Date</th>
              <th>Description</th>
              <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          while($row = $result->fetch_assoc()) {            
           echo"<tr>";
		   echo "<td><img src='../zel_seller/".$row['imgpath']."' height='50' width='50'/></td>";                        
              echo "<td>".$row['sname']."</td>";
			  echo "<td>".$row['sc_name']."</td>";              
              echo "<td>".$row['pname']."</td>";              
              echo "<td>".$row['manufacturer']."</td>";              
              echo "<td>".$row['pur_price']."</td>";
              echo "<td>".$row['price']."</td>";
              echo "<td>".$row['cod']."</td>";
              echo "<td>".$row['delivery_charges']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
			  $pdesc=$row['pdesc'];
			  $pdesc=preg_replace("#\[sp\]#", "&nbsp;", $pdesc);
			  $pdesc=preg_replace("#\[nl\]#", "<br>\n", $pdesc);
			  echo "<td>".$pdesc."</td>";
              echo  "<td> <button type='submit' class='btn btn-default btn-sm' onclick='delete_product(".$row['pid'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-trash'></span> Delete</button></td>";
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