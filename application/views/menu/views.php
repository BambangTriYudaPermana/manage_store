<div class="panel panel-default">
	<div class="panel-heading">
	  <h6 class="panel-title"><i class="icon-table2"></i> List Menu</h6>
	</div>
	<div class="datatable">
		<table class="table table-striped table-bordered table-check">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Menu</th>
					<th>Parent Menu</th>
					<th>icon</th>
					<th>kategori</th>
					<th>Link</th>
					<th>Urutan Menu</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach ($listMenu->result() as $menu){
						?>
						<tr>
							<td><?=$x?></td>
							<td><?=$menu->nama_menu?></td>
							<td><?=$menu->nama_menu_parent?></td>
							<td><?=$menu->icon?></td>
							<td><?=$menu->kategori?></td>
							<td><?=$menu->href?></td>
							<td><?=$menu->sort?></td>
							<td><?=$menu->status?></td>
							<td>
								<div class="table-controls">
									<a href="<?=site_url('menu/update/'.$menu->id_menu)?>" class="btn btn-default btn-icon btn-xs tip" title="Update"><i class="icon-pencil"></i></a>
									<a href="<?=site_url('menu/delete/'.$menu->id_menu)?>" class="btn btn-danger btn-icon btn-xs tip" title="Delete" onclick="return confirm('Are You Sure Want to Delete This Data?')"><i class="icon-remove2"></i></a>
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
			<a href="<?=site_url('menu/add')?>" title=""><button type="button" class="btn btn-primary btn-right-icon"><i class="icon-plus-circle"></i> Tambah Data</button></a>
		</center>
	</div>
</div>