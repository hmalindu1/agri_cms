<?php
session_start();
$dsn = "pgsql:host=localhost;dbname=agri_users;port=5432";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, 'postgres', '123', $opt);
// echo "Connected to Database<br>";
