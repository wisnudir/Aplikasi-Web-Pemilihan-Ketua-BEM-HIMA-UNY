<nav class="navbar text-center" style="height: 100px; padding-top: 1%; background-color: #EA2027">
	<div class="col-sm-2 col-lg-4 hidden-xs">
		<a href="http://www.uny.ac.id/">
			<img width="60px" alt="Brand" src="<?php echo base_url('asset/img/uny.gif') ?>">
		</a>
	</div>
	<div class="col-sm-8 col-lg-4">
		<strong class="hidden-xs" style="color: white; font-size: 24pt">PEMILWA ONLINE</strong>
		<strong class="hidden-sm hidden-md hidden-lg hidden-xl" style="color: white; font-size: 18pt">PEMILWA ONLINE</strong>
		
		<p style="color: white">Fakultas Matematika dan Ilmu Pengetahuan Alam UNY</p>
	</div>
	<div class="col-sm-2 col-lg-4 hidden-xs pull-right">
		<a href="<?php echo base_url('') ?>">
			<img width="60px" alt="Brand" src="<?php echo base_url('asset/img/kpu.png') ?>">
		</a>
	</div>
</nav>
    <div class="container">
    	<div class="row">    		
            <div class="col-sm-2" >
            <a href="<?php echo base_url('admin/menu')?>" title="">&lt; kembali ke Menu Utama</a><br><br>    
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Panduan</b>
                    </div>
                    <div class="panel-body">                        
                        <a href="<?php echo base_url('admin/panduan/voting'); ?>">
                            <?php if (($this->uri->segment(3) == 'voting') OR ($this->uri->segment(3) == null)): ?>
                                <b>Voting</b>
                            <?php else: ?>
                                Voting
                            <?php endif ?>  
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/verifikasi'); ?>">
                            <?php if ($this->uri->segment(3) == 'verifikasi'): ?>
                                <b>Verifikasi</b>
                            <?php else: ?>
                                Verifikasi
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/pengaturan'); ?>">
                            <?php if ($this->uri->segment(3) == 'pengaturan'): ?>
                                <b>Pengaturan</b>
                            <?php else: ?>
                                Pengaturan
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/pemilih'); ?>">
                            <?php if ($this->uri->segment(3) == 'pemilih'): ?>
                                <b>Pemilih</b>
                            <?php else: ?>
                                Pemilih
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/kandidat'); ?>">
                            <?php if ($this->uri->segment(3) == 'kandidat'): ?>
                                <b>Kandidat</b>
                            <?php else: ?>
                                Kandidat
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/panitia'); ?>">
                            <?php if ($this->uri->segment(3) == 'panitia'): ?>
                                <b>Panitia</b>
                            <?php else: ?>
                                Panitia
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/suara'); ?>">
                            <?php if ($this->uri->segment(3) == 'suara'): ?>
                                <b>Suara</b>
                            <?php else: ?>
                                Suara
                            <?php endif ?> 
                        </a>
                        <br> <a href="<?php echo base_url('admin/panduan/statistik'); ?>">
                            <?php if ($this->uri->segment(3) == 'statistik'): ?>
                                <b>Statistik</b>
                            <?php else: ?>
                                Statistik
                            <?php endif ?> 
                        </a> 
                        <br> <a href="<?php echo base_url('admin/panduan/audit'); ?>">
                            <?php if ($this->uri->segment(3) == 'audit'): ?>
                                <b>Audit</b>
                            <?php else: ?>
                                Audit
                            <?php endif ?> 
                        </a> 
                    </div>
                </div>
            </div>