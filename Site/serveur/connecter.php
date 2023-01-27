<?php
function write_to_console($data)
{
    $console = $data;
    if (is_array($console))
        $console = implode(',', $console);

    echo "<script>console.log('Console: " . $console . "' );</script>";
}

// echo '<script>alert("OUAIP!!!")</script>';
// die();

session_start();
require_once("includes/configdb.inc.php");


$email = trim($_POST['emailConn']);
$mdp = trim($_POST['mdpConn']);
write_to_console($email);
write_to_console($mdp);
$requete = "SELECT * FROM connexion WHERE email = ? AND mdp = ?";
$stmt = $conn->prepare($requete);
$stmt->bind_param("ss", $email, $mdp);
$stmt->execute();
$result = $stmt->get_result();

if (!$ligne = $result->fetch_object()) {
    mysqli_close($conn);
    // echo '<script type="text/JavaScript">document.getElementById("msgErrConn").innerText = "Membre inexistant...";</script>';
    write_to_console("Pas trouvé");
    exit;
}
write_to_console("trouvé");
if ($ligne->statut_m == "A") {
    $_SESSION['email'] = $email;
    $_SESSION['role_m'] = $ligne->role_m;
    $a = $_SESSION['role_m'];
    write_to_console($a);

    if ($ligne->role_m == "M") {
        $_SESSION['statut_m'] = 'M';
        header('Location: pages/membre.php');
        exit;
    } elseif ($ligne->role_m == "A") {
        $_SESSION['statut_m'] = 'A';
        header('Location: pages/admin.php');
        exit;
    }
} else {
    header('Location: ../../index.php?msg=Problème+avec+votre+compte,+contactez+l\'administrateur');
    exit;
}

mysqli_close($conn);



?>