<?php
	$host	 = "localhost";
	$user	 = "root";
	$pass	 = "SQL2016SJ08";
	$dabname = "db_she";
	
	$foldername="she";
	$conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	mysql_select_db($dabname, $conn) or die('Could not select database.');
	$label_footer="Copyright &copy; ANG 2016 ".date("Y");
	header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Laporan_Harian_SHE.xls");
?>
<style> .str{ mso-number-format:\@; } </style>
<body>
<td><tbody>
  <tr>  
    <td height="30" colspan="3" align="center" valign="top"><table width="90%" cellpadding="1"  cellspacing="1" border="1" style="font-family: arial; font-size: 12px; border-collapse:collapse;""> 
        <thead>
          <tr>
            <td height="19" colspan="31" align="center" bordercolor="#000000" bgcolor="#999999"><strong>LAPORAN HARIAN SINAR EXPRESS</strong></td>
          </tr>
          <tr>
            <td width="23" rowspan="2" align="center" bordercolor="#000000" bgcolor="#999999">No</td>
            <td width="23" rowspan="2" align="center" bordercolor="#000000" bgcolor="#999999">Kategori</td>
            <td width="34" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Tgl Buat</td>
            <td width="39" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Tgl Kirim</td>
            <td height="19" colspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Delivery</td>
            <td width="36" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">No Body</td>
            <td colspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Driver</td>
            <td width="30" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">No STT</td>
            <td width="30" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Kode</td>
            <td width="89" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Keterangan Jenis</td>
            <td width="43" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Berat KG</td>
            <td width="34" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">JML Colli</td>
            <td width="49" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Harga Bruto</td>
            <td width="42" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Driver</td>
            <td colspan="4" align="center" bordercolor="#000000"  bgcolor="#999999">Penerima FEE</td>
            <td width="36" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Asuransi</td>
            <td width="36" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Bea Extra </td>
            <td width="53" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">NETTO</td>
		
            <td width="43" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Tgl</td>
            <td width="42" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Jumlah</td>
            <td width="43" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Penyetor</td>
            <td width="42" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">ID Setor</td>
            <td width="43" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">CC</td>
            <td width="42" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Lokasi</td>
            <td width="47" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Status</td>
            <td width="30" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">STT</td>
            <td width="116" rowspan="2" align="center" bordercolor="#000000"  bgcolor="#999999">Ket</td>
		
          </tr>
          <tr>
            <td width="32" height="19" align="center" bordercolor="#000000"  bgcolor="#999999">Asal</td>
            <td width="51" align="center" bordercolor="#000000"  bgcolor="#999999">Tujuan</td>
            <td width="27" align="center" bordercolor="#000000"  bgcolor="#999999">NIK</td>
            <td width="46" align="center" bordercolor="#000000"  bgcolor="#999999">Nama</td>
            <td width="43" align="center" bordercolor="#000000"  bgcolor="#999999">Pengirim (Rp)</td>
            <td width="42" align="center" bordercolor="#000000"  bgcolor="#999999">Penerima (Rp)</td>
            <td width="76" align="center" bordercolor="#000000"  bgcolor="#999999">Pengirim</td>
            <td width="76" align="center" bordercolor="#000000"  bgcolor="#999999">Penerima</td>
          </tr>
        </thead>
        <tbody>
          <?php
 function DateToIndo($date){
		$BulanIndo = array("01", "02", "03",
						   "04", "05", "06",
						   "07", "08", "09",
						   "10", "11", "12");
	
		$tahun = substr($date, 0, 4);  
        $bulan = substr($date, 5, 2);  
        $tgl   = substr($date, 8, 2);  
          
        $result = $tgl . "/" . $BulanIndo[(int)$bulan-1] . "/". $tahun;       
        return($result);  
	}
?>
          <?php


if (isset($_POST['submit'])) {
	$tgl_awal= $_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
$no=0;
$rw = mysql_query("select * from data_selesai_kirim WHERE tgl_setor BETWEEN '$tgl_awal' AND '$tgl_akhir' AND setor='Y' ORDER BY tgl_setor ASC") or die(mysql_error()); 

  while($s=mysql_fetch_array($rw)){
$batal=$s['id_she'];
$id_detailjuga=$s['id_detail'];
$id_kirimjuga=$s['id_kirim'];
$nama_barang=$s['nama_barang'];
$tgl_kirim=$s['tgl_kirim'];
$no_body=$s['no_body'];
$nic_sp=$s['nic_sp'];
$nama_sp=$s['nama_sp'];
$no_stt=$s['no_stt'];
$jml_setor=$s['jml_setor'];
$penyetor=$s['penerima_setor'];
$jml_barang=$s['jml_barang'];
$jml_colli=$s['jml_colli'];
$bruto=$s['total_biaya']+$s['jml_asuransi'];
$fee_driver=$s['fee_driver'];
$fee_agen_1=$s['fee_agen_1'];
$fee_agen_2=$s['fee_agen_2'];
$agen_penerima=$s['agen_penerima_fee'];
$stt_manual=$s['stt_manual'];
$beaToDoor=$s['beaToDoor'];
$jml_asuransi=$s['jml_asuransi'];
  $tgl_buat=$s['tgl_buat'];
  $ptd=$s['ptd'];
	  
$get_kode_st=mysql_query("select * from detail_pengiriman where id_detail='$id_detailjuga'")or die(mysql_error());
$rowkode_st=mysql_fetch_array($get_kode_st);
$kode_st=$rowkode_st['id_satuan'];
	  $get_kode_dt=mysql_query("select * from data_satuan where id_satuan='$kode_st'")or die(mysql_error());
	  	$rowkode_dt=mysql_fetch_array($get_kode_dt);
	  		$kode_dt=$rowkode_dt['nama_satuan'];	
			  $exp_bd = explode (' ', $no_body);
				$bd1 = $exp_bd[0];
				$bd2 = $exp_bd[1];
	  if($bd2=='DD'){
		  $kategory_bus='TB';} 
		  else if($bd2=='SS'){
			  $kategory_bus='SS';}
	  			else if($bd2=='T' or $bd2=='P'){
			  		$kategory_bus='BC';}
	  					else { $kategory_bus='AKAP';}
  
$get_doc=mysql_query("select * from data_pengiriman where id_kirim='$id_kirimjuga' GROUP BY id_kirim")or die(mysql_error());
$rowdoc=mysql_fetch_array($get_doc);
$id_kirimjuga=$rowdoc['id_kirim'];
  $id_konsumen=$rowdoc['id_konsumen'];
  $asal=$rowdoc['asal'];
  $tujuan=$rowdoc['tujuan'];
  
  $get_st=mysql_query("select * from data_setor where no_stt='$no_stt'")or die(mysql_error());
$rowst=mysql_fetch_array($get_st);
$ketsetor=$rowst['id_setor'];

 $get_nya=mysql_query("select * from log_setor where id_setor='$ketsetor' ")or die(mysql_error());
$rownya=mysql_fetch_array($get_nya);
$penyetor=$rownya['penyetor']; 
  $get_ket=mysql_query("select * from detail_pengiriman where id_kirim='$id_kirimjuga' GROUP BY id_kirim")or die(mysql_error());
$rowket=mysql_fetch_array($get_ket);
if (($fee_agen_1) and ($fee_agen_2) > 0){
			  $exp_ag = explode ('&', $agen_penerima);
				$ag1 = $exp_ag[0];
				$ag2 = $exp_ag[1];}
				else {$ag1=$agen_penerima;}
$no++;
  ?>
          
          <tr >
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $no?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $kategory_bus ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo (DateToIndo("$tgl_buat")) ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo (DateToIndo("$tgl_kirim"))  ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo ucwords(strtolower($asal)) ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo ucwords(strtolower($tujuan))?></td>
            <td bordercolor="#000000" bgcolor="#ffffff" class="str"><?php  echo $no_body?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $nic_sp?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo ucwords(strtolower($nama_sp))?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $no_stt?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $kode_dt?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo ucwords(strtolower($nama_barang))?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $jml_barang ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $jml_colli ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $bruto+$beaToDoor ;?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $fee_driver ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $fee_agen_1 ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if (($fee_agen_1) and ($fee_agen_2) > 1){ echo $fee_agen_2;} else {echo $fee_agen_2;}
																 ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if (($fee_agen_1) > 1){  echo ucwords(strtolower($asal));}else {echo "";}
																 ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if (($fee_agen_2) > 1){ echo ucwords(strtolower($tujuan));} else {echo "";}
                                 ?></td>
                                 
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $jml_asuransi ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if($ptd=='Y')
																{  echo "<font color='#F80105'>". -$rowket['beaToDoor'];}
                                                                if($ptd=='N')
																{ echo $rowket['beaToDoor'];} ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if($ptd=='Y')
																echo $bruto - $fee_driver -$fee_agen_1 -$fee_agen_2 ;
																if($ptd=='N')
																echo ($bruto - $fee_driver -$fee_agen_1 -$fee_agen_2)+$beaToDoor ;?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $rownya['tgl_setor']; ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if($ptd=='Y')
																{ echo $bruto - $fee_driver ; }
																if($ptd=='N')
																{ echo ($bruto - $fee_driver)+$beaToDoor; }?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo ucwords(strtolower($penyetor))?></td>
            <td bordercolor="#000000" bgcolor="#ffffff">&nbsp;</td>
            <td bordercolor="#000000" bgcolor="#ffffff">&nbsp;</td>
            <td bordercolor="#000000" bgcolor="#ffffff">&nbsp;</td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $rowket['keterangan']; ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  if($stt_manual=='Y') { echo 'STT Manual'; } ?></td>
            <td bordercolor="#000000" bgcolor="#ffffff"><?php  echo $s['ket_data']; ?></td>
            
        </tbody><?php } }?>
  </table>
