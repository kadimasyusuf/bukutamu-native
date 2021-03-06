<?php
include '../config/config.php';
include '../config/database.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$data = mysqli_query($koneksi,"SELECT * FROM tb_pengguna WHERE username='$username' AND status = 'Aktif'");
$count = mysqli_num_rows($data);
if($count == 0){
	exit(header('location:login.php?pesan=gagal'));
}
$d = mysqli_fetch_assoc($data);
if(!password_verify($password, $d['password'])){
	exit(header('location:login.php?pesan=gagal'));
}
$_SESSION['id_pengguna'] = $d['id'];
$_SESSION['level'] = $d['level'];
$_SESSION['nama_lengkap'] = $d['nama_lengkap'];
header('location:modules/dashboard.php');