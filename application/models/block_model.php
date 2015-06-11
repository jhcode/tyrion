<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Blocks Model
*	Handles most database calls to the
*	Blocks(Blockboard) table.
*	@ver Simer2.0
* 	Copyright (c) 2014
*/
class Block_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function block_user($user_id,$blocked_id)
	{	
		$has_been_blocked = $this->get_by(['blocker_id'=>$user_id,'blocked_id'=>$blocked_id]);

		if(!$has_been_blocked)
			$this->block->insert(['blocker_id'=>$user_id,'blocked_id'=>$blocked_id]);
	}

	public function get_blocked_users($where)
	{
		//$where = func_get_args();
		$this->db->select('users.id as id, firstname,lastname,blocked_id,image');
		$this->db->join('users','blocks.blocked_id = users.id');

		return $this->db->get_where($this->_table,$where)->result();
	}
}


/* Location: ./application/models/Block_model.php*/