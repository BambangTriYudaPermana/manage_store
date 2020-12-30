<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Pelanggan_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllPelanggan(){
			return $this->db->get('pelanggan');
		}
		function getPelangganById($id){
			return $this->db->get_where('pelanggan',['id_pelanggan' => $id]);
        }
        function getPelangganByName($name){
			return $this->db->get_where('pelanggan',['nama_pelanggan' => $name]);
		}
		function insertPelanggan($data){
			$this->db->insert('pelanggan',$data);
		}
		function updatePelanggan($data,$condition){
			$this->db->where($condition);
			$this->db->update('pelanggan', $data);
		}
		function deletePelanggan($condition){
			$this->db->where($condition);
			$this->db->delete('pelanggan');
		}
		function getOneLast(){
			$this->db->select('*');
			$this->db->from('pelanggan');
			$this->db->order_by('id_pelanggan','DESC');
			$this->db->limit(1);
			return $this->db->get();
		}
	}
?>