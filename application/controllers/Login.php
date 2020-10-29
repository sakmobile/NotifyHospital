<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data['title'] = 'Login';

        $this->load->view("login", $data);
    }
    public function validlogin()
    {

        if ($this->input->server('REQUEST_METHOD') == true) {
            if ($this->Login_model->record_count($this->input->post('email'), $this->input->post('pass')) == 1) {
                $result = $this->Login_model->fetch_user_login($this->input->post('email'), $this->input->post('pass'));
                $this->session->set_userdata(array('id' => $result->id, 'name' => $result->name, 'email' => $result->email));
                redirect('/home');

            } else {
                $this->session->set_flashdata(array('msgerr' => '<p class="login-box-msg" style="color:red;">ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!</p>'));
                redirect('/login', 'refresh');
            }
        }

    }

    public function logout()
    {
        $this->session->unset_userdata(array('id', 'name', 'email'));
        redirect('', 'refresh');
    }

}