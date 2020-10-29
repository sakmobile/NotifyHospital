<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
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

        $data['title'] = 'หน่วยงาน';
        $data['page'] = 'หน่วยงาน';
        $data['view_list'] = 'department';
        $date_device = date("Y-m-d");
        $this->load->view("layout/template", $data);
    }

    public function fetch_single_device()
    {
        $output = array();
        $data = $this->Board_model->fetch_single_device($this->input->post('id'));
        foreach ($data as $row) {
            $output['Device_name'] = $row->Device_name;
            $output['token_line'] = $row->token_line;
            $output['token_fb'] = $row->token_fb;
            $output['Device_date'] = $row->Device_date;
            $output['Device_code'] = $row->Device_code;

        }

        echo json_encode($output);

    }

    public function fetch_user()
    {
        $fetch_data = $this->Board_model->make_datatables();
        $data = array();

        foreach ($fetch_data as $row) {

            $sub_array = array();
            $sub_array[] = $row->Device_code;
            $sub_array[] = $row->Device_name;
            $sub_array[] = $row->token_line;

            $sub_array[] = date("d-m-Y", strtotime($row->Device_date));
            $sub_array[] = '<button type="button" name="update_device" id="' . $row->Device_id . '" class="btn btn-warning btn-xs update_device">Update</button>
			                 <button type="button" name="delete_device" id="' . $row->Device_id . '" class="btn btn-danger btn-xs delete_device">Delete</button>';
            $data[] = $sub_array;

        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->Board_model->get_all_data(),
            "recordsFiltered" => $this->Board_model->get_filtered_data(),
            "data" => $data,
        );

        echo json_encode($output);

    }

    public function edit_device()
    {
        $updated_data = array(
            "Device_code" => $this->input->post('up_device_code'),
            "Device_name" => $this->input->post('up_device_name'),
            "token_line" => $this->input->post('up_device_token_line'),

            "Device_date" => date("Y-m-d"),
        );
        $device_id = $this->input->post("device_id");
        $this->Board_model->update_device($device_id, $updated_data);
        echo "uplode";

    }
    public function delete_device()
    {

        $this->Board_model->delete_device($_POST["id"]);
        echo 'Data Deleted';
    }
    public function add_device()
    {
        $add_data = array(
            "Device_name" => $this->input->post('name_device'),
            "Device_code" => $this->input->post('code_device'),

            "token_line" => $this->input->post('token_line'),
            "Device_date" => date("Y-m-d"),
            "Device_status" => "offline",
        );
        $this->Board_model->add_device($add_data);
        echo "uplode";
    }
}