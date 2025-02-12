<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
			    <div class="modal-content">
					
          <div class="card-header">
                     <h4 style="display:block; text-align:center;">Penambahan Stok Barang </h4>
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    </div>
			     <form id="form-stok-barang"method="POST">
			        <div class="modal-body">
						<div class="card-body">
							
					 <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
  <tbody>
    <tr>
      <td>Kode Barang</td>
      <td ><?php
                                            if (!empty($dataBarang->kode_barang)) {
                                                echo $dataBarang->kode_barang;
                                            }
                                            ?></td>
      <td>Nama Barang</td>
      <td><?php
                                            if (!empty($dataBarang->nama_barang)) {
                                                echo $dataBarang->nama_barang;
                                            }
                                            ?></td>
    </tr>
    <tr>
      <td>Satuan</td>
      <td>
        <?php
                                            if (!empty($dataBarang->nama_barang)) {
                                                echo $dataBarang->nama_satuan;
                                            }
                                            ?>
      </span></td>
      <td>Jml satuan</td>
      <td>
        <?php
                                            if (!empty($dataBarang->jml_satuan)) {
                                                echo $dataBarang->jml_satuan;
                                            }
                                            ?>
      </span></td>
    </tr>
    <tr>
      <td>Berat</td>
      <td>
        <?php if (!empty($dataBarang)) { echo $dataBarang->berat; } ?>
      </span></td>
      <td>Ukuran</td>
      <td>
        <?php
                                            if (!empty($dataBarang->ukuran)) {
                                                echo $dataBarang->ukuran;
                                            }
                                            ?>
      </span></td>
    </tr>
    <tr>
      <td>Supplier</td>
      <td>
        <?php
                                            if (!empty($dataBarang->nama_supplier)) {
                                                echo $dataBarang->nama_supplier;
                                            }
                                            ?>
      </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p></p>
						<div class="form-group row">
							
                 <input type="hidden" name="kode_barang" value="<?php if (!empty($dataBarang)) { echo $dataBarang->kode_barang; } ?>">
                    <label class="col-sm-2 col-form-label">No Invoice</label>
                    <div class="col-sm-4">
                       <input type="text" name="no_invoice" class="form-control" id="regular13">
                    </div>
                    </div>				
							<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="col-sm-4">
                       <input type="text" name="harga_beli" class="form-control" id="regular13">
                    </div>
					<label class="col-sm-2 col-form-label">Harga Jual Satuan</label>
                    <div class="col-sm-4">
                       <input type="text" name="harga_satuan" class="form-control" id="regular13">
                    </div>
                    </div>	
					<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Eceran</label>
                    <div class="col-sm-4">
                       <input type="text" name="harga_eceran" class="form-control" id="regular13">
                    </div>
					<label class="col-sm-2 col-form-label">Harga Reseller</label>
                    <div class="col-sm-4">
                        <input type="text" name="harga_reseller" class="form-control" id="regular13">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-4">
						<input type="hidden" name="jumlah" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->stok)) {
                                                echo $dataBarang->stok;
                                            }
                                            ?>" required>
                      <input type="text" name="stok" class="form-control" id="regular13">
                    </div>
					<label class="col-sm-2 col-form-label">Tgl Expired</label>
                    <div class="col-sm-4">
                        <input type="text" name="tgl_expired" id="datepicker" value="" class="form-control datepicker datetimepicker" data-toggle="datetimepicker" data-target=".datepicker" data-format="yyy-mm-dd">
                    </div>
                        
                    </div>

									
			        </div>
			    </div>

                        <input type="text" name="pembuat" value="<?php echo $userdata->pengguna_nama; ?>" class="form-control">
            <div class="modal-footer justify-content-between">
			            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
			            <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span> Simpan</button>
			        </div>
			    </form>
			    </div>
			</div>
<script type="text/javascript">
$('#datepicker').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});
</script>