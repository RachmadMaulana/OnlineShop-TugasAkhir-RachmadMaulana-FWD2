<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Produk_status_model extends MY_Model
{

    public function getProducts()
    {
        $query = 'SELECT p.*, s.nama as status
        FROM produk p 
        INNER JOIN status s ON p.status_id = s.id
        ORDER BY p.status_id DESC';

        return $this->db->query($query)->result_array();
    }

    public function getStatus()
    {
        return $this->db->get('status')->result_array();
    }

    public function editStatus($input)
    {
        $data = [
            'status_id' => $input->status
        ];

        $this->db->where('id', $input->id);
        $this->db->update('produk', $data);
        return $this->db->affected_rows();
    }
}

/* End of file Produk_status_model.php */
