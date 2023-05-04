<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		admin_login_check();
	}
	public function index()
	{
		$data['folder'] = 'admin';
		$data['template'] = 'users';
		$data['title'] = 'Manage Users';
		$data['admin_data'] = logged_in_admin_row();
		$this->load->view('layout', $data);
	}
	public function add_user($id = null)
	{
		if ($this->input->post()) {
		} else {
			if ($id == null) {
				$data['title'] = 'Add User';
			} else {
				$data['title'] = 'Edit User';
				$data['user_data'] = $this->UserModel->getuser($id);
			}
			$data['folder'] = 'admin';
			$data['admin_data'] = logged_in_admin_row();
			$data['template'] = 'add_user';
			$this->load->view('layout', $data);
		}
	}
}
