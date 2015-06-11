<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Migration_Notice_details extends CI_Migration
{
	public function up()
	{
		//Noticeboard table
		$this->dbforge->add_field(	array(
											"id"=>array("type"=>"int", "auto_increment"=>TRUE),											 
											"notice_id"=>array("type"=>"int", "constraint"=>255),
											"image_url"=>array("type"=>"varchar", "constraint"=>255),
											"is_cover"=>array("type"=>"tinyint", "constraint"=>1)
										)
		);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table("notice_details", true);
	}

	public function down()
	{
		$this->dbforge->drop_table("notice_details");
	}

}