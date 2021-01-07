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
		function getDetailTransaksi($id_catatan){
			$this->db->select("
				barang.created_date tgl_booked,
				tgl_checkout,
				transaksi.*, 
				pelanggan.*, 
				barang.*
			");
			$this->db->from("transaksi");
			$this->db->join("barang","barang.id_barang = transaksi.id_barang");
			$this->db->join("pelanggan","pelanggan.id_pelanggan = barang.id_pelanggan");
			$this->db->where("transaksi.id_catatan",$id_catatan);
			return $this->db->get();
		}
		function getTransaksiOne($id_catatan){
			$this->db->from('transaksi');
			$this->db->join("catatan","catatan.id_catatan = transaksi.id_catatan");
			$this->db->join("barang","barang.id_barang = transaksi.id_barang");
			$this->db->join("pelanggan","pelanggan.id_pelanggan = barang.id_pelanggan");
			$this->db->where("transaksi.id_catatan",$id_catatan);
			$this->db->group_by('pelanggan.id_pelanggan');
			return $this->db->get();
		}
	}
?>