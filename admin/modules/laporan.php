<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
if(isset($_GET['export_pdf'])) exit(header('location:pdf_rekap.php?'.$_SERVER['QUERY_STRING']));
$title = 'Data Laporan Konsultasi | Admin SIKAMU';
include 'template/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Laporan Konsultasi</h1>
		
	</div>
	<div class="row">
		<div class="col-md-12">
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
					
					<div class="col-md-4">
						<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
						<a href="laporan.php" class="btn btn-warning btn-sm">Clear</a>
						<button class="btn btn-info btn-sm" name="export_pdf"><i class="fa fa-file-pdf"></i> Export PDF</button>

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
						<th>Permasalahan</th>
						<th>Solusi</th>


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
							<td><?= $d['permasalahan']?></td>
							<td><?= $d['solusi']?></td>
							
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
	
</script>

<?php include 'template/footer.php'?>