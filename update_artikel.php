<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);
    $id_penulis = intval($_POST['id_penulis']);
    $id_kategori = intval($_POST['id_kategori']);
    $gambar = $_FILES['gambar'];

    $stmt = $koneksi->prepare("SELECT gambar FROM artikel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $old = $result->fetch_assoc();
    $stmt->close();
    if (!$old) {
        echo json_encode(['status' => 'error', 'message' => 'Artikel tidak ditemukan']);
        exit;
    }

    $nama_gambar = $old['gambar'];
    if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $gambar['tmp_name']);
        finfo_close($finfo);
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan']);
            exit;
        }
        if ($gambar['size'] > 2 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB']);
            exit;
        }
        $ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
        $nama_gambar_baru = time() . '_' . uniqid() . '.' . $ext;
        $target = 'uploads_artikel/' . $nama_gambar_baru;
        if (move_uploaded_file($gambar['tmp_name'], $target)) {
            if (file_exists('uploads_artikel/' . $old['gambar'])) {
                unlink('uploads_artikel/' . $old['gambar']);
            }
            $nama_gambar = $nama_gambar_baru;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal upload gambar']);
            exit;
        }
    }

    $stmt = $koneksi->prepare("UPDATE artikel SET id_penulis=?, id_kategori=?, judul=?, isi=?, gambar=? WHERE id=?");
    $stmt->bind_param("iisssi", $id_penulis, $id_kategori, $judul, $isi, $nama_gambar, $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil diupdate']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal update: ' . $stmt->error]);
    }
    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>