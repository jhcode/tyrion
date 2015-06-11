<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Classroom extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->config('school_defaults');
		$this->data['levels'] = $this->config->item('levels');
	}

	public function home()
	{
		
	}
}

/* End of file Finance.php*/
/* Location: ./application/controllers/Finance.php*/
