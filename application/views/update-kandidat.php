<div class="container">
  <div class="col-sm-5">
    <a href="<?php echo base_url('kandidat')?>" title="">&lt; kembali ke Tabel Kandidat</a>
    <div >
      <h1>Update.</h1>
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
    <p class="lead">Silakan ubah data kandidat yang ingin diubah.</p>
    <img src="<?php echo base_url('asset/upload/img/'.$data_kandidat->pict) ?>" style="height: auto; width: 100px;"><br>
    <a style="width: 100px" class="btn btn-info btn-xs" href="<?php echo base_url('kandidat/update_foto/'.$ids) ?>">Ganti Foto</a>
    <br><br>
    <?php
    echo form_open('kandidat/update_kandidat/'.$ids); ?>
    <label>Jabatan:</label>
    <?php echo form_dropdown($jabatan);
    ?>
    <label>Nomor Urut:</label>
    <?php echo form_input($no_urut); ?>
    <label>Nama:</label>
    <?php echo form_input($nama1); ?>
    <label>Nama Pasangan: <i>(optional)</i></label>
    <?php echo form_input($nama2); ?>
    <br>
    <?php echo form_submit($submit); ?>
    
    <?php echo form_close(); ?>
    <hr>
  </div>
  
  
  
  <div class="col-sm-7 hidden-xs">
    <img src="<?php echo base_url('asset/img/edit_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 100px" class="pull-right img-responsive">
  </div>
</div>