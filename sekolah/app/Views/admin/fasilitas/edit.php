<p class="text-right">
	<a href="<?php echo base_url('admin/fasilitas') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/fasilitas/edit/'.$fasilitas->id_fasilitas) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul/Nama Fasilitas <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="text" name="judul_fasilitas" class="form-control" value="<?php echo set_value('judul_fasilitas', $fasilitas->judul_fasilitas) ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kode/Nomor Fasilitas</label>
	<div class="col-md-6">
		<input type="text" name="kode_nomor_fasilitas" class="form-control" value="<?php echo set_value('kode_nomor_fasilitas', $fasilitas->kode_nomor_fasilitas) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Fasilitas</label>
	<div class="col-md-5">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
		<small class="text-secondary">Biarkan kosong jika tidak ingin mengganti gambar.</small>
	</div>
	<div class="col-md-1">
		<img src="<?php echo base_url('assets/upload/image/thumbs/'.$fasilitas->gambar) ?>" class="img img-thumbnail" alt="Gambar Fasilitas">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kondisi, Tahun &amp; Tanggal</label>
	<div class="col-md-2">
		<select name="kondisi_fasilitas" class="form-control">
			<option value="Baik" <?php if($fasilitas->kondisi_fasilitas=="Baik") { echo 'selected'; } ?>>Baik</option>
			<option value="Rusak" <?php if($fasilitas->kondisi_fasilitas=="Rusak") { echo 'selected'; } ?>>Rusak</option>
			<option value="Hilang" <?php if($fasilitas->kondisi_fasilitas=="Hilang") { echo 'selected'; } ?>>Hilang</option>
		</select>
		<small class="text-secondary">Kondisi Fasilitas</small>
	</div>
	<div class="col-md-2">
		<input type="number" name="tahun_fasilitas" class="form-control" value="<?php echo set_value('tahun_fasilitas', $fasilitas->tahun_fasilitas) ?>">
		<small class="text-secondary">Tahun Fasilitas</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="tanggal_fasilitas" class="form-control tanggal" value="<?php echo set_value('tanggal_fasilitas', $this->website->tanggal_id($fasilitas->tanggal_fasilitas)) ?>">
		<small class="text-secondary">Tanggal Fasilitas</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori &amp; Status</label>
	<div class="col-md-4">
		<select name="id_kategori_fasilitas" class="form-control select2">
			<?php foreach($kategori_fasilitas as $kategori_fasilitas) { ?>
			<option value="<?php echo $kategori_fasilitas->id_kategori_fasilitas ?>" <?php if($fasilitas->id_kategori_fasilitas==$kategori_fasilitas->id_kategori_fasilitas) { echo 'selected'; } ?>>
				<?php echo $kategori_fasilitas->nama_kategori_fasilitas ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	<div class="col-md-2">
		<select name="status_fasilitas" class="form-control">
			<option value="Publish" <?php if($fasilitas->status_fasilitas=="Publish") { echo 'selected'; } ?>>Publish</option>
			<option value="Draft" <?php if($fasilitas->status_fasilitas=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Tampil</small>
	</div>
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya" <?php if($fasilitas->status_text=="Ya") { echo 'selected'; } ?>>Aktif</option>
			<option value="Tidak" <?php if($fasilitas->status_text=="Tidak") { echo 'selected'; } ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Fasilitas</label>
	<div class="col-md-9">
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-media">
			<i class="fa fa-plus-circle"></i> Upload &amp; Kelola Media/File
		</button>
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-galeri">
			<i class="fa fa-image"></i> Lihat Galeri
		</button>
		<button type="button" class="btn btn-secondary btn-sm mb-1" data-toggle="modal" data-target="#modal-download">
			<i class="fa fa-download"></i> Lihat File
		</button>
		<!-- Class 'konten' ditambahkan untuk Summernote -->
		<textarea name="isi" class="form-control konten" placeholder="Deskripsi dan detail fasilitas"><?php echo set_value('isi', $fasilitas->isi) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website', $fasilitas->text_website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website', $fasilitas->website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/fasilitas') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>
<?php // Meskipun ini mungkin tidak berfungsi di Canvas, ini adalah bagian dari struktur kode asli:
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
            placeholder: 'Masukkan Deskripsi dan Detail Fasilitas di sini',
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
