<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Privileges extends CI_Migration
{
	public function up()
	{
		//messages table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"name"=>array("type"=>"varchar", "constraint"=>50),
											"controller"=>array("type"=>"varchar", "constraint"=>50),
											"method"=>array("type"=>"varchar", "constraint"=>20),
											"priority"=>array("type"=>"int", "constraint"=>11),
											"parent_id"=>array("type"=>"int", "constraint"=>11),
											"is_sadmin"=>array("type"=>"tinyint", "constraint"=>1),
											"is_admin"=>array("type"=>"tinyint", "constraint"=>1),
											"is_manager"=>array("type"=>"tinyint", "constraint"=>1),
											"is_teacher"=>array("type"=>"tinyint", "constraint"=>1),
											"is_parent"=>array("type"=>"tinyint", "constraint"=>1),
											"is_bursar"=>array("type"=>"tinyint", "constraint"=>1),
											"is_student"=>array("type"=>"tinyint", "constraint"=>1),
											"is_regular"=>array("type"=>"tinyint", "constraint"=>1),
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("privileges",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("privileges");
	}

}