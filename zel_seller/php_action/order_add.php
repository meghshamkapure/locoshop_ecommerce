<?php
include('../conn.php');
include('../lock.php');
$error="";
$show="display:none;";
$alert="alert alert-danger";
if (isset($_POST['submitorder'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {		
		$euid = test_input($_POST["euid"]);
		$order_date = test_input($_POST["txtdate"]);
		$sql1="SELECT order_id FROM orders WHERE euid='$euid' AND order_date='$order_date' AND order_status=1 ";
		$result = $conn->query($sql1);
		if ($result->num_rows > 0){
			$error="Order Is Already Exist!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:../order_add.php?error=$error&show=$show&alert=$alert");
			exit();
		}		  
		else
		{
			$msg=order_add();
			$error=$msg;
			$show="display:show;";
			$alert="alert alert-success";
			header("Location:../order_add.php?error=$error&show=$show&alert=$alert");
		}
	}
}
function order_add(){
	include('../conn.php');
	include('../lock.php');
	$euid = test_input($_POST["euid"]);
	$order_date = test_input($_POST["txtdate"]);
	$status=1;
	$currdate=date("Y-m-d");	
	$sql = "INSERT INTO orders (euid, order_date, order_status) VALUES ($euid, '$order_date', $status)";
	if ($conn->query($sql) === TRUE) {
		$order_id = $conn->insert_id;
		$number = count($_POST["productName"]); 
		for($i=0; $i<$number; $i++)  
		{  
		   if(trim($_POST["productName"][$i] != ''))  
		   { 	   
			$productName=$_POST["productName"][$i];
			$quantity=$_POST["quantity"][$i];
			$rateValue=$_POST["rateValue"][$i];			
			$fmSql = "INSERT INTO order_item (order_id, pid, rate_id, qty, order_item_status) 
			VALUES ($order_id, $productName, $rateValue, '$quantity', 1)";
			$conn->query($fmSql);			
		   }  
		} 	
		$msg="Order Is Placed successfully!";	
	}
	else{
		$msg="Something Is Wrong! Please Try Again!";
	}
	return $msg;
}
//*********************************************************************************************************************

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>