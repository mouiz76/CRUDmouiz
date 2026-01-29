<?php
include('config/config.php');

$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
$pdo = new PDO($dsn, $username, $password);

if (isset($_POST['submit'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "UPDATE Rollercoaster AS HAVE
            SET    Rollercoaster = :naamAchtbaan
                ,AmusementPark = :naamPretpark
                ,Country = :land
                ,Topspeed = :topsnelheid
                ,Height = :hoogte
                ,YearOfConstruction = :bouwjaar
                WHERE HAVE.Id = :id";

    $statement = $pdo->prepare($sql);	
    $statement->bindValue(':naamAchtbaan', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':naamPretpark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
    $statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_INT);
    $statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_INT);
    $statement->bindValue(':bouwjaar', $_POST['bouwjaar'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $statement->execute();

    $display = 'flex';
    header('Refresh: 3; url=index.php');
} else {
    $sql = "SELECT HAVE.Id
                  ,HAVE.Rollercoaster
                  ,HAVE.AmusementPark
                  ,HAVE.Country
                  ,HAVE.Topspeed
                  ,HAVE.Height
                  ,HAVE.YearOfConstruction
                  FROM Rollercoaster AS HAVE
                  WHERE HAVE.Id = :id";
    
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_OBJ);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-3">
      <div class="row justify-content-center">
        <div class="col-6">
            <h3 class="text-primary">Wijzig een achtbaan</h3>
        </div>
      </div>

      <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-6">
            <div class="alert alert-success text-center" role="alert">
                De gegevens zijn bijgewerkt. U wordt teruggestuurd naar de index-pagina.
            </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-6">
            <form action="update.php" method="POST">
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input type="text" name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" class="form-control" id="inputNaamAchtbaan" required value="<?= $result->NaamAchtbaan ?? $_POST['naamAchtbaan'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                    <input type="text" name="naamPretpark" placeholder="Vul de naam van het pretpark in" class="form-control" id="inputNaamPretpark" required value="<?= $result->NaamPretpark ?? $_POST['naamPretpark'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input type="text" name="land" placeholder="Vul het land in waar het pretpark zich bevindt" class="form-control" id="inputLand" required value="<?= $result->Land ?? $_POST['land'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input type="text" name="topsnelheid" placeholder="Vul de topsnelheid in km/u in" class="form-control" id="inputTopsnelheid" required value="<?= $result->Topsnelheid ?? $_POST['topsnelheid'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input type="text" name="hoogte" placeholder="Vul de hoogte in meters in" class="form-control" id="inputHoogte" required value="<?= $result->Hoogte ?? $_POST['Hoogte'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                    <input type="date" name="bouwjaar" placeholder="Vul het bouwjaar in" class="form-control" id="inputYearOfConstruction" required value="<?= $result->Bouwjaar ?? $_POST['bouwjaar'] ?? '' ?>">
                </div>

                <input type="hidden" name="id" value="<?= $result->Id ?? $_POST['id'] ?? '' ?>">

                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
                </div>
            </form>
        </div>
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>