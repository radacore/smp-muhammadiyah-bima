<p class="text-right">
	<a href="<?php echo base_url('admin/prestasi') ?>" class="btn btn-outline-info btn-sm">
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

<form action="<?php echo base_url('admin/prestasi/edit/'.$prestasi->id_prestasi) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-3">Judul Prestasi <span class="text-danger">*</span></label>
	<div class="col-md-9">
		<input type="text" name="judul_prestasi" class="form-control" value="<?php echo set_value('judul_prestasi', $prestasi->judul_prestasi) ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Penyelenggara dan Hadiah</label>
	<div class="col-md-5">
		<input type="text" name="penyelenggara" class="form-control" value="<?php echo set_value('penyelenggara', $prestasi->penyelenggara) ?>">
		<small class="text-secondary">Penyelenggara kegitan. Misal: Kementerian Pendidikan dan Kebudayaan</small>
	</div>
	<div class="col-md-4">
		<input type="text" name="hadiah_prestasi" class="form-control" value="<?php echo set_value('hadiah_prestasi', $prestasi->hadiah_prestasi) ?>">
		<small class="text-secondary">Hadiah dan Penghargaan. Misal: Piala dan Uang Tunai</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Level, Tahun &amp; Tanggal</label>
	<div class="col-md-2">
		<select name="jenjang_prestasi" class="form-control">
			<?php 
			$jenjang_options = ['Sekolah', 'Kelurahan', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];
			foreach ($jenjang_options as $jenjang) {
				echo '<option value="'.$jenjang.'" ' . set_select('jenjang_prestasi', $jenjang, ($prestasi->jenjang_prestasi==$jenjang)) . '>' . $jenjang . '</option>';
			}
			?>
		</select>
		<small class="text-secondary">Jenjang Prestasi</small>
	</div>
	<div class="col-md-2">
		<input type="number" name="tahun_prestasi" class="form-control" value="<?php echo set_value('tahun_prestasi', $prestasi->tahun_prestasi) ?>">
		<small class="text-secondary">Tahun Prestasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="tanggal_prestasi" class="form-control tanggal" value="<?php echo set_value('tanggal_prestasi', $this->website->tanggal_id($prestasi->tanggal_prestasi)) ?>" placeholder="dd-mm-yyyy">
		<small class="text-secondary">Tanggal Prestasi</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Kategori, Jenis &amp; Status</label>
	<div class="col-md-4">
		<select name="id_kategori_prestasi" class="form-control select2">
			<?php foreach($kategori_prestasi as $kategori_prestasi) { ?>
			<option value="<?php echo $kategori_prestasi->id_kategori_prestasi ?>" 
				<?php echo set_select('id_kategori_prestasi', $kategori_prestasi->id_kategori_prestasi, ($prestasi->id_kategori_prestasi==$kategori_prestasi->id_kategori_prestasi)); ?>>
				<?php echo $kategori_prestasi->nama_kategori_prestasi ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
	
	<div class="col-md-2">
		<select name="status_prestasi" class="form-control">
			<option value="Publish" <?php echo set_select('status_prestasi', 'Publish', ($prestasi->status_prestasi=="Publish")); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_prestasi', 'Draft', ($prestasi->status_prestasi=="Draft")); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status Tampil</small>
	</div>
	<div class="col-md-2">
		<select name="status_text" class="form-control">
			<option value="Ya" <?php echo set_select('status_text', 'Ya', ($prestasi->status_text=="Ya")); ?>>Aktif</option>
			<option value="Tidak" <?php echo set_select('status_text', 'Tidak', ($prestasi->status_text=="Tidak")); ?>>Tidak Aktif</option>
		</select>
		<small class="text-secondary">Text pada slider</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Nama Penerima Prestasi/Penghargaan <span class="text-danger">*</span></label>
	<div class="col-md-6">
		<input type="text" name="nama_penerima" class="form-control" value="<?php echo set_value('nama_penerima', $prestasi->nama_penerima) ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Upload Gambar Prestasi</label>
	<div class="col-md-5">
		<input type="file" name="gambar" class="form-control" value="<?php echo set_value('gambar') ?>">
		<small class="text-secondary">Pilih gambar baru jika ingin mengganti.</small>
	</div>
	<div class="col-md-1">
		<?php if(!empty($prestasi->gambar)) { ?>
			<img src="<?php echo base_url('assets/upload/image/thumbs/'.$prestasi->gambar) ?>" class="img img-thumbnail" style="max-height: 50px; width: auto;" alt="Gambar Saat Ini">
		<?php } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Isi Prestasi</label>
	<div class="col-md-9">
		<!-- TEXTAREA INI MENGGUNAKAN CLASS 'konten' UNTUK SUMMERNOTE -->
		<textarea name="isi" class="form-control konten" placeholder="Deskripsi lengkap prestasi"><?php echo set_value('isi', $prestasi->isi) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Text untuk tombol link (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="text_website" class="form-control" value="<?php echo set_value('text_website', $prestasi->text_website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3">Link/URL untuk Banner (Opsional)</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control" value="<?php echo set_value('website', $prestasi->website) ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-3"></label>
	<div class="col-md-9">
		<a href="<?php echo base_url('admin/prestasi') ?>" class="btn btn-outline-info">
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
            placeholder: 'Deskripsi lengkap prestasi',
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
