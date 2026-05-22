<?php
// Tampilkan pesan sukses dari Controller (opsional, untuk konsistensi)
if (session()->getFlashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo session()->getFlashdata('sukses');
    echo '</div>';
}

// Tampilkan error validasi jika ada (opsional, untuk konsistensi)
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

echo form_open_multipart(base_url('admin/konfigurasi/banner'));
echo csrf_field();
?>

<input type="hidden" name="id_konfigurasi" value="<?php echo $konfigurasi->id_konfigurasi ?>">

<div class="form-group row">
	<label class="col-3">Ringkasan Tentang Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<textarea name="ringkasan" class="form-control" rows="3" placeholder="Ringkasan singkat website"><?php echo set_value('ringkasan', $konfigurasi->ringkasan) ?></textarea>
		<small class="text-secondary">Ringkasan ini biasanya muncul di halaman depan website.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tentang Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<!-- TEXTAREA INI MENGGUNAKAN CLASS 'konten' UNTUK SUMMERNOTE -->
		<textarea name="tentang" class="form-control konten" rows="10" 
			placeholder="Tuliskan deskripsi lengkap tentang website atau perusahaan di sini."><?php echo set_value('tentang', $konfigurasi->tentang) ?></textarea>
		<small class="text-secondary">Konten ini akan muncul di halaman "Tentang Kami" atau sejenisnya.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Text Link About Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="link_text" class="form-control" 
			value="<?php echo set_value('link_text', $konfigurasi->link_text) ?>" required>
		<small class="text-secondary">Teks tombol tautan. Contoh: Selengkapnya, Baca Profil.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Link About Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="link_website" class="form-control" 
			value="<?php echo set_value('link_website', $konfigurasi->link_website) ?>" required placeholder="<?php echo base_url('profil') ?>">
		<small class="text-secondary">URL tujuan ketika tombol diklik. Contoh: <?php echo base_url('profil') ?></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Link Video Profil</label>
	<div class="col-9">
		<input type="text" name="link_video" class="form-control" 
			value="<?php echo set_value('link_video', $konfigurasi->link_video) ?>" placeholder="Contoh: https://www.youtube.com/watch?v=..." >
		<small class="text-secondary">URL video dari YouTube atau platform lain untuk video profil.</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Upload Banner Baru</label>
	<div class="col-6">
		<input type="file" name="banner" value="<?php echo set_value('banner') ?>" class="form-control" accept="image/*">
		<small class="text-secondary">Format: JPG, PNG, GIF. Kosongkan jika tidak ingin ganti.</small>
	</div>
	<div class="col-3">
		<!-- Asumsi $this->website->banner() mengembalikan URL banner saat ini -->
		<?php 
		// Mengganti $this->website->banner() dengan asumsi variabel $banner_url tersedia atau menggunakan data konfigurasi
		$current_banner = base_url('assets/upload/image/thumbs/' . ($konfigurasi->banner ?? 'default.jpg'));
		?>
		<img src="<?php echo $current_banner ?>" class="img img-thumbnail" alt="Banner Saat Ini" style="max-height: 100px; width: auto;">
	</div>
</div>

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/konfigurasi') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan dan Update</button>
	</div>
</div>

<?php 
echo form_close();
// Asumsi modal-modal ini harus tetap di-include di akhir file:
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
            placeholder: 'Tuliskan deskripsi lengkap tentang website atau perusahaan di sini.',
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
