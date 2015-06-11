<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Schools extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('school_model','school');
	}

	/**
	*	Callback function for payment platform
	*	Setup school signing up for the first time		
	*	Verify a schools payment and redirect to dashboard
	*	@param school_id (int)
	*	@return void
	*/
	public function setup($school_id)
	{		
		if(!$school_id)redirect($_SERVER['HTTP_REFERER']);

		//save the paid  status of the school: TODO
		$this->school->update($school_id,['active'=>1,'paid'=>1]);

		//crunch tables for the new school IF and ONLY IF, this admin is logging in for the first time
		if(!(bool)$this->user_details->last_login)
			$this->school->create($school_id);

		redirect('home');
	}


	/**
	*test table crunch
	*/
	public function crunch_tables($id = 3)
	{
		$this->view = false;
		$this->school->create($id);
	}
}

/* End of file Finance.php*/
/* Location: ./application/controllers/Finance.php*/
