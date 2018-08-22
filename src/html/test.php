<?php

require_once '../var/autoloader.php';

new \Model\Toto2();

$dsn = 'mysql:dbname=test_iad_chat;host=chat_db';
$user = 'iad';
$password = 'KLzanTatgAazs556';

try {
    $dbh = new PDO($dsn, $user, $password);
    $sql = "SELECT * FROM users";

    $statement = $dbh->query($sql);

    foreach ($statement as $row) {
        var_dump($row);
    }
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
