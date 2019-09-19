<div class="container">
	<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="<?php echo base_url('kandidat')?>" title="">&lt; kembali ke Tabel Kandidat</a>
		</div>
	</div>
	<h2>Kelola Jabatan</h2>
      <?php 
      if ($sukses) {
        echo "<div class='alert alert-success'>
        <strong>Sukses! </strong>",     
         $sukses,"</div>";
      }
      elseif ($error or $error_validation) {
        echo "<div class='alert alert-danger'>
        <strong>Gagal! </strong>",      
         $error,$error_validation,"</div>";
      }
     ?> 
	<table class="table table-hover table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Kode Jabatan</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Kode Dapil</th>
      <th scope="col">Dapil</th>
      <th scope="col">Kontrol</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      if ($data_jabatan == null) {
        echo "<div class='alert alert-warning'>
        <strong>Maaf, </strong> tidak ada data ditemukan.</div>";
      }

      foreach ($data_jabatan as $jbtn) {
        $kode_id = $this->pemilwa_library->encode_url($jbtn->id);
        $link_edit = 'jabatan/update_jabatan/'.$kode_id;
        $link_hapus = 'jabatan/hapus_jabatan/'.$kode_id;

        echo "<tr>
      <td class='col-sm-1'>",$jbtn->id,"</td>
      <td class='col-sm-1'>", $jbtn->kode_jabatan,"</td>
      <td class='col-sm-3'>",$jbtn->jabatan,"</td>
      <td class='col-sm-1'>", $jbtn->kode_dapil,"</td>
      <td class='col-sm-3'>", $jbtn->dapil,"</td>
      <td>
        <a href='", base_url($link_edit) ,"' class='btn btn-info btn-xs'>edit</a>
        <a href='#myModal",$jbtn->id,"'  data-toggle='modal' class='btn btn-warning btn-xs'>hapus</a> ";
        echo 
          "<div id='myModal",$jbtn->id,"' class='modal fade' role='dialog'>
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
    ?>
  </tbody>
</table>
	<div class="row">
    <div class="col-xs-6">
    <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Tambah Jabatan Baru </button>
    <div class="collapse" id="collapseExample">
      <div class="well">        
        <?php
        echo form_open('jabatan/jabatan'); ?>
        <label>Jabatan:</label>
        <?php echo form_input($kode_jabatan); ?>
        <?php echo form_input($jabatan); ?>
        <label>Daerah Pemilihan:</label>
        <?php echo form_input($kode_dapil); ?>
        <?php echo form_input($dapil); ?>
        <br>
        <?php echo form_submit($submit); ?>
        
        <?php echo form_close(); ?>
        <br>
      </div>
      <br>
    </div>
    </div>		
	</div>
  <hr>
</div>
</div>