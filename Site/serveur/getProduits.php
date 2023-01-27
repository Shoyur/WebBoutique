<?php

  require_once("includes/configdb.inc.php");

  $query = "SELECT * FROM produits ORDER BY qte_vendue DESC LIMIT 0,5";
  $result = mysqli_query($conn, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
    
  }
  if(empty($data)){
    echo json_encode(array("error" => "No data found"));
    exit();
}
$json = json_encode($data, JSON_INVALID_UTF8_IGNORE);
if(json_last_error()){
    echo json_encode(array("error" => json_last_error_msg()));
    exit();
}
echo $json;




?>