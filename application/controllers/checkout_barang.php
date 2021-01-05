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
			
			$this->load->model(["checkout_barang_model","barang_model","pelanggan_model"]);
		}		
	}

	function index() {
		$hari_ini = date("Y-m-d");
		$start_date = !empty($this->input->post('start_date')) ? $this->input->post('start_date') : date('Y-m-01', strtotime($hari_ini));
		$end_date = !empty($this->input->post('end_date')) ? $this->input->post('end_date') : date('Y-m-t', strtotime($hari_ini));
		

		if ($this->input->post()) {
			$this->data['data'] = $this->checkout_barang_model->getAllBarang($start_date,$end_date);
		}else{
			$this->data['data'] = $this->checkout_barang_model->getAllBarang($start_date,$end_date);
		}

		if ($start_date > $end_date) {
			$this->data['message'] = true;
		}

		$this->data['start_date'] = $start_date;
		$this->data['end_date'] = $end_date;
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('checkout_barang/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function detail($id_pelanggan,$start_date,$end_date){

		$this->data['data_barang'] = $this->barang_model->getBarangByIdPelanggan($id_pelanggan,$start_date,$end_date);
		$pelanggan = $this->pelanggan_model->getPelangganById($id_pelanggan)->row();
		$this->data['nama_pelanggan'] = $pelanggan->nama_pelanggan;

		$this->data['start_date'] = $start_date;
		$this->data['end_date'] = $end_date;

		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('checkout_barang/checkout', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function checkout(){
		$id_barang = $this->input->post('id_barang');
		foreach ($id_barang as $key => $value) {
			$data=array(
				'status' => "checkout",
				'updated_date'	=> date('Y-m-d h:i:s')
			);
			$condition['id_barang']=$value;
			$this->barang_model->updateBarang($data,$condition);

			echo $value."-";
		}
		die();
	}

	

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */