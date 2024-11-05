<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

		public function insert_data($data)
{
    $result = $this->db->insert('users', $data);
   
    return $result;
}

	

	public function get_all_users() {
		$query = $this->db->get('users');
		return $query->result_array();
	}

}
