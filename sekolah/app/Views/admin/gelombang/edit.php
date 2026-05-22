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
echo form_open_multipart(base_url('admin/gelombang/edit/'.$gelombang->id_gelombang), 'accept-charset="utf-8"');
echo csrf_field();

// Definisikan tahun ajaran untuk placeholder
$tahun_ajaran_placeholder = (date('Y'))."/".(date('Y')+1);
?>

<div class="form-group row">
	<label class="col-3">Nama Periode PPDB <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="judul" class="form-control" placeholder="Nama Periode PPDB" 
			value="<?php echo set_value('judul', $gelombang->judul) ?>" required>
		<small class="text-secondary">Nama Periode PPDB. Misal: **PPDB Tahap 1 - Tahun Ajaran <?php echo $tahun_ajaran_placeholder; ?>**</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tahun ajaran dan status <span class="text-danger">*</span></label>

	<div class="col-3">
		<input type="number" name="tahun" 
			value="<?php echo set_value('tahun', $gelombang->tahun) ?>" 
			placeholder="Tahun" class="form-control" required>
		<small class="text-secondary">Tahun</small>
	</div>

	<div class="col-3">
		<input type="text" name="tahun_ajaran" 
			value="<?php echo set_value('tahun_ajaran', $gelombang->tahun_ajaran) ?>" 
			placeholder="Tahun ajaran" class="form-control" required>
		<small class="text-secondary">Tahun Ajaran: <?php echo date('Y') ?>/<?php echo date('Y')+1; ?></small>
	</div>

	<div class="col-3">
		<select name="status_gelombang" class="form-control">
			<?php 
			$status_options = ['Buka', 'Tutup'];
			foreach ($status_options as $status) {
				$selected = set_select('status_gelombang', $status, ($gelombang->status_gelombang == $status));
				echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
			}
			?>
		</select>
		<small class="text-secondary">Status Periode</small>
	</div>
</div>


<div class="form-group row">
	<label class="col-3">Gambar / Banner</label>
	
	<div class="col-6">
		<input type="file" name="gambar" class="form-control" placeholder="Gambar? logo" 
			value="<?php echo set_value('gambar') ?>" accept="image/*">
		<small class="text-secondary">Kosongkan jika tidak ingin mengubah gambar.</small>
	</div>
	<div class="col-md-3">
		<?php if(!empty($gelombang->gambar)) { ?>
			<img src="<?php echo base_url('assets/upload/image/thumbs/'.$gelombang->gambar) ?>" class="img img-thumbnail" alt="Gambar Banner Saat Ini">
		<?php } else { echo '<small class="text-danger">Gambar belum ada.</small>'; } ?>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Keterangan</label>
	<div class="col-9">
		<!-- TEXTAREA YANG AKAN DIJADIKAN SUMMERNOTE -->
		<textarea name="isi" placeholder="Keterangan lengkap periode PPDB" class="form-control konten" rows="10"><?php echo set_value('isi', $gelombang->isi) ?></textarea>
	</div>
</div>


<div class="form-group row">
	<label class="col-3">Tanggal buka, tutup, dan pengumuman PPDB</label>

	<div class="col-3">
		<input type="text" name="tanggal_buka" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_buka', date('d-m-Y', strtotime($gelombang->tanggal_buka))) ?>">
		<small class="text-secondary">Tanggal buka pendaftaran</small>
	</div>
	
	<div class="col-3">
		<input type="text" name="tanggal_tutup" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_tutup', date('d-m-Y', strtotime($gelombang->tanggal_tutup))) ?>">
		<small class="text-secondary">Tanggal tutup pendaftaran</small>
	</div>

	<div class="col-3">
		<input type="text" name="tanggal_pengumuman" class="form-control tanggal" placeholder="dd-mm-yyyy" 
			value="<?php echo set_value('tanggal_pengumuman', date('d-m-Y', strtotime($gelombang->tanggal_pengumuman))) ?>">
		<small class="text-secondary">Tanggal pengumuman pendaftaran</small>
	</div>
</div>
				

<div class="form-group row">
	<label class="col-3"></label>
	<div class="col-9">
		<a href="<?php echo base_url('admin/gelombang/') ?>" class="btn btn-default">
			<i class="fa fa-arrow-left"></i> Kembali
		</a>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>


<?php 
echo form_close(); 

// Asumsi file modal di-include dari sini
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
