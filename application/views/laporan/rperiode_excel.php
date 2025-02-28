<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Periode.xls");
?>
<h3>Laporan Transaksi </h3>
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data" border="1">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tgl Transaksi</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Modal Satuan</th>
                <th>Total Modal</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Jumlah</th>
                <th>Potongan Barang</th>
                <th>Pembayaran</th>
                <th>Potongan Transaksi</th>
                <th>Laba</th>
                <th>Konsumen</th>
                <th>Pembuat</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php 
                 $no=1;
                 if(!empty($dataHarian)){ 
                  foreach ($dataHarian as $d) {	  
                      $datetime = new DateTime($d->tgl_buat);
                      $date = $datetime->format('d-m-Y');
                      $harga_beli=$d->harga_beli*$d->jumlah;
                      $potong_harga=$d->potongan*$d->jumlah;
                      $total_harga=$d->harga_dasar*$d->jumlah;
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $d->id_penjualan; ?></td>   
		<td><?php echo $d->tgl_buat; ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php echo number_format($d->harga_beli); ?></td>
		<td><?php echo number_format($harga_beli); ?></td>
		<td><?php echo number_format($d->harga_dasar); ?></td>
		<td><?php echo number_format($total_harga); ?></td>
		<td><?php echo $d->jumlah; ?></td>
		<td><?php echo number_format($potong_harga); ?></td>
		<td><?php echo number_format($d->total_harga); ?></td>
		<td><?php echo $d->jumlah_diskon; ?></td>
		<td><?php echo number_format($total_harga-$harga_beli-$potong_harga); ?></td>
		<td><?php echo $d->nama_konsumen; ?></td>
		<td><?php echo $d->pembuat; ?></td>
    </tr><?php
    $no++;
  }}
?>	</tbody><tfoot></tfoot>
    </table>