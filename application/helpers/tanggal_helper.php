<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tgl')) {
	function tanggal($tanggal)
    {
    	$hari = array ( 1 =>    'SEN',
    				'SEL',
    				'RAB',
    				'KAM',
    				'JUM',
    				'SAB',
    				'MIN'
    			);
    			
    	$bulan = array (1 =>   'Januari',
    				'Februari',
    				'Maret',
    				'April',
    				'Mei',
    				'Juni',
    				'Juli',
    				'Agustus',
    				'September',
    				'Oktober',
    				'November',
    				'Desember'
    			);
    	$split 	  = explode('-', $tanggal);
    	
		$num = date('N', strtotime($tanggal));
		$data = [
		    'hari' => $hari[$num],
            'tgl' => $split[2],
            'bulan' => $bulan[(int)$split[1]],
            'thn' => $split[0],
		 ];
		 return $data;
    }
}
