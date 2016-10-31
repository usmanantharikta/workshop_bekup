<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

  function crud($data){
    $this->db->insert('tbl_usman',$data);
  }
  function getdata()
  {
    $this->db->select('*');
    $this->db->from('tbl_usman');
    $this->db->order_by('id','DESC');
    $query=$this->db->get();
    return $query->result_array();
  }

  public function get_by_id($id)
  {
    $this->db->from('tbl_usman');
    $this->db->where('id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function update($where, $data)
  {
    $this->db->update('tbl_usman', $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('tbl_usman');
  }



}
