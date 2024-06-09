<?php
include('../conn.php');
include('../lock.php');
$error="";
$show="display:none;";
$alert="alert alert-danger";
if (isset($_POST['editorder'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {		
		$order_id = test_input($_POST["order_id"]);
		$sql1="SELECT * FROM orders WHERE order_id=$order_id and order_status=1 ";
		$result = $conn->query($sql1);
		if ($result->num_rows === 0){
			$error="Order Is Not Exist!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:../order_edit.php?order_id=$order_id&error=$error&show=$show&alert=$alert");
			exit();
		}		
		else
		{
			$msg=updateorder();
			$error=$msg;
			$show="display:show;";
			$alert="alert alert-success";
			header("Location:../order_edit.php?order_id=$order_id&error=$error&show=$show&alert=$alert");
		}
	}
}
function updateorder(){
	include('../conn.php');
	$order_id = test_input($_POST["order_id"]);
	$order_date = test_input($_POST["txtdate"]);
	$euid = test_input($_POST["euid"]);	
	$status=1;		 	
	$sql = "UPDATE orders SET euid=$euid, order_date='$order_date' WHERE order_id=$order_id";
	if($conn->query($sql)===TRUE){
		for($x = 0; $x < count($_POST['productNameEdit']); $x++) {			
			$order_item_id=$_POST['order_item_idEdit'][$x];
			$fmSql = "UPDATE order_item SET pid='".$_POST['productNameEdit'][$x]."', qty='".$_POST['quantityEdit'][$x]."', rate_id='".$_POST['rateValueEdit'][$x]."' WHERE order_item_id=$order_item_id";
			echo $fmSql;
			$conn->query($fmSql);								
		} 
		if($_POST["productName"]){
			$number = count($_POST["productName"]);
			for($x = 0; $x < $number; $x++) {			
				// add into order_item
				$fmSql = "INSERT INTO order_item (order_id, pid, rate_id, qty, order_item_status)
				VALUES ($order_id,'".$_POST['productName'][$x]."', '".$_POST['rateValue'][$x]."','".$_POST['quantity'][$x]."', 1)";
				$conn->query($fmSql);
			}
		}
		$msg='<p>Order Details Are Updated Successfully !</p>';	
	}
	return $msg;
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>