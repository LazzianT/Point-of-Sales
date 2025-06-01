
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4"><?= $judul ?></h4>
        <ul>
            <li>
                <a href="<?= base_url('dashboard') ?>" class="active">🏠 Dashboard</a>
            </li>
            <li>
                <a data-bs-toggle="collapse" href="#menuPenjualan" role="button" aria-expanded="false"
                    aria-controls="menuPenjualan">
                    💰 Penjualan
                </a>
                <ul class="collapse submenu" id="menuPenjualan">
                    <li><a href="<?= base_url('penjualan') ?>">Semua Penjualan</a></li>
                    <li><a href="<?= base_url('penjualan/laporan') ?>">Laporan Penjualan</a></li>
                    <li><a href="<?= base_url('penjualan/tambah') ?>">Tambah Penjualan</a></li>
                </ul>
            </li>
            <li>
                <a data-bs-toggle="collapse" href="#menuProduk" role="button" aria-expanded="false"
                    aria-controls="menuProduk">
                    📦 Produk
                </a>
                <ul class="collapse submenu" id="menuProduk">
                    <li><a href="<?= base_url('produk') ?>">Daftar Produk</a></li>
                    <li><a href="<?= base_url('produk/kategori') ?>">Kategori Produk</a></li>
                    <li><a href="<?= base_url('produk/tambah') ?>">Tambah Produk</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('stok') ?>">📊 Stok</a>
            </li>
            <li>
                <a href="<?= base_url('laporan') ?>">📄 Laporan</a>
            </li>
            <li>
                <a data-bs-toggle="collapse" href="#menuUsers" role="button" aria-expanded="false"
                    aria-controls="menuUsers">
                    👤 Pengguna
                </a>
                <ul class="collapse submenu" id="menuUsers">
                    <li><a href="<?= base_url('users') ?>">Daftar Pengguna</a></li>
                    <li><a href="<?= base_url('users/tambah') ?>">Tambah Pengguna</a></li>
                    <li><a href="<?= base_url('users/roles') ?>">Role & Permission</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('auth/logout') ?>">🚪 Logout</a>
            </li>
        </ul>
    </div>