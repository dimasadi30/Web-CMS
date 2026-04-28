<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_depan = trim($_POST['nama_depan']);
    $nama_belakang = trim($_POST['nama_belakang']);
    $user_name = trim($_POST['user_name']);
    $password = $_POST['password'];
    $foto = $_FILES['foto'];

    $stmt = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $old = $result->fetch_assoc();
    $stmt->close();
    if (!$old) {
        echo json_encode(['status' => 'error', 'message' => 'Penulis tidak ditemukan']);
        exit;
    }

    $nama_foto = $old['foto'];
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $foto['tmp_name']);
        finfo_close($finfo);
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan']);
            exit;
        }
        if ($foto['size'] > 2 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB']);
            exit;
        }
        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $nama_foto_baru = time() . '_' . uniqid() . '.' . $ext;
        $target = 'uploads_penulis/' . $nama_foto_baru;
        if (move_uploaded_file($foto['tmp_name'], $target)) {
            if ($old['foto'] != 'default.png' && file_exists('uploads_penulis/' . $old['foto'])) {
                unlink('uploads_penulis/' . $old['foto']);
            }
            $nama_foto = $nama_foto_baru;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal upload foto']);
            exit;
        }
    }

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $koneksi->prepare("UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, password=?, foto=? WHERE id=?");
        $stmt->bind_param("sssssi", $nama_depan, $nama_belakang, $user_name, $hashed, $nama_foto, $id);
    } else {
        $stmt = $koneksi->prepare("UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssi", $nama_depan, $nama_belakang, $user_name, $nama_foto, $id);
    }
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil diupdate']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal update: ' . $stmt->error]);
    }
    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>