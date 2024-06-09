<?php 	
require_once '../conn.php';
$productId = $_POST['productId'];
$sql = "SELECT r.rate_id, r.price, r.cgst, r.sgst, r.igst FROM products p, rate r WHERE p.pid=r.pid AND r.rate_status=1 AND p.pid=$productId";
$result = $conn->query($sql);
if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows
$conn->close();
echo json_encode($row);