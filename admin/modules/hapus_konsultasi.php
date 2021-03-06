<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM `tb_konsultasi` WHERE id = '$id'");
header("location:konsultasi.php?sukses=hapus");
