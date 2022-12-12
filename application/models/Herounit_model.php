<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Herounit_model extends CI_Model
{

    public function getHero()
    {
        return $this->db->get_where('hero_unit', ['status_id' => 1])->result_array();
    }

    public function getAllHero()
    {
        $query = '
            SELECT h.*, s.nama as status
            FROM hero_unit h
            INNER JOIN status s ON h.status_id = s.id
        ';
        return $this->db->query($query)->result_array();
    }

    public function getHeroById($id)
    {
        return $this->db->get_where('hero_unit', ['id' => $id])->row_array();
    }

    public function createHero($input, $gambar)
    {
        $path = "assets/img/hero/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";

        if (!empty($gambar['name'])) {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('gambar')) {
                $uploadData = $this->upload->data();
                $path_file = $uploadData['file_name'];
            }
        }

        $data = [
            'label' => $input->label,
            'description' => $input->description,
            'file_foto' => $path_file,
            'status_id' => 2
        ];

        $this->db->insert('hero_unit', $data);
        return $this->db->affected_rows();
    }

    public function deleteHero($id)
    {
        $gambar = $this->getHeroById($id);
        $status = $this->getHeroById($id);
        $role = $this->session->userdata['role_id'];
        if ($status['status_id'] == 1 && $role != 1) {
            return false;
        } else {
            $this->db->where('id', $id);
            $this->db->delete('hero_unit');
            $path = "assets/img/hero/";

            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                @unlink('./' . $path . $gambar['file_foto']);
            }
            return true;
        }
    }

    public function updateHero($input, $pict)
    {
        $path = "assets/img/hero/";
        $gb = $this->getHeroById($input->id);
        $status = $this->getHeroById($input->id);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";

        if (empty($pict['name'])) {
            $path_file = $gb['file_foto'];
        } else {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('gambar')) {
                @unlink('./' . $path . $gb['file_foto']);
                $uploadData = $this->upload->data();
                $path_file = $uploadData['file_name'];
            }
        }

        $data = [
            'label' => $input->label,
            'description' => $input->description,
            'file_foto' => $path_file,
            'status_id' => $status['status_id']
        ];

        $this->db->where('id', $input->id);
        $this->db->update('hero_unit', $data);
        return $this->db->affected_rows();
    }
}
