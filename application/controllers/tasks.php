<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Tasks controller
*	This is the interface
*	to handle all behaviours and
*	activities concerning
*	@ver Simer2.0
*	@author joerex
* 	Copyright (c) 2014
*/

Class Tasks extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){

	}

	public function manage(){
		$this->load->model('task_model', 'tasks');
		$all = $this->tasks->get_all();
		$this->data['all'] = $all;
	}

	public function add(){
		$this->view = false;
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('time', 'Task Time', 'required');
		$this->form_validation->set_rules('meridian', 'Meridian', 'required');
		$this->form_validation->set_rules('activity', 'Activity', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();
			list($d,$m,$y) = explode('-',$data['date']);
			$created = strtotime($m.'/'.$d.'/'.$y.' '.$data['time'].' '.$data['meridian']);
			$post = [
			'created' => $created,
			'activity' => $data['activity']
			];
			$this->load->model('task_model', 'tasks');
			$this->tasks->insert($post);
			$this->message->set('success', 'Task has succssfully been added');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$response = ['type' => 'error', 'content' => validation_errors()];
		}
	}

	/**
	*
	* Remove Task by id from manage page
	* @param id
	*/
	public function remove($id){
		$this->view = false;
		$this->load->model('task_model', 'tasks');
		$this->tasks->delete($id);
		redirect($site_url.'/tasks/manage');

	}

	public function edit($id){
		$this->load->model('task_model', 'tasks');
		$all = $this->tasks->get($id);
		$this->data['all'] = $all;
	}
}