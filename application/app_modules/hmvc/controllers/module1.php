<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Module1 extends MX_Controller 

{

 

	public function index( )

	{

		$this->load->view('mod1-view');

	}

}
