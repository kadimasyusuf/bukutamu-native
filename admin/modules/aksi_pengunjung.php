<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access(['Super Admin','Admin']);
if(!isset($_POST['id'])){
	//insert
	$nama_pengunjung = $_POST['nama_pengunjung'];
	$kategori = $_POST['kategori'];
	$instansi_perusahaan = $_POST['instansi_perusahaan'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$email = $_POST['email'];
	
	mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
	$id_pengunjung = mysqli_insert_id($koneksi);
	header("location:pengunjung.php?sukses=tambah");

}else{
	//insert
	$nama_pengunjung = $_POST['nama_pengunjung'];
	$kategori = $_POST['kategori'];
	$instansi_perusahaan = $_POST['instansi_perusahaan'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$email = $_POST['email'];
	$id = $_POST['id'];
		
	mysqli_query($koneksi,"UPDATE `tb_pengunjung` SET `nama`='$nama_pengunjung',`instansi_perusahaan`='$instansi_perusahaan',`alamat`='$alamat',`notelp`='$notelp',`email`='$email',`kategori`='$kategori' WHERE id = '$id'");
	header("location:pengunjung.php?sukses=ubah");
}