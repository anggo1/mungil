<div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="section-body">
    <section class="style-default-bright" style="margin-top:0px;">



        <button class="btn bg-gradient-green" data-toggle="modal" data-target="#tambah-barang"><span
                class="fa fa-plus"></span> Tambah Data </button>
        &nbsp;&nbsp;

        <p class="section-lead">
        </p>
        <!-- BEGIN TABLE HOVER -->

        <div class="row ">
            <div class="col-12 ">
                <div class="card card-first card-outline">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped  table-bordered table-hover dt-responsive nowrap"
                                id="tabel-part">
                                <thead>
                                    <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Supplier</th>
                                        <th>H Eceran</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data-barang"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
</div>
<?php echo $modal_tambah_barang; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataBarang', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script type="text/javascript">
$('#datepicker', '#datepicker2').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});

$(document).ready(function() {

    //datatables
    table = $("#tabel-part").DataTable({
        "dom": "<'row'<'col-sm-3 text-left'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
        "buttons": [{
                extend: 'copyHtml5',
                text: '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy',
                title: 'Data Barang',
                className: 'btn btn-sm  btn-outline-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: 'Excel',
                title: 'Data Barang',
                className: 'btn btn-outline-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF',
                title: 'Data Barang',
                className: 'btn btn-outline-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Cetak',
                titleAttr: 'Print',
                title: 'Data Barang',
                className: 'btn btn-outline-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-eye"></i> Tampilan',
                titleAttr: 'Costum Tampilan',
                className: 'btn btn-outline-secondary',
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                }
            }

        ],

        "responsive": true,
        "paging": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,

        "language": {
            "sEmptyTable": "Data Sparepart Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true,
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x"></i>'
        },
        "order": [],

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Barang/ajax_list') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }, ],

    })

});

/* Barang */

function tampilBarang() {
    $.get('<?php echo base_url('Barang/showList'); ?>', function(data) {
        MyTable.fnDestroy();
        $('#data-barang').html(data);
        refresh();
    });
}
$('#form-tambah-barang').submit(function(e) {
    var data = $(this).serialize();

    $.ajax({
            method: 'POST',
            url: '<?php echo base_url('Barang/prosesTbarang'); ?>',
            data: data
        })
        .done(function(data) {
            var out = jQuery.parseJSON(data);

            if (out.status == 'form') {
                $('.form-msg').html(out.msg);
                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Gagal',
                                showConfirmButton: false,
                                timer: 1000
                            })
            } else {
                document.getElementById("form-tambah-barang").reset();
                $('#tambah-barang').modal('hide');
                $('.msg').html(out.msg);
				Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
                window.setTimeout(function() {
                    window.location.reload()
                }, 1000);
            }
        })

    e.preventDefault();
});

$(document).on("click", ".update-dataBarang", function() {
    var id = $(this).attr("data-id");

    $.ajax({
            method: "POST",
            url: "<?php echo base_url('Barang/updateBarang'); ?>",
            data: "id=" + id
        })
        .done(function(data) {
            $('#tempat-modal').html(data);
            $('#update-barang').modal('show');
        })
})
$(document).on('submit', '#form-update-barang', function(e) {
    var data = $(this).serialize();

    $.ajax({
            method: 'POST',
            url: '<?php echo base_url('Barang/prosesUbarang'); ?>',
            data: data
        })
        .done(function(data) {
            var out = jQuery.parseJSON(data);

            if (out.status == 'form') {
                $('.form-msg').html(out.msg);
                effect_msg_form();
            } else {
                document.getElementById("form-update-barang").reset();
                $('#update-barang').modal('hide');
                $('.msg').html(out.msg);
				table.ajax.reload();
                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
                window.setTimeout(function() {
                }, 1000);
            }
        })

    e.preventDefault();
});
$(document).on("click", ".update-stokBarang", function() {
    var id = $(this).attr("data-id");

    $.ajax({
            method: "POST",
            url: "<?php echo base_url('Barang/updatestokBarang'); ?>",
            data: "id=" + id
        })
        .done(function(data) {
            $('#tempat-modal').html(data);
            $('#update-stokbarang').modal('show');
        })
})
$(document).on('submit', '#form-stok-barang', function(e) {
    var data = $(this).serialize();

    $.ajax({
            method: 'POST',
            url: '<?php echo base_url('Barang/prosesSbarang'); ?>',
            data: data
        })
        .done(function(data) {
            var out = jQuery.parseJSON(data);

            if (out.status == 'form') {
                $('.form-msg').html(out.msg);
                effect_msg_form();
            } else {
                document.getElementById("form-stok-barang").reset();
                $('#update-stokbarang').modal('hide');
                $('.msg').html(out.msg);
				table.ajax.reload();
                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
                window.setTimeout(function() {
                }, 1000);
            }
        })

    e.preventDefault();
});

$('#tambah-barang').on('hidden.bs.modal', function() {
    $('.form-msg').html('');
})

$('#update-barang').on('hidden.bs.modal', function() {
    $('.form-msg').html('');
})
$('#update-stokbarang').on('hidden.bs.modal', function() {
    $('.form-msg').html('');
})
var kode_barang;
$(document).on("click", ".delete-barang", function() {
    id_kons = $(this).attr("data-id");
})
$(document).on("click", ".hapus-dataBarang", function() {
    var id = id_kons;

    $.ajax({
            method: "POST",
            url: "<?php echo base_url('Barang/deleteBarang'); ?>",
            data: "id=" + id
        })
        .done(function(data) {
            $('#konfirmasiHapus').modal('hide');
			table.ajax.reload();
            $('.msg').html(data);
                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Data dihapus',
                                showConfirmButton: false,
                                timer: 1000
                            })
                window.setTimeout(function() {
                }, 1000);
        })
})


//end
/* Satuan */

</script>