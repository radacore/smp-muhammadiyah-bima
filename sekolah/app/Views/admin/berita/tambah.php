<p class="text-right">
	<a href="<?php echo base_url('admin/berita') ?>" class="btn btn-outline-info btn-sm">
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
echo form_open_multipart(base_url('admin/berita/tambah'), 'accept-charset="utf-8"');
echo csrf_field();
?>

<div class="form-group row">
	<label class="col-md-2">Judul Berita <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<input type="text" name="judul_berita" class="form-control" 
			value="<?php echo set_value('judul_berita'); ?>" 
			placeholder="Masukkan judul berita" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar Berita</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" accept="image/*">
		<small class="text-secondary">Maksimal 4MB (jpg, jpeg, gif, png, svg)</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Kategori, Jenis &amp; Status <span class="text-danger">*</span></label>
	
	<!-- Kategori -->
	<div class="col-md-3">
		<select name="id_kategori" class="form-control">
			<?php foreach($kategori as $kategori) { 
				$selected = set_select('id_kategori', $kategori->id_kategori);
			?>
			<option value="<?php echo $kategori->id_kategori ?>" <?php echo $selected; ?>>
				<?php echo esc($kategori->nama_kategori) ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>

	<!-- Jenis Konten -->
	<div class="col-md-2">
		<select name="jenis_berita" class="form-control">
			<option value="Berita" <?php echo set_select('jenis_berita', 'Berita'); ?>>Berita</option>
			<option value="Layanan" <?php echo set_select('jenis_berita', 'Layanan'); ?>>Layanan</option>
			<option value="Profil" <?php echo set_select('jenis_berita', 'Profil'); ?>>Profil</option>
			<option value="Keunggulan" <?php echo set_select('jenis_berita', 'Keunggulan'); ?>>Keunggulan</option>
		</select>
		<small class="text-secondary">Jenis konten</small>
	</div>

	<!-- Status Publikasi -->
	<div class="col-md-2">
		<select name="status_berita" class="form-control">
			<option value="Publish" <?php echo set_select('status_berita', 'Publish', true); ?>>Publish</option>
			<option value="Draft" <?php echo set_select('status_berita', 'Draft'); ?>>Draft</option>
		</select>
		<small class="text-secondary">Status publikasi</small>
	</div>
	
	<!-- Icon -->
	<div class="col-md-2">
		<input type="text" name="icon" class="form-control" 
			value="<?php echo set_value('icon'); ?>" 
			placeholder="fa-home">
		<small class="text-secondary">Icon <a href="https://fontawesome.com/icons" target="_blank">Fontawsome</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Tanggal, jam Publikasi &amp; Urutan</label>
	
	<!-- Tanggal Publish -->
	<div class="col-md-3">
		<?php 
		$default_date = date('d-m-Y');
		$publish_date = set_value('tanggal_publish', $default_date);
		?>
		<input type="text" name="tanggal_publish" class="form-control tanggal" 
			value="<?php echo $publish_date; ?>">
		<small class="text-secondary">Format **dd-mm-yyyy**. Misal: <?php echo date('d-m-Y') ?></small>
	</div>
	
	<!-- Jam Publish -->
	<div class="col-md-3">
		<?php 
		$default_jam = date('H:i:s');
		$publish_jam = set_value('jam', $default_jam);
		?>
		<input type="text" name="jam" class="form-control jam" 
			value="<?php echo $publish_jam; ?>">
		<small class="text-secondary">Format **HH:MM:SS**. Misal: <?php echo date('H:i:s') ?></small>
	</div>
	
	<!-- Urutan -->
	<div class="col-md-3">
		<input type="number" name="urutan" class="form-control" 
			value="<?php echo set_value('urutan', 0); ?>">
		<small class="text-secondary">Nomor urut tampil</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Ringkasan</label>
	<div class="col-md-10">
		<textarea name="ringkasan" class="form-control" rows="3" 
			placeholder="Ringkasan singkat tentang berita/konten"><?php echo set_value('ringkasan') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Isi Berita <span class="text-danger">*</span></label>
	<div class="col-md-10">
		<!-- TEXTAREA YANG AKAN DIJADIKAN SUMMERNOTE -->
		<textarea name="isi" class="form-control konten" id="isi_berita" rows="15"><?php echo set_value('isi') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Keyword Berita (untuk SEO Google)</label>
	<div class="col-md-10">
		<textarea name="keywords" class="form-control" rows="3"
			placeholder="Keywords dipisahkan dengan koma (,)"><?php echo set_value('keywords') ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<a href="<?php echo base_url('admin/berita') ?>" class="btn btn-outline-info">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="reset" class="btn btn-secondary"><i class="fa fa-times"></i> Reset</button>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php 
echo form_close();

// Asumsi file-file modal ini ada di lokasi yang sama (Anda mungkin perlu menghapus include() jika modal sudah tidak digunakan)
include('media.php');
include('galeri.php');
include('download.php');
?>

<!-- ============================================= -->
<!-- INTEGRASI SUMMERNOTE LITE -->
<!-- ============================================= -->
<!-- Perhatian: Saya memasukkan CDN di sini. Idealnya, CSS dan JS harus berada di file layout/wrapper. -->

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
            placeholder: 'Tulis isi berita/konten di sini...',
            tabsize: 2,
            height: 300,
            toolbar: [
                // Toolbar yang disarankan untuk Summernote Lite
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'hr', 'picture']], // Menambahkan 'picture' untuk upload/sisip gambar
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Catatan: Jika Anda juga menggunakan CKEditor, pastikan Anda hanya menginisialisasi satu editor saja.
        // Saya menginisialisasi berdasarkan class `.konten` sesuai dengan kode Anda.
    });
</script>
