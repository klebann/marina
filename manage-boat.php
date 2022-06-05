<?php
require_once "config.php";
require_once("common.php");
check_login();

if (!isset($_GET["id"])) {
    header("location: boats.php");
    exit;
}

$boatid = $_GET['id'];
$userid = $_SESSION["id"];
$result = mysqli_query($link, "SELECT * FROM boats WHERE userid = $userid AND id = $boatid");
$row = mysqli_fetch_array($result);

if (empty($row)) {
    header("location: boats.php");
    exit;
}

naglowek("Zarządzaj łodzią", 10);
?>

<section>
    <div class="container mt-3">
        <div class="mb-3">
            <h1>Łódź "<?php echo $row['nazwa'] ?>"</h1>
            <a href="edit-boat.php?id=<?php echo $row['id']?>" class="btn btn-primary">Edytuj Dane</a>
            <a class="btn btn-danger">Usuń</a>
        </div>
        
        
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>ID:</td>
                    <td><?php echo $row['id']?></td>
                </tr>
                <tr>
                    <td>Nazwa:</td>
                    <td><?php echo $row['nazwa']?></td>
                </tr>
                <tr>
                    <td>MMSI:</td>
                    <td><?php echo $row['mmsi']?></td>
                </tr>
                <tr>
                    <td>Opis:</td>
                    <td><?php echo $row['opis']?></td>
                </tr>
                <tr>
                    <td>Długość:</td>
                    <td><?php echo $row['dlugosc']?>m</td>
                </tr>
                <tr>
                    <td>Szerokość:</td>
                    <td><?php echo $row['szerokosc']?>m</td>
                </tr>
                <tr>
                    <td>Zanurzenie:</td>
                    <td><?php echo $row['zanurzenie']?>m</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section>
   <div class="container">
       <h1>Akcje:</h1>
        <a class="btn btn-primary">Zamów Zimowanie</a>
        <a class="btn btn-primary">Zamów Miejsce Postojowe</a>
        <a class="btn btn-primary">Zamów Dźwig</a>
   </div>
</section>

<?php
    stopka();
?>
