<div class="container">
	<?php
	$user = $this->session->userdata('voter_id');
	$user_db = $this->db->get_where('pemilih', array('id' => $user))->row();

	$list_nama_jabatan = array();
	foreach ($jabatan as $j) {
		$query_jabatan = $this->db->get_where('jabatan', array('id' => $j))->row();
		$nama_jabatan =  $query_jabatan->jabatan.'<br>'.$query_jabatan->dapil;
		array_push($list_nama_jabatan, $nama_jabatan);
	}

	$list_suara = array();
	$list_nama_kandidat = array();
	foreach ($suara as $s) {
		$s_decode = $this->encrypt->decode($s);
		array_push($list_suara, $s_decode);
		if ($s_decode == 'none') {
			$nama_kandidat = 'kosong';
			array_push($list_nama_kandidat, $nama_kandidat);
		} else {
			$query_kandidat = $this->db->get_where('kandidat', array('id' => $s_decode))->row();
			if ($query_kandidat->nama2 == null) {
				$nama_kandidat = $query_kandidat->nama;
				array_push($list_nama_kandidat, $nama_kandidat);
			} else {
				$nama_kandidat = $query_kandidat->nama.' dan '.$query_kandidat->nama2;
				array_push($list_nama_kandidat, $nama_kandidat);
			}
		}			
	}
		$combine_suara = array_combine( $list_nama_jabatan, $list_nama_kandidat);
	?>
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-info">
				<div class="panel-heading"><strong>Pemilih</strong></div>
				<div class="panel-body">
					Nama: <?php echo $user_db->nama; ?>
					<br>NIM: <?php echo $user; ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6 alert alert-info text-center">
			<?php 
			echo form_open('vote/selesai'); 
			foreach ($barcode as $b) {
				echo form_hidden('barcode[]', $b);				
			}
			foreach ($jabatan as $jb) {
				echo form_hidden('jabatan[]', $jb);				
			}
			foreach ($no_urut as $nu) {
				echo form_hidden('no_urut[]', $nu);				
			}
			?>
			<b style="font-size: 18pt">Terima kasih!</b><br>
			<b>Telah memberikan hak suara Anda.</b><br><br>
			<?php 			
			$submit = array('type' => 'submit', 'class' => 'btn btn-info', 'value' => 'Logout');
			echo form_submit($submit);
			echo form_close();
			?>			
			<small>
				Silakan tekan tombol logout.<br>
				<?php //if ($this->akun_model->pengaturan('print_suara')): ?>				
					Kemudian ambil kertas hasil cetak dari printer dan masukkan ke dalam kotak audit.<br>
				<?php //endif ?>
			</small>
		</div>
		<div class="col-sm-3">
			<div class="panel panel-info">
				<div class="panel-heading"><strong>Waktu</strong></div>
				<div class="panel-body">
					Tanggal: <?php echo date('Y M j'); ?>
					<br>Pukul: <?php echo date('H:i:s') ?>
				</div>
			</div>
		</div>		
	</div>	
<hr>
	<div class="row">
	<?php $i = 0; ?>
	<?php foreach ($combine_suara as $key => $value): ?>
	<div class="col-sm-3">
		<div class="panel-body text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $key; ?></h3>
				</div>
				<div class="panel-body">
				<?php $query_gambar = $this->db->get_where('kandidat', array('id' => $list_suara[$i]))->row(); ?>
				<?php if ($list_suara[$i] !== 'none'): ?>					
					<img src="<?php echo base_url('asset/upload/img/'.$query_gambar->pict) ?>" style="width:100%">
				<?php else: ?>
					<img src="<?php echo base_url('asset/upload/img/default.png') ?>" style="width:100%">					
				<?php endif ?>
				</div>
				<div class="panel-footer">
					<?php echo $value; ?><br>
				</div>
			</div>
		</div>
	</div>
	<?php $i++; ?>
	<?php endforeach ?>

	<?php //if ($this->akun_model->pengaturan('print_suara')): ?>
		<!-- PRINT PREVIEW -->
		<div class="col-sm-3 text-center pull-right panel panel-default">
		<strong>Print preview:</strong><br>
			<h4>PEMILWA ONLINE</h4>
			<p>Fakultas Matematika <br> dan Ilmu Pengetahuan Alam <br> UNY</p>
				<?php foreach ($barcode as $bc): ?>
					<img src="<?php echo base_url('asset/img/barcode/'.$bc.'.png') ?>">
					<br>
				<?php endforeach ?><br>
			<p>Terimakasih telah memberikan hak suara Anda.<br>KPU FMIPA UNY 2018</p>
		</div>
	<?php //endif ?>
	</div>
</div>

