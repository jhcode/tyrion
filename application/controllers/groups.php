<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Groups controller
*	This is the interface
*	to handle all behaviours and
*	activities concerning
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Groups extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('group_model','group');
		$this->load->model('group_member_model','member');
		$this->load->model('invitation_model','invitation');
		$this->load->model('user_model','user');
		$this->load->model('chat_model','chat');
		$this->load->model('interest_model','interest');
		$this->load->model('notification_model','notification');
	}

	public function home()
	{		
		$this->data['invitations'] = $this->invitation->order_by('time','desc')->get_many_by(['recipient'=>$this->user_details->id]);
		
		$this->data['joined_groups'] = $joined = $this->member->order_by('joined','desc')->get_many_by(['user_id '=>$this->user_details->id]);
		//$this->data['unjoined'] = $this->member->get_many_by(['user_id !='=>$this->user_details->id]);
		$this->data['shared_interest'] = $this->interest->dropdown('id','name','interest_id','ios-button inheritance addtag');
		$this->data['users_drop'] = $this->user->dropdown('id','firstname','user_id','ios-button addtag');

		$groups = $this->group->order_by('created','desc')->get_all();

		$user_interests = [];
		if($this->user_details->interests)
			$user_interests = explode(',',$this->user_details->interests);					


		//get suggested groups
		$suggested = [];$members = [];$tags = [];	
		foreach($groups as $group):

			//get group tags
			if($group->tags)
				$tags = explode(',',$group->tags);

			//check if user interests are in the group tags
			if((bool)array_intersect($user_interests,$tags) AND !$this->is_member($group->id,$joined))
			{
				$suggested[] = $group;				
			}				

			//get members of this current group
			$members[$group->id][] = $this->member->get_many_by(['group_id'=>$group->id]);
		endforeach;

		//print_r($suggested);exit();
 		
		$this->data['members'] = $members;
		$this->data['suggested'] = $suggested;
	}

	/*
	*Index
	*List all groups of the 
	*logged in user
	*/
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		return $this->fetch_groups($user_id);
	}

	/**
	*fetch_groups
	*List all groups of the 
	*specified user
	*@param user_id(int)
	*@return groups (array)
	*/
	public function fetch_groups($user_id = false)
	{
		if(!$user_id)
		{
			$this->message->set('error','Specify a user to view groups.');
			redirect('groups');
		}

		$groups = $this->group->get_user_groups($user_id);
		$this->response = json_encode($groups);
		return $groups;
	}

	/**
	*create group	
	*@return success (bool)
	*/
	public function create()
	{				
		$this->view = false;
		$this->form_validation->set_rules('title','Name of Group','required|group_exists');
		$this->form_validation->set_rules('privacy','Group Privacy','required');
		$this->form_validation->set_rules('overview','Group Overview','required');
		$this->form_validation->set_rules('theme','Theme selection','required');
		$this->form_validation->set_rules('tags[]','Tags','required');

		if($this->form_validation->run()):

			$data = $this->input->post();	
			$tags = (sizeof(json_decode($data['tags'])) == 0) ? "" : implode(',',json_decode($data['tags']));
			$post = [
						'privacy'=>$data['privacy'],
						'title'=>$data['title'],
						'overview'=>$data['overview'],
						'theme'=>$data['theme'],
						'creator_id'=>$this->user_details->id,						
						'tags'=>$tags,
						'created'=>time()
					];
			$success = $this->group->insert($post);
			$this->member->insert(['user_id'=>$this->user_details->id,'group_id'=>$success,'joined'=>time()]);

			redirect($_SERVER['HTTP_REFERER']);
			/*if($success):
									
				$this->output->set_output(json_encode(['error'=>false, 'msg'=>'The <strong>'.$data['title'].'</strong> group has been successfully created.']));

			else:
				
				$this->output->set_output(json_encode(['error'=>true, 'msg'=>'The creation of <strong>'.$data['title'].'</strong> group failed.']));

			endif;*/
			
		else:
			
			$this->output->set_output(json_encode(['error'=>true,'msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>']));

		endif;
	}

	/**
	*edit group	
	*@param group_id (int)
	*@return success (bool)
	*/
	public function edit($group_id = false)
	{
		//does this logged in user have the right to edit this group?
		if(!$group_id):

			$this->message->set('error','Specify a group to edit.');
			redirect('groups');

		endif;	

		$this->form_validation->set_rules('name','Name of Group','required|group_exists');
		$this->form_validation->set_rules('type','Type of Group','required');
		$this->form_validation->set_rules('description','Name of Group','required');
		$this->form_validation->set_rules('category_id','You must choose a category','required|is_natural_no_zero');

		if($this->form_validation->run()):

			$data = $this->input->post();
			$success = $this->group->update($group_id,array($data));


			if($success):
				
				$this->message->set('success','Your group has been successfully updated.');
				$this->response = 'Your group has been successfully updated.';

			else:

				$this->message->set('error','Your group was not successfully updated.');
				$this->response = 'Your group has been successfully updated.';

			endif;

			//only redirect if its not an ajax call
			if(!_is_ajax())redirect('groups');

		endif;
	}

	/**
	*Invite user
	*Send invite to other users to join the group
	*@param group
	*/
	public function invite()
	{
		$this->view = false;
		$_POST['tags'] = array(1,2,3);
		$_POST['recipient'] = 1;
		$_POST['sender'] = 2;$_POST['group_id'] = 2;
		$_POST['place_id'] = 1;
		$_POST['time'] = 18987654;

		$this->form_validation->set_rules('tags[]', 'User','required');

		//$_POST['tags'] = [1,2,3];
		//var_dump($this->input->post());

		if($this->form_validation->run()){
			
			$data = $this->input->post();
			$post[] = "";$post2[] ="";

			foreach($data['tags'] as $recipient):

				$post []= [
							'type'=>'group',
							'sender'=>$this->user_details->id,
							'recipient'=>$recipient,
							'place_id'=>$data['group_id'],
							'time'=>time()
						];
				$post2 [] = [
							'sender'=>$this->user_details->id,
							'recipient'=>$recipient,
							'type'=>'group',
							'type_id'=>$data['group_id'],
							'created'=>time()
				];
			endforeach;
			var_dump($post);var_dump($post2);
			$this->invitation->insert_many($post);
			$this->notification->insert_many($post2);
			//redirect('groups/home');
			$this->output->set_output(json_encode(['error'=>false,'msg'=>'<div class="alert alert-danger">Invitation sent</div>']));			
		}else{
			$this->output->set_output(json_encode(['error'=>true,'msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>']));			
		}
	}

	/**
	* Handle Invites Accept or Decline group invitations
	* @param $action = action from user(Accept or Decline)
	* @param $group_id
	* @param $invite_id Invitation id to delete invitation after being attended to
	*/
	public function handle_invite($action,$group_id,$invite_id){
		$this->view = false;
		if ($action === 'accept') {
			$post = ['user_id'=>$this->user_details->id,'group_id'=>$group_id,'joined'=>time()];
			$this->member->insert($post);
			$this->invitation->delete($invite_id);
			redirect($_SERVER['HTTP_REFERER']);
		}elseif($action === 'decline'){
			$this->invitation->delete($invite_id);
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

	public function chat(){
		$this->view = false;
		$this->form_validation->set_rules('message','Message','required');
		if($this->form_validation->run()){
			$data = $this->input->post();
			$post = [
			'type'=>'group',
			'resource_id'=>$data['group_id'],
			'user_id'=>$this->user_details->id,
			'message'=>htmlentities($data['message']),
			'time'=>time()];
			$this->chat->insert($post);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	*Get Group Box
	*From the template
	*/
	public function get_group($id = false)
	{
		$this->view = false;
		if(!$id) redirect($_SERVER["HTTP_REFERER"]);

		$this->data['group'] = $this->group->get($id);
		$this->data['members'] = $this->members->get_many_by($id);
		$this->data['chats'] = $this->chat->get_many_by($id);

		$group_markup = $this->load->view('groups/template',$this->data,true);

		$this->output->set_output($group_markup);
	}

	public function join($group_id){
		$this->view = false;
		$post = ['user_id'=>$this->user_details->id,'group_id'=>$group_id,'joined'=>time()];
		$this->member->insert($post);
		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	*delete group	
	*@param group_id (int)
	*@return success (bool)
	*/
	public function delete($group_id)
	{
		if($group_id):
			$this->message->set('error','Specify a group to delete.');
			redirect('groups');
		endif;
		
		//Does this user have the right to delete this group
		if(!is_admin($group_id)):

			$this->message->set('error','You are not allowed to do that.');	

		else:

			$group = $this->group->get($id);
			$success = $this->group->delete($group_id);
			$this->message->set('success','You have successfully deleted the '.$group->name.' group.');			
			$this->response = 'You are not allowed to do that.';

		endif;

		//only redirect if its not an ajax call
		if(!_is_ajax())redirect('groups');						
	}

	/**
	*is_admin
	*@access private
	*@param group_id
	*@return is_admin (bool)
	*/
	private function is_admin($group_id)
	{				
		//is the logged in user the admin of specified group
		$group = $this->group->get($group_id);
		return $this->user->id === $group->admin_id;
	}

	/**
	*is_member
	*@access private
	*@param group_id
	*@param groups(array)	
	*@return is_member (bool)
	*/
	private function is_member($group_id,$groups)
	{				
		foreach($groups as $group):
			
			if($group->group_id == $group_id) // if this is the group to confirm membership for
				return true;

		endforeach;

		return false;
	}

	public function build_group($id)
	{
		$this->view = false;
		$this->data['group'] = $this->group->get($id);
		$this->data['members'] = $this->member->get_many_by(['group_id'=>$id]);

		$this->data['chats'] = $this->chat->get_many_by(['resource_id'=>$id]);
		$group_temp = $this->load->view('groups/template', $this->data, true);

		$this->output->set_output($group_temp);
	}

	public function get_thread($group_id){
		$this->view = false;
		$chats = $this->chat->get_many_by(['type'=>'group','resource_id'=>$group_id]);
		//return $chats;
		$data['chats'] = $chats;
		$data['group'] = $this->group->get($group_id);
		$this->output->set_output($this->load->view('groups/thread',$data,true));
	}
}

/* End of file Groups*/
/* Location: ./application/controllers/groups.php*/