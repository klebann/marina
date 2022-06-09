<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

require_once "../config.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Wpisz nazwę użytkownika.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Wpisz hasło.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: ../index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Niepoprawny login lub hasło.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Niepoprawny login lub hasło.";
                }
            } else{
                echo "Oops! Coś poszło nie tak. Spróbuj ponownie później.";
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
    <title>Zaloguj się</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-body">
    <div class="container login-container">
        <div class="d-flex justify-content-center h-100">
            <div class="card login-card">
                <div class="card-header">
                    <h2>Zaloguj się</h2>
                    <p>Wpisz swoje dane aby się zalogować.</p>
                    <?php
                        if(!empty($login_err)) echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nazwa użytkownika</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <label>Hasło</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <input type="submit" class="btn float-end btn-primary" value="Zaloguj">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <p class="mt-2">Nie masz konta? <a href="register.php">Zarejestruj się</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
