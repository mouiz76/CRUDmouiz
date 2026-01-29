<?php
if (isset($_POST['submit'])) {
    include('config/config.php');
    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
    $pdo = new PDO($dsn, $username, $password);
   
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "INSERT INTO rollercoaster (
                Rollercoaster
               ,AmusementPark
               ,Country
               ,Topspeed
               ,Height
               ,YearOfConstruction)
           VALUES (
                :naamAchtbaan
               ,:naamPretpark
               ,:land
               ,:topsnelheid
               ,:hoogte
               ,:bouwjaar
               )";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':naamAchtbaan', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':naamPretpark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
    $statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_INT);
    $statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_INT);
    $statement->bindValue(':bouwjaar', $_POST['bouwjaar'], PDO::PARAM_STR);
    $statement->execute();

    $display = 'flex';
    header('Refresh: 3; url=index.php');
}
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

    <div class="justify-content-center" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-6">
            <div class="alert alert-success text-center" role="alert">
                De gegevens zijn toegevoegd. U wordt teruggestuurd naar de index-pagina.
            </div>
        </div>
    </div>

      <div class="row justify-content-center">
        <div class="col-6">
          <h3 class="text-primary">Voer een nieuwe achtbaan in:</h3>
        </div>

      </div>
      
      <div class="row justify-content-center">
        <div class="col-6">
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input type="text" name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" class="form-control" id="inputNaamAchtbaan" required value="<?= $_POST['naamAchtbaan'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                    <input type="text" name="naamPretpark" placeholder="Vul de naam van het pretpark in" class="form-control" id="inputNaamPretpark" required value="<?= $_POST['naamPretpark'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input type="text" name="land" placeholder="Vul het land in waar het pretpark zich bevindt" class="form-control" id="inputLand" required value="<?= $_POST['land'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input type="text" name="topsnelheid" placeholder="Vul de topsnelheid in km/u in" class="form-control" id="inputTopsnelheid" required value="<?= $_POST['topsnelheid'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input type="text" name="hoogte" placeholder="Vul de hoogte in meters in" class="form-control" id="inputHoogte" required value="<?= $_POST['hoogte'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="inputYearOfConstruction" class="form-label">Bouwjaar:</label>
                    <input type="date" name="bouwjaar" placeholder="Vul het bouwjaar in" class="form-control" id="inputYearOfConstruction" required value="<?= $_POST['bouwjaar'] ?? '' ?>">
                </div>
                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
                </div>
            </form>
        </div>
      </div>

      <div class="row justify-content-center mt-3">
        <div class="col-6">
            <a href="index.php"><i class="bi bi-arrow-left-square-fill text-danger" style="font-size:1.5em"></i></a>
        </div>
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>