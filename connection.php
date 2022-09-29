<?php
try {
    $pdo = new PDO(
        'mysql:host=coffee20.mysql.tools;
        port=3306;
        dbname=coffee20_khranovskiy',
        'coffee20_khranovskiy',
        '4k3s6vUNkK5H'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Unable connect to the DB '. $e->getMessage();
}