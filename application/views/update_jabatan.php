<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="<?php echo base_url('jabatan')?>" title="">&lt; kembali ke Tabel Kelola Jabatan</a>
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
  
  <?php
  echo form_open('jabatan/update_jabatan/'.$id); ?>
  <label>Kode:</label>
  [<?php echo $data_jabatan->id; ?>]<br><br>
  <label>Kode Jabatan:</label>
  [<?php echo $data_jabatan->kode_jabatan; ?>]<br>
  <label>Nama Jabatan:</label>
  <?php echo form_input($jabatan); ?><br><br>
  <label>Kode Daerah Pemilihan (Dapil):</label>
  [<?php echo $data_jabatan->kode_dapil; ?>]<br>
  <label>Nama Daerah Pemilihan:</label>
  <?php echo form_input($dapil); ?>
  <br>
  <?php echo form_submit($submit); ?>
  
  <?php echo form_close(); ?>
  <br>
</div>