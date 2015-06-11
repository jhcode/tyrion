<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Users extends CI_Migration
{
	public function up()
	{
		//Users table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"type"=>array("type"=>"varchar", "constraint"=>100),
											"firstname"=>array("type"=>"varchar", "constraint"=>255),
											"middlename"=>array("type"=>"varchar", "constraint"=>255),
											"lastname"=>array("type"=>"varchar", "constraint"=>255),
											"username"=>array("type"=>"varchar", "constraint"=>255),
											"password"=>array("type"=>"varchar", "constraint"=>255),
											"email"=>array("type"=>"varchar", "constraint"=>255),
											"phone"=>array("type"=>"varchar", "constraint"=>255),
											"facebook_handle"=>array("type"=>"varchar", "constraint"=>255),
											"twitter_handle"=>array("type"=>"varchar", "constraint"=>255),
											"dob"=>array("type"=>"varchar", "constraint"=>255),
											"gender"=>array("type"=>"varchar", "constraint"=>10),
											"verified"=>array("type"=>"tinyint", "constraint"=>1),
											"active"=>array("type"=>"tinyint", "constraint"=>1),
											"last_login"=>array("type"=>"int", "constraint"=>255),
											"created"=>array("type"=>"int", "constraint"=>255),
											"modified"=>array("type"=>"int", "constraint"=>255),
											"image"=>array("type"=>"varchar", "constraint"=>255),
											"interests"=>array("type"=>"text"),
											"acc_name"=>array("type"=>"varchar", "constraint"=>255),
											"acc_no1"=>array("type"=>"int", "constraint"=>255),
											"acc_no2"=>array("type"=>"int", "constraint"=>255),
											"is_sadmin"=>array("type"=>"tinyint", "constraint"=>1),
											"is_admin"=>array("type"=>"tinyint", "constraint"=>1),
											"is_manager"=>array("type"=>"tinyint", "constraint"=>1),
											"is_teacher"=>array("type"=>"tinyint", "constraint"=>1),
											"is_parent"=>array("type"=>"tinyint", "constraint"=>1),
											"is_student"=>array("type"=>"tinyint", "constraint"=>1),
											"is_bursar"=>array("type"=>"tinyint", "constraint"=>1)
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("users",true);
	}

	public function down()
	{
		$this->dbforge->drop_table("users");
	}

}