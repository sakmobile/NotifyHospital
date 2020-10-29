<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_reportall($search_d, $date_s, $date_e)
    {

        $this->db->select('*');
        $this->db->from('report');
        $this->db->join('device', 'device.Device_id = report.device_id');
        $this->db->join('room', 'room.room_id = report.room_id');
        $this->db->where('report.device_id', $search_d);
        $this->db->where("report.date BETWEEN '$date_s' AND '$date_e'");

        $query = $this->db->get();
        return $query->result();
    }

    public function get_device()
    {
        $response = array();
        $this->db->select('*');
        $this->db->from('device');
        $query = $this->db->get();
        $response = $query->result_array();
        return $response;
    }
    public function get_report()
    {
        $response = array();
        $this->db->select('*');
        $this->db->from('report');
        $query = $this->db->get();
        $response = $query->result_array();
        return $response;
    }

    public function report_search($dates_search_s, $dates_search_e, $devices_search)
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->join('device', 'device.Device_id = report.device_id');
        $this->db->join('room', 'room.room_id = report.room_id');
        $this->db->where('report.device_id', $devices_search);
        $this->db->where("report.date BETWEEN '$dates_search_s' AND '$dates_search_e'");
        $query = $this->db->get();
        return $query->result();
    }
    public function report_ex($dates_search_s, $dates_search_e, $devices_search)
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->join('device', 'device.Device_id = report.device_id');
        $this->db->join('room', 'room.room_id = report.room_id');
        $this->db->where('report.device_id', $devices_search);
        $this->db->where("report.date BETWEEN '$dates_search_s' AND '$dates_search_e'");
        $query = $this->db->get();
        return $query->result();
    }

}
// $this->db->select('*');
// $this->db->from('topics_list');
// $this->db->where('order_datetime <','2012-10-03');
// $this->db->where('order_datetime >','2012-10-01');

// $result = $this->db->get();