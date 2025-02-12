       <?php
  $no = 1;

  foreach ($data as $s) {
	  
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->kode_barang ?></td>
    <td><?php echo $s->nama_barang; ?></td>
    <td><?php echo $s->id_satuan; ?></td>
    <td><?php echo $s->nama_supplier; ?></td>
    <td><?php echo number_format($s->harga_beli); ?></td>
    <td><?php echo number_format($s->harga_eceran); ?></td>
    <td><?php echo $s->stok; ?></td>
    <td><?php echo $s->tgl_expired; ?></td>
		
      <td class="text-center">          
        <button class="btn btn-info btn-sm update-dataBarang" data-id="<?php echo $s->kode_barang; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
		  <?php //if ($userdata->pengguna_level !='1'){ echo '';} else{ ?>
		<button class="btn btn-success btn-sm update-stokBarang" data-id="<?php echo $s->kode_barang; ?>"><i class="glyphicon glyphicon-plus"></i> Edit Harga</button>
          <button class="btn btn-danger btn-sm delete-barang" data-toggle="modal" data-target="#konfirmasiHapus" data-id="<?php echo $s->kode_barang; ?>"><i class="fa fa-delete"></i> Hapus</button>
      </td>
    </tr>
    <?php 
	 $no++;
  }
?> 