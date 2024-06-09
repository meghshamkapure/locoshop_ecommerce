<?php
$login_session="" ;
 $url="";
 $status="";
 $order_id="";
 $mob="";
 include('lock.php');
 include ("conn.php");
//fetch Company Details
$compsql = "SELECT * FROM company_profile WHERE comp_id = 1";
$compQuery = $conn->query($compsql);
while ($compResult = $compQuery->fetch_assoc()) {
	$comp_id = $compResult['comp_id'];
	$comp_name = $compResult['comp_name'];
	$comp_tag_line = $compResult['comp_tag_line'];
	$pro_pra_name = $compResult['pro_pra_name'];
	$comp_add = $compResult['comp_add'];
	$comp_mob= $compResult['comp_mob'];
	$comp_mob1= $compResult['comp_mob1'];
	$comp_web= $compResult['comp_web'];
}
if (isset($_POST['submitstatus'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$order_status = test_input($_POST["order_status"]);
		$sql = "SELECT o.order_id, o.order_status, o.order_date, e.euid, e.euname, e.eumob, e.address FROM orders o, order_item oi, products p, seller s, end_user e WHERE e.euid=o.euid AND s.sid=p.sid AND p.pid=oi.pid AND o.order_id=oi.order_id AND s.sid=$user_id AND order_status=$order_status ORDER BY o.order_id DESC";
	}
}
else if (isset($_POST['submitbydate'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$datefrom = test_input($_POST["txtdatefrom"]);
		$dateto = test_input($_POST["txtdateto"]);		
		$sql = "SELECT o.order_id, o.order_status, o.order_date, e.euid, e.euname, e.eumob, e.address FROM orders o, order_item oi, products p, seller s, end_user e WHERE e.euid=o.euid AND s.sid=p.sid AND p.pid=oi.pid AND o.order_id=oi.order_id AND s.sid=$user_id AND order_status=1 AND order_date BETWEEN '$datefrom' AND '$dateto' ORDER BY o.order_id DESC";
	}
}
else{
	$sql = "SELECT o.order_id, o.order_status, o.order_date, e.euid, e.euname, e.eumob, e.address FROM orders o, order_item oi, products p, seller s, end_user e WHERE e.euid=o.euid AND s.sid=p.sid AND p.pid=oi.pid AND o.order_id=oi.order_id AND s.sid=$user_id AND order_status=1 ORDER BY o.order_id DESC";
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
<title> Order List </title>
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
<script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./resources/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="./resources/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./resources/jquery-ui.min.js"></script>
<script src="./projectmember.js"></script>
<script src="./sss.js"></script>
<script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto").autocomplete({
    source: "search.php",
    minLength: 1
  });       
});
</script>
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
<div class="container-fluid" style="margin-top:20px">
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-info" style="border-color: #004c91;">
		  <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Search Orders  </div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">				
				<div class="col-md-6" >
					<div class="form-group">
					<label class="control-label">Select Order Status </label>
						<select class="form-control" id="order_status" name="order_status">
						  <option value="">Select Order Status</option>						      
						  <option value="1">Received</option>						      
						  <option value="2">Delivered</option>						      
						  <option value="0">Deleted</option>						      
						  <option value="3">On Working</option>						      
						</select>
				    </div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info btn-sm" id ="submitstatus" name="submitstatus">Search By Status</button>
					</div>
				</div>
				<div class="col-md-6" >
                    <div class="form-group">
					<label class="control-label">From </label>
					<input class="form-control input-sm" type="date" id="txtdatefrom" name= "txtdatefrom">
					</div>
					<div class="form-group">
					<label class="control-label">To </label>
					<input class="form-control input-sm" type="date" id="txtdateto" name= "txtdateto">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info btn-sm" id ="submitbydate" name="submitbydate">Search By Date</button>
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
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Orders List <a class="pull-right" style="color:white" align="right" href="#" onclick=printbill(); >Print List</a></div>
      <div class="panel-body">
        <div class='table-responsive' style="padding-bottom:100px;">
      <?php
      //include('conn.php');
      error_reporting(E_ALL);
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
          echo "<table class='table table-bordered table-striped'>
          <thead>
            <tr>
              <th>#</th>
               <th>Id</th>
              <th>Customer Name  </th>              
              <th>Mobile  </th>
              <th>Shipping Address </th>
              <th>Total Items </th>
              <th>Order Status </th>
			   <th>Date</th>
			   <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          $count=0;
          while($row = $result->fetch_assoc()) {
			  $sqlcnt = "SELECT * FROM order_item WHERE order_item_status=1 AND order_id=".$row['order_id'];
			  $query = $conn->query($sqlcnt);
			  $countorders = $query->num_rows;
              $count++;
              $order_status=$row['order_status'];
              if($order_status==1){
                $order_status="info";      
                $order_remark="Received";      
              }
              else if($order_status==2){
                $order_status="success";  
				$order_remark="Delivered";      				
              }
              else if($order_status==0){
                $order_status="danger";
				$order_remark="Cancel";      					
              }
              else if($order_status==3){
                $order_status="warning";  
				$order_remark="Ongoing";      				
              }
			echo"<tr class='".$order_status."'>";
			echo "<td>".$count."</td>";
			echo "<td>".$row['order_id']."</td>";
			echo "<td>".$row['euname']."</td>";
			echo "<td>".$row['eumob']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td>".$countorders."</td>";
			echo "<td>".$order_remark."</td>";
			echo "<td>".date('d-m-Y',strtotime($row['order_date']))."</td>";
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>
			<li><a type='button' href='./order_edit.php?order_id=".$row['order_id']."'>Edit</a></li>
			<li><a type='button' href='./order_view.php?order_id=".$row['order_id']."'>View/Print</a></li>
			<li><a type='button' id='deletebtn' onclick='delivered_order(".$row['order_id'].")'>Delivered</a></li>
			<li><a type='button' id='deletebtn' onclick='delete_order(".$row['order_id'].")'>Delete</a></li>
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
        <div id="invoice" style="border:1px solid #ccc; padding:20px; height:100%; width:580pt; display:none;">
		<div style="text-align:left; border:0px solid #ccc; float:left; width:300pt;">
			<b>&nbsp;<?php echo $comp_name; ?></b><br/>
			&nbsp;<?php echo "Address: ".$comp_add; ?><br />
			&nbsp;<?php echo "Mobile: ".$comp_mob." / ".$comp_mob1;?><br />
		</div>
        
            <br />
        
     
        <div style="text-align:left; border:1px solid #ccc; float:right; width:100pt;">
          
           &nbsp;Date: &nbsp;<?php echo date( 'd/m/Y') ?>
        </div>
           
         

         <div Style=" clear:both; float:none;"></div>
         <h3 align="center">All Orders Reports</h3><hr/>
           
      <?php
      include('conn.php');
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table style= 'font-size:13px; width:100%;' border-collapse: collapse; cellspacing='0'>
          <thead>
            <tr>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Sr. No </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Order Id </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Customer Name </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Mobile No. </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Address </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Total Items </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Date </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Status </th>
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
			  $sqlcnt = "SELECT * FROM order_item WHERE order_item_status=1 AND order_id=".$row['order_id'];
			  $query = $conn->query($sqlcnt);
			  $countorders = $query->num_rows;
			  $order_status=$row['order_status'];
              if($order_status==1){
                $order_status="info";      
                $order_remark="Received";      
              }
              else if($order_status==2){
                $order_status="success";  
				$order_remark="Delivered";      				
              }
              else if($order_status==0){
                $order_status="danger";
				$order_remark="Cancel";      					
              }
              else if($order_status==3){
                $order_status="warning";  
				$order_remark="Ongoing";      				
              }
            $count++;
           echo"<tr>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$count."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['order_id']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['euname']."</td>"; 
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['eumob']."</td>"; 
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['address']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$countorders."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".date('d-m-Y',strtotime($row['regdate']))."</td>"; 
			  echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$order_remark."</td>"; 
           echo "</tr>";
         }
          echo"</tbody>
      </table>";
        
        }  
      
        else {
          echo"<tr>";
         echo "<td colspan='6' style='border-bottom: 1px solid #ddd; padding: 3px;'>No Record Found</td>";
         echo "</tr>";
        }

        $conn->close();
      
        ?> 
         <div style=" text-align:center; border:1px solid #ccc; float:left; margin-top:50px; width:130pt;">
          
            Thank You!

        </div>

        <div style=" text-align:center; border:1px solid #ccc; float:right; margin-bottom:10px;  margin-top:40px; width:250pt;">
           <br/>
            <br />
            <b> &nbsp;For <?php echo $pro_pra_name; ?></b>
        </div>

      </div> <!-- Close Invoice -->
</body>
</html>