<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
	 public function __construct(){
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
			
			$this->data['link_active']	= 'menu';
			
			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('dashboard');
			} 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			//sampai sini
			
			$this->load->model("menu_model");
		}
	 }
	 
	public function index(){
		$this->data['listMenu'] = $this->menu_model->getAllMenuwithjoin();
		$this->data['title'] = "Data Menu";
		
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
        $this->load->view('menu/views',$this->data);
		$this->load->view('shared/footer', $this->data);
	}
	 
	public function add(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|xss_clean');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
		
			$data = array(
				'id_menu_parent'	=> $this->input->post('id_menu_parent'),
				'nama_menu' 		=> $this->input->post('nama_menu'),
				'icon' 				=> $this->input->post('icon'),
				'kategori' 			=> $this->input->post('kategori'),
				'href'				=> $this->input->post('href'),
				'status'			=> $this->input->post('status'),
				'sort'				=> $this->input->post('sort')
			);
			
			$this->menu_model->addMenu($data);
			
			redirect('menu');
		} else {
			$this->data['id_menu_parent']	= $this->input->post('id_menu_parent');
			$this->data['nama_menu']      	= $this->input->post('nama_menu');
			$this->data['icon']      		= $this->input->post('icon');
			$this->data['kategori']  		= $this->input->post('kategori');
			$this->data['href']        		= $this->input->post('href');
			$this->data['status']       	= $this->input->post('status');
			$this->data['sort']     	  	= $this->input->post('sort');
			
			$this->data['listMenu'] = $this->menu_model->getAllMenu();
			
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action']       = site_url('menu/add');
			$this->data['title']        = "Form Tambah";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('menu/form',$this->data);
			$this->load->view('shared/footer');
		}
	}
	
	public function update($id){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|xss_clean');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'required|xss_clean');
		
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'id_menu_parent'	=> $this->input->post('id_menu_parent'),
				'nama_menu' 		=> $this->input->post('nama_menu'),
				'icon' 				=> $this->input->post('icon'),
				'kategori' 			=> $this->input->post('kategori'),
				'href'				=> $this->input->post('href'),
				'status'			=> $this->input->post('status'),
				'sort'				=> $this->input->post('sort')
			);
			$condition['id_menu'] = $id;
			
			$this->menu_model->updateMenu($data, $condition);
			
			redirect('menu');
			
		} else {
			$this->data['id_menu_parent']	= $this->input->post('id_menu_parent');
			$this->data['nama_menu']      	= $this->input->post('nama_menu');
			$this->data['icon']      		= $this->input->post('icon');
			$this->data['kategori']  		= $this->input->post('kategori');
			$this->data['href']        		= $this->input->post('href');
			$this->data['status']       	= $this->input->post('status');
			$this->data['sort']     	  	= $this->input->post('sort');
			
			$this->data['listMenu'] = $this->menu_model->getAllMenu();
			
			$menu = $this->menu_model->getMenu($id);
			
			$this->data['id_menu_parent']	= $menu->id_menu_parent;
			$this->data['nama_menu']      	= $menu->nama_menu;
			$this->data['icon']      		= $menu->icon;
			$this->data['kategori']  		= $menu->kategori;
			$this->data['href']        		= $menu->href;
			$this->data['status']       	= $menu->status;
			$this->data['sort']     	  	= $menu->sort;
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('menu/update/'.$id);
			$this->data['title'] = "Form Edit";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('menu/form',$this->data);
			$this->load->view('shared/footer');
		}
	}
	
	public function delete($id){
		$condition['id_menu'] = $id;
		$this->menu_model->deleteMenu($condition);
		redirect('menu');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */