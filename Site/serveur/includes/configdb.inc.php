<?php
$servername = "sql9.freesqldatabase.com";
$username = "sql9558434";
$password = "bQV64kWUMF";
$dbname = "sql9558434";
 
// Create connection
$conn = mysqli_connect($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn === false) {
    die("Connection failed: "
        . mysqli_connect_error());
}

?>
<?php
    $servername = "sql9.freesqldatabase.com";
    $username = "sql9558434";
    $password = "bQV64kWUMF";
    $dbname = "sql9558434";
    
    // Create connection
    $conn = mysqli_connect($servername,
        $username, $password, $dbname);
    
    // Check connection
    if ($conn === false) {
        die("Connection failed: "
            . mysqli_connect_error());
    }

?>