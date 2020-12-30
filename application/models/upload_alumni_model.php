<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class upload_alumni_model extends CI_Model  {
		function __construct() { parent::__construct(); }

		function getAllAlumni($id_user){
			return $this->db->get_where('alumni',['id_user' => $id_user]);
		}
		function insertAlumni($data){
			$this->db->insert('alumni',$data);
		}
		function getAlumniById($id_alumni){
			return $this->db->get_where('alumni',['id_alumni' => $id_alumni]);	
		}
		function updateAlumni($data,$condition){
			$this->db->where($condition);
			$this->db->update('alumni', $data);
		}
		function deleteAlumni(){
			$this->db->empty_table('alumni');
		}
		function deleteAlumniById($condition){
			$this->db->where($condition);
			$this->db->delete('alumni');
		}
	}
?>