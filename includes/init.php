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
$pdo = new PDO($dsn, 'postgres', '123', $opt);
// echo "Connected to Database<br>";
include "php_functions.php";