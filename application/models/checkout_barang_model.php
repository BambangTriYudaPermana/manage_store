<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Checkout_barang_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllBarang($start_date,$end_date,$status = ''){
            $status = $status != '' ?  $status : 'booked';
            return $this->db->query("
                SELECT
                    d.created_date tgl_checkout,
                    b.id_pelanggan,
                    b.nama_pelanggan,
                    SUM( qty ) qty,
                    SUM( harga ) total_harga,
                    a.status,
                    d.* 
                FROM
                    barang a
                    LEFT JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan
                    LEFT JOIN transaksi c ON c.id_barang = a.id_barang
	                LEFT JOIN catatan d ON d.id_catatan = c.id_catatan 
                WHERE a.status = '".$status."' AND tgl_booked > '".$start_date."' AND tgl_booked < '".$end_date."'
                GROUP BY
                    a.id_pelanggan,
                    d.id_catatan
                    ");
        }
		function getCheckout($status){
			$this->db->select("pelanggan.*,catatan.* ");
			$this->db->from("barang");
			$this->db->join("pelanggan","pelanggan.id_pelanggan = barang.id_pelanggan","left");
            $this->db->join("transaksi","transaksi.id_barang = barang.id_barang","left");
            $this->db->join("catatan","catatan.id_catatan = transaksi.id_catatan","left");
            $this->db->where(["barang.status" => "'".$status."'"]);
            $this->db->group_by('id_pelanggan');
            return $this->db->get();
		}
	}
?>