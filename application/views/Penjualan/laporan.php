<!-- Main Content -->
<div class="content" style="background-color: #f8f9fc; min-height: 100vh; padding: 20px;">
    <!-- Top Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm rounded mb-4 px-4 d-print-none">
        <div class="container-fluid justify-content-end">
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center text-dark text-decoration-none" href="#"
                    role="button" data-bs-toggle="dropdown">
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

    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="mb-1">Laporan Penjualan</h4>
                        <small class="text-muted">Tanggal: <?= date('d-m-Y') ?></small>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Dibayar</th>
                                    <th>Kembali</th>
                                    <th>Cek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($listPenjualan as $key => $item):
                                    $total = $total + $item['total_harga'];
                                    ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $item['tanggal'] ?></td>
                                        <td>Rp<?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($item['bayar'], 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($item['kembalian'], 0, ',', '.') ?></td>
                                        <td><button type="button" class="btn btn-primary btn-detail"
                                                data-idpenjualan="<?= $item['id_penjualan'] ?>">🔍</button></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-end">Total</th>
                                    <th>Rp<?= number_format($total, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-5 text-end">
                        <p class="mb-1">Dibuat oleh:</p>
                        <strong><?= $this->session->userdata('nama') ?></strong>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalKonfirmasiLabel">Detail Penjualan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    <tbody id="tbody"></tbody>
                    </thead>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btnKonfirmasi">Ya, Simpan</button>
            </div> -->
        </div>
    </div>
</div>


<script>

    $(document).on('click', '.btn-detail', function () {
        var idPenjualan = $(this).data('idpenjualan')
        console.log(idPenjualan)

        $.ajax({
            url: '<?= base_url('Penjualan/getPenjualanDetail') ?>',
            method: 'get',
            data: {
                idPenjualan: idPenjualan
            },
            dataType: 'JSON',
            success: function (res) {
                data = res.response
                $.each(data, function (key, value) {
                    $('#tbody').append(
                        `<tr>
                            <td>${key+1}</td>
                            <td>${value.nama_produk}</td>
                            <td>${value.satuan}</td>
                            <td>${value.harga}</td>
                            <td>${value.qty}</td>
                            <td>${(value.qty * value.harga).toLocaleString('id-ID',{
                                style:"currency",
                                currency:'IDR',
                                minimumFractionDigits:0
                            })}</td>
                        </tr>`
                    )
                })
            },
            error: function () {

            }
        })


        $('#modalKonfirmasi').modal('show');
    })
</script>