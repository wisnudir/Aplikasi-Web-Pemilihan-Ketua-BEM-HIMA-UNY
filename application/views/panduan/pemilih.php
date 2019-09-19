<div class="col-sm-10">
	<h1>Kelola Pemilih</h1>

	<h3>Kondisi Awal</h3>
	<p>Akun telah login sebagai admin, tin verifikasi, atau ketua KPU.</p>

	<h3>Alur Kerja</h3>
	<p>Untuk mengelola data pemilih silakan ikuti langkah-langkah dibawah ini:</p>
	<ol type="A">
		<li>Lihat data pemilih</li>
		<ol type="1">
			<li>Klik <code>Data Pemilih</code> pada menu utama</li>
			<li>Sistem akan menampilkan seluruh data pemilih</li>
		</ol>
		<li>Tambah data pemilih</li>
		<ol type="1">
			<li>Klik <code>Data Pemilih</code> pada menu utama.</li>
			<li>Sistem akan menampilkan seluruh data pemilih</li>
			<li>Klik tombol <code>+Tambah</code> atau <code>Upload</code> yang berada dibawah data pemilih untuk menambah data</li>
			<ol type="a">
				<li>Menambahkan satu data pemilih</li>
				<ol type="i">
					<li>Klik tombol <code>+Tambah</code></li>
					<li>Isi data pemilih pada <code>formulir</code> yang disediakan</li>
					<li>Klik <code>Tambah</code> untuk menambahkan data.</li>
				</ol>
				<li>Menambahkan banyak data pemilih</li>
				<ol type="i">
					<li>Siapkan data pemilih dalam format <code>Exel</code> dengan format isi sesuai dengan template yang disediakan di dalam panduan</li>
					<li>Klik <code>Pilih File</code> dan pilih file data pemilih dari direktori.</li>
					<li>Klik tombol <code>Upload</code> untuk menambahkan data.</li>
				</ol>
			</ol>			
			<img src="<?php echo base_url('asset/img/panduan-pemilih-1.png'); ?>" height="200px">
			<br><br>
		</ol>
		<li>Hapus data pemilih</li>
		<ol type="1">
			<li>Klik <code>Data Pemilih</code> pada menu utama.</li>
			<li>Sistem akan menampilkan data pemilih.</li>
			<li>Klik tombol <code>hapus</code> pada kolom kontrol untuk menghapus salah satu data.</li>
		</ol>
		<li>Ubah data pemilih</li>
		<ol type="1">
			<li>Klik <code>Data Pemilih</code> pada menu utama.</li>
			<li>Sistem akan menampilkan data pemilih.</li>
			<li>Klik tombol <code>edit</code> pada kolom kontrol untuk mengedit salah satu data.</li>
			<li>Ubah data pemilih pada <code>formulir</code> yang disediakan</li>
			<li>Klik <code>simpan</code> untuk menyimpan data</li>
		</ol>
	</ol>
		<br>
		<div class="alert alert-info">
			<h4>Panduan file Ms. Exel</h4>
			<p class="alert alert-danger">File yang bisa terbaca sistem hanya file yg disimpan dari software <b>Microsoft Exel 2007 keatas</b>. Software lain yang serupa (seperti WPS Spreadsheet atau yang serupa lainnya) tidak dipastikan bisa terbaca, dan berpotensi menimbulkan <b>error</b>.</p><br>
			<p>Isi cell pada kolom dapil wajib dipisahkan dengan <b>tanda koma (,) dan tanpa spasi</b>, sebagai contoh:<br>
				<ul>
					<li>Kode dapil yang tersedia adalah FAK, MAT, BIO, KIM, FIS, dan IPA.</li>
					<li>Akan menambahkan mahasiswa berjurusan Pendidikan Kimia.</li>
					<li>Maka isi cell pada kolom dapil adalah <b>FAK,KIM</b> (dipisahkan koma dan tanpa spasi),<br>
						karena mahasiswa tersebut termasuk dalam dapil Fakultas MIPA dan Jurusan Kimia.
					</li>
				</ul>
			</p><hr>
			<b>Template</b> file Ms. Exel diunduh disini: <a href="<?php echo base_url('asset/upload/tambah_pemilih_template.xlsx') ?>"><b>tambah_pemilih_template.xlsx</b></a><br>
		</div>

	<h3>Pengecualian</h3>
	<p>
		Ketua KPU terbatas hanya bisa melihat data pemilih. <br>
		Fungsi ini bisa diakses admin, ketua KPU, tim verifikasi.
	</p>
	<hr>
</div>
</div>
</div>