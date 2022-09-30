<?php
session_start();
require_once("database/connection.php");
$title = "Edition";

if ($_GET["id"] && !empty($_GET["id"])) {

    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM articles WHERE id=:id";
    $data = $db->prepare($sql);
    $data->bindValue(":id", $id, PDO::PARAM_INT);
    $data->execute();
    $article = $data->fetch();

    if ($article) {

        if (!empty($_POST["name"]) && !empty($_POST["price"]) && !empty($_POST["stock"])) {

            $name = strip_tags($_POST["name"]);
            $price = strip_tags($_POST["price"]);
            $stock = strip_tags($_POST["stock"]);

            $sql = "UPDATE articles SET name=:name,price=:price,stock=:stock WHERE id=:id";
            $data = $db->prepare($sql);

            $data->bindValue(":id", $id, PDO::PARAM_INT);
            $data->bindValue(":name", $name, PDO::PARAM_STR);
            $data->bindValue(":price", $price, PDO::PARAM_STR);
            $data->bindValue(":stock", $stock, PDO::PARAM_STR);

            $data->execute();
            header("location: index.php");
            $_SESSION["message"] = "Artcicle modifié.";
        }
    } else {
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
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body>

    <h1 class="mt-5 text-center">CRUD en PHP</h1>
    <main class="container mt-5">

        <div class="col-md-12">
            <h2>Édition de l'article <?= $article["name"] ?></h2>
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?= $article["name"] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" value="<?= $article["price"] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" value="<?= $article["stock"] ?>" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <a href="index.php" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>

</html>