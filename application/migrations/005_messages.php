<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Messages extends CI_Migration
{
	public function up()
	{
		//messages table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"sender_id"=>array("type"=>"int", "constraint"=>100),
											"recipient_id"=>array("type"=>"int", "constraint"=>100),
											"viewed"=>array("type"=>"tinyint", "constraint"=>1),
											"message"=>array("type"=>"text"),
											"created"=>array("type"=>"int", "constraint"=>100)
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("messages",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("messages");
	}

}