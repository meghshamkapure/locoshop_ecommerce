<?php
include ("./zel_admin/conn.php");
$request = mysqli_real_escape_string($conn, $_POST["query"]);
$query = "SELECT * FROM sub_category WHERE sc_name LIKE '%".$request."%'";
$result = $conn->query($query);
$data = array();
if ($result->num_rows > 0) 
{
 while($row = $result->fetch_assoc()) 
 {
  $data[] = $row["sc_name"];
 }
}
else  
{  
   $data[] = "NoDataFound";
}  
echo json_encode($data);

?>
