<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
			    <div class="modal-content">
			    <div class="modal-header">
                     <h4 style="display:block; text-align:center;"><?php if (!empty($dataBarang->id_barang)) {
                            echo 'Edit  Data Barang';
                        } else { echo 'Penambahan Data Barang1';}
                        ?></h4>
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    </div>
			     <form <?php if (empty($dataBarang->id_barang)) {echo 'id="form-tambah-barang"';} else { echo 'id="form-update-barang"';}?> method="POST">
			        <div class="modal-body">
									<div class="form-group">
										<label for="regular13" class="col-sm-3 control-label">Kode</label>
										<div class="col-sm-12">
											<input type="hidden" name="id_barang" value="<?php if (!empty($dataBarang)) { echo $dataBarang->id_barang; } ?>">
                                            <input type="text" name="kode_barang" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->kode_barang)) {
                                                echo $dataBarang->kode_barang;
                                            }
                                            ?>"  required>
										</div>
									</div>
                        
									<div class="form-group">
										<label for="regular13" class="col-sm-3 control-label">Nama Barang</label>
										<div class="col-sm-12">
											<input type="text" name="nama_barang" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->nama_barang)) {
                                                echo $dataBarang->nama_barang;
                                            }
                                            ?>" required>
										</div>
									</div>
                        
									<div class="form-group">
										<label for="select13" class="col-sm-3 control-label">Satuan</label>
										<div class="col-sm-12">
											<select name="id_satuan" class="form-control" >
                                                    <option value="" >Pilih Satuan...</option>
                                                   <?php
                                                   if(empty($dataBarang)){
                                                    foreach ($dataSat as $sat) {
                                                        ?>
                                                        <option <?php echo $sat == $sat->id_satuan ? 'selected="selected"' : '' ?> 
                                                            value="<?php echo $sat->id_satuan ?>"><?php echo $sat->nama_satuan ?></option>
                                                        <?php
                                                        }
                                                    }else {
                                                foreach ($dataSat as $ss) {          ?>
                                      <option value="<?php echo $ss->id_satuan; ?>" <?php if($ss->id_satuan == $dataBarang->id_satuan){echo "selected='selected'";} ?>><?php echo $ss->nama_satuan; ?></option>
                                      <?php
                                    }}
                                    ?>
                                                </select> 
										</div>
									</div>
									<div class="form-group">
										<label for="select13" class="col-sm-3 control-label">Supplier</label>
										<div class="col-sm-12">
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
										</div>
									</div>

									<div class="form-group">
										<label for="textarea13" class="col-sm-3 control-label">Harga</label>
										<div class="col-sm-12">
                                            <input type="text" name="harga" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->harga)) {
                                                echo $dataBarang->harga;
                                            }
                                            ?>" required>
										</div>
									</div>

									<div class="form-group">
										<label for="regular13" class="col-sm-3 control-label">Jumlah</label>
										<div class="col-sm-12">
											<input type="text" name="stok" class="form-control" id="regular13" value="<?php
                                            if (!empty($dataBarang->stok)) {
                                                echo $dataBarang->stok;
                                            }
                                            ?>" required>
										</div>
									</div>
									
			        </div>
			        <div class="modal-footer">
			            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
			            <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span> Simpan</button>
			        </div>
			    </form>
			    </div>
			    </div>
			</div>