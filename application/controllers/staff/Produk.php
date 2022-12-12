<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['is_login'])) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Produk';
        $data['page'] = 'pages/staff/produk/index';
        $data['produk'] = $this->produk->getAllProduct();
        $data['kategori'] = $this->produk->getKategori();
        $data['products'] = $this->produk->getProducts();
        $this->view_dashboard($data);
    }

    public function create()
    {

        if (empty($_POST)) {
            redirect('staff/produk');
        }

        $input = (object) $this->input->post(null, true);
        $gambar = $_FILES['gambar'];

        if ($this->produk->createProduct($input, $gambar) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Ditambahkan');
            redirect('staff/produk');
        } else {
            $this->session->set_flashdata('error', 'Gagal Ditambahkan');
        }
    }

    public function delete($id)
    {
        if ($this->produk->deleteProduct($id)) {
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
            redirect('staff/produk');
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus, anda bukan Manajer!!');
            redirect('staff/produk');
        }
    }

    public function edit()
    {
        if (empty($_POST)) {
            redirect('staff/produk');
        }

        $input = (object) $this->input->post(null, true);
        $gambar = $_FILES['gambar'];

        if ($this->produk->updateProduct($input, $gambar) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect('staff/produk');
        } else {
            $this->session->set_flashdata('error', 'Gagal Diedit');
        }
    }
}

/* End of file Produk.php */
