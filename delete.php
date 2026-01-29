<?php
include('config/config.php');
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
$pdo = new PDO($dsn, $username, $password);

$sql = "DELETE FROM Rollercoaster WHERE Id = :id";

$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$statement->execute();

header('Refresh: 3; url=index.php')
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Basics Delete Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>
    <div class="container mt-3">

      <div class="row justify-content-center">
        <div class="col-10">
            <div class="alert alert-success text-center" role="alert">
                Rollercoaster succesvol verwijderd!
            </div>
        </div>
      </div>
    </div>
  
</body>
</html>