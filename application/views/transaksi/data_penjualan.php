<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped  table-bordered table-hover nowrap responsive"
                                    id="list-penjualan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
  $no = 1;

foreach ($dataDetail as $s) {
  
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->kode_barang ?></td>
    <td <?php if($s->status=='EP'){echo 'bgcolor="#18F360"';}?>><?php echo $s->nama_barang ?></td>
    <td title="Double click Untuk Edit Dan Tekan Enter untuk Simpan"
                                onclick="this.contentEditable=true; this.className='inEdit';"
                                onblur="this.contentEditable=false; this.className='inEdit';"
                                onkeypress="saveData(event,'<?php echo $s->id_penjualan; ?>','<?php echo $s->id_detail; ?>','<?php echo $s->harga; ?>',$(this).html() )">
                                <?php echo $s->jumlah; ?></td>
    <td><?php echo $s->satuan ?></td>
    <td><?php echo number_format($s->harga) ?></td>
    <td><?php echo number_format($s->total_harga) ?></td>
     <td class="text-center">
		 <button class="btn bg-gradient-danger btn-sm delete-detail" data-id="<?php echo $s->id_detail; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="fa fa-times"></i></button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 

</tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
<script language="javascript">
var MyTable = $('#list-penjualan').dataTable({
    "responsive": false,
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true
});
function saveData(e, idp, id, hrg_part, jml_part) {
    if (e.keyCode === 13) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Penjualan/updateDetailPenjualan')?>",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'id': id,
                'hrg_part': hrg_part,
                'jml_part': jml_part,
            },
            success: function(response) {

              tampilDetailkirim(idp);
            }
        });
    }
}
</script>