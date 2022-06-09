<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../config.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Wprowadź nowe hasło.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Hasło musi mieć przynajmniej 6 znaków.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Proszę potwierdź hasło.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Hasła nie są identyczne.";
        }
    }

    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Ups! Coś poszło nie tak. Spróbuj ponownie później.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Zmień hasło</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-body">
    <div class="container login-container">
        <div class="d-flex justify-content-center h-100">
            <div class="card login-card">
                <div class="card-header">
                    <h2>Zmień hasło</h2>
                    <p>Wypełnij poniższy formularz, aby zresetować hasło.</p>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nowe hasło</label>
                            <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <label>Potwierdź hasło</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group mt-4">
                            <a class="btn btn-link ml-2" href="/marina/index.php">Anuluj</a>
                            <input type="submit" class="btn btn-primary float-end" value="Zmień">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
