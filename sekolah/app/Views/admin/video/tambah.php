<p class="text-right">
	<a href="<?php echo base_url('admin/video') ?>" class="btn btn-outline-info btn-sm">
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
echo validation_list_errors();
?>

<h3>Formulir Tambah Video Baru</h3>
<hr>

<form action="<?php echo base_url('admin/video/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-3">Judul Video <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="judul" class="form-control" placeholder="Judul Video" value="<?php echo set_value('judul') ?>" required>
		<small class="text-secondary">Judul Video</small>
	</div>
	
</div>

<div class="form-group row">
	<label class="col-3">Kode Video Youtube <span class="text-danger">*</span></label>
	<div class="col-9">
		
			<input type="text" name="video" class="form-control" placeholder="Kode video youtube (Contoh: cxLeZXObWDA)" value="<?php echo set_value('video') ?>" required>
			
		<small class="text-secondary">Hanya kode unik dari URL Youtube yang diperlukan. Misal: dari `https://youtu.be/cxLeZXObWDA?si=...` cukup masukkan `cxLeZXObWDA`.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Gambar Thumbnail &amp; Status</label>
	
	<div class="col-3">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar Thumbnail" value="<?php echo set_value('gambar') ?>">
		<small class="text-secondary">Gambar Thumbnail Video. Format: JPG, JPEG, PNG, GIF</small>
	</div>
	<div class="col-3">
		<select name="status_video" class="form-control">
			<option value="Publish" <?php echo set_select('status_video', 'Publish'); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_video', 'Draft'); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Video</small>
	</div>
	<div class="col-3">
		<select name="posisi_video" class="form-control">
			<option value="Beranda" <?php echo set_select('posisi_video', 'Beranda'); ?>>Beranda</option>
			<option value="Video" <?php echo set_select('posisi_video', 'Video'); ?>>Galeri Video</option>
		</select>
		<small class="text-secondary">Posisi Video</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<!-- Diberi class 'konten' untuk Summernote -->
		<textarea name="keterangan" placeholder="Keterangan dan Deskripsi Video" class="form-control konten"><?php echo set_value('keterangan') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Urutan</label>
	<div class="col-9">
		<input type="number" name="urutan" class="form-control" placeholder="Nomor urut tampil" value="<?php echo set_value('urutan', 0) ?>">
		<small class="text-secondary">Urutan tampilan video (angka yang lebih kecil tampil lebih dulu)</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/video/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Video</button>
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
            placeholder: 'Masukkan Keterangan Video di sini',
            tabsize: 2,
            height: 200, 
            toolbar: [
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
