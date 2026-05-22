<div class="modal fade" id="modal-<?php echo $jenis_dokumen->id_jenis_dokumen ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $jenis_dokumen->nama_jenis_dokumen ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				 <iframe src="<?php echo base_url('assets/upload/pendaftaran/'.$check_dokumen->gambar) ?>"  height="300" style="width:100%;" allowfullscreen webkitallowfullscreen></iframe>

			</div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->