       <?php
  $no = 1;
  foreach ($data as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->nama_satuan; ?></td>

      <td class="text-center">
        <button class="btn btn-info btn-sm update-dataSatuan" data-id="<?php echo $s->id_satuan; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 