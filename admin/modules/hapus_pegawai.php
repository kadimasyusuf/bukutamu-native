<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access('Super Admin');
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM `tb_pegawai` WHERE id = '$id'");
header("location:pegawai.php?sukses=hapus");
