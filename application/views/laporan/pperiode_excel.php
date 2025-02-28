<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Periode Promo.xls");
?>
                     <?php if(!empty($dataPromo)){ ?>
<h3>Laporan Periode Promo</h3>
					
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data" border="1">
                        <thead>  
        <tr>
          <th>No</th>
               <th>Tgl Promo</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Promo</th>
                <th>awal</th>
                <th>Akhir</th>
                <th>Jumlah Promo</th>
                <th>Keterangan</th>
                <th>Tgl Input</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataPromo as $d) {	  
	  $datetime = new DateTime($d->tgl_promo);
      $date = $datetime->format('d-m-Y');
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $date  ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php if($d->promo=='R'){echo'Rupiah';}else{echo'Persen';} ?></td>
		<td><?php echo $d->tgl_awal; ?></td>
		<td><?php echo $d->tgl_akhir; ?></td>
		<td><?php if($d->promo=='R'){echo  number_format($d->jml_promo);}else{echo $d->jml_promo. ' %';} ?></td>
		<td><?php echo $d->keterangan; ?></td>
		<td><?php echo $d->tgl_input; ?></td>
    </tr><?php
    $no++;
  }
?><?php } ?>	</tbody><tfoot></tfoot>
    </table>