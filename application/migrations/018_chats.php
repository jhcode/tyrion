<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Chats extends CI_Migration
{
	public function up()
	{
		//Chats table
		$this->dbforge->add_field([
									"id"=>["type"=>"int", "auto_increment"=>TRUE],											 
									"type"=>["type"=>"varchar", "constraint"=>255],
									"resource_id"=>["type"=>"int", "constraint"=>255],
									"user_id"=>["type"=>"int", "constraint"=>255],
									"time"=>["type"=>"int", "constraint"=>100],
									"message"=>["type"=>"text"]
									]
		);
		$this->dbforge->add_key('id',true);
		$this->dbforge->create_table("chats", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("chats");
	}

}