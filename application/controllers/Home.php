<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $data['tiem'] = date('H:i:s');
        $data['date'] = date('Y-m-d');
        $data['title'] = 'Dashboard';
        $data['page'] = 'Dashboard';
        $data['device'] = $this->Report_model->get_device();
        $data['report_data'] = $this->Report_model->get_report();

        $data['active'] = 'active treeview menu-open';
        $data['view_list'] = 'view_home';
        $this->load->view("layout/template", $data);
    }

    public function get_reportall()
    {

        $search_d = $this->input->post('search_d');
        $date_s = $this->input->post('date_ss');
        $date_e = $this->input->post('date_ee');

        $report_output = array();
        $report_data = $this->Report_model->get_reportall($search_d, $date_s, $date_e);

        foreach ($report_data as $row) {
            array_push($report_output, array(
                "room_id" => $row->room_id,
                "device_name" => $row->Device_name,
                "room_name" => $row->room_name,
                "date_call" => $row->date_call,
                "date_back" => $row->date_back,
                "date" => $row->date,
                "note" => $row->note,

            ));
        }
        echo json_encode($report_output);

    }

    public function call()
    {
        $date = $this->input->post('date');
        $text = $this->input->post('msg');
        $time = date('H:i:s');
        if ($text == "") {

            $this->session->set_flashdata('error', 'ข้อมูลว่าง');
            redirect(base_url());
        } else {
            $this->notifyLine($text, $time, $date);
            $this->session->set_flashdata('success', 'ส่งข้อมูลเรียบร้อย');
            redirect(base_url());
        }

    }

}