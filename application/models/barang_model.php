<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Barang_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllBarang(){
			return $this->db->get('barang');
		}
		function getBarangById($id){
			$this->db->from('barang');
			$this->db->join('pelanggan','barang.id_pelanggan=pelanggan.id_pelanggan');
			$this->db->where(['id_barang' => $id]);
			return $this->db->get();
		}
		function getBarangByIdPelanggan($id,$start_date,$end_date){
			$this->db->from('barang');
			$this->db->where(['id_pelanggan' => $id, 'status' => 'booked', 'tgl_booked >' => $start_date, 'tgl_booked <' => $end_date]);
			return $this->db->get();
        }
        function getBarangByStatus($status){
			return $this->db->get_where('barang',['status' => $status]);
		}
		function insertBarang($data){
			$this->db->insert('barang',$data);
		}
		function updateBarang($data,$condition){
			$this->db->where($condition);
			$this->db->update('barang', $data);
		}
		function deleteBarang($condition){
			$this->db->where($condition);
			$this->db->delete('barang');
		}
		function getDetailAllBarangbyStatus($status){
			$this->db->from('barang');
			$this->db->join('pelanggan','barang.id_pelanggan=pelanggan.id_pelanggan');
			$this->db->where(['status' => "'".$status."'"]);
			$this->db->order_by('id_barang','DESC');
			return $this->db->get();
		}
	}
?>