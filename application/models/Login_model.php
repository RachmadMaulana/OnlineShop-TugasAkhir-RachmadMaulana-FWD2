<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model {

    protected $table = 'user';

    public function validationRule(){
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]'
            ]
        ];;
    }

    public function Validate($rule){
		$this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">','</small>'
        );
		$this->form_validation->set_rules($rule);
        return $this->form_validation->run();
	}

    public function run($input){
        
        $user = $this->db->get_where($this->table,['email' => $input->email])->row_array();

        if($user){
            if(password_verify($input->password,$user['password'])){
                $sess_data = [
                    'name' => $user['nama'],
                    'role_id' => $user['role_id'],
                    'email' => $user['email'],
                    'is_login' => true
                ];

                $this->session->set_userdata($sess_data);
                return true;
            }
        }
        
    }

}

/* End of file Login_model.php */



?>