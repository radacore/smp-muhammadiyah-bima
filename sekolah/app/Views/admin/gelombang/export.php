<table class="tabelku table-sm mb-3">
			<thead>
				<tr>
					<th width="30%">Nama Periode</th>
					<th><?php echo $gelombang->judul ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Tanggal pelaksanaan</td>
					<td>
						<span class="text-secondary">Pembukaan:</span> <?php echo $this->website->hari($gelombang->tanggal_buka) ?>
						<br><span class="text-secondary">Penutupan:</span> <?php echo $this->website->hari($gelombang->tanggal_tutup) ?>
						<br><span class="text-secondary">Pengumuman:</span> <?php echo $this->website->hari($gelombang->tanggal_pengumuman) ?>
					</td>
				</tr>
				<tr>
					<td>Periode</td>
					<td><?php echo $gelombang->tahun ?></td>
				</tr>
				<tr>
					<td>Tahun Ajaran</td>
					<td><?php echo $gelombang->tahun_ajaran ?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<?php if($gelombang->status_gelombang=='Buka') { ?>
							<span class="badge bg-info">
								<i class="fa fa-eye"></i> <?php echo $gelombang->status_gelombang ?>
							</span>
						<?php }else{ ?>
							<span class="badge bg-secondary">
								<i class="fa fa-eye-slash"></i> Not Published
							</span>
						<?php } ?>
					</td>
				</tr>
				<tr>
		          <td>Jenjang Pendidikan</td>
		          <td><?php echo $judul_jenjang_pendidikan ?></td>
		        </tr>
		        <tr>
		          <td>Status Pendaftaran</td>
		          <td><?php echo $status_pendaftaran ?></td>
		        </tr>
			</tbody>
		</table>

		<p>Klik tombol <strong>Excel</strong> pada tabel di bawah ini untuk melakukan Ekspor data ke Excel</p>
		<div class="table-responsive">
			<table class="tabelku table-sm" id="example1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Panggilan</th>
						<th>L/P</th>
						<th>Tempat lahir</th>
						<th>Tgl lahir</th>
						<th>NIS</th>
						<th>NISN</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Kewarganegaraan</th>
						<th>Status Anak</th>
						<th>Anak nomor</th>
						<th>Jumlah Saudara</th>
						<th>Agama</th>
						<th>Berkebutuhan Khusus</th>
						<th>Ayah</th>
						<th>Ibu</th>
						<th>Wali</th>
						<th>Alamat wali</th>
						<th>Telepon Wali</th>
						<th>Status Pendaftaran</th>
						<th>Golongan Darah</th>
						<th>Tinggi (cm)</th>
						<th>Berat (kg)</th>
						<th>Asal Sekolah</th>
						<th>Status Masuk</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($siswa as $siswa) { ?>
					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo $siswa->nama_siswa ?></td>
						<td><?php echo $siswa->nama_panggilan ?></td>
						<td><?php echo $siswa->jenis_kelamin ?></td>
						<td><?php echo $siswa->tempat_lahir ?></td>
						<td><?php echo $siswa->tanggal_lahir ?></td>
						<td><?php echo $siswa->nis ?></td>
						<td><?php echo $siswa->nisn ?></td>
						<td><?php echo $siswa->alamat ?></td>
						<td><?php echo $siswa->telepon ?></td>
						<td><?php echo $siswa->status_wn ?></td>
						<td><?php echo $siswa->nama_hubungan ?></td>
						<td><?php echo $siswa->anak_ke ?></td>
						<td><?php echo $siswa->jumlah_saudara ?></td>
						<td><?php echo $siswa->nama_agama ?></td>
						<td><?php echo $siswa->berkebutuhan_khusus ?></td>
						<td><?php echo $siswa->nama_ayah ?></td>
						<td><?php echo $siswa->nama_ibu ?></td>
						<td><?php echo $siswa->nama_wali ?></td>
						<td><?php echo $siswa->alamat_wali ?></td>
						<td><?php echo $siswa->telepon_wali ?></td>
						<td><?php echo $siswa->status_pendaftaran ?></td>
						<td><?php echo $siswa->goldar_siswa ?></td>
						<td><?php echo $siswa->tinggi ?></td>
						<td><?php echo $siswa->berat ?></td>
						<td><?php echo $siswa->asal_sekolah ?></td>
						<td><?php echo $siswa->jenis_siswa ?></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>