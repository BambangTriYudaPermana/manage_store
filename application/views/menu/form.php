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
				<label class="col-sm-2 control-label">Nama Menu: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="nama_menu" placeholder="Nama Menu" autocomplete="off" value="<?php if( isset($nama_menu)  ) {echo $nama_menu;}?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Parent Menu: </label>
				<div class="col-sm-10">
					<select data-placeholder="Pilih Parent Menu..." name="id_menu_parent" class="select-search" tabindex="2">
						<option value="">Pilih Parent Menu</option> 
						<?php
							foreach($listMenu->result() as $menu){
								if($menu->id_menu == $id_menu_parent){
									echo '<option value="'.$menu->id_menu.'" selected >'.$menu->nama_menu.'</option>';
								}
								else{
									echo '<option value="'.$menu->id_menu.'">'.$menu->nama_menu.'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Icon: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="icon" placeholder="Icon" autocomplete="off" value="<?php if( isset($icon)  ) {echo $icon;}?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Kategori: </label>
				<div class="col-sm-10">
					<?php
						if(isset($kategori) && $kategori == "Link"){
							?>
								<label class="radio-inline radio-primary">
									<input type="radio" name="kategori" value="Controller" class="styled">
									Controllers
								</label>
								<label class="radio-inline radio-primary">
									<input type="radio" name="kategori" value="Link" class="styled" checked="checked">
									Link
								</label>
							<?php							
						}
						else {
							?>
								<label class="radio-inline radio-primary">
									<input type="radio" name="kategori" value="Controller" class="styled" checked="checked">
									Controllers
								</label>
								<label class="radio-inline radio-primary">
									<input type="radio" name="kategori" value="Link" class="styled">
									Link
								</label>
							<?php	
						}
					?>
					
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Link: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="href" placeholder="Link" autocomplete="off" value="<?php if( isset($href)  ) {echo $href;}?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Urutan Menu: </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="sort" placeholder="Urutan" autocomplete="off" value="<?php if( isset($sort)  ) {echo $sort;}?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Status: </label>
				<div class="col-sm-10">
					<?php
						if(isset($status) && $status == "N"){
							?>
								<label class="radio-inline radio-success">
									<input type="radio" name="status" value="Y" class="styled">
									Aktif
								</label>
								<label class="radio-inline radio-danger">
									<input type="radio" name="status" value="N" class="styled" checked="checked">
									Non Aktif
								</label>
							<?php							
						}
						else {
							?>
								<label class="radio-inline radio-success">
									<input type="radio" name="status" value="Y" class="styled" checked="checked">
									Aktif
								</label>
								<label class="radio-inline radio-danger">
									<input type="radio" name="status" value="N" class="styled">
									Non Aktif
								</label>
							<?php	
						}
					?>
				</div>
			</div>
			
			<div class="form-actions text-right">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	<!-- /basic inputs -->
</form>