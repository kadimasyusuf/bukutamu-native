<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
only_level_access('Super Admin');
$title = 'Tambah Data Pengguna | Admin SIKAMU';
include 'template/head.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Tambah Pengguna</h1>
		<div class="float-right">
			<a href="<?= base_url()?>pengguna.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="aksi_pengguna.php" method="post">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Username</label>
						<input type="text" class="form-control" name="username" required="" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" required="" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label for="">Pegawai ?</label>
						<select name="is_pegawai" id="is_pegawai" class="custom-select">
							<option value="y">Ya</option>
							<option value="t">Tidak</option>
						</select>
					</div>
					
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Nama Lengkap</label>
						<select name="id_pegawai" class="custom-select" onchange="check_namalengkap(this)">
							<option value="">Pilih</option>
							<?php 
							$data = mysqli_query($koneksi,"select * from tb_pegawai where status = 'Aktif'");
							while($d = mysqli_fetch_array($data)){
								?>
								<option value="<?= $d['id']?>"><?= $d['nama']?></option>
							<?php } ?>
						</select>
						<input type="text" class="form-control d-none" name="nama_lengkap" required="">
					</div>
					<div class="form-group col-md-4">
						<label for="">Level</label>
						<select name="level" class="custom-select" required="">
							<option value="">Pilih</option>
							<option>Super Admin</option>
							<option>Pimpinan</option>
							<option>Admin</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="">Status</label>
						<select name="status" class="custom-select" required="">
							<option>Aktif</option>
							<option>Nonaktif</option>
						</select>
					</div>
					
				</div>
				
				
				<div class="form-group">
					<button class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</main>


<script>
	$(function() {
		$('#is_pegawai').on('change',function(){
			var value = $(this).val();
			if(value == 'y'){
				$('[name=id_pegawai]').removeClass('d-none');
				$('[name=nama_lengkap]').addClass('d-none').val('');

			}
			if(value == 't'){
				$('[name=id_pegawai]').addClass('d-none').val('');
				$('[name=nama_lengkap]').removeClass('d-none');

			}
		});

	})
	function check_namalengkap(element){
		var is_pegawai = $('#is_pegawai').val();
		if(is_pegawai == 'y'){
			var value = $('[name=id_pegawai]').find('option:selected').text();
			$('[name=nama_lengkap]').val(value);
		}else{
			var value = '';
			$('[name=nama_lengkap]').val(value);
		}
	}
</script>

<?php include 'template/footer.php'?>