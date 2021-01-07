<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Print_invoice extends CI_Controller
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
			
			$this->data['link_active']	= 'print_invoice';
					
			// if (!$this->tank_auth->permit($this->data['link_active'])) {
			// 	redirect('dashboard');
			// } 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model(["checkout_barang_model","transaksi_model"]);
		}		
	}

	function index() {
		$hari_ini = date("Y-m-d");
		$start_date = !empty($this->input->post('start_date')) ? $this->input->post('start_date') : date('Y-m-01', strtotime($hari_ini));
		$end_date = !empty($this->input->post('end_date')) ? $this->input->post('end_date') : date('Y-m-t', strtotime($hari_ini));
		

		if ($this->input->post()) {
			$this->data['data'] = $this->checkout_barang_model->getAllBarang($start_date,$end_date,"checkout");
		}else{
			$this->data['data'] = $this->checkout_barang_model->getAllBarang($start_date,$end_date,"checkout");
		}

		if ($start_date > $end_date) {
			$this->data['message'] = true;
		}

		$this->data['start_date'] = $start_date;
		$this->data['end_date'] = $end_date;
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('print_invoice/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function detail($id_catatan){
		$this->data['data_barang'] = $this->transaksi_model->getDetailTransaksi($id_catatan);
		$detail_order = $this->transaksi_model->getTransaksiOne($id_catatan)->row();
		$this->data['nama_pelanggan'] = $detail_order->nama_pelanggan;
		$this->data['ttl_berat'] = $detail_order->ttl_berat;
		$this->data['catatan'] = $detail_order->catatan;
		$this->data['link'] = $detail_order->link;

		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('print_invoice/print_invoice', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function checkout(){
		$id_barang = $this->input->post('id_barang');
		$ttl_berat = $this->input->post('ttl_berat');
		$catatan = $this->input->post('catatan');
		$link = $this->input->post('link');

		$data_catatan = array(
			'ttl_berat' 	=> $ttl_berat,
			'catatan' 		=> $catatan,
			'link' 			=> $link,
			'created_date'	=> date('Y-m-d h:i:s'),
		);

		$this->catatan_model->insertCatatan($data_catatan);

		$get_last_id = $this->catatan_model->getIdLast()->row();
		// die($get_last_id->id_catatan);

		foreach ($id_barang as $key => $value) {
			$data=array(
				'status' => "checkout",
				'updated_date'	=> date('Y-m-d h:i:s')
			);
			$condition['id_barang']=$value;
			$this->barang_model->updateBarang($data,$condition);

			$data_transaksi = array(
				'id_barang'		=> $value,
				'id_catatan'	=> $get_last_id->id_catatan,
				'created_date'	=> date('Y-m-d h:i:s'),
			);

			$this->transaksi_model->insertTransaksi($data_transaksi);

			echo $value."-";
		}
		die();
	}

	

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */