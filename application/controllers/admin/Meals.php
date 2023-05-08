<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meals extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		admin_login_check();
		$this->load->model('MealsModel');
	}
	public function index()
	{
		$data['folder'] = 'admin';
		$data['template'] = 'meals';
		$data['title'] = 'Manage Meals';
		$data['admin_data'] = logged_in_admin_row();
		$data['meals'] = $this->MealsModel->getmeals();
		$this->load->view('layout', $data);
	}
	public function add_meal($id = null)
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules(
				'price',
				'Price',
				'required|regex_match[/^\d+(\.\d{1,2})?$/]',
				array(
					'required' => 'The %s field is required.',
					'regex_match' => 'The %s field must contain a valid price.'
				)
			);
			$this->form_validation->set_rules('from_time', 'From', 'required');
			$this->form_validation->set_rules('to_time', 'To', 'required');
			if ($this->form_validation->run() == TRUE) {
				$data = $_POST;
				if ($this->MealsModel->add_meal($data) !== false) {
					$this->session->set_flashdata('log_suc', 'User Added');
					redirect('admin/Users', 'refresh');
				} else {
					$this->session->set_flashdata('log_err', 'Something Went Wrong..!!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			} else {
				$this->session->set_flashdata('log_err', validation_errors());
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		} else {
			if ($id == null) {
				$data['title'] = 'Add Meal';
			} else {
				$data['title'] = 'Edit Meal';
				$data['meal_data'] = $this->MealsModel->getuser($id);
			}
			$data['folder'] = 'admin';
			$data['admin_data'] = logged_in_admin_row();
			$data['template'] = 'add_meal';
			$this->load->view('layout', $data);
		}
	}
}
