
<?php
  $no = 1;

foreach ($dataDetail as $s) {
  
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->kode_barang ?></td>
    <td <?php if($s->status=='EP'){echo 'bgcolor="#18F360"';}?>><?php echo $s->nama_barang ?></td>
    <td><?php echo $s->jumlah ?></td>
    <td><?php echo $s->satuan ?></td>
    <td><?php echo number_format($s->harga) ?></td>
    <td><?php echo number_format($s->total_harga) ?></td>
     <td class="text-center">
		 <button class="btn bg-gradient-danger btn-sm delete-detail" data-id="<?php echo $s->id_detail; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="fa fa-times"></i></button>
		<button class="btn bg-gradient-warning btn-sm edit-detail" data-id="<?php echo $s->id_detail; ?>"><i class="fa fa-edit"></i></button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 