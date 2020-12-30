<?php
	if ($use_username) {
		$username = array(
			'name'	=> 'username',
			'id'	=> 'username',
			'class' => 'input',
			'value' => set_value('username'),
			'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
			'size'	=> 30,
			'autocomplete' => 'off'
		);
	}
	$email = array(
		'name'	=> 'email',
		'id'	=> 'email',
		'class' => 'input',
		'value'	=> set_value('email'),
		'maxlength'	=> 80,
		'size'	=> 30,
		'autocomplete' => 'off'
	);
	$password = array(
		'name'	=> 'password',
		'id'	=> 'password',
		'class' => 'input',
		'value' => set_value('password'),
		'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
		'size'	=> 30,
		'autocomplete' => 'off'
	);
	$confirm_password = array(
		'name'	=> 'confirm_password',
		'id'	=> 'confirm_password',
		'class' => 'input',
		'value' => set_value('confirm_password'),
		'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
		'size'	=> 30,
		'autocomplete' => 'off'
	);
	$captcha = array(
		'name'	=> 'captcha',
		'id'	=> 'captcha',
		'class' => 'input',
		'maxlength'	=> 8,
		'autocomplete' => 'off'
	);
	$label_captcha = "Confirmation Code";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- Apple iOS and Android stuff (do not remove) -->
		<meta name="apple-mobile-web-app-capable" content="no" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />

		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />
		
		<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/ico">

		<!-- Required Stylesheets -->
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/login.css" media="screen" >
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/demo-login.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/style4.css" />
        
        
		<script src="<?php echo base_url();?>asset/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/modernizr.custom.86080.js"></script>

		<title>Login Q-Invite</title>

	</head>

	<body>
	    <div id="page">
			<ul class="cb-slideshow">
				<li><span>Image 01</span><div></div></li>
				<li><span>Image 02</span><div></div></li>
				<li><span>Image 03</span><div></div></li>
				<li><span>Image 04</span><div></div></li>
				<li><span>Image 05</span><div></div></li>
				<li><span>Image 06</span><div></div></li>
			</ul>
		</div>
	    <div class="login-wrap"></div>
		<div class="login-html">
			<img src="<?php echo base_url();?>asset/images/qi-logo-white.png" alt="" style="height:100px; display:block; margin:auto; margin-bottom: 5px;" />
			<h3 style="margin-bottom: 10px; color: #FFF;">Manage Your Guest Properly</h3>
			<hr style="margin-bottom:15px; width:60%;">
			<label class="tab">Sign Up</label>
			<div class="login-form">
				<?php echo form_open('auth/register');?>
					<?php if ($use_username) { ?>
						<div class="group">
							<label for="user" class="label">Username</label>
							<?php echo form_input($username); ?>
							<span style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
						</div>
					<?php } ?>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<?php echo form_password($password); ?>
						<span style="color: red;"><?php echo form_error($password['name']); ?></span>
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<?php echo form_password($confirm_password); ?>
						<span style="color: red;"><?php echo form_error($confirm_password['name']); ?></span>
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<?php echo form_input($email); ?>
						<span style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
					</div>
					<?php
						if(isset($registration_fields)) {
							foreach($registration_fields as $val) {
								list($name, $label,, $type) = $val;
								$field = array('name'	=> $name, 'id'	=> $name, 'value' => set_value($name));
								if($type == 'text') {
									$field += array('size'=>30);
									$attr = isset($val[4]) ? $val[4] : FALSE;
									if($attr){
										foreach($attr as $k=>$v){
											$field[$k] = $v;
										}
									}
									?>
										<div class="group">
											<label class="label"><?php echo form_label($label, $field['name']); ?></label>
											<?php echo form_input($field); ?>
											<span style="color: red;"><?php echo form_error($field['name']); ?><?php echo isset($errors[$field['name']]) ? $errors[$field['name']] : ''; ?></span>
										</div>
									<?php
								}
								elseif($type == 'dropdown') {
									?>
										<tr>
											<td><?php echo form_label($label, $name); ?></td>
													<?php if(isset($db_dropdowns) && in_array($name, $db_dropdowns)) : ?>
														<td><?php echo form_dropdown($name, $dropdown_items[$name], $dropdown_items_default[$name]); ?></td>
													<?php else : ?>
														<td><?php echo form_dropdown($name, $dropdown_simple[$name], $dropdown_simple_default[$name]); ?></td>
													<?php endif; ?>
											<td style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></td>
										</tr>
									<?php
								}
								elseif($type == 'checkbox') {
									?>
										<tr valign="top">
											<td><?php echo $label; ?></td>
													<!--
											<td><?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($name) ? $name : FALSE)) . ' ' . form_label($val[4], $name); ?></td>
													-->
													<td><?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($val[5]) ? $val[5] : FALSE)) . ' ' . form_label($val[4], $name); ?></td>
											<td style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></td>
										</tr>
									<?php
								}
								elseif($type == 'radio') {
									?>
										<div class="group">
											<label class="label"><?php echo form_label($label); ?></label>
											<?php
												$open_tag = isset($val[5]) ? $val[5] : '<span>';
												$close_tag = isset($val[6]) ? $val[6] : '</span>';
												foreach($val[4] as $key=>$radio_label){
													echo $open_tag.'<label>'.form_radio($name, $key, set_radio($name, $key)).' '.$radio_label.'</label>'.$close_tag;
												}
											?>
											<span style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></span>
										</div>
									<?php
								}
							}
						}
						if ($captcha_registration) {
							if ($use_recaptcha) {
								?>
									<script src='https://www.google.com/recaptcha/api.js'></script>
									<center>
										<div class="captcha_wrapper" style="display: inline-block; margin-bottom: 15px;">
											<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_html; ?>"></div>
											<span style="color:red;"><?php echo form_error('g-recaptcha-response'); ?><?php echo isset($errors['g-recaptcha-response'])?$errors['g-recaptcha-response']:''; ?></span>
										</div>
									</center>
								<?php
							}
							else {
								?>
									<div class="group">
										<center>
											<img src="<?php echo $captcha_html; ?>" id="captcha" />
										</center>
										<label for="captcha" class="label"><?=$label_captcha?></label>
										<div class="mws-form-item large">
											<?php echo form_input($captcha); ?>
										</div>
										<span style="color:red;"><?php echo form_error($captcha['name']); ?></span>
									</div>
								<?php
							}
						}
					?>
					<div class="group">
						<input type="submit" class="button" style="cursor:pointer;" value="Sign Up">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1"><?php echo anchor('/auth/login/', 'Already Member?'); ?></label>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		
	    <div class="container">
			<!-- Codrops top bar -->
			<div class="codrops-top">
				<a href="">
					<strong>Q-Invite</strong> Manage Your Guest Properly
				</a>
				<span class="right">
					<a href="">OSA</a>
					<a href="">Website By</a>
					<a href="">
						<strong>Tintapuccino</strong>
					</a>
				</span>
				<div class="clr"></div>
			</div><!--/ Codrops top bar -->
		</div>

	</body>
</html>