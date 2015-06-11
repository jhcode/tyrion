<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Books extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function home()
	{
		
	}
	/*
	*
	* Adding a new book
	*
	*/
	public function add(){
		$this->form_validation->set_rules('book_name','Book name');
		$this->form_validation->set_rules('book_desc','Book Description');
		if ($this->form_validation->run()) {
			// Collecting GET data into $data array
			$data = $this->input->post();

			if(!empty($_FILE['userfile'])){
				$config['upload_path'] = './uploads/books';
				$config['allowed_types'] = 'doc|docx|pdf|odf|ps|rtf';
				$config['file_name'] = str_replace(' ', '_', $data['book_name']).'.pdf';

				$this->load->library('upload', $config);
				var_dump($config); die();
				if ($this->upload->do_upload('userfile')) {
					$book = $this->upload->data();
					var_dump($book); die();
					$this->load->model('book_model', 'book');
					$this->book->insert([
						'name' => $data['book_name'],
						'description' => $data['book_desc'],
						'book_url' => 'stuff',
						'added' => time()
						]);
				}
			$this->message->set('success', 'Book have been uploaded' );
			}else{
				var_dump($this->upload->display_errors());
			}
			
		}else{
			$response = ['type'=>'error','content'=>validation_errors()];
		}
	}
}