<?php
require_once 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);
    $id_penulis = intval($_POST['id_penulis']);
    $id_kategori = intval($_POST['id_kategori']);
    $gambar = $_FILES['gambar'];

    if (empty($judul) || empty($isi) || empty($id_penulis) || empty($id_kategori)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi']);
        exit;
    }
    if ($gambar['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => 'error', 'message' => 'Gambar artikel wajib diupload']);
        exit;
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $gambar['tmp_name']);
    finfo_close($finfo);
    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($mime, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan (JPEG, PNG, GIF)']);
        exit;
    }
    if ($gambar['size'] > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB']);
        exit;
    }
    $ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
    $nama_gambar = time() . '_' . uniqid() . '.' . $ext;
    $target = 'uploads_artikel/' . $nama_gambar;
    if (!move_uploaded_file($gambar['tmp_name'], $target)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal upload gambar']);
        exit;
    }

    $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $sekarang = new DateTime();
    $nama_hari = $hari[$sekarang->format('w')];
    $tanggal = $sekarang->format('j');
    $nama_bulan = $bulan[(int)$sekarang->format('n')];
    $tahun = $sekarang->format('Y');
    $jam = $sekarang->format('H:i');
    $hari_tanggal = "$nama_hari, $tanggal $nama_bulan $tahun | $jam";

    $stmt = $koneksi->prepare("INSERT INTO artikel (id_penulis, id_kategori, judul, isi, gambar, hari_tanggal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $id_penulis, $id_kategori, $judul, $isi, $nama_gambar, $hari_tanggal);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil ditambahkan']);
    } else {
        if (file_exists($target)) unlink($target);
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan: ' . $stmt->error]);
    }
    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}
?>