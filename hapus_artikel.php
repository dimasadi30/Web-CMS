<?php
require_once 'koneksi.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $koneksi->prepare("SELECT gambar FROM artikel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $artikel = $result->fetch_assoc();
    $stmt->close();

    $del = $koneksi->prepare("DELETE FROM artikel WHERE id = ?");
    $del->bind_param("i", $id);
    if ($del->execute()) {
        if ($artikel && file_exists('uploads_artikel/' . $artikel['gambar'])) {
            unlink('uploads_artikel/' . $artikel['gambar']);
        }
        echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal hapus: ' . $del->error]);
    }
    $del->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diberikan']);
}
?>