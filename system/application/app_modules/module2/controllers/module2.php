<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Module2 extends MX_Controller 

{
	public function index()

	{
		echo "Now in Index..<br/>";
		$this->callModule1();

	}

	public function callModule1()
	{
		echo "Now in callModule1..<br/>";
		echo 'Loading Module1....<br/>';
		echo Modules::run('module1/module1/nextModule1Call');
	}

	public function finalCall()
	{
		echo "Final call to module2";
	}

}
