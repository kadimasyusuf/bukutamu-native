<?php
include '../../config/config.php';
include '../../config/database.php';
require_once '../vendors/tcpdf/tcpdf.php';

check_session();
$id = @$_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM tb_konsultasi WHERE id = '$id'");
$d = mysqli_fetch_assoc($data);
if($d['id_pengguna'] != ''){
    $q_pengguna = mysqli_query("SELECT nama FROM tb_pengguna peng JOIN tb_pegawai peg ON peng.id_pegawai = peg.id WHERE peng.id = '$d[id_pengguna]'");
    $d_pengguna = mysqli_fetch_assoc($q_pengguna);
}else{
    $d_pengguna['nama'] = '';
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
$pdf->SetTitle('CETAK LAPORAN KONSULTASI');

// remove default header/footer
// $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$html = '<img src="../../assets/img/lpse-logo.png"><br>';
$html .= '<h5 align="center">FORM KONSULTASI PENGGUNA SPSE</h5><br>';
$html .= '<table width="100%" border="0" cellpadding="2">';
$html .= '<tr>';
$html .= '<td colspan="2" width="50%" style="border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">Hari/Tanggal Konsultasi</td><td width="50%" style="border-top:1px solid black;border-right:1px solid black;">: '.date('d M Y',strtotime($d['tanggal'])).'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td colspan="2" width="50%" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">Waktu</td><td width="50%" style="border-bottom:1px solid black;border-right:1px solid black;">: '.$d['waktu'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="10%" rowspan="6" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"><b>A.</b></td><td colspan="2" width="90%" style="border-right:1px solid black;"><b>IDENTITAS PENGGUNA SPSE</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="40%">a. Nama</td><td style="border-right:1px solid black;" width="50%">: '.$d['nama_pengunjung'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="40%">b. Nama Instansi/Perusahaan</td><td style="border-right:1px solid black;" width="50%">: '.$d['instansi_perusahaan'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="40%">c. Alamat</td><td style="border-right:1px solid black;" width="50%">: '.$d['alamat'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="40%">d. Nomor Telepon/HP</td><td style="border-right:1px solid black;" width="50%">: '.$d['notelp'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="40%">e. E-Mail</td><td style="border-right:1px solid black;" width="50%">: '.$d['email'].'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td width="10%" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;height:200px;"><b>B.</b></td><td colspan="2" width="90%" style="border-right:1px solid black;border-top:1px solid black;"><b>PERMASALAHAN</b>
<br>
'.$d['permasalahan'].'
</td>';
$html .= '</tr>';
/*for($i=0;$i<9;$i++){
$html .= '<tr>';
$html .= '<td colspan="2" style="border-right:1px solid black;"></td>';
$html .= '</tr>';
}*/
$html .= '<tr>';
$html .= '<td width="10%" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;height:200px"><b>C.</b></td><td colspan="2" width="90%" style="border-right:1px solid black;border-top:1px solid black;"><b>JAWABAN/SOLUSI PERMASALAHAN</b><br>'.$d['solusi'].'</td>';
$html .= '</tr>';
// for($i=0;$i<9;$i++){
// $html .= '<tr>';
// $html .= '<td colspan="2" style="border-right:1px solid black;"></td>';
// $html .= '</tr>';
// }
$html .= '<tr>';
$html .= '<td style="border-left:1px solid black;border-bottom:1px solid black;"></td><td width="40%" style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;" align="center">Pemberi Penjelasan<br><br>';
if($d['ttd_pengguna'] != ''){
    $html .= '<img src="../uploads/ttd/'.$d['ttd_pengguna'].'">';

}

$html .= '<br><br>('.($d['pegawai'] == '' ? '.............................' : $d_pengguna['nama'] ).')</td><td width="50%" style="border-right:1px solid black;border-top:1px solid black;border-bottom:1px solid black;"></td>';
$html .= '</tr>';
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('laporan_konsultasi_'.date('d_m_Y_H_i_s',strtotime($d['tanggal'].' '.$d['waktu'])).'.pdf', 'I');
?>