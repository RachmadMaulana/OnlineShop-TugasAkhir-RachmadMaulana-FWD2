<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends MY_Model
{

    protected $table = 'produk';

    public function getAllProduct()
    {
        $query = 'SELECT p.nama,p.id,s.nama as status,k.nama as kategori
        FROM produk p
        INNER JOIN kategori k ON p.kategori_id = k.id
        INNER JOIN status s ON p.status_id = s.id;';
        return $this->db->query($query)->result_array();
    }

    public function getProducts()
    {
        return $this->db->get('produk')->result_array();
    }

    public function jumlahProduk()
    {
        return $this->db->get('produk')->num_rows();
    }

    public function jumlahHero()
    {
        return $this->db->get('hero_unit')->num_rows();
    }

    public function jumlahProdukSetuju()
    {
        return $this->db->get_where('produk', ['status_id' => 1])->num_rows();
    }

    public function jumlahHeroSetuju()
    {
        return $this->db->get_where('hero_unit', ['status_id' => 1])->num_rows();
    }

    public function getKategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function getProductById($id)
    {
        return $this->db->get_where('produk', ['id' => $id])->row_array();
    }

    public function createProduct($input, $gambar)
    {
        $path = "assets/img/upload/";

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
            'nama' => $input->nama,
            'harga' => $input->harga,
            'gambar' => $path_file,
            'kategori_id' => $input->kategori,
            'kondisi' => $input->kondisi,
            'Berat_satuan' => $input->berat_satuan,
            'status_id' =>  2,
            'deskripsi' => $input->deskripsi,
            'created_at' => $input->tanggal
        ];

        $this->db->insert('produk', $data);
        return $this->db->affected_rows();
    }

    public function deleteProduct($id)
    {
        $gambar = $this->getProductById($id);
        $status = $this->getProductById($id);
        $role = $this->session->userdata('role_id');

        if ($status['status_id'] == 1 && $role != 1) {
            return false;;
        } else {
            $this->db->where('id', $id);
            $this->db->delete('produk');
            $path = "assets/img/upload/";
            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                @unlink('./' . $path . $gambar['gambar']);
            }
            return true;
        }
    }

    public function updateProduct($input, $pict)
    {
        $path = "assets/img/upload/";
        $gb = $this->getProductById($input->id);
        $status = $this->getProductById($input->id);
        $gambar = $gb['gambar'];

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path_file = "";

        if (empty($pict['name'])) {
            $path_file = $gambar;
        } else {
            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = "jpg|png|jpeg";
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('gambar')) {
                @unlink('./' . $path . $gb['gambar']);
                $uploadData = $this->upload->data();
                $path_file = $uploadData['file_name'];
            }
        }

        $data = [
            'nama' => $input->nama,
            'harga' => $input->harga,
            'gambar' => $path_file,
            'kategori_id' => $input->kategori,
            'kondisi' => $input->kondisi,
            'Berat_satuan' => $input->berat_satuan,
            'status_id' => $status['status_id'],
            'deskripsi' => $input->deskripsi,
            'created_at' => $input->tanggal
        ];

        $this->db->where('id', $input->id);
        $this->db->update('produk', $data);
        return $this->db->affected_rows();
    }
}

/* End of file Produk_model.php */
