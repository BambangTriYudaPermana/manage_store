<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library(array('session', 'tank_auth'));
		$this->load->helper('url');
	}

	function index()
	{
		$this->load->view('home');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */