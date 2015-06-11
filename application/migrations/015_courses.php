<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**
* Courses Table
* Type Field expects Courses or Subjects
*/
class Migration_Courses extends CI_Migration
{
	public function up()
	{
		//Notifications table
		$this->dbforge->add_field([
					"id"=>["type"=>"int", "auto_increment"=>TRUE],
					"privacy"=>["type"=>"varchar", "constraint"=>10],
					"title"=>["type"=>"varchar", "constraint"=>100],
					"overview"=>["type"=>"text"],
					"founder"=>["type"=>"varchar", "constraint"=>100],
					"created"=>["type"=>"int", "constraint"=>30]
			]);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("courses", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("courses");
	}
	
}