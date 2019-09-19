<div class="container">
  <div class="col-sm-5">
    <a href="<?php echo base_url('kandidat/update_kandidat/'.$ids)?>" title="">&lt; kembali ke Edit Kandidat</a>
    <div >
      <h1>Ganti Foto.</h1>
    </div>
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
    <p class="lead">Silakan upload foto baru.</p>
    <img src="<?php echo base_url('asset/upload/img/'.$data_kandidat->pict) ?>" style="height: auto; width: 200px;"><br>
    <br>
    <small><code>Perhatian</code> Foto harus berukuran 300x300 px <br>File yang diizinkan png/jpg/jpeg/svg</small>
    <?php
    echo form_open_multipart('kandidat/upload_foto/'.$ids); ?>
    <br>
    <?php echo form_upload($foto); ?>
    <br>
    <?php echo form_submit($submit); ?>
    
    <?php echo form_close(); ?>
    <hr>
  </div>
  
  
  
  <div class="col-sm-7 hidden-xs">
    <img src="<?php echo base_url('asset/img/edit_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 100px" class="pull-right img-responsive">
  </div>
</div>