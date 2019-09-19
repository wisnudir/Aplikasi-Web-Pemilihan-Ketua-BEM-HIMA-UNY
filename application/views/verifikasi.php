<div class="container">	
	<div class="col-lg-12 text-center">
		<a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a><br>	
	    <?php
	      if ($sukses) {
	        echo "<div class='alert alert-info alert-dismissible' role='alert'>
	                  <strong>Sukses! </strong>",
	        $sukses,"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	      }
	      elseif ($error or $error_validation) {
	        echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	                  <strong>Gagal! </strong>", $error, $error_validation,"</div>";
	      }
	    ?>
		<h1>Verifikasi.</h1>
		Silakan ketik NIM atau scan KTM pemilih yang akan diverifikasi:<hr>
		<?php
		$attributes = array('class'=>'form-inline');
	    echo form_open('admin/verifikasi/', $attributes); ?>
	    <?php echo form_input($nim); ?>
	    <?php echo form_submit($submit); ?>	    
	    <?php echo form_close(); ?>
		<script>
			nimToVerif.onblur = function () {
				nimToVerif.focus();
			}
		</script>
		<img src="<?php echo base_url('asset/img/verif_ilustrasi.png')?>" alt="ikon verifikasi" style="max-width: 300px; padding-top: 20px; padding-bottom: 20px; " class="img-responsive center-block">
		<p><code>Perhatian!</code> <i>Jika menggunakan scanner tidak perlu menekan tombol verifikasi.</i></p>
	</div>
</div>