<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function fetch_user_login($email, $pass)
    {
        $this->db->where('email', $email);
        $this->db->where('pass', $this->salt_pass($pass));
        $query = $this->db->get('admin');
        return $query->row();
    }
    public function record_count($email, $pass)
    {
        $this->db->where('email', $email);
        $this->db->where('pass', $this->salt_pass($pass));
        return $this->db->count_all_results('admin');
    }

    public function salt_pass($pass)
    {
        return md5($pass);
    }

    public function read_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return false;
    }
    public function entry_user($id)
    {
        $data = array('name' => $this->input->post('email'));
        $this->db->update('admin', $data, array('id' => $id));
    }
}