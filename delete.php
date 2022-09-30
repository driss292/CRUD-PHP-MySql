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

        $id = strip_tags($_GET["id"]);

        $name = strip_tags($_POST["name"]);
        $price = strip_tags($_POST["price"]);
        $stock = strip_tags($_POST["stock"]);

        $sql = "DELETE FROM articles WHERE id=:id";
        $data = $db->prepare($sql);

        $data->bindValue(":id", $id, PDO::PARAM_INT);

        $data->execute();
        header("location: index.php");
        $_SESSION["message"] = "Artcicle supprimé.";
    } else {
        header("location: index.php");
        $_SESSION["message"] = "Désolé ! L'article est introuvable.";
    }
} else {
    header("location: index.php");
    $_SESSION["message"] = "Désolé ! Vous ne pouvez pas y accéder.";
}
