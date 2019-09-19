<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="<?php echo base_url('pemilih')?>" title="">&lt; kembali ke Tabel Daftar Pemilih Tetap</a>
    </div>
  </div>
  <div class="page-header">
    <h1>Tambah.</h1>
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
  <p class="lead">Silakan masukkan data pemilih tetap yang ingin ditambahkan.</p>
  
  <div class="col-xs-4">
    <?php
    echo form_open('pemilih/tambah_pemilih'); ?>
    <?php echo form_input($id); ?>
    <br>
    <?php echo form_input($nama); ?>
    <br><label>Pilih daerah pemilihan:</label><br>
    <?php 
      $query = $this->db->select(array('kode_dapil','dapil'))->distinct()->get('jabatan')->result();
    foreach ($query as $q): ?>
      <input type="checkbox" name="dapil[]" value=<?php echo $q->kode_dapil; ?> <?php echo set_checkbox('dapil', $q->kode_dapil) ?>>
      <?php echo $q->dapil; ?><br>
    <?php endforeach ?>
    <br>
    <?php echo form_submit($submit); ?>
    
    <?php echo form_close(); ?>
    <br>
  </div>
  <hr>
  <p class="col-xs-12"><code>Perhatian!</code> Pastikan tidak memberikan password kepada siapapun.</p>
</div>