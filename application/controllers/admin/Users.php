<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'libraries/phpqrcode/qrlib.php');

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
		$data['users'] = $this->UserModel->getusers();
		$this->load->view('layout', $data);
	}
	public function add_user($id = null)
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('photo', 'Photo', 'required');
			$this->form_validation->set_rules('acc_type', 'acc_type', 'required');
			$this->form_validation->set_rules('created_at', 'created_at', 'required');
			if ($this->form_validation->run() == TRUE) {
				$data = $_POST;
				$user_id = $this->UserModel->add_user($data);
				if ($user_id !== false) {
					$file_name1 = $_POST['name'] . '_QRCODE_' . $user_id . '.png';
					$file_path = QR_UPLOAD;

					$text = base_url('user/' . $user_id);
					$folder = $file_path;
					$file_name = $folder . $file_name1;
					QRcode::png($text, $file_name, QR_ECLEVEL_L, 400);
					$qr_data = [
						'qr' => $file_name1
					];
					if ($this->UserModel->update_user($qr_data, $user_id) !== false) {
						$this->session->set_flashdata('log_suc', 'User Added');
						redirect('admin/Users', 'refresh');
					} else {
						$this->session->set_flashdata('log_err', 'QR Failed..!!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}
				} else {
					$this->session->set_flashdata('log_err', 'Database Error..!!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			} else {
				$this->session->set_flashdata('log_err', validation_errors());
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
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
	public function edit_user($id)
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('photo', 'Photo', 'required');
			$this->form_validation->set_rules('acc_type', 'acc_type', 'required');
			$this->form_validation->set_rules('updated_at', 'created_at', 'required');
			if ($this->form_validation->run() == TRUE) {
				$data = $_POST;
				if ($this->UserModel->update_user($data, $id) !== false) {
					$this->session->set_flashdata('log_suc', 'User Updated');
					redirect('admin/Users', 'refresh');
				} else {
					$this->session->set_flashdata('log_err', 'Something Went Wrong..!!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			} else {
				$this->session->set_flashdata('log_err', validation_errors());
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
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
	public function delete_user($id)
	{
		if ($this->UserModel->delete_user($id) == true) {
			$this->session->set_flashdata('log_suc', 'User Deleted');
			redirect('admin/Users', 'refresh');
		} else {
			$this->session->set_flashdata('log_err', 'Something Went Wrong..!!');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}
