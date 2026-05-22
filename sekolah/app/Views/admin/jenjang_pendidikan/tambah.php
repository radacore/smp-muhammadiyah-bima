<p class="text-right">
	<a href="<?php echo base_url('admin/jenjang_pendidikan') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/jenjang_pendidikan/tambah') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Nama Jenjang Pendidikan <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<input type="text" name="judul_jenjang_pendidikan" class="form-control" value="<?php echo set_value('judul_jenjang_pendidikan') ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar Jenjang Pendidikan</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
        <small class="text-secondary">Pilih gambar utama untuk jenjang pendidikan.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Jenjang Pendidikan, Jenis &amp; Status <span class="text-danger">*</span></label>
	<div class="col-md-3">
		<select name="id_jenjang" class="form-control">
			<?php foreach($jenjang as $jenjang) { ?>
			<option value="<?php echo $jenjang->id_jenjang ?>" <?php echo set_select('id_jenjang', $jenjang->id_jenjang); ?>>
				<?php echo $jenjang->nama_jenjang ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Jenjang Pendidikan</small>
	</div>
	<div class="col-md-2">
		<select name="jenis_jenjang_pendidikan" class="form-control">
			<option value="Jenjang" <?php echo set_select('jenis_jenjang_pendidikan', 'Jenjang', true); ?>>Jenjang Pendidikan</option>
			<option value="Yayasan" <?php echo set_select('jenis_jenjang_pendidikan', 'Yayasan'); ?>>Informasi Yayasan</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>
	<div class="col-md-2">
		<select name="status_jenjang_pendidikan" class="form-control">
			<option value="Publish" <?php echo set_select('status_jenjang_pendidikan', 'Publish', true); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_jenjang_pendidikan', 'Draft'); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status publikasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="icon" class="form-control" value="<?php echo set_value('icon') ?>">
		<small class="text-secondary">Icon <a href="https://fontawesome.com/icons" target="_blank">Fontawsome</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Tanggal, jam Publikasi &amp; Urutan</label>
	<div class="col-md-3">
		<input type="text" name="tanggal_publish" class="form-control tanggal" value="<?php if(isset($_POST['tanggal_publis'])) { echo set_value('tanggal_publish'); }else{ echo date('d-m-Y'); } ?>">
		<small class="text-secondary">Format **dd-mm-yyyy**. Misal: <?php echo date('d-m-Y') ?></small>
	</div>
	<div class="col-md-3">
		<input type="text" name="jam" class="form-control jam" value="<?php if(isset($_POST['jam'])) { echo set_value('jam'); }else{ echo date('H:i:s'); } ?>">
		<small class="text-secondary">Format **HH:MM:SS**. Misal: <?php echo date('H:i:s') ?></small>
	</div>
	<div class="col-md-3">
		<input type="number" name="urutan" class="form-control" value="<?php if(isset($_POST['urutan'])) { echo set_value('urutan'); }else{ echo 0; } ?>">
		<small class="text-secondary">Nomor urut tampil</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Ringkasan</label>
	<div class="col-md-10">
		<textarea name="ringkasan" class="form-control" placeholder="Ringkasan singkat jenjang pendidikan (Opsional)"><?php echo set_value('ringkasan') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Isi Jenjang Pendidikan <span class="text-danger">*</span></label>
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
		<textarea name="isi" class="form-control konten" placeholder="Deskripsi lengkap Jenjang Pendidikan"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Keyword Jenjang Pendidikan (untuk SEO Google)</label>
	<div class="col-md-10">
		<textarea name="keywords" class="form-control" placeholder="Kata kunci, dipisahkan koma, untuk SEO"><?php echo set_value('keywords') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<a href="<?php echo base_url('admin/jenjang_pendidikan') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="reset" class="btn btn-secondary"><i class="fa fa-times"></i> Reset</button>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php 
echo form_close(); 
include('media.php');
include('galeri.php');
include('download.php');
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
        // Target: Isi Jenjang Pendidikan
        $('.konten').summernote({
            placeholder: 'Masukkan Deskripsi dan Detail Jenjang Pendidikan di sini',
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
