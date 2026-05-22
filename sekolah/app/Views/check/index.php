

<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
      <div class="col-lg-8 col-xl-8 col-xxl-8 mx-auto mt-n20">
        <div class="card">
          <div class="card-body p-5" style="min-height: 300px;">

              <p>Masukkan <strong>Nomor/Kode Pendaftaran</strong> Anda untuk memeriksa Status Pendaftaran.</p>

              <?php echo form_open(base_url('check')); ?>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="kode_pendaftaran" placeholder="Nomor/Kode Pendaftaran" aria-label="Nomor/Kode Pendaftaran" aria-describedby="button-addon2" value="<?php if(isset($_POST['submit'])) { 
                $kode_siswa   = strip_tags(strtoupper($_POST['kode_pendaftaran'])); echo $kode_siswa; } ?>">
                  <button class="btn btn-info text-white" name="submit" type="submit" id="button-addon2">
                    <i class="fa fa-search"></i>&nbsp; Lihat Status Pendaftaran
                  </button>
                </div>
              <?php echo form_close();
              if(isset($_POST['submit'])) { 
                $kode_siswa   = strip_tags(strtoupper($_POST['kode_pendaftaran']));
                $siswa = $m_siswa->kode_siswa($kode_siswa);
                if($siswa) {
                ?>
                <div class="alert alert-info text-center">Berikut adalah data pendaftaran Anda:</div>
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th width="25%">Nama</th>
                      <th><?php echo $siswa->nama_siswa ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="font-bold">Jenis Kelamin</td>
                      <td><?php if($siswa->jenis_kelamin=='L') { echo 'Laki-laki'; }else{ echo 'Perempuan'; } ?></td>
                    </tr>
                    <tr>
                      <td class="font-bold">Tempat, tanggal lahir</td>
                      <td><?php echo $siswa->tempat_lahir ?>, <?php echo $this->website->tanggal_id($siswa->tanggal_lahir) ?></td>
                    </tr>
                    <tr>
                      <td class="font-bold">Status Pendaftaran</td>
                      <td>
                          <?php if($siswa->status_pendaftaran=='Menunggu') { ?>
                            <div class="btn btn-warning"><i class="fa fa-clock"></i>&nbsp;<?php echo $siswa->status_pendaftaran ?></div>
                          <?php }elseif($siswa->status_pendaftaran=='Diterima') { ?>
                            <div class="btn btn-success"><i class="fa fa-check-circle"></i>&nbsp;<?php echo $siswa->status_pendaftaran ?></div>
                          <?php }elseif($siswa->status_pendaftaran=='Tidak-Diterima') { ?>
                            <div class="btn btn-danger"><i class="fa fa-times-circle"></i>&nbsp;<?php echo $siswa->status_pendaftaran ?></div>
                          <?php }else{ ?>
                            <div class="btn btn-info"><i class="fa fa-tasks"></i>&nbsp;<?php echo $siswa->status_pendaftaran ?></div>
                          <?php } ?>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <p class="text-right">
                <a href="<?php echo base_url('pendaftaran/cetak/'.$siswa->slug_siswa) ?>" class="btn btn-danger btn-sm w-100" target="_blank">
                  <i class="fa fa-file-pdf"></i>&nbsp;Cetak Bukti Pendaftaran
                </a>
              </p>
              
              <?php }else{ ?>
                <div class="alert alert-warning">Mohon maaf, data pendaftaran tidak ditemukan</div>
              <?php }} ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

