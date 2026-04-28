<?php
require_once 'koneksi.php';
$sql = "SELECT id, nama_kategori, keterangan FROM kategori_artikel ORDER BY id DESC";
$result = $koneksi->query($sql);
?>
<div class="table-responsive">
    <table class="table table-premium">
        <thead><tr><th>Nama Kategori</th><th>Keterangan</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="fw-semibold"><i class="bi bi-tag-fill text-primary"></i> <?= htmlspecialchars($row['nama_kategori']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td>
                            <button class="btn-action btn-edit edit-kategori" data-id="<?= $row['id'] ?>"><i class="bi bi-pencil"></i> Edit</button>
                            <button class="btn-action btn-delete hapus-kategori" data-id="<?= $row['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center text-muted py-4">Belum ada kategori</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>