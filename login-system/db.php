<?php
$host = 'localhost';
$dbname = 'central_db';
$user = 'root';
$password = '';

$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>