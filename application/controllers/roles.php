<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller
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
			
			$this->data['link_active']	= 'roles';
					
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('dashboard');
			} 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model("roles_model");
		}		
	}

	function index() {
		$this->data['title'] = "List Roles";
			
		$this->data['listRoles'] = $this->roles_model->getAllRoles();
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
		$this->load->view('roles/view', $this->data);
		$this->load->view('shared/footer', $this->data);
	}

	function add() {	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('role', 'Role', 'required|xss_clean');
		$this->form_validation->set_rules('full', 'Full Name Role', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
		    $data = array(
				'role' => $this->input->post('role'),
				'full' => $this->input->post('full')
			);
			
			$this->roles_model->addRole($data);
			redirect('roles');
			
		} else {
			$this->data['role']= $this->input->post('role');
			$this->data['full']= $this->input->post('full');
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('roles/add');
			$this->data['title'] = "Add Role";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('roles/form', $this->data);
			$this->load->view('shared/footer', $this->data);
		
		}
	}
	
	function update($id) {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('role', 'Role', 'required|xss_clean');
		$this->form_validation->set_rules('full', 'Full Name Role', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
			
			$data = array(
				'role' => $this->input->post('role'),
				'full' => $this->input->post('full')
			);
			$condition['role_id'] = $id;
			$this->roles_model->updateRole($data, $condition);
			redirect('roles');
			
		} else {			
			$roles = $this->roles_model->getRole($id);
			
			$this->data['role']= $roles->role;
			$this->data['full']= $roles->full;
			
			if($this->input->post()) {
				$this->data['role']= $this->input->post('role');
				$this->data['full']= $this->input->post('full');
			}
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('roles/update/'.$id);
			$this->data['title'] = "Update Role";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('roles/form', $this->data);
			$this->load->view('shared/footer', $this->data);		
		}
	}
	
	function delete($id) {	
		$condition['role_id'] = $id;
		$this->roles_model->deleteRole($condition);
		redirect('roles');
	}
	
	function change_default($id) {
		$condition['default'] = '1';
		$data = array(
			'default' => '0'
		);		
		$this->roles_model->updateRole($data, $condition);
		
		$condition2['role_id'] = $id;
		$data = array(
			'default' => '1'
		);	
		$this->roles_model->updateRole($data, $condition2);
		redirect('roles');
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */