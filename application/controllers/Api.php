<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
date_default_timezone_set('Asia/Bangkok');

    }

    public function index()
    {

        $this->load->library('Email');
        $datals;
        $getcode = $this->input->get('device_code');
        $getcall = $this->input->get('call');
        $getcall_back = $this->input->get('call_back');
        $get_status = $this->input->get('st');

        if ($get_status == "online") {
            echo $getcode . " = " . $get_status . "==";
            $this->update_status($getcode, $get_status);
            $this->session->set_userdata( 'status', $get_status);
            $datals = $getcode;
        }else{
            $this->update_status1($datals);

        }
        $currenttime = time();
        $usercount = date('i:s', (10 * 30) - ($currenttime % (10 * 30)));
        if ($usercount <= 0) {
            $this->update_status1($datals);

        }

        //     // $output = array();

            $data_device = $this->Api_model->getalldevice($getcode);

            if ($getcall != "") {
                $length = count($data_device);


                for ($i = 0; $i < $length; $i++) {
                    //     echo "ห้อง 1";
                 
                    $date = date("Y-m-d");
                      $time = date('H:i:s');
                   $timestamp = date("Y-m-d H:i:s ", $date . $time);

                    $text = "ห้องพิเศษ " . $getcall;
                    $sumtext = "แจ้งเตือนคุณ" . $data_device[$i]->user_name . '' . $text . 'วันที่ : ' . $date . 'เวลา :' . $time;
                   
                    $deid = $data_device[$i]->Device_id;
                   
                   $token = $data_device[$i]->token_line;
                    $this->email->clear();
                    $this->email->from('hospital@hos.com', 'Admin');
                    $this->email->to($data_device[$i]->user_email);
                    $this->email->subject('แจ้งเตือน....!!');
                    $this->email->message($sumtext);
                    $this->email->send();
                    
                   $room = $getcall;
                      $this->add_report($timestamp, $room, $deid);
                     $this->call($text, $time, $date, $token);

                }
                
               

 


            }

            if ($getcall_back != "") {
                $length = count($data_device);

                for ($i = 0; $i < $length; $i++) {
                    //     echo "ห้อง 1";
                    $date = date("Y-m-d");
                    $time = date('H:i:s');                 
                    $timestamp = date("Y-m-d H:i:s ", $date . $time);
                    $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องพิเศษ " . $getcall_back;
                    $sumtext = "แจ้งเตือนคุณ" . $data_device[$i]->user_name . '' . $text . 'วันที่ : ' . $date . 'เวลา :' . $time;                 
                    $deid = $data_device[$i]->Device_id;
                    $token = $data_device[$i]->token_line;
                    $this->email->clear();
                    $this->email->from('hospital@hos.com', 'Admin');
                    $this->email->to($data_device[$i]->user_email);
                    $this->email->subject('แจ้งเตือน....!!');
                    $this->email->message($sumtext);
                    $this->email->send();
                    $room = $getcall_back;
                    $test = $this->Api_model->getreport($deid);
                    foreach ($test as $row) {
                        $id = $row->repot_id;
                    }
               
                    $this->update_report($timestamp, $room, $id);
                    $this->call($text, $time, $date, $token);

                }

            }
    }
//    if( $this->input->post('A') == "2"){
    //     $date = date("Y-m-d");
    //        $time = date('H:i:s');
    //        $text = "เกิดเหตุฉุกเฉินห้องอบชาย 2";
    //        echo $date;
    //        echo $time;
    //        echo $text;
    //        $this->call($text, $time, $date);
    //  }
    //  if( $this->input->post('A') == "2_1"){
    //   echo "ห้อง 1";
    //    $date = date("Y-m-d");
    //    $time = date('H:i:s');
    //    $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องอบชาย 2";
    //    echo $date;
    //    echo $time;
    //    echo $text;
    //    $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "3"){
    //   echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องอบชาย 3 ";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "3_1"){
    //  echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องอบชาย 3";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "4"){
    // $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องอบหญิง 1";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "4_1"){
    // echo "ห้อง 1";
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องอบหญิง 1";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }

// if( $this->input->post('A') == "5"){
    //   echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องอบหญิง 2 ";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "5_1"){
    //  echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องอบหญิง 2";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "6"){
    // $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องอบหญิง 3";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "6_1"){
    // echo "ห้อง 1";
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องอบหญิง 3";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "7"){
    // echo "ห้อง 1";
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เกิดเหตุฉุกเฉินห้องน้ำชาย 1 ";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "7_1"){
    // echo "ห้อง 1";
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำชาย 1";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "8"){
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เกิดเหตุฉุกเฉินห้องน้ำชาย 2 ";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "8_1"){
    // echo "ห้อง 1";
    // $date = date("Y-m-d");
    // $time = date('H:i:s');
    // $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำชาย 2";
    // echo $date;
    // echo $time;
    // echo $text;
    // $this->call($text, $time, $date);
    // }
    // if( $this->input->post('A') == "9"){
    //   echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องน้ำหญิง 1 ";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    //   }
    //   if( $this->input->post('A') == "9_1"){
    //   echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำหญิง 1";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    //   }
    //   if( $this->input->post('A') == "10"){
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เกิดเหตุฉุกเฉินห้องน้ำหญิง 2 ";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    //   }
    //   if( $this->input->post('A') == "10_1"){
    //   echo "ห้อง 1";
    //   $date = date("Y-m-d");
    //   $time = date('H:i:s');
    //   $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำหญิง 2";
    //   echo $date;
    //   echo $time;
    //   echo $text;
    //   $this->call($text, $time, $date);
    //   }
    //   if( $this->input->post('A') == "11"){
    //     $date = date("Y-m-d");
    //     $time = date('H:i:s');
    //     $text = "เกิดเหตุฉุกเฉินห้องน้ำกายภาพชาย ";
    //     echo $date;
    //     echo $time;
    //     echo $text;
    //     $this->call($text, $time, $date);
    //     }
    //     if( $this->input->post('A') == "11_1"){
    //     echo "ห้อง 1";
    //     $date = date("Y-m-d");
    //     $time = date('H:i:s');
    //     $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำกายภาพชาย";
    //     echo $date;
    //     echo $time;
    //     echo $text;
    //     $this->call($text, $time, $date);
    //     }
    //     if( $this->input->post('A') == "12"){
    //       $date = date("Y-m-d");
    //       $time = date('H:i:s');
    //       $text = "เกิดเหตุฉุกเฉินห้องน้ำกายภาพหญิง";
    //       echo $date;
    //       echo $time;
    //       echo $text;
    //       $this->call($text, $time, $date);
    //       }
    //       if( $this->input->post('A') == "12_1"){
    //       echo "ห้อง 1";
    //       $date = date("Y-m-d");
    //       $time = date('H:i:s');
    //       $text = "เจ้าหน้าที่ได้เข้าช่วยเหลือแล้ว ห้องน้ำกายภาพหญิง";
    //       echo $date;
    //       echo $time;
    //       echo $text;
    //       $this->call($text, $time, $date);
    //       }

//     // $userid = $this->input->get('userid');
    //         // $key = $this->input->get('key');
    //         // $board = $this->Board_model->getboard();
    //         // foreach($board as $test) {
    //         //     $data = array(
    //         //         'id' => $test->id,
    //         //         'name' => $test->name,
    //         //         'status' => $test->status,
    //         //         'key' => $test->key
    //         //      );
    //     // }

//     // echo json_encode($data);

//   }
    public function call($text, $time, $date, $token)
    {

        if ($text == "") {

            $this->session->set_flashdata('error', 'ข้อมูลว่าง');
            redirect(base_url());
        } else {
            $this->notifyLine($text, $time, $date, $token);
            $this->session->set_flashdata('success', 'ส่งข้อมูลเรียบร้อย');
            redirect(base_url());
        }

    }

    public function notifyLine($text, $time, $date, $token)
    {

        $Result = "วันที่ " . $date . "เวลา " . $time . " " . $text;
        define('LINE_API', "https://notify-api.line.me/api/notify");

        // $token = "d4K388bpRNgwFdx2PrSdkKJz9v5b8yHdIQ0QNn8zgtE";
        $this->notify_message($Result, $token);
    }

    public function notify_message($message, $token)
    {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData),
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false));
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, false, $context);
        $res = json_decode($result);
        return $res;
    }

    public function add_report($timestamp, $room, $deid)
    {

        $add_data = array(
            "device_id" => $deid,
            "room_id" => $room,
            "date_call" => $timestamp,
            "date" => $date = date("Y-m-d"),

        );
        $this->Api_model->add_report($add_data);
        echo "uplode";

    }
    public function update_report($timestamp, $room, $id)
    {
        $updated_data = array(

            "date_back" => $timestamp,

        );

        $this->Api_model->update_report($updated_data, $id);
        echo "uplode";

    }
    public function update_status($getcode, $get_status)
    {
        $updated_data = array(
            "Device_status" => $get_status,
        );

        $this->Api_model->update_st($updated_data, $getcode);
        echo "uplode";
    }
    public function update_status1($datals)
    {

        $updated_data = array(
            "Device_status" => "offline",
        );

        $this->Api_model->update_st1($updated_data, $datals);
        echo "uplode";
    }

}