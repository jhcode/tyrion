<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Users controller
*	This serves as the landing 
*	and default controller for
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('task_model','tasks');
		$this->load->model('user_model','user');
		$this->load->model('notice_model', 'notice');
		$this->load->model('notification_model','notifications');
		$this->load->model('message_model','messages');
	}

	/**
	*Home Page for all users
	*/
	public function home()
	{
		$this->view = 'users/'.get_default_role($this->user_details).'/home';
		$this->data['user'] = $this->session->userdata('user_details');
		$this->data['tasks'] = $this->tasks->order_by('created','asc')->get_all();
		$this->data['notices'] = $this->notice->get_all();

		if(!(bool)$this->user_details->last_login)://if this is users first login

			$user_full_name = ucfirst($this->user_details->firstname)." ".ucfirst($this->user_details->lastname);
			$data['user_full_name'] = $user_full_name;

			//just for admin though
			$this->load->config('school_defaults');
			$data['levels'] = $this->config->item('levels');
			$data['grades'] = $this->config->item('grades');
			$data['subjects'] = asort($this->config->item('subjects'));
			
			$this->data['walkthrough'] = $this->load->view('users/'.get_default_role($this->user_details).'/walkthrough',$data,true);					
		endif;
	}

	public function get_users($user = false)
	{
		$this->view = false;

		$all_users = $this->user->get_searched_users(['id !='=>$this->user_id],$this->input->get('q'));
		$response = array();
		
		foreach($all_users as $user):
			$response[] = [ "id" => $user->id , 
							"name" => $user->firstname." ".$user->middlename." ".$user->lastname ,
							"image"=>check_image($user->image,true)
						  ];
		endforeach;

		$this->output->set_content_type('application/json')->set_output(json_encode($response));		
	}

	
	public function get_notifications()
	{
		$this->view  = false;
		$data = $this->notifications->get_many_by(['recipient_id'=>$this->user_id, 'viewed'=>0]);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));

		//Flag notifications as 'viewed'
		//$success = $this->notifications->update_by(['to'=>$this->user_id], ['viewed'=>1]);
	}

	public function get_notification_count()
	{
		$this->view  = false;
		$data['count'] = count($this->notifications->get_many_by(['recipient_id'=>$this->user_id, 'viewed '=>0]));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_unseen_messages()
	{
		$this->view  = false;		
		$data = $this->messages->order_by('created','desc')->limit(10)->get_many_by(['recipient_id'=>$this->user_id]);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_unseen_message_count()
	{
		$this->view  = false;		
		$data['count'] = count($this->messages->get_many_by(['recipient_id'=>$this->user_id,'viewed'=>0]));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
}