<?php
require_once 'koneksi.php';
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $cek = $koneksi->prepare("SELECT id FROM artikel WHERE id_penulis = ? LIMIT 1");
    $cek->bind_param("i", $id);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Penulis tidak dapat dihapus karena masih memiliki artikel']);
        $cek->close();
        exit;
    }
    $cek->close();

    $stmt = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $penulis = $result->fetch_assoc();
    $stmt->close();

    $del = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
    $del->bind_param("i", $id);
    if ($del->execute()) {
        if ($penulis && $penulis['foto'] != 'default.png' && file_exists('uploads_penulis/' . $penulis['foto'])) {
            unlink('uploads_penulis/' . $penulis['foto']);
        }
        echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal hapus: ' . $del->error]);
    }
    $del->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diberikan']);
}
?>