<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Tasks extends CI_Migration
{
	public function up()
	{
		//Todos table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),
											"day"=>array("type"=>"varchar", "constraint"=>30),
											"time"=>array("type"=>"varchar", "constraint"=>30),
											"activity"=>array("type"=>"varchar", "constraint"=>100)
										)
		);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table("tasks", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("tasks");
	}

}