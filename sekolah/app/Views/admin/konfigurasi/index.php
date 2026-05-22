<form action="<?php echo base_url('admin/konfigurasi') ?>" method="post" accept-charset="utf-8">
<?php
echo csrf_field();
?>

<h4>Informasi Dasar</h4>
<hr>
<div class="form-group row">
	<label class="col-3">Nama Website <span class="text-danger">*</span></label>
	<div class="col-9">
		<input type="text" name="namaweb" class="form-control" value="<?php echo $konfigurasi->namaweb ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Singkatan Website</label>
	<div class="col-9">
		<input type="text" name="singkatan" class="form-control" value="<?php echo $konfigurasi->singkatan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tagline Website</label>
	<div class="col-9">
		<input type="text" name="tagline" class="form-control" value="<?php echo $konfigurasi->tagline ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Alamat Website</label>
	<div class="col-6">
		<input type="text" name="website" class="form-control" value="<?php echo $konfigurasi->website ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Setting Pagination</label>
	<div class="col-3">
		<input type="number" name="paginasi" class="form-control" value="<?php echo $konfigurasi->paginasi ?>">
		<small class="text-secondary">Paginasi back end</small>
	</div>
	<div class="col-3">
		<input type="number" name="paginasi_depan" class="form-control" value="<?php echo $konfigurasi->paginasi_depan ?>">
		<small class="text-secondary">Paginasi front end</small>
	</div>
</div>



<hr>
<h4>Informasi Profil Website/Aplikasi</h4>
<hr>
<div class="form-group row">
	<label class="col-3">Tentang Website</label>
	<div class="col-9">
		<textarea name="tentang" class="form-control konten" rows="5" placeholder="Teks panjang tentang profil atau latar belakang website"><?php echo $konfigurasi->tentang ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Deskripsi Ringkas</label>
	<div class="col-9">
		<textarea name="deskripsi" class="form-control" placeholder="Deskripsi ringkas untuk meta tag SEO"><?php echo $konfigurasi->deskripsi ?></textarea>
	</div>
</div>

<hr>
<h4>Kontak dan Alamat</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Official Email</label>
	<div class="col-6">
		<input type="email" name="email" class="form-control" value="<?php echo $konfigurasi->email ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Secondary Email</label>
	<div class="col-6">
		<input type="email" name="email_cadangan" class="form-control" value="<?php echo $konfigurasi->email_cadangan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Telepon</label>
	<div class="col-6">
		<input type="text" name="telepon" class="form-control" value="<?php echo $konfigurasi->telepon ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">HP</label>
	<div class="col-6">
		<input type="text" name="hp" class="form-control" value="<?php echo $konfigurasi->hp ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Alamat</label>
	<div class="col-9">
		<!-- Menggunakan class 'summernote' yang juga akan diinisialisasi -->
		<textarea name="alamat" class="form-control summernote" placeholder="Alamat lengkap yang akan ditampilkan"><?php echo $konfigurasi->alamat ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Google Map</label>
	<div class="col-9">
		<textarea name="google_map" class="form-control" placeholder="Iframe atau kode embed Google Maps"><?php echo $konfigurasi->google_map ?></textarea>
	</div>
</div>

<hr>
<h4>Kontak Whatsapp</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Nomor Whatsapp <i class="fab fa-whatsapp text-success"></i></label>
	<div class="col-6">
		<input type="text" name="whatsapp" class="form-control" value="<?php echo $konfigurasi->whatsapp ?>">
		<small class="text-warning">Format nomor: 62812xxxxxxx (tanpa tanda + atau 0)</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Pesan Whatsapp</label>
	<div class="col-9">
		<textarea name="pesan_whatsapp" class="form-control" placeholder="Pesan default saat user mengklik tombol whatsapp"><?php echo $konfigurasi->pesan_whatsapp ?></textarea>
	</div>
</div>

<hr>
<h4>Jejaring Sosial</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Facebook <i class="fab fa-facebook"></i></label>
	<div class="col-3">
		<input type="text" name="nama_facebook" class="form-control" value="<?php echo $konfigurasi->nama_facebook ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="facebook" class="form-control" value="<?php echo $konfigurasi->facebook ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Twitter <i class="fab fa-twitter"></i></label>
	<div class="col-3">
		<input type="text" name="nama_twitter" class="form-control" value="<?php echo $konfigurasi->nama_twitter ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="twitter" class="form-control" value="<?php echo $konfigurasi->twitter ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Instagram <i class="fab fa-instagram"></i></label>
	<div class="col-3">
		<input type="text" name="nama_instagram" class="form-control" value="<?php echo $konfigurasi->nama_instagram ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="instagram" class="form-control" value="<?php echo $konfigurasi->instagram ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Youtube <i class="fab fa-youtube"></i></label>
	<div class="col-3">
		<input type="text" name="nama_youtube" class="form-control" value="<?php echo $konfigurasi->nama_youtube ?>">
		<small class="text-secondary">Nama akun</small>
	</div>
	<div class="col-6">
		<input type="text" name="youtube" class="form-control" value="<?php echo $konfigurasi->youtube ?>">
		<small class="text-secondary">Alamat link akun</small>
	</div>
</div>

<hr>
<h4>Informasi Pendaftaran Online</h4>
<hr>

<div class="form-group row">
	<label class="col-3">Fitur Website untuk Pendaftaran Online</label>
	<div class="col-6">
		<select name="fitur_pendaftaran" class="form-control">
			<option value="Off">Off - Non Aktif</option>
			<option value="On" <?php if($konfigurasi->fitur_pendaftaran=='On') { echo 'selected'; } ?>>On - Aktif</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Periode Pendaftaran Online</label>
	<div class="col-2">
		<!-- Perhatikan: Fungsi $this->website->tanggal_id() mungkin perlu disesuaikan dengan environment CodeIgniter Anda. -->
		<input type="text" name="mulai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php if(isset($this->website)) { echo $this->website->tanggal_id($konfigurasi->mulai_pendaftaran); } else { echo $konfigurasi->mulai_pendaftaran; } ?>">
		<small class="text-secondary">Tanggal mulai</small>
	</div>
	<div class="col-2">
		<input type="text" name="selesai_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php if(isset($this->website)) { echo $this->website->tanggal_id($konfigurasi->selesai_pendaftaran); } else { echo $konfigurasi->selesai_pendaftaran; } ?>">
		<small class="text-secondary">Tanggal selesai</small>
	</div>
	<div class="col-2">
		<input type="text" name="pengumuman_pendaftaran" placeholder="dd-mm-yyyy" class="form-control tanggal" value="<?php if(isset($this->website)) { echo $this->website->tanggal_id($konfigurasi->pengumuman_pendaftaran); } else { echo $konfigurasi->pengumuman_pendaftaran; } ?>">
		<small class="text-secondary">Tanggal pengumuman</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Informasi pendaftaran</label>
	<div class="col-9">
		<textarea name="keterangan_pendaftaran" class="form-control konten" rows="5" placeholder="Teks lengkap mengenai tata cara atau persyaratan pendaftaran online"><?php echo $konfigurasi->keterangan_pendaftaran ?></textarea>
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
        // Inisialisasi Summernote pada textarea dengan class 'konten' dan 'summernote'
        // Ini mencakup: Tentang Website, Alamat, dan Informasi pendaftaran.
        $('.konten, .summernote').summernote({
            placeholder: 'Masukkan konten di sini',
            tabsize: 2,
            height: 200, // Mengurangi tinggi agar tidak terlalu besar
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'hr']], // Tidak memasukkan 'picture' karena biasanya konfigurasi berupa teks
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Catatan: Jika Anda menggunakan datepicker/datetimepicker untuk input dengan class 'tanggal', 
        // pastikan library JS-nya juga dimuat. Di sini hanya mencakup Summernote.
    });
</script>
