<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devices extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('name') == null) {
            redirect('/login', 'refresh');

        }
        $data['name'] = $this->session->userdata('name');

        $data['data_device'] = $this->Device_model->get_all_device();
        $data['title'] = 'อุปกรณ์';
        $data['page'] = 'อุปกรณ์';
        $data['active'] = 'active treeview menu-open';
        $data['view_list'] = 'devices';
        $this->load->view("layout/template", $data);
    }

    public function get_all_device()
    {
        $data_device = $this->Device_model->get_device();
        echo json_encode($data_device);
    }

}