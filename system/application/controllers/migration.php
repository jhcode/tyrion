<?php
class Migration extends MY_Controller{
	public function index(){
		$this->view = false;
		$this->load->library('migration');

		$this->migration->latest();
		echo "we herexsxs";
	}
}
