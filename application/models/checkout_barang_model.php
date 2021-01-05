<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Checkout_barang_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllBarang($start_date,$end_date){
            return $this->db->query("
                SELECT
                    b.id_pelanggan,
                    b.nama_pelanggan,
                    SUM( qty ) qty,
                    SUM( harga ) total_harga,
                    a.status 
                FROM
                    barang a
                    JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan
                WHERE a.status = 'booked'	AND tgl_booked > '".$start_date."' AND tgl_booked < '".$end_date."'
                GROUP BY
                    a.id_pelanggan
                    ");
		}
	}
?>