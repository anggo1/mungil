					<div class="row ">
					    <div class="col-12 ">
					        <div class="card card-first card-outline">
					            <div class="card-body">
					                <div class="table-responsive">
					                    <table class="table table-striped  table-bordered table-hover dt-responsive nowrap"
					                        id="table-pertanggal">
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
					                                <th>Pot Barang</th>
					                                <th>Pembayaran</th>
					                                <th>Pot Transaksi</th>
					                                <th>Laba</th>
					                                <th>Pembuat</th>
					                            </tr>
					                        </thead>
					                        <tbody>

					                            <?php
  $no = 1;
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
					                                <td><?php echo tglIndoPendek($d->tgl_buat) ?></td>
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
					                                <td><?php echo $d->pembuat; ?></td>
					                            </tr><?php
    $no++;
  }
?>
					                        </tbody>
					                        <tfoot></tfoot>
					                    </table>
					                </div>
					            </div>

					        </div>
					    </div>
					</div>
					<script type="text/javascript">
var MyTable = $('#table-pertanggal').dataTable({
    "responsive": true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true
})
					</script>