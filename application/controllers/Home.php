<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('daftar_produk_model');
    }


    public function index()
    {
        $data['title'] = 'Homepage';
        $data['page'] = 'pages/home/index';
        $data['hero'] = $this->Herounit_model->getHero();
        $data['daftar_produk'] = $this->daftar_produk_model->getProdukByStatus();
        $this->view_home($data);
    }

    public function daftarProduk()
    {
        $data['title'] = 'Daftar Produk';
        $data['page'] = 'pages/home/produk';
        $data['daftar_produk'] = $this->daftar_produk_model->getProdukByStatus();
        $keyword = $this->input->post('keyword');
        if ($keyword) {
            $data['daftar_produk'] = $this->daftar_produk_model->cariProduk($keyword);
        }

        $data['kategori'] = $this->daftar_produk_model->getProdukByKategori();
        $this->view_home($data);
    }

    public function filter()
    {
        $nama_kategori = $this->input->get('kategori');
        $kategori = $this->daftar_produk_model->getKategoriByName($nama_kategori);
        $harga = $this->input->get('harga');

        if ($harga == "default" && $nama_kategori == "default") {
            redirect('home/daftarProduk');
            return;
        } else {
            if ($nama_kategori == 'default') {
                $data['daftar_produk'] = $this->daftar_produk_model->getProdukByFilter($nama_kategori, $harga);
            } else {
                $data['daftar_produk'] = $this->daftar_produk_model->getProdukByFilter($kategori['id'], $harga);
            }

            $data['title'] = 'Daftar Produk';
            $data['page'] = 'pages/home/produk';
            $data['kategori'] = $this->daftar_produk_model->getProdukByKategori();
        }
        $this->view_home($data);
    }
}

/* End of file Home.php */
