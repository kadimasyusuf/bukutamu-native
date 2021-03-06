<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
$id = @$_POST['id'];
$data = mysqli_query($koneksi,"SELECT peg.foto as ttd FROM tb_pengguna peng JOIN tb_pegawai peg ON peng.id_pegawai = peg.id WHERE peng.id = '$_SESSION[id_pengguna]'");
$d = mysqli_fetch_assoc($data);
mysqli_query($koneksi,"UPDATE `tb_konsultasi` SET `solusi`='$_POST[solusi]',`id_pengguna`='$_SESSION[id_pengguna]',`ttd_pengguna`='$d[ttd]' WHERE id = '$id'");
header('location:jawab_konsultasi.php?id='.$id.'&sukses=jawab');
