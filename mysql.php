<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$name = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

$mysql_conn = new mysqli($host, $user, $pass, $name, $port);

if ($mysql_conn->connect_error) {
    die("Connection failed: " . $mysql_conn->connect_error);
}
?>
