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

<form  class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
	<!-- Basic inputs -->
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h6 class="panel-title"><i class="icon-bubble4"></i> Form Import</h6>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">File Import: </label>
				<div class="col-sm-10">
					<input type="file" name="file_excel" />
				</div>
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	<!-- /basic inputs -->
</form>