<?php
require_once 'koneksi.php';
$result = $koneksi->query("SELECT id, nama_kategori FROM kategori_artikel ORDER BY id");
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
?>