<p class="text-right">
	<a href="<?php echo base_url('admin/portfolio') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/portfolio/edit/'.$portfolio->id_portfolio) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Portfolio <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="text" name="judul_portfolio" class="form-control" value="<?php echo set_value('judul_portfolio', $portfolio->judul_portfolio) ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Portfolio</label>
	<div class="col-md-8">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
		<small class="text-secondary">Biarkan kosong jika tidak ingin mengganti gambar.</small>
	</div>
	<div class="col-md-1">
		<img src="<?php echo base_url('assets/upload/image/thumbs/'.$portfolio->gambar) ?>" class="img img-thumbnail" alt="Gambar saat ini">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-3">
		<select name="id_kategori_portfolio" class="form-control">
			<?php foreach($kategori_portfolio as $kategori_portfolio) { ?>
			<option value="<?php echo $kategori_portfolio->id_kategori_portfolio ?>" <?php if($portfolio->id_kategori_portfolio==$kategori_portfolio->id_kategori_portfolio) { echo 'selected'; } ?>>
				<?php echo $kategori_portfolio->nama_kategori_portfolio ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_portfolio" class="form-control">
			<option value="Portfolio" <?php if($portfolio->jenis_portfolio=="Portfolio") { echo 'selected'; } ?>>Portfolio</option>
			<option value="Homepage" <?php if($portfolio->jenis_portfolio=="Homepage") { echo 'selected'; } ?>>Homepage Slider</option>
			<option value="Header" <?php if($portfolio->jenis_portfolio=="Header") { echo 'selected'; } ?>>Header Halaman</option>
			<option value="Pop Up" <?php if($portfolio->jenis_portfolio=="Pop Up") { echo 'selected'; } ?>>Pop Up Homepage</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya" <?php if($portfolio->status_text=="Ya") { echo 'selected'; } ?>>Aktif</option>
			<option value="Tidak" <?php if($portfolio->status_text=="Tidak") { echo 'selected'; } ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
	<div class="col-md-2">
		<select name="status_portfolio" class="form-control">
			<option value="Publish" <?php if($portfolio->status_portfolio=="Publish") { echo 'selected'; } ?>>Publish</option>
			<option value="Draft" <?php if($portfolio->status_portfolio=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Tampil</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Portfolio</label>
	<div class="col-md-9">
		<!-- Diberi class 'konten' untuk Summernote -->
		<textarea name="isi" class="form-control konten" placeholder="Isi detail portfolio"><?php echo set_value('isi', $portfolio->isi) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website', $portfolio->text_website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website', $portfolio->website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/portfolio') ?>" class="btn btn-outline-info">
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
            placeholder: 'Masukkan Isi Detail Portfolio di sini',
            tabsize: 2,
            height: 300, 
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
