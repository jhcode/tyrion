<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Schools extends CI_Migration
{
	public function up()
	{
		//Schools table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"name"=>array("type"=>"varchar", "constraint"=>255),
											"email"=>array("type"=>"varchar", "constraint"=>255),
											"phone"=>array("type"=>"varchar", "constraint"=>255),
											"principal"=>array("type"=>"varchar", "constraint"=>255),
											"director"=>array("type"=>"varchar", "constraint"=>255),
											"address"=>array("type"=>"varchar", "constraint"=>255),
											"country"=>array("type"=>"varchar", "constraint"=>255),
											"state"=>array("type"=>"varchar", "constraint"=>255),
											"LGA"=>array("type"=>"varchar", "constraint"=>255),
											"logo"=>array("type"=>"varchar", "constraint"=>255),
											"active"=>array("type"=>"tinyint", "constraint"=>1),
											"created"=>array("type"=>"int", "constraint"=>255),
											"modified"=>array("type"=>"int", "constraint"=>255),
											"admin_id"=>array("type"=>"int", "constraint"=>11)
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("schools",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("schools");
	}

}