<?php
require "config.php";
require_once("common.php");
check_login();

naglowek("Pusta", 5);

$userid = $_SESSION["id"];
$result = mysqli_query($link, "SELECT * FROM users WHERE id = $userid");
$user = mysqli_fetch_array($result);
?>

<div class="container">
    <h1 class="mt-2">Konto użytkownika:</h1>
    <h2>Nazwa użytkownika:
        <br><b><?php echo $user['username']?></b>
    </h2>
    <h2>Imie:<br><b><?php echo $user['firstName']?></b></h2>
    <h2>Nazwisko:<br><b><?php echo $user['lastName']?></b></h2>
    <h2>Email:<br><b><?php echo $user['email']?></b></h2>
    <h2>Pesel:<br><b><?php echo (empty($user['pesel'])) ? "Brak danych" : $user['pesel']?></b></h2>
    <h2>Data rejestracji:<br><b><?php echo $user['created_at']?></h2>
</div>

<?php
stopka();
?>
