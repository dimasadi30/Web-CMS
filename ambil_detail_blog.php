<?php
require_once 'koneksi.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT artikel.judul, artikel.isi, artikel.gambar, artikel.hari_tanggal,
            penulis.nama_depan, penulis.nama_belakang,
            kategori_artikel.nama_kategori
        FROM artikel
        JOIN penulis ON artikel.id_penulis = penulis.id
        JOIN kategori_artikel ON artikel.id_kategori = kategori_artikel.id
        WHERE artikel.id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Artikel tidak ditemukan']);
    exit;
}

$row = $result->fetch_assoc();
$isi = nl2br(htmlspecialchars($row['isi']));
echo json_encode([
    'status' => 'success',
    'judul' => htmlspecialchars($row['judul']),
    'isi' => $isi,
    'gambar' => 'uploads_artikel/' . $row['gambar'],
    'tanggal' => htmlspecialchars($row['hari_tanggal']),
    'penulis' => htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']),
    'kategori' => htmlspecialchars($row['nama_kategori'])
]);
