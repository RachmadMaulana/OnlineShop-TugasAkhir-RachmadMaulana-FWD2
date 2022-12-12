<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
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
        $this->load->model('Produk_model');
        $data['title'] = 'Dashboard';
        $data['page'] = 'pages/dashboard/index';
        $data['jumlah_produk'] = $this->Produk_model->jumlahProduk();
        $data['jumlah_hero'] = $this->Produk_model->jumlahHero();
        $data['jumlah_produk_setuju'] = $this->Produk_model->jumlahProdukSetuju();
        $data['jumlah_hero_setuju'] = $this->Produk_model->jumlahHeroSetuju();
        $this->view_dashboard($data);
    }
}

/* End of file Dashboard.php */
