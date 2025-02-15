<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
			    <section class="content">
      <div class="container-fluid">
	<div class="row">
          <div class="col-md-6">
            <div class="card card-default">
              <!-- /.card-header --><div class="modal-content">
			    <div class="modal-header">
				
                     <h5 style="display:block; text-align:center;"> Barang Masuk Berdasarkan Invoice</h5>
			    </div>
			     <form id="form-tambah-invoice" name="form-tambah-invoice" method="POST">
			        <div class="modal-body">
						<div class="form-group row">
                    <label class="col-sm-4 col-form-label">Supplier</label>
                    <div class="col-sm-8">
                        <input type="hidden" name="pembuat" value="<?php echo $this->session->userdata['full_name']; ?>" class="form-control">
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
					<div class="form-group row">
                    <label class="col-sm-4 col-form-label">No Invoice</label>
                    <div class="col-sm-8">
                       <input type="text" name="no_invoice" class="form-control" id="no_invoice">
                    </div>
                    </div>	
						<div class="form-group row">
                    <label for="Kode Barang" class="col-sm-4 col-form-label">Kode Barang</label>
                    <div class="col-sm-8">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="kode_barang" id="kode_barang" class="form-control"
							   onBlur="riwayat(kode_barang.value)"
						onkeyup="riwayat(kode_barang.value)" onFocus="riwayat(kode_barang.value)" onChange="riwayat(kode_barang.value)" onKeyPress="riwayat(kode_barang.value)">
							<span class="input-group-append">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cari-barang"><i class="glyphicon glyphicon-plus-sign"><i class="fa fa-search"></i> Cari..</button></i>
                  </span>
                  </div>
				</div>
					
                    </div>			
					<div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tgl Expired</label>
                    <div class="col-sm-8">
                        <input type="text" name="tgl_expired" id="datepicker" value="" class="form-control datepicker datetimepicker" data-toggle="datetimepicker" data-target=".datepicker" data-format="yyy-mm-dd">
                    </div>
                        
                    </div>		
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                    <div class="col-sm-8">
                      <input type="text" name="jumlah" class="form-control" id="jumlah">
                    </div>
					</div>
						<div class="form-group row">
                    <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <input type="text" name="keterangan" class="form-control" id="keterangan">
                    </div>
					</div>
					

                        <input type="hidden" name="pembuat" value="<?php echo $this->session->userdata['full_name']; ?>" class="form-control">
            <div class="modal-footer justify-content-between">
			            <button class="btn btn-primary " type="submit"><span class="fa fa-save"></span> Simpan</button>
			        </div>
						
			    </form>
			    </div>
			</div>
			</div>
			</div>
		
  <?php echo $modal_cari_barang; ?>
<div class="col-md-6">
            <div class="card card-default">
              <!-- /.card-header --><div class="modal-content">
			    <div class="modal-header">
				
                     <h5 style="display:block; text-align:center;"> Detail Barang</h5>
			    </div> 
			        <div class="modal-body">
				<div id="detail_barang"></div>	
			    </div>
			</div>
			</div>
			</div>
			</div>