<?php

Class produkModel extends CI_Model{
    public function getListKategori(){
        return $query = $this->db->get('kategori')->result_array();
    }

    public function getListSatuan(){
        return $query = $this->db->get('produk_satuan')->result_array();
    }
    public function getListProduk(){
        return $query = $this->db->get('produk')->result_array();
    }

    public function getDetailProduk($id){
        $query = $this->db->where('id_produk',$id);
        return $query = $this->db->query("
        SELECT a.*, b.nama_kategori FROM produk a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE a.id_produk = '$id'
        ")->result_array();

    }
}