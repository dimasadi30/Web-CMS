<?php
require_once 'koneksi.php';
$sql = "SELECT artikel.id, artikel.judul, artikel.gambar, artikel.hari_tanggal,
               penulis.nama_depan, penulis.nama_belakang, penulis.foto as penulis_foto,
               kategori_artikel.nama_kategori
        FROM artikel
        JOIN penulis ON artikel.id_penulis = penulis.id
        JOIN kategori_artikel ON artikel.id_kategori = kategori_artikel.id
        ORDER BY artikel.id DESC";
$result = $koneksi->query($sql);
?>
<div class="container p-3">
    <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): 
                $gambar = 'uploads_artikel/' . $row['gambar'];
                $judul = htmlspecialchars($row['judul']);
                $kategori = htmlspecialchars($row['nama_kategori']);
                $penulis = htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']);
                $tanggal = htmlspecialchars($row['hari_tanggal']);
                $fotoPenulis = !empty($row['penulis_foto']) ? 'uploads_penulis/' . $row['penulis_foto'] : 'uploads_penulis/default.png';
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-blog h-100">
                        <img src="<?= $gambar ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body p-3">
                            <span class="badge-category"><?= $kategori ?></span>
                            <h5 class="mt-2"><?= $judul ?></h5>
                            <div class="d-flex align-items-center gap-2 mt-2">
                                <img src="<?= $fotoPenulis ?>" class="avatar-circle" width="32" height="32">
                                <div class="small">
                                    <div><?= $penulis ?></div>
                                    <div class="text-secondary"><?= $tanggal ?></div>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-accent w-100 mt-3 btn-read-blog" data-id="<?= $row['id'] ?>">
                                <i class="bi bi-eye"></i> Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-newspaper display-1 text-secondary"></i>
                <p class="mt-3">Belum ada artikel. Silakan tambahkan dari menu Kelola Artikel.</p>
            </div>
        <?php endif; ?>
    </div>
</div>