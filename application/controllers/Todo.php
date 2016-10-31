<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Todo extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct($config='rest'){
		parent::__construct();
	}

	function index_get()
	{
		$id = $this->get('id');
		if($id=='')
		{
			$todos = $this->db->get('tbl_task')->result();
		} else
		{
			$this->db->where('id',$id);
			$todos=$this->db->get('tbl_task')->result();
		}
		$this->response($todos,200);
	}

	function index_post()
	{
		$data= array(
			'task'=>$this->post('task'),
			'date'=>$this->post('date'),
		);

		$insert = $this->db->insert('tbl_task', $data);
		if($insert){
			$this->response($data,200);
		}else
		{
			$this->response(array('status' => 'fail' ,500 ));
		}
	}

	/**
	* @api (PUT) /todo PUT List todos
	* @apiName PutTodo
	* @apiGroup trader_cdlmorningdojistar
	* apiParam {Number} id Todo unique ID
	*/

	function index_put()
	{
		$id= $this->get('id');
		$data= array(
			'task'=>$this->post('task'),
			'date'=>$this->post('date'),
		);
		$this->db->where('id',$id);
		$update=$this->db->update('tbl_task',$data);
		if($update)
		{
			$this->response($data,200);
		}else
		{
			$this->response(array('status'=>'fail',200));
		}

	}

	function index_delete()
	{
		$id= $this->get('id');
		$this->db->where('id',$id);
		$delete=$this->db->delete('tbl_task');
		if($delete)
		{
			$this->response(array('status' => 'succses',200));
		}else
		{
			$this->response(array('status'=>'fail',200));
		}
	}


}
