<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
            <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-satuan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
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
    <td>Satuan</td>					
    <td>Aksi</td>					
      </thead>
      <tbody id="data-satuan">	

      </tbody>
    </table>
  </div>
</div>
		 
</div>
<?php  echo $modal_tambah_satuan; ?><div id="tempat-modal"></div>
</div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKota', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script type="text/javascript">
$('#datepicker','#datepicker2').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});
    
	window.onload = function() {
		tampilSatuan();
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
    
    function tampilSatuan() {
		$.get('<?php echo base_url('Satuan/showSat'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-satuan').html(data);
			refresh();
		});
	}
$('#form-tambah-satuan').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Satuan/prosesTsatuan'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSatuan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-satuan").reset();
				$('#tambah-satuan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

$(document).on("click", ".update-dataSatuan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Satuan/updateSatuan'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-satuan').modal('show');
		})
	})
	$(document).on('submit', '#form-update-satuan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Satuan/prosesUsatuan'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSatuan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-satuan").reset();
				$('#update-satuan').modal('hide');
				$('.msg').html(out.msg);
            $('.msg').html(data);
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

	$('#tambah-satuan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-satuan').on('hidden.bs.modal', function () {
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

	
</script>