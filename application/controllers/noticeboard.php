<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Noticeboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('notice_model', 'notice');
	}

	public function index()
	{
		$all = $this->notice->order_by('created','desc')->get_all();
		$this->data['all'] = $all;
	}

	public function home()
	{
	}
	
	/* Displays all the noticeboard items to be managed */
	public function manage()
	{
		$all = $this->notice->get_all();
		$this->data['all'] = $all;
	}

	/**
	*
	* Create items
	* @param type
	* The type of post(article, image, video, gallery)
	*
	*/
	public function create($type = 'default')
	{
		$this->view = false;
		$this->data['type'] = $type;

		// If Creating an article notice
		if ($type == 'article') {
			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');

			if($this->form_validation->run()){
				$data = $this->input->post();
				$post = ["title"=>$data['title'], "details"=>$data['details'], "type" => $type,
				"created"=>time() ];
				$this->notice->insert($post);
				$this->message->set('success',"Article posted successfully!");
			}else
			{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		// If Creating an Image notice
		}elseif ($type == 'image') {
			$this->form_validation->set_rules('title','Notice title','required');
			if($this->form_validation->run()){
				$data = $this->input->post();
				$config['upload_path'] = './uploads/notices';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '500';
				$config['max_width']  = '2048';
				$config['max_height']  = '1024';
				$config['file_name'] = 'image_'.time().'.jpg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')){
					$img = $this->upload->data();
					$image = json_encode([$img['file_name']]);
					$post = ['title' => $data['title'], 'type' => $type, 'details'=>'image file',
					'info'=>$image,'created' => time()];
					$this->notice->insert($post);
					$this->message->set('success', "Image posted successfully!");
				}else{
					$this->message->set('errors', $this->upload->display_errors());
				}
			}else{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		// If Creating a Video notice
		}elseif ($type == 'video') {
			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');
			if ($this->form_validation->run()) {
				$data = $this->input->post();
				$post = ['title' => $data['title'], 'details' => substr($data['details'], -11), 'type' => $type,
				'created' => time()];
				$this->notice->insert($post);
				$this->message->set('success', "Video link posted successfully!");
			}else{
				$response = ['type'=>'error','content'=>validation_errors()];
			}


		// If Creating a Gallery Notice
		}elseif ($type == 'gallery') {
			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');

			if($this->form_validation->run())
			{
				$data = $this->input->post();

				$config['upload_path'] = './uploads/notices';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '2048';
				$config['max_height']  = '1024';
				$this->load->library('upload',$config);

				$photos = json_encode($_FILES['files']['name']);
				
				$post = [
							"title"=>$data['title'],
							"details"=>$data['details'],
							"info"=>$photos,
							"created"=>time(),
							"type" => $type
						];
		
				if ($this->upload->do_multi_upload('files'))
				{
					
					$this->notice->insert($post);
								
					$this->message->set('success', 'Gallery has been uploaded' );

				}else{
					$this->message->set('error', $this->upload->display_errors());
				}
			}else
			{
				$response = ['type'=>'error','content'=>validation_errors()];
			}
		
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	*	Remove
	*	Removes a notice from the database table
	*	@param id
	*	
	*/
	public function remove($id)
	{
		$this->view = false;
		$this->load->model('notice_model', 'notice');
		$this->notice->delete($id);
		redirect($site_url.'/noticeboard/manage');
	}

	/**
	*	Edit
	*	Updates the noticeboard
	*	@param email
	*	
	*/
	public function edit($type = null, $id = null)
	{
		$this->load->model('notice_model', 'notice');
		$all = $this->notice->get($id);
		$this->data['type'] = $type;
		$this->data['all'] = $all;

		// Edit Articles
		if($type === 'article'){
			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');

			if($this->form_validation->run()){
				$data = $this->input->post();
				$post = ["title"=>$data['title'], "details"=>$data['details'], "created"=>time() ];
				$this->notice->update($id, $post);
				$this->message->set('success',"Article updated successfully!");
			}else
			{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		// Edit Images
		}elseif($type === 'image'){
			$this->form_validation->set_rules('title','Notice title','required');
			if($this->form_validation->run()){
				$data = $this->input->post();

				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '500';
				$config['max_width']  = '2048';
				$config['max_height']  = '1024';
				$config['file_name'] = 'image_'.time().'.jpg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')){
					$img = $this->upload->data();
					$post = ['title' => $data['title'], 'image1' => $img['file_name'], "created"=>time()];
					$this->notice->update($id, $post);
					$this->message->set('success', "Image updated successfully!");
				}else{
					$this->notice->update($id, ['title' => $data['title']]);
					$this->message->set('success', "Image caption updated successfully!");
					$this->message->set('errors', $this->upload->display_errors());
				}

			}else{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		// Edit Video
		}elseif($type === 'video'){
			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');
			if ($this->form_validation->run()) {
				$data = $this->input->post();
				$post = ['title' => $data['title'], 'details' => $data['details'], 'created' => time()];
				$this->notice->update($id, $post);
				$this->message->set('success', "Video updated successfully!");
			}else{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		// Edit Gallery
		}elseif($type === 'gallery'){

			$this->form_validation->set_rules('title','Notice title','required');
			$this->form_validation->set_rules('details','Noticeboard details','required');

			if($this->form_validation->run())
			{
				$data = $this->input->post();

				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '2048';
				$config['max_height']  = '1024';
				$this->load->library('upload',$config);

				$post = ["title"=>$data['title'],"details"=>$data['details'],"created"=>time() ];

				$photos = $_FILES['files'];

				foreach ($photos['name'] as $id => $name){
					if($name !== ""){
						$post['image'.++$id] = $name;	
					}
				}
				if ($this->upload->do_multi_upload('files')){
					$this->notice->update($id, $post);
					$this->message->set('success', 'Gallery has been updated' );

				}else{
					$this->message->set('error', $this->upload->display_errors());
				}
			}else{
				$response = ['type'=>'error','content'=>validation_errors()];
			}

		}else{
			redirect($site_url.'/noticeboard/manage');
		}	
	}

}
/* End of file noticeboard.php*/
/* Location: ./application/controllers/noticeboard.php*/