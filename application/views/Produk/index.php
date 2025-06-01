<!-- Main Content -->
<div class="content" style="background-color: #f8f9fc; min-height: 100vh; padding: 20px;">
  <!-- Top Navbar -->
  <nav class="navbar navbar-light bg-white shadow-sm rounded mb-4 px-4">
    <div class="container-fluid justify-content-end">
      <div class="dropdown">
        <a class="dropdown-toggle d-flex align-items-center text-dark text-decoration-none" href="#" role="button"
          data-bs-toggle="dropdown">
          <img
            src="https://ui-avatars.com/api/?name=<?= urlencode($this->session->userdata('nama')) ?>&background=random"
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
            <h5 class="mb-0">Daftar Produk</h5>
            <button id="modalTambahProduk" class="btn btn-success btn-sm shadow-sm"><i
                class="fa fa-plus me-1"></i>Tambah Produk</button>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="tabelProduk">
              <thead class="table-light text-center">
                <tr>
                  <th>No</th>
                  <th>Barcode</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Harga Produk</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($listProduk as $key => $value):
                  ?>
                  <tr class="text-center" onclick="tabelClicked(<?= $value['id_produk'] ?>)">
                    <td><?= $key + 1 ?></td>
                    <td><img src="<?= base_url('assets/image/barcodeProduk/') . $value['barcode'] ?>" alt=""></td>
                    <td><?= $value['id_produk'] ?></td>
                    <td><?= $value['nama_produk'] ?></td>
                    <td>Rp. <?= number_format($value['harga_jual'], 0, 2) ?></td>
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
    <div class="col-md-3">
      <div class="card shadow-sm border-0 card-clickable" style="cursor:pointer;">
        <div class="card-header d-flex align-items-center" style="background-color:#A4CCD9;">
          <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
            style="width: 48px; height: 48px; font-size: 1.5rem;">
            📦
          </div>
          <div>
            <h5 class="mb-0">Detail Barang</h5>
          </div>
        </div>
        <div class="card-body d-flex align-items-center">
            <div class="flex-grow-1">
          <h6 class="fw-bold mb-1" id="showNamaProduk">Nama Produk</h6>
          <p class="mb-1 text-muted small" id="showidProduk">ID Produk: PRD001</p>
          <p class="mb-1 text-muted small" id="showsatuanProduk">Satuan: PCS</p>
          <p class="mb-1 text-muted small" >Harga Jual:</p>
          <h6 class="text-success" id="showharga_jualProduk">Rp 25.000</h6>
          <div id="showBarcode"></div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalFormProduk" tabindex="-1" aria-labelledby="modalFormProdukLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <div class="modal-header" style="background-color: cadetblue; font-weight: bold; color: white;">
        <h5 class="modal-title" id="modalFormProdukLabel">Tambah Produk 📦</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="produkSimpan">
        <div class="modal-body">

          <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
          </div>

          <div class="mb-3">
            <label for="harga_display" class="form-label">Harga Produk</label>
            <input type="text" class="form-control" id="harga_display" placeholder="Rp 0">
            <input type="hidden" id="harga" name="harga" required>
          </div>

          <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <br>
            <select name="satuan" id="satuan" class="form-select" required>
              <option value="">Pilih Satuan</option>
              <?php
              foreach ($listSatuan as $key => $value):
                ?>
                <option value="<?= $value['satuan'] ?>"><?= $value['satuan'] ?></option>
                <?php
              endforeach;
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
              <option value="">Pilih Kategori</option>
              <?php
              foreach ($listKategori as $key => $value):
                ?>
                <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                <?php
              endforeach
              ?>
              <!-- Tambahkan kategori lainnya jika perlu -->
            </select>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn"
            style="border-radius: 5px; background-color: cadetblue; color: white; font-weight: bold;">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $('#tabelProduk').DataTable()


  $('#modalTambahProduk').on('click', function () {
    // Tampilkan modal
    var modalTambah = new bootstrap.Modal(document.getElementById('modalFormProduk'));
    modalTambah.show();

    // Inisialisasi Select2 setelah modal muncul
    setTimeout(function () {
      $('#kategori').select2({
        dropdownParent: $('#modalFormProduk') // penting agar dropdown muncul di atas modal
      });
    }, 200);

    $('#satuan').select2({
      dropdownParent: $('#modalFormProduk')
    })
  });




  function tabelClicked(id) {
    var id = id

    $.ajax({
      url: '<?= base_url('Produk/getDetailProduk') ?>',
      method: 'GET',
      dataType: 'JSON',
      data: {
        id: id
      },
      success: function (response) {
        let data = response.data
        $('#showNamaProduk').text(data.nama_produk)
        $('#showidProduk').text(data.id_produk)
        $('#showsatuanProduk').text(data.satuan)
        $('#showharga_jualProduk').text(data.harga_jual)
        $('#showBarcode').html(`<img src='<?= base_url('assets/image/barcodeProduk/')?>${data.barcode}'>`)
      }
    })
  }


  const hargaDisplay = document.getElementById('harga_display');
  const hargaAsli = document.getElementById('harga');

  hargaDisplay.addEventListener('input', function () {
    let angka = hargaDisplay.value.replace(/[^\d]/g, ''); // Hanya angka
    let angkaInt = parseInt(angka || 0);
    hargaAsli.value = angkaInt; // Set nilai hidden input

    // Format angka jadi Rupiah
    hargaDisplay.value = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(angkaInt);
  });


  $('#produkSimpan').on('submit', function (e) {
    e.preventDefault()
    var data = $(this).serialize()
    console.log(data)

    $.ajax({
      url: '<?= base_url('Produk/produkSimpan') ?>',
      method: 'post',
      dataType: 'JSON',
      data: data,
      success: function (response) {

        Swal.fire({
          title: 'Berhasil Masuk',
          icon: 'success'
        })

        setTimeout(function () {
          window.location.reload();
        }, 1000)

      }
    })
  })
</script>