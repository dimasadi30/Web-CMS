<?php
require_once 'koneksi.php';
$result = $koneksi->query("SELECT id, nama_depan, nama_belakang FROM penulis ORDER BY id");
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
?>