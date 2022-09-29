<?php
try {
    $db = new PDO(
        "mysql:host=localhost;chartset=utf8;dbname=php_CRUD",
        "root",
        "root"
    );
} catch (PDOException $ex) {
    echo 'Error : ' . $ex;
    die();
}
