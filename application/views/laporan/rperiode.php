<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
 <form role="form" id="form-cari-tempat" method="post" name="personal" action="#" class="form-horizontal form-groups-bordered">
                   
					<div class="form-group row">
                    <label class="col-sm-1 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-2 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">

                        <input type="text" name="date" id="datepicker" value="" class="form-control datepicker datetimepicker" 
                               data-toggle="datetimepicker" data-target=".datepicker" data-format="yyy-mm-dd" required>

                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                    <label class="col-sm-1 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-2 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">

                        <input type="text" name="date2" id="datepicker2" value="" class="form-control datepicker2 datetimepicker"
                               data-toggle="datetimepicker" data-target=".datepicker2" data-format="yyy-mm-dd" required>

                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                         <div class="col-sm-3 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">                       
                            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Cari..</button>
                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                    </div>
                    </div>
						
						<div class="col-md-3">
                        <div class="input-group">
        				</form>
						<?php if(!empty($dataHarian)){ $tgl1=$_REQUEST['date'];$tgl2=$_REQUEST['date2'];?>
<a href="<?php echo base_url('Laporan/exportPeriode'); ?>?tgl=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>"  onClick="validateForm()" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a><?php } ?>
    					</div></div>
                    </div>                        
      

</div>
</div> 
<div id="data-pertanggal"></div>
</div> 
</div> 
</div> 
                   
<script type="text/javascript">
$('#datepicker,#datepicker2,#datepicker3').datetimepicker({
    format: 'DD-MM-YYYY',
    date: moment()
});

function refresh() {
		MyTable = $('#list-data,#table-1,#table-2,#table-barang').dataTable();
	}

window.onload = function() {
        //tampilSatuan();
        listPertanggal()
    }

    function listPertanggal() {
        var date1 = document.getElementById("datepicker").value;
        var date2 = document.getElementById("datepicker2").value;
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('DataPenjualan/list_pertanggal'); ?>',
            data: 'date1=' + date1 + '&date2=' + date2,
            success: function(hasil) {
                MyTable.fnDestroy();
                $('#data-pertanggal').html(hasil);
                refresh();
            }
        });
    }
    $(document).on("click", ".export-excel", function() {
        var date1 = document.getElementById("date1").value;
        var date2 = document.getElementById("date2").value;

        $.ajax({
                method: "GET",
                url: '<?php echo base_url('Report/ExcelPertanggal1'); ?>?date1' + date1,
                data: 'date1=' + date1 + '&date2=' + date2,
            })
            .done(function(data) {
                html(data);
            })
    })


    //header("Content-type: application/vnd-ms-excel");
    //header("Content-Disposition: attachment; filename=Pengiriman Pertanggal.xls");
    var MyTable = $('#table-pertanggal').dataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true
    })
</script>
	