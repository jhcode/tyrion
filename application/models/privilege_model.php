<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Privilege_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get($roles)
	{
		$this->load->model('user_model','user');		
		
		foreach ($roles as $key => $value) :
			$this->db->or_where([$key=>$value]);
		endforeach;

		$this->db->where(['parent_id'=>0]);
		$this->db->order_by('priority','asc');		
		
		return $this->db->get($this->_table)->result();
	}
}
/* End of file Privilege*/
/* Location: ./application/models/Privilege_model.php*/