<?php
	
	class Panel extends Controller
	{
	
		function Panel()
		{
			parent::Controller();
			
			//$this->load->scaffolding('entries');
			$this->load->model('entries');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('date');
			
		}
		
		function index($success = 0)
		{
			// bussines logic
			$view_data['model'] = $this->entries->getList();
			$view_data['validation'] = true;
			
			$view_data['success'] = $success;

			// load view
			$this->load->view('panel/index', $view_data);
		}
		
		function create() {
			// bussines logic
			$view_data['model'] = $this->entries->getList();
			
			// validation rules
			$this->form_validation->set_rules('Title', 'Title', 'required');
			$this->form_validation->set_rules('Body', 'Body', 'required');
			$validation = $this->form_validation->run();
			
			$view_data['validation'] = $validation;
			
			// if data valid save
			if ($validation)
			{
				
				if ($this->entries->saveEntry()) {
					// redirect to index and send success param (1)
					redirect('//panel/index/1', 'refresh');
				}
				else {
					$view_data["success"] = 0;
					$this->load->view('panel/index', $view_data);
				}
				
			}
			else
			{
				$view_data["success"] = 0; 
				$this->load->view('panel/index', $view_data);
			}			
		}
	
	}
	
?>