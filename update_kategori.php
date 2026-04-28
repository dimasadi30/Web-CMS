<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama = trim($_POST['nama_kategori']);
    $keterangan = trim($_POST['keterangan']);
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama kategori harus diisi']);
        exit;
    }
    $stmt = $koneksi->prepare("UPDATE kategori_artikel SET nama_kategori=?, keterangan=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $keterangan, $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil diupdate']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal update: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>