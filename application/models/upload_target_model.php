<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class upload_target_model extends CI_Model  {
		function __construct() { parent::__construct(); }

		function getAllTarget($id_user){
			return $this->db->get_where('target',['id_user' => $id_user]);
		}
		function insertTarget($data){
			$this->db->insert('target',$data);
		}
		function deleteTarget(){
			$this->db->empty_table('target');
		}
	}
?>