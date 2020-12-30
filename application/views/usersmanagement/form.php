<?php
	if ($use_username) {
		$username = array(
			'name'	=> 'username',
			'id'	=> 'username',
			'class' => 'form-control',
			'value' => set_value('username'),
			'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
			'autocomplete' => 'off'
		);
	}
	$email = array(
		'name'	=> 'email',
		'id'	=> 'email',
		'class' => 'form-control',
		'value'	=> set_value('email'),
		'maxlength'	=> 80,
		'autocomplete' => 'off'
	);
	$foto = array(
		'name'	=> 'foto',
		'id'	=> 'foto',
		'type'	=> 'file',
		'class' => 'form-control',
		'value'	=>  set_value('foto'),
		'maxlength'	=> 80,
		'autocomplete' => 'off'
	);
	$password = array(
		'name'	=> 'password',
		'id'	=> 'password',
		'class' => 'form-control',
		'value' => set_value('password'),
		'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
		'autocomplete' => 'off'
	);
	$confirm_password = array(
		'name'	=> 'confirm_password',
		'id'	=> 'confirm_password',
		'class' => 'form-control',
		'value' => set_value('confirm_password'),
		'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
		'autocomplete' => 'off'
	);
?>

<?php echo form_open($action, 'class="form-horizontal"');?>
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h6 class="panel-title"><i class="icon-bubble4"></i> Form User</h6>
		</div>
		<div class="panel-body">
			<?php if ($use_username) { ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Username: </label>
					<div class="col-sm-10">
						<?php echo form_input($username); ?>
						<span style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
					</div>
				</div>
			<?php } ?>
			<div class="form-group">
				<label class="col-sm-2 control-label">Password: </label>
				<div class="col-sm-10">
					<?php echo form_password($password); ?>
					<span style="color: red;"><?php echo form_error($password['name']); ?></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Repeat Password: </label>
				<div class="col-sm-10">
					<?php echo form_password($confirm_password); ?>
					<span style="color: red;"><?php echo form_error($confirm_password['name']); ?></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Email Address: </label>
				<div class="col-sm-10">
					<?php echo form_input($email); ?>
					<span style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
				</div>
			</div>
			<?php
				if(isset($registration_fields)) {
					foreach($registration_fields as $val) {
						list($name, $label,, $type) = $val;
						$field = array('name'	=> $name, 'id'	=> $name, 'value' => set_value($name), 'class' => 'form-control', 'autocomplete' => 'off');
						if($type == 'text') {
							$attr = isset($val[4]) ? $val[4] : FALSE;
							if($attr){
								foreach($attr as $k=>$v){
									$field[$k] = $v;
								}
							}
							?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $label; ?>: </label>
									<div class="col-sm-10">
										<?php echo form_input($field); ?>
										<span style="color: red;"><?php echo form_error($field['name']); ?><?php echo isset($errors[$field['name']]) ? $errors[$field['name']] : ''; ?></span>
									</div>
								</div>
							<?php
						}
						elseif($type == 'dropdown') {
							?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $label; ?>: </label>
									<div class="col-sm-10">
										<?php if(isset($db_dropdowns) && in_array($name, $db_dropdowns)) : ?>
											<?php echo form_dropdown($name, $dropdown_items[$name], $dropdown_items_default[$name], 'class="select-liquid" tabindex="2" data-placeholder="Choose..."'); ?>
										<?php else : ?>
											<?php echo form_dropdown($name, $dropdown_simple[$name], $dropdown_simple_default[$name], 'class="select-liquid" tabindex="2" data-placeholder="Choose..."'); ?>
										<?php endif; ?>
										<span style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></span>
									</div>
								</div>
							<?php
						}
						elseif($type == 'checkbox') {
							?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $label; ?>: </label>
									<div class="col-sm-10">
										<!--
										<?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($name) ? $name : FALSE)) . ' ' . form_label($val[4], $name); ?>
										-->
										<?php echo form_checkbox(array('name'=>$name, 'id'=>$name), 1, set_checkbox($name, 1, isset($val[5]) ? $val[5] : FALSE)) . ' ' . form_label($val[4], $name); ?>
										<span style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></span>
									</div>
								</div>
							<?php
						}
						elseif($type == 'radio') {
							?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $label; ?>: </label>
									<div class="col-sm-10">
										<?php
											$open_tag = isset($val[5]) ? $val[5] : '<label class="radio-inline radio-info">';
											$close_tag = isset($val[6]) ? $val[6] : '</label>';
											foreach($val[4] as $key=>$radio_label){
												echo $open_tag.form_radio($name, $key, set_radio($name, $key), 'class="styled"').' '.$radio_label.$close_tag;
											}
										?>
										<span style="color: red;"><?php echo form_error($name); ?><?php echo isset($errors[$name]) ? $errors[$name] : ''; ?></span>
									</div>
								</div>
							<?php
						}
					}
				}
			?>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Foto: </label>
				<div class="col-sm-10">
					<?php echo form_input($foto); ?>
					<span style="color: red;"><?php echo form_error($foto['name']); ?><?php echo isset($errors[$foto['name']])?$errors[$foto['name']]:''; ?></span>
				</div>
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>