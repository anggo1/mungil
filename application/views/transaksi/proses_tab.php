<form id="form-proses-pengiriman" method="POST">
                <div class="card-body">


                  <div class="form-group row">
                    <label for="No Rekamedis" class="col-sm-2 col-form-label">Satuan Jenis</label>
                    <div class="col-sm-4">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="hidden" name="id_konsumen" id="id_konsumen" class="form-control">
                        <input type="text" name="nama" id="nama" class="form-control">
							<span class="input-group-append">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cari-konsumen"><i class="glyphicon glyphicon-plus-sign"><i class="fa fa-search"></i> Cari..</button></i>
                  </span>
                  </div>
				</div>
					<label class="col-sm-2 col-form-label">ID Kirim</label>
                    <div class="col-sm-4">
                        <input type="text" name="id_kirim" id="id_kirim" value="<?php foreach($dataPengiriman as $data){echo $data->id_kirim; } echo $kodeBaru?>" class="form-control">
                    </div>
                  </div>
					<div id="riwayat"></div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-4">
                        <input type="text" name="penerima" id="penerima" class="form-control">
                    </div>
					<label class="col-sm-2 col-form-label">Colli</label>
                    <div class="col-sm-4">
                        <input type="text" name="tlp_penerima" id="tlp_penerima" class="form-control">
                    </div>
                    </div>
					<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jumlah / Kg</label>
                    <div class="col-sm-4">
                        <input type="text" name="penerima" id="penerima" class="form-control">
                    </div>
					<label class="col-sm-2 col-form-label">Harga Satuan</label>
                    <div class="col-sm-4">
                        <input type="text" name="tlp_penerima" id="tlp_penerima" class="form-control">
                    </div>
                    </div>
					<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bea To Door</label>
                    <div class="col-sm-4">
                        <input type="text" name="tlp_penerima" id="tlp_penerima" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">Minimum Charge ?</label>
					<div class="col-sm-4">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess1">
                        <label for="checkboxSuccess1">
                        </label>
                      </div>
                    </div>

                    </div>
					<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ket Pengiriman</label>
                    <div class="col-sm-4 select2-purple">
                    <select name="status_pasien" class="form-control select2-purple" data-dropdown-css-class="select2-purple" style="width: 100%;" >
                            <option value="" selected>Pilih status ...</option>
                            <option value="REG">REG</option>
                            <option value="ONS">ONS</option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Non Minimum Charge ?</label>
					<div class="col-sm-4">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess2">
                        <label for="checkboxSuccess2">
                        </label>
                      </div>
                    </div>

                    </div>

					<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Diskon ?</label>
                    <div class="col-sm-4">
					<div class="icheck-primary d-inline">
                        <input type="radio" name="pembayaran" value="Y" id="radioSuccess3">
                        <label for="radioSuccess3"> Persen
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" name="pembayaran" value="Y" id="radioSuccess4">
                        <label for="radioSuccess4"> Kg
                        </label>
                      </div>
                    </div>
						<label class="col-sm-2 col-form-label">Status Asuransi ?</label>
					<div class="col-sm-4">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxSuccess3">
                        <label for="checkboxSuccess3">
                        </label>
                      </div>
                    </div>
                    </div>


        <div class="col-sm-12 margin pull-right">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan</button>
        </div>
                </div>
    </div>