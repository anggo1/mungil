
<?php
$date= date('d-m-Y');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Barang $date.xls");
?>
<h3>Data Penjualan Harian <?php echo $date ?></h3>
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>       
     <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
        <tr>
          <th width="20">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Berat</th>
                <th>Ukuran</th>
                <th>Satuan</th>
                <th>Supplier</th>
                <?php  if ($userdata->pengguna_level =='1'){ ?>
                <th>Modal</th><?php } ?>
                <th>H Karton</th>
                <th>H Eceran</th>
                <th>H Grosir</th>
                <th>H Reseller</th>
                <th>H Gofood</th>
                <th>H Grabfood</th>
                <th>H Shopee</th>
                <th>H Tokped</th>
                <th>H Lainnye</th>
                <th>Stok</th>
                <th>Tgl Exp</th>
        </tr>
     </thead>
            <tbody>
                  <?php
  $no = 1;

  foreach ($data as $s) {
	  
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->kode_barang ?></td>
    <td><?php echo $s->nama_barang; ?></td>
    <td><?php echo $s->berat; ?></td>
    <td><?php echo $s->ukuran; ?></td>
    <td><?php echo $s->nama_satuan; ?></td>
    <td><?php echo $s->nama_supplier; ?></td>
    <?php  if ($userdata->pengguna_level =='1'){ ?><td><?php echo number_format($s->harga_beli); ?></td><?php } ?>
    <td><?php echo number_format($s->harga_karton); ?></td>
    <td><?php echo number_format($s->harga_eceran); ?></td>
    <td><?php echo number_format($s->harga_grosir); ?></td>
    <td><?php echo number_format($s->harga_reseller); ?></td>
    <td><?php echo number_format($s->harga_gofood); ?></td>
    <td><?php echo number_format($s->harga_grabfood); ?></td>
    <td><?php echo number_format($s->harga_shopee); ?></td>
    <td><?php echo number_format($s->harga_tokped); ?></td>
    <td><?php echo number_format($s->harga_lainnya); ?></td>
    <td><?php echo $s->stok; ?></td>
    <td><?php echo $s->tgl_expired; ?></td>

    </tr>
    <?php 
	 $no++;
  }
?> 
                          </tbody><tfoot></tfoot>
    </table>