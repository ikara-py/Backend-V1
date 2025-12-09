<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$connection = mysqli_connect($_ENV["db_host"], $_ENV["db_username"], $_ENV["db_password"], $_ENV["db_name"]);

if (!$connection) {
    die('Connect error: ' . mysqli_connect_error());
}

$allPatients = "select * from patients";

