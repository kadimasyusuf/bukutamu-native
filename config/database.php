<?php 

$koneksi = mysqli_connect("localhost","kadimas","","db_bukutamu");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
	exit;
}

?>
