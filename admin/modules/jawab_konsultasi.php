<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
$title = 'Respon Konsultasi | Admin SIKAMU';
$id = @$_GET['id'];
$data = mysqli_query($koneksi,"select * from tb_konsultasi where id='$id'");
$d = mysqli_fetch_assoc($data);
include 'template/head.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Respon Konsultasi</h1>
		<div class="float-right">
			<a href="<?= base_url()?>konsultasi.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Ke Daftar Konsultasi
			</a>
			<a href="<?= base_url()?>detail_konsultasi.php?id=<?= $d['id']?>" class="btn btn-secondary btn-sm">
				<i class="fa fa-info-circle"></i> Detail Konsultasi
			</a>
			<a href="<?= base_url()?>edit_konsultasi.php?id=<?= $d['id']?>" class="btn btn-primary btn-sm">
				<i class="fa fa-edit"></i> Edit Konsultasi
			</a>
			<a href="#" onclick="hapus(<?= $d['id']?>)" class="btn btn-danger btn-sm">
				<i class="fa fa-trash"></i> Hapus Konsultasi
			</a>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php 
			if(@$_GET['sukses'] == 'jawab') echo '<div class="alert alert-success">Respon berhasil disimpan</div>';
			?>
			<form method="post" action="aksi_jawab_konsultasi.php">
				<input type="hidden" name="id" value="<?= $d['id']?>">
				<div class="form-group row">    
					<label class="col-md-3 col-form-label">Hari/Tanggal Konsultasi</label>
					<div class="col-md-3">  
						<input type="text" readonly="" name="tanggal" value="<?= date('d M Y',strtotime($d['tanggal']))?>" class="form-control">
					</div>
					<label class="col-md-3 col-form-label">Waktu</label>
					<div class="col-md-3">  
						<input type="text" readonly="" name="waktu" value="<?= date('H:i:s',strtotime($d['waktu']))?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">IDENTITAS PENGGUNA SPSE</h5>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama </label>
					<div class="col-md-3">
						<input type="text" class="form-control" readonly name="nama_pengunjung" value="<?= $d['nama_pengunjung']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Nama Instansi/Perusahaan</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="instansi_perusahaan" value="<?= $d['instansi_perusahaan']?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					
					<label for="" class="col-md-3 col-form-label">Alamat </label>
					<div class="col-md-9">
						<textarea name="alamat" class="form-control" readonly="" name="alamat"><?= $d['alamat']?></textarea>
					</div>

				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nomor Telepon/HP </label>
					<div class="col-md-3">
						<input type="tel" class="form-control" readonly="" name="notelp" value="<?= $d['notelp']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Email</label>
					<div class="col-md-3">
						<input type="email" class="form-control" readonly="" name="email" value="<?= $d['email']?>">
					</div>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">PERMASALAHAN </h5>
					<textarea name="permasalahan" class="form-control" readonly=""><?= $d['permasalahan']?></textarea>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">SOLUSI </h5>
					<textarea name="solusi" class="form-control" required=""><?= $d['solusi']?></textarea>
				</div>
				<div class="form-group text-center">
					<button class="btn btn-success">SETUJUI RESPON</button>
				</div>
			</form>
		</div>
	</div>
</main>

<script>
	function hapus(id){
		if(confirm('Hapus?')) window.location = 'hapus_konsultasi.php?id='+id;
	}
</script>

<?php include 'template/footer.php'?>