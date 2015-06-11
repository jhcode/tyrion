<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Notices extends CI_Migration
{
	public function up()
	{
		//Noticeboard table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),
											"type"=>array("type"=>"varchar", "constraint"=>20),
											"title"=>array("type"=>"varchar", "constraint"=>255),
											"details"=>array("type"=>"text"),
											"created"=>array("type"=>"int", "constraint"=>255)
										)
		);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table("notices", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("notices");
	}

}