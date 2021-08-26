<?php
ob_start();
session_start();

$host = 'localhost';
$db = 'agri_users';
$user = 'postgres';
$pass = '123';
$port = '5432';

$dsn = "pgsql:host=$host;dbname=$db;port=$port";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    //code...
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    //throw $th;
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Line Number: " . $e->getLine();

}
// echo "Connected to Database<br>";
$root_directory = "agri_cms";
$from_email = "admin@imgenv.com";
$reply_email = "admin@imgenv.com";

include "php_functions.php";
