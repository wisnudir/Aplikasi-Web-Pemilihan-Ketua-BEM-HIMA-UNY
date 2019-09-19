<div class="container">
    <div class="col-sm-5">
      <div class="page-header">
        <h1>Admin.</h1>
      </div>
      <?php
      if ($error or $error_validation) {
      echo "<div class='alert alert-danger'>
        <strong>Gagal! </strong>",
      $error, $error_validation,"</div>";
      }
      ?>
      <p class="lead">Silakan masukkan username dan password.</p>
      
      <?php
      echo form_open('admin/login'); ?>
      <?php echo form_input($id); ?>
      <br>
      <?php echo form_input($password); ?>
      <br>
      <?php echo form_submit($submit); ?>
      <?php echo form_close(); ?>
      <br>
      <hr>
      <p class="col-xs-12"><code>Perhatian!</code> Pastikan tidak memberikan password kepada siapapun.</p>
      
    </div>
    <div class="col-sm-7 hidden-xs">
      <br><br>
      <img src="<?php echo base_url('asset/img/admin-ilustrasi.svg')?>" alt="ikon verifikasi" height="300px" class="pull-right">
    </div>
</div>