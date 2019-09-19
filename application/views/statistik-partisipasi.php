<div class="container">
	<a href="<?php echo base_url('admin')?>" title="">&lt; kembali ke Menu Utama</a>
	<hr>
	<div class="row">
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">			
					<b>Partisipasi Pemilih Fakultas MIPA</b>
					<?php 						
						$jurusan = array();
						$nama_jurusan = array();
						foreach ($jabatan as $jab) {
							if ($jab->kode_jabatan == 'HIM') {
								array_push($jurusan, $jab->kode_dapil);
								array_push($nama_jurusan, $jab->dapil);
							}	
						};
					?>
				</div>
				<div class="panel-body">
					<div class="col-sm-5">					
						<span class="donut" data-peity='{"fill": ["#20c1bd", "#dbedf3"], "innerRadius":50, "radius": 60 }'><?php echo $telah_memilih.'/'.$total ?></span>
						<?php $kontribusi = null; 
						foreach ($jurusan as $jur) {
							if ($total == 0) {
								$kontribusi = 0;
							} else {
								$kontribusi = $kontribusi.(${$jur}/$total).',';
							}
						}?>					
						<span class="donut" data-peity='{"fill": ["#ffa600","#ff6361","#bc5090","#58508d","#003f5c","#eeeeee"], "innerRadius":30, "radius": 60 }'><?php echo $kontribusi; ?></span>
					</div>			
					<div class="col-sm-4">
						Partisipasi: <br>
						<b>Total:</b> <?php echo $total ?> <br>
						<?php 
						if ($total == 0) {
							$persen_memilih = 0;
						} else {
							$persen_memilih = ($telah_memilih/$total)*100;							
						}
						?>
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#20c1bd;" />
						</svg> <b>Memilih:</b> <?php echo $telah_memilih,' (', round($persen_memilih,2), '%)'; ?> 
						<br>
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#dbedf3;" />
						</svg> <b>Tidak Memilih:</b> <?php echo ($total-$telah_memilih),' (',(100-round($persen_memilih,2)),'%)' ?>
						<br><br>
					</div>
					<div class="col-sm-3">
						Kontribusi: <br>
						<?php 
							$color = array("#ffa600","#ff6361","#bc5090","#58508d","#003f5c","#eeeeee"); 
							$i = 0;
						?>
						<?php foreach ($jurusan as $jur): ?>
								<svg width="10" height="10">
									<rect width="10" height="10" style="fill:<?php echo $color[$i]; ?>;" />
								</svg> 
								<b><?php echo $jur,': '; ?></b>
								<?php 
								if ($total == 0) {
									echo ${$jur}.' (0%)'; 
								} else {
									echo ${$jur}.' ('.round(((${$jur}/$total)*100),2).'%)'; 							
								}

								?> 
								<br>
								<?php $i++; ?>							
						<?php endforeach ?>				
					</div>		
				</div>
			</div>	
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">			
					<b>Partisipasi Per Jurusan</b>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">						
						<?php 
						$partisipasi_jurusan = null; 
						$k = 0;
						$max = count($jurusan);
						foreach ($jurusan as $jur) {
							if (${'total'.$jur} == 0) {
								if ($k == $max-1) {									
									$partisipasi_jurusan = $partisipasi_jurusan.'0';
								} else {									
									$partisipasi_jurusan = $partisipasi_jurusan.'0,';
								}
							} else {
								if ($k == $max-1) {									
									$partisipasi_jurusan = $partisipasi_jurusan.((${$jur}/${'total'.$jur})*10);
								} else {
									$partisipasi_jurusan = $partisipasi_jurusan.((${$jur}/${'total'.$jur})*10).',';
								}
							}
						$k++;
						} ?>	
						<span class="bar" data-peity='{"fill": ["#ffa600","#ff6361","#bc5090","#58508d","#003f5c","#eeeeee"], "height": 120, "width":120 }'><?php echo $partisipasi_jurusan; ?></span>					
					</div>
					<div class="col-xs-6">
						<br>
						<?php $j = 0;?>
						<?php foreach ($jurusan as $jur): ?>
								<svg width="10" height="10">
									<rect width="10" height="10" style="fill:<?php echo $color[$j]; ?>;" />
								</svg> 
								<b><?php echo $jur,': '; ?></b>
								<?php if (${'total'.$jur} == 0): ?>
									0 (0%)
								<?php else: ?>								
								<?php echo ${$jur}.' ('.round(((${$jur}/${'total'.$jur})*100),2).'%)'; ?> 
								<?php endif ?>
								<br>
								<?php $j++; ?>							
						<?php endforeach ?>			 						
					</div>
				</div>
			</div>	
		</div>
	</div>
	<hr>
	<div class="row">
		<?php $m = 0; ?>
		<?php foreach ($jurusan as $jur): ?>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">			
					<?php echo $nama_jurusan[$m]; ?>
				</div>
				<div class="panel-body">
					<div class="col-xs-4">
						<span class="donut" data-peity='{"fill": ["#4fb783", "#eef5db"], "innerRadius":22, "radius": 30 }'><?php echo ${$jur}.'/'.${'total'.$jur}; ?></span>							
					</div>
					<div class="col-xs-8">
						Total: <?php echo ${'total'.$jur} ?> <br>						
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#4fb783;" />
						</svg> Memilih: 
						<?php if (${'total'.$jur} == 0): ?>
							0 (0%)
						<?php else: ?>								
						<?php echo ${$jur}.' ('.round(((${$jur}/${'total'.$jur})*100),2).'%)'; ?> 
						<?php endif ?>
						<br>
						<svg width="10" height="10">
							<rect width="10" height="10" style="fill:#eef5db;" />
						</svg> Tidak Memilih:
						<?php if (${'total'.$jur} == 0): ?>
							0 (0%)
						<?php else: ?>	
						<?php echo ${'total'.$jur}-${$jur}.' ('.round((((${'total'.$jur}-${$jur})/${'total'.$jur})*100),2).'%)';?>	
						<?php endif ?>

					</div>				
				</div>
			</div>	
		</div>
		<?php $m++; ?>
		<?php endforeach ?>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">	
					Alat		
				</div>
				<div class="panel-body">
				<p>
					<?php 
						date_default_timezone_set('Asia/Jakarta');					
						echo 'Statistik per tanggal: '.date('Y-m-d H:i');
					?>
				</p>	
				<a href="<?php echo base_url('admin/audit'); ?>" class="btn btn-default ">Audit</a>
				<a target="_blank" href="<?php echo base_url('admin/cetak_statistik'); ?>" class="btn btn-default ">Print</a>
				<!--<a href="" class="btn btn-default ">Cetak</a>-->
				</div>
			</div>	
		</div>
	</div>
	<hr>
</div>

