<div class="panel panel-default">
	<div class="panel-heading">
	  <h6 class="panel-title"><i class="icon-table2"></i> List Roles</h6>
	</div>
	<div class="datatable">
	  <table class="table table-striped table-bordered table-check">
		<thead>
		  <tr>
			<th>#</th>
			<th>USername</th>
			<th>Full Name</th>
			<th>Status</th>
			<th>Banned</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($listuser->result() as $user){
					?>
						<tr>
							<td><?=$no?></td>
							<td><?=$user->username?></td>
							<td><?=$user->name?></td>
							<td><?php if($user->activated== '1') { echo 'Active'; } else { echo 'Deactive'; } ?></td>
							<td><?php if($user->banned== '1') { echo 'Yes'; } else { echo 'No'; } ?></td>
							<td>
								<div class="table-controls">
									<a href="<?=site_url('usersmanagement/update/'.$user->id_user)?>" class="btn btn-default btn-icon btn-xs tip" title="Update"><i class="icon-pencil"></i></a>
									<?php
										if($user->banned== '1') {
											?>
												<a href="<?=site_url('usersmanagement/unbanned/'.$user->id_user)?>" class="btn btn-primary btn-icon btn-xs tip" title="Unbanned"><i class="icon-user-plus2"></i></a>
											<?php
										}
										else {
											?>
												<a href="<?=site_url('usersmanagement/banned/'.$user->id_user)?>" class="btn btn-danger btn-icon btn-xs tip" title="Banned" onclick="return confirm('Are You Sure Want to Banned This Data?')"><i class="icon-user-block"></i></a>
											<?php
										}
										if($user->activated== '0') {
											?>
												<a href="<?=site_url('usersmanagement/activate/'.$user->id_user)?>" class="btn btn-success btn-icon btn-xs tip" title="Active"><i class="icon-checkmark3"></i></a>
											<?php
										}
									?>
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
			<a href="<?=site_url('usersmanagement/add')?>" title=""><button type="button" class="btn btn-primary btn-right-icon"><i class="icon-plus-circle"></i> Add Users</button></a>

			<a href="<?=site_url('usersmanagement/import_user')?>" title=""><button type="button" class="btn btn-success btn-right-icon"><i class="icon-folder-upload"></i> Import Data User</button></a>

			<a href="<?=site_url('usersmanagement/import_target')?>" title=""><button type="button" class="btn btn-success btn-right-icon"><i class="icon-folder-upload"></i> Import Data Target</button></a>

			<a href="<?=site_url('usersmanagement/import_realisasi')?>" title=""><button type="button" class="btn btn-success btn-right-icon"><i class="icon-folder-upload"></i> Import Data Realisasi</button></a>

			<a href="<?=site_url('usersmanagement/import_alumni')?>" title=""><button type="button" class="btn btn-success btn-right-icon"><i class="icon-folder-upload"></i> Import Data Alumni</button></a>
		</center>
	</div>
</div>