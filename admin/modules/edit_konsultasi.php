<?php
include '../../config/config.php';
include '../../config/database.php';
check_session();
$title = 'Konsultasi Baru | Admin SIKAMU';
$id = @$_GET['id'];
$data = mysqli_query($koneksi,"SELECT k.*,p.kategori FROM tb_konsultasi k JOIN tb_pengunjung p ON k.id_pengunjung = p.id WHERE k.id = '$id'");
$d = mysqli_fetch_assoc($data);
include 'template/head.php';
?>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Konsultasi Baru</h1>
		<div class="float-right">
			<a href="<?= base_url()?>konsultasi.php" class="btn btn-warning btn-sm">
				<i class="fa fa-arrow-left"></i> Ke Daftar Konsultasi
			</a>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			
			<form method="post" action="aksi_konsultasi.php">
				<input type="hidden" name="id" value="<?= $d['id']?>">
				<div class="form-group row">    
					<label class="col-md-3 col-form-label">Hari/Tanggal Konsultasi</label>
					<div class="col-md-3">  
						<input type="text" readonly="" name="tanggal" value="<?= date('d M Y',strtotime($d['tanggal']))?>" class="form-control">
					</div>
					<label class="col-md-3 col-form-label">Waktu</label>
					<div class="col-md-3">
						<input type="text" readonly="" name="waktu" value="<?= $d['waktu']?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">IDENTITAS PENGGUNA SPSE</h5>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control" required="" name="nama_pengunjung" autocomplete="off" value="<?= $d['nama_pengunjung']?>">
						<input type="hidden" name="id_pengunjung" value="<?= $d['id_pengunjung']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Instansi/Perusahaan ?<span class="text-danger">*</span></label>
					<div class="col-md-3">
						<select name="kategori" class="custom-select" required="">
							<option value="">Pilih</option>
							<option <?= ($d['kategori'] == 'Perusahaan') ? 'selected' : ''?> >Perusahaan</option>
							<option <?= ($d['kategori'] == 'Perangkat Daerah') ? 'selected' : ''?>>Perangkat Daerah</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama Instansi/Perusahaan <span class="text-danger">*</span></label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="instansi_perusahaan" value="<?= $d['instansi_perusahaan']?>" required>
					</div>
					<label for="" class="col-md-3 col-form-label">Alamat <span class="text-danger">*</span></label>
					<div class="col-md-3">
						<textarea name="alamat" class="form-control" required="" name="alamat"><?= $d['alamat']?></textarea>
					</div>

				</div>
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nomor Telepon/HP <span class="text-danger">*</span></label>
					<div class="col-md-3">
						<input type="tel" class="form-control" required="" name="notelp" value="<?= $d['notelp']?>">
					</div>
					<label for="" class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
					<div class="col-md-3">
						<input type="email" class="form-control" required="" name="email" value="<?= $d['email']?>">
					</div>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">PERMASALAHAN <span class="text-danger">*</span></h5>
					<textarea name="permasalahan" class="form-control" required=""><?= $d['permasalahan']?></textarea>
				</div>
				<div class="form-group">
					<h5 class="font-weight-bold">SOLUSI <span class="text-danger">*</span></h5>
					<textarea name="solusi" class="form-control" required=""><?= $d['solusi']?></textarea>
				</div>
				<div class="form-group text-center">
					<button class="btn btn-success">SIMPAN</button>
				</div>
			</form>
		</div>
	</div>
</main>
<script>
	$(function() {
		$('[name=nama_pengunjung]').autoComplete({
			minLength:2,
			autoSelect:false,
			noResultsText:'',
			resolver: 'custom',
			formatResult: function (item) {
				return {
					value: item.id,
					text: item.text,
					html: [ 
					item.text , " [" , item.instansi_perusahaan , "]" 
					] 
				};
			},
			events: {
				search: function (qry, callback) {
					$.ajax(
						'ajax_nama_pengunjung.php',
						{
							data: { 'qry': qry}
						}
						).done(function (res) {
                            // console.log(res);
                            callback(res.data);
                        });
					}

				}
			});
		$('[name=nama_pengunjung]').on('autocomplete.select',function(evt, item){
			$('[name=kategori]').val(item.kategori);
			$('[name=instansi_perusahaan]').val(item.instansi_perusahaan);
			$('[name=alamat]').val(item.alamat);
			$('[name=notelp]').val(item.notelp);
			$('[name=email]').val(item.email);
			$('[name=id_pengunjung]').val(item.value);

		})

	})
</script>
<?php include 'template/footer.php'?>