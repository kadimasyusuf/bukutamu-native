<?php 
include 'template/head.php'
?>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-warning shadow border-warning">
                <div class="card-body p-2">
                    <h4 class="card-title text-center">Selamat Datang di Bagian Pengadaan Barang/Jasa Kabupaten Lumajang</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">   
        <div class="col-md-12"> 
            <div class="card shadow">  
                <div class="card-header bg-primary text-white p-2">   
                    <h5 class="card-title text-center">Form Konsultasi Pengguna SPSE</h5>
                </div>
                <div class="card-body">
                    <?php 
                    if(@$_GET['sukses'] == 'kirim'){
                        echo '<div class="alert alert-success">Data berhasil dikirim</div>';
                    }
                    ?>
                    <form action="modules/aksi_konsultasi.php" method="post">
                        <div class="form-group row">    
                            <label class="col-md-3 col-form-label">Hari/Tanggal Konsultasi</label>
                            <div class="col-md-3">  
                                <input type="text" readonly="" name="tanggal" value="<?= date('D, d M Y')?>" class="form-control">
                            </div>
                            <label class="col-md-3 col-form-label">Waktu</label>
                            <div class="col-md-3">  
                                <input type="text" readonly="" name="waktu" value="<?= date('H:i:s')?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-weight-bold">IDENTITAS PENGGUNA SPSE</h5>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-3">
                               <input type="text" class="form-control" required="" name="nama_pengunjung" autocomplete="off">
                               <input type="hidden" name="id_pengunjung">
                           </div>
                           <label for="" class="col-md-3 col-form-label">Instansi/Perusahaan ?<span class="text-danger">*</span></label>
                           <div class="col-md-3">
                            <select name="kategori" class="custom-select" required="">
                                <option value="">Pilih</option>
                                <option>Perusahaan</option>
                                <option>Perangkat Daerah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label">Nama Instansi/Perusahaan<span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" required="" name="instansi_perusahaan">
                        </div>
                        <label for="" class="col-md-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <textarea name="alamat" class="form-control" required="" name="alamat"></textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label">Nomor Telepon/HP <span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <input type="tel" class="form-control" required="" name="notelp">
                        </div>
                        <label for="" class="col-md-3 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <input type="email" class="form-control" required="" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 class="font-weight-bold">PERMASALAHAN <span class="text-danger">*</span></h5>
                        <textarea name="permasalahan" class="form-control" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success">KIRIM</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>  
</div>
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
                        'modules/ajax_nama_pengunjung.php',
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
