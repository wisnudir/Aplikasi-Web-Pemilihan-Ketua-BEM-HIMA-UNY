<p>
	Total Pemilih Tetap: <?php echo $total; ?> <br>
Memberikan Hak Suara: <?php echo $telah_memilih; ?><br>
Tidak Memberikan Hak Suara: <?php echo $total-$telah_memilih; ?><br>
</p>
<p>
	<?php 
	$i = 0;
	foreach ($jabatan as $j):	
	$query_kandidat = $this->db->get_where('kandidat', array('jabatan' => $j->id))->result();
	?>	
	<hr>	
	<strong>Hasil: </strong><?php echo $j->jabatan.' '.$j->dapil; ?>
					<table style="text-align: center" border="1">
						<thead>
							<tr>
								<th>No Urut</th>
								<th>Nama</th>
								<th>Perolehan Suara</th>
							</tr>
						</thead>
						<tbody>
								<?php 
								$query_suara = $this->db->get_where('suara', array('jabatan' => $j->id))->result();
								$suara_kosong = array(); //Variabel untuk suara golput
								$hasil_suara = array(); //Variabel untuk suara yg dipilih
								foreach ($query_suara as $qs) {
									$decode_suara = $this->encrypt->decode($qs->suara); //decrypt data suara
									if ($decode_suara == 'none') {
										array_push($suara_kosong, $decode_suara);										
									} else {
										array_push($hasil_suara, $decode_suara);										
									}
								}
								$hitung = array_count_values($hasil_suara); 
								foreach ($query_kandidat as $qk): ?>
								<tr>
									<td><?php echo $qk->no_urut; ?></td> 
									<?php if ( $qk->nama2): ?>
										<td><?php echo $qk->nama.' dan '.$qk->nama2;?></td>							
									<?php else: ?>
										<td><?php echo $qk->nama;?></td>										
									<?php endif ?>
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
</p>