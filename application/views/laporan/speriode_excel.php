<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapitulasi Supplier.xls");
?>
                     <?php if(!empty($dataSupplier)){ ?>
<h3>Rekapitulasi Supplier</h3>
					
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data" border="1">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Nama Supplier</th>
                <th>No Invoice</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Expired</th>
                <th>Tanggal Input</th>
                <th>Pembuat</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataSupplier as $d) {	  
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $d->nama_supplier; ?></td>   
		<td><?php echo $d->no_invoice; ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php echo $d->jumlah; ?></td>
		<td><?php echo $d->tgl_expired; ?></td>
		<td><?php echo $d->tgl_input; ?></td>
		<td><?php echo $d->pengguna; ?></td>
    </tr><?php
    $no++;
  }
?><?php } ?>	</tbody><tfoot></tfoot>
    </table>