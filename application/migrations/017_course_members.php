<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
/**
* Course_Members Migration
* Database calls to the course/group members area
*
*/
class Migration_Course_members extends CI_Migration
{
	public function up()
	{
		//Notifications table
		$this->dbforge->add_field([
					"id"=>["type"=>"int", "auto_increment"=>TRUE],
					"user_id"=>["type"=>"int", "constraint"=>30],
					"course_id"=>["type"=>"int", "constraint"=>30],
					"instructor"=>["type"=>"varchar", "constraint"=>30],
					"joined"=>["type"=>"int", "constraint"=>30]
			]);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("course_members", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("course_members");
	}
	
}