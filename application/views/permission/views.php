<div class="panel panel-default">
	<div class="panel-heading">
	  <h6 class="panel-title"><i class="icon-table2"></i> List Permission</h6>
	</div>
	<div class="datatable">
		<table class="table table-striped table-bordered table-check">
			<thead>
				<tr>
					<th>#</th>
					<th>Permission</th>
					<th>Controller</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach ($listPermission->result() as $permission){
						?>
						<tr>
							<td><?=$x?></td>
							<td><?=$permission->description?></td>
							<td><?=$permission->permission?></td>
							<td>
								<div class="table-controls">
									<a href="<?=site_url('permission/update/'.$permission->	permission_id)?>" class="btn btn-default btn-icon btn-xs tip" title="Update"><i class="icon-pencil"></i></a>
									<a href="<?=site_url('permission/delete/'.$permission->	permission_id)?>" class="btn btn-danger btn-icon btn-xs tip" title="Delete" onclick="return confirm('Are You Sure Want to Delete This Data?')"><i class="icon-remove2"></i></a>
								</div>
							</td>
						</tr>
						<?php
						$x++;
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="panel-toolbar" style="padding:2px; border-top:1px solid #ddd;">
		<center>
			<a href="<?=site_url('permission/add')?>" title=""><button type="button" class="btn btn-primary btn-right-icon"><i class="icon-plus-circle"></i> Tambah Data</button></a>
		</center>
	</div>
</div>