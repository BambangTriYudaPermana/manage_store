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

<script type="text/javascript">
	function selectAll() {
		for (var i = 0; i < document.getElementById("box2View").options.length; i++) {
			document.getElementById("box2View").options[i].selected = true;
		}
		return true;
	}
</script>

<form  class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST" onsubmit="return selectAll()">
	<!-- Basic inputs -->
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h6 class="panel-title"><i class="icon-bubble4"></i> Form Role</h6>
		</div>
		<div class="panel-body">
			<input type="hidden" class="form-control" name="flag" placeholder="Permission" autocomplete="off" value="1">
			<div class="form-group">
				<!-- Left box -->
				<div class="left-box">
					<input type="text" id="box1Filter" class="form-control" placeholder="Filter entries...">
					<button type="button" id="box1Clear" class="filter">x</button>
					<select id="box1View" multiple="multiple" class="form-control">
						<?php
							foreach ($listPermission->result() as $permission){
								if (!in_array($permission->permission_id, $listPermissionByRoles)) {
									?>
										<option value="<?=$permission->permission_id?>"><?=$permission->description?></option>
									<?php
								}
							}
						?>
					</select>
					<span id="box1Counter" class="count-label"></span>
					<select id="box1Storage"></select>
				</div>
				<!-- /left-box -->
				
				<!-- Control buttons -->
				<div class="dual-control">
					<button id="to2" type="button" class="btn btn-default">&nbsp;&gt;&nbsp;</button>
					<button id="allTo2" type="button" class="btn btn-default">&nbsp;&gt;&gt;&nbsp;</button><br />
					<button id="to1" type="button" class="btn btn-default">&nbsp;&lt;&nbsp;</button>
					<button id="allTo1" type="button" class="btn btn-default">&nbsp;&lt;&lt;&nbsp;</button>
				</div>
				<!-- /control buttons -->
				
				<!-- Right box -->
				<div class="right-box">
					<input type="text" id="box2Filter" class="form-control" placeholder="Filter entries...">
					<button type="button" id="box2Clear" class="filter">x</button>
					<select id="box2View" multiple="multiple" class="form-control" name="permission_id[]">
						<?php
							foreach ($listPermission->result() as $permission){
								if (in_array($permission->permission_id, $listPermissionByRoles)) {
									?>
										<option value="<?=$permission->permission_id?>"><?=$permission->description?></option>
									<?php
								}
							}
						?>
					</select>
					<span id="box2Counter" class="count-label"></span>
					<select id="box2Storage"></select>
				</div>
				<!-- /right box -->
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	<!-- /basic inputs -->
</form>