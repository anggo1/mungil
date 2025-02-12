<div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('form-msg'); ?>
</div>
<div class="row">
    <div class="col-12 ">
        <div class="card card-primary card-outline ">
            <div class="card-body card-outline">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-default">
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <form id="form1" name="form1" method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">ID Penjualan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="next_proses" id="next_proses"
                                                        class="form-control datakode" readonly>
                                                    <input type="hidden" name="pembuat"
                                                        value="<?php echo $this->session->userdata['full_name']; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="Nama Konsumen" class="col-sm-4 col-form-label">Nama
                                                    Konsumen</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date" id="reservationdate"
                                                        data-target-input="nearest">
                                                        <input type="text" name="nama" id="nama" class="form-control"
                                                            onkeypress="return handleEnter(this, event)"
                                                            onkeyup="f(this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Kode Barang" class="col-sm-4 col-form-label">Kode
                                                    Barang</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date" id="reservationdate"
                                                        data-target-input="nearest">
                                                        <input type="text" name="kode_barang" id="kode_barang" autofocus
                                                            class="form-control">
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#cari-barang"><i
                                                                    class="glyphicon glyphicon-plus-sign"><i
                                                                        class="fa fa-search"></i>
                                                                    Cari..</button></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="riwayat"></div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Nama Barang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="nama_barang" id="nama_barang"
                                                        class="form-control" onkeydown="f(this)" onkeyup="f(this)"
                                                        onkeypress="return handleEnter(this, event)">
                                                    <input type="hidden" name="harga_eceran" id="harga_eceran"
                                                        class="form-control" onkeydown="f(this)" onkeyup="f(this)"
                                                        onkeypress="return handleEnter(this, event)">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Jumlah</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="jml_barang" id="jml_barang" value="1"
                                                        onfocus="startCalculate()" onblur="stopCalc()"
                                                        onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="form-control btn bg-gradient-primary">
                                                        <i class="fa fa-check-circle"></i> Simpan</button>
                                                </div>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <div class="card card-default">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="form2" name="form2" method="POST">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Diskon ?</label>
                                            <div class="col-sm-4">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" name="diskon" value="N" id="radioSuccess4">
                                                    <label for="radioSuccess4"> Rupiah
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" name="diskon" value="Y" id="radioSuccess3">
                                                    <label for="radioSuccess3"> Persen
                                                    </label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Jml/Dsc</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="potongan" id="potongan"
                                                    onfocus="startCalculate()" onblur="stopCalc()"
                                                    onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                    class="form-control input-medium">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <input type="hidden" name="total_diskon" id="total_diskon"
                                                onfocus="startCalculate()" onblur="stopCalc()"
                                                onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                class="form-control">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pembayaran ?</label>
                                            <div class="col-sm-9">
                                                <div class="icheck-info d-inline">
                                                    <input type="radio" id="radioPrimary1" name="pembayaran"
                                                        value="cash" checked>
                                                    <label for="radioPrimary1">Cash
                                                    </label>
                                                </div>
                                                <div class="icheck-info d-inline">
                                                    <input type="radio" id="radioPrimary2" name="pembayaran"
                                                        value="debit">
                                                    <label for="radioPrimary2">Debit
                                                    </label>
                                                </div>
                                                <div class="icheck-info d-inline">
                                                    <input type="radio" id="radioPrimary3" name="pembayaran"
                                                        value="transfer">
                                                    <label for="radioPrimary3">Transfer
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="total_diskon" id="total_diskon"
                                                class="form-control">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Total</label>
                                            <div class="col-sm-9">

                                                <input type="hidden" name="kode_t" id="kode_t"
                                                    class="form-control datakode" required readonly>
                                                <input type="hidden" name="total_harganya" id="total_harganya" value=""
                                                    onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                    readonly class="form-control" align="right">
                                                <input type="text" name="total_bayar" id="total_bayar" value=""
                                                    onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                    readonly class="form-control" align="right">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Total Diskon</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="total_potongan" id="total_potongan"
                                                    onfocus="startCalculate()" onblur="stopCalc()"
                                                    onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                    class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Total Item</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="total_jumlah" id="total_jumlah"
                                                    onfocus="startCalculate()" onblur="stopCalc()"
                                                    onkeypress="return handleEnter(this, event)" onkeydown="f(this)"
                                                    class="form-control" readonly>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nominal Bayar</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="jumlah_bayar" id="jumlah_bayar"
                                                    onfocus="startCalculate()" onClick="isi_total()"
                                                    onKeyPress="isi_total()" onblur="stopCalc()"
                                                    onkeyup="formatNumber(this)" onchange="formatNumber(this)"
                                                    onkeydown="f(this)" class="form-control" required>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Kembalian</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="kembalian" id="kembalian"
                                                    onchange="formatNumber(this)" onblur="formatNumber(this)"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button class="btn bg-gradient-success col-sm-12 cetak-ttb" id="cetak"
                                                    data-id="" hidden=""> <i class="fa fa-print"></i>
                                                    Cetak</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                </section>
                <div class="col-md-12">
                    <div class="card card-default">
                                    <div id="data-penjualan"></div>
                    </div>

                </div>
            </div>
            <div id="modal-ttb"></div>
            <div id="tempat-modal"></div>
            <?php echo $modal_cari_barang; ?>

            <?php show_my_confirm('konfirmasiHapus', 'hapus-data', 'Hapus Data Ini?', 'Ya, Hapus Data Ini', 'Batal Hapus data'); ?>
            <script type="text/javascript">
            document.form1.kode_barang.focus();

            $('#datepicker,#date1').datetimepicker({
                format: 'DD-MM-YYYY',
                date: moment()
            });

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
            var MyTable = $('#table-konsumen').dataTable({
                "responsive": false,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "pageLength": 5
            });

            var MyTable = $('#table-barang').dataTable({
                "responsive": false,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "pageLength": 5
            });


            //next id send datakode
            function next(datakode) {
                document.getElementById('next_proses').value = datakode;
                document.getElementById('kode_t').value = datakode;
                var d = document.getElementById("cetak");
                d.setAttribute('data-id', datakode, );
                document.getElementById("tab-proses-tab").hidden = false;
            }

            function tampilDetailkirim2(datakode) {
                //var out = jQuery.parseJSON(data);
                var next_proses = document.getElementById('next_proses').value = datakode;
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Penjualan/tampilDetail'); ?>',
                    data: 'next_proses=' + next_proses,
                    success: function(hasil) {
                        MyTable.fnDestroy();
                        $('#data-penjualan').html(hasil);
                        //document.getElementById('total_bayar').value=val.harga_karton;
                        //refresh();

                        document.getElementById("cetak").hidden = false;
                    }
                });
            }

            function tampilDetailkirim(datakode) {
                var next_proses = document.getElementById('next_proses').value = datakode;
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Penjualan/tampilDetail'); ?>',
                    data: 'next_proses=' + next_proses,
                    success: function(hasil) {
                        MyTable.fnDestroy();
                        $('#data-penjualan').html(hasil);
                        refresh();
                        document.getElementById("cetak").hidden = false;
                    }
                });
            }

            function isi_total() {
                var kode = document.getElementById('next_proses').value;
                $.ajax({
                    url: "<?php echo base_url();?>Penjualan/cari_sum",
                    data: '&kode=' + kode,
                    success: function(data) {
                        var hasil = JSON.parse(data);
                        $.each(hasil, function(key, val) {
                            document.getElementById('total_harganya').value = val
                                .total_harganya;
                            document.getElementById('total_jumlah').value = val.total_jumlah;

                        });
                    }
                });

            }
            $('#form1').submit(function(e) {
                var data = $(this).serialize();

                $.ajax({
                        method: 'POST',
                        url: '<?php echo base_url('Penjualan/prosesTtransaksi'); ?>',
                        data: data
                    })
                    .done(function(data) {
                        var out = jQuery.parseJSON(data);
                        document.getElementById('kode_t').value = out.datakode;
                        tampilDetailkirim(out.datakode);
                        isi_total()
                        if (out.status == 'form') {
                            //toastr.error(out.msg);
                            $('.msg').html(out.msg);
                            next(out.datakode);
                            toastr.error(out.msg);
                        } else {
                            document.getElementById("form1"); //reset()
                            $('#kode_barang').val('');
                            $('#nama_barang').val('');
                            $('#harga').val('');
                            $('#satuan').val('');
                            $('#supplier').val('');
                            $('#potongan').val('');
                            $('#total_harga').val('');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            //refresh();
                            startCalculate()
                            //$('.msg').html(out.msg);
                            //effect_msg();
                        }
                    })

                e.preventDefault();
            });
            $('#form-tambah-pengiriman').on('hidden.bs.modal', function() {
                $('.form-msg').html('');
            })
            $('#form1').on('hidden.bs.modal', function() {
                $('.form-msg').html('');
            })
            $('#update-konsumen').on('hidden.bs.modal', function() {
                $('.form-msg').html('');
            })
            $(document).on("click", ".edit-detail", function() {
                var id = $(this).attr("data-id");

                $.ajax({
                        method: "POST",
                        url: "<?php echo base_url('Penjualan/update_detail'); ?>",
                        data: "id=" + id
                    })
                    .done(function(data) {
                        $('#tempat-modal').html(data);
                        $('#edit-detail').modal('show');
                    })
            })
            $(document).on('submit', '#form-editdetail', function(e) {
                var data = $(this).serialize();

                $.ajax({
                        method: 'POST',
                        url: '<?php echo base_url('Penjualan/proses_edit'); ?>',
                        data: data
                    })
                    .done(function(data) {
                        var out = jQuery.parseJSON(data);

                        tampilDetailkirim(out.datakode)
                        if (out.status == 'form') {
                            //$('.form-msg').html(out.msg);
                            toastr.error(out.msg);
                        } else {
                            document.getElementById("form-editdetail").reset();
                            $('#edit-detail').modal('hide');
                            toastr.success(out.msg);
                            startCalculate();
                            isi_harga()
                            //$('.msg').html(out.msg);
                            //effect_msg();
                        }
                    })

                e.preventDefault();
            });


            function cetakTtb(datakode) {}
            $(document).on('submit', '#form2', function(e) {
                var data = $(this).serialize();
                $.ajax({
                        method: 'POST',
                        url: '<?php echo base_url('Penjualan/cetak'); ?>',
                        data: data
                    })
                    .done(function(data) {
                        $('#modal-ttb').html(data);
                        $('#cetak-ttb').modal('show');

                    })
            })


            function cetakTtb(datakode) {}
            $(document).on("click", ".cetak-ulang", function() {
                var id = $(this).attr("data-id");

                $.ajax({
                        method: "POST",
                        url: "<?php echo base_url('Penjualan/cetak_ulang'); ?>",
                        data: "id=" + id
                    })

                    .done(function(data) {
                        $('#tempat-modal').html(data);
                        $('#cetak-ttb').modal('show');

                    })
            })

            $('#form2').submit(function(e) {
                var data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url('Penjualan/cetak'); ?>',
                    data: data
                })


                e.preventDefault();
            });

            var data_id;
            $(document).on("click", ".delete-detail", function() {
                data_id = $(this).attr("data-id");
            })
            $(document).on("click", ".hapus-data", function() {
                var id = data_id;

                $.ajax({
                        method: "POST",
                        url: "<?php echo base_url('Penjualan/deleteDetail'); ?>",
                        data: "id=" + id
                    })
                    .done(function(data) {
                        var out = jQuery.parseJSON(data);
                        if (out.status != 'form') {
                            $('#konfirmasiHapus').modal('hide');
                            toastr.error(out.msg);
                            var next_proses = document.form1.next_proses.value;
                            refresh();
                            isi_total()
                            //isi_harga2(next_proses);
                            //next(next_proses);
                            tampilDetailkirim(next_proses);
                        }
                    })
            })
            /**
                            function listPenjualan() {
                                var date1 = document.getElementById("date1").value;
                                $.ajax({
                                    type: 'GET',
                                    url: '<?php echo base_url('Penjualan/list_penjualan'); ?>?date1' + date1,
                                    data: 'date1=' + date1,
                                    success: function(hasil) {
                                        MyTable.fnDestroy();
                                        $('#list_penjualan').html(hasil);
                                        refresh();
                                    }
                                });
                            }
             */
            //Front//

            function success() {
                if (!document.getElementById("next_proses").value.length) {
                    document.getElementById('cetak').disabled = true;
                } else {
                    document.getElementById("cetak").style.visibility = "hidden";
                }
            }

            function selectHarga(kode_barang, nama_barang, harga_eceran) {
                document.getElementById('kode_barang').value = kode_barang;
                document.getElementById('nama_barang').value = nama_barang;
                document.getElementById('harga_eceran').value = harga_eceran;

                $('#cari-barang').modal('hide');
            }
            /**
                            function isi_otomatis() {
                                var kode = document.getElementById('kode_barang').value;
                                $.ajax({
                                    url: "<?php echo base_url();?>Penjualan/cari_harga",
                                    data: '&kode=' + kode,
                                    success: function(data) {
                                        var hasil = JSON.parse(data);
                                        $.each(hasil, function(key, val) {
                                            document.getElementById('nama_barang').value = val.nama_barang;
                                            document.getElementById('harga_eceran').value = val.harga_eceran;

                                        });
                                    }
                                });

                            }
             */
            function isi_harga() {
                var kode = document.getElementById('id_penjualan').value;
                $.ajax({
                    url: "<?php echo base_url();?>Penjualan/isi_harga",
                    data: '&kode=' + kode,
                    success: function(data) {
                        var hasil = JSON.parse(data);
                        $.each(hasil, function(key, val) {
                            document.getElementById('total_harganya').value = val
                                .total_harganya;
                            document.getElementById('total_jumlah').value = val.total_jumlah;

                        });
                    }
                });

            }

            function isi_harga2() {
                var kode = document.getElementById('next_proses').value;
                $.ajax({
                    url: "<?php echo base_url();?>Penjualan/isi_harga2",
                    data: '&kode=' + kode,
                    success: function(data) {
                        var hasil = JSON.parse(data);
                        $.each(hasil, function(key, val) {
                            document.getElementById('total_harganya').value = val
                                .total_harganya;
                            document.getElementById('total_jumlah').value = val.total_jumlah;
                        });
                    }
                });

            }



            /* Fungsi */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            }

            function startCalculate() {
                interval = setInterval("Calculate()", 10);
            }

            function formatNumber1(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
            }

            function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
                try {
                    decimalCount = Math.abs(decimalCount);
                    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                    const negativeSign = amount < 0 ? "-" : "";

                    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                    let j = (i.length > 3) ? i.length % 3 : 0;

                    return negativeSign +
                        (j ? i.substr(0, j) + thousands : '') +
                        i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands);
                        //(decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
                } catch (e) {
                    console.log(e)
                }
            };

            function Calculate() {
                var total = document.form2.jumlah_bayar.value;
                total = total.replace(/\,/g, '');
                
                var t_bayar = document.form2.total_bayar.value;
                t_bayar = t_bayar.replace(/\,/g, '');

                var x = t_bayar;
                var y = total;
                var a = document.form2.total_harganya.value;
                var b = document.form2.potongan.value;
                var diskon = document.form2.total_diskon.value = (a * 1) * b / 100;

                if ($('#radioSuccess3').is(':checked')) {
                    document.form2.kembalian.value = formatMoney(y - x);
                    document.form2.total_potongan.value = (a * 1) * b / 100;
                    document.form2.total_bayar.value = formatMoney(a - diskon);
                } else {
                    document.form2.kembalian.value = formatMoney(y - x);
                    document.form2.total_bayar.value = formatMoney(a - b);
                    document.form2.total_potongan.value = b;
                }
            }

            function stopCalc() {
                clearInterval(interval);
            }
            </script>