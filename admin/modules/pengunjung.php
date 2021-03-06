<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
only_level_access(['Super Admin','Admin']);
$title = 'Data Pengunjung | Admin SIKAMU';
include 'template/head.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Data Pengunjung</h1>
		<div class="float-right">
			<a href="<?= base_url()?>tambah_pengunjung.php" class="btn btn-success btn-sm">
				<i class="fa fa-plus"></i> Tambah Pengunjung
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php 
			if(isset($_GET['sukses'])){
				if($_GET['sukses'] == 'tambah'){
					echo '<div class="alert alert-success">Data berhasil ditambahkan</div>';

				}
				if($_GET['sukses'] == 'ubah'){
					echo '<div class="alert alert-success">Data berhasil diubah</div>';
				}
				if($_GET['sukses'] == 'hapus'){
					echo '<div class="alert alert-success">Data berhasil dihapus</div>';
				}

			}
			?>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Nama</th>
						<th>Nama Instansi/Perusahaan</th>
						<th>Alamat</th>
						<th>No. Telp/HP</th>
						<th>Email</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					$data = mysqli_query($koneksi,"select * from tb_pengunjung order by nama asc");
					while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?= $no++?></td>
							<td><?= $d['nama']?></td>
							<td><?= $d['instansi_perusahaan']?></td>
							<td><?= $d['alamat']?></td>
							<td><?= $d['notelp']?></td>
							<td><?= $d['email']?></td>
							<td><?= $d['kategori']?></td>
							<td class="text-center">
								<a href="edit_pengunjung.php?id=<?= $d['id']?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
								<a href="#" onclick="hapus(<?= $d['id']?>)" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus">
									<i class="fa fa-trash"></i>
								</a>

							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</main>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script>
	$(function() {
		$('table').DataTable();
	})
	function hapus(id){
		if(confirm('Hapus?')) window.location = 'hapus_pengunjung.php?id='+id;
	}
</script>

<?php include 'template/footer.php'?>