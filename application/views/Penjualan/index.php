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


    <div class="row g-4">
        <!-- Tabel Produk -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Input Penjualan</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listProduk as $key => $value):
                                    ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['nama_produk'] ?></td>
                                        <td><?= $value['harga_jual'] ?></td>
                                        <td><button class="btn btn-success tambah"
                                                data-produk="<?= $value['id_produk'] ?>"><i class="fa fa-plus"></i></button>
                                        </td>
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
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Resume</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Atur</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                            <tfoot>
                                <tr id="total">
                                    <th colspan="4"><button id="submit" type="submit" class="btn btn-primary"><i
                                                class="fas fa-download"></i></button></th>
                                                <th id="grandtot"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        reloadTemporary()
    })

    $('.tambah').on('click', function () {
        var dataProduk = $(this).data('produk')

        $.ajax({
            url: '<?= base_url('Penjualan/insertTemporaryPenjualan') ?>',
            method: 'post',
            dataType: 'JSON',
            data: {
                dataProduk: dataProduk
            },
            success: function (res) {
                reloadTemporary()
            }
        })
    })



    function reloadTemporary() {
        $.ajax({
            url: '<?= base_url('Penjualan/getTemporaryPenjualan') ?>',
            dataType: 'JSON',
            success: function (data) {
                var total = 0
                let row = data.data
                $('#tbody').empty()
                $.each(row, function (index, item) {
                    $('#tbody').append(`<tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_produk}</td>
                    <td><input type='number' value='${item.qty}' class='form-control qty' data-id='${item.id_temp}'></td>
                    <td>${item.harga_jual}</td>
                    <td>${item.harga_jual * item.qty}</td>
                    <td><button class='btn btn-danger hapus' data-id='${item.id_temp}'><i class='fa fa-trash'></i></button></td>
                    </tr>`)

                    total = total + (item.qty * item.harga_jual)
                })

                $('#grandtot').html(`<div id='showTotal'>${total}</div>`)
            }
        })
    }


    $(document).on('click', '.hapus', function () {
        var id = $(this).data('id')
        $.ajax({
            url: '<?= base_url('Penjualan/delTemporaryPenjualan') ?>',
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (res) {
                reloadTemporary();
            }
        })
    })

    $(document).on('click', '#submit', function () {
    let showTotal = $('#showTotal').text();
    
    let total = parseInt(showTotal.replace(/\D/g, '')); // Buang "Rp" dan titik
    let totalRupiah = total.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });

    console.log(total)

    Swal.fire({
        title: "Pembayaran",
        text: "Total yang harus dibayar: " + totalRupiah,
        input: "number",
        inputLabel: "Jumlah yang dibayarkan",
        showCancelButton: true,
        confirmButtonText: "Submit",
        inputValidator: (value) => {
            if (!value) {
                return "Kamu Belum isi nominal";
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let nominal = parseInt(result.value);

            $.ajax({
                url: '<?= base_url('Penjualan/submitTemporaryPenjualan') ?>',
                method: 'POST',
                data: {
                    nominal: nominal,
                    total: total
                },
                dataType: 'JSON',
                success: function (res) {
                    Swal.fire({
                        title: "Transaksi berhasil",
                        icon: "success",
                        text: "Kembalian: Rp" + parseInt(res.kembalian).toLocaleString('id-ID'),
                        confirmButtonText: "Ok"
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function () {
                    Swal.fire("Gagal menyimpan data", "", "error");
                }
            });
        }
    });
});


    $(document).on('keyup', '.qty', function () {
        id = $(this).data('id');
        qtynew = $(this).val()

        $.ajax({
            url: '<?= base_url('Penjualan/updTemporaryPenjualan') ?>',
            method: 'POST',
            data: {
                id: id,
                qtynew: qtynew
            },
            dataType: 'JSON',
            success: function (res) {
                reloadTemporary()
            }
        })
    })


</script>