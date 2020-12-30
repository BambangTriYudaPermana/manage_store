<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Checkout_barang_model extends CI_Model  {
		function __construct() { parent::__construct(); }
		
		function getAllBarang(){
            return $this->db->query("
                SELECT
                    b.nama_pelanggan,
                    SUM( qty ) qty,
                    SUM( harga ) total_harga,
                    a.status 
                FROM
                    barang a
                    JOIN pelanggan b ON a.id_pelanggan = b.id_pelanggan
                WHERE a.status = 'booked'	AND tgl_booked > '2020-02-01' AND tgl_booked < '2020-12-01'
                GROUP BY
                    a.id_pelanggan
                    ");
		}
	}
?>