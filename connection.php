<?php
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "puskesmas2";

$connect = new mysqli($host, $username, $password, $database, $port);
if ($connect->connect_error) {
    die("Maaf koneksi gagal ".$connect->connect_error);
} 
?>