<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendemail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        $this->load->library('Email');
        $this->email->from('hospital@hos.com', 'Admin');
        $this->email->to('sak.janenii@gmail.com');
        $this->email->subject('แจ้งเตือน....!!');
        $this->email->message('Hi  Here is the info you requested.');
        $this->email->send();

    }
}