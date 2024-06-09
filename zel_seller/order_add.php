<?php
$login_session="" ;
$url="";
$status="";
include('lock.php');
$error="";
$show="display:none;";
$alert="";
$today=date('Y-m-d');
if (isset($_GET['error'])) {
	$error=$_GET['error'];
	$show=$_GET['show'];
	$alert=$_GET['alert'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Order</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
   <script src="./order_items.js"></script>
</head>
<body id="addproject">
<?php
include('./header.php');
?>
<div class="container-fluid">
<div class="row">
<div class = "col-md-12">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center"> Add New Order </div>
      <div class="panel-body">
<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
<div class="form-group">
<form enctype="multipart/form-data" method="POST" action="php_action/order_add.php" onsubmit="return validation()">
	<div class="row">
		<div class="col-md-6">	
		<div class="form-group">
        <label class="control-label">Select Customer </label>
            <select class="form-control" id="euid" name="euid" required>
              <option value="">Select Customer</option>
			  <?php
				$query = "SELECT euid, euname from end_user where status=1 ORDER BY euname ASC";
				$result = $conn->query($query);  
					while($row = $result->fetch_assoc()) {                                                 
					echo "<option value='".$row['euid']."'>".$row['euname']."</option>";
					}
				?>     
            </select>
    </div>				  
		</div> 
		<div class="col-md-6">	        	
		<div class="form-group">
		  <label class="control-label">Order Date </label>
			<input class="form-control" type="date" id="txtdate" name= "txtdate" value="<?php echo $today; ?>" placeholder="Order Date" required >
		</div>		
		</div>			
	</div>
<hr/>	
	<table class="table" id="productTable">
		<thead>
			<tr>			  			
				
				<th style="width:30%;">Item Name</th>
				<th style="width:15%;">Quantity</th>
				<th style="width:20%;">Price </th>
				<th style="width:20%;">GST (in %)</th>	
				<th style="width:15%;">Sub Amount</th>	
				<th style="width:5%;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$arrayNumber = 0;
		for($x = 1; $x < 2; $x++) { ?>
			<tr id="row<?php echo $x; ?>" name="tr" class="<?php echo $arrayNumber; ?>">								  							
				<td>
					<div class="form-group">
					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
						<option value="">~~SELECT~~</option>
						<?php
							$productSql = "SELECT * FROM products WHERE status = 1 ORDER BY pname ASC";
							$productData = $conn->query($productSql);
							while($row = $productData->fetch_array()) {									 		
								echo "<option value='".$row['pid']."' id='changeProduct".$row['pid']."'>".$row['pname']."</option>";
								} // /while 
						?>
					</select>
					</div>
				</td>
				<td>
					<div class="form-group">
					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
					</div>
				</td>				
				<td>
					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
				</td>							
				<td>
					<input type="text" name="gst[]" id="gst<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  								  					  				
				</td>							
				<td>
					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  		<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
				</td>
				<td> 
					<button class="form-control btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>					
				</td>
			</tr>
		<?php
		$arrayNumber++;
		} // /for
		?>
		</tbody>			  	
	</table>
	<div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  				  		  		 
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	  <div class="form-group" align="center">
				  <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add New Item </button>
					<button type="submit" class="btn btn-info" name="submitorder" id="submitorder">Place Order</button>
				  </div>						  
			  </div> <!--/col-md-6-->

</form>
</div> <!-- Form Group-->
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>