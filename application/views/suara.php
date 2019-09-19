<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					Telah ditutup pada:
				</div>
				<div class="panel-body">
					<!-- Menampilkan waktu ditutupnya pemungutan suara -->
					<!-- Variabel ???????? diset dan dikirim dari ???????????????????????? -->
					<?php 
					date_default_timezone_set('Asia/Jakarta');
					echo date('D j M Y H:i'); 
					?>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="panel panel-warning">
				<div class="panel-heading">
					Total Pemilih Tetap
				</div>
				<div class="panel-body">
					<!-- Menampilkan total pemilih tetap -->
					<!-- Variabel $total diset dan dikirim dari application/controllers/vote.php line 34 -->
					<?php echo $total; ?> orang
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					Memberikan Hak Suara
				</div>
				<div class="panel-body">
					<!-- Menampilkan jumlah pemilih yang ikut voting -->
					<!-- Variabel $telah_memilih diset dan dikirim dari application/controllers/vote.php line 33 -->
					<?php echo $telah_memilih; ?> orang
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Tidak Memberikan Hak Suara
				</div>
				<div class="panel-body">
					<!-- Menaghitung dan menampilkan jumlah pemilih yang tidak ikut voting -->
					<?php echo $total-$telah_memilih; ?> orang
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					Alat
				</div>
				<div class="panel-body">
					<!-- Menaghitung dan menampilkan jumlah pemilih yang tidak ikut voting -->
					<a href="<?php echo base_url('admin/statistik'); ?>" class="btn btn-default btn-sm">Statistik</a>
					<a href="<?php echo base_url('admin/audit'); ?>" class="btn btn-default btn-sm">Audit</a>
					<a target="_blank" rel="nofollow" href="<?php echo base_url('vote/cetak_hasil'); ?>" class="btn btn-default btn-sm">Print</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-group" id="accordion">
	<?php 
	//Melakukan looping (dengan foreach) untuk menampilkan variabel isi $jabatan yg dikirim dari controller
	//Variabel $jabatan diset dan dikirim dari application/controllers/vote.php line ????????????????????
	$i = 0;
	foreach ($jabatan as $j):	
	//$query_subtotal = 'SELECT * FROM pemilih WHERE dapil LIKE \'%'.$j.'%\'';
	//$subtotal = $this->db->query($query_subtotal)->num_rows();
	//echo $subtotal;
	//Pengambilan data kandidat dari database sesuai dengan jabatan
	$query_kandidat = $this->db->get_where('kandidat', array('jabatan' => $j->id))->result();
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $j->kode_jabatan.$j->kode_dapil; ?>">
				<strong class=" pull-right" style="color: #bdc3c7;">v</strong>
				<!-- Menampilkan field jabatan dan field dapil dari database -->
				<strong>Hasil: </strong><?php echo $j->jabatan.' '.$j->dapil; ?></a>
				</h4>
			</div>
			<div id="<?php echo $j->kode_jabatan.$j->kode_dapil; ?>" class="panel-collapse">
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>No Urut</th>
								<th>Nama</th>
								<th>Perolehan Suara</th>
								<th>Persentase</th>
								<th width="30%">Bar</th>
							</tr>
						</thead>
						<tbody>
								<?php 
								//Pengambilan data suara dari database dan menyimpannya ke variabel
								$query_suara = $this->db->get_where('suara', array('jabatan' => $j->id))->result();
								$suara_kosong = array(); //Variabel untuk suara golput
								$hasil_suara = array(); //Variabel untuk suara yg dipilih

								//Looping untuk mengisi dua variabel array diatas
								//Variabel $query_suara diset pada line 98
								foreach ($query_suara as $qs) {
									$decode_suara = $this->encrypt->decode($qs->suara); //decrypt data suara
									if ($decode_suara == 'none') {
										array_push($suara_kosong, $decode_suara);											
									} else {
										array_push($hasil_suara, $decode_suara);											
									}
									
								}
								//Variabel untuk menghitung total suara diperoleh dari setiap kandidat
								$hitung = array_count_values($hasil_suara); 
								
								//Looping untuk menampilkan data kandidat
								//Variabel $query_kandidat diset pada line 67
								foreach ($query_kandidat as $qk): ?>
									<tr>
									<!-- Nomer urut -->
									<td><?php echo $qk->no_urut; ?></td> 
									<!-- Nama -->
									<?php if ( $qk->nama2): ?>
										<td><?php echo $qk->nama.' dan '.$qk->nama2;?></td>										
									<?php else: ?>
										<td><?php echo $qk->nama;?></td>										
									<?php endif ?>
									<!-- Total suara yg didapatkan -->
									<?php 
									$final_count;
									if (in_array($qk->id, $hasil_suara)) {
										echo "<td>".$hitung[$qk->id]."</td>";
										$final_count = $hitung[$qk->id];
									} else {
										echo "<td> 0 </td>";
										$final_count = 0;
									}
									if ($total == 0) {
										$persen = 0;
									} else {
										$persen = ($final_count/$total)*100;
									}
									?>
									<!-- Menampilkan perolehan suara dalam persen -->
									<td><?php echo $persen = round($persen, 2),"%"; ?></td>
									<td>
									<!-- Menampilkan perolehan suara dalam grafik bar -->
									<div class="progress">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen; ?>%;">
											<span class="sr-only">60% Complete</span>
										</div>
									</div>
									</td>
								</tr>
								<?php $i++;
								endforeach ?>
								<tr>
									<td><i>Suara kosong: <?php echo count($suara_kosong); ?></i></td>
									<!--<td><i>Tidak memberikan suara: <?php echo $total-$telah_memilih; ?></i></td>-->
								</tr>
						</tbody>
					</table>
					<!--<button class="btn btn-default">Print</button>-->
				</div>
			</div>
		</div>
	<?php endforeach ?>
	</div>
</div>