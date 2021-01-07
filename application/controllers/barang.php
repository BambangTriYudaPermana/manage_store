<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller
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
			
			$this->data['link_active']	= 'insert_barang';
					
			// if (!$this->tank_auth->permit($this->data['link_active'])) {
			// 	redirect('dashboard');
			// } 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model(["barang_model"]);
		}		
	}

	function index() {
        $this->data['data'] = $this->barang_model->getDetailAllBarangbyStatus('booked');
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('barang/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function add(){
		$this->data['aksi'] = "add";

		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('barang/form', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function save_add(){
		// cek pelanggan
		$this->load->model("pelanggan_model");
		$nama_pelanggan		= $this->input->post('nama_pelanggan');

		$cek_pelanggan = $this->pelanggan_model->getPelangganByName($nama_pelanggan)->row();
		if (empty($cek_pelanggan)) {
			$data_pelanggan = array(
				'nama_pelanggan' 	=> $nama_pelanggan,
				'created_date'		=> date('Y-m-d h:i:s'),
			);

			$this->pelanggan_model->insertPelanggan($data_pelanggan);

			$get_id_pelanggan = $this->pelanggan_model->getOneLast()->row();

			$id_pelanggan = $get_id_pelanggan->id_pelanggan;
		}else{
			$id_pelanggan = $cek_pelanggan->id_pelanggan;
		}

		$harga 				= str_replace(",","",$this->input->post('harga'));

		$data_barang = array(
			'nama_barang' 	=> $this->input->post('nama_barang'),
			'qty'			=> $this->input->post('qty'),
			'harga'			=> $harga,
			'tgl_booked'	=> $this->input->post('tgl_booked'),
			'status'		=> $this->input->post('status'),
			'id_pelanggan'	=> $id_pelanggan,
			'created_date'	=> date('Y-m-d h:i:s')
		);

		$insert_barang = $this->barang_model->insertBarang($data_barang);

		

		$status_result = [
			'title'	=> 'Berhasil!!!',
			'text'	=> 'Data berhasil Diinputkan..',
			'status'=> 'success'
		];

		$res = json_encode($status_result);
		echo $res;
		// return $res;
	}

	function update($id) {
		$data = $this->barang_model->getBarangById($id)->row();
		$this->data['nama_pelanggan'] 	= $data->nama_pelanggan;
		$this->data['nama_barang'] 		= $data->nama_barang;
		$this->data['qty'] 				= $data->qty;
		$this->data['harga'] 			= $data->harga;
		$this->data['tgl_booked'] 		= $data->tgl_booked;
		$this->data['status'] 			= $data->status;

		$this->data['id_barang'] 		= $id;

		$this->data['aksi'] = "update";

		$this->load->view('layout/header', $this->data);
		$this->load->view('layout/nav_left', $this->data);
		$this->load->view('barang/form', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	function save_update($id_barang){
		// cek pelanggan
		$this->load->model("pelanggan_model");
		$nama_pelanggan		= $this->input->post('nama_pelanggan');

		$cek_pelanggan = $this->pelanggan_model->getPelangganByName($nama_pelanggan)->row();
		if (empty($cek_pelanggan)) {
			$data_pelanggan = array(
				'nama_pelanggan' 	=> $nama_pelanggan,
				'created_date'		=> date('Y-m-d h:i:s'),
			);

			$this->pelanggan_model->insertPelanggan($data_pelanggan);

			$get_id_pelanggan = $this->pelanggan_model->getOneLast()->row();

			$id_pelanggan = $get_id_pelanggan->id_pelanggan;
		}else{
			$id_pelanggan = $cek_pelanggan->id_pelanggan;
		}

		$harga 				= str_replace(",","",$this->input->post('harga'));

		$data_barang = array(
			'nama_barang' 	=> $this->input->post('nama_barang'),
			'qty'			=> $this->input->post('qty'),
			'harga'			=> $harga,
			'tgl_booked'	=> $this->input->post('tgl_booked'),
			'status'		=> $this->input->post('status'),
			'id_pelanggan'	=> $id_pelanggan,
			'updated_date'	=> date('Y-m-d h:i:s')
		);

		$condition['id_barang']		=	$id_barang;
		$insert_barang 				= 	$this->barang_model->updateBarang($data_barang,$condition);


		$status_result = [
			'title'	=> 'Berhasil!!!',
			'text'	=> 'Data berhasil Diubah..',
			'status'=> 'success'
		];

		$res = json_encode($status_result);
		echo $res;
		// return $res;
	}

	public function delete($id_barang){
		$condition['id_barang']	= $id_barang;
		
		$this->barang_model->deleteBarang($condition);
		// redirect('kategori');
	}


	

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */