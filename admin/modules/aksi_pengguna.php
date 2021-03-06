<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access('Super Admin');
if(!isset($_POST['id'])){
	//insert
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$nama_lengkap = $_POST['nama_lengkap'];
	$is_pegawai = $_POST['is_pegawai'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	$id_pegawai = (@$_POST['id_pegawai'] == '') ? NULL : $_POST['id_pegawai'];

	mysqli_query($koneksi,"INSERT INTO `tb_pengguna`(`username`, `password`, `nama_lengkap`, `is_pegawai`, `level`, `status`".(($id_pegawai == NULL) ? "" : ", `id_pegawai`").") VALUES ('$username','$password','$nama_lengkap','$is_pegawai','$level','$status'".(($id_pegawai == NULL) ? NULL : ",'$id_pegawai'").")");
	header("location:pengguna.php?sukses=tambah");
}else{
	$username = $_POST['username'];
	if($_POST['password'] != ''){
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);	
	}else{
		$password = '';
	}
	$nama_lengkap = $_POST['nama_lengkap'];
	$is_pegawai = $_POST['is_pegawai'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	$id_pegawai = (@$_POST['id_pegawai'] == '') ? NULL : $_POST['id_pegawai'];
	$id_pengguna = $_POST['id'];
	mysqli_query($koneksi,"UPDATE `tb_pengguna` SET `username`='$username',".( ($password != '')?"`password`='$password'," : "" )."`nama_lengkap`='$nama_lengkap',`is_pegawai`='$is_pegawai',`level`='$level',`status`='$status'".(($id_pegawai == NULL) ? "" : ",`id_pegawai`='$id_pegawai'")." WHERE id = '$id_pengguna'");
	header("location:pengguna.php?sukses=ubah");
}