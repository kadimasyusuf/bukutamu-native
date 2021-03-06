<?php
include '../config/config.php';
include '../config/database.php';

$tanggal = date('Y-m-d',strtotime($_POST['tanggal']));
$waktu = $_POST['waktu'];
$nama_pengunjung = $_POST['nama_pengunjung'];
$kategori = $_POST['kategori'];
$instansi_perusahaan = $_POST['instansi_perusahaan'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];
$email = $_POST['email'];
$permasalahan = $_POST['permasalahan'];
$id_pengunjung = @$_POST['id_pengunjung'];
if($id_pengunjung == ''){
	//insert pengunjung
	mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
	$id_pengunjung = mysqli_insert_id($koneksi);
}else{
	$data = mysqli_query($koneksi,"SELECT * FROM tb_pengunjung WHERE id = '$id_pengunjung'");
	$d = mysqli_fetch_assoc($data);
	$tdksama = 0;
	if($kategori != $d['kategori']) $tdksama += 1;
	if($instansi_perusahaan != $d['instansi_perusahaan']) $tdksama += 1;
	if($alamat != $d['alamat']) $tdksama += 1;
	if($notelp != $d['notelp']) $tdksama += 1;
	if($email != $d['email']) $tdksama += 1;

	if($tdksama > 0){
		mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
		$id_pengunjung = mysqli_insert_id($koneksi);
	}else{
		$id_pengunjung = $d['id'];
	}
}

//insert konsultasi
mysqli_query($koneksi,"INSERT INTO `tb_konsultasi`(`tanggal`, `waktu`, `nama_pengunjung`, `id_pengunjung`, `instansi_perusahaan`, `alamat`, `notelp`, `email`,`permasalahan`) VALUES ('$tanggal','$waktu','$nama_pengunjung','$id_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$permasalahan')");
header("location:../index.php?sukses=kirim");

