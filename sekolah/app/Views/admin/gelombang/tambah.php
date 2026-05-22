<p class="text-right">
	<a href="<?php echo base_url('admin/gelombang') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
<hr>

<?php
// Tampilkan pesan sukses dari Controller
if (session()->getFlashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo session()->getFlashdata('sukses');
    echo '</div>';
}

// Tampilkan error validasi jika ada
$errors = session()->getFlashdata('errors');
if ($errors) {
    echo '<div class="alert alert-danger">';
    echo '<h4>Error Validasi:</h4>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . esc($error) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}

// Buka form dengan atribut enctype untuk upload file
echo form_open_multipart(base_url('admin/gelombang/tambah'), 'accept-charset="utf-8"');

// Definisikan tahun ajaran jika belum ada (sesuai logika asli)
$tahun_ajaran = (date('Y'))."/".(date('Y')+1);
echo csrf_field();
?>

<div class="form-group row">
	<label class="col-3">Nama Periode PPDB <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="judul" class="form-control" placeholder="Nama Periode PPDB" 
			value="<?php 
				// Jika ada POST, gunakan set_value. Jika tidak, gunakan $nama_gelombang (asumsi $nama_gelombang didefinisikan di controller)
				echo set_value('judul', $nama_gelombang ?? 'Gelombang ' . (date('Y') + 1)); 
			?>" required>
		<small class="text-secondary">Nama Periode PPDB. <span class="text-danger">Anda dapat menggantinya sesuai kebutuhan.</span> Misal: **<?php echo $nama_gelombang ?? 'Gelombang ' . (date('Y') + 1) ?>**</small>
	</div>

</div>

<div class="form-group row">

	<label class="col-3">Tahun ajaran dan status <span class="text-danger">*</span></label>

	<div class="col-3">
		<input type="number" name="tahun" 
			value="<?php echo set_value('tahun', date('Y') + 1); ?>" 
			placeholder="Tahun" class="form-control" required>
		<small class="text-secondary">Tahun</small>
	</div>

	<div class="col-3">
		<input type="text" name="tahun_ajaran" 
			value="<?php echo set_value('tahun_ajaran', $tahun_ajaran); ?>" 
			placeholder="Tahun ajaran" class="form-control" required>
		<small class="text-secondary">Tahun Ajaran: <?php echo $tahun_ajaran ?></small>
	</div>

	<div class="col-3">
		<select name="status_gelombang" class="form-control">
			<option value="Buka" <?php echo set_select('status_gelombang', 'Buka', true); ?>>Buka</option>
			<option value="Tutup" <?php echo set_select('status_gelombang', 'Tutup'); ?>>Tutup</option>
		</select>
		<small class="text-secondary">Status Periode</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-3">Gambar / Banner</label>
	
	<div class="col-9">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar? logo" 
			value="<?php echo set_value('gambar') ?>" accept="image/*">
		<small class="text-secondary">Gambar/Banner utama periode PPDB (kosongkan jika tidak ada).</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<!-- TEXTAREA YANG AKAN DIJADIKAN SUMMERNOTE -->
		<textarea name="isi" placeholder="Keterangan lengkap periode PPDB" class="form-control konten" rows="10"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tanggal buka, tutup, dan pengumuman PPDB</label>

	<div class="col-3">
		<input type="text" name="tanggal_buka" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_buka') ?>">
		<small class="text-secondary">Tanggal buka pendaftaran</small>
	</div>
	
	<div class="col-3">
		<input type="text" name="tanggal_tutup" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_tutup') ?>">
		<small class="text-secondary">Tanggal tutup pendaftaran</small>
	</div>

	<div class="col-3">
		<input type="text" name="tanggal_pengumuman" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_pengumuman') ?>">
		<small class="text-secondary">Tanggal pengumuman pendaftaran</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>

	<div class="col-9">
		<a href="<?php echo base_url('admin/gelombang') ?>" class="btn btn-default" >
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>
<?php 
echo form_close();

// Asumsi file modal di-include dari sini (dibiarkan sesuai kode Anda)
echo view('admin/berita/media');
echo view('admin/berita/download');
echo view('admin/berita/galeri');
?>

<!-- ============================================= -->
<!-- INTEGRASI SUMMERNOTE LITE -->
<!-- ============================================= -->
<!-- Ini harus dimuat hanya sekali di footer/layout utama untuk performa yang lebih baik. -->

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
            placeholder: 'Masukkan keterangan lengkap periode PPDB di sini...',
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
