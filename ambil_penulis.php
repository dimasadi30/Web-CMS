<?php
require_once 'koneksi.php';
$sql = "SELECT id, nama_depan, nama_belakang, user_name, password, foto FROM penulis ORDER BY id DESC";
$result = $koneksi->query($sql);
?>
<div class="table-responsive">
    <table class="table table-premium">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Password (Hash)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): 
                    $foto = !empty($row['foto']) ? 'uploads_penulis/' . $row['foto'] : 'uploads_penulis/default.png';
                    $nama = htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']);
                    $username = htmlspecialchars($row['user_name']);
                    $hashPassword = htmlspecialchars($row['password']); // hash dari database
                ?>
                    <tr>
                        <td><img src="<?= $foto ?>" class="avatar-circle" alt="Foto"></td>
                        <td class="fw-semibold"><?= $nama ?></td>
                        <td><?= $username ?></td>
                        <td>
                            <span class="badge-pw" style="font-family: monospace; font-size: 0.7rem; word-break: break-all;">
                                <?= $hashPassword ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-action btn-edit edit-penulis" data-id="<?= $row['id'] ?>"><i class="bi bi-pencil"></i> Edit</button>
                            <button class="btn-action btn-delete hapus-penulis" data-id="<?= $row['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data penulis</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>