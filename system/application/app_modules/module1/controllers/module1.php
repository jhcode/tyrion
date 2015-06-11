<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Module1 extends MX_Controller 
{

	public function index()

	{
		echo "This  is module 1";
		$this->callModule2();
	}

	public function callModule2()
	{
		echo 'Loading Module2....<br/>';
		echo Modules::run('module2/module2/index');
	}

	public function nextModule1Call()
	{
		echo "Now in nextModuleCall..<br/>";
		echo 'Loading Module2...again...<br/>';
		echo Modules::run('module2/module2/finalCall');
	}

}
