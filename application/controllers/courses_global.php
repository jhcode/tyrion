<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Courses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('course_model', 'course');
		$this->load->model('comment_model', 'comment');
		$this->load->model('chat_model','chat');
		$this->load->model('resource_model','resource');
		$this->load->model('course_member_model', 'member');
		$this->load->model('course_outline_model','outline');
		$this->load->model('attachment_model','attachment');
	}
	public function index(){
		$this->data['created'] = $this->course->order_by('created','desc')->get_many_by(['founder'=>$this->user_details->id]);
		$this->data['members'] = $this->member->order_by('joined','desc')->get_many_by(['user_id'=>$this->user_details->id]);
		$this->data['suggestion'] = $this->course->order_by('created','desc')->get_many_by(['privacy'=>"public"]);
		$this->data['sess_name'] = $this->user_details->firstname." ".$this->user_details->lastname;
		$this->form_validation->set_rules('title','Course Title','required');
		$this->form_validation->set_rules('overview','Course Overview', 'required');
		
		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$post = [
			'privacy' => $data['privacy'],
			'title' => $data['title'],
			'overview' => $data['overview'],
			'founder' => $this->user_details->id,
			'created' => time() ];
			
			$course = $this->course->insert($post);
			$membership = [
			'user_id'=>$this->user_details->id,
			'course_id'=> $course,
			'joined'=>time()];
			$this->member->insert($membership);
			redirect(site_url()."courses/view/".$course);
		}

		$this->data['created'] = $this->course->order_by('created','desc')->get_many_by(['founder'=>$this->user_details->id]);
		$this->data['members'] = $this->member->order_by('joined','desc')->get_many_by(['user_id'=>$this->user_details->id]);
		$this->data['suggestion'] = $this->course->order_by('created','desc')->get_many_by(['privacy'=>"public"]);
		$this->data['sess_name'] = $this->user_details->firstname." ".$this->user_details->lastname;
	}

	public function view($course = false)
	{
		$this->load->view('courses/globalview');
		if($course == false){redirect(site_url("courses"));}
		$course_info = $this->course->get($course);
		$membership = $this->member->order_by('joined','desc')->get_many_by(['course_id'=>$course]);
		$courses = $this->resource->order_by('modified','desc')->get_many_by(['course_id'=>$course]);
		$this->data['outlines'] = $this->outline->order_by('time','desc')->get_many_by(['course_id'=>$course]);

		foreach($courses as $coursep):

			$this->data['attachments'] = $this->attachment->get_by(['resource_id'=>$coursep->id]);
			if($coursep->type === 'live_class'):
			$this->data['chats'] = $this->chat->get_many_by(['resource_id'=>$coursep->id]);
			endif;
			
		endforeach;

		$this->data['members'] = $membership;
		$this->data['course_info'] = $course_info;
		$this->data['courses'] = $courses;

		$this->data['notes'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'note']);
		$this->data['videos'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'video']);
		$this->data['assignments'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'assignment']);
		$this->data['announcements'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'announcement']);
		$this->data['quizzes'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'quiz']);
		$this->data['live_class'] = $this->resource->get_many_by(['course_id'=>$course,'type'=>'live_class']);

		$this->data['user_info'] = $this->user->get($course_info->founder);
	}

	public function add($course_id = false, $type = false)
	{
		$this->view = false;

		$this->data['type'] = $type;

		$this->form_validation->set_rules('title', 'Post Title', 'required');

		if($type === 'video'){
			$this->form_validation->set_rules('details', 'Post Content', 'required|callback_is_youtube_link');
		}else{
			$this->form_validation->set_rules('details', 'Post Content', 'required');
		}

		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$post = [
			'type' => $type,
			'course_id' => $course_id,
			'title' => $data['title'],
			'details' => $data['details'],
			'created' => time(),
			'modified' => time() ];

			$this->resource->insert($post);
			$this->message->set('success',"{$type} Added");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$response = [ 'type'=>'error','content'=>validation_errors() ];
		}
	}

	/**
	*Edit posts
	*/
	public function edit($course_id = false, $type = false, $id = false)
	{
		$this->view = false;
		$course = $this->resource->get($id);
		$this->data['course'] = $course;
		$this->data['type'] = $type;

		$this->form_validation->set_rules('title', 'Post Title', 'required');

		if($type == 'video'){
			$this->form_validation->set_rules('content', 'Post Content', 'required|callback_is_youtube_link');
		}else{
			$this->form_validation->set_rules('content', 'Post Content', 'required');
		}

		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$post = [
			'type' => $type,
			'title' => $data['title'],
			'content' => $data['content'],
			'modified' => time() ];
			$this->resource->update($id, $post);
			$this->message->set('success',"Course Updated");
		}else{
			return json_encode([ 'type'=>'error','content'=>validation_errors() ]);
		}
	}

	/**
	*Edit Course Details
	*/
	public function edit_course()
	{
		// if(!$id) $this->output->set_output(json_encode(['error'=>true,'msg'=>'Specify A Course.']));

		$this->form_validation->set_rules('title','Course Title','required');
		$this->form_validation->set_rules('desc','Course Description','required');
		$this->form_validation->set_rules('id','Course','required');

		$data = $this->input->post();

		if($this->form_validation->run()):
			$this->course->update($data['id'],['title'=>$data['title'],'overview'=>$data['desc']]);
			//$this->output->set_output(json_encode(['error'=>false,'msg'=>'Course edited successfully.']));

			redirect($_SERVER['HTTP_REFERER']);
		else:
			$this->output->set_output(json_encode(['error'=>true,'msg'=>'Specify A Course.']));
		endif;
	}

	/**
	* edit_outline
	* Method to handle course outline updates
	*
	*/
	public function edit_outline($outline_id)
	{
		$this->form_validation->set_rules('title','Outline Title','required');
		if ($this->form_validation->run()) {
			$data = $this->input->post();
			/*list($d,$m,$y) = explode('/',$data['date']);
			$time = strtotime($m.'/'.$d.'/'.$y.' '.$data['time'].' '.$data['meridian']);*/
			$post = ['title'=>$data['title'],'description'=>$data['description']];
			$this->outline->update($outline_id, $post);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete_outline($id){
		$this->view = false;
		$this->outline->delete($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	* Delete Course resources
	*/
	public function remove($course_id, $id)
	{
		$this->view = false;
		$this->resource->delete($id);
		redirect($site_url.'/courses/view/'.$course_id);
	}

	public function join($id, $course_id)
	{
		$this->view = false;
		$this->member->insert(['user_id'=>$id,'course_id'=>$course_id,'joined'=>time()]);
		redirect($site_url.'/courses/view/'.$course_id);
	}
	/**
	*
	* Live Class chat method
	* @param resource_id present live class
	* @param user_id chat user
	*/
	public function chat($resource_id,$user_id)
	{
		$this->view = false;
		$this->form_validation->set_rules('chat', 'Chat', '');
		if ($this->form_validation->run()) 
		{
			$data = $this->input->post();
			$post = [
			'type'=> 'live_class',
			'resource_id' => $resource_id,
			'user_id'=> $user_id,
			'time'=>time(),
			'message'=>$data['chat'] ];
			$this->chat->insert($post);
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$response = ['type'=>'error','content'=>validation_errors()];
		}
	}

	public function delete_member($id){
		$this->view = false;
		$this->member->delete($id);
		redirect($_SERVER['HTTP_REFERER']);
	}


	/**
	* Callback Function
	* To Check if Link is genuine YouTube link
	*
	* @param $link
	**/
	public function is_youtube_link($link)
	{
		$http = substr($link, 7, -20);
		$www_http = substr($link, 11, -20);
		$https = substr($link, 8, -20);
		$www_https = substr($link, 12, -20);
		if ((strlen($link) == 38) and ($http == "youtube.com")) {
			return TRUE;
		}elseif((strlen($link) == 39) and ($https == "youtube.com")){
			return TRUE;
		}elseif((strlen($link) == 42) and ($www_http == "youtube.com")){
			return TRUE;
		}elseif((strlen($link) == 43) and ($www_https == "youtube.com")){
			return TRUE;
		}else{
			$this->form_validation->set_message('is_youtube_link', 'Invalid Youtube URL');
			return FALSE;
		}
	}

	/**
	* Add New Course On Add-more
	**/

	public function get_next_course_id(){
		$post = [
		'privacy' => 'private',
		'title' => 'New Course',
		'overview' => 'Enter Description',
		'founder' => $this->user_details->id,
		'created' => time() ];
		
		$course = $this->course->insert($post); 
		$this->output->set_content_type('application/json')->set_output(json_encode($course));
	}

	public function add_more_courses(){
		$data = $this->input->post();
		$post = [
		'privacy' => 'private',
		'title' => $data['title'],
		'overview' => $data['description'],
		'founder' => $this->user_details->id,
		'created' => time() ];
		
		//Set Where
		$course['course_id'] = $this->course->insert($post); 
		$this->output->set_content_type('application/json')->set_output(json_encode($course));
	}

	public function done_outline($val,$id){
		$this->view = false;
		$this->outline->update($id, ['done'=>$val]);
	}

}

/* End of file Finance.php*/
/* Location: ./application/controllers/Finance.php*/
