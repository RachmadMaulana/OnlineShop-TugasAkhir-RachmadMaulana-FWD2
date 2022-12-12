<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['is_login'])) {
            redirect('manajer/dashboard');
        }
    }



    public function index()
    {
        $rule = $this->login->validationRule();
        $validate = $this->login->Validate($rule);

        if (!$validate) {
            $data['title'] = 'Login';
            $data['page'] = 'pages/login/index';
            $this->view_login($data);
        } else {
            $input = (object)$this->input->post(null, true);
            $login = $this->login->run($input);

            if ($login) {
                $role_id = $this->session->userdata('role_id');
                if ($role_id == 1) {
                    redirect('manajer/dashboard');
                } else {
                    redirect('staff/produk');
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah');
                redirect('login');
            }
        }
    }
}
/* End of file Login.php */
