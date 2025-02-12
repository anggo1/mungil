<div class="card card-first">
    <div class="card-header">
        <h3 class="card-title">
            <h4 class="modal-title" style="display:block; text-align:center;">
                Pencarian Harga Barang</h4>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover display responsive nowrap" id="table-barang">
                <thead>
                    <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang </th>
                        <th>Satuan</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
  $no = 1;
  foreach ($dataBrg as $h) {
    ?>
                    <tr onClick="javascript:selectHarga('<?php echo $h->kode_barang ?>',
						 '<?php echo $h->nama_barang ?>','<?php echo $h->harga_eceran ?>',
						 '<?php echo $h->nama_satuan ?>')">
                        <td><?php echo $h->kode_barang?></td>
                        <td><?php echo $h->nama_barang?></td>
                        <td><?php echo $h->nama_satuan?></td>
                        <td><?php echo $h->nama_supplier?></td>
                    </tr>
                    <?php
  }
?>
                </tbody>
            </table>
        </div>
    </div>
</div>