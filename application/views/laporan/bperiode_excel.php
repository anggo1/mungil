<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Periode.xls");
?>
                     <?php if(!empty($dataBarang)){ ?>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="list-data" border="1">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Tgl Transaksi</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Modal Satuan</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Keterangan</th>
                <th>Pembuat</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataBarang as $d) {	  
	  $datetime = new DateTime($d->tgl_keluar);
      $date = $datetime->format('d-m-Y');
	  $harga_beli=$d->harga_beli*$d->jumlah;
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $date  ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php echo number_format($d->harga_beli); ?></td>
		<td><?php echo $d->jumlah; ?></td>
		<td><?php echo number_format($harga_beli); ?></td>
		<td><?php echo $d->keterangan; ?></td>
		<td><?php echo $d->pembuat; ?></td>
    </tr><?php
    $no++;
  }
?><?php } ?>	</tbody><tfoot></tfoot>
    </table>