<div class="container">
    <div class="col-sm-5">
      <a href="<?php echo base_url('pemilih')?>" title="">&lt; kembali ke Tabel Pemilih Tetap</a>
      <h1>Update.</h1>
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
    <p class="lead">Silakan mengubah data pemilih tetap yang ingin diubah.</p>
    
    	<?php
	    echo form_open('pemilih/update_pemilih/'.$ids); ?>
	    <?php echo '<label>NIM: </label> ', $data_akun->id; ?>
      <br>
      <label>Nama:</label>
      <?php echo form_input($nama); ?>
      <br>
      <?php echo form_input($status); ?>
      <br>
      <label>Daerah pemilihan:</label><br>
      <?php 
        $dapil_pemilih = $this->db->select('dapil')->get_where('pemilih', array('id' => $data_akun->id))->row();
        $dap = explode(',', $dapil_pemilih->dapil);
        $query = $this->db->select(array('kode_dapil','dapil'))->distinct()->get('jabatan')->result();

        foreach ($query as $q) {
          if (in_array($q->kode_dapil, $dap)) {
            echo '<input type="checkbox" name="dapil[]" value="'.$q->kode_dapil.'" '.set_checkbox('dapil', $q->kode_dapil).' checked>';
            echo $q->dapil.'<br>';
          } else {
            echo '<input type="checkbox" name="dapil[]" value="'.$q->kode_dapil.'" '.set_checkbox('dapil', $q->kode_dapil).'>';
            echo $q->dapil.'<br>';
          }
          
          
        };
      ?>
      <br>
	    <?php echo form_submit($submit); ?>
	    
	    <?php echo form_close(); ?>
	    <br>
    </div>  
  <div class="col-sm-7 hidden-xs">
    <img src="<?php echo base_url('asset/img/edit_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 100px" class="pull-right img-responsive">
  </div>
  
</div>	