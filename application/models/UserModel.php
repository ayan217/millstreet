<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'user';
	}

	public function add_user($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function checkUsernameExist($email, $admin_or_not)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('email', $email);
		if ($admin_or_not == 1) {
			$this->db->where('acc_type', 1);
		} else {
			$this->db->where('acc_type != 1');;
		}
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->row();
		}
	}
	public function getadmin($id)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$this->db->where('acc_type', 1);

		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->row();
		}
	}

	public function getuser($id)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$this->db->where('acc_type', 0);

		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->row();
		}
	}

	public function getusers()
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('acc_type', 0);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->result();
		}
	}

	public function update_user($data, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update($this->table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}
}
