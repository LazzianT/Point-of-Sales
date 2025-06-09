<?php
class penjualanModel extends CI_Model
{
    public function listPenjualan()
    {
        return $this->db->get('penjualan')->result_array();
    }

    public function detailPenjualan($id)
    {
        return $this->db->query("
       SELECT a.*,b.nama_produk,b.satuan,c.nama FROM penjualan_detail a 
        LEFT JOIN produk b ON a.id_produk = b.id_produk 
        LEFT JOIN penjualan d ON a.id_penjualan = d.id_penjualan
        LEFT JOIN users c ON d.id_user = c.id_user WHERE a.id_penjualan = '$id'
        ")->result_array();
    }
}
?>