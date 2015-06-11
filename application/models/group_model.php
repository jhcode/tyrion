<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Group_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	*Fetch groups a user is subscribed to 
	*@param user_id(int)
	*@return groups (array)
	*/
	public function get_user_groups($user_id = false)
	{
		if(!$user_id) return false;
		return $this->db->get_where('group_members',array('user_id'=>$user_id))->result();
	}

	/**
	*is group member
	*@param user_id(int)
	*@param group_id(int)
	*@return boolean
	*/
	public function is_group_member($user_id = false,$group_id = false)
	{
		if(!$user_id || !$group_id) return false;
		return $this->db->get_where('group_members',array('user_id'=>$user_id,'group_id'=>$group_id))->result();
	}
}
/* End of file Group*/
/* Location: ./application/models/group_model.php*/