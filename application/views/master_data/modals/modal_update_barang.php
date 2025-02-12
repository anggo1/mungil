<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
<div class="modal-content">

    <div class="card-header">
        <h5 style="display:block; text-align:center;">Edit Harga Barang </h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <form id="form-stok-barang" method="POST">
        <div class="modal-body">
            <div class="card-body">
                <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                    <tbody>
                        <tr>
                            <td>Kode Barang</td>
                            <td><?php
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
                                                echo $dataBarang->id_satuan;
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

                    <input type="hidden" name="kode_barang"
                        value="<?php if (!empty($dataBarang)) { echo $dataBarang->kode_barang; } ?>">
                    <input type="hidden" name="nama_barang"
                        value="<?php if (!empty($dataBarang)) { echo $dataBarang->nama_barang; } ?>">

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="col-sm-4">
                        <input type="text" name="harga_beli" class="form-control" id="regular13"
                            value="<?php if (!empty($dataBarang)) { echo $dataBarang->harga_beli; } ?>">
                    </div>
                    <label class="col-sm-2 col-form-label">Harga Eceran</label>
                    <div class="col-sm-4">
                        <input type="text" name="harga_eceran" class="form-control" id="regular13"
                            value="<?php if (!empty($dataBarang)) { echo $dataBarang->harga_eceran; } ?>">
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" name="pembuat" value="<?php echo $this->session->userdata['full_name']; ?>"
            class="form-control">
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