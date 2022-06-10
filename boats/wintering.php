<?php
require_once "../config.php";
require_once("../common.php");
check_login();

if (!isset($_GET["id"])) {
    header("location: list.php");
    exit;
}

$boatid = $_GET['id'];
$userid = $_SESSION["id"];

$mscId = $startDate = $endDate = "";
$endDate_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $boatId = test_input($_GET['id']);
    $mscId = test_input($_POST['mscId']);
    $startDate = test_input($_POST['startDate']);
    $endDate = test_input($_POST['endDate']);

    if ($startDate >= $endDate) {
        $endDate_err = "Data zakończenia zimowania jest przed rozpoczęciem!";
    }
    
    if(empty($endDate_err)) {
        
        $sql = "INSERT INTO wintering (userId, boatId, placeNumber, startDate, endDate, status) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "iiisss", $p_userId, $p_boatId, $p_placeNumber, $p_start, $p_end, $p_status);

            $p_userId = $userid;
            $p_boatId = $boatid;
            $p_placeNumber = $mscId;
            $p_start = $startDate;
            $p_end = $endDate;
            $p_status = "Requested";

            if(mysqli_stmt_execute($stmt)){
                $sql = "UPDATE place SET isTaken = 1 WHERE number = $p_placeNumber";

                if (mysqli_query($link, $sql)) {
                    header("location: manage.php?id=" . $p_boatId);
                    die();
                } else {
                    echo "Error przy update miejsca.";
                }
            } else{
                echo "Oops! Coś poszło nie tak. Spróbuj ponownie później.";
                die();
            }

            mysqli_stmt_close($stmt);
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$result = mysqli_query($link, "SELECT * FROM boats WHERE userid = $userid AND id = $boatid");
$boat = mysqli_fetch_array($result);
$nazwa = $boat['nazwa'];

$places = mysqli_query($link, "SELECT * FROM place WHERE isTaken = 0");

mysqli_close($link);

naglowek("Zimowanie", 1);
?>

<section id="zimowanie">
    <div class="container">
        <h1 class="mt-3 mb-5">
            <a href="manage.php" class="btn btn-secondary">&lt;</a>
            Zarezerwuj zimowanie dla łodzi "<?php echo $nazwa; ?>"
        </h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). "?id=$boatid"; ?>" method="post">
            <div class="form-group row mb-3">
                <label for="miejsce" class="col-sm-2 col-form-label">Miejsce:</label>
                <div class="col-sm-10">
                    <select name="mscId" class="form-select form-control" id="miejsce" required>
                        <option value="" selected>Wybierz...</option>
                        <?php
    while($place = mysqli_fetch_array($places)) {
        echo "<option value='" . $place['number'] . "' " . (($mscId === $place['number']) ? "selected" : "") . ">" . $place['name']."</option>";
    }
?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="startDate" class="form-label col-sm-2 col-form-label">Start:</label>
                <div class="col-sm-10">
                    <input name="startDate" class="form-select " type="datetime-local" id="startDate" value="<?php echo $startDate ?>" required>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="endDate" class="col-sm-2 col-form-label">Koniec:</label>
                <div class="col-sm-10">
                    <input name="endDate" class="form-select <?php echo (!empty($endDate_err)) ? 'is-invalid' : ''; ?>" type="datetime-local" id="endDate" required value="<?php echo $endDate ?>">
                    <span class="invalid-feedback"><?php echo $endDate_err ?></span>
                </div>
            </div>
            <div class="float-end">
                <a href="manage.php?id=<?php echo $boatid?>" class="btn btn-primary ">Anuluj</a>
                <input type="submit" class="btn btn-success" value="Zarezerwuj">
            </div>
            <input type="hidden" name="boatId" value="<?php echo $boatid ?>">
        </form>
    </div>
</section>

<?php
    stopka();
?>
