<?php
session_start();
require_once("database/connection.php");


if ($_GET["id"] && !empty($_GET["id"])) {

    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM articles WHERE id=:id";
    $data = $db->prepare($sql);
    $data->bindValue(":id", $id, PDO::PARAM_INT);
    $data->execute();
    $article = $data->fetch();

    if (!$article) {
        header("location: index.php");
        $_SESSION["message"] = "Désolé ! L'article est introuvable.";
    }
} else {
    header("location: index.php");
    $_SESSION["message"] = "Désolé ! Vous ne pouvez pas y accéder.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article["name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body>
    <main class="container">
        <div class="col-md-12 mt-5">
            <h2>Article n°<?= $article["id"] ?> : <?= $article["name"] ?></h2>
        </div>
    </main>

</body>

</html>