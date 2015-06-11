<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Upload extends CI_Controller
{
	var $model,$type;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('youtube');

		//load model based on the upload type of upload(Course post, Notice board post etc)
		$types = ['notice'=>'notice','course'=>'resource'];

		//get upload type
		$this->type = $this->uri->segment(3);
		$this->load->model($types[$this->type]."_model",$this->type);
		var_export($this->input->post()); die();
	}

	/**
	*Get Youtube access token for upload video
	*@param title(string),description(string)
	*@return $youtube response object
	*
	*/
	public function upload_video()
	{		
		$this->view = false;
		$current_model = $this->type;

		// Simulation to be removed
		/*$_POST['details'] = 'http://youtube.com/watch?v=abcdefghijk';
		$_POST['title'] = 'My First Video';
		$_POST['upload_option'] = 'upload';
		$_POST['type'] = 'video';
		$_POST['course_id'] = 4;*/


		// Validating URL
		$this->form_validation->set_rules('info', 'Post Content', 'callback_is_youtube_link');
		if($this->form_validation->run()){
			$data = $this->input->post();
			$title = $data['title'];

			if($data['upload_option'] === 'link'){
				$description = $data['info'];
				$post = ["title"=>$title,'type'=>$data['type'],'details'=>$description,'created'=>time()];
				if($current_model === 'course'){
					$post['course_id'] = $data['course_id'];
					$post['modified'] = time();
				}
				$this->$current_model->insert($post);
				redirect($_SERVER['HTTP_REFERER']);
			}elseif($data['upload_option'] === 'upload'){
				$description = $data['details'];
				// $file_path = $_FILES['file']['tmp_name'];
				// $file_path = '/home/bl4ckdu5t/Videos/Sagging Lords.mp4';

				//call the youtube get token resource here
				$response = $this->youtube->get_token($title, $description);

				$data_insert = ["title"=>$title,'type'=>$data['type'],'details'=>$description,'created'=>time()];

				if($current_model === 'course'){
					$data_insert['course_id'] = $data['course_id'];
					$data_insert['modified'] = time();
				}

				//insert into db
				$video_id = $this->$current_model->insert($data_insert);

				//pass type and the inserted video id to get_video Id for further processing...
				$nexturl = site_url('/upload/get_video_id/'.$this->type.'/'.$video_id);

				$url = $response->url.'?nexturl='.urlencode($nexturl);

				//call the actual upload video function
				$this->do_youtube_upload($url,$file_path,$response->token);	
			}
		}else{
			var_dump($this->input->post()['details'].'[error]:'.validation_errors()); die();
		}
	}

	/**
	*Upload Youtube video
	*@param token(string)
	*@return $video url(string)
	*
	*/
	public function do_youtube_upload($url, $file_path,$token)
	{
		$postdata = ['file'=>'@'.$file_path,'token'=>$token];
		$curl = curl_init($url);

	    curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);		

		$response     = curl_exec($curl);
		$info         = curl_getinfo($curl);

		curl_close($curl);   
		redirect($_SERVER['HTTP_REFERER']);   	    

		//we can send an confirmation output response here
	    //var_dump($response);var_dump($info['url']);  
	}

	/**
	*Update the post in database with its corresponding youtube link
	*@param type(string)
	*@param insert_id(int)
	*/
	public function get_video_id($type, $id)
	{	
		$youtube_url_id = "https://www.youtube.com/watch?v=".$_GET['id'];
		$this->$type->update($id,['details'=>$youtube_url_id]);		
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

}
