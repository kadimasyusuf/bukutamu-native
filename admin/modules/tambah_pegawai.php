<?php
include '../../config/config.php';
$title = 'Tambah Data Pegawai | Admin SIKAMU';
check_session();
only_level_access('Super Admin');
include 'template/head.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Tambah Pegawai</h1>
		<div class="float-right">
			<a href="<?= base_url()?>pegawai.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="aksi_pegawai.php" method="post">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Nama</label>
						<input type="text" class="form-control" name="nama" required="">
					</div>
					<div class="form-group col-md-4">
						<label for="">NIP</label>
						<input type="text" class="form-control" name="nip" required="">
					</div>
					<div class="form-group col-md-4">
						<label for="">Jabatan</label>
						<input type="text" class="form-control" name="jabatan" required="">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Pangkat</label>
						<input type="text" class="form-control" name="pangkat" required="">
					</div>
					<div class="form-group col-md-4">
						<label for="">Status</label>
						<select name="status" class="custom-select" required="">
							<option>Aktif</option>
							<option>Nonaktif</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="">TTD</label><br>
						<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal_ttd"><i class="fa fa-plus"></i> Masukkan TTD</button>
						<button class="btn btn-danger btn-sm d-none" type="button" id="reset_ttd"><i class="fa fa-redo"></i> Reset TTD</button>
						<input type="hidden" name="ttd" id="generated_ttd">	

					</div>
				</div>
				
				
				<div class="form-group">
					<button class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</main>
<!-- Modal -->
<div class="modal fade" id="modal_ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukkan TTD Anda</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<canvas class="border d-block" width="765" height="300"></canvas>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="clear_ttd">Hapus</button>
				<button type="button" class="btn btn-primary" id="generate_ttd">Simpan</button>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


<script>
	var canvas, signaturePad;
	$(function() {
		$('#modal_ttd').on('show.bs.modal', function (e) {
			canvas = document.querySelector("canvas");
			signaturePad = new SignaturePad(canvas);
			if($('#generated_ttd').val() != ''){
				var gen = $('#generated_ttd').val();
				signaturePad.fromDataURL(gen);
			}
		})
		$('#modal_ttd').on('hide.bs.modal', function (e) {
			signaturePad.clear();
			signaturePad.off();
		});
		$('#generate_ttd').click(function(){
			const data = signaturePad.toDataURL();
			$('#generated_ttd').val(data);
			console.log(data);
			$('#modal_ttd').modal('hide');
			$('#reset_ttd').removeClass('d-none');

		});
		$('#clear_ttd').click(function(){
			signaturePad.clear();
			$('#generated_ttd').val('');
			$('#reset_ttd').addClass('d-none');
		});
		$('#reset_ttd').click(function(){
			$('#generated_ttd').val('');
			$(this).addClass('d-none');
		});
	})

</script>

<?php include 'template/footer.php'?>