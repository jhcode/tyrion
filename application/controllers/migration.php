<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view = false;
		$this->load->library('migration');

		echo "Migration(s) Loading...<br/>";

		$this->load->library('migration');

		if ( ! $this->migration->current())
		{
			show_error($this->migration->error_string());
		}
		
		echo "Migration(s) Loaded Succesfully";
	}
}
/* End of file Migration.php*/
/* Location: ./application/controllers/Migration.php*/
