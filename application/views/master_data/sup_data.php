       <?php
  $no = 1;
  foreach ($data as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->nama_supplier; ?></td>
    <td><?php echo $s->telp; ?></td>
    <td><?php echo $s->alamat; ?></td>

      <td class="text-center">
        <button class="btn btn-info btn-sm update-dataSupplier" data-id="<?php echo $s->id_supplier; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
		  <button class="btn btn-danger btn-sm delete-supplier" data-toggle="modal" data-target="#konfirmasiHapus" data-id="<?php echo $s->id_supplier; ?>"><i class="fa fa-delete"></i> Hapus</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 