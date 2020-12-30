<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'class' => 'form-control',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'autocomplete' => 'off'
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'class' => 'form-control',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'autocomplete' => 'off'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'class' => 'form-control',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'autocomplete' => 'off'
);
?>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" role="form"'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
	  <h6 class="panel-title"><i class="icon-bubble4"></i> Form User</h6>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo form_label('Old Password', $old_password['id']); ?></label>
			<div class="col-sm-10">
				<?php echo form_password($old_password); ?>
				<span style="color: red;"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo form_label('New Password', $new_password['id']); ?></label>
			<div class="col-sm-10">
				<?php echo form_password($new_password); ?>
				<span style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?></label>
			<div class="col-sm-10">
				<?php echo form_password($confirm_new_password); ?>
				<span style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
			</div>
		</div>
		<div class="form-actions text-right">
			<input name="change" type="submit" class="btn btn-primary" value="Change Password" >
		</div>
	</div>
</div>
<?php //echo form_submit('change', 'Change Password'); ?>
<?php echo form_close(); ?>