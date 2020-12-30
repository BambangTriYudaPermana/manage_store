<?php
	class LanguageLoader {
		function initialize() {
			$ci =& get_instance();
			$ci->load->helper('language');
			$siteLang = $ci->session->userdata('site_lang');
			if ($siteLang) {
				$ci->lang->load('header',$siteLang);
				$ci->session->set_userdata('site_lang', $siteLang);
			} else {
				$ci->lang->load('header','english');
				$ci->session->set_userdata('site_lang', 'english');
			}
			$ci->data['text_title'] = $ci->lang->line('text_title');
			
			$ci->data['text_menu_home'] = $ci->lang->line('text_menu_home');
			$ci->data['text_menu_about'] = $ci->lang->line('text_menu_about');
			$ci->data['text_menu_services'] = $ci->lang->line('text_menu_services');
			$ci->data['text_menu_project'] = $ci->lang->line('text_menu_project');
			$ci->data['text_menu_career'] = $ci->lang->line('text_menu_career');
			$ci->data['text_menu_contact'] = $ci->lang->line('text_menu_contact');
			
			//About Sub Menu
			$ci->data['text_submenu_company_overview'] = $ci->lang->line('text_submenu_company_overview');
				$ci->data['text_submenu_supra_history'] = $ci->lang->line('text_submenu_supra_history');
				
			$ci->data['text_submenu_value_vision_mission'] = $ci->lang->line('text_submenu_value_vision_mission');
				$ci->data['text_submenu_strategy'] = $ci->lang->line('text_submenu_strategy');
				$ci->data['text_submenu_good_corporate_governance'] = $ci->lang->line('text_submenu_good_corporate_governance');
				
			$ci->data['text_submenu_safety'] = $ci->lang->line('text_submenu_safety');
				$ci->data['text_submenu_safe_operation'] = $ci->lang->line('text_submenu_safe_operation');
				$ci->data['text_submenu_safety_health'] = $ci->lang->line('text_submenu_safety_health');
			
			$ci->data['text_submenu_people'] = $ci->lang->line('text_submenu_people');
				$ci->data['text_submenu_board_of_director'] = $ci->lang->line('text_submenu_board_of_director');
				$ci->data['text_submenu_professional_management'] = $ci->lang->line('text_submenu_professional_management');
				$ci->data['text_submenu_field_personel'] = $ci->lang->line('text_submenu_field_personel');
				
			$ci->data['text_submenu_partner_affiliation'] = $ci->lang->line('text_submenu_partner_affiliation');
				$ci->data['text_submenu_partner'] = $ci->lang->line('text_submenu_partner');
				$ci->data['text_submenu_affiliation'] = $ci->lang->line('text_submenu_affiliation');
				$ci->data['text_submenu_association'] = $ci->lang->line('text_submenu_association');
				
			$ci->data['text_submenu_social_sustainability'] = $ci->lang->line('text_submenu_social_sustainability');
				$ci->data['text_submenu_social'] = $ci->lang->line('text_submenu_social');
				$ci->data['text_submenu_environment'] = $ci->lang->line('text_submenu_environment');
				
			//Services Sub Menu
			$ci->data['text_submenu_services_overview'] = $ci->lang->line('text_submenu_services_overview');
			
			$ci->data['text_submenu_drilling'] = $ci->lang->line('text_submenu_drilling');
				$ci->data['text_submenu_ground_water'] = $ci->lang->line('text_submenu_ground_water');
				$ci->data['text_submenu_environmental'] = $ci->lang->line('text_submenu_environmental');
				$ci->data['text_submenu_geotechnical_soil_investigation'] = $ci->lang->line('text_submenu_geotechnical_soil_investigation');
				$ci->data['text_submenu_exploration'] = $ci->lang->line('text_submenu_exploration');
				
			$ci->data['text_submenu_survey'] = $ci->lang->line('text_submenu_survey');
				$ci->data['text_submenu_hydrogeological_survey'] = $ci->lang->line('text_submenu_hydrogeological_survey');
				$ci->data['text_submenu_geological_survey'] = $ci->lang->line('text_submenu_geological_survey');
				$ci->data['text_submenu_topographic_survey'] = $ci->lang->line('text_submenu_topographic_survey');
				
			$ci->data['text_submenu_consultancy'] = $ci->lang->line('text_submenu_consultancy');
				$ci->data['text_submenu_hydrogeological_study'] = $ci->lang->line('text_submenu_hydrogeological_study');
				$ci->data['text_submenu_geological_study'] = $ci->lang->line('text_submenu_geological_study');
				$ci->data['text_submenu_research_development'] = $ci->lang->line('text_submenu_research_development');
				$ci->data['text_submenu_training_courses'] = $ci->lang->line('text_submenu_training_courses');
				
			$ci->data['text_submenu_integrated_water_supply_system'] = $ci->lang->line('text_submenu_integrated_water_supply_system');
			
			$ci->data['text_submenu_distributor'] = $ci->lang->line('text_submenu_distributor');
				$ci->data['text_submenu_drilling_bit'] = $ci->lang->line('text_submenu_drilling_bit');
				$ci->data['text_submenu_bentonite'] = $ci->lang->line('text_submenu_bentonite');
				$ci->data['text_submenu_drilling_fluid_polymers'] = $ci->lang->line('text_submenu_drilling_fluid_polymers');
				$ci->data['text_submenu_water_well_screens'] = $ci->lang->line('text_submenu_water_well_screens');
				$ci->data['text_submenu_submersible_pumps'] = $ci->lang->line('text_submenu_submersible_pumps');
				$ci->data['text_submenu_solar_panel_submersible_pumps'] = $ci->lang->line('text_submenu_solar_panel_submersible_pumps');
				$ci->data['text_submenu_drilling_equipment'] = $ci->lang->line('text_submenu_drilling_equipment');
				$ci->data['text_submenu_tools'] = $ci->lang->line('text_submenu_tools');
				$ci->data['text_submenu_automatic_water_level_recording'] = $ci->lang->line('text_submenu_automatic_water_level_recording');
				$ci->data['text_submenu_other'] = $ci->lang->line('text_submenu_other');
				
			//Project Sub Menu
			$ci->data['text_submenu_latest_project'] = $ci->lang->line('text_submenu_latest_project');
			
			$ci->data['text_submenu_previous_project'] = $ci->lang->line('text_submenu_previous_project');
			
			$ci->data['text_submenu_gallery'] = $ci->lang->line('text_submenu_gallery');
			
			//Career Sub Menu
			$ci->data['text_submenu_working_at_supra'] = $ci->lang->line('text_submenu_working_at_supra');
				$ci->data['text_submenu_career_overview'] = $ci->lang->line('text_submenu_career_overview');
			
			$ci->data['text_submenu_career_pools'] = $ci->lang->line('text_submenu_career_pools');
				$ci->data['text_submenu_drop_your_cv'] = $ci->lang->line('text_submenu_drop_your_cv');
				
			$ci->data['text_submenu_vacancy_opportunities'] = $ci->lang->line('text_submenu_vacancy_opportunities');
				$ci->data['text_submenu_intern_fresh_graduate'] = $ci->lang->line('text_submenu_intern_fresh_graduate');
				$ci->data['text_submenu_professional'] = $ci->lang->line('text_submenu_professional');
				
			//Contact Sub Menu
			$ci->data['text_submenu_request_for_quotation'] = $ci->lang->line('text_submenu_request_for_quotation');
			
			$ci->data['text_submenu_general_inquiry'] = $ci->lang->line('text_submenu_general_inquiry');
			
			$ci->data['text_submenu_maps'] = $ci->lang->line('text_submenu_maps');
			
			$ci->data['text_submenu_social_media'] = $ci->lang->line('text_submenu_social_media');
		}
	}
?>