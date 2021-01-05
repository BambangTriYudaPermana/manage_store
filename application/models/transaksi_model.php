<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Transaksi_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllTransaksi(){
			return $this->db->get('transaksi');
		}
		function insertTransaksi($data){
			$this->db->insert('transaksi',$data);
		}
		function updateTransaksi($data,$condition){
			$this->db->where($condition);
			$this->db->update('transaksi', $data);
		}
		function deleteTransaksi($condition){
			$this->db->where($condition);
			$this->db->delete('transaksi');
		}
	}
?>