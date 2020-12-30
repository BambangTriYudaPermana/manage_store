<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class upload_relasi_model extends CI_Model  {
		function __construct() { parent::__construct(); }

		function getAllRealisasi($id_user){
			return $this->db->get_where('realisasi',['id_user' => $id_user]);
		}
		function insertRealisasi($data){
			$this->db->insert('realisasi',$data);
		}
		function getRealisasiById($id_realisasi){
			return $this->db->get_where('realisasi',['id_realisasi' => $id_realisasi]);	
		}
		function updateAlumni($data,$condition){
			$this->db->where($condition);
			$this->db->update('realisasi', $data);
		}
		function deleteRealisasi(){
			$this->db->empty_table('realisasi');
		}
		function deleteRealisasiById($condition){
			$this->db->where($condition);
			$this->db->delete('realisasi');
		}
		
	}
?>