<?php
include '../../config/config.php';
include '../../config/database.php';
require_once '../vendors/tcpdf/tcpdf.php';

check_session();
$dari = @$_GET['dari'];
$sampai = @$_GET['sampai'];
if($dari != '' && $sampai != ''){
    $dari = str_replace('/', '-', urldecode(@$_GET['dari']));
    $sampai = str_replace('/', '-', urldecode(@$_GET['sampai']));

    $dari = date('Y-m-d',strtotime($dari));
    $sampai = date('Y-m-d',strtotime($sampai));
    $data = mysqli_query($koneksi,"select * from tb_konsultasi where tanggal between '$dari' and '$sampai' order by tanggal desc,waktu desc");
}else{
    $data = mysqli_query($koneksi,"select * from tb_konsultasi order by tanggal desc,waktu desc");
}

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = '../../assets/img/lpse-logo.png';
        $this->SetAlpha(0.5);

        $this->Image($img_file, 10, 120, 195, 90, '', '', '', true, 72);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}
// create new PDF document
$pdf = new MYPDF('P', 'mm', [215,330], true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIKAMU - SISTEM INFORMASI BUKU TAMU');
$pdf->SetTitle('CETAK REKAP LAPORAN KONSULTASI');

// remove default header/footer
// $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(4, 0, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L');

$html = '<img src="../../assets/img/lpse-logo.png"><br>';
$html .= '<h5 align="center">REKAP LAPORAN KONSULTASI PENGGUNA SPSE</h5><br>';
$html .= '<table width="100%" border="1" cellpadding="2">';
$html .= '<tr style="background-color:black;color:white;">';
$html .= '<th align="center" valign="middle" width="5%">No</th>';
$html .= '<th align="center" valign="middle" width="10%">Tanggal, Waktu</th>';
$html .= '<th align="center" valign="middle" width="10%">Nama</th>';
$html .= '<th align="center" valign="middle" width="15%">Instansi/Perusahaan</th>';
$html .= '<th align="center" valign="middle" width="15%">Alamat</th>';
$html .= '<th align="center" valign="middle" width="10%">No. Telp/HP</th>';
$html .= '<th align="center" valign="middle" width="10%">Email</th>';
$html .= '<th align="center" valign="middle" width="15%">Permasalahan</th>';
$html .= '<th align="center" valign="middle" width="10%">Solusi</th>';
$html .= '</tr>';
if(mysqli_num_rows($data) > 0){
    $no=1;
    while($d = mysqli_fetch_assoc($data)){
        $html .= '<tr>';
        $html .= '<td align="center" valign="middle">'.($no++).'</td>';
        $html .= '<td align="center" valign="middle" >'.date('d M Y',strtotime($d['tanggal'])).' '.$d['waktu'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['nama_pengunjung'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['instansi_perusahaan'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['alamat'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['notelp'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['email'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['permasalahan'].'</td>';
        $html .= '<td align="center" valign="middle" >'.$d['solusi'].'</td>';
        $html .= '</tr>';
    }
}else{
    $html .= '<tr>';
    $html .= '<td colspan="9" align="center">Data Kosong</td>';
    $html .= '</tr>';

}
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('rekap_laporan_konsultasi_'.str_replace('/', '-', @$_GET['dari']).'_sd_'.str_replace('/', '-', @$_GET['sampai']).'.pdf', 'I');
?>