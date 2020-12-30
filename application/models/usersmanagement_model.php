<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Usersmanagement_model extends CI_Model  {
		function __construct() { parent::__construct(); }

		function getAllUser() {
			$this->db->select("*, users.id as id_user");
			$this->db->from("users");
			$this->db->join('user_profiles', 'users.id = user_profiles.id', 'left');
			
			return $this->db->get();
		}
		
		function cekNip($nip)
		{
			$cek = $this->db->select("*")->from("user_profiles")->where('user_profiles.nip', $nip)->get();
			if ($cek->num_rows() > 0) {
				return true;
			}else{
				return false;
			}
		}

		function getUser($id) {
			$this->db->where('users.id', $id);
			$this->db->select("*");
			$this->db->from("users");
			$this->db->join('user_profiles', 'users.id = user_profiles.id', 'left');
			$query = $this->db->get();
			$res = $query->result();
			return $res[0];
		}
		
		function updateUser($data, $condition) {
			$this->db->where($condition);
			$this->db->update('users', $data);
		}

		function updateUserProfile($data, $condition) {
			$this->db->where($condition);
			$this->db->update('user_profiles', $data);
		}

		function insertTarget($data){
			$this->db->insert('target',$data);
		}
		function insertRealisasi($data){
			$this->db->insert('realisasi',$data);
		}
		function insertAlumni($data){
			$this->db->insert('alumni',$data);
		}
	}
?>