<p class="text-right">
	<a href="<?php echo base_url('admin/download') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/download/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Download <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="text" name="judul_download" class="form-control" value="<?php echo set_value('judul_download') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload File <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>" required>
		<small class="text-secondary">File yang diupload bisa berupa PDF, DOC, ZIP, atau lainnya.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-5">
		<select name="id_kategori_download" class="form-control">
			<?php foreach($kategori_download as $kategori_download) { ?>
			<option value="<?php echo $kategori_download->id_kategori_download ?>" <?php echo set_select('id_kategori_download', $kategori_download->id_kategori_download); ?>>
				<?php echo $kategori_download->nama_kategori_download ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_download" class="form-control">
			<option value="Download" <?php echo set_select('jenis_download', 'Download'); ?>>Download</option>
			<option value="Panduan" <?php echo set_select('jenis_download', 'Panduan'); ?>>Panduan</option>
			<option value="Member" <?php echo set_select('jenis_download', 'Member'); ?>>Member</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	<div class="col-md-2">
		<select name="status_download" class="form-control">
			<option value="Publish" <?php echo set_select('status_download', 'Publish'); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_download', 'Draft'); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status tampil</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Download</label>
	<div class="col-md-9">
		<!-- TEXTAREA INI MENGGUNAKAN CLASS 'konten' UNTUK SUMMERNOTE -->
		<textarea name="isi" class="form-control konten" placeholder="Deskripsi singkat file download"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website') ?>" placeholder="Misal: http://link-eksternal.com">
		<small class="text-secondary">URL eksternal jika file tidak diupload di server.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/download') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="reset" class="btn btn-secondary"><i class="fa fa-times"></i> Reset</button>
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
            placeholder: 'Deskripsi singkat file download',
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
