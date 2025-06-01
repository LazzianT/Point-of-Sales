<!-- Main Content -->
<div class="content" style="background-color: #f8f9fc; min-height: 100vh; padding: 20px;">
    <!-- Top Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm rounded mb-4 px-4">
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

    <!-- Judul Halaman -->
    <h2 class="mb-4 text-dark"><?= $clicked ?></h2>

    <div class="row g-4">
        <!-- Tabel Produk -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Daftar Kategori</h5>
                        <button id="modalTambahProduk" class="btn btn-success btn-sm shadow-sm"><i
                                class="fa fa-plus me-1"></i>Tambah Kategori</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white" id="tabelProduk">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($listKategori as $key=>$value):
                                ?>
                                <tr class="text-center" onclick="tabelClicked('ss')">
                                    <td><?= $key+1?></td>
                                    <td><?= $value['id_kategori']?></td>
                                    <td><?= $value['nama_kategori']?></td>
                                </tr>
                                <?php

                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Penjualan -->
        <!-- <div class="col-md-3">
            <div class="card shadow-sm border-0 card-clickable" style="cursor:pointer;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
                        style="width: 48px; height: 48px; font-size: 1.5rem;">
                        📦
                    </div>
                    <div>
                        <div class="text-muted big">Detail Barang</div>
                        <h5 class="mb-0">Rp <?= number_format($total_penjualan_hari_ini ?? 0, 0, ',', '.') ?></h5>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>


<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalFormKategori" tabindex="-1" aria-labelledby="modalFormKategoriLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalFormKategoriLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="tambahKategori">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#tabelProduk').DataTable()

    $('#modalTambahProduk').on('click', function () {
        var modalTambah = new bootstrap.Modal('#modalFormKategori')
        modalTambah.show()
    })

    function tabelClicked() {

    }

    $('#tambahKategori').on('submit', function(e){
        e.preventDefault()
        var data = $(this).serialize()
        $.ajax({
            url:'<?= base_url('Produk/kategoriSimpan')?>',
            method:'post',
            dataType:'JSON',
            data:data,
            success:function(response){
                Swal.fire({
                        title:'Kategori Berhasil disimpan',
                        icon:'success'
                })
                setTimeout(function(){
                    location.reload();
                },1000)
            }
        })
    })
</script>