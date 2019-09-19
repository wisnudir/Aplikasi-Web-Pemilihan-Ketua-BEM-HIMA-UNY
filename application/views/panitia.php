<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a>
		</div>
	</div>
	<h2>Daftar Panitia KPU FMIPA</h2>

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
      <th scope="col">Username</th>
      <th scope="col">Nama</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Status</th>
      <th scope="col">Kontrol</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach ($data_panitia as $panitia) {
        $kode_id = $this->pemilwa_library->encode_url($panitia->id);
        $link_edit = 'panitia/update_panitia/'.$kode_id;
        $link_hapus = 'panitia/hapus_panitia/'.$kode_id;
        $link_blokir = 'panitia/blokir_panitia/'.$kode_id;
        $link_unblokir = 'panitia/unblokir_panitia/'.$kode_id;

        switch ($panitia->role) {
          case '0':
            $role = '<b class="text-danger">Admin</b>';
            break;
          case '1':
            $role = '<b class="text-warning">Ketua KPU</b>';
            break;
          case '2':
            $role = '<b class="text-info">Tim Verifikasi</b>';
            break;
        }

        switch ($panitia->status) {
          case '0':
            $status = '<b class="text-warning">Tidak Aktif</b>';
            break;
          case '1':
            $status = '<b class="text-success">Aktif</b>';
            break;
        }

      echo "<tr>
      <td scope='row'>", $panitia->id,"</td>
      <td>",$panitia->nama,"</td>
      <td class='col-xs-2'>",$role,"</td>
      <td class='col-xs-1'>",$status,"</td>
      <td>";
      if ($roles !== '0') {
        echo '<img src="', base_url('asset/img/block.png'), '" height="10px">';
      } else {
        echo "
        <a href='", base_url($link_edit) ,"' class='btn btn-info btn-xs'>edit</a>
        <a href='#myModal",$panitia->id,"'  data-toggle='modal' class='btn btn-warning btn-xs'>hapus</a> ";
        if ($panitia->status) {
          echo "<a href='", base_url($link_blokir) ,"' class='btn btn-danger btn-xs'>non-aktifkan</a></td></tr>";
        } else {
          echo "<a href='", base_url($link_unblokir) ,"' class='btn btn-success btn-xs'>aktifkan</a></td></tr>";
        }
        echo 
          "<div id='myModal",$panitia->id,"' class='modal fade' role='dialog'>
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
<?php if ($roles !== '0'): ?>
  
<?php else: ?>
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('panitia/tambah_panitia')?>" title="" class="btn btn-default">+ Tambah</a>
		</div>
		
	</div>
<?php endif ?>
  <hr>
</div>