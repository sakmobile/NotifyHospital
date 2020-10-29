<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPExcel');
    }

    public function index()
    {
        if ($this->session->userdata('name') == null) {
            redirect('/login', 'refresh');

        }
        $data['name'] = $this->session->userdata('name');

        $data['tiem'] = date('H:i:s');
        $data['date'] = date('Y-m-d');
        $data['title'] = 'รายงาน';
        $data['page'] = 'รายงาน';
        $data['active'] = 'active treeview menu-open';
        $data['view_list'] = 'reports';
        $data['device'] = $this->Report_model->get_device();
        $this->load->view("layout/template", $data);
    }

    // public function get_reportall(){
    // $report_output = array();
    // $report_data = $this->Report_model->get_reportall($dates_search,$devices_search);
    // foreach($report_data as $row){
    //     array_push($report_output, array(
    //         "room" => $row->room_name,
    //         "date_call" => $row->date_call,
    //         "date_back" => $row->date_back,
    //         "device_name" =>  $row->Device_name,
    //         "note" => $row->note
    //     ));
    // }

    // echo json_encode($report_output);
    // }

    public function search_report()
    {

        $dates_search_s = $this->input->post('dates_search_s');
        $dates_search_e = $this->input->post('dates_search_e');
        $devices_search = $this->input->post('devices_search');
        $report_search = $this->Report_model->report_search($dates_search_s, $dates_search_e, $devices_search);
        $search_output = array();
        echo json_encode($report_search);
    }

    public function action()
    {
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("#", "ห้อง", "วันเวลาเรียก", "วันเวลาช่วยเหลือ", "ขาดการช่วยเหลือ", "หมายเหตุ");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $dates_search_s = $this->input->post('date_search_start');
        $dates_search_e = $this->input->post('date_search_end');
        $devices_search = $this->input->post('device_search');
        $employee_data = $this->Report_model->report_ex($dates_search_s, $dates_search_e, $devices_search);

        $excel_row = 2;
        $num = 1;
        $a = 0;
        foreach ($employee_data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $num);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->room_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->date_call);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->date_back);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $a);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->note);
            $num++;
            $excel_row++;
        }
        $tiem = date('H:i:s');
        $date = date('Y-m-d');
        $namefile = $date . "_" . $tiem . ".xls";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $namefile . '"');
        $object_writer->save('php://output');
    }
}