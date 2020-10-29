<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getalldevice($getcode)
    {
        // $this->db->where("Device_code", $getcode);
        // $query = $this->db->get('device', 'user');
        // $this->db->join('user', 'device.Device_id = user.device_id');

        // $this->db->select('*');
        // $this->db->from('device');
        // $this->db->join('user', 'device.Device_id = user.device_id');
        // $this->db->where("Device_code", $getcode);

        // $query = $this->db->get();
        // // return $query->result_array();
        $this->db->select('*');
        $this->db->from('device');
        $this->db->join('user', 'device.Device_id = user.device_id', 'left');
        $this->db->where('Device_code', $getcode);
        $query = $this->db->get();
        return $query->result();

    }
    public function add_report($add_data)
    {
        $this->db->insert('report', $add_data);

    }

    public function getreport($deid)
    {

        $this->db->select_max('repot_id');
        $this->db->where('device_id', $deid);
        $query = $this->db->get('report');
        return $query->result();

    }
    public function update_report($updated_data, $id)
    {
        $this->db->where("repot_id", $id);
        $this->db->update("report", $updated_data);
    }
    public function update_st($updated_data, $getcode)
    {

        $this->db->where("Device_code", $getcode);
        $this->db->update("device", $updated_data);

    }
    public function update_st1($updated_data, $datals)
    {
        $this->db->where("Device_code", $datals);
        $this->db->update("device", $updated_data);

    }
}