<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
            <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-supplier"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
            <p class="section-lead">             
            </p>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>       
        <tr>
         <td>No</td>
    <td>Nama Supplier</td>					
    <td>No Telp</td>					
    <td>Alamat</td>					
    <td>Aksi</td>					
      </thead>
      <tbody id="data-supplier">	

      </tbody>
    </table>
  </div>
</div>
		 
</div>
<?php  echo $modal_tambah_supplier; ?><div id="tempat-modal"></div>
</div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-supplier', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script type="text/javascript">
$('#datepicker','#datepicker2').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});
    
	window.onload = function() {
		tampilSupplier();
	}
	function refresh() {
		MyTable = $('#list-data,#table-1,#table-2,#table-barang,#list-menu').dataTable();
	}

var MyTable = $('#list-data,#table-1,#table-2').dataTable({
		"responsive": true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"processing": true
		});


    /* Supplier */
    
    function tampilSupplier() {
		$.get('<?php echo base_url('Supplier/showSup'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-supplier').html(data);
			refresh();
		});
	}
$('#form-tambah-supplier').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Supplier/prosesTsupplier'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSupplier();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Delete',
                                showConfirmButton: false,
                                timer: 1000
                            })
			} else {
				document.getElementById("form-tambah-supplier").reset();
				$('#tambah-supplier').modal('hide');
				$('.msg').html(out.msg);
                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
			}
		})
		
		e.preventDefault();
	});

$(document).on("click", ".update-dataSupplier", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Supplier/updateSupplier'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-supplier').modal('show');
		})
	})
	$(document).on('submit', '#form-update-supplier', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Supplier/prosesUsupplier'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSupplier();
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
				document.getElementById("form-update-supplier").reset();
				$('#update-supplier').modal('hide');
				$('.msg').html(out.msg);
                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Sukses',
                                showConfirmButton: false,
                                timer: 1000
                            })
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-supplier').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-supplier').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	
	var id_sup;
	$(document).on("click", ".delete-supplier", function() {
		id_sup = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-supplier", function() {
		var id = id_sup;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Supplier/deleteSup'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSupplier();
			$('.msg').html(data);
                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Delete',
                                showConfirmButton: false,
                                timer: 1000
                            })
		})
	})
	//end



</script>