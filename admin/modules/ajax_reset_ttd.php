<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
only_level_access('Super Admin');
$id = $_GET['id'];
mysqli_query($koneksi,"UPDATE `tb_pegawai` SET `foto`='' WHERE id = '$id'");
echo 'sukses reset ttd';