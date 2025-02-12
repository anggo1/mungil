<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
				<section class="style-default-bright" style="margin-top:0px;">
       
                   
                    
                    <button class="btn bg-gradient-green" data-toggle="modal" data-target="#tambah-barang"><span class="fa fa-plus"></span> Tambah Data </button> 
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url('Barang/export_dataBarang'); ?>">
                        <button class="btn btn-xl bg-gradient-indigo"> <i class="fa fa-file-excel"></i>  Export Excel</button></a>
                    
            <p class="section-lead">
              </p>
				<!-- BEGIN TABLE HOVER -->
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>       
     <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
        <tr>
          <th width="20">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Supplier</th>
                <th>Modal</th>
                <th>H Eceran</th>
                <th>Stok</th>
                <th>Tgl Exp</th>
			
          <th>Aksi</th>
        </tr>
     </thead>
            <tbody id="data-barang"></tbody><tfoot></tfoot>
    </table>
  </div>
</div>
		  
</div>
</div>
</div>
</div>
</div>
<?php echo $modal_tambah_barang; ?>

<div  id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataBarang', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script type="text/javascript">
$('#datepicker','#datepicker2').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});
    
	window.onload = function() {
		tampilSatuan();
		tampilSupplier();
		tampilBarang();
	}
	function refresh() {
		MyTable = $('#list-data,#table-1,#table-2,#table-barang,#list-menu').dataTable();
	}


	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(500);
		setTimeout(function() { $('.form-msg').fadeOut(500); }, 1000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(500);

                //toastr.success(data.message, 'Adding New Pegawai');
		setTimeout(function() { $('.msg').fadeOut(500); }, 1000);
	}

    var table;

$(document).ready(function() {

    //datatables
    table = $('#table-lap').DataTable({ 
	"responsive": true,
	"paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "processing": true, 
    "serverSide": true, 
    "order": [], 
        "ajax": {
            "url": "<?php echo site_url('Barang/ajax_konsumen')?>",
            "type": "POST"
        },       
        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": false, 
        },
        ],

    });

});
var MyTable = $('#list-data,#table-1,#table-2').dataTable({
		"responsive": true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"processing": true
		});


/* Konsumen */
$('#form-tambah-konsumen').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Barang/prosesTkonsumen'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
				window.setTimeout(function(){window.location.reload()}, 1000);
			} else {
				document.getElementById("form-tambah-konsumen").reset();
				$('#tambah-konsumen').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				window.setTimeout(function(){window.location.reload()}, 1000);
			}
		})
		
		e.preventDefault();
	});

$(document).on("click", ".update-dataKonsumen", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pengaturan/updateKonsumen'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-konsumen').modal('show');
		})
	})
	$(document).on('submit', '#form-update-konsumen', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pengaturan/prosesUkonsumen'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			//tampilPerusahaan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
				window.setTimeout(function(){window.location.reload()}, 1000);
			} else {
				document.getElementById("form-update-konsumen").reset();
				$('#update-konsumen').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				window.setTimeout(function(){window.location.reload()}, 1000);
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-konsumen').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-konsumen').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
    
    
	var id_kons;
	$(document).on("click", ".delete-konsumen", function() {
		id_kons = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKonsumen", function() {
		var id = id_kons;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Barang/deleteKons'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			$('.msg').html(data);
			effect_msg();window.setTimeout(function(){window.location.reload()}, 1000);
		})
	})
	
	//end
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

			tampilBarang();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-barang").reset();
				$('#tambah-barang').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

$(document).on("click", ".update-dataBarang", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Barang/updateBarang'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-barang').modal('show');
		})
	})
	$(document).on('submit', '#form-update-barang', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Barang/prosesUbarang'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBarang();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-barang").reset();
				$('#update-barang').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$(document).on("click", ".update-stokBarang", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Barang/updatestokBarang'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-stokbarang').modal('show');
		})
	})
	$(document).on('submit', '#form-stok-barang', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Barang/prosesSbarang'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBarang();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-stok-barang").reset();
				$('#update-stokbarang').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-barang').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-barang').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-stokbarang').on('hidden.bs.modal', function () {
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
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilBarang();
			$('.msg').html(data);
			effect_msg();
               // toastr.success(out.msg);
		})
	})
	
	
	//end
	/* Satuan */
    
    function tampilSatuan() {
		$.get('<?php echo base_url('Barang/showSat'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-satuan').html(data);
			refresh();
		});
	}
$('#form-tambah-satuan').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Barang/prosesTsatuan'); ?>',
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
			url: "<?php echo base_url('Barang/updateSatuan'); ?>",
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
			url: '<?php echo base_url('Barang/prosesUsatuan'); ?>',
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
				effect_msg();
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
	
	
	//end
    /* Supplier */
    
    function tampilSupplier() {
		$.get('<?php echo base_url('Barang/showSup'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-supplier').html(data);
			refresh();
		});
	}
$('#form-tambah-supplier').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Barang/prosesTsupplier'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSupplier();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-supplier").reset();
				$('#tambah-supplier').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

$(document).on("click", ".update-dataSupplier", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Barang/updateSupplier'); ?>",
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
			url: '<?php echo base_url('Barang/prosesUsupplier'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSupplier();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-supplier").reset();
				$('#update-supplier').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
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
			url: "<?php echo base_url('Barang/deleteSup'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSupplier();
			$('.msg').html(data);
			effect_msg();
		})
	})
	//end



	function req_nama_sp1(get_kode,get_area,flag)
{
clearTimeout(timer);
nic_sp=get_kode;
area=get_area;
if(flag=="start")
{
timer=setTimeout("req_nama_sp1(nic_sp,area,'delay')",200);
}
else if(flag=="delay")
{
if(get_kode==document.getElementById("nic_sp1").value)
{
var url="<?php echo base_url('laplaka/carisp');?>?rand="+Math.random();
var post="nic_sp="+nic_sp+"&act=req_nama_sp1";
ajax(url,post,area);
}
else
{timer=setTimeout("req_nama_sp1(nic_sp,area,'delay')",200);}
}
}
/* pencarian Nomor Kasusnye */
var xmlhttp = false;

try {
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
	xmlhttp = new XMLHttpRequest();
}


//untuk bukutamu
function surat(no_kasus){
	var obj=document.getElementById("pencarian");
	var url='<?php echo base_url('bak/carisurat');?>?no_kasus='+no_kasus;
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'><img src='waiting.gif' alt='Loading' /></div>";
		}
	}
	xmlhttp.send(null);
}

</script>