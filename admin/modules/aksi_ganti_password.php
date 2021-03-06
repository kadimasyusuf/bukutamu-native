<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
$password = $_POST['password'];
if($password != ''){
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$id_pengguna = $_SESSION['id_pengguna'];
	mysqli_query($koneksi,"UPDATE `tb_pengguna` SET `password`='$password' WHERE id = '$id_pengguna'");
	header("location:ganti_password.php?sukses=ubah");
	exit;
}
header("location:ganti_password.php");
