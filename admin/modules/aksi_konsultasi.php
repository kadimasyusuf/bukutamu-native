<?php
include '../../config/database.php';
include '../../config/config.php';
check_session();
if(!isset($_POST['id'])){
	//insert
	$tanggal = date('Y-m-d',strtotime($_POST['tanggal']));
	$waktu = $_POST['waktu'];
	$nama_pengunjung = $_POST['nama_pengunjung'];
	$kategori = $_POST['kategori'];
	$instansi_perusahaan = $_POST['instansi_perusahaan'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$email = $_POST['email'];
	$permasalahan = $_POST['permasalahan'];
	$id_pengunjung = @$_POST['id_pengunjung'];
	$solusi = $_POST['solusi'];
	$id_pengguna = $_SESSION['id_pengguna'];
	
	if($id_pengunjung == ''){
	//insert pengunjung
		mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
		$id_pengunjung = mysqli_insert_id($koneksi);
	}else{
		$data = mysqli_query($koneksi,"SELECT * FROM tb_pengunjung WHERE id = '$id_pengunjung'");
		$d = mysqli_fetch_assoc($data);
		$tdksama = 0;
		if($kategori != $d['kategori']) $tdksama += 1;
		if($instansi_perusahaan != $d['instansi_perusahaan']) $tdksama += 1;
		if($alamat != $d['alamat']) $tdksama += 1;
		if($notelp != $d['notelp']) $tdksama += 1;
		if($email != $d['email']) $tdksama += 1;

		if($tdksama > 0){
			mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
			$id_pengunjung = mysqli_insert_id($koneksi);
		}else{
			$id_pengunjung = $d['id'];
		}
	}

	$data = mysqli_query($koneksi,"SELECT peg.foto AS ttd FROM tb_pengguna peng JOIN tb_pegawai peg ON peng.id_pegawai = peg.id WHERE peng.id = '$id_pengguna'");
	$d = mysqli_fetch_assoc($data);

//insert konsultasi
	mysqli_query($koneksi,"INSERT INTO `tb_konsultasi`(`tanggal`, `waktu`, `nama_pengunjung`, `id_pengunjung`, `instansi_perusahaan`, `alamat`, `notelp`, `email`,`permasalahan`,`solusi`,`id_pengguna`,`ttd_pengguna`) VALUES ('$tanggal','$waktu','$nama_pengunjung','$id_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$permasalahan','$solusi','$id_pengguna','$d[ttd]')");
	header("location:konsultasi.php?sukses=tambah");


}else{
//insert
	$tanggal = date('Y-m-d',strtotime($_POST['tanggal']));
	$waktu = $_POST['waktu'];
	$nama_pengunjung = $_POST['nama_pengunjung'];
	$kategori = $_POST['kategori'];
	$instansi_perusahaan = $_POST['instansi_perusahaan'];
	$alamat = $_POST['alamat'];
	$notelp = $_POST['notelp'];
	$email = $_POST['email'];
	$permasalahan = $_POST['permasalahan'];
	$id_pengunjung = @$_POST['id_pengunjung'];
	$solusi = $_POST['solusi'];
	$id_pengguna = $_SESSION['id_pengguna'];
	
	if($id_pengunjung == ''){
	//insert pengunjung
		mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
		$id_pengunjung = mysqli_insert_id($koneksi);
	}else{
		$data = mysqli_query($koneksi,"SELECT * FROM tb_pengunjung WHERE id = '$id_pengunjung'");
		$d = mysqli_fetch_assoc($data);
		$tdksama = 0;
		if($kategori != $d['kategori']) $tdksama += 1;
		if($instansi_perusahaan != $d['instansi_perusahaan']) $tdksama += 1;
		if($alamat != $d['alamat']) $tdksama += 1;
		if($notelp != $d['notelp']) $tdksama += 1;
		if($email != $d['email']) $tdksama += 1;

		if($tdksama > 0){
			mysqli_query($koneksi,"INSERT INTO `tb_pengunjung`(`nama`, `instansi_perusahaan`, `alamat`, `notelp`, `email`, `kategori`) VALUES ('$nama_pengunjung','$instansi_perusahaan','$alamat','$notelp','$email','$kategori')");
			$id_pengunjung = mysqli_insert_id($koneksi);
		}else{
			$id_pengunjung = $d['id'];
		}
	}

	$data = mysqli_query($koneksi,"SELECT peg.foto AS ttd FROM tb_pengguna peng JOIN tb_pegawai peg ON peng.id_pegawai = peg.id WHERE peng.id = '$id_pengguna'");
	$d = mysqli_fetch_assoc($data);

//insert konsultasi
	mysqli_query($koneksi,"UPDATE `tb_konsultasi` SET `tanggal` = '$tanggal', `waktu` = '$waktu', `nama_pengunjung` = '$nama_pengunjung', `id_pengunjung` = '$id_pengunjung', `instansi_perusahaan` = '$instansi_perusahaan', `alamat` = '$alamat', `notelp` = '$notelp', `email` = '$email',`permasalahan` = '$permasalahan',`solusi`='$solusi',`id_pengguna`='$id_pengguna',`ttd_pengguna` = '$d[ttd]' WHERE id = '$_POST[id]'");
	header("location:konsultasi.php?sukses=ubah");
}