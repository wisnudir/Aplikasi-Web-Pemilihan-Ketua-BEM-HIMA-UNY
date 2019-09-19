<div class="container">
  <div class="col-sm-5">
    <a href="<?php echo base_url('panitia')?>" title="">&lt; kembali ke Tabel Panitia</a>
      <h1>Edit.</h1>
    <?php
      if ($sukses) {
        echo "<div class='alert alert-success'>
                  <strong>Sukses! </strong>",
        $sukses,"</div>";
      }
      elseif ($error or $error_validation) {
        echo "<div class='alert alert-danger'>
                  <strong>Gagal! </strong>",
        $error, $error_validation,"</div>";
      }
    ?>
    
    <?php
    echo form_open('panitia/update_panitia/'.$ids); ?>
    <b><?php echo 'Username: ', $id; ?></b><br>
    <br>
    <label>Password:</label>
    <?php echo form_input($password); ?>
    <small><code>Note: </code>Isi password lama jika tidak ingin mengganti passwordnya.</small>
    <br><br>
    <label>Nama:</label>
    <?php echo form_input($nama); ?>
    <label>Jabatan:</label>
    <?php echo form_dropdown($role); ?>
    <label>Status Akun:</label>
    <?php echo form_dropdown($status); ?>
    <br>
    <?php echo form_submit($submit); ?>
    
    <?php echo form_close(); ?>
    <br>
  </div>
  
  
  
  <div class="col-sm-7 hidden-xs">
    <img src="<?php echo base_url('asset/img/edit_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 100px" class="pull-right img-responsive">
  </div>
</div>