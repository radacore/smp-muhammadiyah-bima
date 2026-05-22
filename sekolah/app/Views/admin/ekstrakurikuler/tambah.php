<p class="text-right">
	<a href="<?php echo base_url('admin/ekstrakurikuler') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/ekstrakurikuler/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Judul Ekstrakurikuler <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<input type="text" name="judul_ekstrakurikuler" class="form-control" value="<?php echo set_value('judul_ekstrakurikuler') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Nama Penanggung Jawab <span class="text-danger">*</span></label>
	<div class="col-md-6">
		<input type="text" name="nama_penanggung_jawab" class="form-control" value="<?php echo set_value('nama_penanggung_jawab') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar Ekstrakurikuler</label>
	<div class="col-md-6">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
        <small class="text-secondary">Pilih gambar utama untuk ekstrakurikuler.</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-md-2">Kategori &amp; Status</label>
	<div class="col-md-2">
		<select name="id_kategori_ekstrakurikuler" class="form-control select2">
			<?php foreach($kategori_ekstrakurikuler as $kategori_ekstrakurikuler) { ?>
			<option value="<?php echo $kategori_ekstrakurikuler->id_kategori_ekstrakurikuler ?>" <?php echo set_select('id_kategori_ekstrakurikuler', $kategori_ekstrakurikuler->id_kategori_ekstrakurikuler); ?>>
				<?php echo $kategori_ekstrakurikuler->nama_kategori_ekstrakurikuler ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="status_ekstrakurikuler" class="form-control">
			<option value="Publish" <?php echo set_select('status_ekstrakurikuler', 'Publish', true); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_ekstrakurikuler', 'Draft'); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Tampil</small>
	</div>
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya" <?php echo set_select('status_text', 'Ya', true); ?>>Aktif</option>
			<option value="Tidak" <?php echo set_select('status_text', 'Tidak'); ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Isi Ekstrakurikuler</label>
	<div class="col-md-10">
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-media">
			<i class="fa fa-plus-circle"></i> Upload &amp; Kelola Media/File
		</button>
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-galeri">
			<i class="fa fa-image"></i> Lihat Galeri
		</button>
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-download">
			<i class="fa fa-download"></i> Lihat File
		</button>
		<textarea name="isi" class="form-control konten" placeholder="Deskripsi dan detail ekstrakurikuler"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Text untuk tombol link (Opsional)</label>
	<div class="col-md-10">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Link/URL untuk Banner (Opsional)</label>
	<div class="col-md-10">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website') ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<a href="<?php echo base_url('admin/ekstrakurikuler') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>
<?php 
echo view('admin/berita/media');
echo view('admin/berita/download');
echo view('admin/berita/galeri');
?>

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
            placeholder: 'Masukkan Deskripsi dan Detail Ekstrakurikuler di sini',
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
