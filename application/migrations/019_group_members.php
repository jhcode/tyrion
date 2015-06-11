<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Group_members extends CI_Migration
{
	public function up()
	{
		//groups table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),										 
											"user_id"=>array("type"=>"int"),
											"group_id"=>array("type"=>"int"),
											"joined"=>array("type"=>"int")
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("group_members", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("group_members");
	}

}