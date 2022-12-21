<?php
    // Database settings
    define("DB_HOST", "localhost");
    define("DB_NAME", "test");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");

    //connect to database
    try {
        $pdo = new PDO(
            "mysql:host=".DB_HOST.";db_name=".DB_NAME.";charset=".DB_CHARSET,DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (Exception $ex) { exit($ex->getMessage());}
?>