<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Produk_status extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['is_login'])) {
            redirect('login');
        } else {
            $role_id = $this->session->userdata('role_id');
            if ($role_id != 1) {
                redirect('staff/produk');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Produk Status';;
        $data['page'] = 'pages/manajer/produk_status/index';
        $data['produk_status'] = $this->produk_status->getProducts();
        $data['status'] = $this->produk_status->getStatus();
        $this->view_dashboard($data);
    }

    public function edit()
    {
        $input = (object) $this->input->post(null, true);

        if ($this->produk_status->editStatus($input) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Update status');
            redirect('manajer/produk_status');
        } else {
            $this->session->set_flashdata('error', 'Gagal Update status');
            redirect('manajer/produk_status');
        }
    }

    public function delete($id)
    {
        $this->load->model('produk_model');
        if ($this->produk_model->deleteProduct($id)) {
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
            redirect('manajer/produk_status');
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus, anda bukan Manajer!!');
            redirect('manajer/produk_status');
        }
    }
}

/* End of file Produk_status.php */
