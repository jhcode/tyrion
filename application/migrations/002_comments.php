<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Comments extends CI_Migration
{
	public function up()
	{
		//Comments table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"type"=>array("type"=>"varchar", "constraint"=>255),
											"resource_id"=>array("type"=>"int", "constraint"=>255),
											"user_id"=>array("type"=>"int", "constraint"=>255),
											"time"=>array("type"=>"int", "constraint"=>100),
											"comment"=>array("type"=>"text")
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("comments", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("comments");
	}

}