<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Device_model extends CI_Model 
{

    public function __construct(){
        parent::__construct();
      }
    public function get_all_device(){
    
          $this->db->select("*");  
        $this->db->from('device');
        $query = $this->db->get();  
        return $query; 
    
    }
    public function get_device(){
    
        $this->db->select("*");  
      $this->db->from('device');
      $query = $this->db->get();  
      return $query->result(); 
  
  }

}