<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access('Super Admin');
if(!isset($_POST['id'])){
	//insert
	$data_uri = $_POST['ttd'];
	$encoded_image = explode(",", $data_uri)[1];
	$decoded_image = base64_decode($encoded_image);
	$filename = date('dmYHis').'.png';
	$path = '../uploads/ttd/'.$filename;
	file_put_contents($path, $decoded_image);
	mysqli_query($koneksi,"INSERT INTO `tb_pegawai`(`nama`, `nip`, `jabatan`, `pangkat`, `status`, `foto`) VALUES ('$_POST[nama]','$_POST[nip]','$_POST[jabatan]','$_POST[pangkat]','$_POST[status]','$filename')");
	header("location:pegawai.php?sukses=tambah");
}else{
	$data_uri = $_POST['ttd'];
	$encoded_image = explode(",", $data_uri)[1];
	$decoded_image = base64_decode($encoded_image);
	$filename = date('dmYHis').'.png';
	$path = '../uploads/ttd/'.$filename;
	file_put_contents($path, $decoded_image);
	mysqli_query($koneksi,"UPDATE `tb_pegawai` SET `nama`='$_POST[nama]',`nip`='$_POST[nip]',`jabatan`='$_POST[jabatan]',`pangkat`='$_POST[pangkat]',`status`='$_POST[status]',`foto`='$filename' WHERE id='$_POST[id]'");
	header("location:pegawai.php?sukses=ubah");
}