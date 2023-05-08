<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MealsModel extends CI_Model
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'meals';
	}

	public function add_meal($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function getmeal($id)
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->row();
		}
	}

	public function getmeals()
	{
		$this->db->select();
		$this->db->from($this->table_name);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return $query->result();
		}
	}

	public function update_meal($data, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update($this->table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_meal($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete($this->table_name)) {
			return true;
		} else {
			return false;
		}
	}
}
