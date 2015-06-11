<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Blocks extends CI_Migration
{
	public function up()
	{
		//messages table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"blocker_id"=>array("type"=>"int"),
											"blocked_id"=>array("type"=>"int")											
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("blocks",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("blocks");
	}

}