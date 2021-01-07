<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Catatan_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllCatatan(){
			return $this->db->get('catatan');
		}
		function insertCatatan($data){
			$this->db->insert('catatan',$data);
		}
		function updateCatatan($data,$condition){
			$this->db->where($condition);
			$this->db->update('catatan', $data);
		}
		function deleteCatatan($condition){
			$this->db->where($condition);
			$this->db->delete('catatan');
		}
		function getIdLast(){
			$this->db->from('catatan');
			$this->db->order_by('id_catatan','DESC');
			return $this->db->get();
		}
	}
?>