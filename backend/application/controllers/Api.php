	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	#[AllowDynamicProperties]
	class Api extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model('ApiModel');
			$this->load->helper('api'); 
	
			
		}

		public function getData()
		{
			$data = ['message' => 'Hello from CodeIgniter'];
			echo json_encode($data);
		}
		public function submit() {
			
			header('Content-Type: application/json');
			$input = get_json_input(); 
		
			$username = $input['username'] ?? null;  
			$contact = $input['contact'] ?? null; 
		
			
			if (!$username) {
				echo json_encode(['status' => 'error', 'message' => 'Username is required']);
				return;
			}
		
			if (!$contact) {
				echo json_encode(['status' => 'error', 'message' => 'Contact number is required']);
				return;
			}
		
			
			$data = [
				'username' => $username,
				'contact' => $contact 
			];
		
			
			if ($this->ApiModel->insert_data($data)) {
				echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Data insertion failed']);
			}
		}

		public function get_users() {
			header('Content-Type: application/json');
			$users = $this->ApiModel->get_all_users(); 

			if ($users) {
				echo json_encode(['status' => 'success', 'data' => $users]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'No users found']);
			}
		}



	}
