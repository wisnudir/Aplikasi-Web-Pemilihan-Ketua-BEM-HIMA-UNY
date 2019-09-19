<div class="container">
	<a href="<?php echo base_url('admin')?>" title="">&lt; kembali ke Menu Utama</a>
	<div class="btn-group pull-right">
		<a href="<?php echo base_url('admin/statistik/statistik-partisipasi'); ?>" class="btn btn-default"><</a>
		<a href="<?php echo base_url('admin/statistik/statistik-distribusi-suara'); ?>" class="btn btn-default disabled">></a>
	</div>
	<h1>Distribusi Suara</h1>
	<hr>
	<div class="row">
		<?php foreach ($jabatan as $jab): ?>
		<div class="col">
			<div class="panel ">
				<div class="panel-heading text-center">
					<b style="font-size: 16pt"><?php echo $jab->jabatan.' '.$jab->dapil; ?></b>
				</div>
				<div class="panel-body">		
					<?php 
						$kode_jabatan_kandidat = $jab->kode_jabatan.$jab->kode_dapil;
						$nama_kandidat = $this->db->get_where('kandidat', array('jabatan' => $kode_jabatan_kandidat))->result(); 
					?>
					<?php foreach ($nama_kandidat as $nk): ?>
					<ul class="list-group col-sm-3 text-center">
						<li class="list-group-item" style="background-color: #f2f2f0"><b><?php echo $nk->nama; ?></b></li>
						<li class="list-group-item">
							<span class="donut" data-peity='{"fill": ["#ffa600","#ff6361","#bc5090","#58508d","#003f5c"], "innerRadius":30, "radius": 50 }'>2,2,2,2,1.9</span>
						</li>
						<li class="list-group-item">
							<svg width="10" height="10">
								<rect width="10" height="10" style="fill:#ffa600;" />
							</svg> <b>MAT:</b> 1245 (40%)
						</li>
						<li class="list-group-item">
							<svg width="10" height="10">
								<rect width="10" height="10" style="fill:#ff6361;" />
							</svg> <b>FIS:</b> 1245 (40%)
						</li>
						<li class="list-group-item">
							<svg width="10" height="10">
								<rect width="10" height="10" style="fill:#bc5090;" />
							</svg> <b>KIM:</b> 1245 (40%)
						</li>
						<li class="list-group-item">
							<svg width="10" height="10">
								<rect width="10" height="10" style="fill:#58508d;" />
							</svg> <b>BIO:</b> 1245 (40%)
						</li>
						<li class="list-group-item">
							<svg width="10" height="10">
								<rect width="10" height="10" style="fill:#003f5c;" />
							</svg> <b>IPA:</b> 1245 (40%)
						</li>
					</ul>
					<?php endforeach ?>
				</div>					
					<div class="col-xs-4">
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#4bbb8b;" />
						</svg> <b>Tidak Kosong:</b> 1245 (40%)
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#c93d1b;" />
						</svg> <b>Kosong:</b> 1245 (40%)
					</div>
					<div class="col-xs-8">
						<svg width="70%" height="10">
							<rect width="100%" height="5" style="fill:#4bbb8b;" />
						</svg>							
						<svg width="30%" height="10">
							<rect width="100%" height="5" style="fill:#c93d1b;" />
						</svg>				
					</div>
					<br><br>
			</div>
		</div>
		<?php endforeach ?>
	</div>
	<hr>
	<div class="row">
		<div class="text-center">
			<div class="btn-group">
				<a href="<?php echo base_url('admin/statistik/statistik-partisipasi'); ?>" class="btn btn-default">< Partisipasi</a>
				<a href="<?php echo base_url('admin/statistik/statistik-distribusi-suara'); ?>" class="btn btn-default disabled">Distribusi Suara ></a>
			</div>
		</div>
	</div>
	<hr>
</div>