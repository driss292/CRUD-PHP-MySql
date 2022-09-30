<?php
session_start();
$title = "Create";
require_once("database/connection.php");
if (!empty($_POST["name"]) && !empty($_POST["price"]) && !empty($_POST["stock"])) {
    $name = strip_tags($_POST["name"]);
    $price = strip_tags($_POST["price"]);
    $stock = strip_tags($_POST["stock"]);

    $sql = "INSERT INTO articles(name,price,stock) VALUES (:name,:price,:stock)";
    $article = $db->prepare($sql);

    // Liaison
    $article->bindValue(":name", $name, PDO::PARAM_STR);
    $article->bindValue(":price", $price, PDO::PARAM_STR);
    $article->bindValue(":stock", $stock, PDO::PARAM_STR);

    // Execution
    $article->execute();

    $_SESSION["message"] = "Votre articles a bien été sauvegardé dans la BDD !";
    header("location: index.php");
} else {
    $_SESSION["message"] = "Vous devez remplir tous les champs !";
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
</head>

<body>
    <h1 class="mt-5 text-center">CRUD en PHP</h1>
    <main class="container mt-5">
        <div class="col-md-12">
            <h2>Création d'un article</h2>
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="index.php" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>