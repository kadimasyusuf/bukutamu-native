<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
only_level_access('Super Admin');
$title = 'Edit Data Pengguna | Admin SIKAMU';
$id = $_GET['id'];
$data = mysqli_query($koneksi,"select * from tb_pengguna where id='$id'");
$d = mysqli_fetch_array($data);
include 'template/head.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit Pengguna</h1>
		<div class="float-right">
			<a href="<?= base_url()?>pengguna.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="aksi_pengguna.php" method="post">
				<input type="hidden" name="id" value="<?= $d['id']?>">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Username</label>
						<input type="text" class="form-control" name="username" required="" autocomplete="off" value="<?= $d['username']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" autocomplete="off">
						<span class="form-text text-info">Kosongi jika tidak diubah</span>
					</div>
					<div class="form-group col-md-4">
						<label for="">Pegawai ?</label>
						<select name="is_pegawai" id="is_pegawai" class="custom-select">
							<option value="y" <?= $d['is_pegawai'] == 'y' ? 'selected' : ''?> >Ya</option>
							<option value="t" <?= $d['is_pegawai'] == 't' ? 'selected' : ''?> >Tidak</option>
						</select>
					</div>
					
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Nama Lengkap</label>
						<select name="id_pegawai" class="custom-select <?= $d['is_pegawai'] == 'y' ? '' : 'd-none'?>" onchange="check_namalengkap(this)">
							<option value="">Pilih</option>
							<?php 
							$data = mysqli_query($koneksi,"select * from tb_pegawai where status = 'Aktif'");
							while($dpegawai = mysqli_fetch_array($data)){
								?>
								<option value="<?= $dpegawai['id']?>" <?= $d['id_pegawai'] == $dpegawai['id'] ? 'selected' : ''?> ><?= $dpegawai['nama']?></option>
							<?php } ?>
						</select>
						<input type="text" class="form-control <?= $d['is_pegawai'] == 't' ? '' : 'd-none'?>" name="nama_lengkap" required="" value="<?= $d['nama_lengkap']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">Level</label>
						<select name="level" class="custom-select" required="">
							<option value="">Pilih</option>
							<option <?= $d['level'] == 'Super Admin' ? 'selected' : ''?> >Super Admin</option>
							<option <?= $d['level'] == 'Pimpinan' ? 'selected' : ''?> >Pimpinan</option>
							<option <?= $d['level'] == 'Admin' ? 'selected' : ''?> >Admin</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="">Status</label>
						<select name="status" class="custom-select" required="">
							<option <?= $d['status'] == 'Aktif' ? 'selected' : ''?> >Aktif</option>
							<option <?= $d['status'] == 'Nonaktif' ? 'selected' : ''?> >Nonaktif</option>
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