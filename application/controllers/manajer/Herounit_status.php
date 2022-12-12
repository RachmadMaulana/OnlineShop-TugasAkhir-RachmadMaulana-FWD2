<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Herounit_status extends MY_Controller
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
        $data['title'] = 'Herounit Status';
        $data['page'] = 'pages/manajer/hero_status/index';
        $data['hero_status'] = $this->herounit_status->getHero();
        $data['status'] = $this->herounit_status->getStatus();
        $this->view_dashboard($data);
    }

    public function edit()
    {
        $input = (object) $this->input->post(null, true);

        if ($this->herounit_status->editStatus($input) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Update status');
            redirect('manajer/herounit_status');
        } else {
            $this->session->set_flashdata('error', 'Gagal Update status');
            redirect('manajer/herounit_status');
        }
    }

    public function delete($id)
    {
        $this->load->model('herounit_model');
        if ($this->herounit_model->deleteHero($id)) {
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
            redirect('manajer/herounit_status');
        } else {
            $this->session->set_flashdata('error', 'Gagal Hapus, anda bukan manajer!!');
            redirect('manajer/herounit_status');
        }
    }
}

/* End of file Herounit_status.php */
