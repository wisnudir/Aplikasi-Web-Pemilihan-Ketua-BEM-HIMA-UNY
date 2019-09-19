<div class="container">
	<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a>
		</div>
	</div>
	<h2>Daftar Kandidat</h2>
      <?php 
      if ($sukses) {
        echo "<div class='alert alert-success'>
        <strong>Sukses! </strong>",     
         $sukses,"</div>";
      }
      elseif ($error) {
        echo "<div class='alert alert-danger'>
        <strong>Gagal! </strong>",      
         $error,"</div>";
      }
     ?> 
	<table class="table table-hover table-striped">
  <thead>
    <tr>      
      <th scope="col">Foto</th>
      <th scope="col">No Urut</th>
      <th scope="col">Nama</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Kontrol</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      if ($data_kandidat == null) {
        echo "<div class='alert alert-warning'>
        <strong>Warning! </strong> Tidak ada data.</div>";
      }

      foreach ($data_kandidat as $kandidat) {
        $kode_id = $this->pemilwa_library->encode_url($kandidat->id);
        $link_edit = 'kandidat/update_kandidat/'.$kode_id;
        $link_hapus = 'kandidat/hapus_kandidat/'.$kode_id;

        if ($kandidat->nama2 !== null) {
          $nama = $kandidat->nama." & ".$kandidat->nama2;
        } else {
          $nama = $kandidat->nama;
        }

        $data_jabatan = $this->db->select(array('jabatan', 'dapil'))->get_where('jabatan', array('id' => $kandidat->jabatan))->row();

        echo "<tr>  
      <td><img src='".base_url('asset/upload/img/'.$kandidat->pict)."' style='height: 50px'></td>
      <td class='col-lg-1'>", $kandidat->no_urut,"</td>
      <td>",$nama,"</td>
      <td><b>".$data_jabatan->jabatan."</b> dapil <b>".$data_jabatan->dapil."</b></td>
      <td>";
      if ($role == '1') {
        echo '<img src="', base_url('asset/img/block.png'), '" height="10px">';
      } else {
        echo "
        <a href='", base_url($link_edit) ,"' class='btn btn-info btn-xs'>edit</a>
        <a href='#myModal",$kandidat->id,"'  data-toggle='modal' class='btn btn-warning btn-xs'>hapus</a> ";
        echo 
          "<div id='myModal",$kandidat->id,"' class='modal fade' role='dialog'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Hapus.</h4>
                </div>
                <div class='modal-body'>
                  <p>Anda yakin akan menghapus akun ini?</p>
                </div>
                <div class='modal-footer'>        
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Tidak</button>
                  <a type='button' class='btn btn-default' href='", base_url($link_hapus),"'>Ya, lanjutkan!</a>
                </div>
              </div>
            </div>
          </div>";  
        }        
      }
    ?>
  </tbody>
</table>
<hr>
<?php if ($role == '1'): ?>
  
<?php else: ?>
	<div class="row">
		<div class="col-12">
      <a href="<?php echo base_url('kandidat/tambah_kandidat')?>" title="" class="btn btn-default">Tambah Kandidat</a>
			<a href="<?php echo base_url('jabatan')?>" title="" class="btn btn-default">Kelola Jabatan</a>
		</div>
		
	</div>
<?php endif ?>
  <hr>
</div>
</div>