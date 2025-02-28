<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapitulasi Konsumen.xls");
?>
                     <?php if(!empty($dataKonsumen)){ ?>
<h3>Rekapitulasi Konsumen</h3>
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data" border="1">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Nama Konsumen</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Jumlah Transaksi</th>
                <th>Nominal Transaksi</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataKonsumen as $d) {	  
	  $total =$d->total_transaksi;
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $d->nama_konsumen; ?></td>   
		<td><?php echo $d->alamat; ?></td>
		<td><?php echo $d->no_telp; ?></td>
		<td <?php if($total >= 10){ echo 'bgcolor="#0BE19B"';} else if($total >=5){ echo 'bgcolor="#F3D403"';}?> ><?php echo $total; ?></td>
		<td><?php echo number_format($d->jml_transaksi); ?></td>
    </tr><?php
    $no++;
  }
?><?php } ?>	</tbody><tfoot></tfoot>
    </table>
                      <table width="35%" border="0">
        <tbody>
          <tr>
            <td width="28%">Keterangan Warna :</td>
            <td width="23%" align="right">Transaksi > 10</td>
            <td width="10%" bgcolor="#0BE19B">&nbsp;</td>
            <td width="29%" align="right">Transaksi > 5 < 10</td>
            <td width="10%" bgcolor="#F3D403">&nbsp;</td>
          </tr>
        </tbody>
      </table>