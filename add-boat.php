<?php
require_once "config.php";
require_once("common.php");
check_login();

$nazwa = $mmsi = $opis = $dlugosc = $szerokosc = $zanurzenie = "";
$nazwa_err = $mmsi_err = $opis_err = $dlugosc_err = $szerokosc_err = $zanurzenie_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["nazwa"]))){
        $nazwa_err = "Wprowadź nazwę.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nazwa"]))){
        $nazwa_err = "Nazwa łodzi może zawierać tylko litery, liczby i -";
    } else {
        $nazwa = test_input($_POST["nazwa"]);
    }

    if (empty(trim($_POST["mmsi"]))) {
        $mmsi = null;
    } else {
        $mmsi = test_input($_POST['mmsi']);
    }
    
    $opis = test_input($_POST['opis']);
    $dlugosc = test_input($_POST['dlugosc']);
    $szerokosc = test_input($_POST['szerokosc']);
    $zanurzenie = test_input($_POST['zanurzenie']);

    if(empty($nazwa_err) && empty($mmsi_err)) {
        
        $sql = "INSERT INTO boats (userid, nazwa, mmsi, opis, dlugosc, szerokosc, zanurzenie) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "isisddd", $param_userid, $param_nazwa, $param_mmsi, $param_opis, $param_dlugosc, $param_szerokosc, $param_zanurzenie);

            $param_userid = $_SESSION["id"];
            $param_nazwa = $nazwa;
            $param_mmsi = $mmsi;
            $param_opis = $opis;
            $param_dlugosc = $dlugosc;
            $param_szerokosc = $szerokosc;
            $param_zanurzenie = $zanurzenie;

            if(mysqli_stmt_execute($stmt)){
                header("location: boats.php");
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

naglowek("Moje łodzie", 1);
?>

<section id="lodzie">
    <div class="container">
       <h1 class="mt-3 mb-3">Dodaj nową łódź:</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="nazwa" class="form-label">Nazwa:</label>
                <input
                    type="text"
                    class="form-control <?php echo (!empty($nazwa_err)) ? 'is-invalid' : ''; ?>"
                    name="nazwa"
                    required
                    value="<?php echo $nazwa; ?>"
                >
                <span class="invalid-feedback"><?php echo $nazwa_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="mmsi" class="form-label">MMSI (opcjonalne):</label>
                <input
                    type="number"
                    class="form-control <?php echo (!empty($mmsi_err)) ? 'is-invalid' : ''; ?>"
                    name="mmsi"
                    value="<?php echo $mmsi; ?>"
                    min="100000000"
                    max="999999999"
                >
                <span class="invalid-feedback"><?php echo $mmsi_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis (opcjonalne):</label>
                <input
                    type="textarea"
                    class="form-control <?php echo (!empty($opis_err)) ? 'is-invalid' : ''; ?>"
                    name="opis"
                    value="<?php echo $opis; ?>"
                >
                <span class="invalid-feedback"><?php echo $opis_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="dlugosc" class="form-label">
                    Długość (m):
                </label>
                <input
                    type="number"
                    class="form-control <?php echo (!empty($dlugosc_err)) ? 'is-invalid' : ''; ?>"
                    name="dlugosc"
                    required
                    value="<?php echo $dlugosc; ?>"
                    min="0" max="999"
                    step="0.01"
                >
                <span class="invalid-feedback"><?php echo $dlugosc_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="szerokosc" class="form-label">
                    Szerokość (m):
                </label>
                <input
                    type="number"
                    class="form-control <?php echo (!empty($szerokosc_err)) ? 'is-invalid' : ''; ?>"
                    name="szerokosc"
                    required
                    value="<?php echo $szerokosc; ?>"
                    min="0" max="999"
                    step="0.01"
                >
                <span class="invalid-feedback"><?php echo $szerokosc_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="zanurzenie" class="form-label">
                    Zanurzenie (m):
                </label>
                <input
                    type="number"
                    class="form-control <?php echo (!empty($zanurzenie_err)) ? 'is-invalid' : ''; ?>"
                    name="zanurzenie"
                    required
                    value="<?php echo $zanurzenie; ?>"
                    min="0" max="999"
                    step="0.01"
                >
                <span class="invalid-feedback"><?php echo $zanurzenie_err; ?></span>
            </div>
            <input type="submit" class="btn btn-primary float-end" value="Dodaj">
        </form>
    </div>
</section>

<?php
    stopka();
?>
