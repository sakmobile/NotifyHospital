<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table_device = "device";
    public $table_user = "user";
    public $select_column = array("user_id", "user_name", "user_date", "user_position", "user_email", "user_code");
    public $order_column = array(null, "user.user_name", "user.user_code", null, null, null, null);
    public function make_query()
    {
        $this->db->select("*");
        $this->db->from('user');
        $this->db->join('device', 'user.device_id = device.Device_id');

        if (isset($_POST["search"]["value"])) {
            $this->db->like("user.user_name", $_POST["search"]["value"]);

        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('user.user_id', 'DESC');
        }
    }
    public function make_datatables_user()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function get_filtered_data_user()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_all_data_user()
    {
        $this->db->select("*");
        $this->db->from('user');
        $this->db->join('device', 'user.device_id = device.Device_id');
        return $this->db->count_all_results();
    }

    public function fetch_single_User($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('device', 'user.device_id = device.Device_id');
        $this->db->where("user_id", $id);
        $query = $this->db->get();
        return $query->result();

    }
    public function update_user($user_id, $updated_data_user)
    {
        $this->db->where("user_id", $user_id);
        $this->db->update("user", $updated_data_user);

    }
    public function delete_user($id)
    {
        $this->db->where("user_id", $id);
        $this->db->delete("user");
        //DELETE FROM users WHERE id = '$user_id'
    }
    public function add_User($add_data)
    {
        $this->db->insert('user', $add_data);
    }

    public function getDevice()
    {

        $response = array();
        $this->db->select('*');
        $q = $this->db->get('device');
        $response = $q->result_array();
        return $response;
    }

}