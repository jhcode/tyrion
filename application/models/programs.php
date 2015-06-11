<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Program_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	*Fetch programs a user is subscribed to 
	*@param user_id(int)
	*@return programs (array)
	*/
	public function get_user_programs($user_id = false)
	{
		if(!$user_id) return false;
		return $this->db->get_where('program_members',array('user_id'=>$user_id))->result();
	}

	/**
	*is program member
	*@param user_id(int)
	*@param program_id(int)
	*@return boolean
	*/
	public function is_program_member($user_id = false,$program_id = false)
	{
		if(!$user_id || !$program_id) return false;
		return $this->db->get_where('program_members',array('user_id'=>$user_id,'program_id'=>$program_id))->result();
	}
}
/* End of file program*/
/* Location: ./application/models/program_model.php*/