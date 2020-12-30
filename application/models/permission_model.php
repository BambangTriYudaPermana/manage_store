<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Permission_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			
		}
		
		public function getAllPermission(){
			$this->db->from("permissions");
			return $this->db->get();
		}
		
		public function getPermission($id){
			$this->db->where('permission_id', $id);
			$this->db->select("*");
			$this->db->from("permissions");
			$query = $this->db->get();
			$res = $query->result();
			return $res[0];
		}
		
		public function addPermission($data){
			$this->db->insert('permissions', $data);
		}
		
		public function updatePermission($data, $condition){
			$this->db->where($condition);
			$this->db->update('permissions', $data);
		}
		
		public function deletePermission($condition){
			$this->db->where($condition);
			$this->db->delete('permissions');
		}
		
		public function getAllPermissionByRoles($id){
			$this->db->where('role_id', $id);
			$this->db->select("permission_id");
			$this->db->from("role_permissions");
			$query = $this->db->get();
			$id_permission = array();
			foreach ($query->result() AS $data){
				$id_permission[]=$data->permission_id;
			}
			return $id_permission;
		}
		
		public function addRolePermission($data){
			$this->db->insert('role_permissions', $data);
		}
		
		public function deleteRolePermission($condition){
			$this->db->where($condition);
			$this->db->delete('role_permissions');
		}
	}
	
?>