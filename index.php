<?php
session_start();
require_once("database/connection.php");
$title = "CRUD";

$sql = 'SELECT * FROM articles';
$data = $db->prepare($sql);
$data->execute();
$articles = $data->fetchAll(PDO::FETCH_ASSOC);

// var_dump($articles);
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
    <div class="container">
        <div class="row">
            <section class="mt-5">
                <h2>Liste des articles</h2>
                <a href="create.php" class="btn btn-primary">Ajouter un article</a>
                <table class="table mt-3">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        <?php foreach ($articles as $article) : ?>
                            <tr>
                                <td><?= $article["id"] ?></td>
                                <td><?= $article["name"] ?></td>
                                <td><?= $article["price"] ?></td>
                                <td><?= $article["stock"] ?></td>
                                <td>
                                    <a href="#" class="btn btn-primary">Show</a>
                                    <a href="#" class="btn btn-success">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </section>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>