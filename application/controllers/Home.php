<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$this->load->view('header');
		$data['data']=$this->home_model->getdata();
		$this->load->view('home_view',$data);
		$this->load->view('footer');
	}

	public function show()
	{
		$result=$this->home_model->getdata();
		$data=array();
		foreach ($result as $key) {
			array_push($data, array(
				$key['task'],
				$key['date'],
				$key['time'],
				'<a class="btn btn-sm btn-default" href="javascript:void()" title="Edit" onclick="edit('."'".$key['id']."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
									<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete('."'".$key['id']."'".')"><i class="glyphicon glyphicon-trash"></i> </a>',
			));
		}
		echo json_encode(array('data'=>$data));
	}

	public function save_data()
	{
		$data=array
		(
			'task'=>$this->input->post('task'),
			'date'=>date("y.m.d"),
			'time'=>date("h.i.s"),
		);
			$insert=$this->home_model->crud($data);
			echo json_encode(array("status" => TRUE));
	}

	public function edit($id)
	{
		$data = $this->home_model->get_by_id($id);
		echo json_encode($data);
	}




}
