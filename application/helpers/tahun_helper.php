<?php

	function Tahun(){
	    $CI = get_instance();
	    $CI->load->model('tahun_model');
	    return $CI->tahun_model->getAllTahun()->result();

	}

	function TahunAktif(){
		$CI = get_instance();
	    $CI->load->model('tahun_model');
	    return $CI->tahun_model->getAllTahunAktif()->result();
	}

	function TahunNonaktif(){
		$CI = get_instance();
	    $CI->load->model('tahun_model');
	    return $CI->tahun_model->getAllTahunNonAktif()->result();
	}
?>