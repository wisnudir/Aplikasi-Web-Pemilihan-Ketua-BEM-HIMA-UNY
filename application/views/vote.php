<div class="container">
	<?php 
	$id_pemilih = $this->session->userdata('voter_id'); 
	$nama_pemilih = $this->db->get_where('pemilih', array('id' => $id_pemilih))->row();
	?>
	<p class="alert alert-warning alert-dismissable"><a href="#" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a><strong><?php echo $id_pemilih; ?> <?php echo $nama_pemilih->nama; ?></strong> <span class="pull-right">Pilih satu kandidat pada setiap jabatan, klik tombol <b>next</b> untuk lanjut ke jabatan selanjutnya.</span></p>
	<?php echo form_open('vote/simpan_suara', array('id' => 'regForm' )); ?>
	<div class="progress">
	  <div class="progress-bar progress-bar-info" role="progressbar" id="pgBar"></div>
	</div>
	<?php 
	$dapil_pemilih = $this->db->select('dapil')->get_where('pemilih', array('id' => $this->session->userdata('voter_id')))->row();
	$dap = explode(',', $dapil_pemilih->dapil);

    foreach ($dap as $d) {
		$jabatan = $this->db->get_where('jabatan', array('kode_dapil' => $d))->result();
		foreach ($jabatan as $j) {
			echo '<div class="tab">
				<div class="text-center">
				<h2>'.$j->jabatan.' '.$j->dapil.'</h2></div>';
			$query = $this->db->get_where('kandidat', array('jabatan' => $j->id))->result();
			foreach ($query as $data_kandidat) {
				if ($data_kandidat->nama2 == null) {
					$nama = $data_kandidat->nama;
				} else {
					$nama = $data_kandidat->nama.' dan '.$data_kandidat->nama2;
				}
				echo	'<div class="col-sm-3">
							<div class="panel-body text-center">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title badge">'.$data_kandidat->no_urut.'</h3>
									</div>
									<div class="panel-body">
										<img src="'.base_url("asset/upload/img/".$data_kandidat->pict).'" style="width: 100%">
									</div>
									<div class="panel-footer">
										<input type="radio" name="'.$j->id.'" value="'.$data_kandidat->id.'" class="form-control"> 
										<strong>'.$nama.'</strong>
									</div>
								</div>
							</div>
						</div>';
			}
			echo 	'<p><input checked type="radio" name="'.$j->id.'" value="none" class="form-control hidden"></p>';
			echo '</div>';
		}        
    }
	?>
	<div class="row">
	  <div class="col-xs-12">
	    <button class="btn btn-warning" type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
	    <button class="btn btn-warning pull-right" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
	  </div>
	</div>
<hr>

	<?php form_close(); ?>
</div>