<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Interests controller
*	Handle all activities involving interests
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Interests extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Interest_model','interest');
	}

	/**Add
	*Add Interests To Record
	*/
	public function add()
	{
		$data = $this->form_validation->set_rules('name[]','Interest Name','required');

		if($this->form_validation->run())
		{
			$data = $this->input->post();
			$to_save = [];
			foreach ($data['name'] as $name):
				
				$to_save[] = ['name'=>strtolower($name)];				
			endforeach;

			$this->interest->insert_many($to_save);
		}
	}
}	