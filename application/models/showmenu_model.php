<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Showmenu_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			
		}
		
		public function getShowMenu($id_menu_parent = ''){
			$this->db->where('id_menu_parent', $id_menu_parent);
			$this->db->from("menu");
			$this->db->order_by("sort", "asc");
			$query = $this->db->get();
			$res = $query->result();
			$data = Array();
			foreach($res as $menu){
				if($this->checkChild($menu->id_menu)){
					if($menu->kategori == "Link"){
						$menu->child = false;
						$data[] = $menu;
					}
					else{
						if ($this->tank_auth->permit($menu->href)) {
							$menu->child = false;
							$data[] = $menu;
						}
					}
				}
				else{
					$menu->child = true;
					$menu->content_child = $this->getShowMenu($menu->id_menu);
					if(!empty($menu->content_child)){
						$data[] = $menu;
					}
				}
			}
			return $data;
		}
		
		public function checkChild($id) {
			$this->db->where('id_menu_parent', $id);
			$this->db->select("id_menu");
			$this->db->from("menu");
			$query = $this->db->get();
			$res = $query->result();
			
			if(empty($res[0]->id_menu)){
				return true;
			}
			else {
				return false;
			}
		}
		
		public function getAllMenuwithjoin(){
			$this->db->select("menu_utama.*,sub_menu.nama_menu as nama_menu_parent");
			$this->db->from("menu as menu_utama");
			$this->db->join("menu as sub_menu", 'menu_utama.id_menu_parent = sub_menu.id_menu', 'left');
			return $this->db->get();
		}
		
		public function getMenu($id){
			$this->db->where('id_menu', $id);
			$this->db->select("*");
			$this->db->from("menu");
			$query = $this->db->get();
			$res = $query->result();
			return $res[0];
		}
		
		public function addMenu($data){
			$this->db->insert('menu', $data);
		}
		
		public function updateMenu($data, $condition){
			$this->db->where($condition);
			$this->db->update('menu', $data);
		}
		
		public function deleteMenu($condition){
			$this->db->where($condition);
			$this->db->delete('menu');
		}
	}
	
?>