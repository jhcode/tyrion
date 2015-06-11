<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Message_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	*Send message to a simer user
	*@param us3r_id(int)
	*@param title(string)
	*@param body('string
	*/
	public function send_message($from = 0, $to = 0, $body=false)
	{

		if(!$from || !$to || !$body)return false;
		
		$success = $this->insert(
							array(

								'sender_id'=>$from,
								'recipient_id'=>$to,								
								'message'=>$body,
								'viewed'=>0,
								'deleted'=>0,
								'created'=>time()
							)
					 );

		return $success;
	}

	/**
	*get conversation
	*Get sequence of messages in chronological order
	*
	*/
	public function get_convo($sender_id, $recipient_id,$set_viewed = true)
	{					
		if($set_viewed)$this->set_viewed_msg($sender_id, $recipient_id);
					
		$this->db->select('*');

		$where =  "`recipient_id` = $sender_id AND `sender_id` = $recipient_id AND `deleted`!= $recipient_id OR `recipient_id`= $recipient_id AND `sender_id`=$sender_id AND `deleted`!= $recipient_id";

		$this->db->where($where);				

		$this->order_by('created','asc');
		
		return $this->db->get($this->_table)->result();
	}

	/**
	*Get the most recent messages	
	*read/unread
	*/
	public function get_msg_tip($user_id)
	{
		$this->db->select('*');
		
		$where =  "`recipient_id` = $user_id AND `deleted`!= $user_id OR `sender_id`=$user_id AND `deleted`!= $user_id";
		$this->db->where($where);

		$this->db->order_by('created','desc');

		return $this->get_all();
	}

	/**
	*set viewed message
	*Update Viewed Messages	
	*I.e message viewed by logged in user as recipient
	*/
	public function set_viewed_msg($sender_id, $recipient_id)
	{		
		$user_id = $this->session->userdata('user_details')->id;
		$this->update_by(['recipient_id'=>$user_id,'sender_id'=>$sender_id],['viewed'=>1]);		
	}

	/**
	*Delete Message Thread
	*/
	public function delete_thread($user_id,$sender_id)
	{		
		//delete messages that have been flagged for delete previously
		$where =  "`recipient_id` = $user_id AND `sender_id` = $sender_id AND `deleted`>0 AND `deleted`!=$user_id OR `recipient_id`= $sender_id AND `sender_id`=$user_id AND `deleted`>0 AND `deleted`!=$user_id";		
		$this->db->delete($this->_table,$where);

		//flag message to be deleted with ID of logged in user if the message hasn't been flagged before
		$where =  "`recipient_id` = $user_id AND `sender_id` = $sender_id AND `deleted`= 0 OR `recipient_id`= $sender_id AND `sender_id`=$user_id AND `deleted`= 0";		
		$this->update_by($where,['deleted'=>$user_id]);
	}
}
/* End of file Message.php*/
/* Location: ./application/models/message_model.php*/