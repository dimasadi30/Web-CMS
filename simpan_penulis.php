<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_depan = trim($_POST['nama_depan']);
    $nama_belakang = trim($_POST['nama_belakang']);
    $user_name = trim($_POST['user_name']);
    $password = $_POST['password'];
    $foto = $_FILES['foto'];

    if (empty($nama_depan) || empty($nama_belakang) || empty($user_name) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi']);
        exit;
    }

    $cek = $koneksi->prepare("SELECT id FROM penulis WHERE user_name = ?");
    $cek->bind_param("s", $user_name);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username sudah terdaftar']);
        exit;
    }
    $cek->close();

    $nama_foto = 'default.png';
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $foto['tmp_name']);
        finfo_close($finfo);
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan (hanya JPEG, PNG, GIF)']);
            exit;
        }
        if ($foto['size'] > 2 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB']);
            exit;
        }
        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $nama_foto = time() . '_' . uniqid() . '.' . $ext;
        $target = 'uploads_penulis/' . $nama_foto;
        if (!move_uploaded_file($foto['tmp_name'], $target)) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal upload foto']);
            exit;
        }
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $koneksi->prepare("INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama_depan, $nama_belakang, $user_name, $hashed_password, $nama_foto);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan: ' . $stmt->error]);
    }
    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>