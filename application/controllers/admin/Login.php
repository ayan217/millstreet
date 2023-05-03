<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->session->sess_destroy();
		$data['folder'] = 'admin';
		$data['template'] = 'login';
		$data['title'] = 'Admin Login';
		$this->load->view('layout', $data);
	}
	public function verify_login()
	{
		$email     = $this->input->post('email');
		$password = $this->input->post('password');
		//0 means non admin 1 means admin
		if ($nameExist = $this->UserModel->checkUsernameExist($email, 1)) {
			if (password_verify($password, $nameExist->password)) {
				$sess_array = array(
					'user_log_id'  => $nameExist->id,
					'user_display' => $nameExist->name
				);
				$this->session->set_userdata('admin_log_data', $sess_array);
				redirect(ADMIN_URL . 'dashboard', 'refresh');
			} else {
				$this->session->set_flashdata('log_err', 'Invalid Password !!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->session->set_flashdata('log_err', 'Invalid Username !!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(ADMIN_URL, 'refresh');
	}
}
