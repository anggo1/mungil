<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
			    <section class="content">
      <div class="container-fluid">
	<div class="row">
          <div class="col-md-6">
            <div class="card card-default">
              <!-- /.card-header --><div class="modal-content">
			    <div class="modal-header">
				
                     <h5 style="display:block; text-align:center;"> Input Barang Keluar</h5>
			    </div>
			     <form id="form-keluar-barang" name="form-keluar-barang" method="POST">
			        <div class="modal-body">                    
                        <input type="hidden" name="pembuat" value="<?php echo $userdata->pengguna_nama; ?>" class="form-control">
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
					

                        <input type="hidden" name="pembuat" value="<?php echo $userdata->pengguna_nama; ?>" class="form-control">
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
			</div>  
          <!--
<div class="col-md-12">
            <div class="card card-default">
              <div class="modal-content">
			    <div class="modal-header">				
                     <h5 style="display:block; text-align:center;"> List Barang Keluar</h5>
			    </div> 
			        <div class="modal-body">
				<div id="barang-keluar"></div>	
			    </div>
			</div>
			</div>
			</div>
			</div> -->