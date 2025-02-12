<?php
  $no = 1;
  foreach ($datalaplaka as $laporan) {
    ?>
    <tr>
      			<td><?php echo $no; ?></td>
      			<td><?php  echo $laporan->no_kasus; ?></td>
                <td><?php  echo $laporan->no_surat; ?></td>
                <td><?php  echo tgl_indo($laporan->tgl_lapor); ?></td>
                <td><?php  echo $laporan->no_body;?></td>
                <td><?php  echo $laporan->nic_sp;?></td>
                <td><?php  echo tgl_indo($laporan->tgl_masuk_png); ?></td>
                <td><?php  echo $laporan->nic_kr;?></td>
                <td><?php  echo $laporan->petugas;?></td>
                <td><?php  echo $laporan->pembuat;?></td>
      <td class="text-center" style="min-width:230px;">
      <button class="btn btn-success cetak-datalaplaka" data-id="<?php  echo $laporan->no_kasus; ?>"><i class="glyphicon glyphicon-print"></i> Print</button>
          <button class="btn btn-warning update-datalaporan" data-id="<?php  echo $laporan->no_kasus; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
          <button class="btn btn-info detail-datalaporan" data-id="<?php  echo $laporan->no_kasus; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>