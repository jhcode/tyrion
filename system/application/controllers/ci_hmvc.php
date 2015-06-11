<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Ci_hmvc extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}
	
	public function test()
	{
		
		$this->data['result'] = 'All systems baby!';
		//$this->load->view('test_view',$data);
	}
}
/* End of file Ci_hmvc*/
/* Location: ./application/controllers/ci_hmvc.php*/