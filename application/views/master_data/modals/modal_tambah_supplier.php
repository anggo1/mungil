<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="col-12 col-md-12 col-lg-12">
			<div class="modal-header">

				<?php
if (!empty($dataSupplier)){
             foreach ($dataSupplier as $dataSupplier){				 
			 }}
?>
  <p></span><h4 style="display:block; text-align:center;"><?php if (!empty($dataSupplier->id_supplier)) {
                            echo 'Edit Data Supplier';
                        } else { echo 'Penambahan Data Supplier';}
                        ?></h4>
					</p></div><div class="modal-body">
  <form <?php if (empty($dataSupplier->id_supplier)) {echo 'id="form-tambah-supplier"';} else { echo 'id="form-update-supplier"';}?> method="POST">
    <div class="form-group">
      <input type="hidden" name="id_supplier" value="<?php if (!empty($dataSupplier->id_supplier)) { echo $dataSupplier->id_supplier; } ?>">
          </div>
	  <div class="input-group form-group">
      <input type="text" class="form-control" placeholder="Nama Suplier" value="<?php
                        if (!empty($dataSupplier->nama_supplier)) {
                            echo $dataSupplier->nama_supplier;
                        }
                        ?>" name="nama_supplier" aria-describedby="sizing-addon2">	

    </div>
      <div class="input-group form-group">
      <input type="text" class="form-control" placeholder="Telp Suplier" value="<?php
                        if (!empty($dataSupplier->telp)) {
                            echo $dataSupplier->telp;
                        }
                        ?>" name="telp" aria-describedby="sizing-addon2">	

    </div>
      <div class="input-group form-group">
      <input type="text" class="form-control" placeholder="Alamat Suplier" value="<?php
                        if (!empty($dataSupplier->alamat)) {
                            echo $dataSupplier->alamat;
                        }
                        ?>" name="alamat" aria-describedby="sizing-addon2">	

    </div>

	  <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div></form>
    </div>
  </form>
</div>
</div>
</div>