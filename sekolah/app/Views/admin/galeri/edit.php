<p class="text-right">
	<a href="<?php echo base_url('admin/galeri') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php 
// Tampilkan pesan error/sukses
if (session()->getFlashdata('sukses')) {
    echo '<div class="alert alert-success">' . session()->getFlashdata('sukses') . '</div>';
}
if (session()->getFlashdata('error')) {
    echo '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>';
}
// Asumsi validation_list_errors() bekerja untuk menampilkan error validasi
echo validation_list_errors();
?>

<form action="<?php echo base_url('admin/galeri/edit/'.$galeri->id_galeri) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Galeri <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="text" name="judul_galeri" class="form-control" value="<?php echo set_value('judul_galeri', $galeri->judul_galeri) ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Galeri</label>
	<div class="col-md-7">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>" accept="image/*">
		<small class="text-secondary">Pilih file gambar baru jika ingin mengganti.</small>
	</div>
	<div class="col-md-2">
		<?php if(!empty($galeri->gambar)) { ?>
			<!-- Menggunakan set_value('gambar') di sini kurang tepat karena ini adalah file, jadi kita hanya menampilkan gambar yang sudah ada -->
			<img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri->gambar) ?>" class="img img-thumbnail" style="max-height: 100px; width: auto;" alt="Gambar Saat Ini">
		<?php } else { ?>
			<div class="text-secondary">Tidak ada gambar</div>
		<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_galeri" class="form-control">
			<?php foreach($kategori_galeri as $kategori_galeri) { ?>
			<option value="<?php echo $kategori_galeri->id_kategori_galeri ?>" 
				<?php echo set_select('id_kategori_galeri', $kategori_galeri->id_kategori_galeri, ($galeri->id_kategori_galeri==$kategori_galeri->id_kategori_galeri)); ?>>
				<?php echo $kategori_galeri->nama_kategori_galeri ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-3">
		<select name="jenis_galeri" class="form-control">
			<?php 
			$jenis_options = ['Galeri', 'Homepage', 'Header', 'Pop Up'];
			foreach ($jenis_options as $jenis) {
				echo '<option value="' . $jenis . '" ' . set_select('jenis_galeri', $jenis, ($galeri->jenis_galeri==$jenis)) . '>';
				echo ($jenis == 'Homepage' ? 'Homepage Slider' : ($jenis == 'Header' ? 'Header Halaman' : ($jenis == 'Pop Up' ? 'Pop Up Homepage' : $jenis)));
				echo '</option>';
			}
			?>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	
	<div class="col-md-3">
		<select name="status_text" class="form-control">
			<option value="Ya" <?php echo set_select('status_text', 'Ya', ($galeri->status_text=="Ya")); ?>>Aktif</option>
			<option value="Tidak" <?php echo set_select('status_text', 'Tidak', ($galeri->status_text=="Tidak")); ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Galeri</label>
	<div class="col-md-9">
		<!-- TEXTAREA INI MENGGUNAKAN CLASS 'konten' UNTUK SUMMERNOTE -->
		<textarea name="isi" class="form-control konten" placeholder="Teks lengkap atau deskripsi untuk galeri/slider"><?php echo set_value('isi', $galeri->isi) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website', $galeri->text_website) ?>" placeholder="Contoh: Selengkapnya">
		<small class="text-secondary">Teks tombol tautan (Opsional).</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website', $galeri->website) ?>" placeholder="Contoh: <?php echo base_url('berita') ?>">
		<small class="text-secondary">URL tujuan ketika tombol diklik (Opsional).</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/galeri') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>

<!-- ============================================= -->
<!-- INTEGRASI SUMMERNOTE LITE -->
<!-- ============================================= -->
<!-- CDN ini harus dimuat hanya sekali di footer/layout utama. -->

<!-- Tailwind CSS (dimasukkan sesuai permintaan) -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Bootstrap CSS (Diperlukan oleh Summernote) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
<!-- jQuery (Diperlukan oleh Summernote) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Summernote CDN -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Summernote pada textarea dengan class 'konten'
        $('.konten').summernote({
            placeholder: 'Teks lengkap atau deskripsi untuk galeri/slider',
            tabsize: 2,
            height: 300,
            toolbar: [
                // Toolbar yang disarankan untuk Summernote Lite
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'hr', 'picture']], 
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
