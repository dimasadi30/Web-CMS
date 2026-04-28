<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>BlogMaster CMS | Manajemen Blog Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-body: #0b1120;
            --bg-sidebar: #111827;
            --bg-card: #1e293b;
            --surface: #1f2937;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --accent: #3b82f6;
            --accent-glow: rgba(59, 130, 246, 0.3);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --border: #334155;
            --hover-bg: #2d3a4e;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-primary);
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-sidebar);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }

        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: var(--bg-sidebar);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1030;
            border-right: 1px solid var(--border);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }

        .sidebar-header h4 {
            font-weight: 700;
            background: linear-gradient(135deg, #fff, var(--accent));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 0.5rem 1rem;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            border-radius: 16px;
            color: var(--text-secondary);
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .nav-link-custom i {
            font-size: 1.3rem;
            width: 28px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: rgba(59, 130, 246, 0.15);
            color: var(--accent);
            transform: translateX(4px);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 1.5rem 2rem;
            transition: margin 0.3s;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(to right, #e2e8f0, #94a3b8);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .btn-add-modern {
            background: linear-gradient(95deg, var(--accent), #2563eb);
            border: none;
            border-radius: 40px;
            padding: 10px 24px;
            font-weight: 600;
            color: white;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-add-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        /* CARD TABEL */
        .data-card {
            background: var(--bg-card);
            border-radius: 28px;
            border: 1px solid var(--border);
            overflow-x: auto;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
        }

        /* TABEL DARK MODERN */
        /* Tabel dark dengan teks terang */

        .table-premium,
        .table-premium tbody,
        .table-premium tr,
        .table-premium td {
            background-color: var(--bg-card) !important;
        }

        .table-premium {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--bg-card);
            color: #f1f5f9;
            /* teks putih kebiruan, kontras tinggi */
        }

        .table-premium thead tr {
            background: #0f172a;
            border-bottom: 2px solid var(--accent);
        }

        .table-premium th {
            padding: 1rem 1.2rem;
            font-weight: 600;
            color: var(--accent);
            /* biru terang untuk header */
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #0f172a;
        }

        .table-premium td:last-child {
            white-space: nowrap;
            text-align: center;
            background-color: var(--bg-card) !important;
            /* paksa background gelap */
        }

        .table-premium td:last-child .btn-action {
            display: inline-block;
            margin: 0 4px;
        }

        .table-premium tbody tr:hover td {
            background-color: var(--hover-bg);
            color: #ffffff;
            /* saat hover jadi putih */
        }

        /* Paksa semua teks di dalam tabel menggunakan warna terang (override Bootstrap) */
        .table-premium,
        .table-premium td,
        .table-premium th,
        .table-premium span,
        .table-premium .fw-semibold {
            color: #f1f5f9 !important;
            vertical-align: middle !important;
        }

        .table-premium th {
            color: var(--accent) !important;
        }

        .table-premium .badge-pw,
        .table-premium .badge-category {
            color: #f1f5f9 !important;
        }

        .table-premium .btn-edit,
        .table-premium .btn-delete {
            color: #0f172a !important;
            /* tombol edit tetap gelap */
        }

        .table-premium .btn-delete {
            color: white !important;
        }

        /* Force dark table - override Bootstrap */

        /* FOTO LINGKARAN */
        .avatar-circle {
            width: 48px;
            height: 48px;
            border-radius: 50% !important;
            object-fit: cover;
            border: 2px solid var(--accent);
            background: #1e293b;
        }

        .img-article {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        /* BADGE */
        .badge-category {
            background: #1e3a5f;
            color: #90cdf4;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
        }

        .badge-pw {
            background: #334155;
            color: #cbd5e1;
            padding: 4px 10px;
            border-radius: 30px;
            font-family: monospace;
        }

        /* TOMBOL AKSI */
        .btn-action {
            border: none;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: 0.15s;
            margin: 0 4px;
            display: inline-block;
            /* pastikan inline-block */
            line-height: 1.5;
            /* seragamkan line-height */
            min-width: 65px;
            /* beri lebar minimal agar sama */
            text-align: center;
        }

        .btn-edit {
            background: var(--warning);
            color: #0f172a;
        }

        .btn-edit:hover {
            background: #eab308;
            transform: scale(0.96);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: scale(0.96);
        }

        /* MODAL DARK */
        .modal-dark .modal-content {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 32px;
        }

        .modal-dark .modal-header {
            border-bottom-color: var(--border);
        }

        .form-control,
        .form-select {
            background: #0f172a;
            border: 1px solid var(--border);
            color: var(--text-primary);
            border-radius: 14px;
            padding: 10px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            background: #0f172a;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
            color: white;
        }

        label {
            font-weight: 500;
            margin-bottom: 6px;
            color: var(--text-secondary);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .menu-toggle-btn {
                display: block;
            }

            .table-premium th,
            .table-premium td {
                padding: 0.75rem;
                font-size: 0.8rem;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle-btn {
                display: none;
            }
        }

        .menu-toggle-btn {
            background: var(--accent);
            border: none;
            color: white;
            border-radius: 40px;
            padding: 8px 18px;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .content-article {
            line-height: 1.7;
            color: var(--text-secondary);
        }

        .content-article p {
            margin-bottom: 1rem;
        }

        .card-blog {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            transition: transform 0.2s;
        }

        .card-blog:hover {
            transform: translateY(-5px);
        }

        .badge-category {
            background: #1e3a5f;
            color: #90cdf4;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
        }

        .btn-accent {
            background: var(--accent);
            border: none;
            border-radius: 40px;
            color: white;
        }

        .btn-accent:hover {
            background: #2563eb;
        }
    </style>
</head>

<body>
    <div class="app-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4><i class="bi bi-pen-fill me-2"></i>BlogMaster</h4>
                <p class="small text-secondary mb-0">Content Management System</p>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <div class="nav-link-custom menu-link" data-menu="blog">
                        <i class="bi bi-eye-fill"></i> <span>Lihat Blog</span>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link-custom menu-link" data-menu="penulis"><i class="bi bi-people-fill"></i> <span>Kelola Penulis</span></div>
                </li>
                <li class="nav-item">
                    <div class="nav-link-custom menu-link" data-menu="artikel"><i class="bi bi-journal-bookmark-fill"></i> <span>Kelola Artikel</span></div>
                </li>
                <li class="nav-item">
                    <div class="nav-link-custom menu-link" data-menu="kategori"><i class="bi bi-tags-fill"></i> <span>Kelola Kategori</span></div>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="d-flex align-items-center gap-3">
                    <button class="menu-toggle-btn" id="mobileMenuToggle"><i class="bi bi-list"></i> Menu</button>
                    <h1 class="page-title" id="pageTitle">Kelola Penulis</h1>
                </div>
                <button id="globalTambahBtn" class="btn-add-modern"><i class="bi bi-plus-lg"></i> Tambah Data</button>
            </div>
            <div class="data-card">
                <div id="dynamicTable" class="p-0">
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-3 text-secondary">Memuat data...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade modal-dark" id="globalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Form Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="mainForm" enctype="multipart/form-data">
                        <input type="hidden" id="formId" name="id">
                        <div id="formDynamicFields"></div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentMenu = 'penulis';
        const modal = new bootstrap.Modal(document.getElementById('globalModal'));

        function escapeAttr(str) {
            if (!str) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function escapeTextarea(str) {
            if (!str) return '';
            return str.replace(/<\/textarea/gi, '<\\/textarea');
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            }).replace(/"/g, '&quot;');
        }

        function loadMenu(menu) {
            currentMenu = menu;
            let url = '',
                title = '';
            if (menu === 'penulis') {
                url = 'ambil_penulis.php';
                title = 'Kelola Penulis';
            } else if (menu === 'artikel') {
                url = 'ambil_artikel.php';
                title = 'Kelola Artikel';
            } else if (menu === 'kategori') {
                url = 'ambil_kategori.php';
                title = 'Kelola Kategori';
            } else if (menu === 'blog') {
                url = 'ambil_blog.php';
                title = 'Lihat Blog';
            }

            // Sembunyikan atau tampilkan tombol Tambah Data berdasarkan menu
            const tambahBtn = document.getElementById('globalTambahBtn');
            if (menu === 'blog') {
                tambahBtn.style.display = 'none';
            } else {
                tambahBtn.style.display = 'block';
            }

            document.getElementById('pageTitle').innerText = title;
            document.getElementById('dynamicTable').innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary"></div><p>Memuat...</p></div>';
            fetch(url)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('dynamicTable').innerHTML = html;
                    if (menu === 'blog') attachBlogEvents();
                    else attachTableEvents();
                });
        }

        // Tambahkan fungsi ini
        function attachBlogEvents() {
            document.querySelectorAll('.btn-read-blog').forEach(btn => {
                btn.removeEventListener('click', handleReadClick);
                btn.addEventListener('click', handleReadClick);
            });
        }

        function handleReadClick(e) {
            const id = this.getAttribute('data-id');
            showDetailBlog(id);
        }


        function attachTableEvents() {
            document.querySelectorAll('.edit-penulis').forEach(btn => btn.addEventListener('click', () => editPenulis(btn.dataset.id)));
            document.querySelectorAll('.hapus-penulis').forEach(btn => btn.addEventListener('click', () => hapusPenulis(btn.dataset.id)));
            document.querySelectorAll('.edit-artikel').forEach(btn => btn.addEventListener('click', () => editArtikel(btn.dataset.id)));
            document.querySelectorAll('.hapus-artikel').forEach(btn => btn.addEventListener('click', () => hapusArtikel(btn.dataset.id)));
            document.querySelectorAll('.edit-kategori').forEach(btn => btn.addEventListener('click', () => editKategori(btn.dataset.id)));
            document.querySelectorAll('.hapus-kategori').forEach(btn => btn.addEventListener('click', () => hapusKategori(btn.dataset.id)));
        }

        //DETAIL BLOG
        function showDetailBlog(id) {
            fetch(`ambil_detail_blog.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const modalBody = document.getElementById('modalDetailBody');
                        modalBody.innerHTML = `
                    <img src="${data.gambar}" class="img-fluid rounded mb-3" style="max-height: 300px; width: 100%; object-fit: cover;">
                    <h3>${escapeHtml(data.judul)}</h3>
                    <div class="d-flex gap-3 mb-3 text-secondary small">
                        <span><i class="bi bi-person-circle"></i> ${escapeHtml(data.penulis)}</span>
                        <span><i class="bi bi-calendar"></i> ${escapeHtml(data.tanggal)}</span>
                        <span><i class="bi bi-tag"></i> ${escapeHtml(data.kategori)}</span>
                    </div>
                    <div class="content-article">${data.isi}</div>
                `;
                        new bootstrap.Modal(document.getElementById('detailModal')).show();
                    } else {
                        alert(data.message);
                    }
                });
        }

        // PENULIS
        function editPenulis(id) {
            fetch(`ambil_satu_penulis.php?id=${id}`).then(res => res.json()).then(data => {
                if (data.status === 'success') showPenulisForm(data.data);
                else alert(data.message);
            });
        }

        function hapusPenulis(id) {
            if (confirm('Yakin hapus penulis?')) fetch('hapus_penulis.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`
            }).then(res => res.json()).then(data => {
                alert(data.message);
                if (data.status === 'success') loadMenu('penulis');
            });
        }

        function showPenulisForm(data = null) {
            document.getElementById('modalTitle').innerHTML = `<i class="bi bi-person-badge"></i> ${data?'Edit Penulis':'Tambah Penulis'}`;
            let fotoPreview = (data && data.foto) ? `<img src="uploads_penulis/${escapeAttr(data.foto)}" class="avatar-circle mt-2">` : '';
            document.getElementById('formDynamicFields').innerHTML = `
            <div class="mb-3"><label>Nama Depan</label><input type="text" name="nama_depan" class="form-control" value="${data?escapeAttr(data.nama_depan):''}" required></div>
            <div class="mb-3"><label>Nama Belakang</label><input type="text" name="nama_belakang" class="form-control" value="${data?escapeAttr(data.nama_belakang):''}" required></div>
            <div class="mb-3"><label>Username</label><input type="text" name="user_name" class="form-control" value="${data?escapeAttr(data.user_name):''}" required></div>
            <div class="mb-3"><label>Password ${data?'(Kosongkan jika tidak diubah)':''}</label><input type="password" name="password" class="form-control" ${data?'':'required'}></div>
            <div class="mb-3"><label>Foto Profil</label><input type="file" name="foto" class="form-control" accept="image/*">${fotoPreview}</div>
        `;
            document.getElementById('formId').value = data ? data.id : '';
            const form = document.getElementById('mainForm');
            form.onsubmit = (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                fetch(data ? 'update_penulis.php' : 'simpan_penulis.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json()).then(resp => {
                        alert(resp.message);
                        if (resp.status === 'success') {
                            modal.hide();
                            loadMenu('penulis');
                        }
                    });
            };
            modal.show();
        }

        // KATEGORI
        function editKategori(id) {
            fetch(`ambil_satu_kategori.php?id=${id}`).then(res => res.json()).then(data => {
                if (data.status === 'success') showKategoriForm(data.data);
                else alert(data.message);
            });
        }

        function hapusKategori(id) {
            if (confirm('Yakin hapus kategori?')) fetch('hapus_kategori.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`
            }).then(res => res.json()).then(data => {
                alert(data.message);
                if (data.status === 'success') loadMenu('kategori');
            });
        }

        function showKategoriForm(data = null) {
            document.getElementById('modalTitle').innerHTML = `<i class="bi bi-tag"></i> ${data?'Edit Kategori':'Tambah Kategori'}`;
            document.getElementById('formDynamicFields').innerHTML = `
            <div class="mb-3"><label>Nama Kategori</label><input type="text" name="nama_kategori" class="form-control" value="${data?escapeAttr(data.nama_kategori):''}" required></div>
            <div class="mb-3"><label>Keterangan</label><textarea name="keterangan" class="form-control" rows="3">${data?escapeTextarea(data.keterangan):''}</textarea></div>
        `;
            document.getElementById('formId').value = data ? data.id : '';
            const form = document.getElementById('mainForm');
            form.onsubmit = (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                fetch(data ? 'update_kategori.php' : 'simpan_kategori.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json()).then(resp => {
                        alert(resp.message);
                        if (resp.status === 'success') {
                            modal.hide();
                            loadMenu('kategori');
                        }
                    });
            };
            modal.show();
        }

        // ARTIKEL
        function editArtikel(id) {
            fetch(`ambil_satu_artikel.php?id=${id}`).then(res => res.json()).then(data => {
                if (data.status === 'success') showArtikelForm(data.data);
                else alert(data.message);
            });
        }

        function hapusArtikel(id) {
            if (confirm('Yakin hapus artikel?')) fetch('hapus_artikel.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`
            }).then(res => res.json()).then(data => {
                alert(data.message);
                if (data.status === 'success') loadMenu('artikel');
            });
        }

        function showArtikelForm(data = null) {
            Promise.all([fetch('daftar_penulis_json.php').then(r => r.json()), fetch('daftar_kategori_json.php').then(r => r.json())])
                .then(([penulisList, kategoriList]) => {
                    let gambarPreview = (data && data.gambar) ? `<img src="uploads_artikel/${escapeAttr(data.gambar)}" class="img-article mt-2">` : '';
                    document.getElementById('modalTitle').innerHTML = `<i class="bi bi-file-text"></i> ${data?'Edit Artikel':'Tambah Artikel'}`;
                    document.getElementById('formDynamicFields').innerHTML = `
                <div class="mb-3"><label>Judul</label><input type="text" name="judul" class="form-control" value="${data?escapeAttr(data.judul):''}" required></div>
                <div class="mb-3"><label>Isi</label><textarea name="isi" class="form-control" rows="5" required>${data?escapeTextarea(data.isi):''}</textarea></div>
                <div class="mb-3"><label>Penulis</label><select name="id_penulis" class="form-select" required>
                    <option value="">Pilih</option>${penulisList.map(p=>`<option value="${p.id}" ${data && data.id_penulis==p.id?'selected':''}>${escapeHtml(p.nama_depan)} ${escapeHtml(p.nama_belakang)}</option>`).join('')}
                </select></div>
                <div class="mb-3"><label>Kategori</label><select name="id_kategori" class="form-select" required>
                    <option value="">Pilih</option>${kategoriList.map(k=>`<option value="${k.id}" ${data && data.id_kategori==k.id?'selected':''}>${escapeHtml(k.nama_kategori)}</option>`).join('')}
                </select></div>
                <div class="mb-3"><label>Gambar ${data?'(Kosongkan jika tidak ganti)':'(Wajib)'}</label><input type="file" name="gambar" class="form-control" accept="image/*" ${data?'':'required'}>${gambarPreview}</div>
            `;
                    document.getElementById('formId').value = data ? data.id : '';
                    const form = document.getElementById('mainForm');
                    form.onsubmit = (e) => {
                        e.preventDefault();
                        const fileInput = form.querySelector('input[name="gambar"]');
                        if (!data && (!fileInput.files || fileInput.files.length === 0)) {
                            alert('Gambar wajib diupload');
                            return;
                        }
                        const formData = new FormData(form);
                        fetch(data ? 'update_artikel.php' : 'simpan_artikel.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(res => res.json()).then(resp => {
                                alert(resp.message);
                                if (resp.status === 'success') {
                                    modal.hide();
                                    loadMenu('artikel');
                                }
                            });
                    };
                    modal.show();
                });
        }

        document.getElementById('globalTambahBtn').addEventListener('click', () => {
            if (currentMenu === 'penulis') showPenulisForm();
            else if (currentMenu === 'artikel') showArtikelForm();
            else showKategoriForm();
        });
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', (e) => {
                loadMenu(link.dataset.menu);
                if (window.innerWidth <= 768) document.getElementById('sidebar').classList.remove('open');
                document.querySelectorAll('.nav-link-custom').forEach(nav => nav.classList.remove('active'));
                link.classList.add('active');
            });
        });
        document.getElementById('mobileMenuToggle')?.addEventListener('click', () => document.getElementById('sidebar').classList.toggle('open'));
        loadMenu('penulis');
        document.querySelector('.menu-link[data-menu="penulis"]').classList.add('active');
    </script>
    <!-- Modal Detail Artikel -->
    <div class="modal fade modal-dark" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Artikel</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalDetailBody">
                    <p>Memuat...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>