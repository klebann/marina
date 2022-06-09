<?php
require_once "../config.php";
require_once("../common.php");
check_login();

$userid = $_SESSION["id"]; 
$result = mysqli_query($link, "SELECT * FROM boats WHERE userid = $userid");

naglowek("Moje łodzie", 1);
?>

<section id="lodzie">
    <div class="container mt-3">
        <h1>Moje łodzie:</h1>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Opis</th>
                    <th scope="col">MMSI</th>
                    <th scope="col">
                        <div class="text-end me-5">
                            Akcja
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
<?php
    while($row = mysqli_fetch_array($result)) {
        echo <<<END
        <tr>
            <th scope="row">$row[id]</th>
            <td>
                <a href="manage.php?id=$row[id]">
                    $row[nazwa]
                </a>
            </td>
            <td>$row[opis]</td>
            <td>$row[mmsi]</td>
            <td>
                <div class="text-end">
                    <a href="manage.php?id=$row[id]" class="btn btn-primary">
                        Zarządzaj
                    </a>
                    <a href="remove.php?id=$row[id]" class="btn btn-danger"> 
                        Usuń
                    </a>
                </div>
            </td>
        </tr>
        END;
    }
?>         
            </tbody>
        </table>
        <a href="add.php">
            <button class="btn btn-success">Dodaj łódź</button>
        </a>
    </div>
</section>

<?php
    stopka();
?>
