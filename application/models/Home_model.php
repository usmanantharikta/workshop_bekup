<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

  function crud($data){
    $this->db->insert('tbl_task',$data);
  }

}
