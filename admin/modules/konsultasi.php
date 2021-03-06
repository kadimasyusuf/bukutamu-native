<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
$title = 'Data Konsultasi | Admin SIKAMU';
include 'template/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Data Konsultasi</h1>
		<div class="float-right">
			<a href="<?= base_url()?>tambah_konsultasi.php" class="btn btn-success btn-sm">
				<i class="fa fa-plus"></i> Konsultasi Baru
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
			<form>
				<div class="form-group row">
					<label for="" class="col-form-label col-md-2">Filter :</label>
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" class="form-control" name="dari" value="<?= @$_GET['dari']?>">
							<div class="input-group-append">
								<span class="input-group-text">s/d</span>
							</div>
							<input type="text" class="form-control" name="sampai" value="<?= @$_GET['sampai']?>">

						</div>
					</div>
					
					<div class="col-md-2">
						<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
						<a href="konsultasi.php" class="btn btn-warning btn-sm">Clear</a>

					</div>
				</div>	
			</form>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Tanggal</th>
						<th>Waktu</th>
						<th>Nama</th>
						<th>Nama Instansi/Perusahaan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					if(@$_GET['dari'] != '' && @$_GET['sampai'] != ''){
						$dari = str_replace('/', '-', urldecode(@$_GET['dari']));
						$sampai = str_replace('/', '-', urldecode(@$_GET['sampai']));

						$dari = date('Y-m-d',strtotime($dari));
						$sampai = date('Y-m-d',strtotime($sampai));
						$data = mysqli_query($koneksi,"select * from tb_konsultasi where tanggal between '$dari' and '$sampai' order by tanggal desc,waktu desc");

					}else{
						$data = mysqli_query($koneksi,"select * from tb_konsultasi order by tanggal desc,waktu desc");

					}
					while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?= $no++?></td>
							<td><?= date('d M Y',strtotime($d['tanggal']))?></td>
							<td><?= $d['waktu']?></td>
							<td><?= $d['nama_pengunjung']?></td>
							<td><?= $d['instansi_perusahaan']?></td>
							<td class="text-center">
								<a href="detail_konsultasi.php?id=<?= $d['id']?>" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail">
									<i class="fa fa-info-circle"></i>
								</a>
								<a href="jawab_konsultasi.php?id=<?= $d['id']?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Respon">
									<i class="fas fa-comment-dots"></i>
								</a>
								<a href="edit_konsultasi.php?id=<?= $d['id']?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
								<a href="#" onclick="hapus(<?= $d['id']?>)" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus">
									<i class="fa fa-trash"></i>
								</a>
								<a href="pdf_laporan.php?id=<?= $d['id']?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Print to PDF">
									<i class="fa fa-file-pdf"></i>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script>
	$(function() {
		$('table').DataTable();
		$('[name=dari]').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('[name=sampai]').datepicker({
			format: 'dd/mm/yyyy'
		});
	})
	function hapus(id){
		if(confirm('Hapus?')) window.location = 'hapus_konsultasi.php?id='+id;
	}
</script>

<?php include 'template/footer.php'?>