<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usersmanagement extends CI_Controller
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
			
			$this->data['link_active']	= 'usersmanagement';
					
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('dashboard');
			} 
			
			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();
			
			$this->load->model("usersmanagement_model");
		}		
	}

	function index() {
		$this->data['title'] = "List User";
			
		$this->data['listuser'] = $this->usersmanagement_model->getAllUser();
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
		$this->load->view('usersmanagement/view', $this->data);
		$this->load->view('shared/footer', $this->data);
	}

	function add() {
		$this->load->library('form_validation');
		$use_username = $this->config->item('use_username', 'tank_auth');
		if ($use_username) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|callback__check_username_blacklist|callback__check_username_exists');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
		
		// Check for additional fields
		$registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
		if($registration_fields){
			foreach($registration_fields as $val){
				$this->data['registration_fields'][] = $val;
				list($name, $label, $rules, $type) = $val;
				$this->form_validation->set_rules($name, $label, $rules);
				
				// Check if you need to query a db
				if($type == 'dropdown'){
					$selection = $val[4];
					
					if(is_string($val[4])){
						$default = isset($val[5]) ? $val[5] : NULL;
						preg_match('/\w+(?=\.)/', $selection, $dbname);
						preg_match_all('/(?<=\.)\w+/', $selection, $fields);
						$fields = $fields[0];
						
						// Create the dropdown field
						//$this->data['dropdown_name'] = $name;
						$this->data['dropdown_items'][$name] = $this->tank_auth->create_regdb_dropdown($dbname, $fields);
						$this->data['dropdown_items_default'][$name] = $default;
						$this->data['db_dropdowns'][] = $name;
					}
					else {
						$default = isset($val[5]) ? $val[5] : NULL;
						$this->data['dropdown_simple'][$name] = $selection;
						$this->data['dropdown_simple_default'][$name] = $default;
					}
				}
			}
		}
		$this->data['errors'] = array();

		//$email_activation = $this->config->item('email_activation', 'tank_auth');
		$email_activation = FALSE;
		
		$config['upload_path']          = './asset/images/foto/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['file_name']           = uniqid();
 
		$this->load->library('upload', $config);

		if ($this->form_validation->run() && $this->upload->do_upload('foto')) {							// validation ok
			$foto=$this->upload->data();
			$custom['foto']=$foto["file_name"];
			
			// Custom registration fields
			$registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
			if($registration_fields){
				//$datatypes = $this->tank_auth->get_profile_datatypes();
				foreach($this->config->item('registration_fields', 'tank_auth') as $val){
					$name = $val[0];
					$value = $this->form_validation->set_value($name);
					$custom[$name] = $value;
				}
				
				//Remove all NULL values so MySQL will use the default value
				foreach($custom as $key=>$val){
					if(is_null($val)) unset($custom[$key]);
				}
				
				$custom = serialize($custom);
			}
			else {
				$custom = '';
			}
		
			// Create the user here
			if (!is_null($data = $this->tank_auth->create_user(
					$use_username ? $this->form_validation->set_value('username') : '',
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('password'),
					$email_activation,
					$custom))) {									// success

				$this->data['site_name'] = $this->config->item('website_name', 'tank_auth');

				if ($email_activation) {									// send "activate" email
					$this->data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $this->data['email'], $data);

					unset($this->data['password']); // Clear password (just for any case)

				} else {
					if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email
						$this->_send_email('welcome', $this->data['email'], $data);
					}
					unset($this->data['password']); // Clear password (just for any case)
				}
				
				redirect('usersmanagement');
				
			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$this->data['errors'][$k] = $this->lang->line($v);
			}
		}
		
		//$this->data['debug'] = $this->tank_auth->debug('14');
		$this->data['use_username'] = $use_username;
		
		$this->data['action'] = site_url('usersmanagement/add');
		$this->data['title'] = "Add User";
		
		$this->load->view('shared/header', $this->data);
		$this->load->view('shared/nav', $this->data);
		$this->load->view('shared/nav_left', $this->data);
		$this->load->view('usersmanagement/form', $this->data);
		$this->load->view('shared/footer', $this->data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		
		$config['upload_path']          = './asset/images/foto/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['file_name']           = uniqid();
 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto')) {
			if ($user->foto != "no_image.jpg") {
				if (file_exists('./asset/images/foto/'.$user->foto)) {
					unlink('./asset/images/foto/'.$user->foto);
				}
			}
			$foto=$this->upload->data();
			$custom['foto']=$foto["file_name"];
		}

		if ($this->form_validation->run() == TRUE) {
			// Custom registration fields
			$registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
			if($registration_fields){
				//$datatypes = $this->tank_auth->get_profile_datatypes();
				foreach($this->config->item('registration_fields', 'tank_auth') as $val){
					$name = $val[0];
					$value = $this->input->post($name);
					$custom[$name] = $value;
				}
				
				//Remove all NULL values so MySQL will use the default value
				foreach($custom as $key=>$val){
					if(is_null($val)) unset($custom[$key]);
				}
			}
			else {
				$custom = '';
			}

			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');
	 
			$user= $this->usersmanagement_model->getUser($id);

			if ($user->foto != "no_image.jpg") {
				if (file_exists('./asset/images/foto/'.$user->foto)) {
					unlink('./asset/images/foto/'.$user->foto);
				}
			}
			
			$condition['id'] = $id;
			$this->usersmanagement_model->updateUser($data, $condition);
			$this->usersmanagement_model->updateUserProfile($custom, $condition);
			redirect('usersmanagement');
			
		} else {	
			$this->data['message'] = $this->upload->display_errors();
			$user= $this->usersmanagement_model->getUser($id);
			$this->data['username']= $user->username;
			$this->data['email']= $user->email;
			$this->data['name']= $user->name;
			// Check for additional fields
			$registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
			if($registration_fields){
				foreach($registration_fields as $val){
					$this->data['registration_fields'][] = $val;
					list($name, $label, $rules, $type) = $val;
					$this->form_validation->set_rules($name, $label, $rules);
					
					// Check if you need to query a db
					if($type == 'dropdown'){
						$selection = $val[4];
						
						if(is_string($val[4])){
							$default = isset($val[5]) ? $val[5] : NULL;
							preg_match('/\w+(?=\.)/', $selection, $dbname);
							preg_match_all('/(?<=\.)\w+/', $selection, $fields);
							$fields = $fields[0];
							
							// Create the dropdown field
							//$this->data['dropdown_name'] = $name;
							$this->data['dropdown_items'][$name] = $this->tank_auth->create_regdb_dropdown($dbname, $fields);
							$this->data['dropdown_items_default'][$name] = $default;
							$this->data['db_dropdowns'][] = $name;
						}
						else {
							$default = isset($val[5]) ? $val[5] : NULL;
							$this->data['dropdown_simple'][$name] = $selection;
							$this->data['dropdown_simple_default'][$name] = $default;
						}
					}
				}
			}
			
			if($this->input->post()) {
			}
			
			$use_username = $this->config->item('use_username', 'tank_auth');
			$this->data['use_username'] = $use_username;
			$this->data['action'] = site_url('usersmanagement/update/'.$id);

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['title'] = "Update Users";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form', $this->data);
			$this->load->view('shared/footer', $this->data);
		}
	}
	
	function banned($id) {
		$condition['id'] = $id;
		$data = array(
			'banned' => '1'
		);
		$this->usersmanagement_model->updateUser($data, $condition);
		redirect('usersmanagement');
	}
	
	function unbanned($id) {
		$condition['id'] = $id;
		$data = array(
			'banned' => '0'
		);
		$this->usersmanagement_model->updateUser($data, $condition);
		redirect('usersmanagement');
	}
	
	function activate($user_id)
	{
		//$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user_manual($user_id)) {		// success
			redirect('usersmanagement');

		} else {																// fail
			redirect('usersmanagement');
		}
	}
	
	function change_role($id)	{
		$this->load->library('form_validation');
		
		foreach($this->tank_auth->get_roles($id) as $val){
			$this->data['role_id_change'] = $val['role_id'];
		}
		
		$this->form_validation->set_rules('role_id', 'Role', 'required|xss_clean');
	
		if ($this->form_validation->run() == TRUE) {
			$this->tank_auth->change_role(intval($id), intval($this->data['role_id_change']), intval($this->input->post('role_id')));
			
			redirect('usersmanagement');
			
		} else {
			
			if($this->input->post()) {
				$this->data['role_id_change']= $this->input->post('role_id');
			}
			
			$this->data['listRoles'] = $this->tank_auth->get_list_role();
			
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('usersmanagement/change_role/'.$id);
			$this->data['title'] = "Change Role";
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form_role', $this->data);
			$this->load->view('shared/footer', $this->data);		
		}
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	function import_user() {
		$this->data['title'] = 'Import Data User';
		$this->load->library('excel/PHPExcel');
		$this->load->library('form_validation');
		if (!empty($_FILES['file_excel']['name'])) {
		    require(APPPATH.'libraries/import_excel/excel_reader.php');
		    
		    $target = basename($_FILES['file_excel']['name']) ;
        	move_uploaded_file($_FILES['file_excel']['tmp_name'], $target); 
        	
        	$data_excel = new Spreadsheet_Excel_Reader($_FILES['file_excel']['name'],false); 
        	$baris = $data_excel->rowcount($sheet_index=0); 
			for ($i=7; $i<=$baris; $i++){
				$nip = $data_excel->val($i, 2);
				$email = $nip.'@gmail.com';
				if(!empty($nip)){				
					$data = array(
						'nip' => $nip,
						'name' => $data_excel->val($i, 3),
						'tempat_lahir' => $data_excel->val($i, 4),
						'alamat' => $data_excel->val($i, 5),
						'tanggal_lahir' => date('Y-m-d', strtotime($data_excel->val($i, 6))),
						'gender' => $data_excel->val($i, 7),
						'gol' => $data_excel->val($i, 8),
						'eselon' => $data_excel->val($i, 9),
						'tmt_eselon' => date('Y-m-d', strtotime($data_excel->val($i, 10))),
						'jabatan' => $data_excel->val($i, 11),
						'grade' => $data_excel->val($i, 12),
						'tempat_tugas' => $data_excel->val($i, 13),
						'agama' => $data_excel->val($i, 14),
						'telepon' => $data_excel->val($i, 15),
						'unit_kerja' => $data_excel->val($i, 16),
						'no_hp' => $data_excel->val($i, 17),
						'npwp' => $data_excel->val($i, 18),
						'tmt_gol' => date('Y-m-d', strtotime($data_excel->val($i, 19))),
						'pd_jenjang' => $data_excel->val($i, 20),
						'pd_jurusan' => $data_excel->val($i, 21),
						'pd_sekolah' => $data_excel->val($i, 22),
						'jenis_jabatan' => $data_excel->val($i, 23),
						'tmt_cpns' => date('Y-m-d', strtotime($data_excel->val($i, 24))),
						'tmt_pns' => date('Y-m-d', strtotime($data_excel->val($i, 25))),
						'tmt_jabatan' => date('Y-m-d', strtotime($data_excel->val($i, 26))),
						'masa_kerja_keseluruhan' => $data_excel->val($i, 27),
						'masa_kerja_jabatan' => $data_excel->val($i, 28),
						'masa_kerja_eselon' => $data_excel->val($i, 29),
						'modified' => date('Y-m-d H:i:s')
					);
					if($this->usersmanagement_model->cekNip($nip)){
						$condition['nip'] = $nip;
						$this->usersmanagement_model->updateUserProfile($data, $condition);
					}else{
						$email_activation=False;
						// Create the user here
						if (!is_null($data = $this->tank_auth->create_user(
							$data['nip'],
							$email,
							$data['nip'],
							$email_activation,
							serialize($data)))
							){
							$this->data['site_name'] = $this->config->item('website_name', 'tank_auth');

							if ($email_activation) {// send "activate" email
								$this->data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

								$this->_send_email('activate', $this->data['email'], $data);

								unset($this->data['password']); // Clear password (just for any case)

							} else {
								if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

									$this->_send_email('welcome', $this->data['email'], $data);
								}
								unset($this->data['password']); // Clear password (just for any case)
							}
						}
					}
				}
        	}
			redirect('usersmanagement');
		} else {
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('usersmanagement/import_user');
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form_import', $this->data);
			$this->load->view('shared/footer', $this->data);
		}
	}

	function import_target() {
		$this->data['title'] = 'Import Data Taget';
		$this->load->library('excel/PHPExcel');
		$this->load->library('form_validation');
		if (!empty($_FILES['file_excel']['name'])) {
		    require(APPPATH.'libraries/import_excel/excel_reader.php');
		    
		    $target = basename($_FILES['file_excel']['name']) ;
        	move_uploaded_file($_FILES['file_excel']['tmp_name'], $target); 
        	
        	$data_excel = new Spreadsheet_Excel_Reader($_FILES['file_excel']['name'],false); 
        	$baris = $data_excel->rowcount(0); 
			for ($i=6; $i<=$baris; $i++){
				$data = array(
						'klasifikasi_satuan_kerja' => $data_excel->val($i, 2, 0),
						'provinsi' => $data_excel->val($i, 3, 0),
						'satuan_kerja_lembaga' => $data_excel->val($i, 4, 0),
						'tipe_pelatihan' => $data_excel->val($i, 5, 0),
						'klasifikasi_pelatihan' => $data_excel->val($i, 6, 0),
						'kejuruan' => $data_excel->val($i, 7, 0),
						'program_pelatihan' => $data_excel->val($i, 8, 0),
						'target_peserta_pelatihan' => $data_excel->val($i, 9, 0),
						'target_sertifikasi' => $data_excel->val($i, 10, 0),
						'instruktur_pns' => $data_excel->val($i, 11, 0),
						'instruktur_swasta' => $data_excel->val($i, 12, 0),
						'total_workshop' => $data_excel->val($i, 13, 0),
						'jumlah_asesor' => $data_excel->val($i, 14, 0),
						'jumlah_tuk' => $data_excel->val($i, 15, 0),
						'jumlah_lsp' => $data_excel->val($i, 16, 0),
						'sumber_dana' => $data_excel->val($i, 17, 0),
						'fungsi_anggaran' => $data_excel->val($i, 18, 0),
						'tahun_anggaran' => $data_excel->val($i, 19, 0),
						'k_l_perusahaan' => $data_excel->val($i, 20, 0),
						'detail' => $data_excel->val($i, 21, 0),
						'tematik' => $data_excel->val($i, 22, 0)
					);
				$this->usersmanagement_model->insertTarget($data);
        	}
			redirect('usersmanagement');
		} else {
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('usersmanagement/import_target');
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form_import', $this->data);
			$this->load->view('shared/footer', $this->data);
		}
	}

	function import_realisasi() {
		$this->data['title'] = 'Import Data Realisasi';
		$this->load->library('excel/PHPExcel');
		$this->load->library('form_validation');
		if (!empty($_FILES['file_excel']['name'])) {
		    require(APPPATH.'libraries/import_excel/excel_reader.php');
		    
		    $target = basename($_FILES['file_excel']['name']) ;
        	move_uploaded_file($_FILES['file_excel']['tmp_name'], $target); 
        	
        	$data_excel = new Spreadsheet_Excel_Reader($_FILES['file_excel']['name'],false); 
        	$baris = $data_excel->rowcount(1); 
			for ($i=6; $i<=$baris; $i++){
				$data = array(
						'kode_paket_pelatihan' => $data_excel->val($i, 2, 1),
						'klasifikasi_satuan_kerja' => $data_excel->val($i, 3, 1),
						'provinsi' => $data_excel->val($i, 4, 1),
						'satuan_kerja_lembaga' => $data_excel->val($i, 5, 1),
						'tipe_pelatihan' => $data_excel->val($i, 6, 1),
						'klasifikasi_pelatihan' => $data_excel->val($i, 7, 1),
						'kejuruan' => $data_excel->val($i, 8, 1),
						'program_pelatihan' => $data_excel->val($i, 9, 1),
						'tgl_pelaksanaan_awal' => $data_excel->val($i, 10, 1),
						'tgl_pelaksanaan_akhir' => $data_excel->val($i, 11, 1),
						'jumlah_peserta_pelatihan' => $data_excel->val($i, 12, 1),
						'hasil_pelatihan_lulus' => $data_excel->val($i, 13, 1),
						'hasil_pelatihan_tidak_lulus' => $data_excel->val($i, 14, 1),
						'uji_sertifikasi_kompeten' => $data_excel->val($i, 15, 1),
						'uji_sertifikasi_tidak_kompeten' => $data_excel->val($i, 16, 1),
						'uji_sertifikasi_total' => $data_excel->val($i, 17, 1),
						'latar_belakang_pendidikan_sd' => $data_excel->val($i, 18, 1),
						'latar_belakang_pendidikan_smp' => $data_excel->val($i, 19, 1),
						'latar_belakang_pendidikan_sma' => $data_excel->val($i, 20, 1),
						'latar_belakang_pendidikan_smk' => $data_excel->val($i, 21, 1),
						'latar_belakang_pendidikan_diploma' => $data_excel->val($i, 22, 1),
						'latar_belakang_pendidikan_pt' => $data_excel->val($i, 23, 1),
						'latar_belakang_pendidikan_total' => $data_excel->val($i, 24, 1),
						'jk_l' => $data_excel->val($i, 25, 1),
						'jk_p' => $data_excel->val($i, 26, 1),
						'jk_total' => $data_excel->val($i, 27, 1),
						'jumlah_perta_difabel' => $data_excel->val($i, 28, 1),
						'penyerapan_alumni_mandiri' => $data_excel->val($i, 29, 1),
						'penyerapan_alumni_industri' => $data_excel->val($i, 30, 1),
						'penyerapan_alumni_total' => $data_excel->val($i, 31, 1),
						'sumber_dana' => $data_excel->val($i, 32, 1),
						'fungsi_anggaran' => $data_excel->val($i, 33, 1),
						'tahun_anggaran' => $data_excel->val($i, 34, 1),
						'k_l_perusahaan' => $data_excel->val($i, 35, 1),
						'detail' => $data_excel->val($i, 36, 1),
						'tematik' => $data_excel->val($i, 37, 1),
					);
				$this->usersmanagement_model->insertRealisasi($data);
        	}
        	
			redirect('usersmanagement');
		} else {
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('usersmanagement/import_realisasi');
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form_import', $this->data);
			$this->load->view('shared/footer', $this->data);
		}
	}

	function import_alumni() {
		$this->data['title'] = 'Import Data Alumni';
		$this->load->library('excel/PHPExcel');
		$this->load->library('form_validation');
		if (!empty($_FILES['file_excel']['name'])) {
		    require(APPPATH.'libraries/import_excel/excel_reader.php');
		    
		    $target = basename($_FILES['file_excel']['name']) ;
        	move_uploaded_file($_FILES['file_excel']['tmp_name'], $target); 
        	
        	$data_excel = new Spreadsheet_Excel_Reader($_FILES['file_excel']['name'],false); 
        	$baris = $data_excel->rowcount(2); 
			for ($i=15; $i<=$baris; $i++){
				$data = array(
						'kode_pelatihan' => $data_excel->val($i, 1, 2),
						'fungsi_anggaran' => $data_excel->val($i, 2, 2),
						'klasifikasi_satker' => $data_excel->val($i, 3, 2),
						'provinsi' => $data_excel->val($i, 4, 2),
						'satker_lembaga' => $data_excel->val($i, 5, 2),
						'klasifikasi_pelatihan' => $data_excel->val($i, 6, 2),
						'kejuruan' => $data_excel->val($i, 7, 2),
						'program_pelatihan' => $data_excel->val($i, 8, 2),
						'tgl_pelaksanaan_awal' => $data_excel->val($i, 9, 2),
						'tgl_pelaksanaan_akhir' => $data_excel->val($i, 10, 2),
						'nik_ktp' => $data_excel->val($i, 11, 2),
						'nama_peserta' => $data_excel->val($i, 12, 2),
						'jk' => $data_excel->val($i, 13, 2),
						'difabel' => $data_excel->val($i, 14, 2),
						'pendidikan_terakhir' => $data_excel->val($i, 15, 2),
						'konversi_pendidikan_terakhir' => $data_excel->val($i, 16, 2),
						'tempat_tgl_lahir' => $data_excel->val($i, 17, 2),
						'alamat' => $data_excel->val($i, 18, 2),
						'no_telp' => $data_excel->val($i, 19, 2),
						'penyerapan_lulusan_mandiri' => $data_excel->val($i, 20, 2),
						'penyerapan_lulusan_industri' => $data_excel->val($i, 21, 2),
						'kompeten' => $data_excel->val($i, 22, 2),
						'belum_kompeten' => $data_excel->val($i, 23, 2),
						'ojt' => $data_excel->val($i, 24, 2),
						'tahun_anggaran' => $data_excel->val($i, 25, 2),
						'sumber_dana' => $data_excel->val($i, 26, 2),
						'kerja_sama' => $data_excel->val($i, 27, 2),
						'tematik' => $data_excel->val($i, 28, 2)
					);
				$this->usersmanagement_model->insertAlumni($data);
        	}
			redirect('usersmanagement');
		} else {
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('usersmanagement/import_alumni');
			
			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('usersmanagement/form_import', $this->data);
			$this->load->view('shared/footer', $this->data);
		}
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */