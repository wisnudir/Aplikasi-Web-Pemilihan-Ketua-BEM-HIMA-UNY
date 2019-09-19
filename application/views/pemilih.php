<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('admin/menu')?>">&lt; kembali ke Menu Utama</a>
		</div>
	</div>  
	<h2>
  <?php if (is_null($search_mode)) {
    echo "Daftar Pemilih Tetap </h2>";
  } else {
    echo 'Hasil Pencarian: <i>'.$kata_kunci.'</i> </h2>';
    echo "<a href=".base_url('pemilih').">&lt; kembali ke Daftar Pemilih Tetap</a>";
  } ?>

    <?php 
      if ($sukses) {        
         if (is_array($sukses)) {
           foreach ($sukses as $sk) {
              echo "<div class='alert alert-success'>
              <strong>Sukses! </strong> NIM ",      
               $sk," telah berhasil ditambahkan.</div>";
            }
         } else {
           echo "<div class='alert alert-success'>
          <strong>Sukses! </strong>",     
           $sukses,"</div>";
         }
         
      }
      if ($error) {
        if (is_array($error)) {
            foreach ($error as $er) {
              echo "<div class='alert alert-warning'>
              <strong>Gagal! </strong> NIM ",      
               $dp," gagal ditambahkan.</div>";
            }
        } else {          
          echo "<div class='alert alert-danger'>
          <strong>Gagal! </strong>",      
           $error, $error_validation,"</div>";
        }
        
      }
      if ($error_validation) {
        echo "<div class='alert alert-danger'>
        <strong>Gagal! </strong>",      
         $error, $error_validation,"</div>";
      }
      if ($duplikat) {        
          echo "<div class='alert alert-warning'>
          <strong>Gagal! </strong> NIM terindikasi duplikasi:</div><br>";
        foreach ($duplikat as $dp) {
          echo $dp,"<br>";
        }
      }
     ?> 
<hr>
    <?php if (is_null($search_mode)): ?>
     <span class="pull-right">
      Filter Jurusan: 
     <a href="<?php echo base_url('pemilih/show/id/MAT'); ?>">MAT</a>
     <a href="<?php echo base_url('pemilih/show/id/FIS'); ?>">FIS</a>
     <a href="<?php echo base_url('pemilih/show/id/BIO'); ?>">BIO</a>
     <a href="<?php echo base_url('pemilih/show/id/KIM'); ?>">KIM</a>
     <a href="<?php echo base_url('pemilih/show/id/IPA'); ?>">IPA</a>
    </span>
    <?php endif ?>
      Total data ditemukan <?php echo $count; ?>
	<table class="table table-hover table-striped">
  <thead>
    <?php if (is_null($search_mode)): ?>
    <tr>
      <th scope="col">NIM <a href="<?php echo base_url('pemilih/show/id') ?>">^</a></th>
      <th scope="col">Nama <a href="<?php echo base_url('pemilih/show/nama') ?>">^</a></th>
      <th scope="col">Dapil <a href="<?php echo base_url('pemilih/show/dapil') ?>">^</a></th>
      <th scope="col">Status <a href="<?php echo base_url('pemilih/show/status') ?>">^</a></th>
      <th scope="col">Kontrol</th>
    </tr>
    <?php else: ?>
    <tr>
      <th scope="col">NIM </th>
      <th scope="col">Nama </th>
      <th scope="col">Dapil </th>
      <th scope="col">Status </th>
      <th scope="col">Kontrol</th>
    </tr>
    <?php endif ?>
  </thead>
  <tbody>
    <?php 
      if ($data_pemilih == null) {
        echo "<div class='alert alert-warning'>
        <strong>Warning! </strong> Tidak ada data.</div>";
      }
      foreach ($data_pemilih as $pemilih) {
        $kode_id = $this->pemilwa_library->encode_url($pemilih->id);
        $link_edit = 'pemilih/update_pemilih/'.$kode_id;
        $link_hapus = 'pemilih/hapus_pemilih/'.$kode_id;
        $link_blokir = 'pemilih/blokir_pemilih/'.$kode_id;
        $link_unblokir = 'pemilih/unblokir_pemilih/'.$kode_id;
        $dap = explode(',', $pemilih->dapil);
        $view_dapil = null;
        foreach ($dap as $d) {
          $query = $this->db->select('dapil')->get_where('jabatan', array('kode_dapil' => $d ))->row();
          if ($view_dapil == null) {
            $view_dapil = $query->dapil;
          } else {
            $view_dapil = $view_dapil.', '.$query->dapil;
          }         
        }
        switch ($pemilih->status) {
          case '0':
            $status = '<b class="text-warning">Belum Verifikasi</b>';
            break;
          case '1':
            $status = '<b class="text-info">Sudah Verifikasi, Belum Memilih</b>';
            break;
          case '2':
            $status = '<b class="text-success">Sudah Memilih</b>';
            break;
          case '3':
            $status = '<b class="text-danger">Diblokir</b>';
            break;
        }
        echo "<tr>
      <td scope='row'>", $pemilih->id,"</td>
      <td>",$pemilih->nama,"</td>
      <td>", $view_dapil,"</td>
      <td>",$status,"</td>
      <td>";
      if ($role == '1') {
        echo '<img src="', base_url('asset/img/block.png'), '" height="10px">';
      } else {
        echo "
        <a href='", base_url($link_edit) ,"' class='btn btn-info btn-xs'>edit</a>
        <a href='#myModal",$pemilih->id,"'  data-toggle='modal' class='btn btn-warning btn-xs'>hapus</a> ";
        if ($pemilih->status !== '3') {
          echo "<a href='", base_url($link_blokir) ,"' class='btn btn-danger btn-xs'>blokir</a></td></tr>";
        } else {
          echo "<a href='", base_url($link_unblokir) ,"' class='btn btn-success btn-xs'>aktifkan</a></td></tr>";
        }
        echo 
          "<div id='myModal",$pemilih->id,"' class='modal fade' role='dialog'>
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
<?php if (is_null($search_mode)): ?>
<p class="text-center"><?php echo $pag_link; ?></p>
<hr>
  <?php if ($role == '1'): ?>
  
<?php else: ?>
	<div class="row">
      <div class="col-sm-3">        
        <label> Tambah satu pemilih:</label><br>
        <a href="<?php echo base_url('pemilih/tambah_pemilih')?>" title="" class="btn btn-default">+ Tambah</a>
      </div>
      <div class="col-sm-5">
        <label> Tambah banyak pemilih dengan Ms.Exel file:</label><br>
        <?php 
        echo form_open_multipart('pemilih/upload_exel_pemiilih', array('class'=>'form-inline'));
        echo form_upload($exel);
        echo form_submit($submit);
        echo form_close();
        ?>
      </div> 		
      <div class="col-sm-4">
        <label> Cari data:</label><br>
       <?php
        $attributes = array('class'=>'form-inline center-block');
        echo form_open('pemilih/show', $attributes); ?>
        <?php echo form_input($key); ?>
        <?php echo form_submit($search); ?>     
        <?php echo form_close(); ?> 
      </div>
	</div>
<?php endif ?>
<?php endif ?>

  <hr>
</div>