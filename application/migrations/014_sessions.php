<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Sessions extends CI_Migration
{
	public function up()
	{
		//Notifications table
		$this->dbforge->add_field(	array(
											"session_id"=>array("type"=>"varchar", "constraint"=>140),											 
											"ip_address"=>array("type"=>"varchar", "constraint"=>40),
											"user_agent"=>array("type"=>"varchar", "constraint"=>120),
											"last_activity"=>array("type"=>"int", "constraint"=>10),
											"user_data"=>array("type"=>"text"),
											"viewed"=>array("type"=>"tinyint", "constraint"=>1),
											"created"=>array("type"=>"int", "constraint"=>255)
										)
		);
		$this->dbforge->add_key('session_id',true);
		$this->dbforge->add_key('last_activity');
		$this->dbforge->create_table("sessions", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("sessions");
	}
	
}