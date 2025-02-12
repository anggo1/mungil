       <?php
  $no = 1;
  foreach ($dataJabatan as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->no_body; ?></td>
    <td><?php echo $s->no_pol; ?></td>
    <td><?php echo $s->keur; ?></td>
    <td><?php echo $s->ket; ?></td>

      <td class="text-center">
      <button class="btn btn-info btn-sm update-datacargo" data-id="<?php echo $s->no_body; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 