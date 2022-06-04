<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Witaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">Hej, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Witaj na naszej stronie.</h1>
<p>
    <a href="change-password.php" class="btn btn-warning">Zresetuj swoje hasło</a>
    <a href="logout.php" class="btn btn-danger ml-3">Wyloguj się</a>
</p>
</body>
</html>