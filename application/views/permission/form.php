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
		  <h6 class="panel-title"><i class="icon-bubble4"></i> Form Menu</h6>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Permission: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="description" placeholder="Permission" autocomplete="off" value="<?php if( isset($description)  ) {echo $description;}?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Controller: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="permission" placeholder="Controller" autocomplete="off" value="<?php if( isset($permission)  ) {echo $permission;}?>">
				</div>
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	<!-- /basic inputs -->
</form>