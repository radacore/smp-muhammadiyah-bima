<?php
// Tampilkan pesan sukses dari Controller (opsional, jika ada)
if (session()->getFlashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo session()->getFlashdata('sukses');
    echo '</div>';
}

// Tampilkan error validasi jika ada (opsional, jika ada)
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

echo form_open(base_url('admin/konfigurasi/pendaftaran'));
echo csrf_field();
?>

<div class="form-group row">
	<label class="col-3">Fitur Website untuk Pendaftaran Online</label>
	<div class="col-6">
		<select name="fitur_pendaftaran" class="form-control">
			<?php 
			// Menggunakan set_select untuk menjaga nilai jika terjadi error validasi
			$current_fitur = set_value('fitur_pendaftaran', $konfigurasi->fitur_pendaftaran ?? 'Off');
			?>
			<option value="Off" <?php if($current_fitur=='Off') { echo 'selected'; } ?>>Off - Non Aktif</option>
			<option value="On" <?php if($current_fitur=='On') { echo 'selected'; } ?>>On - Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Periode Pendaftaran Online</label>
	<!-- Mengganti $this->website->tanggal_id() dengan set_value dan asumsi format default 'd-m-Y' -->
	<div class="col-2">
		<input type="text" name="mulai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" 
			value="<?php echo set_value('mulai_pendaftaran', date('d-m-Y', strtotime($konfigurasi->mulai_pendaftaran ?? 'now'))) ?>">
		<small class="text-secondary">Tanggal mulai</small>
	</div>
	<div class="col-2">
		<input type="text" name="selesai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" 
			value="<?php echo set_value('selesai_pendaftaran', date('d-m-Y', strtotime($konfigurasi->selesai_pendaftaran ?? 'now'))) ?>">
		<small class="text-secondary">Tanggal selesai</small>
	</div>
	<div class="col-2">
		<input type="text" name="pengumuman_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" 
			value="<?php echo set_value('pengumuman_pendaftaran', date('d-m-Y', strtotime($konfigurasi->pengumuman_pendaftaran ?? 'now'))) ?>">
		<small class="text-secondary">Tanggal pengumuman</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Informasi pendaftaran</label>
	<div class="col-9">
		<!-- TEXTAREA DENGAN CLASS 'konten' UNTUK SUMMERNOTE -->
		<textarea name="keterangan_pendaftaran" class="form-control konten" rows="5" 
			placeholder="Masukkan informasi, panduan, atau persyaratan pendaftaran di sini."><?php echo set_value('keterangan_pendaftaran', $konfigurasi->keterangan_pendaftaran) ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>

<!-- ============================================= -->
<!-- INTEGRASI SUMMERNOTE LITE -->
<!-- ============================================= -->
<!-- CDN ini harus dimuat hanya sekali di footer/layout utama untuk performa yang lebih baik. -->

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
            placeholder: 'Masukkan informasi, panduan, atau persyaratan pendaftaran di sini.',
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
