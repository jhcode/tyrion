<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Roles extends CI_Migration
{
	public function up()
	{
		//Roles table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"role"=>array("type"=>"varchar", "constraint"=>30),
											"user_id"=>array("type"=>"int", "constraint"=>11),
											"school_id"=>array("type"=>"int", "constraint"=>11),
											"created"=>array("type"=>"int", "constraint"=>30),
											"verified"=>array("type"=>"varchar", "constraint"=>5)
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("roles",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("roles");
	}

}