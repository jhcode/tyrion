<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Programs controller
*	This is the interface
*	to handle all behaviours and
*	activities concerning
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Programs extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
	*Index
	*List all programs of the 
	*logged in user
	*/
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		return $this->fetch_programs($user_id);
	}

	/**
	*fetch_programs
	*List all programs of the 
	*specified user
	*@param user_id(int)
	*@return programs (array)
	*/
	public function fetch_programs($user_id = false)
	{
		if(!$user_id)
		{
			$this->message->set('error','Specify a user to view programs.');
			redirect('programs');
		}

		$programs = $this->program->get_user_programs($user_id);
		$this->response = json_encode($programs);
		return $programs;
	}

	/**
	*create program	
	*@return success (bool)
	*/
	public function create()
	{
		$this->form_validation->set_rules('name','Name of program','required|program_exists');
		$this->form_validation->set_rules('type','Type of program','required');
		$this->form_validation->set_rules('description','Name of program','required');
		$this->form_validation->set_rules('category_id','You must choose a category','required|is_natural_no_zero');

		if($this->form_validation->run()):

			$data = $this->input->post();
			$success = $this->program->insert(array($data));

			if($success):
				
				$this->message->set('success','The '.$data['name'].' program has been successfully created.');
				$this->response = 'The '.$data['name'].' program has been successfully created.';

			else:

				$this->message->set('error','The '.$data['name'].' program was not successfully created.');
				$this->response = 'The '.$data['name'].' program has been successfully created.';

			endif;

			//only redirect if its not an ajax call
			if(!_is_ajax())redirect('programs');

		endif;
	}

	/**
	*edit program	
	*@param program_id (int)
	*@return success (bool)
	*/
	public function edit($program_id = false)
	{
		//does this logged in user have the right to edit this program?
		if(!$program_id):

			$this->message->set('error','Specify a program to edit.');
			redirect('programs');

		endif;	

		$this->form_validation->set_rules('name','Name of program','required|program_exists');
		$this->form_validation->set_rules('type','Type of program','required');
		$this->form_validation->set_rules('description','Name of program','required');
		$this->form_validation->set_rules('category_id','You must choose a category','required|is_natural_no_zero');

		if($this->form_validation->run()):

			$data = $this->input->post();
			$success = $this->program->update($program_id,array($data));


			if($success):
				
				$this->message->set('success','Your program has been successfully updated.');
				$this->response = 'Your program has been successfully updated.';

			else:

				$this->message->set('error','Your program was not successfully updated.');
				$this->response = 'Your program has been successfully updated.';

			endif;

			//only redirect if its not an ajax call
			if(!_is_ajax())redirect('programs');

		endif;
	}

	/**
	*Invite user
	*Send invite to other users to join the program
	*@param program
	*/
	public function invite($program_id = false,$user_id = false)
	{
		if(!$program_id || !$user_id):

			$this->message->set('error','Specify a user to invite to the program.');
			redirect($_SERVER['HTTP_REFERER']);

		endif;	

		/*does this user have the right to invite other users?
		either he is the admin or a member of the program*/
		if(!is_admin() || !is_member($program)):

			$this->message->set('error','You are not allowed to do that.');	
		
		else:

			//Todo:send invite as notification #chikena
			$user = $this->user-.get($user_id);
			$this->message->set('success','Invitation sent to '.$user->firstname.' '.$user->lastname);
			$this->response = 'Invitation sent to '.$user->firstname.' '.$user->lastname;

		endif;	

		//only redirect if its not an ajax call
		if(!_is_ajax())redirect('programs');
	}

	/**
	*delete program	
	*@param program_id (int)
	*@return success (bool)
	*/
	public function delete($program_id)
	{
		if($program_id):
			$this->message->set('error','Specify a program to delete.');
			redirect('programs');
		endif;
		
		//Does this user have the right to delete this program
		if(!is_admin($program_id)):

			$this->message->set('error','You are not allowed to do that.');	

		else:

			$program = $this->program->get($id);
			$success = $this->program->delete($program_id);
			$this->message->set('success','You have successfully deleted the '.$program->name.' program.');			
			$this->response = 'You are not allowed to do that.';

		endif;

		//only redirect if its not an ajax call
		if(!_is_ajax())redirect('programs');						
	}

	/**
	*is_admin
	*@access private
	*@param program_id
	*@return is_admin (bool)
	*/
	private function is_admin($program_id)
	{				
		//is the logged in user the admin of specified program
		$program = $this->program->get($program_id);
		return $this->user->id === $program->admin_id;
	}

	/**
	*is_member
	*@access private
	*@param user_id
	*@param program_id	
	*@return is_admin (bool)
	*/
	private function is_member($user_id,$program_id)
	{				
		return $this->program->is_program_member($user_id,$program_id);
	}
}
/* End of file programs*/
/* Location: ./application/controllers/programs.php*/