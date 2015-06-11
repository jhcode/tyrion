<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Settings extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('school_model','school');		
	}

	/**
	*Save basic information for a user
	*/
	public function save_user_basic()
	{
		
	}

	/**
	*Save basic information for a user
	*/
	public function save_user_basic()
	{
		
	}

	/**
	*Crunch total profile completion for users
	*/
	public function user_profile_complete()
	{
		$this->data['complete'] = (
									$this->user_basic_profile_complete() + 
								  	$this->user_location_complete() + 
								  	$this->user_interests_complete() +
								  	$this->user_interests_complete()
								  )/4; 
	}

	/*************************************************************************
	*	Make the profile complete crunching process granular, 
	*	just in case we need the individual innformation at some point dans la future.
	*************************************************************************/

	/**
	*Crunch total basic profile completion for users
	*/
	private function user_basic_profile_complete()
	{
		/*The properties are either set or unset*/

		//set user alias here, fvcking tired of the long ass name already!
		$user = $this->user_details;

		//is firstname set?
		$complete = ($user->firstname == "")? 0 : 100;

		//is middlename set?
		$complete += ($user->middlename == "")? 0 : 100;

		//is lastname set?
		$complete += ($user->lastname == "")? 0 : 100;

		//is date of birth set?
		$complete += ($user->dob == "")? 0 : 100;

		//is gender set?
		$complete += ($user->gender == "")? 0 : 100;

		//is email set?
		$complete += ($user->email == "")? 0 : 100;

		//is phone set?
		$complete += ($user->phone == "")? 0 : 100;

		//is users image set?
		$complete = ($user->image == "")? 0 : 100;

		//is about me set?
		$complete += ($user->about == "")? 0 : 100;

		return $complete/8;

	}

	/**
	*Crunch total location completion for users
	*/
	private function user_location_complete()
	{
		/*The properties are either set or unset*/

		//set user alias here, fvcking tired of the long ass name already!
		$user = $this->user_details;

		//is country set?
		$complete = ($user->country == "")? 0 : 100;

		//is state set?
		$complete += ($user->state == "")? 0 : 100;	

		//is LGA set?
		$complete += ($user->LGA == "")? 0 : 100;	

		//is address set?
		$complete += ($user->address == "")? 0 : 100;	

		return $complete/4;
	}

	/**
	*Crunch total interests completion for users
	*/
	private function user_interests_complete()
	{
		//is user interests set?
		$complete = ($user->inserests == "")? 0 : 100;
		return $complete;
	}

	/**
	*Crunch total social completion for users
	*/
	private function user_social_complete()
	{
		//is facebook user name set?
		$complete = ($user->facebook_handle == "")? 0 : 100;

		//is twitter user name set?
		$complete = ($user->twitter_handle == "")? 0 : 100;

		//is google + user name set?
		$complete = ($user->google_handle == "")? 0 : 100;

		return $complete/3;
	}

	/**
	*Crunch total profile completion for school
	*/
	public function school_profile_complete()
	{
		
	}
}
/* End of file Settings*/
/* Location: ./application/controllers/Settings.php*/