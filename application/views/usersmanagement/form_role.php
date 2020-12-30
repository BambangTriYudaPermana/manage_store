<?php
	if(!empty($message)){
		?>
			<!-- Callout -->
			<div class="callout callout-danger fade in">
			  <button type="button" class="close" data-dismiss="alert">×</button>
			  <h5>Error Input Data</h5>
			  <p><?=$message?></p>
			</div>
			<!-- /callout -->
		<?php
	}
?>

<form  class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
	<!-- Basic inputs -->
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h6 class="panel-title"><i class="icon-bubble4"></i> Form Jamaah</h6>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Role: </label>
				<div class="col-sm-10">
					<select class="multi-select" name="role_id" tabindex="2">
						<?php
							foreach($listRoles->result() as $role){
								?>
									<option value="<?=$role->role_id?>" <?php if( $role->role_id == $role_id_change  ) {echo 'selected="selected"';}?> ><?=$role->full?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	<!-- /basic inputs -->
</form>