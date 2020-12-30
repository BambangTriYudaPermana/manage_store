<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller {
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
			
			$this->data['link_active']	= 'permission';
					
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('dashboard');
			} 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model("permission_model");
		}
	 }
	 
	public function index(){
		$this->data['listPermission'] = $this->permission_model->getAllPermission();
		$this->data['title'] = "Data Permission";
		
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
        $this->load->view('permission/views',$this->data);
		$this->load->view('shared/footer', $this->data);
	}
	 
	public function add(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('description', 'Permission', 'required|xss_clean');
		$this->form_validation->set_rules('permission', 'Controller', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
		
			$data = array(
				'description'	=> $this->input->post('description'),
				'permission' 		=> $this->input->post('permission')
			);
			
			$this->permission_model->addPermission($data);
			
			redirect('permission');
		} else {
			$this->data['description']	= $this->input->post('description');
			$this->data['permission']  	= $this->input->post('permission');
			
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action']       = site_url('permission/add');
			$this->data['title']        = "Form Tambah";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('permission/form',$this->data);
			$this->load->view('shared/footer');
		}
	}
	
	public function update($id){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('description', 'Permission', 'required|xss_clean');
		$this->form_validation->set_rules('permission', 'Controller', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'description'	=> $this->input->post('description'),
				'permission' 		=> $this->input->post('permission')
			);
			$condition['permission_id'] = $id;
			
			$this->permission_model->updatePermission($data, $condition);
			
			redirect('permission');
			
		} else {
			$this->data['description']	= $this->input->post('description');
			$this->data['permission']  	= $this->input->post('permission');
			
			$permission = $this->permission_model->getPermission($id);
			
			$this->data['description']	= $permission->description;
			$this->data['permission']	= $permission->permission;
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('permission/update/'.$id);
			$this->data['title'] = "Form Edit";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('permission/form',$this->data);
			$this->load->view('shared/footer');
		}
	}
	
	public function delete($id){
		$condition['permission_id'] = $id;
		$this->permission_model->deletePermission($condition);
		redirect('permission');
	}
	
	function role_permission($id) {
		$this->data['link_active']	= 'roles';
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('permission_id', 'Permission', 'xss_clean');
	
		if ($this->input->post()) {
			$condition['role_id'] = $id;
			$this->permission_model->deleteRolePermission($condition);
			$permission_id = $_POST['permission_id'];
			
			for($x = 0; count($_POST['permission_id']) > $x; $x++){
				$data = array(
					'role_id'	=> $id,
					'permission_id'	=> $permission_id[$x]
				);
				
				$this->permission_model->addRolePermission($data);
			}
			
			redirect('roles');
			
		} else {
			$this->data['listPermission'] = $this->permission_model->getAllPermission();
			$this->data['listPermissionByRoles'] = $this->permission_model->getAllPermissionByRoles($id);
		
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('permission/role_permission/'.$id);
			$this->data['title'] = "Update Role Permission";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('permission/form_permission', $this->data);
			$this->load->view('shared/footer', $this->data);		
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */