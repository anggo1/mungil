<?php if(!empty($dataBarang)){foreach ($dataBarang as $dataBarang){}} ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 style="display:block; text-align:center;"> Barang Promo / Diskon</h5>
                        </div>
                        <form id="form-tambah-promo" name="form-tambah-promo" method="POST">
                            <div class="modal-body">
                              <div class="card-body">

                                <div class="form-group row">
                                    <label for="Kode Barang" class="col-sm-4 col-form-label">Kode Barang</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="kode_barang" id="kode_barang" class="form-control"
                                                onBlur="riwayat(kode_barang.value)" onkeyup="riwayat(kode_barang.value)"
                                                onFocus="riwayat(kode_barang.value)"
                                                onChange="riwayat(kode_barang.value)"
                                                onKeyPress="riwayat(kode_barang.value)">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#cari-barang"><i
                                                        class="glyphicon glyphicon-plus-sign"><i
                                                            class="fa fa-search"></i> Cari..</button></i>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="nama_barang" id="nama_barang"
                                                        class="form-control" onkeydown="f(this)" onkeyup="f(this)"
                                                        onkeypress="return handleEnter(this, event)">
                                                    <input type="hidden" name="harga_eceran" id="harga_eceran"
                                                        class="form-control" onkeydown="f(this)" onkeyup="f(this)"
                                                        onkeypress="return handleEnter(this, event)">
                                                </div>


                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Tgl Promo / Diskon</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="tgl_awal" id="datepicker" value=""
                                            class="form-control datepicker datetimepicker" data-toggle="datetimepicker"
                                            data-target=".datepicker" data-format="yyy-mm-dd">
                                    </div>
                                    
                                    <label class="col-sm-2 col-form-label">Sampai dengan</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="tgl_akhir" id="datepicker1" value=""
                                            class="form-control datepicker1 datetimepicker" data-toggle="datetimepicker"
                                            data-target=".datepicker1" data-format="yyy-mm-dd">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Bentuk Promo</label>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="promo" value="P" id="radioSuccess3" checked>
                                        <label for="radioSuccess3"> Persen
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="promo" value="R" id="radioSuccess4">
                                        <label for="radioSuccess4"> Rupiah
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Jumlah Promo</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="jml_promo" class="form-control" id="jml_promo">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="keterangan" class="form-control" id="keterangan">
                                    </div>
                                </div>


                                <input type="hidden" name="pembuat"
                                    value="<?php echo $this->session->userdata['full_name']; ?>" class="form-control">
                                <div class="modal-footer justify-content-between">
                                    <button class="btn btn-primary " type="submit"><span class="fa fa-save"></span>
                                        Simpan</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <?php echo $modal_cari_barang; ?>
        <!-- <div class="col-md-6">
            <div class="card card-default">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 style="display:block; text-align:center;"> Detail Barang</h5>
                    </div>
                    <div class="modal-body">
                        <div id="detail_barang"></div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <script type="text/javascript">
    $('#datepicker,#datepicker1').datetimepicker({
        format: 'DD-MM-YYYY',
        date: moment()
    });

    window.onload = function() {
        //tampilSatuan();
    }

    function refresh() {
        MyTable = $('#list-data,#table-1,#table-2,#table-barang').dataTable();
    }


    function effect_msg_form() {
        // $('.form-msg').hide();
        $('.form-msg').show(500);
        setTimeout(function() {
            $('.form-msg').fadeOut(500);
        }, 1000);
    }

    function effect_msg() {
        // $('.msg').hide();
        $('.msg').show(500);

        //toastr.success(data.message, 'Adding New Pegawai');
        setTimeout(function() {
            $('.msg').fadeOut(500);
        }, 1000);
    }

    var MyTable = $('#list-data,#table-1').dataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
    var MyTable = $('#table-setor').dataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "pageLength": 5
    });

    $('#form-tambah-promo').submit(function(e) {
        var data = $(this).serialize();

        $.ajax({
                method: 'POST',
                url: '<?php echo base_url('Promo/prosesPromo'); ?>',
                data: data
            })
            .done(function(data) {
                var out = jQuery.parseJSON(data);


                if (out.status == 'form') {
                    $('.form-msg').html(out.msg);
                    toastr.error(out.msg);
                    //effect_msg_form();
                } else {
                    document.getElementById("form-tambah-promo").reset();
                    toastr.success(out.msg);
                    //$('#tambah-konsumen').modal('hide');
                    $('.msg').html(out.msg);
                }
            })

        e.preventDefault();
    });

    function next(datakode) {
        document.getElementById('kode_keluar').value = datakode;
        d.setAttribute('data-id', datakode, );
    }

    function tampilBarang(datakode) {
        $.get('<?php echo base_url('Invoice/list_keluar'); ?>', function(data) {
            MyTable.fnDestroy();
            $('#barang-keluar').html(data);
            refresh();
        });
    }

    function autotab(original, destination) {
        if (original.getAttribute && original.value.length == original.getAttribute("maxlength"))
            destination.focus()
    }

    function f(o) {
        o.value = o.value.toUpperCase().replace(/([^0-9A-Z(),-/ .])/g, "");
    }

    function fn(o) {
        o.value = o.value.toUpperCase().replace(/([^0-9A-Z()/ .])/g, "");
    }


    function fn(o) {
        o.value = o.value.toUpperCase().replace(/([^0-9A-Z()/ .])/g, "");
    }

    function selectHarga(kode_barang, nama_barang, harga_eceran) {
        document.getElementById('kode_barang').value = kode_barang;
        document.getElementById('nama_barang').value = nama_barang;
        document.getElementById('harga_eceran').value = harga_eceran;
		//riwayat(kode_barang);
        $ ('#cari-barang'). modal ('hide');
  }
    </script>