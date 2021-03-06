<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
$title = 'Ganti Password | Admin SIKAMU';
$data = mysqli_query($koneksi,"SELECT * FROM tb_pengguna WHERE id = '$_SESSION[id_pengguna]'");
$d = mysqli_fetch_assoc($data);
include 'template/head.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Ganti Password</h1>
		
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php 
			if(isset($_GET['sukses'])){
				
				if($_GET['sukses'] == 'ubah'){
					echo '<div class="alert alert-success">Data berhasil diubah</div>';
				}

			}
			?>
			<form action="aksi_ganti_password.php" method="post">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Username</label>
						<input type="text" class="form-control" autocomplete="off" readonly="" value="<?= $d['username']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" required="" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label for="">Pegawai ?</label>
						<input type="text" class="form-control" readonly="" value="<?= $d['is_pegawai'] == 'y' ? 'Ya' : 'Tidak'?>">
					</div>
					
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">Nama Lengkap</label>
						<input type="text" class="form-control" readonly="" value="<?= $d['nama_lengkap']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">Level</label>
						<input type="text" readonly="" class="form-control" value="<?= $d['level']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">Status</label>
						<input type="text" readonly="" class="form-control" value="<?= $d['status']?>">
						
					</div>
					
				</div>
				
				
				<div class="form-group">
					<button class="btn btn-success">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</main>


<?php include 'template/footer.php'?>