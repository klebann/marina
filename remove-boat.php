<?php
require_once "config.php";
require_once("common.php");
check_login();

if (!isset($_GET["id"])) {
    header("location: boats.php");
    exit;
}

naglowek("Usuwanie łodzi", 5);
?>
<div class="container mt-5">    

<?php

$boatid = $_GET['id'];
$userid = $_SESSION["id"];

$sql = "SELECT 1 FROM boats WHERE id = $boatid AND userid = $userid";

$query = mysqli_query($link, $sql);
    
if (mysqli_num_rows($query) > 0) {  
    $sql = "DELETE FROM boats WHERE id = $boatid AND userid = $userid";

    if (mysqli_query($link, $sql) === TRUE) {
      echo "<div class='alert alert-success' role='alert'>Poprawnie usnięto łódź</div>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>Nie udało się usunąć</div>";
    }
} else {
  echo "<div class='alert alert-danger' role='alert'>Nie ma takiej łodzi</div>";
}

echo "<a href='boats.php'>Powrót</a></div>";
stopka();
?>