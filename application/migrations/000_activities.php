<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Activities extends CI_Migration
{
	public function up()
	{
		// Activities table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"action"=>array("type"=>"TEXT"),
											"to"=>array("type"=>"TEXT"),
											"from"=>array("type"=>"datetime")
										)
		);
		$this->dbforge->add_key('id',true);

		$this->dbforge->create_table("activities", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("activities");
	}

}