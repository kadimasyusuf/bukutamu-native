<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access(['Super Admin','Admin']);
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM `tb_pengunjung` WHERE id = '$id'");
header("location:pengunjung.php?sukses=hapus");
