<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Resources extends CI_Migration
{
	public function up()
	{
		//groups table
      $this->dbforge->add_field(	
      								[	
										"id"=>["type"=>"int", "auto_increment"=>TRUE],											
										"title"=>["type"=>"varchar", "constraint"=>255],
										"description"=>["type"=>"text"],
										"type"=>["type"=>"varchar", "constraint"=>11],
										"source"=>["type"=>"varchar", "constraint"=>255],
										"privacy"=>["type"=>"varchar","constraint"=>25],											
										"created"=>["type"=>"int"],
										"modified"=>["type"=>"int"]							
									]
								)
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("resources", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("group_members");
	}

}
