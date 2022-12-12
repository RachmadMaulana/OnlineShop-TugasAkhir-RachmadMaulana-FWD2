<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_produk_model extends MY_Model
{

    public function getProdukByStatus()
    {
        return $this->db->get_where('produk', ['status_id' => 1])->result_array();
    }

    public function getProdukByKategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function getKategoriByName($name)
    {
        return $this->db->get_where('kategori', ['nama' => $name])->row_array();
    }

    public function getProdukByFilter($id, $harga)
    {

        if ($id == 'default' && $harga == 'termurah') {
            return $this->db->order_by('harga', 'ASC')->get_where('produk', ['status_id' => 1])->result_array();
        } else if ($id == 'default' && $harga == 'termahal') {
            return $this->db->order_by('harga', 'DESC')->get_where('produk', ['status_id' => 1])->result_array();
        }


        if ($harga == 'termurah') {
            return $this->db->order_by('harga', 'ASC')->get_where('produk', ['status_id' => 1, 'kategori_id' => $id])->result_array();
        } else {
            return $this->db->order_by('harga', 'DESC')->get_where('produk', ['status_id' => 1, 'kategori_id' => $id])->result_array();
        }
    }

    public function cariProduk($keyword)
    {
        $this->db->like('nama', $keyword);
        return $this->db->get_where('produk', ['status_id' => 1])->result_array();
    }
}

/* End of file Daftar_produk_model.php */
