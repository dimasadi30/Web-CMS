<?php
require_once 'koneksi.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $koneksi->prepare("SELECT id, nama_depan, nama_belakang, user_name, foto FROM penulis WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['status' => 'success', 'data' => $row]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diberikan']);
}
?>