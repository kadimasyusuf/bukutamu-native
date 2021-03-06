<?php
include '../../config/config.php';
include '../../config/database.php';
$qry = $_GET['qry'];
$data = mysqli_query($koneksi,"SELECT * FROM `tb_pengunjung` WHERE nama LIKE '%$qry%'");
$row = [];
while($d = mysqli_fetch_assoc($data)){
	$row[] = [
		'value'=>$d['id'],
		'text'=>$d['nama'],
		'instansi_perusahaan'=>$d['instansi_perusahaan'],
		'alamat'=>$d['alamat'],
		'notelp'=>$d['notelp'],
		'email'=>$d['email'],
		'kategori'=>$d['kategori']
	];
}
header('Content-Type:application/json');
echo json_encode(['data'=>$row]);

