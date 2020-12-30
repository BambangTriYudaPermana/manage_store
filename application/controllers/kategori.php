<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller
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
			
			$this->data['link_active']	= 'kategori';
					
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('dashboard');
			} 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model(["usersmanagement_model","upload_target_model","upload_relasi_model","upload_alumni_model","upload_flash_data_model","data_dokumen_model","kategori_model"]);
		}		
	}

	function index() {
		$this->data['title'] = "List Data Dokumen";
			
		$this->data['data_kategori'] = $this->kategori_model->getAllKategori();
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
		$this->load->view('kategori/view', $this->data);
		$this->load->view('shared/footer', $this->data);
	}

	function add() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|xss_clean');
		
		if ($this->form_validation->run() == TRUE) {
				$data=array(
					'nama_kategori' => $this->input->post('nama_kategori')
				);

				$this->kategori_model->insertKategori($data);
			
			redirect('kategori');
		} else {
			$this->data['nama_kategori'] = $this->input->post('nama_kategori');
			
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action']       = site_url('kategori/add');
			$this->data['title']        = "Form Tambah";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('kategori/form',$this->data);
			$this->load->view('shared/footer');
		}
	}

	function update($id_kategori) {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|xss_clean');
		
		$data=$this->kategori_model->getKategoriById($id_kategori)->row();

		if ($this->form_validation->run() == TRUE) {
			$data=array(
					'nama_kategori' => $this->input->post('nama_kategori')
				);
			$condition['id_kategori']=$id_kategori;
			
			$this->kategori_model->updateKategori($data,$condition);
			
			redirect('kategori');
		} else {
			$this->data['nama_kategori']	= $data->nama_kategori;
			
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action']       = site_url('kategori/update/'.$id_kategori);
			$this->data['title']        = "Form update";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('kategori/form',$this->data);
			$this->load->view('shared/footer');
		}
	}
	public function delete($id){
		$condition['id_kategori']	= $id;
		
		$this->kategori_model->deleteKategori($condition);
		redirect('kategori');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */