<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Messages controller
*	Handle messaging between Simer users
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Messages extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('message_model','msg');
		$this->load->model('block_model','block');
	}


	/**
	*Display all User messages
	*/
	public function home()
	{
		/**
		*i.check if user is logged in first(MY_Controller)
		*ii.get user id(MY_Controller)
		*iii.retrieve user's most recent message thread
		*/		
		
		//get all messages from most to least recent
		$history = $this->msg->get_msg_tip($this->user_id);
		$pointers = $register = $curr_user_reg = [];

		//sort pointers out		
		foreach($history as $hist):

			//ensure at most one user shows in logged in users message tile			
			if(in_array($hist->sender_id,$register) OR in_array($hist->recipient_id,$register))continue;
			
			//dont add logged in user id to register
			if($this->user_id !== $hist->sender_id)
				$register[] = $hist->sender_id;					
			 			
			//if last message was from logged in user, use recipient as key
			if($hist->sender_id === $this->user_id):

				//maintain one message per user								
				$pointers[] = $hist;	
				$register[] = $hist->recipient_id;				
			else:

				//retrieve latest message from this sender
				$pointers[] = $hist;
			endif;			
						
		endforeach;		
				
		//if there are messages, get the thread of the most recent convo
		if( sizeof($pointers) > 0 ):
			
			//get the most recent of message pointers
			$pointers_obj = new ArrayIterator($pointers);
			$curr_pointer_obj = $pointers_obj->current();

			//ensure not to check for where logged in user messaged their self
			if($curr_pointer_obj->recipient_id !== $this->user_id):			
				$this->data['first_pointer_thread'] = $this->msg->get_convo($curr_pointer_obj->recipient_id,$this->user_id,false);
			else:

				$this->data['first_pointer_thread'] = $this->msg->get_convo($curr_pointer_obj->sender_id,$this->user_id);
			endif;

		else:

			$this->data['first_pointer_thread'] = [];
		endif;
		
		$this->data['pointers'] = $pointers;
		$this->data['blocked'] = $blocked = $this->block->get_blocked_users(['blocker_id'=>$this->user_id]);
		$this->data['blocked_count'] = count($blocked);
		$this->data['user_id'] = $this->user_details->id;		
		$this->data['unread'] = count($this->msg->get_many_by(['recipient_id'=>$this->user_id,'viewed'=>0]));	
	}

	/**
	*send message to another simer 
	*accomodate multiple users	
	*/
	public function send()
	{

		$this->view = false;
		$this->form_validation->set_rules('recipients','Recipient','required');
		$this->form_validation->set_rules('message','Message Body','required');

		if($this->form_validation->run())
		{
			$data = $this->input->post();			

			$recepients = $data['recipients'];
			$success = true;

			//send message to all recepients listed
			if(strpos($recepients,';') == false)
			{
				$recipients = [trim($recepients)];
			}else
			{
				$recipients = explode(';',$recepients);
			}
			
			foreach($recipients as $recipient):					
				
				if($recipient == $this->user_id)continue;//in case someone tries shit

				$is_blocked = (bool)$this->block->get_by(['blocker_id'=>$recipient,'blocked_id'=>$this->user_id]);

				if(!$is_blocked)://send to recipient only if recipient dint block this nigga, otherwise make e fool emsef :D
					$result = $this->msg->send_message(
												$this->user_id,
												$recipient,											
												$data['message']											
											);

					$success = $success AND $result;
				endif;

			endforeach;

			if($success)
			{							
				//Todo: register notification
			}else
			{	
				$this->output->set_output(json_encode(['msg'=>'An error occured']));
			}
			//redirect(site_url("/messages/home"));
		}else
		{			
			$this->output->set_output(json_encode(['msg'=>validation_errors()]));
		}
	}

	/**
	*Delete individual messages
	*/
	public function delete($msg_id = false)
	{
		if(!$msg_id)
		{
			$this->message->set('error','You need to choose a message to delete');
			redirect('messages');
		}

		$success = $this->msg->delete($msg_id);

		if($success)
		{
			$this->message->set('success','Your Message Was Deleted Successfully.');
			$this->response = json_encode(array('type'=>'error','msg'=>'Your Message Was Sent Successfully.')); 			
			
			//Todo: register notification
		}else
		{
			$this->message->set('type','Your Message Was Not Successfully Deleted,Try Again.');
			if($this->_is_json())
			{
				$this->output->set_output(json_encode(
									array('type'=>error,
											'msg'=>'Your Message Was Not Sent Successfully Deleted,Try Again.'))
										);
			}
		}
	}

	/**
	*Delete message thread
	*/
	public function delete_thread($user_id = false)
	{
		$this->view = false;
		if($user_id)
		{
			$this->msg->delete_thread($this->user_id,$user_id);
		}	
	}

	/*
	*Block User
	*/
	public function block_user($blocked_id = false)
	{
		$this->view = false;
		if($blocked_id)
		{		
			$this->block->block_user($this->user_id,$blocked_id);

			//delete history		
			$this->msg->delete_thread($this->user_id,$blocked_id);
		}
	}

	/**
	*UnBlock User
	*/
	public function unblock_user($blocked_id = false)
	{
		$this->view = false;
		if($blocked_id)
		{
			$this->block->delete_by(['blocker_id'=>$this->user_id,'blocked_id'=>$blocked_id]);
		}
	}
	
	/**
	*
	* Get Message Thread 
	* Returns conversation thread between
	* Logged in user and named sender
	* @param user(int)
	* 
	*/
	public function get_thread($sender_id)
	{
		$this->view = false;

		//get all messages between the sender and logged in user
		$messages = $this->msg->get_convo($sender_id,$this->user_id);

		$data['messages'] = $messages;

		//set logged in user for view consumption
		$data['logged_in_user_id'] = $this->user_id;

		$data['sender_id'] = $sender_id;
	
		$this->output->set_output($this->load->view('messages/thread',$data,true));		
	}
 
}
/* End of file Messages.php*/
/* Location: ./application/controllers/messages.php*/
