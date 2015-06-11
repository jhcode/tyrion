<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	Welcome controller
*	This serves as the landing 
*	and default controller for
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class Welcome extends MY_Controller
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
		$this->load->model('task_model','tasks');
		$this->load->model('user_model','user');
		$this->load->model('school_model','school');
	}

	/**
	*	Index
	*	The main landing page
	*	@param null
	*	@return null
	*/
	public function index()
	{	
	}

	/*
	public function home()
	{
		$this->layout = "layouts/application";
		$user = $this->user->get($this->user_details->id);
		$tasks = $this->tasks->order_by('day','asc')->get_all();
		$this->data['tasks'] = $tasks;
		$this->data['firstname'] = $this->user_details->firstname;
		$this->data['lastname'] = $this->user_details->lastname;
		$this->data['image'] = $user->image;
	}*/

	/**
	*	Sign User
	*	This is used to handle sign up
	*	For a scholar/ Independent User
	*	@param null
	*	@return null
	*/
	public function sign_user()
	{
		//handle form validation for the user
		$this->view = 'welcome/index';
		$this->form_validation->set_rules('fname','Firstname','required|alpha');
		$this->form_validation->set_rules('lname','Lastname','required|alpha');
		$this->form_validation->set_rules('email','Email','required|email|callback__is_unique_email');
		$this->form_validation->set_rules('pass','Password','required|min_length[8]');
		$this->form_validation->set_rules('confpass','Confirm password','required|matches[pass]');

		$this->form_validation->set_message('_is_unique_email','Sorry, a user already exists with that email, try another.');

		if($this->form_validation->run())
		{
			//if all is well and good, send verification link to users email.

			// Success Notification for users to get when form is valid
			$response = array('type'=>'success',
							  'content'=>'Your details were successfully received,
										a verification link has been sent to your email, please check your inbox 
										and follow the instructions.'
							);

			// Storing all input from user into array $data
			$data = $this->input->post();

			//Loading Necessary libraries to send emails and encrypt data					
			$config['mailtype'] = "html";
			$this->load->library('email',$config);
			$this->load->library('encrypt');

			//encrypt Users details
			$encrypted_data = $this->encrypt->encode($data['email']); // Encoding User email
			$encrypted_data .= "gda@"; // Added Salt
			$encrypted_data .= $this->encrypt->encode(time());// Encoding Unix time of user submission
			$encrypted_data .= "gda@"; // Added Salt
			$encrypted_data .= $this->encrypt->encode('user');// Encoding user type as user

			//create message to send to user
			$url = site_url('verify_account/'.$encrypted_data);
			$anchor = anchor($url,'Click Verification Link');
			$message_to_users = "Hi ".$data['fname']." ".$data['lname'].",<br> 
			Please follow the link below to activate your Simer account <br>".$anchor;			

			//Sending the user details
			$this->email->from('no-reply@simerapp.com', 'Simer Admin');			
			$this->email->to($data['email']);

			$this->email->subject('Simer Account Verification');
			$to_send = $this->load->view('welcome/mail_template',array('mail'=>$message_to_users), true);
			$this->email->message($to_send);
			

			//Pause CI mail function: $this->email->send();

			//use qservers email facility
			$this->load->library('qservers');
			$name = $data['fname']." ".$data['lname'];
			$this->qservers->send_mail($name,$data['email'],'Simer Account Verification',$to_send);

			//create the user			
			$this->user->insert(
									['firstname'=>$data['fname'],
										'lastname'=>$data['lname'],
										'email'=>$data['email'],
										'created'=>time(),
										//Use blowfish hash algorithm function from User Model to store DB password
										'password'=>$this->user->encrypt($data['pass'])
									]
								);

			$this->message->set('success', 'Verification link has been sent to your mail');
			redirect('welcome/index#scholarSignUp');
			/* Echo this for debugging purpose only
			echo $this->email->print_debugger();*/

		}else
		{
			//all was not well and good..
			$response = array('type'=>'error','msg'=>validation_errors());
		}
	}

	/**
	*	Sign School
	*	This is used to handle sign up
	*	For a school
	*	@param null
	*	@return null
	*/
	public function sign_school()
	{

		//handle form validation for the user
		$this->view = 'welcome/index';
		$this->form_validation->set_rules('sch_name','School Name','required|callback__is_unique_school');
		$this->form_validation->set_rules('sch_email','Email','required|email|callback__is_unique_email');
		$this->form_validation->set_rules('sch_pwd','Password','required|min_length[8]');
		$this->form_validation->set_rules('sch_vpwd','Confirm password','required|matches[sch_pwd]');

		$this->form_validation->set_message('_is_unique_email','Sorry, a school already exists with 
		that email, try another.');

		$this->form_validation->set_message('_is_unique_school','Sorry, a school already exists by that name.');

		if($this->form_validation->run())
		{
			//if all is well and good, send verification link to users email.

			// Success Notification for Schools to get when form is valid
			$response = array('type'=>'success',
							  'content'=>'Your details were successfully received,
										a verification link has been sent to your email, please check your inbox 
										and follow the instructions'
							);

			// Storing all input from user into array $data
			$data = $this->input->post();

			//Loading necessary libraries to send emails and encrypt data
			$config['mailtype'] = "html";
			$this->load->library('email',$config);
			$this->load->library('encrypt');

			//Email Preferences and configurations			
			
			//encrypt Users details
			$encrypted_data = $this->encrypt->encode($data['sch_email']); // Encoding User email
			$encrypted_data .= "gda@"; // Added Salt
			$encrypted_data .= $this->encrypt->encode(time());// Encoding Unix time of user submission
			$encrypted_data .= "gda@"; // Added Salt
			$encrypted_data .= $this->encrypt->encode('school');// Encoding type as school

			//create message to send to school
			$url = site_url('verify_account/'.$encrypted_data);
			$anchor = anchor($url,'Click verification link here');
			$message_to_users = $data['sch_name'].", <br>
			please follow the link below to activate your school's Simer account <br>".$anchor;

			//Sending the user details
			$this->email->from('no-reply@simerapp.com', 'Simer Admin');			
			$this->email->to($data['sch_email']);

			$this->email->subject('Simer Account Verification');
			$to_send = $this->load->view('welcome/mail_template',array('mail'=>$message_to_users), true);
			$this->email->message($to_send);

			//Pause CI mail function: $this->email->send();

			//use qservers email facility
			$this->load->library('qservers');
			$this->qservers->send_mail($data['sch_name'],$data['sch_email'],'Simer Account Verification',$to_send);

			/*TODO: Start a transaction here*/

			//add admin as a user and get id of that user
			$user_id = $this->user->insert([
									'firstname'=>$data['sch_name'],
									'lastname'=>'admin',
									'email'=>$data['sch_email'],
									'is_admin'=>1,
									'created'=>time(),
									//Use blowfish hash algorithm function from User Model to store DB password
									'password'=>$this->user->encrypt($data['sch_pwd'])
									]
								);
			//create the school
			$school_id =$this->school->insert(array(
						'name'=>$data['sch_name'],
						'admin_id'=>$user_id,
						'created'=>time()
						)
					);

			//set up role for user
			$this->load->model('role_model','role');
			$this->role->insert(['role'=>'admin','user_id'=>$user_id,'school_id'=>$school_id,'created'=>time()]);

			/*End a transaction here*/

			$this->message->set('success', 'Verification link has been sent to your mail');
			redirect('welcome/index#schoolSignUp');
			/* Echo this for debugging purpose only
			echo $this->email->print_debugger();*/
		}else
		{
			//all was not well and good..
			$response = array('type'=>'error','msg'=>validation_errors());
		}
	}

	/**	
	*Verifying the returned link from users
	*@param type - school/user (string)
	*@param url (string)
	*/
	public function verify_account($url = false)
	{
		if(!$url):
			$this->message->set('error','You need to follow the verification link from your email.');
			redirect('login');
		endif;

		$url_breakdown = explode('gda@',$url);
		if(sizeof($url_breakdown) < 3)
		{
			//this means the link is corrupt
			$this->message->set('error','This link has beeen compromised, please try signing up again.');
			redirect('login');
		}
		
		list($rcvd_mail,$rcvd_time,$type) = $url_breakdown;

		$this->load->library('encrypt');
		$type = $this->encrypt->decode($type);

		if ($type === 'user') 
		{			
			$rcvd_mail = $this->encrypt->decode($rcvd_mail);
			$rcvd_time = $this->encrypt->decode($rcvd_time);

			$user_obj = $this->user->get_by(array('email'=>$rcvd_mail));

			//if user email is not found, the link is not valid	
			if(!$user_obj):				
				$this->message->set('error','Invalid email, please try signing up again.');
				redirect('login');
			endif;

			$current_time = time();// Collecting present time stamp to compare with time of user verification

			/* Subtracting $rcvd_time from $current_time and ensuring it's not greater than 
			600s(10 minutes) */
			if (($rcvd_mail == $user_obj->email) && ($current_time - $rcvd_time <= 600))
			{
				$this->message->set('success', 'Your account has been verified, login here.');
				
				// Change the value of the verified column on DB to 1 to show user is verified
				$this->user->update($user_obj->id, ['verified'=>1,'active'=>1]);

				//send user to login			
				redirect('login');

			}elseif($current_time - $rcvd_time > 600)
			{
				$this->message->set('error','Time has expired');
				redirect('welcome#scholarSignUp');
			}			
			
		}elseif ($type === 'school') 
		{
			$rcvd_mail = $this->encrypt->decode($rcvd_mail);
			$rcvd_time = $this->encrypt->decode($rcvd_time);
			
			$school_admin = $this->user->get_by(array('email'=>$rcvd_mail));

			//if user email is not found, the link is not valid	
			if(!$school_admin):			

				$this->message->set('error','Invalid email, please try signing up again.');
				redirect('login');

			endif;

			$current_time = time();// Collecting present time stamp to compare with time of user verification

			/* Subtracting $rcvd_time from $current_time and ensuring it's not greater than 
			600(10 minutes) */
			if (($rcvd_mail == $school_admin->email) && ($current_time - $rcvd_time <= 600))
			{
				$this->message->set('success', 'Your account has been verified, login here.');
				$this->user->update($school_admin->id, ['verified'=>1,'active'=>1]);					

				//send user to login			
				redirect('login');

			}elseif($current_time - $rcvd_time > 600)
			{
				$this->message->set('error','Time has expired');
				redirect('welcome#schoolSignUp');
			}
		}else
		{			
			//this means the link is corrupt
			$this->message->set('error','This link has beeen compromised, please try signing up again.');
			redirect('login');
		}		
	}


	/**
	*	Compose and send verification link
	*	@param type-> school || user(string)
	*	@return bool
	*/
	public function compose_verification($from, $to, $message)//TODO: Make all mail composing happen here ->DRY SHIT
	{	

	}

	/**
	*	Resend Verification
	*	@param email(string)
	*	@return void
	*/
	public function resend_verification($user_id = false)
	{	
		$message = "Invalid User Details";
		if(!$user_id)redirect('login');

		$user = $this->user->get($user_id);
		if(!$user)
		{
			$this->message->set('error',$message);
			redirect('login');
		}

		$type_of_user = $name = "";
		if((bool)$user->is_admin):

			$type_of_user =  "school";
			$name = $this->school->get_by(['admin_id'=>$user->id])->name;
		else:

			$type_of_user =  "user";
			$name = $user->firstname." ".$user->lastname;
		endif;
	
		//Loading necessary libraries to send emails and encrypt data
		$config['mailtype'] = "html";
		$this->load->library('email',$config);
		$this->load->library('encrypt');		
		
		//encrypt Users details
		$encrypted_data = $this->encrypt->encode($user->email); // Encoding User email
		$encrypted_data .= "gda@"; // Added Salt
		$encrypted_data .= $this->encrypt->encode(time());// Encoding Unix time of user submission
		$encrypted_data .= "gda@"; // Added Salt
		$encrypted_data .= $this->encrypt->encode($type_of_user);// Encoding user type

		//create message to send to school
		$url = site_url('verify_account/'.$encrypted_data);
		$anchor = anchor($url,'Click verification link here');
		$message_to_users = ucfirst($name).", <br>
		Please follow the link below to activate your school's Simer account <br>".$anchor;

		//Sending the user details
		$this->email->from('no-reply@simerapp.com', 'Simer Admin');			
		$this->email->to($user->email);

		$this->email->subject('Simer Account Verification');
		$to_send = $this->load->view('welcome/mail_template',array('mail'=>$message_to_users), true);
		
		//Pause CI mail function: $this->email->message($to_send);$this->email->send();

		//use qservers email facility
		$this->load->library('qservers');
		$success = $this->qservers->send_mail($name,$user->email,'Simer Account Verification',$to_send);

		if(!$success):
			$this->message->set('error','There was an error sending the mail.  '. anchor('welcome/reverify/'.$user->id,'Try Again'));
		else:
			$this->message->set('success','Verification mail has successfully been sent.');
		endif;		
		redirect('login');
	}

	/**
	*	is unique email
	*	Check if a user already exists
	*	@param email
	*	@return bool
	*/
	public function _is_unique_email($email)
	{	
		return $this->user->is_unique_email($email);
	}

	/**
	*	is unique school
	*	Check if a school already exists
	*	@param school
	*	@return bool
	*/
	public function _is_unique_school($school)
	{	
		return $this->school->is_unique_school($school);
	}

}

/* End of file Welcome.php*/
/* Location: ./application/controllers/Welcome.php*/
