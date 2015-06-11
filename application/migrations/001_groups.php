<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Groups extends CI_Migration
{
	public function up()
	{
		//groups table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"type"=>array("type"=>"varchar","constraint"=>10),
											"title"=>array("type"=>"text"),
											"overview"=>array("type"=>"text"),
											"creator_id"=>array("type"=>"int"),
											"avatar"=>array("type"=>"text"),
											"theme"=>array("type"=>"varchar","constraint"=>50),
											"created"=>array("type"=>"int")
										)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("groups", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("groups");
	}

}