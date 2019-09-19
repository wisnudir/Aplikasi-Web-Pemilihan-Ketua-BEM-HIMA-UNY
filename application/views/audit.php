<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a>
		</div>
	</div>
	<div>
		<h1>Audit.</h1>
	</div>
	<p class="lead">Untuk melakukan audit suara, silakan masukkan kode atau scan barcode yg tertera pada lembar audit.</p>
		<?php 
		$attributes = array('class'=>'form-inline');
	    echo form_open('admin/audit', $attributes); ?>
	    <?php echo form_input($kode); ?>
	    <?php echo form_submit($submit); ?>	    
	    <?php echo form_close(); ?>
		<script>
			kode.onblur = function () {
				kode.focus();
			}
		</script>

  <p><code>Perhatian!</code> <i>Jika menggunakan scanner tidak perlu menekan tombol cek.</i></p>
	<hr>

	<?php
	      if ($sukses) {
	        echo "<div class='alert alert-info alert-dismissible' role='alert'>
	                  <strong>Sukses! </strong>",
	        $sukses,"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	      }
	      elseif ($error or $error_validation) {
	        echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	                  <strong>Gagal! </strong>", $error, $error_validation,"</div>";
	      }
	?>
	
	<?php if ($data): ?>
		<?php 
			$id_kandidat = $this->encrypt->decode($data->suara);
			if ($id_kandidat == 'none') {
				$no_urut = 'Tidak Memilih';
				$nama = 'Tidak Memilih';
			} else {
				$query_nourut = $this->db->get_where('kandidat', array('id' => $id_kandidat))->row();
				$no_urut = $query_nourut->no_urut;
				if ($query_nourut->nama2 == null) {
					$nama = $query_nourut->nama;
				} else {
					$nama = $query_nourut->nama.' dan '.$query_nourut->nama2;
				}
			}
		?>
		<h2>Data.</h2>
		<table class="table">
			<caption>Data dari kode <strong><?php echo $kode_encode; ?></strong> adalah sebagai berikut:</caption>
			<thead>
				<tr>
					<th>Kategori</th>
					<th>Nomor</th>
					<th>Nama</th>
					<th>Waktu</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $data->jabatan; ?></td>
					<td><?php echo $no_urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $data->waktu; ?></td>
				</tr>
			</tbody>
		</table>
	<?php endif ?>
	
</div>