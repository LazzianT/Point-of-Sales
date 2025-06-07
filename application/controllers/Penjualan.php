<?php
class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['judul'] = 'Warung';
        $this->load->model('produkModel');
        $data['listProduk'] = $this->produkModel->getListProduk();

        $this->load->view('Template/header', $data);
        $this->load->view('Template/sidebar', $data);
        $this->load->view('Penjualan/index', $data);
        $this->load->view('Template/footer');
    }

    public function insertTemporaryPenjualan()
    {

        $dataProduk = $this->input->post('dataProduk');
        $session_id = $this->session->userdata('username');
        // cari dulu ada ga ni barang yang sama
        $cari = $this->db->query("SELECT id_produk FROM temporary_penjualan WHERE id_produk = '$dataProduk' AND session_id = '$session_id'")->num_rows();
        if ($cari > 0) {

            $this->db->set('qty', 'qty + 1', false);
            $update = $this->db->where('id_produk', $dataProduk);
            $update = $this->db->update('temporary_penjualan');


            if ($update) {
                echo json_encode(array('status' => 1));
            }
        } else {
            $finding = $this->db->query("SELECT * FROM produk WHERE id_produk = '$dataProduk'")->result_array();

            $forInsert = [
                'id_temp' => '',
                'session_id' => $this->session->userdata('username'),
                'id_produk' => $finding[0]['id_produk'],
                'harga_jual' => $finding[0]['harga_jual'],
                'qty' => 1,
            ];

            $Insert = $this->db->insert('temporary_penjualan', $forInsert);

            if ($Insert) {
                echo json_encode(array('status' => 1, 'ini' => 'insert'));
            }
        }



    }

    public function getTemporaryPenjualan()
    {
        $sess_id = $this->session->userdata('username');
        $data['getListTemporary'] = $this->db->query("SELECT a.*, b.nama_produk FROM temporary_penjualan a LEFT JOIN produk b ON a.id_produk = b.id_produk WHERE session_id = '$sess_id'")->result_array();

        echo json_encode(array('data' => $data['getListTemporary']));
    }

    public function delTemporaryPenjualan()
    {
        $id_temp = $this->input->post('id');
        $this->db->where('id_temp', $id_temp);
        $query = $this->db->delete('temporary_penjualan');

        if ($query) {
            echo json_encode(array("res" => 'success'));
        } else {
            echo json_encode(array("res" => 'error'));
        }
    }

    public function updTemporaryPenjualan()
    {
        $id_temp = $this->input->post('id');
        $qtyNew = $this->input->post('qtynew');

        $this->db->set('qty', $qtyNew);
        $this->db->where('id_temp', $id_temp);
        $update = $this->db->update('temporary_penjualan');
        if ($update) {
            echo json_encode(array('res' => 'success'));
        }
    }

    public function submitTemporaryPenjualan()
    {

        $session_id = $this->session->userdata('username');
        $bayar = $this->input->post('nominal');
        $total_harga = $this->input->post('total');
        $datetime = date('Y-m-d H:i:s');
        $bin2hex = bin2hex($session_id . '|' . $datetime);

        $kembalian = $bayar - $total_harga;

        // Submit untuk Headernya dulu
        $header = array(
            'id_penjualan' => '',
            'kode_penjualan' => $bin2hex,
            'tanggal' => $datetime,
            'id_user' => $session_id,
            'total_harga' => $total_harga,
            'bayar' => $bayar,
            'kembalian' => $kembalian
        );

        $this->db->insert('penjualan', $header);


        //CARI HEADER PENJUALAN UNTUK TIINPUT KE DETAIL
        $cari_header = $this->db->query("SELECT * FROM penjualan WHERE kode_penjualan = '$bin2hex'")->result_array();
        $id_header = $cari_header[0]['id_penjualan'];


        // CARI DATA TEMPORARY BASED ON SESSION UNTUK DIINPUT KE DETAIL PAKE LOOPING
        $temporary = $this->db->query("SELECT * FROM temporary_penjualan WHERE session_id = '$session_id'")->result_array();

        foreach ($temporary as $key => $value):
            $forInsert = [
                'id_detail' => '',
                'id_penjualan' => $id_header,
                'id_produk' => $value['id_produk'],
                'harga' => $value['harga_jual'],
                'qty' => $value['qty']
            ];

            $this->db->insert('penjualan_detail', $forInsert);


            // UPDATE STOK
            $this->db->set('stok', 'stok - ' . $value['qty'], FALSE);
            $this->db->where('id_produk', $value['id_produk']);
            $this->db->update('produk');

        endforeach;

        // JANGAN LUPA DI APUS KING DI TEMPORARYNYA
        $this->db->where('session_id', $session_id);
        $this->db->delete('temporary_penjualan');

        echo json_encode(array('res' => 'sukses', 'kembalian' => $kembalian));
    }
}
?>