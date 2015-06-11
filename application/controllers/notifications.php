<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Notifications extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('notification_model', 'notifications');
	}

}
/* End of file Finance.php*/
/* Location: ./application/controllers/Finance.php*/
