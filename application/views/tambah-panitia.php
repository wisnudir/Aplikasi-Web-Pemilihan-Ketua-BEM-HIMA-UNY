<div class="container">
    <div class="row">
    <div class="col-12">
      <a href="<?php echo base_url('panitia')?>" title="">&lt; kembali ke Tabel Admin</a>
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
    <p class="lead">Silakan masukkan data akun panitia yang ingin ditambahkan.</p>
    
    <div class="col-xs-4">
    	<?php
	    echo form_open('panitia/tambah_panitia'); ?>
	    <?php echo form_input($id); ?>
	    <br>
	    <?php echo form_input($password); ?>
	    <br>
      <?php echo form_input($nama); ?>
	    <br>	    
      <?php echo form_dropdown($role); ?>
      <br>
	    <?php echo form_submit($submit); ?>
	    
	    <?php echo form_close(); ?>
	    <br>
    </div>
    
  
  
  <hr>
  <p class="col-xs-12"><code>Perhatian!</code> Pastikan tidak memberikan password kepada siapapun.</p>
</div>	