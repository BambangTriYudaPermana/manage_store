<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_barang extends CI_Controller
{
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} 
		else{
			$this->data['user_id']	= $this->tank_auth->get_user_id();
			$this->data['username']	= $this->tank_auth->get_username();
			$profile	= $this->tank_auth->get_user_profile($this->data['user_id']);
			$this->data['profile_name']	= $profile['name'];
			$this->data['profile_foto']	= $profile['foto'];
			foreach($this->tank_auth->get_roles($this->data['user_id']) as $val){
				$this->data['role_id'] = $val['role_id'];
				$this->data['role'] = $val['role'];
				$this->data['full_name_role'] = $val['full'];
			}
			
			$this->data['link_active']	= 'checkout_barang';
					
			// if (!$this->tank_auth->permit($this->data['link_active'])) {
			// 	redirect('dashboard');
			// } 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model(["checkout_barang_model"]);
		}		
	}

	function index() {
		$this->data['data'] = $this->checkout_barang_model->getAllBarang();
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('checkout_barang/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}



	

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */