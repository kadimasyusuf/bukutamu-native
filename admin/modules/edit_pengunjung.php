<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
only_level_access(['Super Admin','Admin']);
$title = 'Edit Pengunjung | Admin SIKAMU';
$id = @$_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM tb_pengunjung WHERE id = '$id'");
$d = mysqli_fetch_assoc($data);
include 'template/head.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit Pengunjung</h1>
		<div class="float-right">
			<a href="<?= base_url()?>pengunjung.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Ke Daftar Pengunjung
			</a>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			
			<form method="post" action="aksi_pengunjung.php">
				<input type="hidden" name="id" value="<?= $d['id']?>">
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama</label>
					<div class="col-md-3">
						<input type="text" class="form-control" required="" name="nama_pengunjung" autocomplete="off" value="<?= $d['nama']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Instansi/Perusahaan ?</label>
					<div class="col-md-3">
						<select name="kategori" class="custom-select" required="">
							<option value="">Pilih</option>
							<option <?= $d['kategori'] == 'Perusahaan' ? 'selected' : ''?> >Perusahaan</option>
							<option <?= $d['kategori'] == 'Perangkat Daerah' ? 'selected' : ''?> >Perangkat Daerah</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama Instansi/Perusahaan </label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="instansi_perusahaan" value="<?= $d['instansi_perusahaan']?>" required>
					</div>
					<label for="" class="col-md-3 col-form-label">Alamat </label>
					<div class="col-md-3">
						<textarea name="alamat" class="form-control" required="" name="alamat"><?= $d['alamat']?></textarea>
					</div>

				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nomor Telepon/HP </label>
					<div class="col-md-3">
						<input type="tel" class="form-control" required="" name="notelp" value="<?= $d['notelp']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Email </label>
					<div class="col-md-3">
						<input type="email" class="form-control" required="" name="email" value="<?= $d['email']?>">
					</div>
				</div>
				
				<div class="form-group">
					<button class="btn btn-success">SIMPAN</button>
				</div>
			</form>
		</div>
	</div>
</main>

<?php include 'template/footer.php'?>