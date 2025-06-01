<?php

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['judul'] = "Warung";
        $data['clicked'] = "Daftar Produk";
        
        // panggil model
        $this->load->model('produkModel');

        // selectnya dimari
        $data['listKategori'] = $this->produkModel->getListKategori();
        $data['listSatuan'] = $this->produkModel->getListSatuan();
        $data['listProduk'] = $this->produkModel->getListProduk();


        $this->load->view('Template/header', $data);
        $this->load->view('Template/sidebar', $data);
        $this->load->view('Produk/index', $data);
        $this->load->view('Template/footer');
    }
    public function kategori()
    {
        $data['judul'] = "Warung";
        $data['clicked'] = "Daftar Kategori Produk";
        $this->load->model('produkModel');
        $data['listKategori'] = $this->produkModel->getListKategori();
        $this->load->view('Template/header', $data);
        $this->load->view('Template/sidebar', $data);
        $this->load->view('Produk/kategori', $data);
        $this->load->view('Template/footer');
    }

    public function kategoriSimpan()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        $forInsert = array(
            'nama_kategori' => $nama_kategori,
            'counter' => 1
        );

        if ($this->db->insert('kategori', $forInsert)) {
            echo json_encode(array('response' => 1));
        } else {
            echo json_encode(array('response' => 0));
        }
    }


    public function produkSimpan()
    {
        $nama_produk = $this->input->post('nama_produk');
        $harga = $this->input->post('harga');
        $satuan = $this->input->post('satuan');
        $stok = $this->input->post('stok');
        $kategori = $this->input->post('kategori');

        $forInsert = [
            "nama_produk" => $nama_produk,
            "id_kategori" => $kategori,
            "satuan" => $satuan,
            "harga_jual" => $harga,
            "stok" => $stok,
        ];

        if ($this->db->insert('produk', $forInsert)) {
            $find = $this->db->where('barcode','');
            $find = $this->db->get('produk')->result_array();
            $id_produk = $find[0]['id_produk'];
            // echo $id_produk;
            $this->db->query("UPDATE produk SET barcode = '$id_produk.png' WHERE id_produk = '$id_produk'");
            $barcode = $this->set_barcode($id_produk);
            // var_dump($barcode);
            



            echo json_encode(array("response" => 1));
        } else {
            echo json_encode(array("response" => 0));
        }
    }

    public function set_barcode($code)
    {
        // Load library
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');

        // Path tempat menyimpan barcode
        $barcodePath = FCPATH . 'assets/image/barcodeProduk/' . $code . '.png';

        // Generate barcode sebagai image resource
        $barcodeImage = Zend_Barcode::draw('code128', 'image', ['text' => $code], []);

        // Simpan ke file PNG
        imagepng($barcodeImage, $barcodePath);
        imagedestroy($barcodeImage);
    }

    public function getDetailProduk(){
        $id = $this->input->get('id');
        $this->load->model('produkModel');
        $data['detailProduk'] = $this->produkModel->getDetailProduk($id);

        // var_dump($data['detailProduk']);
        echo json_encode(array("data" => $data['detailProduk'][0]));
    }

}