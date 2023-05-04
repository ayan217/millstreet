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
	public function image_upload($height = null, $width = null)
	{
		if (isset($_POST['crop_image'])) {
			$data = $_POST;
			$crop_res = final_crop($data);
			if ($crop_res !== false) {
				$res = [
					'status' => 1,
					'img_name' => $crop_res
				];
			} else {
				$res = [
					'status' => 0
				];
			}
		} else {
			$data = [
				'name' => $_FILES['image']['name'],
				'tmp_name' => $_FILES['image']['tmp_name'],
			];
			$resized_image = image_resize($data, $height, $width);
			if ($resized_image !== false) {
				$res = $resized_image;
			} else {
				$res = [
					'status' => 0
				];
			}
		}
		echo json_encode($res);
	}
}
