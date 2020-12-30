<div class="panel panel-default">
	<div class="panel-heading">
	  <h6 class="panel-title"><i class="icon-table2"></i> List Roles</h6>
	</div>
	<div class="datatable">
	  <table class="table table-striped table-bordered table-check">
		<thead>
		  <tr>
			<th>#</th>
			<th>Role</th>
			<th>Full Name Role</th>
			<th>Default</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($listRoles->result() as $role){
					?>
						<tr>
							<td><?=$no?></td>
							<td><?=$role->role?></td>
							<td><?=$role->full?></td>
							<td><?php if($role->default== '1') { echo 'Yes'; } else { echo 'No'; } ?></td>
							<td>
								<div class="table-controls">
									<a href="<?=site_url('roles/change_default/'.$role->role_id)?>" class="btn btn-primary btn-icon btn-xs tip" title="Default"><i class="icon-spinner8"></i></a>
									<a href="<?=site_url('permission/role_permission/'.$role->role_id)?>" class="btn btn-primary btn-icon btn-xs tip" title="Role Permission"><i class="icon-settings"></i></a>
									<a href="<?=site_url('roles/update/'.$role->role_id)?>" class="btn btn-default btn-icon btn-xs tip" title="Update"><i class="icon-pencil"></i></a>
									<a href="<?=site_url('roles/delete/'.$role->role_id)?>" class="btn btn-danger btn-icon btn-xs tip" title="Delete" onclick="return confirm('Are You Sure Want to Delete This Data?')"><i class="icon-remove2"></i></a>
								</div>
							</td>
						</tr>
					<?php
					$no++;
				}
			?>
		</tbody>
	  </table>
	</div>
	<div class="panel-toolbar" style="padding:2px; border-top:1px solid #ddd;">
		<center>
			<a href="<?=site_url('roles/add')?>" title=""><button type="button" class="btn btn-primary btn-right-icon"><i class="icon-plus-circle"></i> Add Role</button></a>
		</center>
	</div>
</div>