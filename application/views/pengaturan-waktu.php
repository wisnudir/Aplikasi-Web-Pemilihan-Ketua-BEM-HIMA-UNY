<div class="container">
  <div class="col-sm-4">
    <a href="<?php echo base_url('admin/pengaturan')?>" title="">&lt; kembali ke Pengaturan</a>
      <h1>Atur Waktu.</h1>
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
    echo form_open('admin/pengaturan_waktu/'); ?>
    <?php echo form_label('Tanggal voting dibuka').'<code class="pull-right">'.$tm_now.'</code>'; ?>
    <?php echo form_input($tanggal_mulai); ?><br>
    <?php echo form_label('Tanggal voting ditutup').'<code class="pull-right">'.$ta_now.'</code>'; ?>
    <?php echo form_input($tanggal_akhir); ?><br>
    <?php echo form_label('Tanggal penghitungan suara').'<code class="pull-right">'.$th_now.'</code>'; ?>
    <?php echo form_input($tanggal_hitung); ?><br>
    <?php echo form_label('Jam voting dibuka').'<code class="pull-right">'.$jb_now.'</code>'; ?>
    <?php echo form_input($jam_buka); ?><br>
    <?php echo form_label('Jam voting ditutup').'<code class="pull-right">'.$jt_now.'</code>'; ?>
    <?php echo form_input($jam_tutup); ?>
    <br>
    <?php echo form_submit($submit); ?>    
    <?php echo form_close(); ?>
    <br>
  </div> 
  
  <div class="col-xs-7">
    <img src="<?php echo base_url('asset/img/edit_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 100px" class="pull-right img-responsive">
  </div>
</div>