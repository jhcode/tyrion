<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**********************************
*	Login controller
*	This handles authentication
*	for Simer v2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/

class Login extends MY_Controller 
{	
	/**
	*	__Construct
	*	Le constructor
	*	@param null
	*	@return null
	*/
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('school_model','school');
	}

	/**
	*	Index
	*	This is used to handle login
	*	For independent users
	*	@param null
	*	@return null
	*/
	
	public function index()
	{		
		//handle form validation for the user login
		$this->form_validation->set_rules('email','Email','required|callback__user_exists|callback__is_verified');
		$this->form_validation->set_rules('pass','Password','required');		

		$this->form_validation->set_message('_user_exists','Sorry, that email and password combination is incorrect.');		

		if($this->form_validation->run())
		{									
			//if user is admin
			if((bool)$this->user_details->is_admin):

				//check if school is flagged as paid: Schools like Nobel and Co(the rest), Manual payment flag
				$school = $this->school->get_by(['admin_id'=>$this->user_details->id]);
				$has_paid = $school->paid;

				//redirect to payment page here
				if(!$has_paid):
					redirect('https://www.gtwebpay.com?merchant_id=1241341234&callback="'.site_url('/schools/setup/'.$school->id).'"');
				endif;
				
			endif;
			
			//user has successfully logged in, set up session
			$this->session->set_userdata('user_details',$this->user_details);

			//update last login
			$this->user->update($this->user_details->id,["last_login"=>time()]);			

			if(!(bool)$this->user_details->last_login)://if this is users first login			
				redirect('home#walkthrough');	
			else:
				redirect('home');	
			endif;		
		}
	}

	/**
	*	user_exists
	*	Check if a user actually exists
	*	With the given Credentials
	*	@param null
	*	@return bool
	*/
	public function _user_exists()
	{	
		$params['email'] = $this->input->post('email');
		$params['password'] = $this->input->post('pass');
		
		$is_authenticated = $this->user->verify_user($params);
		

		return (bool)$is_authenticated;
	}

	/**
	*	is verified
	*	Check if a user has been verified
	*	With the given Credentials
	*	@param $email (string)
	*	@return bool
	*/
	public function _is_verified($email)
	{	

		$this->user_details = $user = $this->user->get_by(array('email'=>$email));

		if(!$this->user_details)return false;
		
		$verification_msg = 'Oops, it seems your account has not been verified. 
									'.anchor('welcome/reverify/'.$user->id,'Resend verification link?');

		$this->form_validation->set_message('_is_verified',$verification_msg);

		if((bool)$this->user_details->verified):

			/*if user is not a regular user and is not admin(admin should be directed to payment page), 
			**check if their school is active here*/
			if(!$this->user->is_regular($user) && !$this->user_details->is_admin):
				 
				$this->load->model('role_model','role');

				//get school_Id
				$school_id = $this->role->get_by(['user_id'=>$user->id])->school_id;

				//check if school is active
				$this->_is_school_active($school_id);		
			endif;

			//then indicate that user is verified
			return true;
		endif;

		return false;
	}

	/**
	*	is school active
	*	Check if a user's school is active
	*	@param school_id (int)
	*	@return bool
	*/
	public function _is_school_active($school_id)
	{		
		$is_active = $this->school->get($school_id)->active;

		if(!$is_active):
			$this->message->set('error','Your school is not active on Simer, if you feel otherwise, contact your administrator');
		endif;

		redirect('login');
	}

	/**
	*	logout
	*	Log a user out
	*/
	public function logout()
	{	
		$this->session->sess_destroy();
		redirect('login');
	}
}
 
