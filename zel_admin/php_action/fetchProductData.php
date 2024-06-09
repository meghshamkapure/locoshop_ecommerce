<?php 	
require_once '../conn.php';
$sql = "SELECT * FROM products WHERE status = 1";
$result = $conn->query($sql);
$data = $result->fetch_all();
$conn->close();
echo json_encode($data);
?>