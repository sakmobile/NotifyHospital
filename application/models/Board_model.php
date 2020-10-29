<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Board_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public $table = "device";
    public $select_column = array("Device_id", "Device_name", "token_line", "token_fb", "Device_date", "Device_code");
    public $order_column = array(null, "Device_name", null, null, null, null);
    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->like("Device_name", $_POST["search"]["value"]);

        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('Device_id', 'DESC');
        }
    }
    public function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function fetch_single_device($id)
    {
        $this->db->where("Device_id", $id);
        $query = $this->db->get('device');
        return $query->result();
    }
    public function update_device($device_id, $updated_data)
    {
        $this->db->where("Device_id", $device_id);
        $this->db->update("device", $updated_data);

    }
    public function delete_device($id)
    {
        $this->db->where("Device_id", $id);
        $this->db->delete("device");
        //DELETE FROM users WHERE id = '$user_id'
    }
    public function add_device($add_data)
    {
        $this->db->insert('device', $add_data);
    }

}