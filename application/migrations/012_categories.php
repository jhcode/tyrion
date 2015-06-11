<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Categories extends CI_Migration
{
	public function up()
	{
		//Categories table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"uid"=>array("type"=>"int", "constraint"=>100),
											"event"=>array("type"=>"varchar", "constraint"=>255),
											"time_created"=>array("type"=>"int", "constraint"=>255),
											"start"=>array("type"=>"int", "constraint"=>255)
										)
		);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table("categories", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("categories");
	}

}