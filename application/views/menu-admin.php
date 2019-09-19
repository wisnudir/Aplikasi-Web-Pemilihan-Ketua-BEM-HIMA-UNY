<div class="container">
	<div class="container">
		<h3 class="pull-left">Menu Utama</h3>
		<div class="dropdown pull-right">
		  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><img src="<?php echo base_url('asset/img/user.svg')?>" alt="ikon verifikasi" width="15px"> <?php echo $cek ?>
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="<?php echo base_url('admin/logout')?>">Logout</a></li>
		  </ul>
		</div>
	</div>
		<div class="col-sm-3">
			<div class="panel panel-success">
				<div class="panel-body" style="background-color: #2ECC71">
					<img src="<?php echo base_url('asset/img/log.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<a href="<?php echo base_url('admin/panduan')?>" title="" class="btn btn-default">Panduan</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-success">
				<div class="panel-body" style="background-color: #1ABC9C">
					<img src="<?php echo base_url('asset/img/umum.svg')?>" alt="ikon setting umum" width="100%">
				</div>
				<div class="panel-heading text-center">
					<?php if ($role == '2' ): ?>
						<a class="btn btn-default disabled"><img src="<?php echo base_url('asset/img/block.png')?>" width="10px"></a>
						<a href="#" title="Pengaturan" class="btn btn-default disabled">  Pengaturan </a> 
					<?php else: ?>
						<a href="<?php echo base_url('admin/pengaturan')?>" title="" class="btn btn-default">Pengaturan</a>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-info">
				<div class="panel-body" style="background-color: #3498DB">
					<img src="<?php echo base_url('asset/img/pemilih.svg')?>" alt="ikon voter" width="100%">
				</div>
				<div class="panel-heading text-center">
					<a href="<?php echo base_url('pemilih')?>" title="" class="btn btn-default">Data Pemilih</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-body" style="background-color: #9b59b6">
					<img src="<?php echo base_url('asset/img/kandidat.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<a href="<?php echo base_url('kandidat')?>" title="" class="btn btn-default">Data Kandidat</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-warning">
				<div class="panel-body" style="background-color: #f1c40f">
					<img src="<?php echo base_url('asset/img/verifikasi.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<?php if ($role == '1' ): ?>
						<a class="btn btn-default disabled"><img src="<?php echo base_url('asset/img/block.png')?>" width="10px"></a>
						<a href="#" title="Pengaturan" class="btn btn-default disabled"> Verifikasi Pemilih </a>
					<?php else: ?> 
						<a href="<?php echo base_url('admin/verifikasi')?>" title="" class="btn btn-default">Verifikasi Pemilih</a>
					<?php endif ?>
				</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-warning">
				<div class="panel-body" style="background-color: #e67e22">
					<img src="<?php echo base_url('asset/img/panitia.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<a href="<?php echo base_url('panitia')?>" title="" class="btn btn-default">Data Panitia</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-danger">
				<div class="panel-body" style="background-color: #e74c3c">
					<img src="<?php echo base_url('asset/img/suara.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<?php if ($role == '2' ): ?>
						<a class="btn btn-default disabled"><img src="<?php echo base_url('asset/img/block.png')?>" width="10px"></a>
						<a href="#" title="Data Suara" class="btn btn-default disabled"> Data Suara</a>
					<?php else: ?> 
						<a href="<?php echo base_url('vote/suara')?>" title="" class="btn btn-default">Data Suara</a>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-body" style="background-color: #34495e">
					<img src="<?php echo base_url('asset/img/audit.svg')?>" alt="ikon verifikasi" width="100%">
				</div>
				<div class="panel-heading text-center">
					<a href="<?php echo base_url('admin/statistik')?>" title="" class="btn btn-default">Statistik</a>
				</div>
			</div>
		</div>
</div>