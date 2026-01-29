<?php
include('config/config.php');

$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
$pdo = new PDO($dsn, $username, $password);
$sql = "SELECT HAVE.Id
               ,HAVE.Rollercoaster
               ,HAVE.AmusementPark
               ,HAVE.Country
               ,HAVE.Topspeed
               ,HAVE.Height
               ,DATE_FORMAT(HAVE.YearOfConstruction, '%d-%m-%Y') AS YOFC
               FROM Rollercoaster AS HAVE
               ORDER BY HAVE.Height DESC";

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
//var_dump($result);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Basics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container mt-3">

      <div class="row justify-content-center">
        <div class="col-10">
          <h3>Hoogste achtbanen van Europa</h3>
        </div>
      </div>

      <div class="row justify-content-center my-3">
        <div class="col-10">
          <h6>Nieuwe Achtbaan <a href="./create.php"><i class="bi bi-plus-square text-danger"></i></a></h6>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-10">
          <table class="table table-striped table-hover">
            <thead>
              <th>Naam Achtbaan</th>
              <th>Naam Pretpark</th>
              <th>Land</th>
              <th>topsnelheid (km/u)</th>
              <th>Hoogte (m)</th>
              <th>Bouwjaar</th>
              <th>Wijzig</th>
              <th>Verwijder</th>
            </thead>
            <tbody>
              <?php foreach ($result as $rollercoaster):?>
              <tr>
                <td><?= $rollercoaster->Rollercoaster ?></td>
                <td><?= $rollercoaster->AmusementPark ?></td>
                <td><?= $rollercoaster->Country ?></td>
                <td class="text-center"><?= $rollercoaster->Topspeed ?></td>
                <td class="text-center"><?= $rollercoaster->Height ?></td>
                <td><?= $rollercoaster->YOFC ?></td>
                <td class="text-center">
                  <a href="update.php?id=<?= $rollercoaster->Id;?>">
                    <i class="bi bi-pencil-square text-primary"></i>
                  </a>
                </td>
                <td class="text-center">
                  <a href="delete.php?id=<?= $rollercoaster->Id;?>">
                    <i class="bi bi-x-square text-danger"></i>
                  </a>
                  </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>