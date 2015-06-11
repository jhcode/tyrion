<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Notifications extends CI_Migration
{
	public function up()
	{
		//Notifications table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"from"=>array("type"=>"int", "constraint"=>100),
											"to"=>array("type"=>"int", "constraint"=>100),
											"to"=>array("type"=>"int", "constraint"=>10),
											"type_id"=>array("type"=>"datetime"),
											"viewed"=>array("type"=>"tinyint", "constraint"=>1),
											"created"=>array("type"=>"int", "constraint"=>255)
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("notifications", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("notifications");
	}

}