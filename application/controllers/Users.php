<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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

        $data['title'] = 'เจ้าหน้าที่';
        $data['page'] = 'เจ้าหน้าที่';
        $data['active'] = 'active treeview menu-open';
        $data['view_list'] = 'users';
        $data['devices'] = $this->User_model->getDevice();
        $this->load->view("layout/template", $data);
    }
    public function fetch_single_user()
    {
        $output = array();
        $data = $this->User_model->fetch_single_User($this->input->post('id'));
        foreach ($data as $row) {
            $output['user_name'] = $row->user_name;
            $output['user_code'] = $row->user_code;
            $output['user_position'] = $row->user_position;
            $output['device_name'] = $row->Device_name;
            $output['device_id'] = $row->Device_id;
            $output['user_email'] = $row->user_email;
            $output['user_id'] = $row->user_id;

        }

        echo json_encode($output);

    }

    public function getuserall()
    {
        $user_data = $this->User_model->make_datatables_user();
        $data = array();

        foreach ($user_data as $row) {

            $sub_array = array();

            $sub_array[] = $row->user_code;
            $sub_array[] = $row->user_name;
            $sub_array[] = $row->user_position;
            $sub_array[] = $row->Device_name;
            $sub_array[] = $row->user_email;
            $sub_array[] = '<button type="button" name="update_user" id="' . $row->user_id . '" class="btn btn-warning btn-xs update_user">Update</button>
			                 <button type="button" name="delete_user" id="' . $row->user_id . '" class="btn btn-danger btn-xs delete_user">Delete</button>';

            $data[] = $sub_array;

        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->User_model->get_all_data_user(),
            "recordsFiltered" => $this->User_model->get_filtered_data_user(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function add_username()
    {

        $add_data = array(
            "user_name" => $this->input->post('user_name'),
            "user_email" => $this->input->post('user_email'),
            "user_date" => date("Y-m-d"),
            "user_position" => $this->input->post('user_position'),
            "user_code" => $this->input->post('user_code'),
            "device_id" => $this->input->post('user_device'),
        );
        $this->User_model->add_User($add_data);
        echo "uplode";
    }

    public function edit_user()
    {
        $updated_data_user = array(
            "user_code" => $this->input->post('up_user_code'),
            "user_name" => $this->input->post('up_user_name'),
            "user_email" => $this->input->post('up_user_email'),
            "user_position" => $this->input->post('up_user_position'),
            "user_date" => date("Y-m-d"),
            "device_id" => $this->input->post('device_update'),

        );
        $user_id = $this->input->post("user_id");
        $this->User_model->update_user($user_id, $updated_data_user);
        echo "uplode";

    }
    public function delete_user()
    {

        $this->User_model->delete_user($_POST["id"]);
        echo 'Data Deleted';
    }

}