<?php

  require_once(__DIR__ . "./../serveur/ressources/Connexion.php");
  $conn = Connexion::getConnexion();

  $query = "SELECT * FROM produits ORDER BY qte_vendue DESC LIMIT 0,8";
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

  Connexion::unsetConnexion();
  echo $json;

?>