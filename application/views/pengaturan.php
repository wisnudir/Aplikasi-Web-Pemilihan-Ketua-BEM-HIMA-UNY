<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a>
		</div>
	</div><br>
	<?php
      if ($sukses) {
        echo "<div class='alert alert-success'>
                  <strong>Sukses! </strong>",
        $sukses,"</div>";
      }
      elseif ($error or $error_validation) {
        echo "<div class='alert alert-danger'>
                  <strong>Gagal! </strong>",
        $error, $error_validation,"</div>";
      }
    ?>
	<div class="row">		
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Pengaturan waktu</strong>
					<?php if ($batasan_waktu_vote): ?>
						<a href="<?php echo base_url('admin/pengaturan_waktu'); ?>" class="pull-right btn btn-default btn-sm">Edit</a><br><br>
					<?php else: ?>
						<i class="pull-right btn btn-default btn-sm disabled">Edit</i><br><br>
					<?php endif ?>
				</div>
				<div class="panel-body">
					<table class="table-hover table">
						<tbody>
							<tr>
								<td>Pembatasan Waktu Voting</td>
								<?php if ($batasan_waktu_vote): ?>
								<td>
									<b class="text-success">Ya</b>
									<a href="<?php echo base_url('admin/toggle/batasan_waktu_vote/0'); ?>" class="btn btn-danger btn-xs pull-right"> Nonktifkan Batasan</a>
								</td>
								<?php else: ?>
								<td>
									<b class="text-danger">Tidak Dibatasi</b>
									<a href="<?php echo base_url('admin/toggle/batasan_waktu_vote/1'); ?>" class="btn btn-success btn-xs pull-right"> Aktifkan Batasan</a>
								</td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Tanggal Pemilihan Dibuka</td>
								<?php if ($batasan_waktu_vote): ?>
								<td><b class="text-success"><?php echo date($tanggal_mulai); ?></b></td>
								<?php else: ?>
								<td><b class="text-danger">None</b></td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Tanggal Pemilihan Ditutup</td>
								<?php if ($batasan_waktu_vote): ?>
								<td><b class="text-success"><?php echo date($tanggal_akhir); ?></b></td>
								<?php else: ?>
								<td><b class="text-danger">None</b></td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Tanggal Penghitungan Suara</td>
								<?php if ($batasan_waktu_vote): ?>
								<td><b class="text-success"><?php echo date($tanggal_hitung); ?></b></td>
								<?php else: ?>
								<td><b class="text-danger">None</b></td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Jam Pemilihan Dibuka</td>
								<?php if ($batasan_waktu_vote): ?>
								<td><b class="text-success"><?php echo date($jam_buka); ?></b></td>
								<?php else: ?>
								<td><b class="text-danger">None</b></td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Jam Pemilihan Ditutup</td>
								<?php if ($batasan_waktu_vote): ?>
								<td><b class="text-success"><?php echo date($jam_tutup); ?></b></td>
								<?php else: ?>
								<td><b class="text-danger">None</b></td>
								<?php endif ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Pengaturan Voting</strong>
				</div>
				<div class="panel-body">
					<table class="table-hover table">
						<tbody>
							<tr>
								<td>Print suara setelah selesai memilih</td>
								<?php if ($print_suara): ?>
								<td>
									<b class="text-success">Ya</b>
								</td><td>
									<a href="<?php echo base_url('admin/toggle/print_suara/0'); ?>" class="btn btn-danger btn-xs"> Nonaktifkan Print Suara</a>
								</td>
								<?php else: ?>
								<td>
									<b class="text-danger">Tidak</b>
								</td><td>
									<a href="<?php echo base_url('admin/toggle/print_suara/1'); ?>" class="btn btn-success btn-xs"> Aktifkan Print Suara</a>
								</td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Verifikasi pemilih</td>
								<?php if ($verifikasi_voter): ?>
								<td>
									<b class="text-success">Ya</b>
								</td><td>
									<a href="<?php echo base_url('admin/toggle/verifikasi_voter/0'); ?>" class="btn btn-danger btn-xs"> Nonaktifkan Verifikasi</a>
								</td>
								<?php else: ?>
								<td>
									<b class="text-danger">Tidak</b>
								</td><td>
									<a href="<?php echo base_url('admin/toggle/verifikasi_voter/1'); ?>" class="btn btn-success btn-xs"> Aktifkan Verifikasi</a>
								</td>
								<?php endif ?>
							</tr>
							<tr>
								<td>Jabatan yang dibuka:<br>
									<?php 
									$daftar_jabatan = $this->Pemilwa_model->get_field('id', 'jabatan');
									foreach ($daftar_jabatan as $dj) {
										echo $dj->id.', ';
									} 
									?>
								</td>
								</td><td>
								<td><a href="<?php echo base_url('jabatan') ?>" class="btn btn-default btn-xs">Edit</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<strong>Pengaturan Data</strong>
				</div>
				<div class="panel-body">
					<div class="pull-left">						
						<a href="#myModalpemilih" data-toggle="modal" class="btn btn-warning btn-sm"><b>Reset data pemilih tetap</b></a>
						<a href="#myModalkandidat" data-toggle="modal" class="btn btn-warning btn-sm"><b>Reset data kandidat</b></a>
						<a href="#myModalsuara" data-toggle="modal" class="btn btn-warning btn-sm"><b>Reset data suara</b></a><br><br>
					</div>
					<div class="pull-right">						
						<a href="<?php echo base_url('admin/backup/pemilih') ?>" class="btn btn-info btn-sm"><b>Backup data pemilih tetap</b></a>
						<a href="<?php echo base_url('admin/backup/kandidat') ?>" class="btn btn-info btn-sm"><b>Backup data kandidat</b></a>
						<a href="<?php echo base_url('admin/backup/suara') ?>" class="btn btn-info btn-sm"><b>Backup data suara</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- MODAL -->
<?php $reset = array('pemilih', 'kandidat', 'suara'); ?>
<?php foreach ($reset as $res): ?>
<div id="<?php echo 'myModal'.$res; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Hapus.</h4>
			</div>
			<div class="modal-body">
				<p>Anda yakin akan menghapus akun ini?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<a type="button" class="btn btn-default" href="<?php echo base_url('admin/reset/'.$res); ?>">Ya, lanjutkan!</a>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>
</div>