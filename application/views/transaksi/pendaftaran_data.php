       <?php
  $no = 1;
  foreach ($dataPendaftaran as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->nama_pasien ?></td>
    <td><?php echo $s->no_rawat ?></td>
    <td><?php echo $s->tanggal_daftar ?></td>
    <td><?php echo $s->nama_poli ?></td>
    <td><?php echo $s->nama_dokter ?></td>
    <td><?php echo $s->status_pasien ?></td>

      <td class="text-center">
        <button class="btn bg-gradient-danger btn-sm konfirmasiHapus-daftar" data-id="<?php echo $s->id_reg; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="fa  fa-times-circle"></i> Batal</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 