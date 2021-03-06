<?php
include '../../config/config.php';
include '../../config/database.php';
$title = 'Dahboard | Admin SIKAMU';
include 'template/head.php';
check_session();
$data_hari_ini = mysqli_query($koneksi, "SELECT * FROM tb_konsultasi WHERE tanggal = '".date('Y-m-d')."'");
$d_hari_ini = mysqli_num_rows($data_hari_ini);
$data_bulan_ini = mysqli_query($koneksi, "SELECT * FROM tb_konsultasi WHERE DATE_FORMAT(tanggal,'%Y-%m') = '".date('Y-m')."'");
$d_bulan_ini = mysqli_num_rows($data_bulan_ini);
$data_pengguna = mysqli_query($koneksi, "SELECT * FROM tb_pengunjung");
$d_pengguna = mysqli_num_rows($data_pengguna);
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
		
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card text-white bg-primary">
				<div class="card-body">
					<h5>Konsultasi Hari Ini</h5>
					<h3 class="text-right font-weight-bold"><?= $d_hari_ini?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card text-white bg-info">
				<div class="card-body">
					<h5>Konsultasi Bulan Ini</h5>
					<h3 class="text-right font-weight-bold"><?= $d_bulan_ini?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card text-white bg-warning">
				<div class="card-body">
					<h5>Jumlah Pengguna SPSE</h5>
					<h3 class="text-right font-weight-bold"><?= $d_pengguna?></h3>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include 'template/footer.php'?>