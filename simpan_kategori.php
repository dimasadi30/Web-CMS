<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_kategori']);
    $keterangan = trim($_POST['keterangan']);
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama kategori harus diisi']);
        exit;
    }
    $stmt = $koneksi->prepare("INSERT INTO kategori_artikel (nama_kategori, keterangan) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $keterangan);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>