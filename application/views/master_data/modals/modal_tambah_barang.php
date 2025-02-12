<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
			    <div class="modal-content">
			    <div class="modal-header">
                     <h4 style="display:block; text-align:center;"><?php if (!empty($dataBarang->kode_barang)) {
                            echo 'Edit  Data Barang';
                        } else { echo 'Penambahan Data Barang';}
                        ?></h4>
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    </div>
			     <form <?php if (empty($dataBarang->kode_barang)) {echo 'id="form-tambah-barang"';} else { echo 'id="form-update-barang"';}?> method="POST">
			        <div class="modal-body">
						<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-4">
                          <input type="text" name="kode_barang" class="form-control" onkeypress="return handleEnter(this, event)" id="regular13"
							 <?php if (!empty($dataBarang->kode_barang)) {
                            echo 'readonly';}
                        ?> value="<?php
                                            if (!empty($dataBarang->kode_barang)) {
                                                echo $dataBarang->kode_barang;
                                            }
                                            ?>"  required>
                    </div>
					<label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama_barang" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->nama_barang)) {
                                                echo $dataBarang->nama_barang;
                                            }
                                            ?>" required>
                    </div>
                    </div>
						<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-4">
                     <select name="id_satuan" class="form-control" >
                                                    <option value="" >Pilih Satuan...</option>
                                                   <?php
                                                   if(empty($dataBarang)){
                                                    foreach ($dataSat as $sat) {
                                                        ?>
                                                        <option <?php echo $sat == $sat->nama_satuan ? 'selected="selected"' : '' ?> 
                                                            value="<?php echo $sat->nama_satuan ?>"><?php echo $sat->ket ?></option>
                                                        <?php
                                                        }
                                                    }else {
                                                foreach ($dataSat as $ss) {          ?>
                                      <option value="<?php echo $ss->nama_satuan; ?>" <?php if($ss->nama_satuan == $dataBarang->nama_satuan){echo "selected='selected'";} ?>><?php echo $ss->nama_satuan; ?></option>
                                      <?php
                                    }}
                                    ?>
                                                </select> 
                    </div>
					<label class="col-sm-2 col-form-label">Jml Satuan</label>
                    <div class="col-sm-4">
                        <input type="text" name="jml_satuan" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->jml_satuan)) {
                                                echo $dataBarang->jml_satuan;
                                            }
                                            ?>" required>
                    </div>
                    </div>
						<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-4">
                        <select id="select13" name="id_supplier" class="form-control" required>
											 <option value="" >Pilih Supplier...</option>
                                                   <?php
                                                   if(empty($dataBarang)){
                                                    foreach ($dataSup as $sup) {
                                                        ?>
                                                        <option <?php echo $sup == $sup->id_supplier ? 'selected="selected"' : '' ?> 
                                                            value="<?php echo $sup->id_supplier ?>"><?php echo $sup->nama_supplier ?></option>
                                                        <?php
                                                        }
                                                    }else {
                                                foreach ($dataSup as $sp) {          ?>
                                      <option value="<?php echo $sp->id_supplier; ?>" <?php if($sp->id_supplier == $dataBarang->id_supplier){echo "selected='selected'";} ?>><?php echo $sp->nama_supplier; ?></option>
                                      <?php
                                    }}
                                    ?>
                                                </select> 
                    </div><label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" name="ket" id="ket" value="<?php
                                            if (!empty($dataBarang->ket)) {
                                                echo $dataBarang->ket;
                                            }
                                            ?>" class="form-control" >
                    </div>

									
			        </div>
			        
            <div class="modal-footer justify-content-between">
			            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
			            <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span> Simpan</button>
			        </div>
			    </form>
			    </div>
			    </div>
			</div>