<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Roles_model extends CI_Model  {
		function __construct() { parent::__construct(); }

		function getAllRoles() {
			$this->db->from("roles");
			
			return $this->db->get();
		}
		
		function getRole($id) {
			$this->db->where('role_id', $id);
			$this->db->select("*");
			$this->db->from("roles");
			$query = $this->db->get();
			$res = $query->result();
			return $res[0];
		}
		
		function addRole($data) {
			$this->db->insert('roles', $data);
		}
		
		function updateRole($data, $condition) {
			$this->db->where($condition);
			$this->db->update('roles', $data);
		}
		
		function deleteRole($condition) {
			$this->db->where($condition);
			$this->db->delete('roles');
		}
	}
?>