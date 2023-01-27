<?php

  require_once("includes/configdb.inc.php");

  $query = "SELECT * FROM produits ORDER BY qte_vendue DESC LIMIT 0,5";
  $result = mysqli_query($conn, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
  }
  echo json_encode($data);

?>