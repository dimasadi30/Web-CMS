<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_blog';

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Koneksi gagal: ' . $koneksi->connect_error]));
}
$koneksi->set_charset("utf8mb4");
date_default_timezone_set('Asia/Jakarta');
?>