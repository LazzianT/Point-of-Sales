

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid justify-content-end">
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($this->session->userdata('nama')) ?>&background=random"
                            class="rounded-circle me-2" width="32" height="32">
                        <span><?= $this->session->userdata('nama') ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Dashboard -->
        <h2 class="mb-4">Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm card-clickable" onclick="window.location='<?= base_url('penjualan') ?>'">
                    <div class="card-body d-flex align-items-center">
                        <div class="card-icon bg-sales me-3">💰</div>
                        <div>
                            <h6 class="text-muted mb-1">Penjualan Hari Ini</h6>
                            <h5>Rp <?= number_format($total_penjualan_hari_ini ?? 0, 0, ',', '.') ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm card-clickable" onclick="window.location='<?= base_url('produk') ?>'">
                    <div class="card-body d-flex align-items-center">
                        <div class="card-icon bg-products me-3">📦</div>
                        <div>
                            <h6 class="text-muted mb-1">Total Produk</h6>
                            <h5><?= $total_produk ?? 0 ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm card-clickable" onclick="window.location='<?= base_url('stok') ?>'">
                    <div class="card-body d-flex align-items-center">
                        <div class="card-icon bg-stock me-3">📊</div>
                        <div>
                            <h6 class="text-muted mb-1">Total Stok</h6>
                            <h5><?= $total_stok ?? 0 ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm card-clickable" onclick="window.location='<?= base_url('users') ?>'">
                    <div class="card-body d-flex align-items-center">
                        <div class="card-icon bg-users me-3">👤</div>
                        <div>
                            <h6 class="text-muted mb-1">Pengguna Aktif</h6>
                            <h5><?= $total_user ?? 0 ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Penjualan 7 Hari Terakhir</h6>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Top 5 Produk Terlaris</h6>
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    

    <!-- ChartJS -->
    <script>
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: <?= json_encode($chart_labels ?? []) ?>,
                datasets: [{
                    label: 'Penjualan',
                    data: <?= json_encode($chart_data ?? []) ?>,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } },
                responsive: true
            }
        });

        new Chart(document.getElementById('topProductsChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($produk_terlaris_nama ?? []) ?>,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: <?= json_encode($produk_terlaris_jumlah ?? []) ?>,
                    backgroundColor: '#1cc88a'
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } },
                responsive: true
            }
        });
    </script>
