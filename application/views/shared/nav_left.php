<!-- Page container -->
<div class="page-container">
	<!-- Sidebar -->
	<div class="sidebar">
		<div class="sidebar-content">
			<!-- User dropdown -->
			<div class="user-menu dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?=base_url()?>asset/images/demo/users/face3.png" alt="">
					<div class="user-info">Tintapuccino <span>CMS</span></div>
				</a>
				<div class="popup dropdown-menu dropdown-menu-right">
					<div class="thumbnail">
						<div class="thumb"><img alt="" src="<?=base_url()?>asset/images/demo/users/face3.png">
							<div class="thumb-options"><span><a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a><a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a></span></div>
						</div>
						<div class="caption text-center">
							<h6><?=$profile_name?> <small><?=$full_name_role?></small></h6>
						</div>
					</div>
					<ul class="list-group">
						<li class="list-group-item"><i class="icon-pencil3 text-muted"></i> My posts <span class="label label-success">289</span></li>
						<li class="list-group-item"><i class="icon-people text-muted"></i> Users online <span class="label label-danger">892</span></li>
						<li class="list-group-item"><i class="icon-stats2 text-muted"></i> Reports <span class="label label-primary">92</span></li>
						<li class="list-group-item"><i class="icon-stack text-muted"></i> Balance
							<h5 class="pull-right text-danger">$45.389</h5>
						</li>
					</ul>
				</div>
			</div>
		  <!-- /user dropdown -->
		  <!-- Main navigation -->
			<?php
				function showMenu($data,$link_active) {
					foreach($data as $menuUtama){
						if($menuUtama->child){
							?>
								<li>
									<a href="#"><span><?=$menuUtama->nama_menu?></span><?php if(empty($menuUtama->id_menu_parent)){ ?> <i class="<?=$menuUtama->icon?>"></i><?php } ?></a>
									<ul>
										<?php
											showMenu($menuUtama->content_child,$link_active);
										?>
									</ul>
								</li>
							<?php
						}
						else {
							?>
								<li <?php if($link_active == $menuUtama->href) { echo 'class="active"'; }?>>
									<a href="<?=site_url($menuUtama->href.'/')?>"><span><?=$menuUtama->nama_menu?></span><?php if(empty($menuUtama->id_menu_parent)){ ?> <i class="<?=$menuUtama->icon?>"></i><?php } ?></a>
								</li>
							<?php
						}
					}
				}
			?>
			<ul class="navigation">
				<li <?php if($link_active == "dashboard") { echo 'class="active"'; }?>>
					<a href="<?=site_url('dashboard/')?>"><span>Dashboard</span> <i class="icon-home2"></i></a>
				</li>
				
				<?php
					showMenu($ShowMenu,$link_active);
				?>
				
				<!--
				<li><a href="#" class="expand"><span>Navigation levels</span> <i class="icon-stack"></i></a>
					<ul>
						<li><a href="#">Second level first item</a></li>
						<li><a href="#" class="expand">Second level second item</a>
							<ul>
								<li><a href="#">Third level first item</a></li>
								<li><a href="#">Third level second item</a></li>
								<li><a href="#" class="expand">Third level third item</a>
									<ul>
										<li><a href="#">Fourth level first item</a></li>
										<li><a href="#">Fourth level second item</a></li>
										<li><a href="#">Fourth level third item</a></li>
									</ul>
								</li>
								<li><a href="#">Third level second item</a></li>
							</ul>
						</li>
						<li><a href="#">Second level third item</a></li>
					</ul>
				</li>
				-->
			</ul>
		  <!-- /main navigation -->
		</div>
	</div>
	<!-- /sidebar -->
	<!-- Page content -->
	<div class="page-content">
		<!-- Page header -->
		<div class="page-header">
		  <div class="page-title">
			<h3><?=$title?> <small>CMS Tintapuccino</small></h3>
		  </div>
		  <div id="reportrange" class="range">
			<div class="visible-xs header-element-toggle"><a class="btn btn-primary btn-icon"><i class="icon-calendar"></i></a></div>
			<div class="date-range"></div>
			<span class="label label-danger">9</span></div>
		</div>
		<!-- /page header -->
		<!-- Breadcrumbs line -->
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="index.html">Home</a></li>
				<li class="active">Dashboard</li>
			</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
			<ul class="breadcrumb-buttons collapse">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search3"></i> <span>Search</span> <b class="caret"></b></a>
				  <div class="popup dropdown-menu dropdown-menu-right">
					<div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Quick search</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
					<form action="#" class="breadcrumb-search">
					  <input type="text" placeholder="Type and hit enter..." name="search" class="form-control autocomplete">
					  <div class="row">
						<div class="col-xs-6">
						  <label class="radio">
							<input type="radio" name="search-option" class="styled" checked="checked">
							Everywhere</label>
						  <label class="radio">
							<input type="radio" name="search-option" class="styled">
							Invoices</label>
						</div>
						<div class="col-xs-6">
						  <label class="radio">
							<input type="radio" name="search-option" class="styled">
							Users</label>
						  <label class="radio">
							<input type="radio" name="search-option" class="styled">
							Orders</label>
						</div>
					  </div>
					  <input type="submit" class="btn btn-block btn-success" value="Search">
					</form>
				  </div>
				</li>
				<li class="language dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>asset/images/flags/german.png" alt=""> <span>German</span> <b class="caret"></b></a>
				  <ul class="dropdown-menu dropdown-menu-right icons-right">
					<li><a href="#"><img src="<?=base_url()?>asset/images/flags/ukrainian.png" alt=""> Ukrainian</a></li>
					<li class="active"><a href="#"><img src="<?=base_url()?>asset/images/flags/english.png" alt=""> English</a></li>
					<li><a href="#"><img src="<?=base_url()?>asset/images/flags/spanish.png" alt=""> Spanish</a></li>
					<li><a href="#"><img src="<?=base_url()?>asset/images/flags/german.png" alt=""> German</a></li>
					<li><a href="#"><img src="<?=base_url()?>asset/images/flags/hungarian.png" alt=""> Hungarian</a></li>
				  </ul>
				</li>
			</ul>
		</div>
		<!-- /breadcrumbs line -->