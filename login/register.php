<?php
require_once "../config.php";

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Wprowadź nazwę użytkownika.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Nazwa użytkownika może zawierać tylko litery, liczby i -.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ta nazwa użytkownika jest już zajęta.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Coś poszło nie tak. Spróbuj ponownie później.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Wpisz E-mail.";
    } else{
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Niepoprawny email.";
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Wpisz hasło.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Hasło musi mieć przynajmniej 6 znaków.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Proszę potwierdź hasło.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Hasła nie są identyczne.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
            } else{
                echo "Oops! Coś poszło nie tak. Spróbuj ponownie później.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Utwórz konto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="login-body">
    <div class="container login-container">
        <div class="d-flex justify-content-center h-100">
            <div class="card login-card">
                <div class="card-header">
                    <h2>Utwórz konto</h2>
                    <p>Prosze wypełnij formularz aby utworzyć konto.</p>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nazwa użytkownika</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <label>Hasło</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group mt-2">
                            <label>Potwierdź Hasło</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <input type="reset" class="btn btn-secondary" value="Reset">
                            <input type="submit" class="btn btn-primary float-end" value="Utwórz">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <p>Masz już konto? <a href="index.php">Zaloguj się tutaj</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
