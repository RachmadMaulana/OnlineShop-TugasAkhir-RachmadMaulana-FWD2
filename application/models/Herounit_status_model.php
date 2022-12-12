<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Herounit_status_model extends MY_Model
{

    public function getHero()
    {
        $query = 'SELECT h.*, s.nama as status
        FROM hero_unit h
        INNER JOIN status s ON h.status_id = s.id
        ORDER BY h.status_id DESC';

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
        $this->db->update('hero_unit', $data);
        return $this->db->affected_rows();
    }
}

/* End of file Herounit_status_model.php */
