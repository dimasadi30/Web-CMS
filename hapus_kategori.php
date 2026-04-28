<?php
require_once 'koneksi.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $cek = $koneksi->prepare("SELECT id FROM artikel WHERE id_kategori = ? LIMIT 1");
    $cek->bind_param("i", $id);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Kategori tidak dapat dihapus karena masih memiliki artikel']);
        $cek->close();
        exit;
    }
    $cek->close();
    $del = $koneksi->prepare("DELETE FROM kategori_artikel WHERE id = ?");
    $del->bind_param("i", $id);
    if ($del->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal hapus: ' . $del->error]);
    }
    $del->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diberikan']);
}
?>