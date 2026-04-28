<?php
require_once 'koneksi.php';
$sql = "SELECT artikel.id, artikel.judul, artikel.gambar, artikel.hari_tanggal,
               penulis.nama_depan, penulis.nama_belakang,
               kategori_artikel.nama_kategori
        FROM artikel
        JOIN penulis ON artikel.id_penulis = penulis.id
        JOIN kategori_artikel ON artikel.id_kategori = kategori_artikel.id
        ORDER BY artikel.id DESC";
$result = $koneksi->query($sql);
$html = '<div class="table-responsive">
            <table class="table table-premium">
                <thead>
                    <tr>
                        <th style="width: 80px">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gambar = 'uploads_artikel/' . $row['gambar'];
        $judul = htmlspecialchars($row['judul']);
        $kategori = htmlspecialchars($row['nama_kategori']);
        $penulis = htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']);
        $tanggal = htmlspecialchars($row['hari_tanggal']);
        $html .= '<tr>
                    <td><img src="' . $gambar . '" class="img-article" width="55" height="55" style="object-fit: cover; border-radius: 12px;"></td>
                    <td class="fw-semibold">' . $judul . '</td>
                    <td><span class="badge-category">' . $kategori . '</span></td>
                    <td><i class="bi bi-person-circle me-1"></i> ' . $penulis . '</td>
                    <td><i class="bi bi-calendar3 me-1"></i> ' . $tanggal . '</td>
                    <td>
                        <button class="btn-action btn-edit edit-artikel" data-id="' . $row['id'] . '"><i class="bi bi-pencil"></i> Edit</button>
                        <button class="btn-action btn-delete hapus-artikel" data-id="' . $row['id'] . '"><i class="bi bi-trash"></i> Hapus</button>
                    </td>
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada artikel</td></tr>';
}
$html .= '</tbody></table></div>';
echo $html;
