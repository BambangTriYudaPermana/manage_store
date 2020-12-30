<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class upload_flash_data_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllFlashData($id_user){
			return $this->db->get_where('flash_data',['id_user' => $id_user]);
		}
		function getAllFlashDataTarget($id_user){
			return $this->db->get_where('flash_data_target_realisasi',['id_user' => $id_user]);
		}
		function getFlashDataById($id_flash_data){
			return $this->db->get_where('flash_data',['id_flash_data' => $id_flash_data]);	
		}
		function insertFlashData($data){
			$this->db->insert('flash_data',$data);
		}
		function updateflashData($data,$condition){
			$this->db->where($condition);
			$this->db->update('flash_data', $data);
		}
		function deleteFlashDataById($condition){
			$this->db->where($condition);
			$this->db->delete('flash_data');
		}
		function deleteFlashData(){
			$this->db->empty_table('flash_data');
		}

		function insertFlashDataTargetRealisasi($data){
			$this->db->insert('flash_data_target_realisasi',$data);
		}

		function deleteFlashDataTargetRealisasi(){
			$this->db->empty_table('flash_data_target_realisasi');
		}
	}
?>