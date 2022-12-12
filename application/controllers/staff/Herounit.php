<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Herounit extends MY_Controller
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
        $data['title'] = 'Hero Unit';;
        $data['page'] = 'pages/staff/hero/index';
        $data['hero'] = $this->herounit->getAllHero();
        $this->view_dashboard($data);
    }

    public function create()
    {
        if (empty($_POST)) {
            redirect('dashboard');
        }

        $input = (object) $this->input->post(null, true);
        $gambar = $_FILES['gambar'];

        if ($this->herounit->createHero($input, $gambar) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Ditambahkan');
            redirect('staff/herounit');
        } else {
            $this->session->set_flashdata('error', 'Gagal Ditambahkan');
        }
    }

    public function delete($id)
    {
        if ($this->herounit->deleteHero($id)) {
            $this->session->set_flashdata('success', 'Berhasil Dihapus');
            redirect('staff/herounit');
        } else {
            $this->session->set_flashdata('error', 'Gagal Hapus, anda bukan manajer!!');
            redirect('staff/herounit');
        }
    }

    public function edit()
    {
        if (empty($_POST)) {
            redirect('manajer/dashboard');
        }

        $input = (object) $this->input->post(null, true);
        $gambar = $_FILES['gambar'];

        $foto = $this->herounit->getHeroById($input->id);
        if ($this->herounit->updateHero($input, $gambar) > 0) {
            $this->session->set_flashdata('success', 'Berhasil Diedit');
            redirect('staff/herounit');
        } else {
            $this->session->set_flashdata('error', 'Gagal Diedit');
            redirect('staff/herounit');;
        }
    }
}

/* End of file Herounit.php */
